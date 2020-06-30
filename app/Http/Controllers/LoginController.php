<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-28
     * Descripción:     Método para mostrar formulario de inicio de sesión
     * Modificación:      
     * */
    function loginIndex()
    {
        return view('authentication.user_login', ['sLevelDir' => config('constants.level1')]);        
    }
}
