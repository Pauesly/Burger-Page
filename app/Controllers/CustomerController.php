<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;
use App\Models\Adm;
use App\Models\Customer;
use App\Models\Bcrypt;
use Core\Session;

class CustomerController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    


    public function add_customer(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/customer/add_customer.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Adicionar Cliente - Area Restrita');
        $this->renderView('adm/customer/add_customer', '/adm/adm_layout');
    }
    
    
    public function valida_telefone_unico($request){
        
        $validacao = Customer::validar_telefone_unico(self::FormataTelefone($request->get->telefone_check));
            
        if($validacao->erro == true){
            echo(json_encode(true));
            return;
        }else{
            echo(json_encode(false));
            return;
        }
    }
    
    
    
    public function cadastrar_novo_cliente($request){
        
        
        
        $resultado = Customer::cadastrar_novo_cliente(
                self::FormataTelefone($request->post->phone_1),
                self::FormataTelefone($request->post->phone_2),
                $request->post->nome,
                $request->post->cpf,
                $request->post->obs,
                $request->post->address_tipo1,
                $request->post->address_cep1,
                $request->post->address_rua1,
                $request->post->address_numero1,
                $request->post->address_bairro1,
                $request->post->address_cidade1,
                $request->post->address_estado1,
                $request->post->address_referencia1,
                $request->post->address_obs1,
                $request->post->address_tipo2,
                $request->post->address_cep2,
                $request->post->address_rua2,
                $request->post->address_numero2,
                $request->post->address_bairro2,
                $request->post->address_cidade2,
                $request->post->address_estado2,
                $request->post->address_referencia2,
                $request->post->address_obs2
                );
        

        if($resultado->erro){
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 001 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/adm_index', [
                'success' => ['Cliente cadastrado com sucesso!'],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    
    public static function FormataTelefone($tel){
        $new_tel = str_replace(' ', '', $tel); 
        $new_tel = str_replace('(', '', $new_tel); 
        $new_tel = str_replace(')', '', $new_tel); 
        $new_tel = str_replace('-', '', $new_tel); 
        $new_tel = str_replace('%20', '', $new_tel); 
        return $new_tel;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}