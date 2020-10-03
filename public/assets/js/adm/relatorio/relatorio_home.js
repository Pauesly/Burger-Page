$(document).ready(function() {
    //Date Picker
    var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd-mm-yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		});
        
        $("#txt_data_inicial").datepicker().datepicker('setDate', new Date());
        $("#txt_data_final").datepicker().datepicker('setDate', new Date());
        
        $('#select_cliente')  .selectpicker('val', $("") .val());
        $('#select_produto')  .selectpicker('val', $("") .val());
        $('#select_categoria')  .selectpicker('val', $("") .val());
        $('#select_municipio')  .selectpicker('val', $("") .val());
        $('#select_cidade')  .selectpicker('val', $("") .val());
} );


// Listener botao ATIVA
document.getElementById("btn_completa").addEventListener("mousedown", function(event) {
    document.getElementById("btn_completa").className = "btn btn-success btn-block text-white";
    document.getElementById("btn_parcial").className = "btn btn-outline-info btn-block";
    document.getElementById("tipo_busca").value = "1";
    SetFiltro();
});

// Listener botao INATIVA
document.getElementById("btn_parcial").addEventListener("mousedown", function(event) {
    document.getElementById("btn_completa").className = "btn btn-outline-success btn-block";
    document.getElementById("btn_parcial").className = "btn btn-info btn-block text-white";
    document.getElementById("tipo_busca").value = "0";
    SetFiltro();
});


/**
 * Verifica o tipo de busca
 */
function SetFiltro() {
    if(document.getElementById("tipo_busca").value === "1"){
        $('#div_opcoes_filtro').collapse('hide');
        console.log("tudo");
    }else{
        $('#div_opcoes_filtro').collapse('show');
        console.log("parcial");
    }
}


// BTN Confirma realizar consulta
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {
    SelecionaConsulta();
});


/**
 * Realiza consulta
 */
function SelecionaConsulta() {
    
    if(document.getElementById("tipo_busca").value === "1"){
        //Consulta Completa
        let link = "relatorio_full?"
        link = link + "inicial=" +  document.getElementById("txt_data_inicial").value;
        link = link + "&final="   +  document.getElementById("txt_data_final").value;
        
        document.getElementById("btn_busca_full").href=link; 
        document.getElementById("btn_busca_full").click();
    }else{
        console.log("buscar com filtro");
        
    }
}




/**
 * Carregar Select Clientes
 */
function LoadClientes() {
    document.getElementById("loading_cliente").className = "spinner-border spinner-border-sm text-primary";
    
    $.getJSON('/busca_cliente_to_select',{}, function(retorno){
        
        document.getElementById("loading_cliente").className = "";
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                alert("ERRO # Contactar Administrador.");
            }else{
                //Setting Screen
                EnableButtons();
                PreencheSelect("select_cliente", "id_customer", "name", retorno['resultado']);
            }
    });
}





/**
 * Preenche Select
 */
function PreencheSelect(select, id, name, conteudo ) {
    console.log(select);
}









//Listeners Clickem Radio
$(document).ready(function () {
    $('#radio_cliente_vezes').click(function () {   UnsetButtons();   });
    $('#radio_cliente_valor').click(function () {   UnsetButtons();   });
    $('#radio_vendas_custo').click(function () {   UnsetButtons();   });
    $('#radio_produto_abc').click(function () {   UnsetButtons();   });
});


// Listeners Click em botoes
document.getElementById("btn_cliente").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadClientes();
//        document.getElementById("btn_cliente").className = "btn btn-info";
});

document.getElementById("btn_produto").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadProdutos();
});

document.getElementById("btn_categoria").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadCategorias();
});

document.getElementById("btn_municipio").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadMunicipios();
});

document.getElementById("btn_cidade").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadCidades();
});

document.getElementById("btn_pagamento").addEventListener("mousedown", function(event) {
        UnsetRadios();
        UnsetButtons();
        DisableSelects();
        DisableButtons();
        LoadPagamentos();
});


/**
 * Unset All butons
 */
function UnsetButtons() {
    document.getElementById("btn_cliente").className = "btn btn-outline-secondary";
    document.getElementById("btn_produto").className = "btn btn-outline-secondary";
    document.getElementById("btn_categoria").className = "btn btn-outline-secondary";
    document.getElementById("btn_municipio").className = "btn btn-outline-secondary";
    document.getElementById("btn_cidade").className = "btn btn-outline-secondary";
    document.getElementById("btn_pagamento").className = "btn btn-outline-secondary";
}

/**
 * Disabled All butons
 */
function DisableButtons() {
    document.getElementById("btn_cliente").disabled = true;
    document.getElementById("btn_produto").disabled = true;
    document.getElementById("btn_categoria").disabled = true;
    document.getElementById("btn_municipio").disabled = true;
    document.getElementById("btn_cidade").disabled = true;
    document.getElementById("btn_pagamento").disabled = true;
    document.getElementById("btn_validar").className = "btn btn-success btn-lg btn-block text-white disabled";
}

/**
 * Enable All butons
 */
function EnableButtons() {
    document.getElementById("btn_cliente").disabled = false;
    document.getElementById("btn_produto").disabled = false;
    document.getElementById("btn_categoria").disabled = false;
    document.getElementById("btn_municipio").disabled = false;
    document.getElementById("btn_cidade").disabled = false;
    document.getElementById("btn_pagamento").disabled = false;
    document.getElementById("btn_validar").className = "btn btn-success btn-lg btn-block text-white";
}


/**
 * Disable all Select
 */
function DisableSelects() {
    document.getElementById("select_cliente").disabled = true;
    document.getElementById("select_produto").disabled = true;
    document.getElementById("select_categoria").disabled = true;
    document.getElementById("select_municipio").disabled = true;
    document.getElementById("select_cidade").disabled = true;
    document.getElementById("select_pagamento").disabled = true;
}


/**
 * Unset all Radios
 */
function UnsetRadios() {
    document.getElementById("radio_cliente_vezes").checked = false;
    document.getElementById("radio_cliente_valor").checked = false;
    document.getElementById("radio_vendas_custo").checked = false;
    document.getElementById("radio_produto_abc").checked = false;
}


/**
 * Unselect Every Filter
 */
function UnselectEveryFilter() {
    document.getElementById("radio_cliente_vezes").checked = false;
}



