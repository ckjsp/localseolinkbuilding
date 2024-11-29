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
            $data['orders'] = lslbOrder::where('u_id', Auth::user()->id)->with('website')->get();
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
            'type' => 'required',
            'payment_method' => 'required',
            'article_title' => 'required',
            'special_instructions' => 'required',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)

    {
        $request->validate([
            'attachment' => 'required|file|mimes:doc,docx|max:2048',
        ]);

        if ($request->file('attachment')->isValid()) {
            $path = $request->file('attachment')->store('uploads');
            // $validatedData = $request->validate($this->rules());
            $validatedData = Validator::make($request->all(), $this->rules());
            if ($validatedData->fails()) {
                $arr = array();
                $arr['success'] = false;
                $arr['error'] = $validatedData->errors();
                echo json_encode($arr);
                exit;
                // return redirect()->back()->withInput()->withErrors($validatedData);
            } else {
                $data = $request->only(['order_id', 'website_id', 'u_id', 'price', 'quantity', 'type', 'order_date', 'delivery_time', 'status', 'payment_method', 'article_title', 'special_instructions',]);
                $data['order_id'] = 'order-' . md5(time() . 'DS');
                $data['order_date'] = date('Y-m-d');
                $data['attachment'] = $path;
                $data['payment_status'] = 'pending';
                $data['u_id'] = $request->post('user_id');
                $t = time() + 4 * 24 * 60 * 60;
                $data['delivery_time'] = date("Y-m-d H:i:s", $t);
                $data['status'] = 'new';
                $order = lslbOrder::create($data);
                $arr = array();
                $arr['order_id'] = $data['order_id'];
                $arr['price'] = $data['price'];
                $arr['payment_method'] = $data['payment_method'];
                $arr['id'] = $order->id;
                $arr['success'] = true;
                $arr['website_id'] = $request->post('website_id');

                $order = lslbOrder::where('order_id', $data['order_id'])->with('website.user')->get();

                // echo 'hello';
                // print_r($order);
                // exit('data');

                $customData['from_name'] = "Links Farmer";
                $customData['mailaddress'] = "no-reply@linksfarmer.com";
                $customData['subject'] = 'Notification: Links Farmer - Order Place Successfully';
                $customData['msg'] = "<p>Thank you for your order!</p>
                <p>Your order has been successfully placed with the following details:</p>
                <ul>
                    <li><strong>Order ID:</strong> " . $arr['order_id'] . "</li>
                    <li><strong>Product Name:</strong> " . $order[0]->website->website_url . "</li>
                    <li><strong>Total Amount:</strong> $" . $order[0]->price . "</li>
                </ul>
                <a href='" . base_url('/advertiser/orders') . "'>View Orders</a>
                <p>We will process your order and notify you once it's publish. If you have any questions, feel free to contact us.</p>
                <p>Thank you for shopping with us!</p>";
                // Mail::to(Auth::user()->email)->send(new MyMail($customData));

                $customData['subject'] = 'Notification: Links Farmer - New website added';
                $customData['msg'] = "<p>Congratulations! You have a new order to fulfill:</p>
                    <ul>
                        <li><strong>Order ID:</strong> " . $arr['order_id'] . "</li>
                        <li><strong>Website:</strong> " . $order[0]->website->website_url . "</li>
                        <li><strong>Total Amount:</strong> $" . $order[0]->price . "</li>
                    </ul>
                    <a href='" . base_url('/publisher/orders') . "'>View Orders</a>
                    <p>Publish the advertiser provided detail. If you have any questions, please contact the customer directly.</p>
                    <p>Thank you for being a seller on our platform!</p>
                <li><strong>Customer Name:</strong> " . Auth::user()->name . "</li>
                <li><strong>Customer Email:</strong> " . Auth::user()->email . "</li>";
                // echo 'hello';
                // print_r($order[0]->website->user);
                // exit('data');
                // Mail::to($order[0]->website->user->email)->send(new MyMail($customData));

                // echo json_encode($arr);
                // exit;
                if ($data['payment_method'] == 'paypal') {
                    return redirect()->route('paypal.create', ['price' => $data['price'], 'orderId' => $data['order_id']]);
                } elseif ($data['payment_method'] == 'razorpay') {
                    return redirect()->route('razorpay.create', ['price' => $data['price'], 'orderId' => $data['order_id']]);
                }
            }
        } else {
            $arr = array();
            $arr['success'] = false;
            $arr['error'] = 'File upload failed.';
            echo json_encode($arr);
            exit;
            // return redirect()->back()->withInput()->withErrors('File upload failed.');
        }
    }

    /**
     * Display the specified resource.
     */
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
        // echo $docxFilePath;exit;
        try {
            $phpWord = IOFactory::load($docxFilePath);
            $content  = '';
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        // Capture text content
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
