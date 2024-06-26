$(document).ready(function(){
    //Date Picker
    var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		});
    
    $('#txt_add_preco').mask("#,##0.00", {reverse: true});
    $('#txt_frete').mask("#,##0.00", {reverse: true});
    $('#txt_hora_delivery').mask('00:00');
    $('#select_forma_pagamento')        .selectpicker('val', $("#id_status_pedido")       .val());
    $('#select_status_pedido')          .selectpicker('val', $("#fk_id_status")       .val());
    CarregaProdutosPedido();
});


$('#btn_visualizar_romaneio').click(function(){
        let id_pedido = document.getElementById("id_pedido").value;
        window.open('/visualiza_romaneio/' + id_pedido,'janela');
  });
$('#btn_imprimir_romaneio').click(function(){
        let id_pedido = document.getElementById("id_pedido").value;
        window.open('/imprime_romaneio/' + id_pedido,'janela');
  });


// Listener botao PAGAR SIM
document.getElementById("btn_pago_sim").addEventListener("mousedown", function(event) {
    document.getElementById("loading_pago").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_pago_sim").className = "disabled";
    document.getElementById("btn_pago_nao").className = "disabled";
    SalvaPagamentoSIM();
});


/**
 * Salva Pagamento sim
 */
function SalvaPagamentoSIM() {
    let id_pedido = document.getElementById("id_pedido").value;
    $.getJSON('/salva_pagamento_sim?search=',{id_pedido:id_pedido, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                document.getElementById("loading_pago").className = "";
                document.getElementById("btn_pago_sim").className = "btn btn-success text-white";
                document.getElementById("btn_pago_nao").className = "btn btn-outline-danger";
            }
    });
}


// Listener botao PAGAR NAO
document.getElementById("btn_pago_nao").addEventListener("mousedown", function(event) {
    document.getElementById("loading_pago").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_pago_sim").className = "disabled";
    document.getElementById("btn_pago_nao").className = "disabled";
    SalvaPagamentoNAO();
});


/**
 * Salva Pagamento Nao
 */
function SalvaPagamentoNAO() {
    let id_pedido = document.getElementById("id_pedido").value;
    $.getJSON('/salva_pagamento_nao?search=',{id_pedido:id_pedido, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                document.getElementById("loading_pago").className = "";
                document.getElementById("btn_pago_sim").className = "btn btn-outline-success";
                document.getElementById("btn_pago_nao").className = "btn btn-danger text-white";
            }
    });
}



// Listener botao Sim agendar delivery
document.getElementById("btn_entrega_sim").addEventListener("mousedown", function(event) {
    document.getElementById("loading_delivery").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_entrega_sim").className = "disabled";
    document.getElementById("btn_entrega_nao").className = "disabled";
    document.getElementById("txt_delivery_status").value = 1;
    SalvaDeliveryStatus();
});
// Listener botao Nao agendar delivery
document.getElementById("btn_entrega_nao").addEventListener("mousedown", function(event) {
    document.getElementById("loading_delivery").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_entrega_sim").className = "disabled";
    document.getElementById("btn_entrega_nao").className = "disabled";
    document.getElementById("txt_delivery_status").value = 0;
    SalvaDeliveryStatus();
});
function SalvaDeliveryStatus() {
    let id_pedido = document.getElementById("id_pedido").value;
    let delivery_status = document.getElementById("txt_delivery_status").value;
    let created_at = document.getElementById("created_at").value;
    console.log(created_at);
    $.getJSON('/salva_delivery_status?search=',{id_pedido:id_pedido, delivery_status:delivery_status, created_at:created_at, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                document.getElementById("loading_delivery").className = "";
                if(delivery_status === "1"){
                    document.getElementById("btn_entrega_sim").className = "btn btn-success text-white";
                    document.getElementById("btn_entrega_nao").className = "btn btn-outline-danger";
                    document.getElementById("div_data_delivery").className = "";
                }else{
                    document.getElementById("btn_entrega_sim").className = "btn btn-outline-success";
                    document.getElementById("btn_entrega_nao").className = "btn btn-danger text-white";
                    document.getElementById("div_data_delivery").className = "esconder";
                }
                
            }
    });
}



//Salva Data Delivery
document.getElementById("txt_data_delivery").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        SalvaDataDelivery();
    }
});
//Salva Data Delivery
document.getElementById("txt_hora_delivery").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        SalvaDataDelivery();
    }
});
document.getElementById("txt_hora_delivery").addEventListener("focusout", SalvaDataDelivery);

document.getElementById("txt_data_delivery").addEventListener("focusin", SalvaDataAlert);
document.getElementById("txt_hora_delivery").addEventListener("focusin", SalvaDataAlert);

function SalvaDataAlert() {
    document.getElementById("txt_data_delivery").className = "form-control";
    document.getElementById("txt_hora_delivery").className = "form-control";
}

/**
 * Salva Data Delivery
 */
function SalvaDataDelivery() {
    
    document.getElementById("loading_data_delivery").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("loading_hora_delivery").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("txt_data_delivery").disabled = true;
    document.getElementById("txt_hora_delivery").disabled = true;
    
    let data = document.getElementById("txt_data_delivery").value;
    let hora = document.getElementById("txt_hora_delivery").value;
    let id_pedido = document.getElementById("id_pedido").value;
    
    $.getJSON('/salva_data_hora_delivery?search=',{data:data, hora:hora, id_pedido:id_pedido, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO ao salvar Data # Contactar Administrador.");
            }else{
                //Setting Screen
                document.getElementById("loading_data_delivery").className = "";
                document.getElementById("loading_hora_delivery").className = "";
                document.getElementById("txt_data_delivery").disabled = false;
                document.getElementById("txt_hora_delivery").disabled = false;
                document.getElementById("txt_data_delivery").className = "form-control is-valid";
                document.getElementById("txt_hora_delivery").className = "form-control is-valid";
            }
    });
}









//LISTENERS DE DIGITACAO OBS
document.getElementById("txt_obs_customer").addEventListener("keyup", function(event) {
    document.getElementById("btn_salvar_obs").className = "btn btn-danger mt-1 text-white";
    document.getElementById("btn_salvar_obs").innerHTML = "Salvar";
});


// Listener botao Salvar OBS
document.getElementById("btn_salvar_obs").addEventListener("mousedown", function(event) {
    document.getElementById("loading_obs").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_salvar_obs").className = "disabled";
    document.getElementById("txt_obs_customer").disabled = true;
    SalvaObs();
});



// Listener botao Historico Staus
document.getElementById("btn_historico_status").addEventListener("mousedown", function(event) {
    document.getElementById("loading_historico_status").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("btn_historico_status").className = "disabled";
    CarregaHistoricoStatus();
});


// Listener botao ADD Produto
document.getElementById("btn_add_produto").addEventListener("mousedown", function(event) {
    $('#modal_cardapio').modal('show');
});




//Salva Data Delivery
document.getElementById("txt_frete").addEventListener("keyup", function(event) {
    document.getElementById("txt_frete").className = "form-control";
    if (event.keyCode === 13) {
        event.preventDefault();
        SalvaFrete();
    }
});
document.getElementById("txt_frete").addEventListener("focusout", SalvaFrete);

function SalvaFrete() {
    
    document.getElementById("loading_frete").className = "spinner-border spinner-border-sm text-primary";
    document.getElementById("txt_frete").disabled = true;
    
    let id_pedido = document.getElementById("id_pedido").value;
    let frete = document.getElementById("txt_frete").value;
    
    $.getJSON('/salva_frete?search=',{id_pedido:id_pedido, frete:frete, ajax: 'true'}, function(retorno){
        
        document.getElementById("loading_frete").className = "";
        document.getElementById("txt_frete").disabled = false;

        //Erro. Busca vazia ou execucao da consulta
        if(retorno['erro']){
            //Setting Screen
            document.getElementById("txt_frete").className = "form-control is-invalid";
        }else{
            //Setting Screen
            document.getElementById("txt_frete").className = "form-control is-valid";
        }
        CarregaProdutosPedido();
    });
}








/**
 * Carrega Status Pedido
 */
function CarregaHistoricoStatus() {
    
    let id_pedido = document.getElementById("id_pedido").value;
    clearTable("table_historico_status", 1);
    
    $.getJSON('/carrega_historico_status_pedido?search=',{id_pedido:id_pedido, ajax: 'true'}, function(retorno){

            
            document.getElementById("loading_historico_status").className = "";
            document.getElementById("btn_historico_status").className = "btn btn-outline-info";
        
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                document.getElementById("loading_historico_status").className = "";
            }else{
                //Setting Screen
                document.getElementById("loading_historico_status").className = "";
                
                
                for(let i=0; i < retorno['resultado'].length; i++){
                    var tabela = document.getElementById("table_historico_status");
                    var numeroLinhas = tabela.rows.length;
                    var linha = tabela.insertRow(numeroLinhas);
                    
                    var celula1 = linha.insertCell(0); //item
                    var celula2 = linha.insertCell(1); //adm_name
                    var celula3 = linha.insertCell(2); //fk_id_status
                    var celula4 = linha.insertCell(3); //status_name
                    var celula5 = linha.insertCell(4); //created_at
                    
                    celula1.innerHTML = i+1; 
                    celula2.innerHTML =  retorno['resultado'][i]['adm_name']; 
                    celula3.innerHTML =  retorno['resultado'][i]['fk_id_status'];
                    celula4.innerHTML =  retorno['resultado'][i]['status_name'];
                    celula5.innerHTML =  retorno['resultado'][i]['created_at'];
                    $('#modal_hostorico_status').modal('show');
                }
            }
            
    });
    
}






/**
 * Salva Pagamento sim
 */
function SalvaObs() {
    let id_pedido = document.getElementById("id_pedido").value;
    let txt_obs = document.getElementById("txt_obs_customer").value;
    
    $.getJSON('/salva_obs?search=',{id_pedido:id_pedido, txt_obs:txt_obs, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                document.getElementById("loading_obs").className = "";
                document.getElementById("btn_salvar_obs").className = "btn btn-outline-success disabled mt-1";
                document.getElementById("txt_obs_customer").disabled = false;
            }
    });
}




//Select Status Pedido
$(function(){
    $('#select_status_pedido').change(function(){
        //Setting Screen
        if ($('#select_status_pedido').val() === "0"){
            $('#select_status_pedido').selectpicker('setStyle', 'selectpicker form-control is-invalid');
            $('#select_status_pedido').selectpicker('refresh');
            $('#select_status_pedido').selectpicker('setStyle', 'is-valid', 'remove');
            $('#select_status_pedido').selectpicker('refresh');
        }else{
            
            document.getElementById("loading_status_pedido").className = "spinner-border spinner-border-sm text-primary";
            $('#select_status_pedido').selectpicker('setStyle', 'is-valid', 'remove');
            $('#select_status_pedido').selectpicker('refresh');
            $('#select_status_pedido').selectpicker('setStyle', 'is-invalid', 'remove');
            $('#select_status_pedido').selectpicker('refresh');
            
            $('#select_status_pedido').selectpicker('setStyle', 'selectpicker form-control disabled');
            $('#select_status_pedido').selectpicker('refresh');
            
            
            let id_pedido = document.getElementById("id_pedido").value;
            let id_adm = document.getElementById("id_adm").value;
            
            // Fazendo a consulta
            $.getJSON('/salva_status_pedido?search=',{id_pedido:id_pedido, id_adm:id_adm, id_status_pedido: $(this).val(), ajax: 'true'}, function(j){

                   //Erro. Busca vazia ou execucao da consulta
                    if(j['erro']){
                        $('#select_status_pedido').selectpicker('setStyle', 'selectpicker form-control is-invalid');
                        $('#select_status_pedido').selectpicker('refresh');
                        $('#select_status_pedido').selectpicker('setStyle', 'is-valid', 'remove');
                        $('#select_status_pedido').selectpicker('refresh');
                        document.getElementById("loading_status_pedido").className = "";
                    }else{
                        $('#select_status_pedido').selectpicker('setStyle', 'selectpicker form-control is-valid');
                        $('#select_status_pedido').selectpicker('refresh');
                        $('#select_status_pedido').selectpicker('setStyle', 'is-invalid', 'remove');
                        $('#select_status_pedido').selectpicker('refresh');
                        document.getElementById("loading_status_pedido").className = "";
                    }
            });
        }
    });
});   





//Select Forma Pagamento
$(function(){
    $('#select_forma_pagamento').change(function(){
        //Setting Screen
        if ($('#select_forma_pagamento').val() === "0"){
            $('#select_forma_pagamento').selectpicker('setStyle', 'selectpicker form-control is-invalid');
            $('#select_forma_pagamento').selectpicker('refresh');
            $('#select_forma_pagamento').selectpicker('setStyle', 'is-valid', 'remove');
            $('#select_forma_pagamento').selectpicker('refresh');
        }else{
            
            document.getElementById("loading_forma_pagamento").className = "spinner-border spinner-border-sm text-primary";
            $('#select_forma_pagamento').selectpicker('setStyle', 'is-valid', 'remove');
            $('#select_forma_pagamento').selectpicker('refresh');
            $('#select_forma_pagamento').selectpicker('setStyle', 'is-invalid', 'remove');
            $('#select_forma_pagamento').selectpicker('refresh');
            
            $('#select_forma_pagamento').selectpicker('setStyle', 'selectpicker form-control disabled');
            $('#select_forma_pagamento').selectpicker('refresh');
            
            
            let id_pedido = document.getElementById("id_pedido").value;
            
            // Fazendo a consulta
            $.getJSON('/salva_forma_pagamento?search=',{id_pedido:id_pedido, id_forma_pagamento: $(this).val(), ajax: 'true'}, function(j){

                   //Erro. Busca vazia ou execucao da consulta
                    if(j['erro']){
                        $('#select_forma_pagamento').selectpicker('setStyle', 'selectpicker form-control is-invalid');
                        $('#select_forma_pagamento').selectpicker('refresh');
                        $('#select_forma_pagamento').selectpicker('setStyle', 'is-valid', 'remove');
                        $('#select_forma_pagamento').selectpicker('refresh');
                        document.getElementById("loading_forma_pagamento").className = "";
                    }else{
                        $('#select_forma_pagamento').selectpicker('setStyle', 'selectpicker form-control is-valid');
                        $('#select_forma_pagamento').selectpicker('refresh');
                        $('#select_forma_pagamento').selectpicker('setStyle', 'is-invalid', 'remove');
                        $('#select_forma_pagamento').selectpicker('refresh');
                        document.getElementById("loading_forma_pagamento").className = "";
                    }
            });
        }
    });
});   





/**
 * Atualiza Produtos do pedido atualizando toda a tela.
 */
function CarregaProdutosPedido() {
    let id_pedido = document.getElementById("id_pedido").value;
    document.getElementById("loading_totais").className = "spinner-border spinner-border-sm";
    clearTable("table_produtos", 1);
    
    $.getJSON('/carrega_produtos_pedido?search=',{id_pedido:id_pedido, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                document.getElementById("loading_totais").className = "";
            }else{
                //Setting Screen
                document.getElementById("loading_totais").className = "";
                
                let total_produtos = 0;
                let valor_total = 0;
                
                for(let i=0; i < retorno['resultado'].length; i++){
                    var tabela = document.getElementById("table_produtos");
                    var numeroLinhas = tabela.rows.length;
                    var linha = tabela.insertRow(numeroLinhas);
                    
                    var celula1 = linha.insertCell(0); //item
                    var celula2 = linha.insertCell(1); //ID
                    var celula3 = linha.insertCell(2); //Nome
                    var celula4 = linha.insertCell(3); //Valor unitario
                    var celula5 = linha.insertCell(4); //QTD
                    var celula6 = linha.insertCell(5); //Valor Total
                    var celula7 = linha.insertCell(6); //Obs
                    var celula8 = linha.insertCell(7); //Botao
                    
                    celula1.innerHTML = i+1; 
                    celula2.innerHTML =  retorno['resultado'][i]['fk_id_product']; 
                    celula3.innerHTML =  retorno['resultado'][i]['name'];
                    celula4.innerHTML =  "R$ " + retorno['resultado'][i]['price_unit'];
                    celula5.innerHTML =  retorno['resultado'][i]['qtd'];
                    celula6.innerHTML =  "R$ " + retorno['resultado'][i]['price_total'];
                    celula7.innerHTML =  retorno['resultado'][i]['obs'];
                    
                    
                    //Celula Botao Retirar
                    
                    
                    let btn = '<button type="button" class="btn btn-outline-danger" id="btn_remove_';
                    btn = btn + retorno['resultado'][i]['id_product_order'];
                    btn = btn + '" ';
                    btn = btn + 'onclick="DeletaProdutoPedido(';
                    btn = btn + retorno['resultado'][i]['id_product_order'];
                    btn = btn + ')" ';
                    btn = btn + '>Remover <span class="" id="spinner_remove_produto_pedido_';
                    btn = btn + retorno['resultado'][i]['id_product_order'];
                    btn = btn + '" role="status" aria-hidden="true"></span></button>';
                    celula8.innerHTML =  btn;
//                    console.log(btn);
                    
                    total_produtos = parseInt(total_produtos) + parseInt(retorno['resultado'][i]['qtd']);
                    valor_total = parseFloat(valor_total) + parseFloat(retorno['resultado'][i]['price_total']); 
                }
                
                document.getElementById("txt_valor_parcial").innerHTML = "R$ " + valor_total.toFixed(2);
                let frete = document.getElementById("txt_frete").value.length === 0 ? "0" : document.getElementById("txt_frete").value;
                let total_geral = valor_total + parseFloat(frete);
                document.getElementById("txt_total_itens").innerHTML = total_produtos;
                document.getElementById("txt_valor_total").innerHTML = "R$ " + total_geral.toFixed(2);
            }
    });
}



function clearTable(_idTab, _linhaPersistente){
    //_linhaPersistente = Quantidade de linhas para permanecer na tabela
    var linhas = document.getElementById(_idTab).rows;
    var i = 0;
    for (i= linhas.length-1; i>=0; i--){
            //alert(linhas[i].innerHTML);
            if (i != (_linhaPersistente-1) ){
                    document.getElementById(_idTab).deleteRow(i);
            }
    }
}



/**
 * Gerir Inclusao de Item
 */
function AddProduto(id_produto) {

    $('#modal_cardapio').modal('hide');

    let imagem = "data:image/jpg;base64," + document.getElementById("pd_im_" + id_produto).value;
    let nome = "pd_tt_" + id_produto;
    let preco = "pd_pc_" + id_produto;
    
    document.getElementById("txt_add_descricao").innerHTML  = document.getElementById(nome).innerHTML;
    document.getElementById("txt_add_preco").value          = document.getElementById(preco).innerHTML;
    document.getElementById("txt_add_id").value             = id_produto;
    document.getElementById("txt_add_img").src              = imagem;
    
    $('#modal_confirma_add_produto').modal('show');
    document.getElementById("txt_add_preco").focus();
}


// Listener botao Salva Produto
document.getElementById("btn_incluir_produto").addEventListener("mousedown", function(event) {
    AddProdutoLoadingOn();
    SalvaIncluirProuto();
});


/**
 * Salva Pagamento sim
 */
function SalvaIncluirProuto() {
    
    let fk_id_order     = document.getElementById("id_pedido").value;
    let fk_id_product   = document.getElementById("txt_add_id").value;
    let qtd             = document.getElementById("txt_add_qtd").value;
    let price_unit      = document.getElementById("txt_add_preco").value;
    let obs             = document.getElementById("txt_add_obs").value;
    
    
    $.getJSON('/add_produto_pedido?search=',{
        fk_id_order:fk_id_order, 
        fk_id_product:fk_id_product, 
        qtd:qtd, 
        price_unit:price_unit, 
        obs:obs, 
        ajax: 'true'}, function(retorno){
        
            $('#modal_confirma_add_produto').modal('hide');
            AddProdutoLoadingOff();
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                CarregaProdutosPedido();
            }
    });
}


/**
 * bloqueia componentes add Produto (loading)
 */
function AddProdutoLoadingOn() {
    document.getElementById("txt_add_qtd").disabled = true;
    document.getElementById("txt_add_preco").disabled = true;
    document.getElementById("txt_add_obs").disabled = true;
    document.getElementById("btn_cancel_add_produto").disabled = true;
    document.getElementById("btn_incluir_produto").disabled = true;
    document.getElementById("spinner_add_produto_pedido").className = "spinner-border spinner-border-sm";
}

function AddProdutoLoadingOff() {
    document.getElementById("txt_add_qtd").disabled = false;
    document.getElementById("txt_add_preco").disabled = false;
    document.getElementById("txt_add_obs").disabled = false;
    document.getElementById("btn_cancel_add_produto").disabled = false;
    document.getElementById("btn_incluir_produto").disabled = false;
    document.getElementById("spinner_add_produto_pedido").className = "";
    //Limpa Campos
    document.getElementById("txt_add_qtd").value = "1";
    document.getElementById("txt_add_preco").value = "";
    document.getElementById("txt_add_obs").value = "";
}



/**
 * Salva Pagamento sim
 */
function DeletaProdutoPedido(id_produto_order) {
    
    
    document.getElementById("btn_remove_" + id_produto_order).disabled = true;
    document.getElementById("spinner_remove_produto_pedido_" + id_produto_order).className = "spinner-border spinner-border-sm";
    
    console.log(id_produto_order);
    
    $.getJSON('/remove_produto_pedido?search=',{
        id_produto_order:id_produto_order,  
        ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                CarregaProdutosPedido();
            }
    });
}




// Listener botao Salva Produto
document.getElementById("btn_cancelar_pedido").addEventListener("mousedown", function(event) {
    $('#modal_cancelar_pedido').modal('show');
});


// Listener botao Salva Produto
document.getElementById("btn_confirma_cancelar_pedido").addEventListener("mousedown", function(event) {
    document.getElementById("btn_cancela_cancelar_pedido").disabled = true;
    document.getElementById("btn_confirma_cancelar_pedido").disabled = true;
    document.getElementById("spinner_cancela_pedido").className = "spinner-border spinner-border-sm";
    
    $('#modal_cancelar_pedido').modal('hide');
    $('#modal_cancelando_pedido').modal('show');
    document.getElementById('form_apagar_pedido').submit();

});



