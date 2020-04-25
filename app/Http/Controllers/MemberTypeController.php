<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberType;

class MemberTypeController extends Controller
{
   /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los tipos/ministerios
     * Modificación:    
     */
    function index()
    {
        $list = MemberType::all();
        $json = response()->json(['list' => $list]);

        return $json;
    }
}
