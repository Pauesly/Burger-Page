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
             * Seleciona o lista de ADM
             * Retorna token do ADM
             */
            case "gerir_adm":
                $campos = "id_adm, name, email, active";
                
                $result = DBRead('Adm', "", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;   
//------------------------------------------------------------------------------ 
            /**
             * Seleciona o lista de ADM
             * Retorna token do ADM
             */
            case "busca_dados_adm_full":
                
                $id_adm = $info['id_adm'];
                
                $result = DBRead('Adm', "WHERE id_adm LIKE $id_adm");
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
            case "relatorio_all_itens_ativos":
                
                $campos = "id_item, name, cost";
                
                $result = DBRead('Item', "WHERE active LIKE 1", $campos);
                
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
                
                $campos = "id_category, description, sequence, active, created_at";
                
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
             * Seleciona todos os produtos ativos no menu
             * Retorna clientes
             */
            case "relatorio_all_produtos_ativos_menu":
                
                $result = DBRead('Product',
                        
                        "JOIN Category "
                            . "ON Category.id_category = Product.fk_id_category"
                    	
			. " WHERE Product.active LIKE 1 ORDER BY Category.sequence",
                        
                               "Product.id_product          as id_product, 
                                Product.fk_id_category      as fk_id_category, 
                                Product.name                as name,
                                Product.description         as description, 
                                Product.picture_thumb       as picture_thumb,
                                Product.picture_large       as picture_large,
                                Product.star                as star,
                                Product.price_old           as price_old,
                                Product.price_new           as price_new,
                                
                                Category.description        as category_description,
                                Category.sequence           as sequence"
                        );

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os produtos ativos no menu
             * Retorna clientes
             */
            case "relatorio_all_produtos_ativos_menu_no_pic":
                
                $result = DBRead('Product',
                        
                        "JOIN Category "
                            . "ON Category.id_category = Product.fk_id_category"
                    	
			. " WHERE Product.active LIKE 1 ORDER BY Category.sequence",
                        
                               "Product.id_product          as id_product, 
                                Product.fk_id_category      as fk_id_category, 
                                Product.name                as name,
                                Product.description         as description, 
                                Product.picture_thumb       as picture_thumb,
                                Product.star                as star,
                                Product.price_old           as price_old,
                                Product.price_new           as price_new,
                                
                                Category.description        as category_description,
                                Category.sequence           as sequence"
                        );

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
                
                $campos = "id_status, status, active, sequence, color_code";
                
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
             * Seleciona todos os iten de determinado produto
             * Retorna clientes
             */
            case "busca_itens_de_produto":
                
                $id = $info['fk_id_product'];
                
//                $result = DBRead('ItemProduct', "WHERE fk_id_product LIKE '$id'");
        
                $result = DBRead('ItemProduct',
                        
                        "JOIN Item "
                            . "ON Item.id_item = ItemProduct.fk_id_item"
                    	
			. " WHERE fk_id_product LIKE '$id' ORDER BY name_item",
                        
                                "ItemProduct.id_item_product as id_item_product, 
                                ItemProduct.fk_id_product as fk_id_product, 
                                ItemProduct.fk_id_item as fk_id_item,
                                Item.un as un,
                                Item.cost as cost,
                                Item.name as name_item");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Cliente por Telefone
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_cliente_por_telefone":
                
                $phone = $info['phone'];
                
                $result = DBRead('Customer', "WHERE active LIKE 1 AND phone_number_1 LIKE '$phone' OR phone_number_2 LIKE '$phone' ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca endereco de cliente    
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_enderecos_de_cliente":
                
                $id = $info['id'];
                
                $result = DBRead('Address', "WHERE active LIKE 1 AND fk_id_customer LIKE '$id' ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os dados de determinado pedido
             * Retorna clientes
             */
            case "busca_dados_pedido":
                
                $id = $info['id_pedido'];
                
                $result = DBRead('Orders',
                        
                        "JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer"
                       ." JOIN Status "
                            . "ON Status.id_status = Orders.fk_id_status "
                       ." JOIN PaymentTerm "
                            . "ON PaymentTerm.id_payment_term = Orders.fk_id_payment_term "
                        
                    	
			. " WHERE id_order LIKE '$id' ",
                        
                               "Orders.id_order             as id_order, 
                                Orders.fk_id_adm            as fk_id_adm, 
                                Orders.fk_id_customer       as fk_id_customer,
                                Orders.fk_id_address        as fk_id_address,
                                Orders.fk_id_payment_term   as fk_id_payment_term,
                                Orders.fk_id_status         as fk_id_status,
                                Orders.schedule_delivery    as schedule_delivery,
                                Orders.to_deliver_in        as to_deliver_in,
                                Orders.obs                  as obs,
                                Orders.payment_status       as payment_status,
                                Orders.active               as active,
                                Orders.created_at           as created_at,
                                Orders.shipping_fee         as shipping_fee,
                                
                                Customer.name               as name,
                                Customer.phone_number_1     as phone_number_1,
                                Customer.phone_number_2     as phone_number_2,
                                
                                Status.status               as status_nome,
                                
                                PaymentTerm.name            as payment_term
                                ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Produtos do pedido
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_produtos_de_pedido":
                
                $id_pedido = $info['id'];
                
//                $result = DBRead('ProductOrder', "WHERE fk_id_order LIKE '$id_pedido'");
                $result = DBRead('ProductOrder',
                        
                        "JOIN Product "
                            . "ON Product.id_product = ProductOrder.fk_id_product"
                        
			. " WHERE fk_id_order LIKE '$id_pedido' ",
                        
                               "ProductOrder.id_product_order   as id_product_order, 
                                ProductOrder.fk_id_order        as fk_id_order, 
                                ProductOrder.fk_id_product      as fk_id_product,
                                ProductOrder.qtd                as qtd,
                                ProductOrder.price_unit         as price_unit,
                                ProductOrder.price_total        as price_total,
                                ProductOrder.obs                as obs,
                                
                                Product.name                as name,
                                Product.description         as description
                                ");
                

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Endereco de entrega
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_endereco_por_id":
                
                $id_address = $info['id_address'];
                
                $result = DBRead('Address', "WHERE id_address LIKE '$id_address'");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca todas as formas de pagamento
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_formas_de_pagamento":
                
                
                $result = DBRead('PaymentTerm', "WHERE active LIKE '1'");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca status de determinado pedido
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_status_de_pedido":
                
                $id_pedido = $info['id_pedido'];
                
//                $result = DBRead('OrderStatus', "WHERE fkr_id_order LIKE '$id_pedido' ORDER BY created_at");
                
                $result = DBRead('OrderStatus',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = OrderStatus.fk_id_adm "
                       ."JOIN Status "
                            . "ON Status.id_status = OrderStatus.fk_id_status "
                        
			. " WHERE fk_id_order LIKE '$id_pedido' ORDER BY OrderStatus.created_at ",
                        
                               "OrderStatus.id_order_status     as id_order_status, 
                                OrderStatus.fk_id_adm           as fk_id_adm, 
                                OrderStatus.fk_id_order         as fk_id_order,
                                OrderStatus.fk_id_status        as fk_id_status,
                                OrderStatus.created_at          as created_at,
                                
                                Adm.name                    as adm_name,
                                Status.status               as status_name
                                ");
                
                
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido com varios filtros
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_pedido_nome_tel_data":
                
                $fk_id_customer = $info['fk_id_customer'];
                $created_at_ini = $info['created_at_ini'];
                $created_at_fim = $info['created_at_fim'];
                
                $result = DBRead('Orders',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Orders.fk_id_adm "
                       ."JOIN Status "
                            . "ON Status.id_status = Orders.fk_id_status " 
                       ."JOIN PaymentTerm "
                            . "ON PaymentTerm.id_payment_term = Orders.fk_id_payment_term " 
                       ."JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer " .
                        
			 " WHERE $fk_id_customer $created_at_ini $created_at_fim ORDER BY fk_id_status ",
                        
                               "Orders.id_order             as id_order, 
                                Orders.fk_id_adm            as fk_id_adm,
                                Orders.fk_id_customer       as fk_id_customer,
                                Orders.fk_id_payment_term   as fk_id_payment_term,
                                Orders.fk_id_status         as fk_id_status,
                                Orders.payment_status       as payment_status,
                                Orders.created_at           as created_at,
                                
                                Status.status               as status_name,
                                
                                PaymentTerm.name            as payment_term_name,
                                
                                Customer.name               as customer_name
                               ");
                
                
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os clientes com nome ou trecho de nome
             * Retorna clientes
             */
            case "busca_cliente_nome_parcial":
                
                $campos = "id_customer, name";
                
                $id = $info['name'];
                
                $result = DBRead('Customer', "WHERE name LIKE '%$id%'", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Cliente por Telefone Parcial
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "busca_cliente_por_telefone_parcial":
                
                $campos = "id_customer, name";
                
                $phone = $info['phone'];
                
                $result = DBRead('Customer', "WHERE active LIKE 1 AND phone_number_1 LIKE '%$phone%' OR phone_number_2 LIKE '%$phone%' ", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Soma Valor por pedido
             * Retorna clientes
             */
            case "busca_total_pedido":
                
                $id = $info['fk_id_order'];
                
                $result = DBRead('ProductOrder', "WHERE fk_id_order LIKE '$id'", "SUM(price_total) AS total");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido com varios filtros
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "carregar_gestao_a_vista":
                
                $data_get = $info['data_get'];
                
                $result = DBRead('Orders',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Orders.fk_id_adm "
                       ."JOIN Status "
                            . "ON Status.id_status = Orders.fk_id_status " 
                       ."JOIN PaymentTerm "
                            . "ON PaymentTerm.id_payment_term = Orders.fk_id_payment_term " 
                       ."JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer " .
                        
			 " WHERE to_deliver_in BETWEEN '$data_get 00:00:00' AND '$data_get 23:59:59' ORDER BY fk_id_status ",
                        
                               "Orders.id_order             as id_order, 
                                Orders.fk_id_adm            as fk_id_adm,
                                Orders.fk_id_customer       as fk_id_customer,
                                Orders.fk_id_payment_term   as fk_id_payment_term,
                                Orders.fk_id_status         as fk_id_status,
                                Orders.payment_status       as payment_status,
                                Orders.created_at           as created_at,
                                
                                Status.status               as status_name,
                                Status.color_code           as color_code,
                                
                                PaymentTerm.name            as payment_term_name,
                                
                                Customer.name               as customer_name
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * S
             * Retorna clientes
             */
            case "busca_clientes_to_select":
                
                $campos = "id_customer, name";
                
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
             * S
             * Retorna clientes
             */
            case "busca_produtos_to_select":
                
                $campos = "id_product, name";
                
                $result = DBRead('Product', "", $campos);
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * S
             * Retorna 
             */
            case "busca_categorias_to_select":
                
                $campos = "id_category, description";
                
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
             * S
             * Retorna 
             */
            case "busca_municipios_to_select":
                
                $campos = "id_category, description";
                
                $result = DBRead('Address', " GROUP BY bairo ", "bairro AS bairo, COUNT(*) AS qtd");
             
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * S
             * Retorna 
             */
            case "busca_cidades_to_select":
                
                $result = DBRead('Address', " GROUP BY cidade ", "cidade AS cidade, COUNT(*) AS qtd");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * S
             * Retorna 
             */
            case "busca_pagamentos_to_select":
                
                $campos = "id_payment_term, name";
                
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
             * Busca Pedido p/Relatorio FULL
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_full":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                
                $result = DBRead('Orders',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Orders.fk_id_adm "
                       ."JOIN Status "
                            . "ON Status.id_status = Orders.fk_id_status " 
                       ."JOIN PaymentTerm "
                            . "ON PaymentTerm.id_payment_term = Orders.fk_id_payment_term " 
                       ."JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer " .
                        
			 " WHERE to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' ORDER BY Orders.created_at ",
                        
                               "Orders.id_order             as id_order, 
                                Orders.fk_id_adm            as fk_id_adm,
                                Orders.fk_id_customer       as fk_id_customer,
                                Orders.fk_id_payment_term   as fk_id_payment_term,
                                Orders.fk_id_status         as fk_id_status,
                                Orders.payment_status       as payment_status,
                                Orders.created_at           as created_at,
                                
                                Status.status               as status_name,
                                Status.color_code           as color_code,
                                
                                PaymentTerm.name            as payment_term_name,
                                
                                Customer.name               as customer_name
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cliente_vezes
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cliente_vezes":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                 
                $result = DBRead('Orders',
                        
                        "JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer " .
                        
			 " WHERE Orders.active LIKE 1 AND to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY fk_id_customer ORDER BY qtd desc",
                        
                               "Orders.id_order             as id_order,
                                Customer.name               as customer_name,
                                fk_id_customer              as fk_id_customer, 
                                COUNT(*) AS qtd
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cliente_valor
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cliente_valor":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                
//                 $result = DBRead('Address', " GROUP BY cidade ", "cidade AS cidade, COUNT(*) AS qtd");
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        
			 " WHERE o.active LIKE 1 AND  o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY cli.name ORDER BY valor desc",
                        
                               "cli.name AS cliente,
                                cli.id_customer AS id_cliente,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Soma Valor por pedido
             * Retorna clientes
             */
            case "busca_pedidos_cliente":
                
                $id = $info['id_customer'];
                
                $result = DBRead('Order', "WHERE fk_id_order LIKE '$id'", "SUM(price_total) AS total");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_vendas_custo
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_vendas_custo":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        
			 " WHERE o.active LIKE 1 AND  o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY po.fk_id_product ORDER BY valor desc",
                        
                               "po.fk_id_product AS id_product,
                                prod.name   AS nome_prod,
                                SUM(po.price_total) AS valor,
                                SUM(po.qtd) AS qtd
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Calcula custo de todos os produtos cadsaatrados
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "calcula_custos_produtos":
                
                $data_inicial = "2020-01-01";
                $fata_final   = "2020-12-31";
                
//                 $result = DBRead('Address', " GROUP BY cidade ", "cidade AS cidade, COUNT(*) AS qtd");
                 
                $result = DBRead('Product prod',
                        
                        "INNER JOIN ItemProduct ip 	ON ip.fk_id_product = prod.id_product " .
                        "INNER JOIN Item item           ON item.id_item = ip.fk_id_item " .
                        
			 "  GROUP BY prod.id_product ORDER BY prod.id_product",
                        
                               "prod.id_product        AS id_prod,
                                prod.name            AS name,
                                SUM(item.cost)      AS custo
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------
            /**
             * Calcula custo de todos os produtos cadsaatrados
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "calcula_produto_abc":
                
                $result = DBRead('Product prod',
                        
                        "INNER JOIN ItemProduct ip 	ON ip.fk_id_product = prod.id_product " .
                        "INNER JOIN Item item           ON item.id_item = ip.fk_id_item " .
                        
			 "  GROUP BY prod.id_product ORDER BY prod.id_product",
                        
                               "prod.id_product        AS id_prod,
                                prod.name            AS name,
                                SUM(item.cost)      AS custo
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------
            /**
             * Busca Pedido p/Relatorio relatorio_produto_abc
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_produto_abc":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        
			 " WHERE o.active LIKE 1 AND  o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY po.fk_id_product ORDER BY qtd desc",
                        
                               "prod.id_product AS product,
                                prod.name AS name_prod,
                                SUM(po.price_total) AS valor,
                                SUM(po.qtd) AS qtd
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cliente
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cliente":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $cliente   = $info['id_cliente'];
                 
                $result = DBRead('Orders',
                        
                       "JOIN Status "
                            . "ON Status.id_status = Orders.fk_id_status " 
                       ."JOIN PaymentTerm "
                            . "ON PaymentTerm.id_payment_term = Orders.fk_id_payment_term " 
                       ."JOIN Customer "
                            . "ON Customer.id_customer = Orders.fk_id_customer " .
                        
			 " WHERE Orders.active LIKE 1 AND Orders.fk_id_customer LIKE $cliente AND to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' ORDER BY Orders.created_at ",
                        
                               "Orders.id_order             as id_order, 
                                Orders.fk_id_customer       as fk_id_customer,
                                Orders.fk_id_payment_term   as fk_id_payment_term,
                                Orders.fk_id_status         as fk_id_status,
                                Orders.payment_status       as payment_status,
                                Orders.created_at           as created_at,
                                Orders.to_deliver_in        as to_deliver_in,
                                
                                Status.status               as status_name,
                                
                                PaymentTerm.name            as payment_term_name,
                                
                                Customer.name               as customer_name
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cliente
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cliente_soma_pedidos":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $cliente   = $info['id_cliente'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        
			 " WHERE o.active LIKE 1 AND o.fk_id_customer LIKE $cliente AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY po.fk_id_order ",
                        
                               "cli.name AS cliente,
                                cli.id_customer AS id_cliente,
                                po.fk_id_order AS id_order,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_produto
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_produto":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $id_produto   = $info['id_produto'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        
			 " WHERE o.active LIKE 1 AND po.fk_id_product LIKE $id_produto AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY DATE(o.to_deliver_in)  ",
                        
                               "prod.name AS produto,
                                prod.id_product AS id_produto,
                                o.to_deliver_in AS delivered,
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_categoria
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_categoria":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $id_cat       = $info['id_cat'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Category cat        ON cat.id_category = prod.fk_id_category " .
                        
			 " WHERE o.active LIKE 1 AND prod.fk_id_category LIKE $id_cat AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY DATE(o.to_deliver_in), prod.id_product   ",
                        
                               "prod.name AS produto,
                                o.id_order AS id_order,
                                prod.id_product AS id_produto,
                                o.to_deliver_in AS delivered,
                                cat.id_category AS id_category,
                                cat.description AS category_name,
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_municipio_all
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_municipio_all":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Address local       ON local.fk_id_customer = cli.id_customer " .
                        
			 " WHERE o.active LIKE 1 AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY local.bairro ",
                        
                               "
                                local.bairro AS bairro,
                                
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_municipio
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_municipio":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $municipio    = $info['municipio'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Address local       ON local.fk_id_customer = cli.id_customer " .
                        
			 " WHERE o.active LIKE 1 AND local.bairro LIKE '$municipio' AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY cli.id_customer ",
                        
                               "cli.id_customer as id_cliente,
                                cli.name as nome_cliente,
                                local.bairro AS bairro,
                                
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cidade
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cidade":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $cidade       = $info['cidade'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Address local       ON local.fk_id_customer = cli.id_customer " .
                        
			 " WHERE o.active LIKE 1 AND local.cidade LIKE '$cidade' AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY cli.id_customer ",
                        
                               "cli.id_customer as id_cliente,
                                cli.name as nome_cliente,
                                local.cidade AS cidade,
                                
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_pagamento
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_pagamento":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                $pagamento   = $info['pagamento'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN PaymentTerm pay     ON pay.id_payment_term = o.fk_id_payment_term " .
                        
			 " WHERE o.active LIKE 1 AND o.fk_id_payment_term LIKE '$pagamento' AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY cli.id_customer  ",
                        
                               "cli.id_customer as id_customer,
                                cli.name as nome_cliente,
                                pay.name as pag,
                                COUNT(o.fk_id_customer) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_pagamento_all
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_pagamento_all":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                 
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN PaymentTerm pay     ON pay.id_payment_term = o.fk_id_payment_term " .
                        
			 " WHERE o.active LIKE 1 AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY o.fk_id_payment_term  ",
                        
                               "pay.id_payment_term as id_payment_term,
                                pay.name as id_payment_term_name,
                                SUM(o.active) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_categoria_all
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_categoria_all":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Category cat        ON cat.id_category = prod.fk_id_category " .
                        
			 " WHERE o.active LIKE 1 AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY prod.fk_id_category   ",
                        
                               "
                                cat.id_category AS id_category,
                                cat.description AS category_name,
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------ 
            /**
             * Busca Pedido p/Relatorio relatorio_cidade_all
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "relatorio_cidade_all":
                
                $data_inicial = $info['data_inicial'];
                $fata_final   = $info['fata_final'];
                
                $result = DBRead('Customer cli',
                        
                        "INNER JOIN Orders o            ON o.fk_id_customer = cli.id_customer " .
                        "INNER JOIN ProductOrder po 	ON po.fk_id_order = o.id_order " .
                        "INNER JOIN Product prod        ON prod.id_product = po.fk_id_product " .
                        "INNER JOIN Address local       ON local.fk_id_customer = cli.id_customer " .
                        
			 " WHERE o.active LIKE 1 AND o.to_deliver_in BETWEEN '$data_inicial 00:00:00' AND '$fata_final 23:59:59' GROUP BY local.cidade ",
                        
                               "
                                local.cidade AS cidade,
                                
                                SUM(po.qtd) as qtd,
                                SUM(po.price_total) AS valor
                               ");
                
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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

