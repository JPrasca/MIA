<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
