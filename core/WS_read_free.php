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
             * Seleciona um unico usuario com base no email.
             * Recebe email para buscar
             * Retorna todos os dados do USer
             */
            case "valida_cadastro_user":
                
                $fields_to_return = "id_user, nome";
                
                $email = $data['email'];
                $result = DBRead('User', "WHERE email LIKE '$email' limit 1", $fields_to_return);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------
            /**
             * Seleciona um unico usuario com base no email.
             * Recebe email para buscar
             * Retorna id_user, password, email
             */
            case "login_user_com_email":
                $campos = "id_user, password, email";
                $email = $data['email'];
                $result = DBRead('User', "WHERE email LIKE '$email' limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;

//------------------------------------------------------------------------------
            /**
             * Busca a relacao de todos os artigos no sistema
             * Retorna lista
             */
            case "relacao_artigos_view":

                $campos = "id_artigo, id_nome, titulo, descricao, imagem";

                $result = DBRead('Artigo', "WHERE ativo LIKE 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------
            /**
             * Busca Artigo em espefico para visualizacao
             * Retorna lista
             */
            case "busca_artigo":

                $id = $data['id_nome'];
                $result = DBRead('Artigo', "WHERE id_nome LIKE '$id'");
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

    
