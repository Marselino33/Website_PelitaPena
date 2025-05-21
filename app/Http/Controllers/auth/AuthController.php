<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function userLogin()
    {
        if (Cookie::has('user_token')) {
            return redirect()->back();
        }
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function login(Request $request)
    {

        $credentialType = filter_var($request->input('credential'), FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($request->input('credential')) ? 'phone_number' : 'username');

        $response = Http::post(env('API_URL') . 'api/user/login', [
            $credentialType => $request->input('credential'),
            'password' => $request->input('password'),
        ]);

        $responseData = $response->json();
        if ($response->successful() && $responseData['success'] == 1) {
            $user = $responseData['data'];
            if ($user['role'] !== 'admin') {
                return redirect()->back()->withInput()->withErrors(['message' => 'Maaf, silahkan login dengan Aplikasi Mobile']);
            }
            $token = $responseData['token'];
            $minutes = 600;
            $cookie = cookie('user_data', json_encode($user), $minutes, null, null, true, true);
            $tokenCookie = cookie('user_token', $token, $minutes, null, null, true, true);
            Alert::success('Success', $responseData['message']);
            return redirect()->route('admin.dashboard')->withCookie($cookie)->withCookie($tokenCookie);
        } else {
            Alert::error('Maaf', $responseData['message']);
            return redirect()->back()->withInput()->withErrors(['message' => $responseData['message']]);
        }
    }

    public function logout()
    {
        Cookie::queue(Cookie::forget('user_data'));
        Cookie::queue(Cookie::forget('user_token'));
        Alert::success('Success', 'Berhasil Logout');
        return redirect()->route('welcome');
    }
}
