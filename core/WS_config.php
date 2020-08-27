<?php

    $teste = false;

    if($teste){
        
        //Banco de TESTES
        define('DB_HOSTNAME', 'sql185.main-hosting.eu');
    	define('DB_USERNAME', 'u620166704_teste');
    	define('DB_PASSWORD', 'PwobjetProjeto2020');
    	define('DB_DATABASE', 'u620166704_teste');
    	define('DB_PREFIX', 'cw');
    	define('DB_CHARSET', 'utf8');
    	
    }else{
        
        //Banco OFICIAL
        define('DB_HOSTNAME', 'sql185.main-hosting.eu');
    	define('DB_USERNAME', 'u620166704_jg_grill_2020');
    	define('DB_PASSWORD', 'Projetojazzgrill20');
    	define('DB_DATABASE', 'u620166704_jazz_grill_100');
    	define('DB_PREFIX', 'cw');
    	define('DB_CHARSET', 'utf8');
    
        
    }


	

?>