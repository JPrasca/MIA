<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OccupationType;

class OccupationTypeController extends Controller
{
     /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-16
     * Descripción:     Método para obtener todos los tipos de ocupación
     * Modificación:    
     */
    public function index()
    {
        $list = OccupationType::all();
        $json = response()->json(['list' => $list]);
        //var_dump($json);
        //die();
        return $json;
    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-16
     * Descripción:     Método para obtener todos los tipos de ocupación (este retorna el vector directamente)
     * Modificación:    
     */
    public function GetOccupationsAll()
    {
        $list = OccupationType::all();
        
        return $list;
    }
}
