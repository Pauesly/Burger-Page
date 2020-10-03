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
    


    public function add_customer($request){
        $admin  =  Session::get('adm');
        
        if(isset($request->post->new_tel)){
            $this->view->new_tel = $request->post->new_tel;
        }
        
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
        
        if(isset($request->get->id_customer)){
            $validacao = Customer::validar_telefone_unico_de_customer(self::FormataTelefone($request->get->telefone_check), $request->get->id_customer);
                
            if($validacao->erro == true){
                echo(json_encode(true));
                return;
            }else{
                echo(json_encode(false));
                return;
            }
        }else{
            $validacao = Customer::validar_telefone_unico(self::FormataTelefone($request->get->telefone_check));
                
            if($validacao->erro == true){
                echo(json_encode(true));
                return;
            }else{
                echo(json_encode(false));
                return;
            }
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
        
        if($resultado->erro == true){
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 001 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
//            var_dump($resultado);die;
            $tel = self::FormataTelefone($request->post->phone_1);
            $texto_sucesso = "Cliente [ $resultado->id_cadastro ] cadastrado com sucesso! Abrir pedido? <a class=&#34;btn btn-primary&#34; href=novo_pedido_plus/$tel role=&#34;button&#34;>clique aqui</a>";
  
            if($resultado->end_1 == true){
                $texto_sucesso .= "<br> Obs: Não salvou endereço 1.";
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }else if($resultado->end_2 == true){
                $texto_sucesso .= "<br> Obs: Não salvou endereço 2.";
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }else{
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }
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
    
    
    public function consultar_customer(){
        $admin  =  Session::get('adm');
        
        
        //Conteudo do corpo
        $resultado = Customer::adm_relatorio_all_customers();
                
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
                              . '<script type="text/javascript" src="assets/js/adm/customer/consultar_customer.js"></script>';
        
        $this->setPageTitle('Consultar Cliente - Area Restrita');
        $this->renderView('adm/customer/consulta_customer', '/adm/adm_layout');
    }
    
     
    //Pagina Edit perfil MAster
    public function edit_customer($request){
        //Validacoes obrigatorias
        $admin  =  Session::get('adm');
        
        $dados_customer = Customer::full_data_customer_com_id($request->get->id);
//        $dados_adm = json_decode($dados_customer);
        
        $this->view->dados_customer = $dados_customer->resultado[0];
        
        //Inclusoes Obrigatorias em todas as rotas
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/customer/edit_customer.js" crossorigin="anonymous"></script>';

        $this->setPageTitle('Perfil');
        $this->renderView('adm/customer/edit_customer', '/adm/adm_layout' );
    }
    
    
    public function salva_editar_cliente($request){
        
        $resultado = Customer::salva_editar_cliente(
                $request->post->id_customer,
                $request->post->active,
                self::FormataTelefone($request->post->phone_1),
                self::FormataTelefone($request->post->phone_2),
                $request->post->nome,
                $request->post->cpf,
                $request->post->obs,
                $request->post->id_dress_1,
                $request->post->address_tipo1,
                $request->post->address_cep1,
                $request->post->address_rua1,
                $request->post->address_numero1,
                $request->post->address_bairro1,
                $request->post->address_cidade1,
                $request->post->address_estado1,
                $request->post->address_referencia1,
                $request->post->address_obs1,
                $request->post->id_dress_2,
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
        
//                var_dump($resultado); die;
        if($resultado->erro == true){
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 001 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            $tel = self::FormataTelefone($request->post->phone_1);
            $texto_sucesso = "Alterações salvas com sucesso! Abrir pedido? <a class=&#34;btn btn-primary&#34; href=novo_pedido_plus/$tel role=&#34;button&#34;>clique aqui</a>";
  
            if($resultado->end_1 == true){
                $texto_sucesso .= "<br> Obs: Não salvou endereço 1.";
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }else if($resultado->end_2 == true){
                $texto_sucesso .= "<br> Obs: Não salvou endereço 2.";
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }else{
                return Redirect::route('/adm_index', [
                    'success' => [$texto_sucesso],
                    'inputs' => [""]
                ]);
            }
            
            
            
        }
    }
    
    
    public function busca_cliente_por_telefone($request){
        $resultado = Customer::busca_cliente_por_telefone(self::FormataTelefone($request->get->phone));
        echo(json_encode($resultado));
    }
    
    
    public function busca_cliente_to_select(){
        $resultado = Customer::busca_cliente_to_select();
        echo(json_encode($resultado));
    }
    
    
    
    public function salva_edit_endereco($request){
        
        $resultado = Customer::salva_edit_endereco(
                $request->get->id_address, 
                $request->get->tipo, 
                $request->get->cep, 
                $request->get->rua, 
                $request->get->numero_complemento, 
                $request->get->bairro, 
                $request->get->cidade, 
                $request->get->estado, 
                $request->get->referencia, 
                $request->get->obs);
        echo(json_encode($resultado));

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}