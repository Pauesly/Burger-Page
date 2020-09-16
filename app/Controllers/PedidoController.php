<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Pedido;
use App\Models\ProdutoPedido;
use App\Models\Customer;
use App\Models\Endereco;
use App\Models\PaymentTerm;
use App\Models\OrderStatus;
use App\Models\Bcrypt;
use Core\Session;

class PedidoController extends BaseController
{
    
    private $dados;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    

    public function novo_pedido_plus($id){
        $admin  =  Session::get('adm');
        
        $this->view->tel = $id;
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/pedido/novo_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Novo Pedido - Area Restrita');
        $this->renderView('adm/pedido/novo_pedido', '/adm/adm_layout');
    }


    public function novo_pedido(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/pedido/novo_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Novo Pedido - Area Restrita');
        $this->renderView('adm/pedido/novo_pedido', '/adm/adm_layout');
    }
    
    
    
    public function busca_enderecos_de_cliente($request){
        $resultado = Customer::busca_enderecos_de_cliente($request->get->id);
        echo(json_encode($resultado));
    }
    
    
    public function abrir_pedido($request){
        $resultado = Pedido::abrir_pedido($request->get->fk_id_adm, $request->get->fk_id_customer, $request->get->fk_id_address);
        
        if($resultado->erro){
            $array = [
                "erro" => "true"];
            echo(json_encode($array));
        }else{
            $restt = OrderStatus::altera_status_pedido($request->get->fk_id_adm, $resultado->id_cadastro, 1);
            echo(json_encode($resultado));
        }
    }
    
    
    
    public function gerir_pedido($request){
        $admin  =  Session::get('adm');

        $this->view->id_pedido          = $request->post->id_pedido;
        $this->view->id_customer        = $request->post->id_customer;
        $this->view->endereco_entrega   = $request->post->endereco_entrega;
        
        $this->view->dados_pedido       = Pedido::busca_dados_pedido($request->post->id_pedido);
//        $this->view->product_order      = ProdutoPedido::busca_produtos_de_pedido($request->post->id_pedido);
        $this->view->endereco_entrega   = Endereco::busca_endereco_por_id($request->post->endereco_entrega);
        $this->view->formas_de_pagamento= PaymentTerm::busca_formas_de_pagamento();
        $this->view->status_pedido      = OrderStatus::busca_status_de_pedido($request->post->id_pedido);
        
//        var_dump($this->view->endereco_entrega); die;
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_css = '<link  href="/assets/css/bootstrap-select.css" rel="stylesheet" />';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap-select.js"></script>'
                              . '<script src="/assets/js/adm/pedido/gerir_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Gerir Pedido - Area Restrita');
        $this->renderView('adm/pedido/gerir_pedido', '/adm/adm_layout');
    }
    
    
    
    public function salva_pagamento_sim($request){
        $resultado = Pedido::salva_pagamento_sim($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    public function salva_pagamento_nao($request){
        $resultado = Pedido::salva_pagamento_nao($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    public function salva_obs($request){
        $resultado = Pedido::salva_obs($request->get->id_pedido, $request->get->txt_obs);
        echo(json_encode($resultado));
    }
    
    
    public function salva_forma_pagamento($request){
        $resultado = Pedido::salva_forma_pagamento($request->get->id_pedido, $request->get->id_forma_pagamento);
        echo(json_encode($resultado));
    }
    
    
    public function carrega_produtos_pedido($request){
        $resultado = ProdutoPedido::busca_produtos_de_pedido($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    
    
    
}