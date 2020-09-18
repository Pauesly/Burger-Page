<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;
use App\Models\Categoria;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class CategoriaController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function gestao_categoria(){
        $admin  =  Session::get('adm');
        
        //Conteudo do corpo
        $resultado = Categoria::relatorio_all_categorias();
                
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
                              . '<script type="text/javascript" src="assets/js/adm/categoria/gestao_categoria.js"></script>';
        
        $this->setPageTitle('Gestao de Categorias - Area Restrita');
        $this->renderView('adm/categoria/gestao_categoria', '/adm/adm_layout');
    }
    
     

    public function add_categoria(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/categoria/add_categoria.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Categoria - Area Restrita');
        $this->renderView('adm/categoria/add_categoria', '/adm/adm_layout');
    }
    
    
    public function cadastrar_nova_categoria($request){
        
        $resultado = Categoria::cadastrar_nova_categoria(
                $request->post->description,
                $request->post->sequence
                );
        
        if($resultado->erro){
            return Redirect::route('/gestao_categoria', [
                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_categoria', [
                'success' => ["Categoria [  $resultado->id_cadastro ] cadastrada com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_categoria($request){
        $admin  =  Session::get('adm');
        
        $dados_item = Categoria::busca_categoria_com_id($request->get->id);
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
                              . '<script src="/assets/js/adm/categoria/edit_categoria.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Editar Categoria - Area Restrita');
        $this->renderView('adm/categoria/edit_categoria', '/adm/adm_layout');
    }
    

    
    public function salvar_edit_categoria($request){
        
        $resultado = Categoria::altera_categoria(
                $request->post->id_category,
                $request->post->active,
                $request->post->description,
                $request->post->sequence
                );

        if($resultado == 0){
            return Redirect::route('/gestao_categoria', [
                'errors' => ['Erro 004 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_categoria', [
                'success' => ["Categoria alterado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}