<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\FormaPagamento;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class FormaPagamentoController extends BaseController
{
    
    private $dados;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function gestao_forma_pagamento(){
        $admin  =  Session::get('adm');
        
        //Conteudo do corpo
        $resultado = FormaPagamento::relatorio_all_forma_pagamento();
                
        $total_ativa = 0;
        $total_inativa = 0;
        foreach ($resultado->resultado as $value) {
            if($value->active == 1)
                $total_ativa++;
            if($value->active == 0)
                $total_inativa++;
        }
        
        $this->view->total_ativa = $total_ativa;
        $this->view->total_inativa = $total_inativa;
        
        

        if($resultado->erro == false){
            $this->view->existe = true;
            $this->view->conteudo_tabela = $resultado->resultado;
        }else{
            $this->view->existe = false;
        }
        
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<link rel="stylesheet" type="text/css" href="assets/js/data_table/datatables.css"/>'
                              . '<script type="text/javascript" src="assets/js/data_table/datatables.js"></script>'
                              . '<script type="text/javascript" src="assets/js/adm/forma_pagamento/gestao_forma_pagamento.js"></script>';
        
        $this->setPageTitle('Gestao de Forma de Pagamento - Area Restrita');
        $this->renderView('adm/forma_pagamento/gestao_forma_pagamento', '/adm/adm_layout');
    }
    
     

    public function add_forma_pagamento(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/forma_pagamento/add_forma_pagamento.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Forma Pagamento - Area Restrita');
        $this->renderView('adm/forma_pagamento/add_forma_pagamento', '/adm/adm_layout');
    }
    
    
    
    
    public function cadastrar_nova_forma_pagamento($request){
        
        $resultado = FormaPagamento::cadastra_nova_forma_pagamento(
                $request->post->name
                );
        
        if($resultado->erro){
            return Redirect::route('/gestao_forma_pagamento', [
                'errors' => ['Erro 005 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_forma_pagamento', [
                'success' => ["Status [  $resultado->id_cadastro ] cadastrado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_forma_pagamento($request){
        $admin  =  Session::get('adm');
        
        $dados_item = FormaPagamento::busca_forma_pagamento_com_id($request->get->id);
//        $dados_adm = json_decode($dados_customer);
        
        $this->view->dados = $dados_item->resultado[0];
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/forma_pagamento/edit_forma_pagamento.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Editar Forma de Pagamento - Area Restrita');
        $this->renderView('adm/forma_pagamento/edit_forma_pagamento', '/adm/adm_layout');
    }
    

    
    
    public function salvar_edit_forma_pagamento($request){
        
        
        $resultado = FormaPagamento::altera_forma_pagamento(
                $request->post->id_payment_term,
                $request->post->active,
                $request->post->name
                );
        
//                var_dump($resultado);die;
        
        if($resultado == 0){
            return Redirect::route('/gestao_forma_pagamento', [
                'errors' => ['Erro 002 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_forma_pagamento', [
                'success' => ["Status alterado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}