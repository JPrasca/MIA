<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\User;
use App\Utils\EncryptAux;

class UserController extends Controller
{
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-20
     * Descripción:     Método guardar los datos de un usuario nuevo en base de datos
     * Modificación:      
     * */
    function check(Request $request)
    {        
        try
        {            
            //recoger datos por  Post
            $json = $request->input('json', null);
            //$params = json_decode($json);
            $vParamsArray = json_decode($json, true);

            if(!isset($_COOKIE['token']))
            {
                $data = array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'La sesión ha expirado'
                ); 
            }
            else
            {
                $data = array(
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Sessión activa'
                );  
            }

            //devolver respuesta
            return response()->json($data, $data['code']);
        }
        catch(\Throwable $th)
        {
            $data = array(
                'code' => 200,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en UserController@check: '.$th->getMessage()
            );
            return response()->json($data, $data['code']);
        }
    }
    
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-20
     * Descripción:     Método guardar los datos de un usuario nuevo en base de datos
     * Modificación:      
     * */
    function store(Request $request)
    {        
        try
        {            
            //recoger datos por  Post
            $json = $request->input('json', null);
            //$params = json_decode($json);
            $vParamsArray = json_decode($json, true);

            if(!empty($vParamsArray))
            {
                /** verificando que las contraseñas digitadas coincidan*/
                if($vParamsArray['password'] != $vParamsArray['password2'])
                {
                    $data = array(
                        'code' => 200,
                        'status' => 'error',
                        'message' => 'Parece que las contraseñas no coinciden',
                        'data' => $vParamsArray
                    );
                    
                    //devolver respuesta
                    return response()->json($data, $data['code']);
                }

                //Validar datos
                $validate = \Validator::make($vParamsArray, [
                    'userName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'email' => 'email',
                    'password' => 'required'
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
                }
                else
                {                    
                    $objUser = new User();              

                    /** corroborando que no exista otra persona con el mismo id */
                    $objUserAux = $objUser::where('email', '=', \strtolower($vParamsArray['email']))->first();
                    if(!empty($objUserAux))
                    {
                        $data = array(
                            'code' => 200,
                            'status' => 'error',
                            'message' => 'Parece que ya existe una persona con este email',
                            'data' => $objUserAux
                        );
                    }else
                    {
                        /** flujo ideal, completando registro del usuario */
                        $objUser->name = $vParamsArray['userName'];
                        $objUser->name = strtolower($vParamsArray['userName']);
                        $objUser->email = strtolower($vParamsArray['email']);
                        $objUser->password = EncryptAux::encryptDecrypt('ENCRYPT', strtolower($vParamsArray['password']));
                        $objUser->remember_token = EncryptAux::encryptDecrypt('ENCRYPT', strtolower($vParamsArray['userName']));
        
                        $objUser->save();
        
                        $data = array(
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'Ahora te conozco, puedes ingresar',
                            'token' => $objUser->remember_token
                        );
                    }                    
                }
            }
            else
            {
                $data = array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'No hay datos para ingresar'
                );
            }

            //devolver respuesta
            return response()->json($data, $data['code']);
        }
        catch(\Throwable $th)
        {
            $data = array(
                'code' => 200,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en UserController@store: '.$th->getMessage()
            );
            return response()->json($data, $data['code']);
        }
    }


        /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-22
     * Descripción:     Método para corroborar los datos del usuario en el login
     * Modificación:      
     * */
    function login(Request $request)
    {
        try
        {
            
            //recoger datos por  Post
            $json = $request->input('json', null);
            //$params = json_decode($json);
            $vParamsArray = json_decode($json, true);

            if(!empty($vParamsArray))
            {
                //Validar datos
                $validate = \Validator::make($vParamsArray, [
                    'userName' => 'required|regex:/^[\pL\s\-]+$/u',
                    'email' => 'email',
                    'password' => 'required'
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
                }
                else
                {                    
                    $objUser = new User();              

                    /** corroborando que exista el usuario */
                    $objUserAux = 
                        $objUser::where('name', '=', \strtolower($vParamsArray['userName']))
                        ->where('password', '=', EncryptAux::encryptDecrypt('ENCRYPT', strtolower($vParamsArray['password'])))
                        ->first();
                    
                    
                    if(!empty($objUserAux))
                    {
                        Cookie::queue('username', $objUserAux->name, \config('constants.session_time'));
                        Cookie::queue('token', $objUserAux->remember_token, \config('constants.session_time'));
                        Cookie::queue('role_id', $objUserAux->rol_id, \config('constants.session_time'));

                        $data = array(
                            'code' => 200,
                            'status' => 'success',
                            'message' => 'Bienvenido '.$objUserAux->name,
                            'data' => $objUserAux,
                            'token' => $objUserAux->remember_token
                        );
                        
                    }else
                    {
                        $data = array(
                            'code' => 200,
                            'status' => 'error',
                            'message' => 'Parece que no existe el usuario o la clave es incorrecta'
                        );
                    }                    
                }
            }
            else
            {
                $data = array(
                    'code' => 200,
                    'status' => 'error',
                    'message' => 'Datos incorrectos'
                );
            }

            //devolver respuesta
            return response()->json($data, $data['code']);
        }
        catch(\Throwable $th)
        {
            $data = array(
                'code' => 200,
                'status' => 'error',
                'message' => 'Ha ocurrido un error en UserController@login: '.$th->getMessage()
            );
            return response()->json($data, $data['code']);
        }
    }

    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-29
     * Descripción:     Método para borrar los datos del usurario en sesión
     * Modificación:      
     * */
    function logout(Request $request)
    {
        Cookie::queue(Cookie::forget('token'));
        Cookie::queue(Cookie::forget('username'));
        Cookie::queue(Cookie::forget('rol_id'));

        return \redirect('login');
    }
}
