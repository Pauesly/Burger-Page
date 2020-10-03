<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class RelatorioController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    

    public function relatorios_home(){
        $admin  =  Session::get('adm');
        
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
                              . '<script src="/assets/js/date_picker.js" crossorigin="anonymous"></script>'
                              . '<link rel="stylesheet" type="text/css" href="assets/css/date_picker.css"/>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/relatorio/relatorio_home.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Relatorios - Area Restrita');
        $this->renderView('adm/relatorio/relatorios_home', '/adm/adm_layout');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}