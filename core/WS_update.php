<?php    
 
namespace Core;

use App\Models\Bcrypt;

require_once __DIR__ . "/WS_config.php";
require_once __DIR__ . "/WS_connection.php";
require_once __DIR__ . "/WS_database.php";
 

class WS_update
{
   
    public static function alterar_dados($data)
    {
        $status = array();
        $status['erro'] = true;
        
        $case = $data['funcao'];

        switch ($case):

            
//------------------------------------------------------------------------------            
             /**
             * CSalva Cookie de Adm com ID
             * Recebe ID e Cookie
             * Retorna sucesso com ID ou erro
             */
            case "salva_cookie_adm":
                
                $id_adm         = $data['id_adm'];
                $token_login_web = $data['token_login_web'];
	    
	        $array = array(
                    "token_login_web" => $token_login_web,
                );

                $result = BDUpdate('Adm', $array, "id_adm LIKE '$id_adm'", true);
                
                return $result;
            break;
//------------------------------------------------------------------------------            
            /**
             * Altera Dados do cadastro do cliente
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_editar_cliente":
                
                $id_customer        = $data['id_customer'];
	    
	        $array = array(
                    "phone_number_1"    => $data['phone_number_1'],
                    "phone_number_2"    => $data['phone_number_2'],
                    "name"              => $data['name'],
                    "cpf"               => $data['cpf'],
                    "obs"               => $data['obs'],
                    "active"            => $data['active']
                );

                $result = BDUpdate('Customer', $array, "id_customer LIKE '$id_customer'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------    
            /**
             * Altera Dados do cadastro de endereco
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "atualiza_endereco":
                
                $id_address       = $data['id_address'];
	    
	        $array = array(
                    "local"                 => $data['local'],
                    "cep"                   => $data['cep'],
                    "rua"                   => $data['rua'],
                    "numero_complemento"    => $data['numero_complemento'],
                    "bairro"                => $data['bairro'],
                    "cidade"                => $data['cidade'],
                    "estado"                => $data['estado'],
                    "referencia"            => $data['referencia'],
                    "obs"                   => $data['obs']
                );

                $result = BDUpdate('Address', $array, "id_address LIKE '$id_address'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------    
             /**
             * Altera Dados do cadastro do Item
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "altera_item":
                
                $id_item      = $data['id_item'];
	    
	        $array = array(
                    "active"            => $data['active'],
                    "name"              => $data['name'],
                    "description"       => $data['description'],
                    "un"                => $data['un'],
                    "cost"              => $data['cost'],
                    "picture"           => $data['picture']
                );

                $result = BDUpdate('Item', $array, "id_item LIKE '$id_item'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------    
            /**
             * Altera Dados do cadastro do Item
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "altera_categoria":
                
                $id_category      = $data['id_category'];
	    
	        $array = array(
                    "active"            => $data['active'],
                    "description"       => $data['description'],
                    "sequence"          => $data['sequence']
                );

                $result = BDUpdate('Category', $array, "id_category LIKE '$id_category'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------  
            /**
             * Altera Dados do cadastro do Produto
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_edit_produto":
                
                $id_product      = $data['id_product'];
	    
	        $array = array(
                    "fk_id_category"    => $data['fk_id_category'],
                    "name"              => $data['name'],
                    "description"       => $data['description'],
                    "star"              => $data['star'],
                    "picture_thumb"     => $data['picture_thumb'],
                    "active"            => $data['active'],
                    "price_new"         => $data['preco_new'],
                    "price_old"         => $data['preco_old']
                );

                $result = BDUpdate('Product', $array, "id_product LIKE '$id_product'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------    
            /**
             * Altera Dados do cadastro do Status
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "altera_status":
                
                $id_status      = $data['id_status'];
	    
	        $array = array(
                    "active"             => $data['active'],
                    "status"             => $data['name'],
                    "sequence"           => $data['sequence'],
                    "color_code"           => $data['color_code']
                );

                $result = BDUpdate('Status', $array, "id_status LIKE '$id_status'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------   
            /**
             * Altera Dados do cadastro do Status
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "altera_forma_pagamento":
                
                $id_payment_term      = $data['id_payment_term'];
	    
	        $array = array(
                    "active"             => $data['active'],
                    "name"             => $data['name']
                );

                $result = BDUpdate('PaymentTerm', $array, "id_payment_term LIKE '$id_payment_term'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------   
            /**
             * Altera Dados do cadastro do Status
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "altera_testemunho":
                
                $id_status      = $data['id_testimony'];
	    
	        $array = array(
                    "active"            => $data['active'],
                    "name"              => $data['name'],
                    "testimony"         => $data['testimony'],
                    "status"            => $data['status'],
                    "thumb"             => $data['thumb']
                );

                $result = BDUpdate('Testimony', $array, "id_testimony LIKE '$id_status'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
            /**
             * Altera Condicao de pagamento Pedido
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_pagamento_pedido":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "payment_status"            => $data['payment_status']
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
        /**
             * Altera Status Delivery
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_delivery_status":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "schedule_delivery"            => $data['schedule_delivery']
                );
                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                if($data['schedule_delivery'] == 0){
                    $array2 = array(
                        "to_deliver_in"            => $data['created_at']
                    );
                    BDUpdate('Orders', $array2, "id_order LIKE '$id_order'", true);
                }
                
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
        /**
             * Altera Condicao de pagamento Pedido
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_data_hora_delivery":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "to_deliver_in"            => $data['to_deliver_in']
                );
                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
            /**
             * Altera OBS Pedido
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_obs_pedido":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "obs"            => $data['obs']
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
        /**
             * Altera FRETE Pedido
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_frete_pedido":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "shipping_fee"            => $data['shipping_fee']
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
            /**
             * Altera Forma PAgamento
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_forma_pagamento":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "fk_id_payment_term"            => $data['fk_id_payment_term']
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
            /**
             * Altera Forma PAgamento
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "salva_status_pedido":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "fk_id_status"            => $data['fk_id_status']
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------
            /**
             * Cancela Pedido
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "apagar_pedido":
                
                $id_order      = $data['id_pedido'];
	    
	        $array = array(
                    "active"            => 0
                );

                $result = BDUpdate('Orders', $array, "id_order LIKE '$id_order'", true);
                
                return $result;
                
            break;
//------------------------------------------------------------------------------
            
            
            
            
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
            
            
            
            
            
            
        
        
        
        
        
        
        
        
            
            
            
            
            
            
            
            
            
        
        
        
        
        
        
        
        
        //------------------------------------------------------------------------------   
            /**
             * DELETA ITEM PEDIDO
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "remove_item_produto":
                
                $id      = $data['id_item_product'];
	    
                $result = DBDelete('ItemProduct', "id_item_product LIKE $id");
                
                return $result;
                
            break;
//------------------------------------------------------------------------------ 
            /**
             * DELETA PRODUTO DO PEDIDO
             * Recebe dados
             * Retorna sucesso com ID ou erro
             */
            case "remove_produto_pedido":
                
                $id      = $data['id_produto_order'];
	    
                $result = DBDelete('ProductOrder', "id_product_order LIKE $id");
                
                return $result;
                
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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

