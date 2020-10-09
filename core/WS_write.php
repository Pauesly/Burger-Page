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
                $dados['sequence']      = $data['sequence'];
                $dados['active']        = $data['active'];
                $dados['created_at']    = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Category', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Produto
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_novo_produto":
                
                $dados = array();
                $dados['fk_id_category']= $data['fk_id_category'];
                $dados['name']          = $data['name'];
                $dados['description']   = $data['description'];
                $dados['picture_thumb'] = $data['picture_thumb'];
                $dados['picture_large'] = $data['picture_large'];
                $dados['star']          = $data['star'];
                $dados['price_new']     = $data['price_new'];
                $dados['price_old']     = $data['price_old'];
                $dados['active']        = $data['active'];
                $dados['created_at']    = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Product', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Status
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_novo_status":
                
                $dados = array();
                $dados['status']        = $data['status'];
                $dados['sequence']      = $data['sequence'];
                $dados['color_code']      = $data['color_code'];
                $dados['active']        = $data['active'];
                
                if($status['id_cadastro'] = DBCreate('Status', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Status
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastra_nova_forma_pagamento":
                
                $dados = array();
                $dados['name']        = $data['name'];
                $dados['active']        = $data['active'];
                
                if($status['id_cadastro'] = DBCreate('PaymentTerm', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Status
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "cadastrar_novo_testemunho":
                
                $dados = array();
                $dados['name']          = $data['name'];
                $dados['testimony']     = $data['testimony'];
                $dados['status']        = $data['status'];
                $dados['thumb']         = $data['thumb'];
                $dados['created_at']    = $data['created_at'];
                $dados['active']        = $data['active'];
                
                if($status['id_cadastro'] = DBCreate('Testimony', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Item X produto
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "add_item_produto":
                
                $dados = array();
                $dados['fk_id_product']  = $data['fk_id_product'];
                $dados['fk_id_item']     = $data['fk_id_item'];
                
                if($status['id_cadastro'] = DBCreate('ItemProduct', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Novo pedido
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "abrir_pedido":
                
                $dados = array();
                $dados['fk_id_adm']         = $data['fk_id_adm'];
                $dados['fk_id_customer']    = $data['fk_id_customer'];
                $dados['fk_id_address']     = $data['fk_id_address'];
                $dados['payment_status']    = $data['payment_status'];
                $dados['fk_id_payment_term']= $data['fk_id_payment_term'];
                $dados['schedule_delivery'] = $data['schedule_delivery'];
                $dados['to_deliver_in']     = $data['to_deliver_in'];
                $dados['fk_id_status']      = $data['fk_id_status'];
                $dados['created_at']        = $data['created_at'];
                $dados['active']            = $data['active'];
                
                if($status['id_cadastro'] = DBCreate('Orders', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cadastra Novo pedido
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "salvar_novo_adm":
                
                $dados = array();
                $dados['name']          = $data['name'];
                $dados['email']         = $data['email'];
                $dados['obs']           = $data['obs'];
                $dados['password']      = $data['password'];
                $dados['active']        = $data['active'];
                $dados['created_at']    = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('Adm', $dados, true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
 //------------------------------------------------------------------------------   
            /**
             * Salva Novo Status de Pedido
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "altera_status_pedido":
                
                $dados = array();
                $dados['fk_id_adm']         = $data['fk_id_adm'];
                $dados['fk_id_order']       = $data['fk_id_order'];
                $dados['fk_id_status']      = $data['fk_id_status'];
                $dados['created_at']        = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('OrderStatus', $dados, false)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------  
            /**
             * Salva Novo Produto no pedido
             * Recebe Todos os dados relevantes
             * Retorna confirmacao de cadastro
             */
            case "add_produto_pedido":
                
                $dados = array();
                $dados['fk_id_order']       = $data['fk_id_order'];
                $dados['fk_id_product']     = $data['fk_id_product'];
                $dados['qtd']               = $data['qtd'];
                $dados['price_unit']        = $data['price_unit'];
                $dados['price_total']       = $data['price_total'];
                $dados['obs']               = $data['obs'];
                $dados['created_at']        = $data['created_at'];
                
                if($status['id_cadastro'] = DBCreate('ProductOrder', $dados, false)){
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

    
