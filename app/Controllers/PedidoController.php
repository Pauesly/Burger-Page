<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Pedido;
use App\Models\Customer;
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}