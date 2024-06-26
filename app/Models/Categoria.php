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




class Categoria 
{

    
    
    //Busca adm com email para Login
    public static function relatorio_all_categorias() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_categorias"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    //Busca adm com email para Login
    public static function relatorio_all_categorias_ativas() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_categorias_ativas"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function cadastrar_nova_categoria($description, $sequence) {
        //Dados obrigatorios
        $array = [
            "funcao"        => "cadastra_nova_categoria",
            "description"   => $description,
            "sequence"      => $sequence,
            "active"        => 1,
            "created_at"    => Padroes_gerais::data_e_hora()
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_categoria_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao"  => "busca_categoria_com_id",
            "id_category" => $id
            
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Busca adm com email para Login
    public static function altera_categoria($id_category, $active, $description, $sequence) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "altera_categoria",
            "id_category"       => $id_category,
            "active"            => $active,
            "description"       => $description,
            "sequence"          => $sequence
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function busca_categorias_to_select() {
        //Dados obrigatorios
        $array = [
            "funcao"  => "busca_categorias_to_select"
            
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

    
    
  
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
