<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-29
     * Descripción:     Método para mostrar la vista inicial del aplicativo
     * Modificación:      
     * */
    function index(Request $request)
    {
        try
        {
            /**
             * corroborando que existan datos de usuario logeado
             */
            if(Cookie::get('token') != null && Cookie::get('token') != '')
            {
                $objUser = new User();
                $objUserFind = $objUser::where('remember_token', '=', Cookie::get('token'))->first();

                return view('index', [
                    'sLevelDir' => config('constants.level1'), 
                    'objUser' => [
                        'name' => $request->cookie('username'), 
                        'token' => $request->cookie('token'),
                        'rol_id' => $request->cookie('rol_id')
                    ]
                ]);
            }else{
                return \redirect('login');
            }
        }
        catch(\Throwable $th)
        {   
            return \abort(404);
        }
    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-29
     * Descripción:     Método alternativo para mostrar la vista inicial del aplicativo para un usuario que recien logeado
     * Modificación:      
     * */
    function index2($token)
    {
        try
        {
            /** corroborando que exista el token que se envía por la ruta */
            if($token != null && $token != '')
            {
                $objUser = new User();
                $objUserFind = $objUser::where('remember_token', '=', $token)->first();

                Cookie::queue('username', $objUserFind->name, \config('constants.session_time'));
                Cookie::queue('token', $token, \config('constants.session_time'));
                Cookie::queue('rol_id', $objUserFind->rol_id, \config('constans.session_time'));

                return redirect('member');
            }else{
                return \redirect('login');
            }
        }
        catch(\Throwable $th)
        {
            return \abort(404);
        }
    }
}
