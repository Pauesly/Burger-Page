<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Testemunho;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class TestemunhoController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function gestao_testemunho(){
        $admin  =  Session::get('adm');
        
        //Conteudo do corpo
        $resultado = Testemunho::relatorio_all_testemunho();
                
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
                              . '<script type="text/javascript" src="assets/js/adm/testemunho/gestao_testemunho.js"></script>';
        
        $this->setPageTitle('Gestao de Testemunhos - Area Restrita');
        $this->renderView('adm/testemunho/gestao_testemunho', '/adm/adm_layout');
    }
    
     

    public function add_testemunho(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/testemunho/add_testemunho.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Testemunho - Area Restrita');
        $this->renderView('adm/testemunho/add_testemunho', '/adm/adm_layout');
    }
    
    
    
    
    public function cadastrar_novo_testemunho($request){

        $resultado = Testemunho::cadastrar_novo_testemunho(
                $request->post->name,
                $request->post->testimony,
                $request->post->status,
                $request->post->thumb
                );
        
        if($resultado->erro){
            return Redirect::route('/gestao_testemunho', [
                'errors' => ['Erro 005 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_testemunho', [
                'success' => ["Status [  $resultado->id_cadastro ] cadastrado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_testemunho($request){
        $admin  =  Session::get('adm');
        
        $dados_item = Testemunho::busca_testemunho_com_id($request->get->id);
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
                              . '<script src="/assets/js/adm/testemunho/edit_testemunho.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Editar Testemunho - Area Restrita');
        $this->renderView('adm/testemunho/edit_testemunho', '/adm/adm_layout');
    }
    

    
    
    public function salvar_edit_testemunho($request){
        
        
        $resultado = Testemunho::altera_testemunho(
                $request->post->id_testimony,
                $request->post->active,
                $request->post->name,
                $request->post->testimony,
                $request->post->status,
                $request->post->thumb
                );
        
//                var_dump($resultado);die;
        
        if($resultado == 0){
            return Redirect::route('/gestao_testemunho', [
                'errors' => ['Erro 002 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_testemunho', [
                'success' => ["Testemunho alterado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}