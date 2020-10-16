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
    
    
     //Busca por produto
    public static function relatorio_produto($data_inicial, $data_final, $id_produto) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_produto",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "id_produto"       => $id_produto
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por produto
    public static function relatorio_categoria($data_inicial, $data_final, $id_cat) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_categoria",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "id_cat"           => $id_cat
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por produto
    public static function relatorio_municipio($data_inicial, $data_final, $municipio) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_municipio",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "municipio"        => $municipio
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    //Busca por produto
    public static function relatorio_cidade($data_inicial, $data_final, $cidade) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cidade",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "cidade"           => $cidade
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por produto
    public static function relatorio_pagamento($data_inicial, $data_final, $pagamento) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_pagamento",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final),
            "pagamento"        => $pagamento
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca por produto
    public static function relatorio_categoria_all($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_categoria_all",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por municipios
    public static function relatorio_municipio_all($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_municipio_all",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por cidade
    public static function relatorio_cidade_all($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_cidade_all",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca por Pagamento
    public static function relatorio_pagamento_all($data_inicial, $data_final) {
        //Dados obrigatorios
        $array = [
            "funcao"           => "relatorio_pagamento_all",
            "data_inicial"     => Padroes_gerais::ConverteDataBR_US($data_inicial),
            "fata_final"       => Padroes_gerais::ConverteDataBR_US($data_final)
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}

    
