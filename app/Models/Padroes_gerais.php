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
    
    
    //Data e hora Atual no servidor
    public static function Hoje(){
        $data_tz_brasil = date_create('-3 hour')->format('d-m-Y H:i:s');
        return  $data_tz_brasil;
    }
    
    
    
    public static function ulr() {
        return "https://jazzgrill.com.br";
//        return "http://localhost:7777";
    }
    
    
    
    public static function ConverteDataUS_BR($data) {
        $data = str_replace("/", "-", $data);
//        $data = $data . " 00:00:00 ";
        return  date('d-m-Y', strtotime($data));
    }
    
    public static function ConverteDataBR_US($data) {
        $data = str_replace("/", "-", $data);
//        $data = $data . " 00:00:00 ";
        return  date('Y-m-d', strtotime($data));
    }
    
    
    public static function ConverteDataHoraBR_US($data) {
        $data = str_replace("/", "-", $data);
        return  date('Y-m-d H:i:s', strtotime($data));
    }
    
    public static function ConverteDataHoraUS_BR($data) {
        $data = str_replace("/", "-", $data);
        return  date('d-m-Y H:i:s', strtotime($data));
    }
    
    
    
    
    
    public static function ValorDoisDigitos($valor) {
        return number_format($valor, 2, '.', '');
    }
    
    
    
    
    
}

    
