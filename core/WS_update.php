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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

