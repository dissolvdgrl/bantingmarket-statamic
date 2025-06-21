<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {

        $validated = $request->validate([
              "firstname" => "required|string",
              "email_address" => "required|email",
              "website" => "prohibited",
              "contact_number" => "required|numeric",
              "msg_subject" => "required|string",
              "msg_body" => ["required", "alpha_num", "min:24", "max:300","not_regex:/\b(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/[^\s]*)?/i"]
        ]);



        session()->flash('success', 'Message sent, we will contact you soon.');
        return redirect('/contact');
    }
}
