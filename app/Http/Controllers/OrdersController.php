<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbWebsite;
use App\Models\lslbTransaction;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Http\Controllers\ArticleTitle;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Charge;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = array();
        $data['slug'] = 'orders';
        $data['userDetail'] = Auth::user();
        if (Auth::user()->role->name == 'Advertiser') {
            $selectedProjectId = session('selected_project_id');

            $data['orders'] = lslbOrder::where('u_id', Auth::user()->id)
                ->where('selected_project_id', $selectedProjectId)
                ->with('website')
                ->get();
            return view('advertiser/orders')->with($data);
        } else {
            $lslbOrder = new lslbOrder;
            $data['orders'] = $lslbOrder->orderList(Auth::user()->id);

            return view('publisher/orders')->with($data);
        }
    }

    public function updateOrderStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:lslb_orders,id',
                'status' => 'required|string',
                'reason' => 'nullable|string',
            ]);

            $order = lslbOrder::findOrFail($validated['id']);

            $order->advertiser_status = $validated['status'];

            if ($validated['status'] === 'change' && !empty($validated['reason'])) {
                $order->advertiser_change = $validated['reason'];
            }

            $order->save();

            if ($validated['status'] === 'complete') {
                $website = lslbWebsite::findOrFail($order->website_id);
                $publisherId = $website->user_id;

                $transaction = new lslbTransaction();
                $transaction->publisher_id = $publisherId;
                $transaction->transaction_date = now();
                $transaction->transaction_type = 'credit';
                $transaction->amount = $order->price;
                $transaction->currency = 'USD';
                $transaction->payment_email = $order->email;
                $transaction->status = 'pending';
                $transaction->description = 'Complete Orders';
                $transaction->save();
            }

            session()->flash('success', 'Order status updated successfully.');

            return response()->json([
                'success' => true,
                'success' => 'Order status updated successfully.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the order status.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()

    {
        //
    }

    protected function rules()
    {
        return [
            'website_id' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'attachment_type' => 'required',
            'payment_method' => 'required',
            'special_instructions' => 'required',
            'selected_project_id' => 'required',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), array_merge($this->rules(), [
            'attachment.*' => 'nullable|file|mimes:doc,docx,pdf|max:10240',
            'article_title.*' => 'nullable|string',
        ]));

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validatedData->errors(),
            ]);
        }

        $attachmentPaths = [];
        if ($request->hasFile('attachment')) {
            $files = $request->file('attachment');

            foreach ($files as $file) {
                if ($file->isValid()) {
                    $path = $file->store('uploads');
                    $attachmentPaths[] = $path;
                }
            }
        }

        $attachmentsString = implode(", ", $attachmentPaths);

        $data = $request->only([
            'website_id',
            'user_id',
            'price',
            'quantity',
            'attachment_type',
            'order_date',
            'delivery_time',
            'status',
            'payment_method',
            'special_instructions',
            'meta_description',
            'selected_project_id',
            'existing_post_url',
            'landing_page_url',
            'anchor_text',
        ]);

        // Handle article titles
        $articleTitles = $request->input('article_title');
        $storedArticleTitles = [];
        if ($articleTitles && is_array($articleTitles)) {
            foreach ($articleTitles as $title) {
                if (!empty($title)) {
                    $storedArticleTitles[] = $title;
                }
            }
        }

        $articleTitlesString = implode(", ", $storedArticleTitles);

        $data['order_id'] = 'order-' . md5(time() . 'DS');
        $data['order_date'] = date('Y-m-d');
        $data['payment_status'] = 'pending';
        $data['u_id'] = $request->post('user_id');
        $data['delivery_time'] = date("Y-m-d H:i:s", time() + 4 * 24 * 60 * 60);
        $data['status'] = 'new';

        $data['attachment'] = !empty($attachmentPaths) ? $attachmentsString : null;

        $user = lslbUser::find($data['user_id']);
        if ($user) {
            $data['email'] = $user->email;
        } else {
            return response()->json([
                'success' => false,
                'error' => 'User not found.',
            ]);
        }

        $order = lslbOrder::create($data);

        $order->update([
            'article_title' => $articleTitlesString,
        ]);

        $arr = [
            'order_id' => $data['order_id'],
            'price' => $data['price'],
            'payment_method' => $data['payment_method'],
            'id' => $order->id,
            'success' => true,
            'website_id' => $request->post('website_id'),
        ];

        if ($data['payment_method'] == 'paypal') {
            return redirect()->route('paypal.create', ['price' => $data['price'], 'orderId' => $data['order_id']]);
        } elseif ($data['payment_method'] == 'razorpay') {
            return view('razorpaypayment', [
                'price' => $data['price'],
                'orderId' => $data['order_id'],
            ]);
        }

        return response()->json($arr);
    }



    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }

    /**
     * Order Detail
     */

    public function orderInfo(string $id)
    {
        $data = array();
        $data['order'] = lslbOrder::where('order_id', $id)->with(['website.user', 'payments'])->get();
        if (!$data['order']) {
            abort(404);
        }
        $data['userDetail'] = Auth::user();
        return view('order_info')->with($data);
    }

    public function checkArticle(string $id)

    {
        $orders = lslbOrder::find($id);
        $docxFilePath = storage_path('app/' . $orders->attachment);
        try {
            $phpWord = IOFactory::load($docxFilePath);
            $content  = '';
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text = $element->getText();
                        $content .= $text;
                    } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text = $element->getText();
                        $content .= $text;
                    } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
                        $content .= '<br>';
                    } else {

                        $html = Html::render($element, $phpWord);
                        $content .= $html;
                    }
                }
            }

            // Use the extracted text as needed
            return view('publisher/blog')->with(['content' => $content]);
        } catch (\Exception $e) {
            return view('publisher/blog')->with(['error' => "Error reading the DOC file: " . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function updateStatus(Request $request, string $id)
    {
        if (!empty($request->post('status'))) {
            $order = lslbOrder::find($id);
            if (!$order) {
                abort(404);
            }

            $validatedData = $request->validate([
                'status' => 'required',
            ]);

            $status = $validatedData['status'];
            $note = $request->post('note', null);
            $url = $request->post('url', null);

            $updateData = ['status' => $status];

            if ($status === 'rejected' && $note) {
                $updateData['rejection_reason'] = $note;
            }

            if ($status === 'complete' && $url) {
                $updateData['completion_url'] = $url;
            }

            $order->update($updateData);

            $website = lslbWebsite::where('id', $order->website_id)->first();

            $user = lslbUser::where('id', $website->user_id)->first();

            $recipientEmail = ($user->role === 1) ? $user->email : $order->email;


            $statusText = ucwords($status);
            $noteText = ($status === 'rejected' && !empty($note)) ? "<p><strong>Reason for Rejection:</strong> " . ucfirst($note) . "</p>" : '';
            $urlText = ($status === 'complete' && !empty($url)) ? "<p><strong>Completion URL:</strong> <a href='" . $url . "'>" . $url . "</a></p>" : '';

            $customData = [
                'from_name' => "Links Farmer",
                'mailaddress' => "no-reply@linksfarmer.com",
                'subject' => 'Notification: Links Farmer - Order Status Update',
                'msg' => "<p>Your order status has been updated:</p>
                            <ul>
                                <li><strong>Order ID:</strong> " . $order->order_id . "</li>
                                <li><strong>Website:</strong> " . $website->website_url . "</li>
                                <li><strong>New Status:</strong> " . $statusText . "</li>
                            </ul>
                            " . $noteText . "
                            " . $urlText . "  <!-- Display URL if status is 'Complete' -->
                            <a href='" . base_url('/advertiser/orders') . "'>View Orders</a>
                             " . ($statusText == 'Complete' ? "<p>Your order has been marked as complete. Please click the link below to review your completed orders:</p>
                                <a href='" . base_url('/advertiser/orders') . "'>View Completed Orders</a>" : "") . "
                                <p>If you have any questions or concerns, feel free to reach out to our customer support team.</p>
                                <p>Thank you for choosing Links Farmer!</p>",
            ];

            Mail::to($recipientEmail)->send(new MyMail($customData));

            $data = ['success' => 'Order status updated successfully', 'error' => ''];
        } else {
            $data = ['error' => 'Oops! Order status update failed', 'success' => ''];
        }

        echo json_encode($data, true);
        exit;
    }


    public function payment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => 10,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Example Charge',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('payment.failure');
        }
        return redirect()->route('payment.success');
    }
}
