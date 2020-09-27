<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;
use App\Models\Produto;
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
        $this->setPageTitle('Home');
        $this->renderView('home/index', 'layout_main');
    }


    public function carregar_categorias(){
        $restultado = Categoria::relatorio_all_categorias_ativas();
        echo(json_encode($restultado));
    }
    
    
    public function carregar_cardapio(){
        $restultado_cardapio = Produto::busca_cardapio_site();
        echo(json_encode($restultado_cardapio));
    }
    
    
    
    
    
    
}