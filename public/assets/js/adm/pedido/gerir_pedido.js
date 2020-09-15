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
                document.getElementById("btn_pago_sim").className = "btn btn-success";
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
                document.getElementById("btn_pago_nao").className = "btn btn-danger";
            }
    });
}


//LISTENERS DE DIGITACAO OBS
document.getElementById("txt_obs_customer").addEventListener("keyup", function(event) {
    document.getElementById("btn_salvar_obs").className = "btn btn-danger mt-1";
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














