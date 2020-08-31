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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

