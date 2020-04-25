<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\MemberType;
use App\Http\Controllers\OccupationTypeController;
use Illuminate\Support\Facades;
use Illuminate\Http\Response;

class MemberController extends Controller
{

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener la vista inicial para miembros/personas
     * Modificación:    
     */
    function home()
    {        
        return view('member.list');
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener la vista para el registro de una persona nueva
     *                  (se carga la lista de tipos de ocupación)
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
     * Descripción:     Método para obtener la vista de todos los registros de la tabla de miembros
     * Modificación:    
     */
    function list()
    {
        try {
            
            return view('member.list');
        } catch (\Throwable $th) {
            return \abort(404);
        }
    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener la vista de datos de un miembro
     * 
     * Modificación:    
     * 2020-03-28 JPrasca: Se modifica consulta a retornar y se añade vector con los tipos de membresía correspondientes a
     *                      la persona.
     */
    function get($id)
    {

        try {

            /** Se busca a la persona */
            $objMember = Member::find($id);
            
            /** si esxiste en BD, se procede a consultar sus datos */
            if(!empty($objMember))
            {
                /** Consulta de varias tablas para traer el nombre de la ocupación */
                $objMemberAux = 
                    \DB::table('members')
                    ->join('occupation_type', 'members.occupation_type', '=', 'occupation_type.Id')
                    ->select(\DB::raw('members.*, occupation_type.name AS occupation_type, TIMESTAMPDIFF(YEAR,members.birth_date,CURDATE()) AS age'))
                    ->where('members.Id', '=', $id)
                    ->get();

                /** Se arma un array con los tipos de membresía correspondientes */
                $vMemberTypeAux = explode('|', $objMemberAux[0]->member_type_id);
                $vMemberTypeList = [];

                /** se recorre el array  y se arma uno nuevo con los datos de cada tipo de membresía (para ser mostrados en la vista) */
                for($i = 0; $i < count($vMemberTypeAux); $i++)
                {
                    if($vMemberTypeAux[$i] != '')
                    {
                        $vMemberTypeIdList[$i] = MemberType::find($vMemberTypeAux[$i]);
                    }
                }
                    
                return view('member.view', ['objMember' => $objMemberAux[0], 'vMemberTypeSelect' => $vMemberTypeIdList]);
            }else
            {
                return redirect('member/view');
            }

        } catch (\Throwable $th) {
            //return \abort(404);
            throw $th;
        }

    }

    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener la vista de actualización de datos de un miembro
     * Modificación:    
     */
    function edit($id)
    {
        try
        {
            $objMember = new Member();
            $objMemberAux = $objMember::where('Id', '=', $id)->first();
    
            $objOcupation = new OccupationTypeController();
            $vOccupationList = $objOcupation->GetOccupationsAll();
            if(!empty($objMemberAux))
            {
                $vMemberTypeIdList = explode('|',$objMemberAux->member_type_id);
            }else
            {
                return redirect('member/view');
            }
  
            return view('member.edit', ['objMember' => $objMemberAux, 'vOccupationlist' => $vOccupationList, 'vMemberTypeSelect' => $vMemberTypeIdList]);
        }
        catch(Exception $th){
            return abort(404);
        }

    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-01
     * Descripción:     Método para obtener todos los registros de la tabla de miembros
     * Modificación:    
     */
    function index()
    {
        try {
            $list = Member::all();
            $json = response()->json(['list' => $list]);

            return $json;
        } catch (\Throwable $th) {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en MemberController@index' + $th->getMessage()
            );
            return response()->json($data, $data['code']);
        }

    }


    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-21
     * Descripción:     Método guardar los datos de un miembro nuevo en base de datos
     * Modificación:      
     * */
    public function store(Request $request)
    {
        try {
           //recoger datos por  Post
            $json = $request->input('json', null);
            //$params = json_decode($json);
            $vParamsArray = json_decode($json, true);
            
            if(!empty($vParamsArray)){

                //Validar datos
                $validate = \Validator::make($vParamsArray, [
                    'Identification' => 'required|numeric',
                    'firstName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'lastName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'genre' => 'required',
                    'birthDate' => 'date',
                    'phone' => 'numeric',
                    'email' => 'email',
                    'occupation' => 'required',
                    'registrationDate' => 'date'
                ]);

                /** verificando la validez de los campos */
                if($validate->fails())
                {
                    $data = array(
                        'code' => 200,
                        'status' => 'error',
                        'message' => 'Parece que faltan algunos datos o no son correctos',
                        'data' => $vParamsArray
                    );
                }else
                {
                    
                    $objMember = new Member();              

                    $objMember->identification = $vParamsArray['Identification'];

                    /** corroborando que no exista otra persona con el mismo id */
                    $objMemberAux = $objMember::where('Identification', '=', $objMember->identification)->first();
                    if(!empty($objMemberAux))
                    {
                        $data = array(
                            'code' => 200,
                            'status' => 'error',
                            'message' => 'Parece que ya existe una persona con esta identificación',
                            'data' => $objMemberAux
                        );
                    }else
                    {
                        /** flujo ideal, completando registro de la persona */
                        $objMember->first_name = strtolower($vParamsArray['firstName']);
                        $objMember->last_name = strtolower($vParamsArray['lastName']);
                        $objMember->phone = $vParamsArray['phone'];
                        $objMember->member_type_id = $vParamsArray['memberType'];
                        $objMember->genre = $vParamsArray['genre'];
                        $objMember->birth_date = $vParamsArray['birthDate'];
                        $objMember->adress = strtolower($vParamsArray['adress']);
                        $objMember->occupation_type = $vParamsArray['occupation'];
                        $objMember->email = strtolower($vParamsArray['email']);
                        $objMember->regist_date = $vParamsArray['registrationDate'];
        
                        $objMember->save();
        
                        $data = array(
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'Ahora conozco un poco mas, puedes continuar ingresando datos o ver todos los miembros'
                        );
                    }
                }

            }else
            {
                $data = array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'No hay datos para ingresar'
                );
            }


            //devolver respuesta
            return response()->json($data, $data['code']);
        } catch (\Throwable $th) {
            $data = array(
                'code' => 200,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en MemberController@store' + $th->getMessage()
            );
            return response()->json($data, $data['code']);
        }
        
    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-03-22
     * Descripción:     Método actualizar los datos de un miembro registrado en base de datos
     * Modificación:      
     * */
    public function update(Request $request)
    {
        try {
            //recoger datos
            $json = $request->input('json', null);
            //$params = json_decode($json);
            $vParamsArray = json_decode($json, true);
            
            if(!empty($vParamsArray)){

                //Validar datos
                $validate = \Validator::make($vParamsArray, [
                    'Identification' => 'required|numeric',
                    'firstName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'lastName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'genre' => 'required',
                    'birthDate' => 'date',
                    'phone' => 'numeric',
                    'email' => 'email',
                    'occupation' => 'required',
                    'registrationDate' => 'date'
                ]);

                /** verificando la validez de los campos */
                if($validate->fails())
                {
                    $data = array(
                        'code' => 200,
                        'status' => 'error',
                        'message' => 'Parece que faltan algunos datos o no son correctos',
                        'data' => $vParamsArray
                    );
                }else
                {
                    
                    $objMember = new Member();

                    /** flujo ideal, completando registro de la persona */
                    $nMemberId = $vParamsArray['Id'];      

                    /** corroborando que no exista otra persona con el mismo id */
                    /** se busca un registro con el mismo número de identificación */
                    $objMemberAux = $objMember::where('Identification', '=', $vParamsArray['Identification'])->first();

                    /** luego se obtienen los datos del registro a editar (antes de ser actualizado) */
                    $objMemberAux2 = $objMember::where('Id', '=', $nMemberId)->first();

                    /** si existe un registro con el mismo número de identificación(objMemberAux)  y, además,
                     * se nota algún cambio en el número de identificación para el registro que se quiere actualizar (objMemberAux2)
                     * quiere decir que ya existe alguien ya en el sistema con dicho número
                      */
                    if(!empty($objMemberAux) && $objMemberAux2->identification != $vParamsArray['Identification'])
                    {
                        $data = array(
                            'code' => 200,
                            'status' => 'error',
                            'message' => 'Parece que ya existe una persona con esta identificación',
                            'data' => $objMemberAux
                        );
                    }else
                    {
                        /** actualización de los datos de la persona */
                        $objMember->where('id', '=', $nMemberId)->update([
                            'Identification' => $vParamsArray['Identification'],
                            'first_name' => strtolower($vParamsArray['firstName']),
                            'last_name' => strtolower($vParamsArray['lastName']),
                            'phone' => $vParamsArray['phone'],
                            'member_type_id' => $vParamsArray['memberType'],
                            'genre' => $vParamsArray['genre'],
                            'birth_date' => $vParamsArray['birthDate'],
                            'adress' => strtolower($vParamsArray['adress']),
                            'occupation_type' => $vParamsArray['occupation'],
                            'email' => strtolower($vParamsArray['email'])
                        ]);
        
                        $data = array(
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'Ahora conozco un poco mas, puedes continuar actualizando esta info o ver todos los miembros'
                        );
                    }                    
                }

            }else
            {
                $data = array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'No hay datos para ingresar'
                );
            }


            //devolver respuesta
            return response()->json($data, $data['code']);
        } catch (Exception $th) {
            $data = array(
                'code' => 200,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en MemberController@update' + $th->getMessage()
            );
            return response()->json($data, $data['code']);
        }
    }
}