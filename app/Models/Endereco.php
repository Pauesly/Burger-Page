<?php

namespace App\Models;

use Core\Session;
use Core\Redirect;

use Core\WS_read;
use Core\WS_read_free;
use Core\WS_update;
use Core\WS_write;
use Core\WS_write_free;
use App\Models\Padroes_gerais;




class Endereco 
{


    //Busca adm com email para Login
    public static function busca_endereco_por_id($id_address) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_endereco_por_id",
            "id_address"     => $id_address,
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
