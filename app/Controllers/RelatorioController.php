<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Relatorio;
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
//         var_dump($pedidos); die;
        
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
        * cliente_vezes
        * cliente_valor
        * vendas_custo
        * produto_abc
        * cliente
        * produto
        * categoria
        * municipio
        * cidade
        * pagamento
        */
        var_dump($request);
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}