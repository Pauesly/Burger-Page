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




class Relatorio 
{

    //Busca 
    public static function relatorio_full($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_full",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca a
    public static function relatorio_cliente_vezes($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cliente_vezes",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca ad
    public static function relatorio_cliente_valor($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cliente_valor",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm c
    public static function relatorio_vendas_custo($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_vendas_custo",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }

    
     //Busca produto ABC
    public static function relatorio_produto_abc($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_produto_abc",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

     //Busca por cliente
    public static function relatorio_cliente($data_inicial, $data_final, $id_cliente) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cliente",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "id_cliente"       => $id_cliente
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

     //Busca por cliente
    public static function relatorio_cliente_soma_pedidos($data_inicial, $data_final, $id_cliente) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cliente_soma_pedidos",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "id_cliente"       => $id_cliente
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

    
