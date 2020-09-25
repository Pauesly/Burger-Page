<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Status;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class StatusController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function gestao_status(){
        $admin  =  Session::get('adm');
        
        //Conteudo do corpo
        $resultado = Status::relatorio_all_status();
                
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
                              . '<script type="text/javascript" src="assets/js/adm/status/gestao_status.js"></script>';
        
        $this->setPageTitle('Gestao de Status - Area Restrita');
        $this->renderView('adm/status/gestao_status', '/adm/adm_layout');
    }
    
     

    public function add_status(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/status/add_status.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Status - Area Restrita');
        $this->renderView('adm/status/add_status', '/adm/adm_layout');
    }
    
    
    
    
    public function cadastrar_novo_status($request){
        
        $preco = str_replace(',', '', $request->post->cost); 
        
        $resultado = Status::cadastra_novo_status(
                $request->post->name,
                $request->post->sequence,
                $request->post->color_code
                );
        
        if($resultado->erro){
            return Redirect::route('/gestao_status', [
                'errors' => ['Erro 005 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_status', [
                'success' => ["Status [  $resultado->id_cadastro ] cadastrado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_status($request){
        $admin  =  Session::get('adm');
        
        $dados_item = Status::busca_status_com_id($request->get->id);
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
                              . '<script src="/assets/js/adm/status/edit_status.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Editar Status - Area Restrita');
        $this->renderView('adm/status/edit_status', '/adm/adm_layout');
    }
    

    
    
    public function salvar_edit_status($request){
        
        
        $resultado = Status::altera_status(
                $request->post->id_status,
                $request->post->active,
                $request->post->name,
                $request->post->sequence,
                $request->post->color_code
                );
        
//                var_dump($resultado);die;
        
        if($resultado == 0){
            return Redirect::route('/gestao_status', [
                'errors' => ['Erro 002 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_status', [
                'success' => ["Status alterado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}