$(document).ready(function(){
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
//    $('#txt_telefone').mask(SPMaskBehavior, spOptions);
    
//    document.getElementById("txt_telefone").focus();
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




//Select Faculdade
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
















