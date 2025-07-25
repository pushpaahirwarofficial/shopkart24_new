<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }
    
    public function submit(Request $request)
    {
        $contact = $request->validate([
            'contact.name' => 'required|string|max:255',
            'contact.email' => 'required|email|max:255',
            'contact.body' => 'required|string',
        ]);

        // Send the email
        Mail::to('info@shopkart4.com')->send(new ContactFormSubmitted($contact['contact']));

        return back()->with('success', 'Your message has been sent!');
    }
}
