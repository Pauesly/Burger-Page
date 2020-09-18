<?php 
 


    function data_e_hora(){
        $data_tz_brasil = date_create('-3 hour')->format('Y-m-d H:i:s');
        return  $data_tz_brasil;
    }

    
    
    // Grava registros
    function DBCreate($table, array $data, $insertId = false){
        
        $data = DBEscape($data);
        
        $fields = implode (', ', array_keys($data));
        $values = "'".implode ("', '", $data)."'";

        $query = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";
        
        return DBExecute_create($query, $insertId);
        //var_dump($query);
 
    }
    
    

    // Executa Querys
    function DBExecute_create($query, $insertId = false){ 
        
        $link = DBconnect();
        $result = @mysqli_query($link, $query) or die (mysqli_error($link));
        
        if($insertId)
	        $result = mysqli_insert_id($link);
        //$result = mysqli_affected_rows($link);
        
        DBClose($link);
        return $result;
    }
    
    
    // Executa Querys
    function DBExecute_update($query, $insertId = false){ 
        
        $link = DBconnect();
        $result = @mysqli_query($link, $query) or die (mysqli_error($link));
        
        if($insertId)
	        // $result = mysqli_insert_id($link);
                $result = mysqli_affected_rows($link);
        
        DBClose($link);
        return $result;
    }
    
    
    // Executa Querys
    function DBExecute($query, $insertId = false){ 
        
        $link = DBconnect();
        $result = @mysqli_query($link, $query) or die (mysqli_error($link));
        
        if($insertId)
	        // $result = mysqli_insert_id($link);
                $result = mysqli_affected_rows($link);
        
        DBClose($link);
        return $result;
    }
    
    
    
    // Ler Registros
    function DBRead($table, $params = null, $fields = '*'){
		
            // se Passou Params, entao recebe PARAMS com espaco. Senao, null
            $params = ($params) ? " {$params}" : null;

            $query = "SELECT {$fields} FROM {$table} {$params}";

            $result = DBExecute ($query);
//            var_dump($query);

            if(!mysqli_num_rows($result))
                return false;
            else{
                while($res = mysqli_fetch_assoc($result)){
                    $data [] = $res;
            }
            return $data;
            //return $result;
            }
    }
    
    // Ler Registros
    function DBRead_retorna_query($table, $params = null, $fields = '*'){
		
            // se Passou Params, entao recebe PARAMS com espaco. Senao, null
            $params = ($params) ? " {$params}" : null;

            $query = "SELECT {$fields} FROM {$table} {$params}";

//            $result = DBExecute ($query);
            return var_dump($query);

            
    }
    
    
    
    // Ler Registros
    function DBRead_no_from($fields = '*'){
		
            $query = "SELECT {$fields}";

            $result = DBExecute ($query);
//            var_dump($query);

            if(!mysqli_num_rows($result))
                return false;
            else{
                while($res = mysqli_fetch_assoc($result)){
                    $data [] = $res;
            }
            return $data;
            //return $result;
            }
    }
    
    
    
    
    // Deleta Registro 
    function DBDelete($table, $where){
	    $query = "DELETE FROM {$table} WHERE {$where}";
	    return DBExecute($query);
    } 


    
//  Altera Registro
    function BDUpdate($table, array $data, $where, $insertId = true){

        foreach ($data as $key => $value){
            $fields[] = "{$key} = '{$value}'";
        }

        $fields = implode (', ', $fields);

        //Se veio parametro, coloca "espaco WHERE", se nao, NULL
        $where = ($where) ? " WHERE {$where}" : null;

        $query = "UPDATE {$table} SET {$fields}{$where}";

        return DBExecute_update($query, $insertId);

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

//    // Altera Registro
//	function BDUpdate($table, array $data, $where, $insertId = false){
//	    
//	    foreach ($data as $key => $value){
//	    	$fields[] = "{$key} = '{$value}'";
//	    }
//	    
//	    $fields = implode (', ', $fields);
//	
//	    //Se veio parametro, coloca "espaco WHERE", se nao, NULL
//	    $where = ($where) ? " WHERE {$where}" : null;
//	
//	    $query = "UPDATE {$table} SET {$fields}{$where}";
//	    
//	    return DBExecute_update($query, $insertId);
//
//	}
//	
//	
//	
//	
//	//ALTERA SEM ASPAS NOS ARGUMENTOS
//	function BDUpdateSemAspas($table, array $data, $where, $insertId = false){
//	    
//	    foreach ($data as $key => $value){
//	    	$fields[] = "{$key} = {$value}";
//	    }
//	    
//	    $fields = implode (', ', $fields);
//	
//	    //Se veio parametro, coloca "espaco WHERE", se nao, NULL
//	    $where = ($where) ? " WHERE {$where}" : null;
//	
//	    $query = "UPDATE {$table} SET {$fields}{$where}";
//		//var_dump($query);
//	    return DBExecute($query, $insertId);
//	    
//	//	$query = "UPDATE tabela SET campo1 = 'valor1', campo2 = 'valor2' WHERE campo = 'valor'";
//	}
//	
//
//
//
//    
//	
//	
//	
//	// Ler Registros
//    function DBReadContaMateria($table, $fields = '*'){
//		
//		// se Passou Params, entao recebe PARAMS com espaco. Senao, null
//		$params = ($params) ? " {$params}" : null;
//		
//		$query = "SELECT COUNT(*) FROM {$table} WHERE `fk_idMateria` = {$fields}";
//
//		$result = DBExecute ($query);
//		//var_dump($query);
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	// CONTAR ESTATISTICAS QUESTOES RESPONDIDAS
//    function DBReadEstatisticas($idUsuario){
//		
//		
//		$query = "SELECT
//                    (SELECT COUNT(*) FROM `StatusUsuarioQce` WHERE fk_idUsuario LIKE $idUsuario) as qce,
//                    (SELECT COUNT(*) FROM `StatusUsuarioQme5` WHERE fk_idUsuario LIKE $idUsuario) as qme5,
//                    
//                    (SELECT COUNT(*) FROM `StatusUsuarioQce` WHERE fk_idUsuario LIKE $idUsuario AND status LIKE 1) as qceC,
//                    (SELECT COUNT(*) FROM `StatusUsuarioQme5` WHERE fk_idUsuario LIKE $idUsuario AND status LIKE 1) as qme5C
//		   		 ";
//		
//		$result = DBExecute ($query);
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	// CONTAR todas as questoes no sistema
//    function DBRead_relatorio_questoes_no_sistema(){
//
//		$query = "SELECT
//                    (SELECT COUNT(*) FROM `Qce` WHERE ativa LIKE 1) as qce,
//                    (SELECT COUNT(*) FROM `Qme5` WHERE ativa LIKE 1) as qme5";
//	
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	// CONTAR ESTATISTICAS QUESTOES DIGITADAS POR ADM (excluindo inativas)
//    function DBReadEstatisticasAdm($fk_idAdm){
//
//		$query = "SELECT
//                    (SELECT COUNT(*) FROM `Qce` WHERE fk_idAdm LIKE $fk_idAdm AND  ativa LIKE 1) as qce,
//                    (SELECT COUNT(*) FROM `Qme5` WHERE fk_idAdm LIKE $fk_idAdm AND  ativa LIKE 1) as qme5";
//	
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	// CONTAR questoes inativas
//    function DBReadContaInativas($fk_idAdm){
//
//		$query = "SELECT
//                    (SELECT COUNT(*) FROM `Qce` WHERE fk_idAdm LIKE $fk_idAdm AND  ativa LIKE 0) as qce,
//                    (SELECT COUNT(*) FROM `Qme5` WHERE fk_idAdm LIKE $fk_idAdm AND  ativa LIKE 0) as qme5";
//	
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	
//	
//	// CONTAR quantidade de Máterias digitadas em Cada Modalidade
//    function DBReadContaQuestoesDigitadas(){
//        
//        $data;
//
//        // CONTA Qce
//		$query = "SELECT Materia.nome,Materia.idMateria, 
//		            COUNT(Qce.fk_idMateria) AS QtdQce
//                    FROM Materia
//                    JOIN Qce on Qce.fk_idMateria = Materia.idMateria
//                    GROUP BY `fk_idMateria`";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qce [] = $res;
//	        }
//	        $data[qce] = $qce;
//		}
//		
//		
//		// CONTA Qme5
//		$query = "SELECT Materia.nome,Materia.idMateria, 
//		            COUNT(Qme5.fk_idMateria) AS QtdQme5
//                    FROM Materia
//                    JOIN Qme5 on Qme5.fk_idMateria = Materia.idMateria
//                    GROUP BY `fk_idMateria`";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qme5 [] = $res;
//	        }
//	        $data[qme5] = $qme5;
//		}
//		
//		return $data;
//	}
//	
//	
//	
//	
//	
//	// CONTAR ESTATISTICAS QUESTOES DIGITADAS E PAGAS TODOS ADMSSS
//    function DBReadEstatisticasAdms(){
//        
//        $data;
//
//        // CONTA QME5 ATIVASS
//		$query = "SELECT Adm.nome,Adm.idAdm, COUNT(Qme5.fk_idAdm) AS QtdQme5
//                    FROM Adm
//                    JOIN Qme5 on Qme5.fk_idAdm = Adm.idAdm WHERE Qme5.ativa = 1
//                    GROUP BY `fk_idAdm`";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    $data[qme5] = null;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qme5 [] = $res;
//	        }
//	        $data[qme5] = $qme5;
//		}
//		 
//		
//		// CONTA QCE ATIVAS
//		$query = "SELECT Adm.nome, Adm.idAdm, COUNT(Qce.fk_idAdm) AS QtdQce
//                    FROM Adm
//                    JOIN Qce on Qce.fk_idAdm = Adm.idAdm WHERE Qce.ativa = 1
//                    GROUP BY `fk_idAdm`";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    $data[qce] = null;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qce [] = $res;
//	        }
//	        $data[qce] = $qce;
//		}
//		
//		
//		// CONTA QME5 PAGAS
//		$query = "Select fk_idAdm, qtdPago, sum(qtdPago) as qtdPago
//                    from Qme5Pago
//                    group by fk_idAdm";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    $data[qme5pago] = null;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qme5paga [] = $res;
//	        }
//	        $data[qme5pago] = $qme5paga;
//		}
//		
//		
//		// CONTA QCE PAGAS
//		$query = "Select fk_idAdm, qtdPago, sum(qtdPago) as qtdPago
//                    from QcePago
//                    group by fk_idAdm";
//
//		$result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    $data[qcepago] = null;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $qcepaga [] = $res;
//	        }
//	        $data[qcepago] = $qcepaga;
//		}
//		
//		
//		
//		return $data;
//		    
//	}
//	
//	
//	
//	
//	
//	// CONTAR ESTATISTICAS QUESTOES DIGITADAS E PAGAS Adm Especifico
//    function DBRead_conta_soma_questao($idAdm, $tipo_pgto){
//        
//        $data = NULL;
//
//		$query = "SELECT fk_idAdm, SUM(qtdPago) AS qtd_pago, SUM(valorPago) AS valor_pago FROM $tipo_pgto WHERE fk_idAdm like $idAdm";
//
//		$result = DBExecute ($query);
//
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		 
//		return $data;
//	}
//	
//	
//	
//	
//	
//	
//	
//	// Busca todas as questoes digitadas Por determinado ADMIN com Detalhamento 
//    function DBRead_relatorio_questoes_por_adm($tipo_questao, $fk_idAdm){
//        
//        
//        $query = "SELECT 		    $tipo_questao.id$tipo_questao as id,
//	                                       $tipo_questao.fk_idAdm as fk_idAdm,
//		                                 $tipo_questao.fk_idBanca as fk_idBanca,
//           	                                           Banca.nome as nome_banca,
//                                         $tipo_questao.fk_idCurso as fk_idCurso,
//                                                       Curso.nome as nome_curso,
//                                       $tipo_questao.fk_idMateria as fk_idMateria,
//                                                     Materia.nome as nome_materia,
//                                          $tipo_questao.enunciado as enunciado,
//                                         $tipo_questao.updated_at as alterada_em
//                            FROM $tipo_questao 
//
//                            JOIN Banca
//                            	ON Banca.idBanca = $tipo_questao.fk_idBanca
//                            JOIN Curso
//                            	ON Curso.idCurso = $tipo_questao.fk_idCurso
//                            JOIN Materia
//                            	ON Materia.idMateria = $tipo_questao.fk_idMateria
//                            
//                            WHERE $tipo_questao.fk_idAdm like $fk_idAdm AND ativa like 1";
//        
//
//	    $result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//		// Busca todas as questoes digitadas Por determinado ADMIN com Detalhamento 
//    function DBRead_relatorio_questoes_inativas_por_adm($tipo_questao, $fk_idAdm){
//        
//        
//        $query = "SELECT 		    $tipo_questao.id$tipo_questao as id,
//	                                       $tipo_questao.fk_idAdm as fk_idAdm,
//		                                 $tipo_questao.fk_idBanca as fk_idBanca,
//           	                                           Banca.nome as nome_banca,
//                                         $tipo_questao.fk_idCurso as fk_idCurso,
//                                                       Curso.nome as nome_curso,
//                                       $tipo_questao.fk_idMateria as fk_idMateria,
//                                                     Materia.nome as nome_materia,
//                                          $tipo_questao.enunciado as enunciado,
//                                         $tipo_questao.updated_at as alterada_em          
//                            FROM $tipo_questao 
//
//                            JOIN Banca
//                            	ON Banca.idBanca = $tipo_questao.fk_idBanca
//                            JOIN Curso
//                            	ON Curso.idCurso = $tipo_questao.fk_idCurso
//                            JOIN Materia
//                            	ON Materia.idMateria = $tipo_questao.fk_idMateria
//                            
//                            WHERE $tipo_questao.fk_idAdm like $fk_idAdm AND ativa like 0";
//        
//
//	    $result = DBExecute ($query);
//
//		 
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	// Busca todas as questoes digitadas Por determinada BANCA com Detalhamento 
//    function DBRead_relatorio_questoes_por_criterio($tipo_questao, $filtro, $criterio){
//        
//        
//        $query = "SELECT 		    $tipo_questao.id$tipo_questao as id,
//	                                       $tipo_questao.fk_idAdm as fk_idAdm,
//		                                 $tipo_questao.fk_idBanca as fk_idBanca,
//           	                                           Banca.nome as nome_banca,
//                                         $tipo_questao.fk_idCurso as fk_idCurso,
//                                                       Curso.nome as nome_curso,
//                                       $tipo_questao.fk_idMateria as fk_idMateria,
//                                                     Materia.nome as nome_materia,
//                                          $tipo_questao.enunciado as enunciado          
//                            FROM $tipo_questao 
//
//                            JOIN Banca
//                            	ON Banca.idBanca = $tipo_questao.fk_idBanca
//                            JOIN Curso
//                            	ON Curso.idCurso = $tipo_questao.fk_idCurso
//                            JOIN Materia
//                            	ON Materia.idMateria = $tipo_questao.fk_idMateria
//                            
//                            WHERE $tipo_questao.$filtro like $criterio";
//        
//
//	    $result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	
//	// Conta todas as questoes separado por banca 
//    function DBRead_conta_questao_por_banca($tipo_questaom){
//        
//        
//        $query = "SELECT     $tipo_questaom.fk_idBanca as id, 
//                                              count(*) AS qtd, 
//                                            Banca.nome AS nome from $tipo_questaom
//                    JOIN Banca
//                        ON Banca.idBanca = $tipo_questaom.fk_idBanca
//                        
//                    group by $tipo_questaom.fk_idBanca";
//                    
//
//	    $result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	// Conta todas as questoes separado por CURSO/CARGO
//    function DBRead_conta_questao_por_curso($tipo_questaom){
//        
//        $query = "SELECT     $tipo_questaom.fk_idCurso as id, 
//                                              count(*) AS qtd, 
//                                            Curso.nome AS nome from $tipo_questaom
//                    JOIN Curso
//                        ON Curso.idCurso = $tipo_questaom.fk_idCurso
//                        
//                    group by $tipo_questaom.fk_idCurso";
//                    
//
//	    $result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	// Conta todas as questoes separado por MATERIA
//    function DBRead_conta_materia_por_tipo($tipo_questao){
//        
//        $query = "SELECT 		   $tipo_questao.fk_idMateria as fk_idMateria,
//			                                         count(*) AS qtd, 
//				                       $tipo_questao.fk_idAdm as fk_idAdm,
//				                     $tipo_questao.fk_idBanca as fk_idBanca,
//							                       Banca.nome as nome_banca,
//				                     $tipo_questao.fk_idCurso as fk_idCurso,
//							                       Curso.nome as nome_curso,
//							                     Materia.nome as nome_materia
//				  
//	                    FROM $tipo_questao 
//
//                    	JOIN Banca
//                    		ON Banca.idBanca = $tipo_questao.fk_idBanca
//                    	JOIN Curso
//                    		ON Curso.idCurso = $tipo_questao.fk_idCurso
//                    	JOIN Materia
//                    		ON Materia.idMateria = $tipo_questao.fk_idMateria
//                    	
//                    	group by $tipo_questao.fk_idMateria";
//                    
//
//	    $result = DBExecute ($query);
//
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	// Busca todas as questoes digitadas Por determinado Tipo com Detalhamento 
//    function DBRead_relatorio_questoes_no_sistema_por_tipo($tipo_questao){
//        
//        
//        $query = "SELECT 		    $tipo_questao.id$tipo_questao as id,
//	                                       $tipo_questao.fk_idAdm as fk_idAdm,
//	                                                     Adm.nome as nome_admin,
//		                                 $tipo_questao.fk_idBanca as fk_idBanca,
//           	                                           Banca.nome as nome_banca,
//                                         $tipo_questao.fk_idCurso as fk_idCurso,
//                                                       Curso.nome as nome_curso,
//                                       $tipo_questao.fk_idMateria as fk_idMateria,
//                                                     Materia.nome as nome_materia,
//                                          $tipo_questao.enunciado as enunciado,
//                                         $tipo_questao.created_at as data 
//                                          
//                            FROM $tipo_questao 
//
//                            JOIN Adm
//                            	ON Adm.idAdm = $tipo_questao.fk_idAdm
//                            JOIN Banca
//                            	ON Banca.idBanca = $tipo_questao.fk_idBanca
//                            JOIN Curso
//                            	ON Curso.idCurso = $tipo_questao.fk_idCurso
//                            JOIN Materia
//                            	ON Materia.idMateria = $tipo_questao.fk_idMateria";
//        
//
//	    $result = DBExecute ($query);
//
//		
//		if(!mysqli_num_rows($result))
//		    return false;
//		else{
//		    while($res = mysqli_fetch_assoc($result)){
//		        $data [] = $res;
//	        }
//	        return $data;
//		}
//		    
//	}
//	
//	
//	
//	
//	
//	
//	
//	
//	
//	
//	
//	
//	
//
//
//    
//    
//    
//    
//    
//    
//    
//    
//    
//    // Envia Email Pagamento
//    function Envia_email_pagamento(
//        $para, $name, $vl_pago, $qtd_pg, $type_questao, $tt_geral_inserido, $tt_geral_pago
//        ){ 
//        
//        
//        $headers = "From: " . strip_tags("objetivando@objetivando.com.br") . "\r\n";
//        $headers .= "Reply-To: ". strip_tags("contato@objetivando.com.br") . "\r\n";
//        $headers .= "MIME-Version: 1.0\r\n";
//        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        
//        
//        //RECEBENDO DADOS
//        $to = $para;
//        $nome = $name;
//        $valor_pago = $vl_pago;
//        $qtd_paga = $qtd_pg;
//        
//        $tipo_questao = $type_questao;
//        $total_geral_inserido = $tt_geral_inserido;
//        $total_geral_pago = $tt_geral_pago; // incluindo este pagamento
//        
//        
//        $pago_de = $total_geral_pago - $qtd_paga + 1;
//        
//        $saldo_pre = $total_geral_inserido - $total_geral_pago;
//        if($saldo_pre >= 0){
//            $saldo_final = '<td>' . $saldo_pre . '</td></tr>';
//        }else{
//            $saldo_final = '<td style="color: red;">' . $saldo_pre . '</td></tr>';
//        }
//        
//        $data = new DateTime();
//        $data = new DateTime('-3 hour');
//        $data_hora = $data->format('d-m-Y \à\s H:i:s');
//        
//        
//        $subject = 'Pagamento '. $data_hora;
//        
//        
//        $message  = '<html><body>';
//        $message .= '<h2>Olá, ' . $nome . '!</h2>';
//        $message .= '<p>Foi enviado hoje, <strong>' 
//                    . $data_hora . '</strong>, um pagamento de  <strong>R$' 
//                    . $valor_pago . '</strong> referente a <strong>' 
//                    . $qtd_paga . '</strong> questões inseridas em nosso sistema.</p>';
//        
//        $message  .= '<p><i>Agradeçemos a parceria.</i></p>';
//        $message  .= '<p><strong>Segue extrato:</strong></p>';
//        
//        $message .= '<table rules="all" style="border-color: #666;" cellpadding="8">';
//        $message .= "<tr style='background: #eee;'><td><strong>Usuário:</strong> </td><td>"                     . $nome . "</td></tr>";
//        $message .= "<tr><td><strong>   Total de " . $tipo_questao . " inseridas:</strong> </td><td>"           . $total_geral_inserido . "</td></tr>";
//        $message .= "<tr><td><strong>   Total de " . $tipo_questao . " pagos:</strong> </td><td>"               . $total_geral_pago . "</td></tr>";
//        $message .= "<tr><td><strong>   Este pagamento:</strong> </td><td>De "                                  . $pago_de . " até " . $total_geral_pago . "</td></tr>";
//        $message .= "<tr style='background: #eee;'><td><strong>Saldo:</strong> </td>"                           . $saldo_final;
//        $message .= "</table>";
//        
//        $message .= '<h2  style="color: #2d5986;">____________________</h2>';
//        $message .= '<h2  style="color: #2d5986;">Paulo Franco <br>Diretor Executivo</h2>';
//        $message .= '<h3  style="color: #2d5986;">(27) 9 8164-1870</h3>';
//        $message .= '<img src="https://www.objetivando.com.br/_ra/logo.png" alt="Logo" />';
//        $message .= "</body></html>";
//        
//        
//        if(mail($to, $subject, $message, $headers)){
//            return true;
//        }else{
//            return false;
//        }
//        
//        
//        
//        
//    }
//    
    
       
?>