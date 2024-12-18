<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbWebsite;
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
            // $data['orders'] = lslbOrder::with('website.user')->get();
            // echo '<pre>'; print_r( $data['orders'] ); echo '</pre>';exit;
            return view('publisher/orders')->with($data);
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

        // Convert article titles to a comma-separated string
        $articleTitlesString = implode(", ", $storedArticleTitles);

        $data['order_id'] = 'order-' . md5(time() . 'DS');
        $data['order_date'] = date('Y-m-d');
        $data['payment_status'] = 'pending';
        $data['u_id'] = $request->post('user_id');
        $data['delivery_time'] = date("Y-m-d H:i:s", time() + 4 * 24 * 60 * 60);
        $data['status'] = 'new';

        // Store attachments as a comma-separated string
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
        // echo '<pre>'; print_r( $data['order'] ); echo '</pre>';exit;
        if (!$data['order']) {
            abort(404); // Handle not found gracefully
        }
        $data['userDetail'] = Auth::user();
        return view('order_info')->with($data);
    }

    /** read docx fil */

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
                        // Capture text content from text element
                        $text = $element->getText();
                        $content .= $text;
                    } elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
                        // Capture line breaks
                        $content .= '<br>';
                    } else {
                        // Handle other elements as needed
                        // Here, we convert the element to HTML for display
                        $html = Html::render($element, $phpWord);
                        $content .= $html;
                    }
                }
            }
            /* foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    // Check if the element is a text run
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                echo '<pre>'; print_r( $textElement ); echo '</pre>';
                                $text .= $textElement->getText() . ' ';
                            }
                        }
                    }
                }
            } */
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
            $validatedData = $request->validate(['status' => 'required',]);
            $order->update($validatedData);
            $user = lslbUser::find($order->u_id);
            $website = lslbWebsite::find($order->website_id);
            $data = ['success' => 'Status updated successfully', 'error' => ''];
            $status = ucwords($validatedData['status']);
            $note = !empty($request->post('note')) ? "<p><strong>Note:</strong>" . ucwords($request->post('note')) . "</p>" : '';
            $customData['from_name'] = "Links Farmer";
            $customData['mailaddress'] = "no-reply@linksfarmer.com";
            $customData['subject'] = 'Notification: Links Farmer - Order Status Update';
            $customData['msg'] = "<p>Your order status has been updated:</p>
                <ul>
                    <li><strong>Order ID:</strong> " . $order->order_id . "</li>
                    <li><strong>Website:</strong> " . $website->website_url . "</li>
                    <li><strong>New Status:</strong> " . $status . "</li>
                </ul>
                <a href='" . base_url('/advertiser/orders') . "'>View Orders</a>
                " . $note . "
                <p>If you have any questions or concerns, please contact our customer support.</p>
                <p>Thank you for choosing our platform!</p>";

            Mail::to($user->email)->send(new MyMail($customData));

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
