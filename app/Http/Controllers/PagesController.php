<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function termandconditions()
    {
        return view('pages.termandconditions');
    }

    public function privacypolicy()
    {

        return view('pages.privacypolicy');
    }

    public function CancellationandRefundPolicy()
    {

        return view('pages.cancellationandrefundpolicy');
    }

    public function ShippingandDeliveryPolicy()
    {

        return view('pages.shippinganddeliverypolicy');
    }

    public function ContactUs()
    {

        return view('pages.contactus');
    }
}
