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
    
    /**
     * Apenas verifica se tem SESSAO ATIVA ou COOKIE valido
     */
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
            //Se retornar erro == Busca vazia == Usuario nao cadastrado ou desativado
            return Redirect::route('/adm', [
                'errors' => ['Usuário ou senha estão incorretos'],
                'inputs' => ['email' => $request->post->email]
            ]);
        }else{
            $senha_digitada =   $request->post->password;
            $senha_salva    =   $resultado_busca_code->resultado[0]->password;
            
            $login_autorizado = Bcrypt::check($senha_digitada, $senha_salva);
            
            if($login_autorizado){
                
                //se a senha for 123456, mude a senha
                if($request->post->password == "123456"){
                    return Redirect::route('/adm_change_password', [
                        'success' => ['Altere sua senha:'],
                        'inputs' => ['email' => $resultado_busca_code->resultado[0]->email]
                    ]);
                }
                
                //carrega sessao do usuario
                Adm::cria_sessao_com_id($resultado_busca_code->resultado[0]->id_adm);
                
                //Se tudo estiver certo, vefirica se eh pra mander logado ou nao
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
    
    
    public function adm_change_password(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('NOVA SENHA - Area Restrita');
        $this->renderView('adm/login/change_password');
    }
    
    
    public function adm_save_password($request){
       
        $resultado_busca_code = Adm::fazer_login($request->post->email);
        
        $senha_digitada =   "123456";
        $senha_salva    =   $resultado_busca_code->resultado[0]->password;

        $login_autorizado = Bcrypt::check($senha_digitada, $senha_salva);
        
        if($login_autorizado){
            
            $resultad = Adm::adm_save_password($request->post->email, $request->post->password);
            
            return Redirect::route('/to_login', [
                'success' => ['Senha alterada com sucesso! <br>Por favor, refaça o login.'],
                'inputs' => ['email' => $request->post->email]
            ]);
            
        }else{
            return Redirect::route('/to_login', [
                'errors' => ['Erro 003 - Voce nao tem autorizacao para realizar este procedimento.'],
                'inputs' => [""]
            ]);
        }




//
//        
//        
//        if(($admin['id_adm'] == 1) || ($admin['id_adm'] == $request->post->id_adm)){
//            $resultado = Adm::salvar_edit_adm(
//                $request->post->id_adm,
//                $request->post->active,
//                $request->post->name,
//                $request->post->email,
//                $request->post->obs
//                );
//        }else{
//            return Redirect::route('/adm_index', [
//                'errors' => ['Erro 003 - Voce nao tem autorizacao para fazer esta alteracao.'],
//                'inputs' => [""]
//            ]);
//        }
//        
        
//        if($resultado->erro){
//            return Redirect::route('/adm_index', [
//                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
//                'inputs' => [""]
//            ]);
//        }else{
//            return Redirect::route('/adm_index', [
//                'success' => ["Alterações salvas com sucesso."],
//                'inputs'  => [""]
//            ]);
//        }
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
            return Redirect::route('/edit_adm?id' . $admin['id_adm']);
        }
    }
    
    
    public function add_adm(){
//        $re = Bcrypt::hash("123456");
//        var_dump($re); die;
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
        
        $resultado = Adm::salvar_novo_adm(
                $request->post->name,
                $request->post->email,
                $request->post->obs
                );
        
        if($resultado->erro){
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/adm_index', [
                'success' => ["Categoria [  $resultado->id_cadastro ] cadastrada com sucesso!"],
                'inputs'  => [""]
            ]);
        }
    }
    
    
    public function edit_adm($request){
        $admin  =  Session::get('adm');
        
        if($admin['id_adm'] == 1){
            $id_edit = $request->get->id;
        }else{
            $id_edit = $admin['id_adm'];
        }
        
        $res = Adm::busca_dados_adm_full($id_edit);

        $this->view->dados_adm = $res->resultado[0];    
        
        $this->view->id_adm_logged = $admin['id_adm'];
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script type="text/javascript" src="assets/js/adm/perfil/edit_adm.js"></script>';
        $this->setPageTitle('Editar Administrador - Area Restrita');
        $this->renderView('adm/perfil/edit_adm', '/adm/adm_layout');
    }
    
    
    public function salva_editar_adm($request){
        $admin  =  Session::get('adm');
        
        if(($admin['id_adm'] == 1) || ($admin['id_adm'] == $request->post->id_adm)){
            $resultado = Adm::salvar_edit_adm(
                $request->post->id_adm,
                $request->post->active,
                $request->post->name,
                $request->post->email,
                $request->post->obs
                );
        }else{
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 003 - Voce nao tem autorizacao para fazer esta alteracao.'],
                'inputs' => [""]
            ]);
        }
        
        
        if($resultado->erro){
            return Redirect::route('/adm_index', [
                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/adm_index', [
                'success' => ["Alterações salvas com sucesso."],
                'inputs'  => [""]
            ]);
        }
    }
    
    
    public function reset_senha_adm($request){
        $admin  =  Session::get('adm');
        
        if(($admin['id_adm'] == 1) || ($admin['id_adm'] == $request->get->id)){
            //Pode alterar
            $resultado = Adm::reset_senha_adm($request->get->id);
            if($resultado == 1){
                $array = ["erro" => "false"];
                echo(json_encode($array));
            }         
                
        }else{
            //Nao tem autorizacao para realizar a operacao
            $array = ["erro" => "true"];
            echo(json_encode($array));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}