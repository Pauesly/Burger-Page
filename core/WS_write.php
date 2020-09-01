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
             * Salva dados Cliente
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastrar_novo_cliente":
                
                $dados = array();
                $dados['phone_number_1']    = $data['phone_number_1'];
                $dados['phone_number_2']    = $data['phone_number_2'];
                $dados['name']              = $data['name'];
                $dados['cpf']               = $data['cpf'];
                $dados['obs']               = $data['obs'];
                $dados['active']            = $data['active'];
                $dados['created_at']        = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Customer', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Salva dados ARTIGO
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_novo_endereco":
                
                
                $dados = array();
                $dados['fk_id_customer']        = $data['fk_id_customer'];
                $dados['local']                 = $data['local'];
                $dados['cep']                   = $data['cep'];
                $dados['rua']                   = $data['rua'];
                $dados['numero_complemento']    = $data['numero_complemento'];
                $dados['bairro']                = $data['bairro'];
                $dados['cidade']                = $data['cidade'];
                $dados['estado']                = $data['estado'];
                $dados['referencia']            = $data['referencia'];
                $dados['obs']                   = $data['obs'];
                $dados['active']                = $data['active'];
                
                if($status['id_cadastro'] = DBCreate('Address', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Item
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_novo_item":
                
                $dados = array();
                $dados['name']          = $data['name'];
                $dados['description']   = $data['description'];
                $dados['un']            = $data['un'];
                $dados['cost']          = $data['cost'];
                $dados['picture']       = $data['picture'];
                $dados['active']        = $data['active'];
                $dados['created_at']    = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Item', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Categoria
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_nova_categoria":
                
                $dados = array();
                $dados['description']   = $data['description'];
                $dados['active']        = $data['active'];
                $dados['created_at']    = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Category', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
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

    
