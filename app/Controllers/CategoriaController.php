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
    
     
COMECAR ACERTAR DAQUI.!!!!! JA COPIEI E COLEI DE ITEM. EDITAR TUDO PARA CATEGORIA
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
                              . '<script src="/assets/js/adm/item/add_item.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Item - Area Restrita');
        $this->renderView('adm/item/add_item', '/adm/adm_layout');
    }
    
    
    
    
    public function cadastrar_novo_item($request){
        
        $preco = str_replace(',', '', $request->post->cost); 
        
        $resultado = Item::cadastra_novo_item(
                $request->post->name,
                $request->post->description,
                $request->post->un,
                $preco,
                $request->post->picture
                );
        
        if($resultado->erro){
            return Redirect::route('/gestao_item', [
                'errors' => ['Erro 002 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_item', [
                'success' => ["Item [  $resultado->id_cadastro ] cadastrado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_item($request){
        $admin  =  Session::get('adm');
        
        $dados_item = Item::busca_item_com_id($request->get->id);
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
                              . '<script src="/assets/js/adm/item/edit_item.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Editar Item - Area Restrita');
        $this->renderView('adm/item/edit_item', '/adm/adm_layout');
    }
    

    
    
    public function salvar_edit_item($request){
        
        $preco = str_replace(',', '', $request->post->cost); 
        
        $resultado = Item::altera_item(
                $request->post->id_item,
                $request->post->active,
                $request->post->name,
                $request->post->description,
                $request->post->un,
                $preco,
                $request->post->picture
                );
        
//                var_dump($resultado);die;
        
        if($resultado == 0){
            return Redirect::route('/gestao_item', [
                'errors' => ['Erro 002 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/gestao_item', [
                'success' => ["Item alterado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}