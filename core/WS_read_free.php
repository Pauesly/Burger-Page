<?php

namespace Core;

require_once __DIR__ . "/WS_config.php";
require_once __DIR__ . "/WS_connection.php";
require_once __DIR__ . "/WS_database.php";

class WS_read_free 
{

    
    public static function read_free($data){
        
        $status = array();
        $status['erro'] = true;
        
        $func = $data['funcao'];
        
        switch ($func):

            
//------------------------------------------------------------------------------
            /**
             * Seleciona um unico Adm com base no email.
             * Recebe email para buscar
             * Retorna id_user, password, email
             */
            case "login_adm_com_email":
                $campos = "id_adm, password, email, active";
                $email = $data['email'];
                
                $result = DBRead('Adm', "WHERE email LIKE '$email' limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------
            /**
             * Busca dados completos para cardapio no site
             * Recebe email para buscar
             * Retorna todos os dados do USer
             */
            case "busca_cardapio_site":
                
                $result = DBRead('Product',
                        
//                        "JOIN Category "
//                            . "ON Category.id_category = Product.fk_id_category"
                    	
			" WHERE Product.active LIKE 1 ORDER BY fk_id_category",
                        
                               "Product.id_product          as id_product, 
                                Product.fk_id_category      as fk_id_category, 
                                Product.name                as name,
                                Product.description         as description, 
                                Product.picture_thumb       as picture_thumb,
                                Product.star                as star,
                                Product.price_old           as price_old,
                                Product.price_new           as price_new"
                        );
                
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------           
            
            
            
            
            
            
            
            
            
            
            
            


//------------------------------------------------------------------------------
            
            /**
             * retorna Erro se funcao solicitaada nao for encontrada
             */
            default:
                $status['erro2'] =  "funcao invalida";
        endswitch;
//------------------------------------------------------------------------------

        // RETORNA JSON JUNTO COM RESULTADO DA BUSCA
        return json_encode($status);
    }    
        

    
    
}

    
