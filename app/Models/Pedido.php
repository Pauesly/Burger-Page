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




class Pedido 
{


    //Busca adm com email para Login
    public static function abrir_pedido($fk_id_adm, $fk_id_customer, $fk_id_address) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "abrir_pedido",
            "fk_id_adm"         => $fk_id_adm,
            "fk_id_customer"    => $fk_id_customer,
            "fk_id_address"     => $fk_id_address,
            "fk_id_status"      => 1,
            "payment_status"    => 0,
            "created_at"        => Padroes_gerais::data_e_hora(),
            "active"            => 1
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_dados_pedido($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_dados_pedido",
            "id_pedido"         => $id_pedido
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function salva_pagamento_sim($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_pagamento_pedido",
            "id_pedido"         => $id_pedido,
            "payment_status"    => 1
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function salva_pagamento_nao($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_pagamento_pedido",
            "id_pedido"         => $id_pedido,
            "payment_status"    => 0
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Sallva OBS
    public static function salva_obs($id_pedido, $txt_obs) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_obs_pedido",
            "id_pedido"         => $id_pedido,
            "obs"               => $txt_obs
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Sallva OBS
    public static function salva_forma_pagamento($id_pedido, $id_forma) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_forma_pagamento",
            "id_pedido"         => $id_pedido,
            "fk_id_payment_term" => $id_forma
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Sallva OBS
    public static function salva_status_pedido($id_pedido, $id_status_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_status_pedido",
            "id_pedido"         => $id_pedido,
            "fk_id_status"      => $id_status_pedido
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Sallva OBS
    public static function apagar_pedido($id_pedido) {
        //Dados obrigatorios
        $array = [
            "funcao"            => "apagar_pedido",
            "id_pedido"         => $id_pedido,
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //
    public static function busca_pedido_nome_tel_data($nome, $tel, $data_inicial, $data_final) {
        
        $fr_id_customer = "";
        
        if($nome != "666"){
            $array = [
                "funcao"       => "busca_cliente_nome_parcial",
                "name"         => $nome,
            ];
            $resultado_nome = WS_read::ler_dados($array);
            $resultado_nome =  json_decode($resultado_nome);
        }
            
        if($tel != "666"){
            $array = [
                "funcao"       => "busca_cliente_por_telefone_parcial",
                "phone"         => $tel,
            ];
            $resultado_tel = WS_read::ler_dados($array);
            $resultado_tel = json_decode($resultado_tel);
        }
        
        //BUSCAR SIMILARIDADE DE ID ENTRE NOME E TELEFONE. Juntar os ID customer numa string com o comando SQL pronto
        if(false){
            
        }
        
        //BUSCAR SIMILARIDADE DE ID ENTRE NOME E TELEFONE. Juntar os ID customer numa string com o comando SQL pronto
//        $encontrado = ( strpos( $palheiro, $agulha ) !== 0 );
//
//        if ($encontrado) {
//           echo 'Encontrado';
//        } else {
//           echo 'Não encontrado';
//        }
        
        
        $data_ini = str_replace("/", "-", $data_inicial);
        $data_ini = $data_ini . " 00:00:00 ";
        $data_ini =  date('Y-m-d H:i:s', strtotime($data_ini));
        
        $data_fin = str_replace("/", "-", $data_final);
        $data_fin = $data_fin . " 00:00:00 ";
        $data_fin =  date('Y-m-d H:i:s', strtotime($data_fin));
        
        $data_inicial   == "666" ? $data_ini   = " created_at BETWEEN 1900-01-01 00:00:00 " : $data_ini = " created_at BETWEEN " . $data_ini;
        $data_final     == "666" ? $data_fin   = " AND 2900-01-01 23:59:59 "                : $data_fin   = " AND " . $data_fin;
        
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_pedido_nome_tel_data",
            "fk_id_customer"    => $fr_id_customer,
            "created_at_ini"    => $data_ini,
            "created_at_fim"    => $data_fin,
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
   
    
    

    
    

    
    

    
    
    
    
}

    
