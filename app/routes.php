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
$route[] = ['/busca_cliente_por_telefone',      'CustomerController@busca_cliente_por_telefone',        'auth'];
$route[] = ['/salva_edit_endereco',             'CustomerController@salva_edit_endereco',               'auth'];

//ITENS
$route[] = ['/gestao_item',             'ItemController@gestao_item',               'auth'];
$route[] = ['/add_item',                'ItemController@add_item',                  'auth'];
$route[] = ['/cadastrar_novo_item',     'ItemController@cadastrar_novo_item',       'auth'];
$route[] = ['/edit_item',               'ItemController@edit_item',                 'auth'];
$route[] = ['/salvar_edit_item',        'ItemController@salvar_edit_item',          'auth'];

//CATEGORIAS
$route[] = ['/gestao_categoria',                'CategoriaController@gestao_categoria',          'auth'];
$route[] = ['/add_categoria',                   'CategoriaController@add_categoria',             'auth'];
$route[] = ['/cadastrar_nova_categoria',        'CategoriaController@cadastrar_nova_categoria',  'auth'];
$route[] = ['/edit_categoria',                  'CategoriaController@edit_categoria',            'auth'];
$route[] = ['/salvar_edit_categoria',           'CategoriaController@salvar_edit_categoria',     'auth'];

//PRODUTO
$route[] = ['/gestao_produto',                      'produtoController@gestao_produto',                 'auth'];
$route[] = ['/add_produto',                         'produtoController@add_produto',                    'auth'];
$route[] = ['/cadastrar_novo_produto',              'produtoController@cadastrar_novo_produto',         'auth'];
$route[] = ['/edit_produto',                        'produtoController@edit_produto',                   'auth'];
$route[] = ['/salva_edit_produto',                  'produtoController@salva_edit_produto',             'auth'];
$route[] = ['/busca_itens_produto',                 'produtoController@busca_itens_produto',            'auth'];
$route[] = ['/add_item_produto',                    'produtoController@add_item_produto',               'auth'];
$route[] = ['/remove_item_produto',                 'produtoController@remove_item_produto',            'auth'];

$route[] = ['/menuonline',                          'HomeController@index'];


// STATUS
$route[] = ['/gestao_status',               'StatusController@gestao_status',               'auth'];
$route[] = ['/add_status',                  'StatusController@add_status',                  'auth'];
$route[] = ['/cadastrar_novo_status',       'StatusController@cadastrar_novo_status',       'auth'];
$route[] = ['/edit_status',                 'StatusController@edit_status',                 'auth'];
$route[] = ['/salvar_edit_status',          'StatusController@salvar_edit_status',          'auth'];


// STATUS
$route[] = ['/gestao_forma_pagamento',               'FormaPagamentoController@gestao_forma_pagamento',               'auth'];
$route[] = ['/add_forma_pagamento',                  'FormaPagamentoController@add_forma_pagamento',                  'auth'];
$route[] = ['/cadastrar_nova_forma_pagamento',       'FormaPagamentoController@cadastrar_nova_forma_pagamento',       'auth'];
$route[] = ['/edit_forma_pagamento',                 'FormaPagamentoController@edit_forma_pagamento',                 'auth'];
$route[] = ['/salvar_edit_forma_pagamento',          'FormaPagamentoController@salvar_edit_forma_pagamento',          'auth'];


// STATUS
$route[] = ['/gestao_testemunho',               'TestemunhoController@gestao_testemunho',                       'auth'];
$route[] = ['/add_testemunho',                  'TestemunhoController@add_testemunho',                          'auth'];
$route[] = ['/cadastrar_novo_testemunho',       'TestemunhoController@cadastrar_novo_testemunho',               'auth'];
$route[] = ['/edit_testemunho',                 'TestemunhoController@edit_testemunho',                         'auth'];
$route[] = ['/salvar_edit_testemunho',          'TestemunhoController@salvar_edit_testemunho',                  'auth'];


//PEDIDO
$route[] = ['/novo_pedido',                         'PedidoController@novo_pedido',                                 'auth'];
$route[] = ['/novo_pedido_plus/{id}',               'PedidoController@novo_pedido_plus',                            'auth'];
$route[] = ['/busca_enderecos_de_cliente',          'PedidoController@busca_enderecos_de_cliente',                  'auth'];
$route[] = ['/abrir_pedido',                        'PedidoController@abrir_pedido',                                'auth'];
$route[] = ['/gerir_pedido',                        'PedidoController@gerir_pedido',                                'auth'];
$route[] = ['/salva_pagamento_sim',                 'PedidoController@salva_pagamento_sim',                         'auth'];
$route[] = ['/salva_pagamento_nao',                 'PedidoController@salva_pagamento_nao',                         'auth'];
$route[] = ['/salva_obs',                           'PedidoController@salva_obs',                                   'auth'];
$route[] = ['/salva_forma_pagamento',               'PedidoController@salva_forma_pagamento',                       'auth'];
$route[] = ['/salva_status_pedido',                 'PedidoController@salva_status_pedido',                         'auth'];
$route[] = ['/carrega_produtos_pedido',             'PedidoController@carrega_produtos_pedido',                     'auth'];
$route[] = ['/carrega_historico_status_pedido',     'PedidoController@carrega_historico_status_pedido',             'auth'];
$route[] = ['/add_produto_pedido',                  'PedidoController@add_produto_pedido',                          'auth'];
$route[] = ['/remove_produto_pedido',               'PedidoController@remove_produto_pedido',                       'auth'];
$route[] = ['/apagar_pedido',                       'PedidoController@apagar_pedido',                               'auth'];

$route[] = ['/consultar_pedidos',                   'PedidoController@consultar_pedidos',                           'auth'];





return $route;