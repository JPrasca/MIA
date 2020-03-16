<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Http\Controllers\OccupationTypeController;
use Illuminate\Http\Response;

class MemberController extends Controller
{

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function home()
    {        
        return view('member.list');
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function new()
    {
        $objOcupation = new OccupationTypeController();
        $vOccupationList = $objOcupation->GetOccupationsAll();
        return view('member.new', ['vOccupationlist' => $vOccupationList]);
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function list()
    {
        return view('member.list');
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function get($id)
    {
        return view('member.view');
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function edit($id)
    {
        return view('member.edit');
    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function index()
    {
        $list = Member::all();
        $json = response()->json(['list' => $list]);
        //var_dump($json);
        //die();
        return $json;
    }

}
