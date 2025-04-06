<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'recipient' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        Mail::raw($request->body, function ($message) use ($request) {
            $message->to($request->recipient)
                ->subject($request->subject);
        });

        return redirect()->route('admin.user-profiles.index')->with('success', 'Email berhasil dikirim.');
    }
}
