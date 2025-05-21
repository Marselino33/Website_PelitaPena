<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ApiHelper
{
    public static function getAuthorizationHeader(Request $request)
    {
        $token = $request->cookie('user_token');
        $authorizationHeader = ['Authorization' => 'Bearer ' . $token];
        return $authorizationHeader;
    }
}
