<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    use VerifiesEmails;

    public function show()
    {
        return view('auth.verify');
    }
}