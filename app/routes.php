<?php

// AQUI VAO TODAS AS ROTAS DO SISTEMA
//OBS: Fazer os controlers de cada Rota



//Home - Pagina Inicial
$route[] = ['/',            'HomeController@index'];


$route[] = ['/adm',                     'AdmController@loginAdm'];
$route[] = ['/login',                   'AdmController@loginAdm'];
$route[] = ['/login/valida_login',      'AdmController@validarLogin'];
$route[] = ['/logout',                  'AdmController@logout'];


//ADM
$route[] = ['/adm_index',               'AdmController@index',                  'auth'];


//CUSTOMER
$route[] = ['/add_customer',            'CustomerController@add_customer',                  'auth'];



return $route;