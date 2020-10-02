<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Email;
use App\Models\Adm;
use App\Models\Bcrypt;
use Core\Session;

class AdmController extends BaseController
{
    
    private $dados;

    private $email;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    

    public function loginAdm(){
        
        //controle para acesso por cookie ou sessao
        $tipo_acesso = 0;
        
        //Analisa Cookie
        isset($_COOKIE['jazzgrill_sessao_user']) ? $tipo_acesso = 1 : "";
        isset($_COOKIE['jazzgrill_sessao_adm'])  ? $tipo_acesso = 2 : "";
        
        //Analisa Sessao de ADM
        Session::get("adm") ? $tipo_acesso = 3 : "";
        
        //Analisa Sessao de USER
        Session::get("user") ? $tipo_acesso = 4 : "";
        
        
        switch ($tipo_acesso){
            
            //Caso nao tenha ninguem logado de nenhuma maneira
            case 0:
                self::to_login();
                break;
            
            //Caso logado por cookie USER
            case 1:
                echo "Vai logar por cookie USER"; die;
                if(User::valida_login_por_cookie()){
                    //Se validar, cria a sessao e redireciona para Pagina inicial logada
                    Redirect::route('/user_index');
                }else{
                    //Cookie invalido
                    self::to_login();
                }
                break;
                
            //Caso logado por cookie ADM
            case 2:
                if(Adm::valida_login_por_cookie()){
                    //Se validar, cria a sessao e redireciona para Pagina inicial logada
                    Redirect::route('/adm_index');
                }else{
                    //Cookie invalido
                    self::to_login();
                }
                break;
                
                
            //Caso logado por Sessao de ADM
            case 3:
                Redirect::route('/adm_index');
                break;
            
            //Caso locado por sessao USER
            case 4:
                echo "Tem sessao ativa User"; die;
                Redirect::route('/user_index');
                break;
            
            default:
                echo "#005 - Opção não encontrada. Por favor, refaça a operação.";
                die;
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
    
    
    //Encaminha para a tela de login
    public function to_login(){
        $this->setPageTitle('LOGIN');
        $this->renderView('adm/login/login');
    }
    
    
    
    public function validarLogin($request){

        $resultado_busca_code = Adm::fazer_login($request->post->email);

        if ($resultado_busca_code->erro){
            //Se retornar erro == Busca vazia == Usuario nao cadastrado
            return Redirect::route('/adm', [
                'errors' => ['Usuário ou senha estão incorretos'],
                'inputs' => ['email' => $request->post->email]
            ]);
        }else{
            $senha_digitada =   $request->post->password;
            $senha_salva    =   $resultado_busca_code->resultado[0]->password;
            
            $login_autorizado = Bcrypt::check($senha_digitada, $senha_salva);
            
            if($login_autorizado){
                //carrega sessao do usuario
                Adm::cria_sessao_com_id($resultado_busca_code->resultado[0]->id_adm);
                
                if(strcmp($request->post->keep_conected, "true") == 0){ //Verificacao de MANTEM CONECTADO
                    $ret = Adm::criar_cookie_adm($resultado_busca_code->resultado[0]->id_adm);
                    Redirect::route('/adm_index');
                }else{
                    Redirect::route('/adm_index');
                }
            }else{
                //Se retornar erro == Busca vazia == Usuario nao cadastrado
                return Redirect::route('/adm', [
                    'errors' => ['Usuário ou senha estão incorretos'],
                    'inputs' => ['email' => $request->post->email]
                ]);
            }
            
            die;
        }
    }
    
    
    public function index(){
        $admin  =  Session::get('adm');
        
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Painel Administrativo - Area Restrita');
        $this->renderView('adm/home/adm_index', '/adm/adm_layout');
    }
    
    
    
    public function logout()
    {
        //Apaga Cookies
        if(isset($_COOKIE['jazzgrill_sessao_user']))
            setcookie('jazzgrill_sessao_user', '', (time() - 1));
        if(isset($_COOKIE['jazzgrill_sessao_adm']))
            setcookie('jazzgrill_sessao_adm', '', (time() - 1));
        
        //Apaga sessoes
        Session::destroy('adm');
        Session::destroy('user');
        
        return Redirect::route('/');
    }
    
    
    
    
    
    function adm_access() {
        $admin  =  Session::get('adm');
        
        if($admin['id_adm'] == 1){
            return Redirect::route('/gerir_adm');
        }else{
            return Redirect::route('/edit_adm');
        }
    }
    
    
    
    
    public function gerir_adm(){
        $admin  =  Session::get('adm');
        if($admin['id_adm'] == 1){
            $nome_array = explode(' ',$admin['name']);
            
            $this->view->adms = Adm::gerir_adm();
            
            $total_ativa = 0;
            $total_inativa = 0;
            foreach ($this->view->adms->resultado as $value) {
                if($value->active == 1)
                    $total_ativa++;
                if($value->active == 0)
                    $total_inativa++;
            }

            $this->view->total_ativa = $total_ativa;
            $this->view->total_inativa = $total_inativa;
            
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
            $this->setPageTitle('Painel Administrativo de Administradores - Area Restrita');
            $this->renderView('adm/perfil/gestao_adm', '/adm/adm_layout');
        }else{
            return Redirect::route('/edit_adm/' . $admin['id_adm']);
        }
    }
    
    
    
    public function add_adm(){
        $admin  =  Session::get('adm');
        if($admin['id_adm'] == 1){
            $nome_array = explode(' ',$admin['name']);
            $this->view->nome = $nome_array[0];

            $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
            $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
            $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                                  . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                                  . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                                  . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                                  . '<script src="/assets/js/adm/perfil/add_perfil.js" crossorigin="anonymous"></script>';
            $this->setPageTitle('Adicionar Administrador - Area Restrita');
            $this->renderView('adm/perfil/add_adm', '/adm/adm_layout');
        }else{
            return Redirect::route('/edit_adm/' . $admin['id_adm']);
        }
    }
    
    
    public function cadastrar_novo_adm($request){
        
        var_dump($request); die;
        
        FAZERROTINA DE SALVAR ADM
        $resultado =?????????a::ca?????????????????_categoria(
                $request->post->description,
                $request->post->sequence
                );
        
        if($resultado->erro){
            return Redirect::route('/adm', [
                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/adm', [
                'success' => ["Categoria [  $resultado->id_cadastro ] cadastrada com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
    
    
    public function edit_adm($request){
        $admin  =  Session::get('adm');
        
        echo "Soh Editar ADM: " . $request->get->id;
        
//        $nome_array = explode(' ',$admin['name']);
//        $this->view->nome = $nome_array[0];
//        
//        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
//        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
//        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
//                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
//                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>';
//        $this->setPageTitle('Painel Administrativo - Area Restrita');
//        $this->renderView('adm/home/adm_index', '/adm/adm_layout');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}