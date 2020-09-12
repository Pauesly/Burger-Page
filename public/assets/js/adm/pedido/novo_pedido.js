$(document).ready(function(){
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('#txt_telefone').mask(SPMaskBehavior, spOptions);
    $('#phone_number_1').mask(SPMaskBehavior, spOptions);
    $('#phone_number_2').mask(SPMaskBehavior, spOptions);
    document.getElementById("txt_telefone").focus();
});


// Listener botao ADD
document.getElementById("btn_new_cliente").addEventListener("mousedown", function(event) {
    document.getElementById('new_tel').value = document.getElementById('txt_telefone').value;
    document.getElementById('form_add_new_cliente').submit();
});



//Valida Senha em branco
document.getElementById("txt_telefone").addEventListener("keyup", function(event) {
    document.getElementById("alert_nao_encontrado").className = "esconder";
    document.getElementById("box_dados_cliente").className = "esconder";
    if (event.keyCode === 13) {
        event.preventDefault();
        if(validaTelefone()){
            BuscaTelefone();
        }
    }
});



function BuscaTelefone() {
    
    document.getElementById("loading_phone1").className = "spinner-border spinner-border-sm";
    document.getElementById("txt_telefone").disabled = true;
//    document.getElementById("txt_name").disabled = true;
    
    let phone = document.getElementById("txt_telefone").value;
    
    $.getJSON('/busca_cliente_por_telefone?search=',{phone:phone, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                document.getElementById("loading_phone1").className = "";
                document.getElementById("txt_telefone").disabled = false;
//                document.getElementById("txt_name").disabled = false;

                document.getElementById("alert_nao_encontrado").className = "alert alert-danger alert-dismissible fade show";
            }else{
                //Setting Screen
                document.getElementById("loading_phone1").className = "";
                document.getElementById("txt_telefone").disabled = false;
                document.getElementById("box_dados_cliente").className = "form-row";
                
                //Dados Ocultos
                document.getElementById("id_customer").value = retorno['resultado'][0]['id_customer'];
                document.getElementById("phone_number_1").value = retorno['resultado'][0]['phone_number_1'];
                
                //Dados Visiveis
                document.getElementById("txt_nome_cliente").innerHTML = retorno['resultado'][0]['name'];
                document.getElementById("txt_tel1_cliente").innerHTML = "<strong>Telefone 1: </strong>" + retorno['resultado'][0]['phone_number_1'];
                document.getElementById("txt_tel2_cliente").innerHTML = "<strong>Telefone 2: </strong>" + retorno['resultado'][0]['phone_number_2'];
                document.getElementById("txt_obs_cliente").innerHTML  = "<strong>Observações: </strong>" + retorno['resultado'][0]['obs'];
            }
    });
}




/**
 * Comment
 */
function validaTelefone() {
    let phone = document.getElementById("txt_telefone").value;
    if(phone.length > 13){
        return true;
    }else{
        return false;
    }
}
















