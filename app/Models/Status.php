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




class Status 
{

    
    
    //Busca adm com email para Login
    public static function relatorio_all_status() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_status"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function cadastra_novo_status($name, $sequence) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "cadastra_novo_status",
            "status"      => $name,
            "sequence" => $sequence,
            "active"   => 1
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_status_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao"  => "busca_status_com_id",
            "id_status" => $id
            
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Busca adm com email para Login
    public static function altera_status($id_status, $active, $name, $sequence) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "altera_status",
            "id_status"   => $id_status,
            "active"    => $active,
            "name"      => $name,
            "sequence" => $sequence
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
