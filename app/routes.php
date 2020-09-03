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
$route[] = ['/add_customer',                    'CustomerController@add_customer',                      'auth'];
$route[] = ['/valida_telefone_unico',           'CustomerController@valida_telefone_unico',             'auth'];
$route[] = ['/cadastrar_novo_cliente',          'CustomerController@cadastrar_novo_cliente',            'auth'];
$route[] = ['/consultar_customer',              'CustomerController@consultar_customer',                'auth'];
$route[] = ['/edit_customer',                   'CustomerController@edit_customer',                     'auth'];
$route[] = ['/salva_editar_cliente',            'CustomerController@salva_editar_cliente',              'auth'];

//ITENS
$route[] = ['/gestao_item',             'ItemController@gestao_item',               'auth'];
$route[] = ['/add_item',                'ItemController@add_item',                  'auth'];
$route[] = ['/cadastrar_novo_item',     'ItemController@cadastrar_novo_item',       'auth'];
$route[] = ['/edit_item',               'ItemController@edit_item',                 'auth'];
$route[] = ['/salvar_edit_item',        'ItemController@salvar_edit_item',          'auth'];

//CATEGORIAS
$route[] = ['/gestao_categoria',                'CategoriaController@gestao_categoria',          'auth'];
$route[] = ['/add_categoria',                   'CategoriaController@add_categoria',             'auth'];
$route[] = ['/add_categoria',                   'CategoriaController@add_categoria',             'auth'];
$route[] = ['/cadastrar_nova_categoria',        'CategoriaController@cadastrar_nova_categoria',  'auth'];
$route[] = ['/edit_categoria',                  'CategoriaController@edit_categoria',            'auth'];
$route[] = ['/salvar_edit_categoria',           'CategoriaController@salvar_edit_categoria',     'auth'];

//PRODUTO
$route[] = ['/gestao_produto',                      'produtoController@gestao_produto',                 'auth'];
$route[] = ['/add_produto',                         'produtoController@add_produto',                    'auth'];
$route[] = ['/cadastrar_novo_produto',              'produtoController@cadastrar_novo_produto',         'auth'];








return $route;