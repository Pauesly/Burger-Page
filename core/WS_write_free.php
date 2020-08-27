<?php

namespace Core;

require_once __DIR__ . "/WS_config.php";
require_once __DIR__ . "/WS_connection.php";
require_once __DIR__ . "/WS_database.php";

class WS_write_free 
{

    
    public static function white_free($data){
        
        $status = array();
        $status['erro'] = true;
        
        $func = $data['funcao'];
        
        switch ($func):

//------------------------------------------------------------------------------
            /**
             * Cadastra um novo Usuario
             * Recebe dados e faz o input no banco
             * Retorna sucesso com ID ou erro
             */
            case "cadastra_new_user_site":
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['email']                 = $data['email'];
                $dados['token']                 = 0;
                $dados['foto_perfil']           = $data['foto_perfil'];
                $dados['questao_repetida']      = 1;
                $dados['tamanho_fonte_web']     = "medium";
                $dados['tamanho_fonte_android'] = 0;
                $dados['tamanho_fonte_ios']     = 0;
                $dados['ativo']                 = 1;
                $dados['password']              = $data['password'];
                $dados['created_at']            = data_e_hora();

                if($status['id_cadastro'] = DBCreate('User', $dados, true)){
                    $status['erro'] = false;
                }    
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva dados de um possivel novo ADM
             * Recebe nome, email e telefone
             * Retorna confirmacao de cadastro
             */
            case "registra_novo_adm":
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['telefone']              = $data['telefone'];
                $dados['email']                 = $data['email'];
                $dados['concluido']             = 0;
                
                if($status['id_cadastro'] = DBCreate('ContatoAdm', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva registro de login de Adm
             * Recebe id
             * Retorna confirmacao de cadastro
             */
            case "adm_registra_login":
                
                $dados = array();
                $dados['fk_id_adm']          = $data['fk_id_adm'];
                $dados['created_at']         = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('LoginAdm', $dados, true)){
                    $status['erro'] = false;
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

        // RETORNA JSON JUNTO COM RESULTADO
        return json_encode($status);
    }    
        

    
    
}

    
