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




class OrderStatus 
{


    //Busca adm com email para Login
    public static function busca_status_de_pedido($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_status_de_pedido",
            "id_pedido"         => $id_pedido
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

    //Busca adm com email para Login
    public static function status_pedido_aberto($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_status_de_pedido",
            "id_pedido"         => $id_pedido
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
