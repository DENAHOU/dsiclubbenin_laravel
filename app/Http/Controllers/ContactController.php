<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to('contact@clubdsibenin.bj')
            ->send(new ContactMessage(
                $request->name,
                $request->email,
                $request->subject,
                $request->message
            ));


        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
