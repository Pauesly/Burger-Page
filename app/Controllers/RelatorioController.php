<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Relatorio;
use App\Models\Pedido;
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
                $this->view->periodo = $request->get->data_inicio . " - " . $request->get->data_fim;
                $this->view->pedidos = Relatorio::relatorio_cliente_vezes($request->get->data_inicio, $request->get->data_fim);
            break;

            //Cliente que mais comprou
            case "cliente_valor":
                $titulo_pagina = "Relatório CLientes X Compras";
                $caminho_layout = 'adm/relatorio/cliente_valor';
                $this->view->periodo = $request->get->data_inicio . " - " . $request->get->data_fim;
                
                $this->view->pedidos = Relatorio::relatorio_cliente_valor($request->get->data_inicio, $request->get->data_fim);
                
                if($this->view->pedidos->erro == false){
                    for($i=0; $i < sizeof($this->view->pedidos->resultado); $i++){
                        
                        $pedidos_do_cliente = "";
                        $pedidos_do_cliente = Pedido::busca_dados_pedido($this->view->pedidos->resultado[$i]->id_order);
                        
                        if($pedidos_do_cliente->erro == false){
                            $tot = 0;
                            for($j=0; $j < sizeof($pedidos_do_cliente->resultado); $j++){
                                $tot_each = ProdutoPedido::busca_total_pedido($pedidos_do_cliente->resultado[$j]->id_order);
                                $tot = $tot + $tot_each->resultado[0]->total;
                            }
                            $this->view->pedidos->resultado[$i]->total_pedido = $tot;
                        }
                        
                        
                        
                        
                        
//                        $busq = ProdutoPedido::busca_total_pedido($this->view->pedidos->resultado[$i]->id_order);
//                        var_dump($busq->resultado[0]->total); die;
                        
                    }
                }
                
//                var_dump($this->view->pedidos); die;
                
                
//                var_dump($this->view->pedidos) ;
//                die;
            break;
        
            //Produtos X Custos
            case "vendas_custo":
                echo "vendas_custo;";
            break;
        
            //Curva ABC Produtos
            case "produto_abc":
                echo "produto_abc;";
            break;
        
            //Compras porcliente
            case "cliente":
                echo "cliente;";
            break;
        
            //Compras por produto
            case "produto":
                echo "produto;";
            break;
        
            //Compras por categoria
            case "categoria":
                echo "categoria;";
            break;
        
            //Compras por municipio
            case "municipio":
                echo "municipio;";
            break;
        
            //Compras por cidade
            case "cidade":
                echo "cidade;";
            break;
        
            //compras por forma de pagamento
            case "pagamento":
                echo "pagamento;";
            break;
        
        
            default:
            break;
       }// fim Switch
       

   

         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->setPageTitle($titulo_pagina);
        $this->renderView($caminho_layout, '/adm/adm_layout_relatorio');
       
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}