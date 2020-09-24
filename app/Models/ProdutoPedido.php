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
    
    
    //Busca adm com email para Login
    public static function add_produto_pedido($fk_id_order, $fk_id_product, $qtd, $price_unit, $obs) {
        //Dados obrigatorios
        $array = [
            "funcao"        => "add_produto_pedido",
            "fk_id_order"   => $fk_id_order,
            "fk_id_product" => $fk_id_product,
            "qtd"           => $qtd,
            "price_unit"    => $price_unit,
            "price_total"   => $price_unit * $qtd,
            "obs"           => $obs,
            "created_at"    => Padroes_gerais::data_e_hora()
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function remove_produto_pedido($id_produto_order) {
        //Dados obrigatorios
        $array = [
            "funcao"             => "remove_produto_pedido",
            "id_produto_order"   => $id_produto_order
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_total_pedido($id_order) {
        //Dados obrigatorios
        $array = [
            "funcao"             => "busca_total_pedido",
            "fk_id_order"        => $id_order
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
   

    
    
    
    

    
    

    
    

    
    
    
    
}

    
