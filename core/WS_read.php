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
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
//------------------------------------------------------------------------------
            /**
             * Seleciona um unico usuario com base no email.
             * Recebe email para buscar
             * Retorna todos os dados do USer
             */
            case "seleciona_user_com_email":
                $email = $info['email'];
                $result = DBRead('User', "WHERE email LIKE '$email' limit 1");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;

//------------------------------------------------------------------------------
            /**
             * Busca NOME do Usuario com base no email.
             * Recebe email para buscar
             * Retorna so o nome do USer
             */
            case "seleciona_nome_user_com_email":
                $email = $info['email'];
                $result = DBRead('User', "WHERE email LIKE '$email' limit 1", "nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------
            /**
             * Busca NOME do ADM com base no email.
             * Recebe email para buscar
             * Retorna so o nome do USer
             */
            case "seleciona_nome_adm_com_email":
                $email = $info['email'];
                $result = DBRead('Adm', "WHERE email LIKE '$email' limit 1", "nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
            //------------------------------------------------------------------------------
            /**
             * Busca NOME do ADM com base no email.
             * Recebe email para buscar
             * Retorna so o nome do USer
             */
            case "seleciona_nome_adm_com_id":
                $id_adm = $info['id_adm'];
                
                $result = DBRead('Adm', "WHERE id_adm LIKE '$id_adm' limit 1", "nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;  
//------------------------------------------------------------------------------
            
          /**
             * Busca EMAIL do Usuario com base no token
             * Recebe token para buscar
             * Retorna so o email do USer
             */
            case "seleciona_email_user_com_token":
                $token = $info['token'];
                $result = DBRead('User', "WHERE password_recovery_key LIKE '$token' limit 1", "email");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------  
            /**
             * Busca todos os dados do USER com ID
             * Recebe ID para buscar
             * Retorna todos os dados do User
             */
            case "full_data_user_id":
                $id_user = $info['id_user'];
                $result = DBRead('User', "WHERE id_user LIKE '$id_user' limit 1");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------  
            
            /**
             * Seleciona o Token Login de um usuario especifico
             * Recebe ID do Usuario
             * Retorna token do User
             */
            case "valida_token_user_por_id":
                $campos = "token_login_web, id_user";
                
                $id = $info['id'];
                $result = DBRead('User', "WHERE id_user LIKE '$id' limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
         
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as faculdades ativas do sistema
             * Retorna todas as faculdades cadastradas
             */
            case "seleciona_faculdades_ativas":
                
                $result = DBRead('Faculdade', "WHERE ativo LIKE 1 order by nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as faculdades do sistema
             * Retorna todas as faculdades cadastradas
             */
            case "seleciona_todas_faculdades":
                
                $result = DBRead('Faculdade', "order by nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as faculdades do sistema
             * Retorna todas as faculdades cadastradas
             */
            case "seleciona_curso_com_id_faculdade":
                
                $id_fac = $info['id_faculdade'];
                
                $result = DBRead('Curso', "WHERE fk_id_faculdade like $id_fac AND ativo LIKE 1 order by nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as faculdades do sistema
             * Retorna todas as faculdades cadastradas
             */
            case "seleciona_disciplina_com_id_curso_e_id_faculdade":
                
                $id_fac     = $info['id_faculdade'];
                $id_curso   = $info['id_curso'];
                
                $result = DBRead('DisciplinaFac', "WHERE fk_id_faculdade like $id_fac AND fk_id_curso LIKE $id_curso AND ativo LIKE 1 order by nome");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as Questoes de determinada disciplina
             * Retorna todas as questoes de determinada disciplina
             */
            case "seleciona_qfacs_de_disciplina":
                
                $campos = "id_qfac, enunciado";
                $fk_id_disciplina_fac     = $info['fk_id_disciplina_fac'];
                
                $result = DBRead('Qfac', "WHERE fk_id_disciplina_fac like $fk_id_disciplina_fac", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Conta Qfacs de determinado User com base da Disciplina
             * Retorna a contagem
             */
            case "check_adm_possui_qfac_com_disciplina":
                
                $campos = "id_qfac";
                $fk_id_disciplina_fac     = $info['fk_id_disciplina_fac'];
                $fk_id_adm                = $info['fk_id_adm'];
                
                $result = DBRead('Qfac', "WHERE fk_id_adm LIKE $fk_id_adm AND fk_id_disciplina_fac LIKE $fk_id_disciplina_fac limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Conta Qfacs de determinado User com base no ID
             * Retorna a contagem
             */
            case "check_adm_possui_qfac_com_id":
                
                $campos = "id_qfac";
                $id_qfac       = $info['id_qfac'];
                $id_adm        = $info['fk_id_adm'];
                
                $result = DBRead('Qfac', "WHERE id_qfac LIKE $id_qfac AND fk_id_adm LIKE $id_adm limit 1", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona Qfac Especifica com base no ID
             * Retorna a contagem
             */
            case "seleciona_qfac_com_id":
                
                $id_qfac       = $info['id_qfac'];
                
                $result = DBRead('Qfac', "WHERE id_qfac LIKE $id_qfac");
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona Qfacs de determinada disciplina e Adm
             * Retorna lista das questoes com o nome das chaves estrangeiras
             */
            case "seleciona_qfac_por_disciplina_e_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                $fk_id_disciplina_fac       = $info['fk_id_disciplina_fac'];
                
                $result = DBRead('Qfac',
                        
                        "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                        . "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                        . "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                        . "WHERE fk_id_adm LIKE $fk_id_adm AND fk_id_disciplina_fac like $fk_id_disciplina_fac",
                        
                          "Qfac.id_qfac                 as id_qfac,"
                         ."Qfac.fk_id_adm               as fk_id_adm,"
                        . "Qfac.fk_id_faculdade         as fk_id_faculdade,"
                        . "Faculdade.nome               as faculdade_nome,"
                        . "Qfac.fk_id_curso             as fk_id_curso,"
                        . "Curso.nome                   as cursno_nome,"
                        . "Qfac.fk_id_disciplina_fac    as fk_id_disciplina_fac,"
                        . "DisciplinaFac.nome           as disciplina_nome,"
                        . "Qfac.enunciado               as enunciado,"
                        . "Qfac.ativa                   as ativa,"
                        . "Qfac.created_at              as created_at");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Busca TODOS os dados da situacao financeira Por ADM
             * Recebe ID
             * Retorna relatorio
             */
            case "adm_relatorio_resumo_geral":
                
                $id_adm = $info['id_adm'];
                
                $res_qfac = DBRead('Qfac', "WHERE fk_id_adm = $id_adm", "COUNT(*) AS qtd");
                $res_qfac_pago = DBRead('QfacPago', "WHERE fk_id_adm = $id_adm");
                if($res_qfac_pago){
                    $res_qfac_tot = 0;
                    foreach ($res_qfac_pago as $value){
                        $res_qfac_tot +=  $value['qtd_pago'];
                    }
                }else{
                    $res_qfac_tot = 0;
                }
                if($res_qfac_pago){
                    $res_qfac_val_tot = 0;
                    foreach ($res_qfac_pago as $value){
                        $res_qfac_val_tot +=  $value['valor_pago'];
                    }
                }else{
                    $res_qfac_val_tot = 0;
                }

                
                $res_qce = DBRead('Qce', "WHERE fk_id_adm = $id_adm", "COUNT(*) AS qtd");
                $res_qce_pago = DBRead('QcePago', "WHERE fk_id_adm = $id_adm");
                if($res_qce_pago){
                    $res_qce_tot = 0;
                    foreach ($res_qce_pago as $value){
                        $res_qce_tot +=  $value['qtd_pago'];
                    }
                }else{
                    $res_qce_tot = 0;
                }
                if($res_qce_pago){
                    $res_qce_tot_pago = 0;
                    foreach ($res_qce_pago as $value){
                        $res_qce_tot_pago +=  $value['valor_pago'];
                    }
                }else{
                    $res_qce_tot_pago = 0;
                }
                
                
                $res_qme = DBRead('Qme5', "WHERE fk_id_adm = $id_adm", "COUNT(*) AS qtd");
                $res_qme_pago = DBRead('Qme5Pago', "WHERE fk_id_adm = $id_adm");
                if($res_qme_pago){
                    $res_qme_tot = 0;
                    foreach ($res_qme_pago as $value){
                        $res_qme_tot +=  $value['qtd_pago'];
                    }
                }else{
                    $res_qme_tot = 0;
                }
                if($res_qme_pago){
                    $res_qme_tot_pago = 0;
                    foreach ($res_qme_pago as $value){
                        $res_qme_tot_pago +=  $value['valor_pago'];
                    }
                }else{
                    $res_qme_tot_pago = 0;
                }
                
                
                $result['total_faculdade_inseridas'] = $res_qfac;
                $result['total_faculdade_pagas'] = $res_qfac_tot;
                $result['total_pago_faculdade'] = $res_qfac_val_tot;
                
                $result['total_concurso_ce_inseridas'] = $res_qce;
                $result['total_concurso_ce_pagas'] = $res_qce_tot;
                $result['total_pago_concurso_ce'] = $res_qce_tot_pago;
                
                $result['total_concurso_me_inseridas'] = $res_qme;
                $result['total_concurso_me_pagas'] = $res_qme_tot;
                $result['total_pago_concurso_me'] = $res_qme_tot_pago;
                
                $result['total_questoes_pagas'] = $res_qfac_tot + $res_qce_tot + $res_qme_tot;
                $result['total_geral_pago'] = $res_qfac_val_tot + $res_qce_tot_pago + $res_qme_tot_pago;
                
                
                $status['erro'] = false;
                $status['resultado'] = $result;
                
            break;
//------------------------------------------------------------------------------
            /**
             * Seleciona QCEs pagas por ADM
             * Retorna lista dos pagamentos
             */
            case "seleciona_qces_pago_de_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                
                $result = DBRead('QcePago', "WHERE fk_id_adm LIKE $fk_id_adm");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona QMEs pagas por ADM
             * Retorna lista dos pagamentos
             */
            case "seleciona_qmes_pago_de_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                
                $result = DBRead('Qme5Pago', "WHERE fk_id_adm LIKE $fk_id_adm");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona QFACs pagas por ADM
             * Retorna lista dos pagamentos
             */
            case "seleciona_qfacs_pago_de_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                
                $result = DBRead('QfacPago', "WHERE fk_id_adm LIKE $fk_id_adm");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Conta e relciona Qfac separado por Disciplina de unico ADm
             * Retorna lista 
             */
            case "seleciona_relatorio_qfac_por_disciplina_por_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                
                $result = DBRead('Qfac',
                        
                        "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                    	. "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                    	. "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                    	
			. "WHERE fk_id_adm LIKE $fk_id_adm "
                    	. "group by Qfac.fk_id_disciplina_fac ",
                        
 
                        "Qfac.fk_id_disciplina_fac as fk_id_disciplina_fac,
			                  count(*) AS qtd, 
			            Qfac.fk_id_adm as fk_id_adm,
			      Qfac.fk_id_faculdade as fk_id_faculdade,
			            Faculdade.nome as nome_faculdade,
			          Qfac.fk_id_curso as fk_id_curso,
			                Curso.nome as nome_curso,
			        DisciplinaFac.nome as nome_disciplina");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Busca a relacao de todos os artigos no sistema de determinado ADM
             * Retorna lista
             */
            case "relacao_artigos_adm":

                $fk_id_adm = $info['fk_id_adm'];
                $campos = "id_artigo, id_nome, titulo, descricao, created_at";

                $result = DBRead('Artigo', "WHERE fk_id_adm like $fk_id_adm", $campos);
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;            
//------------------------------------------------------------------------------
            /**
             * Seleciona o Token Login de um usuario especifico
             * Recebe ID do Usuario
             * Retorna token do User
             */
            case "adm_relatorio_all_adms":
                
                $campos = "id_adm, email, nome, perfil_master, ativo";
                
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
             * Seleciona o Token Login de um usuario especifico
             * Recebe ID do Usuario
             * Retorna token do User
             */
            case "relatorio_questoes_no_sistema":
                

                
                
                $result = DBRead_no_from("
                    (SELECT COUNT(*) FROM `Qce`  WHERE ativa LIKE 1) as qce_ativa,
                    (SELECT COUNT(*) FROM `Qce`  WHERE ativa LIKE 0) as qce_inativa,
                    (SELECT COUNT(*) FROM `Qme5` WHERE ativa LIKE 1) as qme5_ativa,
                    (SELECT COUNT(*) FROM `Qme5` WHERE ativa LIKE 0) as qme5_inativa,
                    (SELECT COUNT(*) FROM `Qfac` WHERE ativa LIKE 1) as qfac_ativa,
                    (SELECT COUNT(*) FROM `Qfac` WHERE ativa LIKE 0) as qfac_inativa");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;
//------------------------------------------------------------------------------ 
            /**
             * Busca Todas QCE Ativas
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qces_ativas":
                
                $result = DBRead('Qce',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qce.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qce.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qce.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qce.fk_id_materia "
                    	
			. "WHERE ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                                "Qce.id_qce as id, 
                                Qce.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qce.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qce.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qce.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qce.enunciado as enunciado,
                                Qce.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
//------------------------------------------------------------------------------ 
            /**
             * Busca Todas QCE INATIVAS
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qces_inativas":
                
                $result = DBRead('Qce',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qce.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qce.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qce.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qce.fk_id_materia "
                    	
			. "WHERE ativa LIKE 0 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                                "Qce.id_qce as id, 
                                Qce.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qce.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qce.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qce.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qce.enunciado as enunciado,
                                Qce.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
 //------------------------------------------------------------------------------ 
            /**
             * Busca Todas QCE
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qces":
                
                $result = DBRead('Qce',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qce.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qce.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qce.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qce.fk_id_materia "
                    	
			. " ",
                        
 
                                "Qce.id_qce as id, 
                                Qce.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qce.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qce.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qce.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qce.enunciado as enunciado,
                                Qce.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------          
            /**
             * Busca Todas QME Ativas
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qmes_ativas":
                
                $result = DBRead('Qme5',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qme5.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qme5.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qme5.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qme5.fk_id_materia "
                    	
			. "WHERE ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                               "Qme5.id_qme5 as id, 
                                Qme5.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qme5.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qme5.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qme5.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qme5.enunciado as enunciado,
                                Qme5.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
//------------------------------------------------------------------------------ 
            /**
             * Busca Todas QME INATIVAS
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qmes_inativas":
                
                $result = DBRead('Qme5',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qme5.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qme5.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qme5.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qme5.fk_id_materia "
                    	
			. "WHERE ativa LIKE 0 ",
                        
 
                               "Qme5.id_qme5 as id, 
                                Qme5.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qme5.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qme5.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qme5.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qme5.enunciado as enunciado,
                                Qme5.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
 //------------------------------------------------------------------------------ 
            /**
             * Busca Todas QME
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qmes":
                
                $result = DBRead('Qme5',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qme5.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qme5.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qme5.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qme5.fk_id_materia "
                    	
			. " ",
                        
 
                               "Qme5.id_qme5 as id, 
                                Qme5.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qme5.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qme5.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qme5.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qme5.enunciado as enunciado,
                                Qme5.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------  
           /**
             * Busca Todas QFAC Ativas
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qfacs_ativas":
                
                $result = DBRead('Qfac',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qfac.fk_id_adm "
                        . "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                    	. "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                    	. "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                    	
			. "WHERE ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                               "Qfac.id_qfac as id, 
                                Qfac.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qfac.fk_id_faculdade as fk_id_faculdade, 
                                Faculdade.nome as col_2,
                                Qfac.fk_id_curso as fk_id_curso,
                                Curso.nome as col_3,
                                Qfac.fk_id_disciplina_fac as fk_id_disciplina,
                                DisciplinaFac.nome as col_4,
                                Qfac.enunciado as enunciado,
                                Qfac.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
//------------------------------------------------------------------------------ 
            /**
             * Busca Todas QME INATIVAS
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qfacs_inativas":
                
                $result = DBRead('Qfac',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qfac.fk_id_adm "
                        . "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                    	. "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                    	. "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                    	
			. "WHERE ativa LIKE 0 ",
                        
 
                               "Qfac.id_qfac as id, 
                                Qfac.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qfac.fk_id_faculdade as fk_id_faculdade, 
                                Faculdade.nome as col_2,
                                Qfac.fk_id_curso as fk_id_curso,
                                Curso.nome as col_3,
                                Qfac.fk_id_disciplina_fac as fk_id_disciplina,
                                DisciplinaFac.nome as col_4,
                                Qfac.enunciado as enunciado,
                                Qfac.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
            
 //------------------------------------------------------------------------------ 
            /**
             * Busca Todas QCE
             * Retorna lista para relatorio
             */
            case "seleciona_todas_qfacs":
                
                $result = DBRead('Qfac',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qfac.fk_id_adm "
                        . "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                    	. "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                    	. "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                    	
			. " ",
                        
 
                               "Qfac.id_qfac as id, 
                                Qfac.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qfac.fk_id_faculdade as fk_id_faculdade, 
                                Faculdade.nome as col_2,
                                Qfac.fk_id_curso as fk_id_curso,
                                Curso.nome as col_3,
                                Qfac.fk_id_disciplina_fac as fk_id_disciplina,
                                DisciplinaFac.nome as col_4,
                                Qfac.enunciado as enunciado,
                                Qfac.created_at as created_at");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------  
            /**
             * Conta todas as QCES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_todas_qce_por_adm":
                
                $result = DBRead('Adm', "JOIN Qce on Qce.fk_id_adm = Adm.id_adm WHERE Qce.ativa = 1 GROUP BY Qce.fk_id_adm", "Adm.nome, Adm.id_adm, COUNT(Qce.fk_id_adm) AS QtdQce");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Conta todas as QMES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_todas_qme_por_adm":
                
                $result = DBRead('Adm', "JOIN Qme5 on Qme5.fk_id_adm = Adm.id_adm WHERE Qme5.ativa = 1 GROUP BY Qme5.fk_id_adm", "Adm.nome, Adm.id_adm, COUNT(Qme5.fk_id_adm) AS QtdQme5");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Conta todos os pagamentos QMES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_pagamentos_qme_por_adm":
                
                $result = DBRead('Qme5Pago', "group by fk_id_adm", "fk_id_adm, qtd_pago, sum(qtd_pago) as qtd_qme_pago");


                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Conta todos os pagamentos QMES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_pagamentos_qce_por_adm":
                
                $result = DBRead('QcePago', "group by fk_id_adm", "fk_id_adm, sum(qtd_pago) as qtd_qce_pago");


                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------            
            /**
             * Conta todos os pagamentos QMES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_todas_qfacs_por_adm":
                
                $result = DBRead('Adm', "JOIN Qfac on Qfac.fk_id_adm = Adm.id_adm WHERE Qfac.ativa = 1 GROUP BY Qfac.fk_id_adm", "Adm.nome, Adm.id_adm, COUNT(Qfac.fk_id_adm) AS QtdQfac");


                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Conta todos os pagamentos QMES e separa por ADM
             * Retorna lista dos pagamentos
             */
            case "conta_pagamentos_qfac_por_adm":
                
                $result = DBRead('QfacPago', "group by fk_id_adm", "fk_id_adm, qtd_pago, sum(qtd_pago) as qtd_qfac_pago");


                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------  
            /**
             * Seleciona Acessos de Determinado Adm
             * Retorna lista dos acessos
             */
            case "seleciona_acessos_adm":
                
                $fk_id_adm                  = $info['fk_id_adm'];
                
                $result = DBRead('LoginAdm', "WHERE fk_id_adm LIKE $fk_id_adm");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todas as bancas do sistema
             * Retorna lista das bancas
             */
            case "seleciona_todas_bancas":
                
                $result = DBRead('Banca', "");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona banca com ID
             * Retorna lista das bancas
             */
            case "seleciona_banca_com_id":
                
                $id_banca  = $info['id_banca'];
                
                $result = DBRead('Banca', "WHERE id_banca LIKE '$id_banca' limit 1");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Seleciona Faculdade com ID
             * Retorna lista das bancas
             */
            case "busca_faculdade_por_id":
                
                $id_faculdade  = $info['id_faculdade'];
                
                $result = DBRead('Faculdade', "WHERE id_faculdade LIKE '$id_faculdade' limit 1");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------  
            /**
             * Seleciona todos os cursos nomeando a Faculdade
             * Retorna lista das bancas
             */
            case "seleciona_todos_cursos":
                
               $result = DBRead('Curso',
                        
                        "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Curso.fk_id_faculdade "
                    	
			. " ",
                       
                         "Curso.nome as nome, "
                       . "Curso.id_curso as id_curso, "
                       . "Curso.fk_id_faculdade as fk_if_faculdade, "
                       . "Curso.created_at as created_at, "
                       . "Curso.ativo as ativo, "
                       . "Curso.comentario as comentario, "
                       . "Faculdade.nome as faculdade_nome");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;         
//------------------------------------------------------------------------------ 
            /**
             * Seleciona todos os cursos nomeando a Faculdade
             * Retorna lista das bancas
             */
            case "seleciona_todos_cursos_ativos":
                
               $result = DBRead('Curso',
                        
                        "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Curso.fk_id_faculdade "
                    	
			. "WHERE Curso.ativo LIKE 1 ",
                       
                         "Curso.nome as nome, "
                       . "Curso.id_curso as id_curso, "
                       . "Curso.fk_id_faculdade as fk_if_faculdade, "
                       . "Curso.created_at as created_at, "
                       . "Curso.ativo as ativo, "
                       . "Curso.comentario as comentario, "
                       . "Faculdade.nome as faculdade_nome");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;         
//------------------------------------------------------------------------------ 
            /**
             * Seleciona Curso com ID
             * Retorna lista das bancas
             */
            case "busca_curso_por_id":
                
                $id_curso  = $info['id_curso'];
                
                $result = DBRead('Curso', "WHERE id_curso LIKE '$id_curso' limit 1");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break; 
            
 //------------------------------------------------------------------------------  
            /**
             * Seleciona todos as disciplinas
             * Retorna lista das bancas
             */
            case "seleciona_todas_disciplinas_fac":
                
               $result = DBRead('DisciplinaFac',
                        
                        "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = DisciplinaFac.fk_id_faculdade "
                       . "JOIN Curso "
                            . "ON Curso.id_curso = DisciplinaFac.fk_id_curso "
                    	
			. " ",
                       
                         "DisciplinaFac.nome as nome, "
                       . "DisciplinaFac.id_disciplina_fac as id_disciplina_fac, "
                       . "DisciplinaFac.fk_id_faculdade as fk_id_faculdade, "
                       . "DisciplinaFac.fk_id_curso as fk_id_curso, "
                       . "DisciplinaFac.created_at as created_at, "
                       . "DisciplinaFac.ativo as ativo, "
                       . "DisciplinaFac.comentario as comentario, "
                       . "Faculdade.nome as faculdade_nome, "
                       . "Curso.nome as curso_nome");
                        
                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;         
//------------------------------------------------------------------------------ 
            /**
             * Seleciona Disciplina com ID
             * Retorna lista das bancas
             */
            case "busca_disciplina_por_id":
                
                $id_disciplina  = $info['id_disciplina'];
                
                $result = DBRead('DisciplinaFac', "WHERE id_disciplina_fac LIKE '$id_disciplina' limit 1");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;  
//------------------------------------------------------------------------------ 
            /**
             * Relatorio QCE totalizando por Materia
             * Retorna lista dos pagamentos
             */
            case "conta_qce_ativa_por_materia":
                
                $result = DBRead('Materia', 
                        "JOIN Qce on Qce.fk_id_materia = Materia.id_materia "
                        . "JOIN Banca on Banca.id_banca = Materia.fk_id_banca "
                        . "JOIN Cargo on Cargo.id_cargo = Materia.fk_id_cargo "
                        
                        . "WHERE Qce.ativa = 1 GROUP BY Qce.fk_id_materia",
                        
                        "Materia.nome as col_1, Materia.id_materia as id, Banca.nome as col_2, Cargo.nome as col_3, COUNT(Qce.fk_id_materia) AS col_4");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Seleciona Qce por materia
             * Retorna lista das bancas
             */
            case "seleciona_qce_por_materia":
                
                $fk_id_materia  = $info['fk_id_materia'];
                
                $result = DBRead('Qce',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qce.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qce.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qce.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qce.fk_id_materia "
                    	
			. "WHERE fk_id_materia LIKE '$fk_id_materia' AND ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                                "Qce.id_qce as id, 
                                Qce.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qce.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qce.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qce.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qce.enunciado as enunciado,
                                Qce.created_at as created_at");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            
            /**
             * Relatorio QME totalizando por Materia
             * Retorna lista dos pagamentos
             */
            case "conta_qme_ativa_por_materia":
                
                $result = DBRead('Materia', 
                        "JOIN Qme5 on Qme5.fk_id_materia = Materia.id_materia "
                        . "JOIN Banca on Banca.id_banca = Materia.fk_id_banca "
                        . "JOIN Cargo on Cargo.id_cargo = Materia.fk_id_cargo "
                        
                        . "WHERE Qme5.ativa = 1 GROUP BY Qme5.fk_id_materia",
                        
                        "Materia.nome as col_1, Materia.id_materia as id, Banca.nome as col_2, Cargo.nome as col_3, COUNT(Qme5.fk_id_materia) AS col_4");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Seleciona QME por materia
             * Retorna lista 
             */
            case "seleciona_qme_por_materia":
                
                $fk_id_materia  = $info['fk_id_materia'];
                
                $result = DBRead('Qme5',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qme5.fk_id_adm "
                        . "JOIN Banca "
                            . "ON Banca.id_banca = Qme5.fk_id_banca "
                    	. "JOIN Cargo "
                            . "ON Cargo.id_cargo = Qme5.fk_id_cargo "
                    	. "JOIN Materia "
                            . "ON Materia.id_materia = Qme5.fk_id_materia "
                    	
			. "WHERE fk_id_materia LIKE '$fk_id_materia' AND ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                                "Qme5.id_qme5 as id, 
                                Qme5.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qme5.fk_id_banca as fk_id_banca, 
                                Banca.nome as col_2,
                                Qme5.fk_id_cargo as fk_id_cargo,
                                Cargo.nome as col_3,
                                Qme5.fk_id_materia as fk_id_materia,
                                Materia.nome as col_4,
                                Qme5.enunciado as enunciado,
                                Qme5.created_at as created_at");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;       
//------------------------------------------------------------------------------ 
            /**
             * Relatorio QME totalizando por Materia
             * Retorna lista dos pagamentos
             */
            case "conta_qfac_ativa_por_disciplina":
                
                $result = DBRead('DisciplinaFac', 
                        "JOIN Qfac on Qfac.fk_id_disciplina_fac = DisciplinaFac.id_disciplina_fac "
                        . "JOIN Faculdade on Faculdade.id_faculdade = DisciplinaFac.fk_id_faculdade "
                        . "JOIN Curso on Curso.id_curso = DisciplinaFac.fk_id_curso "
                        
                        . "WHERE Qfac.ativa = 1 GROUP BY Qfac.fk_id_disciplina_fac",
                        
                        "DisciplinaFac.nome as col_1, DisciplinaFac.id_disciplina_fac as id, Faculdade.nome as col_2, Curso.nome as col_3, COUNT(Qfac.fk_id_disciplina_fac) AS col_4");

                if($result){
                    $status['erro'] = false;
                    $status['resultado'] = $result;
                }else{
                    $status['resultado'] = 'Busca vazia';
                }
            break;    
//------------------------------------------------------------------------------
            /**
             * Seleciona QFAC por Disciplina
             * Retorna lista 
             */
            case "seleciona_qfac_por_disciplina":
                
                $fk_id_disciplina  = $info['fk_id_disciplina'];
                
                $result = DBRead('Qfac',
                        
                        "JOIN Adm "
                            . "ON Adm.id_adm = Qfac.fk_id_adm "
                        . "JOIN Faculdade "
                            . "ON Faculdade.id_faculdade = Qfac.fk_id_faculdade "
                    	. "JOIN Curso "
                            . "ON Curso.id_curso = Qfac.fk_id_curso "
                    	. "JOIN DisciplinaFac "
                            . "ON DisciplinaFac.id_disciplina_fac = Qfac.fk_id_disciplina_fac "
                    	
			. "WHERE fk_id_disciplina_fac LIKE '$fk_id_disciplina' AND ativa LIKE 1 ",
//			. "WHERE ativa LIKE 1 LIMIT 2 ",
                        
 
                                "Qfac.id_qfac as id, 
                                Qfac.fk_id_adm as fk_id_adm, 
                                Adm.nome as col_1,
                                Qfac.fk_id_faculdade as fk_id_faculdade, 
                                Faculdade.nome as col_2,
                                Qfac.fk_id_curso as fk_id_curso,
                                Curso.nome as col_3,
                                Qfac.fk_id_disciplina_fac as fk_id_disciplina_fac,
                                DisciplinaFac.nome as col_4,
                                Qfac.enunciado as enunciado,
                                Qfac.created_at as created_at");

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
        
        
        
        
        
        
        
        
        
        
        















        
            
 
    

