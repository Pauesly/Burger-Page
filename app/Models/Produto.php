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




class Produto 
{

    //Busca adm com email para Login
    public static function busca_cardapio_site() {
        //Dados obrigatorios
        $array = [
            "funcao"     => "busca_cardapio_site"
        ];
        $resultado = WS_read_free::read_free($array);
        return  json_decode($resultado);
    }
    
    
    //Busca Produtos dados especificos
    public static function relatorio_all_produtos() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_produtos"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
     //Busca adm com email para Login
    public static function relatorio_all_produtos_ativos_menu() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_produtos_ativos_menu"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
     //Busca adm com email para Login
    public static function relatorio_all_produtos_ativos_menu_no_pic() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_produtos_ativos_menu_no_pic"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function cadastrar_novo_produto($fk_id_category, $name, $description, $picture_thumb, $picture_large, $star, $preco_new, $preco_old) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "cadastra_novo_produto",
            "fk_id_category"    => $fk_id_category,
            "name"              => $name,
            "description"       => $description,
            "picture_thumb"     => $picture_thumb,
            "picture_large"     => $picture_large,
            "star"              => $star,
            "price_new"         => $preco_new,
            "price_old"         => $preco_old,
            "active"            => 1,
            "created_at"        => Padroes_gerais::data_e_hora()
        ];
//        var_dump($array); die;
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_produto_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao"     => "busca_produto_com_id",
            "id_produto" => $id
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Busca adm com email para Login
    public static function salva_edit_produto($id_product, $fk_id_category, $name, $description, $star, $picture_thumb, $active, $preco_new, $preco_old) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_edit_produto",
            "id_product"        => $id_product,
            "fk_id_category"    => $fk_id_category,
            "name"              => $name,
            "description"       => $description,
            "star"              => $star,
            "picture_thumb"     => $picture_thumb,
            "active"            => $active,
            "preco_new"         => $preco_new,
            "preco_old"         => $preco_old
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function busca_imagem_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao"     => "busca_imagem_com_id",
            "id_produto" => $id
        ];
        $resultado = WS_read_free::read_free($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function busca_produtos_to_select() {
        //Dados obrigatorios
        $array = [
            "funcao"     => "busca_produtos_to_select"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
   
    
    
    
    
    
    
    
    
    

    
    

    
    

    
    
    
    
}

    
