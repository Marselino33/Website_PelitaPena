<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BackendController extends Controller
{
    public function users()
    {
        $backendUrl = env('BACKEND_API_URL') . '/users';
        $resp       = Http::get($backendUrl);

        if ($resp->failed()) {
            abort(502, 'Gagal ambil data dari backend');
        }

        // Parse teks menjadi array
        $lines = explode("\n", trim($resp->body()));
        $users = [];
        foreach ($lines as $line) {
            if (strpos($line, '- ') === 0) {
                [$id, $name] = explode(': ', substr($line, 2), 2);
                $users[]     = ['id' => $id, 'name' => $name];
            }
        }

        return view('users', compact('users'));
    }
}
