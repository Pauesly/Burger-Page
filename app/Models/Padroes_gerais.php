<?php

namespace App\Models;

use Core\Session;
use Core\Redirect;

use Core\WS_read;
use Core\WS_read_free;
use Core\WS_update;
use Core\WS_write;
use Core\WS_write_free;




class Padroes_gerais 
{
    //Data e hora Atual no servidor
    public static function data_e_hora(){
        $data_tz_brasil = date_create('-3 hour')->format('Y-m-d H:i:s');
        return  $data_tz_brasil;
    }
    
    
    
    
    public static function ulr() {
        return "localhost:7777";
    }
    
    
    
    
    
    
    
    
    
    
}

    
