<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberType;

class MemberTypeController extends Controller
{
    //
    function index()
    {
        $list = MemberType::all();
        $json = response()->json(['list' => $list]);
        //var_dump($json);
        //die();
        return $json;
    }
}
