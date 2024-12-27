<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{


    public function Home()
    {

        return view('pages.home');
    }

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

    public function Guestpostingservices()

    {

        return view('pages.guestpostingservices');
    }

    public function linkbuildingservices()
    {

        return view('pages.linkbuildingservices');
    }

    public function seoresellerservices()
    {

        return view('pages.seoresellerservices');
    }

    public function contentwritingservices()
    {

        return view('pages.contentwritingservices');
    }

    public function contentmarketingservices()
    {

        return view('pages.contentmarketingservices');
    }

    public function aboutus()
    {

        return view('pages.aboutus');
    }
    public function blog()
    {

        return view('pages.blogpage');
    }
}
