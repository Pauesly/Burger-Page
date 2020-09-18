$(document).ready(function(){
    $('#txt_add_preco').mask("#,##0.00", {reverse: true});
    $('#select_forma_pagamento')        .selectpicker('val', $("#id_status_pedido")       .val());
    $('#select_status_pedido')          .selectpicker('val', $("#fk_id_status")       .val());
    CarregaProdutosPedido();
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
 * Salva Pagamento sim
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
                console.log(retorno);
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
                    celula8.innerHTML =  '<a class="btn btn-outline-danger" id="btn_pago_sim" role="button">Retirar</a>';
                    
                    total_produtos = parseInt(total_produtos) + parseInt(retorno['resultado'][i]['qtd']);
                    valor_total = parseFloat(valor_total) + parseFloat(retorno['resultado'][i]['price_total']); 
                }
                
                document.getElementById("txt_total_itens").innerHTML = total_produtos;
                document.getElementById("txt_valor_total").innerHTML = "R$ " + valor_total.toFixed(2);
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
    
    let imag = "pd_im_" + id_produto;
    let nome = "pd_tt_" + id_produto;
    let preco = "pd_pc_" + id_produto;
    
    document.getElementById("txt_add_descricao").innerHTML  = document.getElementById(nome).innerHTML;
    document.getElementById("txt_add_preco").value          = document.getElementById(preco).innerHTML;
    document.getElementById("txt_add_id").value             = id_produto;
//    document.getElementById("txt_add_img").src = document.getElementById(imag).src;
    

    
    $('#modal_confirma_add_produto').modal('show');
}












