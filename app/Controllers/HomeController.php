<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;
use App\Models\Produto;
use App\Models\Testemunho;
use App\Models\Padroes_gerais;
use App\Models\Categoria;

class HomeController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    
    
    public function index(){
        
        $this->view->url = Padroes_gerais::ulr();
        
        $this->view->categorias = Categoria::relatorio_all_categorias_ativas();
        $this->view->produtos = Produto::busca_cardapio_site();
        
        $this->view->testemunhos = Testemunho::testemunhos_to_page();
        
        $this->setPageTitle('Home');
        $this->renderView('home/index', 'layout_main');
    }

    public function get_image($id){
        $restultado = Produto::busca_imagem_com_id($id);
        
        echo(json_encode($restultado->resultado[0]->picture_thumb));
    }
    

    public function carregar_categorias(){
        $restultado = Categoria::relatorio_all_categorias_ativas();
        echo(json_encode($restultado));
    }
    
    
    public function carregar_cardapio(){
        $restultado_cardapio = Produto::busca_cardapio_site();
        echo(json_encode($restultado_cardapio));
    }
    
    public function subscribe($request){
        
    }
    
    
    
    
}