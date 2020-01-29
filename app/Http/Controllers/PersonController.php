<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{

    function index()
    {        
        return view('person.index', [
            'title' => config('constants.name'), 
            'name' => config('constants.name'), 
            'author' => config('constants.author'), 
            'dataYear' => config('constants.dataYear')
        ]);
    }
}
