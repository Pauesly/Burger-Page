<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class ProdutoController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    
    public function gestao_produto(){
        $admin  =  Session::get('adm');
        
        //Conteudo do corpo
        $resultado = Produto::relatorio_all_produtos();
        
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
                              . '<script type="text/javascript" src="assets/js/adm/produto/gestao_produto.js"></script>';
        
        $this->setPageTitle('Gestao de Produtos - Area Restrita');
        $this->renderView('adm/produto/gestao_produto', '/adm/adm_layout');
    }
    
     

    public function add_produto(){
        $admin  =  Session::get('adm');
        
        $categorias = Categoria::relatorio_all_categorias_ativas();
        
        $this->view->categorias = $categorias->resultado;
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_css = '<link  href="/assets/css/bootstrap-select.css" rel="stylesheet" />';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap-select.js"></script>'
                              . '<script src="/assets/js/adm/produto/add_produto.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Produto - Area Restrita');
        $this->renderView('adm/produto/add_produto', '/adm/adm_layout');
    }
    
    
    
    
    public function cadastrar_novo_produto($request){
        
        
        var_dump($request); die;
        
        
        
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