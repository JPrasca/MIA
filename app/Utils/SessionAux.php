<?php
namespace App\Utils;

use Illuminate\Http\Request;
class SessionAux
{
    public static function check(Request $request)
    {
       if($request->cookie('token') !== null)
       {
            return true;
       }
       return false;
    }

    public static function stopSession()
    {
        session_destroy();
    }

    public static function getCookieSession(Request $request)
    {
        $vSession = [
            'name' => $request->cookie('name'),
            'token' => $request->cookie('token')
        ];

        return $vSession;
    }
}