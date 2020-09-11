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




class ItemProduto
{

    
    
     //Busca adm com email para Login
    public static function add_item_produto($id_produto, $item) {
        //Dados obrigatorios
        $array = [
            "funcao"        => "add_item_produto",
            "fk_id_product" => $id_produto,
            "fk_id_item"    => $item
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function busca_itens_de_produto($id_produto) {
        //Dados obrigatorios
        $array = [
            "funcao"        => "busca_itens_de_produto",
            "fk_id_product" => $id_produto
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function remove_item_produto($id_item_produto) {
        //Dados obrigatorios
        $array = [
            "funcao"          => "remove_item_produto",
            "id_item_product" => $id_item_produto
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
