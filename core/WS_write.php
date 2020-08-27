<?php

namespace Core;

require_once __DIR__ . "/WS_config.php";
require_once __DIR__ . "/WS_connection.php";
require_once __DIR__ . "/WS_database.php";

class WS_write
{

    
    public static function white($data){
        
        $status = array();
        $status['erro'] = true;
        
        $func = $data['funcao'];
        
        switch ($func):

//------------------------------------------------------------------------------
            /**
             * Salva dados QFAC
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salvar_nova_qfac":
                
                $dados = array();
                $dados['fk_id_adm']             = $data['fk_id_adm'];
                $dados['fk_id_faculdade']       = $data['fk_id_faculdade'];
                $dados['fk_id_curso']           = $data['fk_id_curso']  ;
                $dados['fk_id_disciplina_fac']  = $data['fk_id_disciplina_fac'];
                $dados['ano']                   = $data['ano'] ;
                $dados['enunciado']             = $data['enunciado'];
                $dados['resposta1']             = $data['resposta1'] ;
                $dados['resposta1check']        = $data['resposta1check'] == 'true' ? 1 : 0;
                $dados['resposta2']             = $data['resposta2'];
                $dados['resposta2check']        = $data['resposta2check'] == 'true' ? 1 : 0;
                $dados['resposta3']             = $data['resposta3'];
                $dados['resposta3check']        = $data['resposta3check'] == 'true' ? 1 : 0;
                $dados['resposta4']             = $data['resposta4'];
                $dados['resposta4check']        = $data['resposta4check'] == 'true' ? 1 : 0;
                $dados['resposta5']             = $data['resposta5'];
                $dados['resposta5check']        = $data['resposta5check'] == 'true' ? 1 : 0;
                $dados['comentario']            = $data['comentario'];
                $dados['imagem']                = $data['imagem'];
                $dados['ativa']                 = $data['ativa'];
                $dados['created_at']            = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Qfac', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva dados ARTIGO
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salvar_novo_artigo":
                
                $dados = array();
                $dados['fk_id_adm']          = $data['fk_id_adm'];
                $dados['id_nome']            = $data['id_nome'];
                $dados['titulo']             = $data['titulo'];
                $dados['descricao']          = $data['descricao'];
                $dados['imagem']             = $data['imagem'];
                $dados['created_at']         = $data['created_at'];
                $dados['ativo']              = $data['ativo'];
                
                if($status['id_cadastro'] = DBCreate('Artigo', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Pagamento ADM
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_pagamento_qce_adm":
                
                $dados = array();
                $dados['fk_id_adm']       = $data['fk_id_adm'];
                $dados['qtd_pago']        = $data['qtd_pago'];
                $dados['valor_pago']      = $data['valor_pago'];
                $dados['created_at']      = $data['created_at'];
                $dados['obs']             = $data['obs'];
                
                if($status['id_cadastro'] = DBCreate('QcePago', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Pagamento ADM
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_pagamento_qme_adm":
                
                $dados = array();
                $dados['fk_id_adm']       = $data['fk_id_adm'];
                $dados['qtd_pago']        = $data['qtd_pago'];
                $dados['valor_pago']      = $data['valor_pago'];
                $dados['created_at']      = $data['created_at'];
                $dados['obs']             = $data['obs'];
                
                if($status['id_cadastro'] = DBCreate('Qme5Pago', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
             /**
             * Salva Pagamento ADM
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_pagamento_qfac_adm":
                
                $dados = array();
                $dados['fk_id_adm']       = $data['fk_id_adm'];
                $dados['qtd_pago']        = $data['qtd_pago'];
                $dados['valor_pago']      = $data['valor_pago'];
                $dados['created_at']      = $data['created_at'];
                $dados['obs']             = $data['obs'];
                
                if($status['id_cadastro'] = DBCreate('QfacPago', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Nova Banca
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_nova_banca":
                
                $dados = array();
                $dados['id_banca']    = $data['id_banca'];
                $dados['nome']        = $data['nome'];
                $dados['ativo']       = $data['ativo'];
                $dados['created_at']  = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Banca', $dados, false)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Nova faculdade
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_nova_faculdade":
                
                $dados = array();
                $dados['nome']        = $data['nome'];
                $dados['ativo']       = $data['ativo'];
                $dados['created_at']  = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Faculdade', $dados, false)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Novo curso
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_novo_curso":
                
                $dados = array();
                $dados['nome']        = $data['nome'];
                $dados['ativo']       = $data['ativo'];
                $dados['created_at']  = $data['created_at'];
                $dados['fk_id_faculdade']  = $data['fk_id_faculdade'];
                
                if($status['id_cadastro'] = DBCreate('Curso', $dados, false)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva Nova disciplina
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salva_nova_disciplina":
                
                $dados = array();
                $dados['nome']        = $data['nome'];
                $dados['ativo']       = $data['ativo'];
                $dados['created_at']  = $data['created_at'];
                $dados['fk_id_faculdade']  = $data['fk_id_faculdade'];
                $dados['fk_id_curso']  = $data['fk_id_curso'];
                
                if($status['id_cadastro'] = DBCreate('DisciplinaFac', $dados, false)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------           
            /**
             * Salva Novo Administrador
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_novo_adm":
                
                $dados = array();
                $dados['perfil_master']         = $data['perfil_master'];
                $dados['email']                 = $data['email'];
                $dados['nome']                  = $data['nome'];
                $dados['telefone']              = $data['telefone'];
                $dados['observacoes']           = $data['observacoes'];
                $dados['observacoes_internas']  = $data['observacoes_internas'];
                $dados['password']              = $data['password'];
                $dados['ativo']                 = $data['ativo'];
                $dados['created_at']            = $data['created_at'];
                $dados['foto_perfil']           = $data['foto_perfil'];
                
                if($status['id_cadastro'] = DBCreate('Adm', $dados, false)){
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

    
