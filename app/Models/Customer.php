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




class Customer 
{

    
    
    //Busca adm com email para Login
    public static function validar_telefone_unico($telefone) {
        //Dados obrigatorios
        $array = [
            "funcao" => "validar_telefone_unico",
            "telefone" => $telefone,
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    //Busca adm com email para Login
    public static function validar_telefone_unico_de_customer($telefone, $id) {
        //Dados obrigatorios
        $array = [
            "funcao" => "validar_telefone_unico_de_customer",
            "telefone" => $telefone,
            "id_customer" => $id,
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    //Busca adm com email para Login
    public static function cadastrar_novo_cliente(
            $phone_1,
            $phone_2,
            $nome,
            $cpf,
            $obs,
            $address_tipo1,
            $address_cep1,
            $address_rua1,
            $address_numero1,
            $address_bairro1,
            $address_cidade1,
            $address_estado1,
            $address_referencia1,
            $address_obs1,
            $address_tipo2,
            $address_cep2,
            $address_rua2,
            $address_numero2,
            $address_bairro2,
            $address_cidade2,
            $address_estado2,
            $address_referencia2,
            $address_obs2
            ) {
        
                
        //Dados obrigatorios
        $array = [
            "funcao" => "cadastrar_novo_cliente",
            "phone_number_1" => $phone_1,
            "phone_number_2" => $phone_2,
            "name" => $nome,
            "cpf" => $cpf,
            "obs" => $obs,
            "active" => 1,
            "created_at" => Padroes_gerais::data_e_hora(),
        ];

        $resultado = WS_write::white($array);
        $save_cli = json_decode($resultado);
        
        if($save_cli->erro){
            return $save_cli;
        }else{
            
            //Dados Endereco 1
            $array = [
                "funcao" => "cadastra_novo_endereco",
                "fk_id_customer"    => $save_cli->id_cadastro,
                "local"             => $address_tipo1,
                "cep"               => $address_cep1,
                "rua"               => $address_rua1,
                "numero_complemento"=> $address_numero1,
                "bairro"            => $address_bairro1,
                "cidade"            => $address_cidade1,
                "estado"            => $address_estado1,
                "referencia"        => $address_referencia1,
                "obs"               => $address_obs1,
                "active"            => 1,
            ];
            $resultado1 = WS_write::white($array);
            $rest1 = json_decode($resultado1);
            
            
            if(strlen($address_cep2) > 5){
                //Dados Endereco 2
                $array = [
                    "funcao" => "cadastra_novo_endereco",
                    "fk_id_customer"    => $save_cli->id_cadastro,
                    "local"             => $address_tipo2,
                    "cep"               => $address_cep2,
                    "rua"               => $address_rua2,
                    "numero_complemento"=> $address_numero2,
                    "bairro"            => $address_bairro2,
                    "cidade"            => $address_cidade2,
                    "estado"            => $address_estado2,
                    "referencia"        => $address_referencia2,
                    "obs"               => $address_obs2,
                    "active"            => 1,
                ];
                $resultado2 = WS_write::white($array);
                $rest2 = json_decode($resultado2);
            }else{
                //Dados Endereco 1
                $array = ["erro" => "false"];
                $rest2 = json_decode($array);
            }
            
            
            if(($rest1->erro == false) && ($rest2->erro == false)){
                $array = [
                    "erro" => "false",
                    "id_cadastro" => $save_cli->id_cadastro
                    ];
                return json_decode($array);
            }else{
                $array = ["erro" => "true" ];
                return json_decode($array);
            }
        }
    }
 
    
    
    //Relatorio de Usuarios do sistema
    public static function adm_relatorio_all_customers() {
        //Dados obrigatorios
         $array = [
            "funcao"                => "adm_relatorio_all_customers",
        ];
        
        $resultado = WS_read::ler_dados($array);
        
        return  json_decode($resultado);
    }

    
    
    //Dados de cliente especifico
    public static function full_data_customer_com_id($id_customer) {
        //Dados obrigatorios
         $array = [
            "funcao"                => "full_data_customer_com_id",
            "id_customer"           => $id_customer
        ];
        
        $resultado = WS_read::ler_dados($array);
        
        return  json_decode($resultado);
    }
    
    
    
    //Busca adm com email para Login
    public static function salva_editar_cliente(
            $id_customer,
            $active,
            $phone_1,
            $phone_2,
            $nome,
            $cpf,
            $obs,
            $id_dress_1,
            $address_tipo1,
            $address_cep1,
            $address_rua1,
            $address_numero1,
            $address_bairro1,
            $address_cidade1,
            $address_estado1,
            $address_referencia1,
            $address_obs1,
            $id_dress_2,
            $address_tipo2,
            $address_cep2,
            $address_rua2,
            $address_numero2,
            $address_bairro2,
            $address_cidade2,
            $address_estado2,
            $address_referencia2,
            $address_obs2
            ) {
        
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_editar_cliente",
            "id_customer"       => $id_customer,
            "phone_number_1"    => $phone_1,
            "phone_number_2"    => $phone_2,
            "name"              => $nome,
            "cpf"               => $cpf,
            "obs"               => $obs,
            "active"            => $active
        ];

        $resultado = WS_update::alterar_dados($array);
        $save_cli = json_decode($resultado);
        

        //Dados Endereco 1
        $array = [
            "funcao" => "atualiza_endereco",
            "id_address"        => $id_dress_1,
            "local"             => $address_tipo1,
            "cep"               => $address_cep1,
            "rua"               => $address_rua1,
            "numero_complemento"=> $address_numero1,
            "bairro"            => $address_bairro1,
            "cidade"            => $address_cidade1,
            "estado"            => $address_estado1,
            "referencia"        => $address_referencia1,
            "obs"               => $address_obs1
        ];
        $rest1 = WS_update::alterar_dados($array);


        //Dados Endereco 2
        $array = [
            "funcao" => "atualiza_endereco",
            "id_address"        => $id_dress_2,
            "local"             => $address_tipo2,
            "cep"               => $address_cep2,
            "rua"               => $address_rua2,
            "numero_complemento"=> $address_numero2,
            "bairro"            => $address_bairro2,
            "cidade"            => $address_cidade2,
            "estado"            => $address_estado2,
            "referencia"        => $address_referencia2,
            "obs"               => $address_obs2
        ];
        $rest2 = WS_update::alterar_dados($array);

        return 0;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
