<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileAdminController extends Controller
{
    public function profile(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/profile');

        if ($response->successful()) {
            $profile = $response->json()['Data'];
        } else {
            $profile = [];
        }
        return view('admin.pages.profile.admin_profile', [
            'title' => 'Admin Profile',
            'profile' => $profile
        ]);
    }
}
