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

    //Busca adm com email para Login
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
    
    
    
    
    
    
    
    
    
    
    

    
    

    
    

    
    
    
    
}

    
