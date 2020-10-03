<?php

namespace App\Models;

use Core\Session;
use Core\Redirect;

use Core\WS_read;
use Core\WS_read_free;
use Core\WS_update;
use Core\WS_write;
use Core\WS_write_free;




class Adm 
{

    
    
    //Busca adm com email para Login
    public static function fazer_login($email) {
        //Dados obrigatorios
        $array = [
            "funcao" => "login_adm_com_email",
            "email" => $email,
        ];
        $resultado = WS_read_free::read_free($array);
        return  json_decode($resultado);
    }
    
    
    
    //Cria sessao com ID do ADM
    public static function cria_sessao_com_id($id_adm){
        $full_data_adm = Adm::full_data_adm_com_id($id_adm);

        //carrega sessao do usuario
        $adm_logado =[
            'id_adm'                => $full_data_adm->resultado[0]->id_adm,
            'email'                 => $full_data_adm->resultado[0]->email,
            'name'                  => $full_data_adm->resultado[0]->name,
            'picture'               => $full_data_adm->resultado[0]->picture,
            'obs'                   => $full_data_adm->resultado[0]->obs,
            'active'                => $full_data_adm->resultado[0]->active
        ];
        Session::set('adm', $adm_logado);
    }
    
    
    
    
    //Busca Full data do Adm
    public static function full_data_adm_com_id($id) {
        //Dados obrigatorios
        $array = [
            "funcao" => "full_data_adm_id",
            "id_adm" => $id
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Salva Coockie para futuro login
    public static function criar_cookie_adm($id_adm)
    {
        // Encriptando o cookie
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d/m/Y');
        $hora = date('H:i:s');
        
        $senha = 'cookie_jazzgrill' . $id_adm. $data . $hora;
        $hash = Bcrypt::hash($senha);
        
        $separador = "&@^!";
        $hash_cookie = $id_adm . $separador . $hash;
        
        // Cria o cookie acima só que irá durar 10 dias
        setcookie('jazzgrill_sessao_adm', $hash_cookie, time() + (10 * 24 * 3600), '/');
        
        //#### Salvar Senha no Banco     
        //Dados obrigatorios
        $array = [
            "funcao"            => "salva_cookie_adm",
            "id_adm"            => $id_adm,
            "token_login_web"   => $senha
        ];

        return WS_update::alterar_dados($array);
    }
    
    
    
    public static function valida_login_por_cookie()
    {
        $cookie_objetivando = $_COOKIE['jazzgrill_sessao_adm'];
        
        $separador = "&@^!";
        $id_hash = explode($separador, $cookie_objetivando);

        $id = $id_hash[0];  // ID do USUARIO
        $hash = $id_hash[1]; // Hash de login criptografado

        //Dados obrigatorios
        $array = [
            "funcao" => "valida_token_adm_por_id",
            "id" => $id,
        ];

        if($cookie_objetivando == NULL){
            $resultado_busca['erro'] = true;
        }else{
            $resultado_busca = WS_read::ler_dados($array);
            $resultado_busca = json_decode($resultado_busca);
        }
        
        //Se resultado tiver erro, aconteceu algum problema na busca ou token nao existe.
        if ($resultado_busca->erro == true){
           return false; 
        }else if ((crypt($resultado_busca->resultado[0]->token_login_web, $hash) == $hash)){
            //Se nao houver erro e o token do cookie bater com o savo em banco, Cria sessao e pode entrar.
            self::cria_sessao_com_id($id);
            return $resultado_busca->resultado[0];
        }else{
            return false;
        }
    }
    
    
    
    
    //Busca Full data do Adm
    public static function gerir_adm() {
        //Dados obrigatorios
        $array = [
            "funcao" => "gerir_adm"
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca Full data do Adm
    public static function salvar_novo_adm($name, $email, $obs) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "salvar_novo_adm",
            "name"      => $name,
            "email"     => $email,
            "obs"       => $obs,
            "password"  => Bcrypt::hash("123456"),
            "active"    => 1,
            "created_at"=> Padroes_gerais::data_e_hora()
        ];
        $resultado = WS_write::white($array);
        return  json_decode($resultado);
    }
    
    
    
    //Busca Full data do Adm
    public static function busca_dados_adm_full($id) {
        //Dados obrigatorios
        $array = [
            "funcao" => "busca_dados_adm_full",
            "id_adm" => $id
        ];
        $resultado = WS_read::ler_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    //Busca Full data do Adm
    public static function salvar_edit_adm($id_adm, $active, $name, $email, $obs) {
        //Dados obrigatorios
        $array = [
            "funcao"    => "salvar_edit_adm",
            "id_adm"    => $id_adm,
            "active"    => $active,
            "name"      => $name,
            "email"     => $email,
            "obs"       => $obs
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //
    public static function reset_senha_adm($id_adm) {
        //Dados obrigatorios
        $array = [
            "funcao" => "reset_senha_adm",
            "id_adm" => $id_adm,
            "password" => Bcrypt::hash("123456"),
            "token_login_web" => 0
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    //
    public static function adm_save_password($email, $password) {
        //Dados obrigatorios
        $array = [
            "funcao" => "adm_save_password",
            "email" => $email,
            "password" => Bcrypt::hash($password),
            "token_login_web" => 0
        ];
        $resultado = WS_update::alterar_dados($array);
        return  json_decode($resultado);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //Valida tipo de perfil
    public static function valida_perfil_minimo($min_perfil){
        $admin =  Session::get('adm');
        if($admin['perfil_master'] < $min_perfil)
            Redirect::route ('/rota_errada');
    }
  
  

    
    
    
    
    
    
    
    
    
    
   
    
    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    
   
    
   
    
    
    
    
    
    
    
   
    
    

    
    

    
    

    
    
    
    
}

    
