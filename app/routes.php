<?php

// AQUI VAO TODAS AS ROTAS DO SISTEMA
//OBS: Fazer os controlers de cada Rota



//Home - Pagina Inicial
$route[] = ['/',            'HomeController@index'];


$route[] = ['/adm',         'AdmController@loginAdm'];






return $route;