<?php
namespace App\Utils;

class EncryptAux
{
        
    /** 
     * Autor:           Jesús Prasca
     * Fecha:           2020-06-20
     * Descripción:     Método para (des)encryptar
     * Modificación:    
     */
    public static function encryptDecrypt($action, $string) {
        $output = false;
        
        $sEncryptMethod = "AES-256-CBC";
        $sSecretKey = 'secret key';
        $sSecretIv = 'secret iv';
        
        // hash
        $key = hash('sha256', $sSecretKey);
        
        // iv - método AES-256-CBC a 16 bytes
        $iv = substr(hash('sha256', $sSecretIv), 0, 16);
        
        if( $action == 'ENCRYPT' ) {
            $output = openssl_encrypt($string, $sEncryptMethod, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'DECRYPT' ){
            $output = openssl_decrypt(base64_decode($string), $sEncryptMethod, $key, 0, $iv);
        }
        
        return $output;
    }
}