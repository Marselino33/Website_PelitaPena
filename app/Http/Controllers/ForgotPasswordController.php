<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // 1) Form input email
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // 2) Proses cek email
    public function submitForgotForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Hanya akun dengan role ADMIN yang boleh reset password.']);
        }

        // kalau OK, redirect ke form reset-password dengan email di query
        return redirect()->route('password.reset', ['email' => $user->email]);
    }

    // 3) Form reset password
    public function showResetForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user->role !== 'admin') {
            abort(403);
        }

        return view('auth.reset-password', ['email' => $user->email]);
    }

    // 4) Proses update password
    public function submitResetForm(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:users,email',
            'password'              => 'required|string|min:8|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Operasi tidak diizinkan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
                         ->with('message', 'Password berhasil diperbarui, silakan login.');
    }
}
