<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Http\Response;

class MemberController extends Controller
{

    function home()
    {        
        return view('member.list');
    }

    function new()
    {
        return view('member.new');
    }

    function list()
    {
        return view('member.list');
    }

    function get($id)
    {
        return view('member.view');
    }

    function edit($id)
    {
        return view('member.edit');
    }

    function index()
    {
        $list = Member::all();
        $json = response()->json(['list' => $list]);
        //var_dump($json);
        //die();
        return $json;
    }

}
