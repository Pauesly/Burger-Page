<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use App\Models\Pedido;
use App\Models\ProdutoPedido;
use App\Models\Customer;
use App\Models\Endereco;
use App\Models\PaymentTerm;
use App\Models\Status;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\OrderStatus;
use App\Models\Bcrypt;
use Core\Session;

class PedidoController extends BaseController
{
    
    private $dados;

    public function __construct()
    {
        parent::__construct();
       // $this->email = new Email;
    }
    

    public function novo_pedido_plus($id){
        $admin  =  Session::get('adm');
        
        $this->view->tel = $id;
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
        
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/pedido/novo_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Novo Pedido - Area Restrita');
        $this->renderView('adm/pedido/novo_pedido', '/adm/adm_layout');
    }


    public function novo_pedido(){
        $admin  =  Session::get('adm');
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/adm/pedido/novo_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Novo Pedido - Area Restrita');
        $this->renderView('adm/pedido/novo_pedido', '/adm/adm_layout');
    }
    
    
    
    public function busca_enderecos_de_cliente($request){
        $resultado = Customer::busca_enderecos_de_cliente($request->get->id);
        echo(json_encode($resultado));
    }
    
    
    public function abrir_pedido($request){
        $resultado = Pedido::abrir_pedido($request->get->fk_id_adm, $request->get->fk_id_customer, $request->get->fk_id_address);
        
        if($resultado->erro){
            $array = [
                "erro" => "true"];
            echo(json_encode($array));
        }else{
            $restt = OrderStatus::altera_status_pedido($request->get->fk_id_adm, $resultado->id_cadastro, 1);
            echo(json_encode($resultado));
        }
    }
    
    
    
    public function gerir_pedido($request){
        $admin  =  Session::get('adm');

        $this->view->id_pedido          = $request->post->id_pedido;

        
        $this->view->dados_pedido       = Pedido::busca_dados_pedido($request->post->id_pedido);
        $this->view->endereco_entrega   = Endereco::busca_endereco_por_id($this->view->dados_pedido->resultado[0]->fk_id_address);
        $this->view->formas_de_pagamento= PaymentTerm::busca_formas_de_pagamento();
        $this->view->status             = Status::relatorio_all_status();
        $this->view->produtos           = Produto::relatorio_all_produtos_ativos_menu_no_pic();
        $this->view->categorias         = Categoria::relatorio_all_categorias_ativas();
        
        //data e hora entrega
        $data_delivery_array = explode(' ',$this->view->dados_pedido->resultado[0]->to_deliver_in);
        $this->view->data_entrega        = date('d/m/Y', strtotime($data_delivery_array[0]));
        $this->view->horario_entrega     = $data_delivery_array[1];
        
        
        
        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        $this->view->id_adm = $admin['id_adm'];
         
        $this->view->css_head =  '<link href="/assets/css/style_adm.css" rel="stylesheet">';
        $this->view->js_head =  '<script src="/assets/js/editor/jquery.min.js"></script>';
        $this->view->extra_css = '<link  href="/assets/css/bootstrap-select.css" rel="stylesheet" />';
        $this->view->extra_js = '<script src="/assets/js/jquery.min.js"></script>'
                              . '<script src="/assets/js/popper.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap.min.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/jquery.mask.js" crossorigin="anonymous"></script>'
                              . '<script src="/assets/js/bootstrap-select.js"></script>'
                              . '<script src="/assets/js/date_picker.js" crossorigin="anonymous"></script>'
                              . '<link rel="stylesheet" type="text/css" href="assets/css/date_picker.css"/>'
                              . '<script src="/assets/js/adm/pedido/gerir_pedido.js" crossorigin="anonymous"></script>';
        $this->setPageTitle('Gerir Pedido - Area Restrita');
        $this->renderView('adm/pedido/gerir_pedido', '/adm/adm_layout');
    }
    
    
    
    public function salva_pagamento_sim($request){
        $resultado = Pedido::salva_pagamento_sim($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    public function salva_pagamento_nao($request){
        $resultado = Pedido::salva_pagamento_nao($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    public function salva_delivery_status($request){
        $resultado = Pedido::salva_delivery_status($request->get->id_pedido, $request->get->delivery_status, $request->get->created_at);
        echo(json_encode($resultado));
    }
    
    
    public function salva_data_hora_delivery($request){
        $resultado = Pedido::salva_data_hora_delivery($request->get->data, $request->get->hora, $request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    public function salva_obs($request){
        $resultado = Pedido::salva_obs($request->get->id_pedido, $request->get->txt_obs);
        echo(json_encode($resultado));
    }
    
    
    public function salva_forma_pagamento($request){
        $resultado = Pedido::salva_forma_pagamento($request->get->id_pedido, $request->get->id_forma_pagamento);
        echo(json_encode($resultado));
    }
    
    public function salva_status_pedido($request){
        $resultado = Pedido::salva_status_pedido($request->get->id_pedido, $request->get->id_status_pedido);
        if($resultado == 0){
            $array = [
                "erro" => "true"];
            echo(json_encode($array));
        }else{
            $restt = OrderStatus::altera_status_pedido($request->get->id_adm, $request->get->id_pedido, $request->get->id_status_pedido);
            echo(json_encode($resultado));
        }
    }
    
    
    public function carrega_produtos_pedido($request){
        $resultado = ProdutoPedido::busca_produtos_de_pedido($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
  
    public function carrega_historico_status_pedido($request){
        $resultado = OrderStatus::busca_status_de_pedido($request->get->id_pedido);
        echo(json_encode($resultado));
    }
    
    
    public function add_produto_pedido($request){
        $resultado = ProdutoPedido::add_produto_pedido(
                $request->get->fk_id_order, 
                $request->get->fk_id_product, 
                $request->get->qtd, 
                $request->get->price_unit, 
                $request->get->obs);
        echo(json_encode($resultado));
    }
    
    
     public function remove_produto_pedido($request){
        $resultado = ProdutoPedido::remove_produto_pedido($request->get->id_produto_order);
        echo(json_encode($resultado));
    }
    
    
    public function apagar_pedido($request){
        
        $resultado = Pedido::apagar_pedido($request->post->id_pedido_del);
        
        if($resultado == 0){
            return Redirect::route('/consultar_pedidos', [
                'errors' => ['Erro 003 - Erro ao tentar salvar. Contate Administrador.'],
                'inputs' => [""]
            ]);
        }else{
            return Redirect::route('/consultar_pedidos', [
                'success' => ["Pedido Cancelado com sucesso!"],
                'inputs' => [""]
            ]);
        }
    }
    
 
    public function consultar_pedidos(){
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
                              . '<script type="text/javascript" src="assets/js/adm/pedido/consultar_pedido.js"></script>';
        


        $this->setPageTitle('Consultar Pedidos - Area Restrita');
        $this->renderView('adm/pedido/consultar_pedidos', '/adm/adm_layout');
    }
    
    
    public function realizar_busca_pedido_filtros($request){
        $tel = self::FormataTelefone($request->get->telefone);
        $resultado = Pedido::busca_pedido_nome_tel_data($request->get->nome, $tel, $request->get->data_inicial, $request->get->data_final);
        echo(json_encode($resultado));
    }
    
    
    public static function FormataTelefone($tel){
        $new_tel = str_replace(' ', '', $tel); 
        $new_tel = str_replace('(', '', $new_tel); 
        $new_tel = str_replace(')', '', $new_tel); 
        $new_tel = str_replace('-', '', $new_tel); 
        $new_tel = str_replace('%20', '', $new_tel); 
        return $new_tel;
    }
    
    
    public function gestao_a_vista(){
        $admin  =  Session::get('adm');

        $nome_array = explode(' ',$admin['name']);
        $this->view->nome = $nome_array[0];
        
        date_default_timezone_set('America/Sao_Paulo');
        $this->view->data = date('d/m/Y');
        
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
                              . '<script type="text/javascript" src="assets/js/adm/pedido/gestao_a_vista.js"></script>';
        
        $this->setPageTitle('Gestão à vista Pedidos - Area Restrita');
        $this->renderView('adm/pedido/gestao_a_vista', '/adm/adm_layout');
    }
    
    
    public function carregar_gestao_a_vista($request){
        $resultado = Pedido::carregar_gestao_a_vista($request->get->data_setted);
        echo(json_encode($resultado));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}