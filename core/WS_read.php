<?php    
 
namespace Core;


require_once __DIR__ . "/WS_config.php";
require_once __DIR__ . "/WS_connection.php";
require_once __DIR__ . "/WS_database.php";
 

class WS_read
{
   
    public static function ler_dados($info)
    {
        $status = array();
        $status['erro'] = true;
        
        $case = $info['funcao'];

        switch ($case):


//------------------------------------------------------------------------------             
            /**
             * Busca todos os dados do ADM com ID
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "full_data_adm_id":
                $id_adm = $info['id_adm'];
                $result = DBRead('Adm', "WHERE id_adm LIKE '$id_adm' limit 1");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Seleciona o Token Login de um ADM especifico
             * Recebe ID do ADM
             * Retorna token do ADM
             */
            case "valida_token_adm_por_id":
                $campos = "token_login_web, id_adm";
                
                $id = $info['id'];
                $result = DBRead('Adm', "WHERE id_adm LIKE '$id' limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;   
//------------------------------------------------------------------------------             
            /**
             * Verifica se telefone ja foi cadastrado
             * Recebe TEL do cliente
             * Retorna true / false
             */
            case "validar_telefone_unico":
                $tel = $info['telefone'];
                
                $result1 = DBRead('Customer', "WHERE phone_number_1 LIKE '$tel' limit 1");
                $result2 = DBRead('Customer', "WHERE phone_number_2 LIKE '$tel' limit 1");
                
                if(($result1 != false) || ($result2 != false)){
                    $status['erro'] = false;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;   
//------------------------------------------------------------------------------  
            /**
             * Verifica se telefone ja foi cadastrado mas considera se eh do cliente atual
             * Recebe TEL do cliente
             * Retorna true / false
             */
            case "validar_telefone_unico_de_customer":
                $tel = $info['telefone'];
                $id  = $info['id_customer'];
                
                $result1 = DBRead('Customer', "WHERE phone_number_1 LIKE '$tel' limit 1");
                $result2 = DBRead('Customer', "WHERE phone_number_2 LIKE '$tel' limit 1");
                
                if(($result1 != false) || ($result2 != false)){
                    if( ($result1[0]['id_customer'] != $id) && ($result2[0]['id_customer'] != $id) ){
                        $status['erro'] = false;
                    }                    
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;   
//------------------------------------------------------------------------------ 
             /**
             * Seleciona alguns dados de todos os clientes
             * 
             * Retorna clientes
             */
            case "adm_relatorio_all_customers":
                
                $campos = "id_customer, phone_number_1, phone_number_2, name, active";
                
                $result = DBRead('Customer', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os dados de um cliente
             * Retorna clientes
             */
            case "full_data_customer_com_id":
                
                $id = $info['id_customer'];
                
                $result = DBRead('Customer', "WHERE id_customer LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                    $status['resultado'][0]['end'] = DBRead('Address', "WHERE fk_id_customer LIKE '$id' ");
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "relatorio_all_itens":
                
                $campos = "id_item, name, cost, active";
                
                $result = DBRead('Item', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "busca_item_com_id":
                
                $id = $info['id_item'];
                
                $result = DBRead('Item', "WHERE id_item LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os Categorias do banco
             * Retorna clientes
             */
            case "relatorio_all_categorias":
                
                $campos = "id_category, description, active, created_at";
                
                $result = DBRead('Category', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os Categorias do banco
             * Retorna clientes
             */
            case "relatorio_all_categorias_ativas":
                
                $campos = "id_category, description";
                
                $result = DBRead('Category', "WHERE active LIKE 1", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os Categorias do banco
             * Retorna clientes
             */
            case "busca_categoria_com_id":
                
                $id = $info['id_category'];
                
                $result = DBRead('Category', "WHERE id_category LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os produtos
             * Retorna clientes
             */
            case "relatorio_all_produtos":
                
                $result = DBRead('Product',
                        
                        "JOIN Category "
                            . "ON Category.id_category = Product.fk_id_category"
                    	
			. "",
                        
                                "Product.id_product as id_product, 
                                Product.name as name, 
                                Product.star as star,
                                Product.price_new as price_new, 
                                Product.active as active,
                                Category.description as category_description");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona produto especifico
             * Retorna clientes
             */
            case "busca_produto_com_id":
                
                $id = $info['id_produto'];
                
                $result = DBRead('Product', "WHERE id_product LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "relatorio_all_status":
                
                $campos = "id_status, status, active, sequence";
                
                $result = DBRead('Status', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "busca_status_com_id":
                
                $id = $info['id_status'];
                
                $result = DBRead('Status', "WHERE id_status LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "relatorio_all_forma_pagamento":
                
                $campos = "id_payment_term, name, active";
                
                $result = DBRead('PaymentTerm', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "busca_forma_pagamento_com_id":
                
                $id = $info['id_status'];
                
                $result = DBRead('PaymentTerm', "WHERE id_payment_term LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "relatorio_all_testemunho":
                
                $campos = "id_testimony, name, testimony, active";
                
                $result = DBRead('Testimony', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os itens do banco
             * Retorna clientes
             */
            case "busca_testemunho_com_id":
                
                $id = $info['id_status'];
                
                $result = DBRead('Testimony', "WHERE id_testimony LIKE '$id' limit 1");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

