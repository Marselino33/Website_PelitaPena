<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('public.contact');
    }

    public function sendEmail(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Kirim email ke alamat tujuan
        Mail::to('dpmdppa@tobakab.go.id')
            ->send(new ContactMail($data));

        return back()->with('success', 'Pesan Anda telah terkirim!');
    }
}
