<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            $mail->from($request->email, $request->name);
            $mail->to('okellykings220@gmail.com')
                 ->subject('Contact Form Message');
        });
        

        // Return a response or redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
