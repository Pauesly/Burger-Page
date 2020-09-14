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




class ProdutoPedido
{

    
    
    //Busca adm com email para Login
    public static function busca_produtos_de_pedido($id) {
        //Dados obrigatorios
        $array = [
            "funcao" => "busca_produtos_de_pedido",
            "id" => $id
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
