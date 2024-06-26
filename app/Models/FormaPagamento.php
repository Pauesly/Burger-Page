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




class FormaPagamento 
{

    
    
    //Busca adm com email para Login
    public static function relatorio_all_forma_pagamento() {
        //Dados obrigatorios
        $array = [
            "funcao" => "relatorio_all_forma_pagamento"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function cadastra_nova_forma_pagamento($name) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "cadastra_nova_forma_pagamento",
            "name"      => $name,
            "active"   => 1
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function busca_forma_pagamento_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao"  => "busca_forma_pagamento_com_id",
            "id_status" => $id
            
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Busca adm com email para Login
    public static function altera_forma_pagamento($id_payment_term, $active, $name) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "altera_forma_pagamento",
            "id_payment_term"   => $id_payment_term,
            "active"    => $active,
            "name"      => $name
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
