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
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }   
                
            break;
//------------------------------------------------------------------------------            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
//------------------------------------------------------------------------------
            /**
             * Atualiza Token de verificacao de email e atualiza KEY recovery
             * Recebe email de usuario especifico
             * Retorna Sucesso ou falha.
             */
            case "altera_recovery_key":
                $email = $data['email'];
	    
                $data_hora = data_e_hora();
                
                //SEPARADOR !@@@$
                $token_raw = $data_hora . "!@@@$" . Bcrypt::hash($data_hora);
                
                $token_raw  = str_replace(' ', '!', $token_raw);
                $token_raw  = str_replace('.', '!', $token_raw);
                $token_fine = str_replace('/', '!', $token_raw); 
                
	        $array = array(
                    "password_recovery_key" => $token_fine,
                );

                $result = BDUpdate('User', $array, "email LIKE '$email'", true);
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }
            break;
//------------------------------------------------------------------------------
            /**
             * Atualiza Token de verificacao de email e atualiza KEY recovery
             * Recebe email de ADM especifico
             * Retorna Sucesso ou falha.
             */
            case "altera_recovery_key_adm":
                $email = $data['email'];
	    
                $data_hora = data_e_hora();
                
                //SEPARADOR !@@@$
                $token_raw = $data_hora . "!@@@$" . Bcrypt::hash($data_hora);
                
                $token_raw  = str_replace(' ', '!', $token_raw);
                $token_raw  = str_replace('.', '!', $token_raw);
                $token_fine = str_replace('/', '!', $token_raw); 
                
	        $array = array(
                    "password_recovery_key" => $token_fine,
                );

                $result = BDUpdate('Adm', $array, "email LIKE '$email'", true);
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }
            break;
           
//------------------------------------------------------------------------------
            /**
             * Atualiza Senha de determinado usuario
             * Recebe email e nova senha usuario especifico
             * Retorna Sucesso ou falha.
             */
            case "adm_alterar_senha":
                $id_adm = $data['id_adm'];
                $password = $data['password'];
	    
	        $array = array(
                    "password" => Bcrypt::hash($password),
                );

                $result = BDUpdate('Adm', $array, "id_adm LIKE '$id_adm'", true);
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = $result;
                }
            break;
//------------------------------------------------------------------------------
            /**
             * Atualiza Senha de determinado usuario
             * Recebe email e nova senha usuario especifico
             * Retorna Sucesso ou falha.
             */
            case "reset_password_user":
                $email = $data['email'];
                $senha = $data['senha'];
	    
	        $array = array(
                    "password" => $senha,
                );

                $result = BDUpdate('User', $array, "email LIKE '$email'", true);
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = $result;
                }
            break;
//------------------------------------------------------------------------------
            /**
             * CSalva Cookie de User com ID
             * Recebe ID e Cookie
             * Retorna sucesso com ID ou erro
             */
            case "salva_cookie_user":
                
                $id_user         = $data['id_user'];
                $token_login_web = $data['token_login_web'];
	    
	        $array = array(
                    "token_login_web" => $token_login_web,
                );

                $result = BDUpdate('User', $array, "id_user LIKE '$id_user'", true);
                
                return $result;
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }   
                
            break;
//------------------------------------------------------------------------------
           
//------------------------------------------------------------------------------
            /**
             * Altera Dados de perfil do ADm
             * Recebe ID, nome, telefone, OBS
             * Retorna sucesso com ID ou erro
             */
            case "altera_perfil_adm":
                
                $id_adm         = $data['id_adm'];
	    
	        $array = array(
                    "nome"                  => $data['nome'],
                    "telefone"              => $data['telefone'],
                    "observacoes"           => $data['observacoes'],
                    "foto_perfil"           => $data['foto_perfil'],
                );

                $result = BDUpdate('Adm', $array, "id_adm LIKE '$id_adm'", true);
                
                return $result;
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Altera Dados de perfil do ADm
             * Recebe ID, nome, telefone, OBS
             * Retorna sucesso com ID ou erro
             */
            case "altera_perfil_user":
                
                $id_user         = $data['id_user'];
	    
	        $array = array(
                    "nome"                  => $data['nome'],
                    "telefone"              => $data['telefone'],
                    "questao_repetida"      => $data['questao_repetida'],
                    "dark_theme"            => $data['dark_theme'],
                    "tamanho_fonte_web"     => $data['tamanho_fonte_web'],
                    "foto_perfil"           => $data['foto_perfil'],
                );

                $result = BDUpdate('User', $array, "id_user LIKE '$id_user'", true);
                
                return $result;
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }   
                
            break;            
//------------------------------------------------------------------------------
            /* 
             * Altera Dados de perfil do ADm MAX
             * Recebe ID, nome, telefone, OBS
             * Retorna sucesso com ID ou erro
             */
            case "altera_perfil_adm_max":
                
                $id_adm         = $data['id_adm'];
	    
	        $array = array(
                    "perfil_master"         => $data['perfil_master'],
                    "email"                 => $data['email'],
                    "nome"                  => $data['nome'],
                    "telefone"              => $data['telefone'],
                    "observacoes"           => $data['observacoes'],
                    "observacoes_internas"  => $data['observacoes_internas'],
                    "foto_perfil"           => $data['foto_perfil'],
                    "ativo"                 => $data['ativo'],
                );

                $result = BDUpdate('Adm', $array, "id_adm LIKE '$id_adm'", true);
                
                return $result;
                
                if($result){
                    $status['erro'] = false;
		    $status['resultado'] = $token_fine;
                }else{
                    $status['resultado'] = $result;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de questao para Adm com restricoes de campos
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "editar_qfac_short":
                
                $id_to_edit = $data['id_qfac'];
                
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
                $dados['updated_at']            = $data['updated_at'];
                
                if($status['id_cadastro'] = BDUpdate('Qfac', $dados, "id_qfac LIKE $id_to_edit" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
            
//------------------------------------------------------------------------------
            /**
             * Edita dados de questao para Adm FULL data
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "editar_qfac_master":
                
                $id_to_edit = $data['id_qfac'];
                
                $dados = array();
                $dados['fk_id_adm']             = $data['fk_id_adm'];
                $dados['fk_id_faculdade']       = $data['fk_id_faculdade'];
                $dados['fk_id_curso']           = $data['fk_id_curso']  ;
                $dados['fk_id_disciplina_fac']  = $data['fk_id_disciplina_fac'];
                $dados['enunciado']             = $data['enunciado'] ;
                $dados['ativa']                 = $data['ativa'];
                $dados['ano']                   = $data['ano'];
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
                $dados['comentario_interno']    = $data['comentario_interno'];
                $dados['comentario']            = $data['comentario'];
                $dados['imagem']                = $data['imagem'];
                $dados['updated_at']            = $data['updated_at'];
                
                if($status['id_cadastro'] = BDUpdate('Qfac', $dados, "id_qfac LIKE $id_to_edit" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de questao para Adm com restricoes de campos
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "salvar_artigo_editado":
                
                $id_to_edit = $data['id_artigo'];
                
                $dados = array();
                $dados['id_nome']             = $data['id_nome'];
                $dados['titulo']       = $data['titulo'];
                $dados['descricao']           = $data['descricao']  ;
                $dados['imagem']  = $data['imagem'];
                $dados['updated_at']                   = $data['updated_at'] ;
                
                
                if($status['id_cadastro'] = BDUpdate('Artigo', $dados, "id_artigo LIKE $id_to_edit" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
             /**
             * Edita dados de questao para Adm com restricoes de campos
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "adm_reset_senha_master":
                
                $id_to_edit = $data['id_adm'];
                
                $dados = array();
                $dados['password']                  = $data['password'];
                $dados['login_token']               = "";
                $dados['password_recovery_key']     = "";
                $dados['token_login_web']           = "";
                
                if($status['id_cadastro'] = BDUpdate('Adm', $dados, "id_adm LIKE $id_to_edit" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de Banca
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "salva_banca_edit":
                
                $id_banca = $data['id_banca'];
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['ativo']                 = $data['ativo'];
                
                if($status['id_cadastro'] = BDUpdate('Banca', $dados, "id_banca LIKE $id_banca" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de Faculdade
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "salva_faculdade_edit":
                
                $id_faculdade = $data['id_faculdade'];
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['ativo']                 = $data['ativo'];
                $dados['comentario']                 = $data['comentario'];
                
                if($status['id_cadastro'] = BDUpdate('Faculdade', $dados, "id_faculdade LIKE $id_faculdade" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de Curso
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "salva_curso_edit":
                
                $id_curso = $data['id_curso'];
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['ativo']                 = $data['ativo'];
                $dados['comentario']            = $data['comentario'];
                $dados['fk_id_faculdade']       = $data['fk_id_faculdade'];
                
                if($status['id_cadastro'] = BDUpdate('Curso', $dados, "id_curso LIKE $id_curso" ,true)){
                    $status['erro'] = false;
                }   
                
            break;
//------------------------------------------------------------------------------
            /**
             * Edita dados de Disciplina
             * Recebe Todos os dados relevantes
             * Retorna confirmacao da edicao
             */
            case "salva_disciplina_edit":
                
                $id_disciplina_fac = $data['id_disciplina_fac'];
                
                $dados = array();
                $dados['nome']                  = $data['nome'];
                $dados['ativo']                 = $data['ativo'];
                $dados['comentario']            = $data['comentario'];
                $dados['fk_id_faculdade']       = $data['fk_id_faculdade'];
                $dados['fk_id_curso']           = $data['fk_id_curso'];
                
                if($status['id_cadastro'] = BDUpdate('DisciplinaFac', $dados, "id_disciplina_fac LIKE $id_disciplina_fac" ,true)){
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

        // RETORNA JSON JUNTO COM RESULTADO DA BUSCA
        return json_encode($status);
    }    

}     
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

