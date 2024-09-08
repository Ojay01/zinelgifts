<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'userMessage' => $request->message,  // Use 'userMessage' instead of 'message'
        ], function ($mail) use ($request) {
            $mail->from("support@zinelgifts.com", $request->name);
            $mail->to('support@zinelgifts.com')
                 ->subject('Contact Form Message');
        });
        

        // Return a response or redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function subscribe(Request $request)
    {
        // Validate the email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save the email and status to the database (status defaults to 1)
        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
