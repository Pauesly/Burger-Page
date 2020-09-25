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
            "schedule_delivery" => 0,
            "to_deliver_in"     => Padroes_gerais::data_e_hora(),
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
    
    
    //Salva Status Delivery
    public static function salva_delivery_status($id_pedido, $delivery_status, $created_at) {
        
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_delivery_status",
            "schedule_delivery" => $delivery_status,
            "id_pedido"         => $id_pedido,
            "created_at"        => $created_at
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    //Salva Data e hora Delivery
    public static function salva_data_hora_delivery($data, $hora, $id_pedido) {
        
        $dt =  str_replace("/", "-", $data);
        $data_hora = date('Y-m-d', strtotime($dt)) . " " . $hora;
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_data_hora_delivery",
            "to_deliver_in"     => $data_hora,
            "id_pedido"         => $id_pedido
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
        
        
        $res_busca_nome  = array();
        $res_busca_tel = array();
        $fr_id_customer = "";
        
        //NOME
        if($nome != "666"){
            $array = [
                "funcao"       => "busca_cliente_nome_parcial",
                "name"         => $nome,
            ];
            $resultado_nome = WS_read::ler_dados($array);
            $resultado_nome =  json_decode($resultado_nome);
        }else{
            $array = [ "erro"       => "true"  ];
            $resultado_nome = json_encode($array);
            $resultado_nome = json_decode($resultado_nome);
        }
                
        //Coleta IDs da busca por nome
        if($resultado_nome->erro == false){
            foreach ($resultado_nome->resultado as $key => $valuei) {
                $res_busca_nome[] = $valuei->id_customer;
            }
        }
        
        //TELEFONE    
        if($tel != "666"){
            $array = [
                "funcao"       => "busca_cliente_por_telefone_parcial",
                "phone"        => $tel,
            ];
            $resultado_tel = WS_read::ler_dados($array);
            $resultado_tel = json_decode($resultado_tel);
        }else{
            $array = [ "erro"       => "true"  ];
            $resultado_tel = json_encode($array);
            $resultado_tel = json_decode($resultado_tel);
        }

        //Coleta IDs da busca por telefone se nao forem igual ao Nome
        if($resultado_tel->erro == false){
            foreach ($resultado_tel->resultado as $key => $valuej) {
                $res_busca_tel[] = $valuej->id_customer;
            }
        }
        
        
        
        //Tratamento Data
        $data_ini = str_replace("/", "-", $data_inicial);
        $data_ini = $data_ini . " 00:00:00 ";
        $data_ini =  date('Y-m-d H:i:s', strtotime($data_ini));
        
        $data_fin = str_replace("/", "-", $data_final);
        $data_fin = $data_fin . "  23:59:59 ";
        $data_fin =  date('Y-m-d H:i:s', strtotime($data_fin));
        
        $data_inicial   == "666" ? $data_ini   = " Orders.created_at BETWEEN '1900-01-01 00:00:00' " : $data_ini = " Orders.created_at BETWEEN '" . $data_ini."' ";
        $data_final     == "666" ? $data_fin   = " AND '2900-01-01 23:59:59' "                       : $data_fin   = " AND '" . $data_fin . "' ";
        
//        echo "\n\nDataini: " . $data_ini . "\n\n";
        
//      busca apenas por NOME
        if(
                ($nome != "666")
            &&
                ($resultado_nome->erro == true)
            &&
                ($tel == "666")
            &&
                ($data_inicial   == "666")
            &&
                $data_final   == "666"
                ){
            $array = [ "erro"       => "true"  ];
            $resultado_nn = json_encode($array);
            return json_decode($resultado_nn);
        }elseif (($resultado_nome->erro == false) && ($tel == "666")){
            $fr_id_customer = "(";
            foreach ($res_busca_nome as $key => $valuek) {
                $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE " . $valuek . " OR " ;
            }
            $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE 0) AND ";
        }
        
 //      busca apenas por TELEFONE
        if(
                ($nome == "666")
            &&
                ($resultado_tel->erro == true)
            &&
                ($tel != "666")
            &&
                ($data_inicial   == "666")
            &&
                $data_final   == "666"
                ){
            $array = [ "erro"       => "true"  ];
            $resultado_nn = json_encode($array);
            return json_decode($resultado_nn);
        }elseif((strlen($fr_id_customer) < 2) && ($nome == "666") && ($tel != "666")){
            $fr_id_customer = "(";
            foreach ($res_busca_tel as $key => $valuet) {
                $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE " . $valuet . " OR " ;
            }
            $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE 0) AND ";
        }
 
        
 //      busca por NOME e TELEFONE
        if(
                (($nome != "666") && ($resultado_nome->erro == true))
            ||
                (($tel != "666") && ($resultado_tel->erro == true))
           ){
            $array = [ "erro"       => "true"  ];
            $resultado_nn = json_encode($array);
            return json_decode($resultado_nn);
        }elseif(strlen($fr_id_customer) < 2){
            $fr_id_customer = "(";
            $count = 0;
            foreach ($res_busca_nome as $key => $valuey) {
                foreach ($res_busca_tel as $key => $valuex) {
//                    echo "comp. Y: " . $valuey . "\n X: " . $valuex;
                    if($valuex == $valuey){
                        $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE " . $valuex . " OR " ;
                        $count++;
                    }
                }
            }
            
            $fr_id_customer = $fr_id_customer . " fk_id_customer LIKE 0) AND ";
            if($count == 0){
                $fr_id_customer = "";
            }
        }
        
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_pedido_nome_tel_data",
            "fk_id_customer"    => $fr_id_customer,
            "created_at_ini"    => $data_ini,
            "created_at_fim"    => $data_fin,
        ];
        $resultado_final = WS_read::ler_dados($array);
        $resultado_final =  json_decode($resultado_final);
        
        if($resultado_final->erro == false){
            foreach ($resultado_final->resultado as $key => $value_f) {
                $tot = ProdutoPedido::busca_total_pedido($value_f->id_order);
                $resultado_final->resultado[$key]->total = $tot->resultado[0]->total;
            }
        }
        
        return  $resultado_final;
    }
   
    
    

    
    

    
    

    
    
    
    
}

    
