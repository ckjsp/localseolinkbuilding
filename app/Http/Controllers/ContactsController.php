<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function store(Request $request)

    {

        // Validation
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'message'      => 'required|string',
        ]);

        // Save to database
        Contact::create($request->all());

        return redirect()->back()->with('success', 'Contact submitted successfully!');
    }
}
