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




class PaymentTerm 
{


    //Busca adm com email para Login
    public static function busca_formas_de_pagamento() {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_formas_de_pagamento"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    

    //Busca adm com email para Login
    public static function busca_pagamentos_to_select() {
        //Dados obrigatorios
        $array = [
            "funcao"            => "busca_pagamentos_to_select"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
