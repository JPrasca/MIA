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

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-05-9
     * Descripción:     Método para obtener la vista inicial del maestro de áreas/ministerios
     * Modificación:    
     */
    function list()
    {
        try {
            
            return view('param/member_type_list', ['sLevelDir' => config('constants.level2')]);
        } catch (\Throwable $th) {
            return \abort(404);
        }
    }
}
