<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Relatorio;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Customer;
use App\Models\Padroes_gerais;
use App\Models\ProdutoPedido;
use App\Models\Bcrypt;
use Core\Session;

class RelatorioController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    

    public function relatorios_home(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_css = '<link  href="/assets/css/bootstrap-select.css" rel="stylesheet" />';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap-select.js"></script>'
                              . '<script src="/assets/js/date_picker.js" crossorigin="anonymous"></script>'
                              . '<link rel="stylesheet" type="text/css" href="assets/css/date_picker.css"/>'
                              . '<script src="/assets/js/adm/relatorio/relatorio_home.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Relatorios - Area Restrita');
        $this->renderView('adm/relatorio/relatorios_home', '/adm/adm_layout');
    }
    
    
    public function relatorio_full($request){
        
        $pedidos = Relatorio::relatorio_full($request->get->inicial, $request->get->final);
        
        $qtd_pedidos = 0;
        $valor_pedidos = 0;
        if($pedidos->erro == false){
            for($i=0; $i < sizeof($pedidos->resultado); $i++ ){
                $qtd_pedidos++;

                $conta_total = ProdutoPedido::busca_produtos_de_pedido($pedidos->resultado[$i]->id_order);
                
                $tot = 0;
                if($conta_total->erro == false){
                    for($j = 0; $j < sizeof($conta_total->resultado); $j++){
                        $tot = $tot + $conta_total->resultado[$j]->price_total;
                    }
                }
                $pedidos->resultado[$i]->total_pedido = $tot;
                $valor_pedidos = $valor_pedidos + $tot;
            }
        }
        
        $this->view->pedidos = $pedidos;
        $this->view->qtd_pedidos = $qtd_pedidos;
        $this->view->valor_pedidos = number_format($valor_pedidos, 2, '.', '');
   
        $this->view->periodo = $request->get->inicial . " - " . $request->get->final;
         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->setPageTitle('Relatorio completo');
        $this->renderView('adm/relatorio/full', '/adm/adm_layout_relatorio');
    }
    
    
    public function relatorio_parcial($request){
       /**
        * PALAVRAS CHAVE FILTROS
        * cliente_vezes - Cliente que comprou mais vezes
        * cliente_valor - Cliente que mais comprou
        * vendas_custo - Produtos X Custos
        * produto_abc - Curva ABC Produtos
        * cliente - Compras porcliente
        * produto - Compras por produto
        * categoria - Compras por categoria
        * municipio - Compras por municipio
        * cidade - Compras por cidade
        * pagamento - compras por forma de pagamento
        */
        
        
        switch ($request->get->func) {
        
            //Cliente que comprou mais vezes
            case "cliente_vezes":
                $titulo_pagina = "Relatório CLientes X Compras";
                $caminho_layout = 'adm/relatorio/cliente_vezes';
                $this->view->pedidos = Relatorio::relatorio_cliente_vezes($request->get->data_inicio, $request->get->data_fim);
            break;

            //Cliente que mais comprou
            case "cliente_valor":
                $titulo_pagina = "Relatório CLientes X Compras";
                $caminho_layout = 'adm/relatorio/cliente_valor';
                $this->view->pedidos = Relatorio::relatorio_cliente_valor($request->get->data_inicio, $request->get->data_fim);
            break;
        
            //Produtos X Custos
            case "vendas_custo":
                $titulo_pagina = "Relatório Vendas X Custo";
                $caminho_layout = 'adm/relatorio/vendas_custo';
                $rel_main = Relatorio::relatorio_vendas_custo($request->get->data_inicio, $request->get->data_fim);
                $custos = Produto::calcula_custos_produtos();
                
                $venda_periodo = 0;
                $custo_periodo = 0;
                $lucro_periodo = 0;
                if($rel_main->erro == false){
                    for($i=0; $i < sizeof($rel_main->resultado); $i++){
                        $rel_main->resultado[$i]->media_unit = Padroes_gerais::ValorDoisDigitos($rel_main->resultado[$i]->valor / $rel_main->resultado[$i]->qtd);
                        $rel_main->resultado[$i]->custo = 0;
                        
                        if($custos->erro == false){
                            for($j=0; $j <sizeof($custos->resultado); $j++){
                                if($rel_main->resultado[$i]->id_product == $custos->resultado[$j]->id_prod){
                                    $rel_main->resultado[$i]->custo = $custos->resultado[$j]->custo;
                                }
                            }
                        }
                        
                        $venda = $rel_main->resultado[$i]->valor;
                        $custo = $rel_main->resultado[$i]->custo * $rel_main->resultado[$i]->qtd;
                        $lucro = Padroes_gerais::ValorDoisDigitos($venda - $custo);
                        $rel_main->resultado[$i]->lucro = $lucro;
                        
                        $custo_periodo = $custo_periodo + $custo;
                        $venda_periodo = Padroes_gerais::ValorDoisDigitos($venda_periodo + $venda);
                        $lucro_periodo = Padroes_gerais::ValorDoisDigitos($lucro_periodo + $lucro);
                    }
                }
                $this->view->pedidos = $rel_main;
                $this->view->vendas_periodo = $venda_periodo;
                $this->view->custo_periodo = Padroes_gerais::ValorDoisDigitos($custo_periodo);
                $this->view->lucro_periodo = $lucro_periodo;
                
//                var_dump($this->view->pedidos); die;
            break;
        
            //Curva ABC Produtos
            case "produto_abc":
                $this->view->pedidos = Relatorio::relatorio_produto_abc($request->get->data_inicio, $request->get->data_fim);
                $titulo_pagina = "Relatório Produto ABC";
                $caminho_layout = 'adm/relatorio/produto_abc';
            break;
        
            //Compras porcliente
            case "cliente":
                $compras_cliente = Relatorio::relatorio_cliente($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                
                if($compras_cliente->erro == false){
                    $totais = Relatorio::relatorio_cliente_soma_pedidos($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                    
                    for($i=0; $i < sizeof($compras_cliente->resultado); $i++){
                        for($j=0; $j < sizeof($totais->resultado); $j++){
                            
                            if($compras_cliente->resultado[$i]->id_order == $totais->resultado[$j]->id_order){
                                $compras_cliente->resultado[$i]->total_order = $totais->resultado[$j]->valor;
                            }
                            
                        }
                    }
                }
                
//                var_dump($totais); die;
                $this->view->pedidos = $compras_cliente;
                $titulo_pagina = "Relatório Compras Por Cliente";
                $caminho_layout = 'adm/relatorio/cliente';
            break;
        
            //Compras por produto
            case "produto":
                $compras_produto = Relatorio::relatorio_produto($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                
                $qtd = 0;
                $vlr = 0;
                
                if($compras_produto->erro == false){
                    for($i=0; $i < sizeof($compras_produto->resultado);  $i++){
                        $qtd = $qtd + $compras_produto->resultado[$i]->qtd;
                        $vlr = $vlr + $compras_produto->resultado[$i]->valor;
                    }
                }
                
                $this->view->qtd_total = $qtd;
                $this->view->valor_total = Padroes_gerais::ValorDoisDigitos($vlr);
                
//                var_dump($totais); die;
                $this->view->pedidos = $compras_produto;
                $titulo_pagina = "Relatório Vendas por Produto";
                $caminho_layout = 'adm/relatorio/produto';
            break;
        
            //Compras por categoria
            case "categoria":
                $compras_produto = Relatorio::relatorio_categoria($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                
                $qtd = 0;
                $vlr = 0;
                
                if($compras_produto->erro == false){
                    for($i=0; $i < sizeof($compras_produto->resultado);  $i++){
                        $qtd = $qtd + $compras_produto->resultado[$i]->qtd;
                        $vlr = $vlr + $compras_produto->resultado[$i]->valor;
                    }
                }
                
                $this->view->qtd_total = $qtd;
                $this->view->valor_total = Padroes_gerais::ValorDoisDigitos($vlr);
                
//                var_dump($totais); die;
                $this->view->pedidos = $compras_produto;
                $titulo_pagina = "Relatório Vendas por Categoria";
                $caminho_layout = 'adm/relatorio/categoria';
            break;
        
            //Compras por municipio
            case "municipio":
                echo "municipio;"; die;
                if($request->get->param == "0"){
                    $compras_produto = Relatorio::relatorio_municipio_all($request->get->data_inicio, $request->get->data_fim);
                    $this->view->bairro = "Todos";
                }else{
                    $compras_produto = Relatorio::relatorio_municipio($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                    $this->view->bairro = $this->view->pedidos->resultado[0]->bairro;
                }

                $qtd = 0;
                $vlr = 0;
                
                if($compras_produto->erro == false){
                    for($i=0; $i < sizeof($compras_produto->resultado);  $i++){
                        $qtd = $qtd + $compras_produto->resultado[$i]->qtd;
                        $vlr = $vlr + $compras_produto->resultado[$i]->valor;
                    }
                }
                
                $this->view->qtd_total = $qtd;
                $this->view->valor_total = Padroes_gerais::ValorDoisDigitos($vlr);
                
                
                
                
//                var_dump($compras_produto); die;
                $this->view->pedidos = $compras_produto;
                $titulo_pagina = "Relatório Vendas por Municipio";
                $caminho_layout = 'adm/relatorio/municipio';
            break;
        
            //Compras por cidade
            case "cidade":
                echo "cidade;"; die;
            break;
        
            //compras por forma de pagamento
            case "pagamento":
                if($request->get->param == "0"){
                    $compras_produto = Relatorio::relatorio_pagamento_all($request->get->data_inicio, $request->get->data_fim);
                    $this->view->bairro = "Todos";
                }else{
                    $compras_produto = Relatorio::relatorio_pagamento($request->get->data_inicio, $request->get->data_fim, $request->get->param);
                    $this->view->bairro = $this->view->pedidos->resultado[0]->bairro;
                }

                $qtd = 0;
                $vlr = 0;
                
                if($compras_produto->erro == false){
                    for($i=0; $i < sizeof($compras_produto->resultado);  $i++){
                        $qtd = $qtd + $compras_produto->resultado[$i]->qtd;
                        $vlr = $vlr + $compras_produto->resultado[$i]->valor;
                    }
                }
                
                $this->view->qtd_total = $qtd;
                $this->view->valor_total = Padroes_gerais::ValorDoisDigitos($vlr);
                
                
                
//                var_dump($compras_produto); die;
                $this->view->pedidos = $compras_produto;
                $titulo_pagina = "Relatório Vendas por Forma de Pagamento";
                $caminho_layout = 'adm/relatorio/pagamento';
            break;
        
        
            default:
            break;
       }// fim Switch
       

        $this->view->periodo = $request->get->data_inicio . " - " . $request->get->data_fim;
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->setPageTitle($titulo_pagina);
        $this->renderView($caminho_layout, '/adm/adm_layout_relatorio');
       
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}