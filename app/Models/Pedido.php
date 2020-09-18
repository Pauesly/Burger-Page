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
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
