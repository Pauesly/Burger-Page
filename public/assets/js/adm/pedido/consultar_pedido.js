$(document).ready(function() {
    
    //Date Picker
    var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		});
    
    //Mascara Telefone
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('#txt_busca_telefone').mask(SPMaskBehavior, spOptions);
    
    $('#tabela_principal').DataTable();
} );

// Switch Nome
$('#switch_nome').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_nome").className = "container";
    }else{
        document.getElementById("filter_nome").className = "esconder";
    }
});

//Switch Telefone
$('#switch_telefone').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_telefone").className = "container";
    }else{
        document.getElementById("filter_telefone").className = "esconder";
    }
});

//Switch data
$('#switch_data').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_data").className = "container";
    }else{
        document.getElementById("filter_data").className = "esconder";
    }
});



// Listener Botao Confirma filtro
document.getElementById("btn_realiza_filtro").addEventListener("mousedown", function(event) {
    if ($('#switch_nome').is(':checked') ||
            $('#switch_telefone').is(':checked') ||
            $('#switch_data').is(':checked')){
        
        RealizaBusca();
    }else{
        document.getElementById("erro_no_filter").className = "alert alert-danger";
    }
});



/**
 * Realiza Busca deacordo com filtros selecionados
 */
function RealizaBusca() {
    document.getElementById("btn_realiza_filtro").className = "btn btn-secondary btn-block text-white disabled";
    document.getElementById("spinner_realizando_busca").className = "spinner-border spinner-border-sm";
    
    if (ValidaCampos()){
        Consultar();
    }
}


/**
 * Verifica filtro ativo
 */
function ValidaCampos() {
    
    let contador = 0;
    
    if($('#switch_nome').is(':checked')){
        if(document.getElementById("txt_busca_nome").value.length > 1){
            document.getElementById("txt_busca_nome").className = "form-control";
        }else{
            document.getElementById("txt_busca_nome").className = "form-control is-invalid";
            contador++;
        }
    }
    
    if($('#switch_telefone').is(':checked')){
        if(document.getElementById("txt_busca_telefone").value.length > 13){
            document.getElementById("txt_busca_telefone").className = "form-control";
        }else{
            document.getElementById("txt_busca_telefone").className = "form-control is-invalid";
            contador++;
        }
    }
    
    if($('#switch_data').is(':checked')){
        if((document.getElementById("txt_data_inicial").value.length > 5) || (document.getElementById("txt_data_final").value.length > 5)){
            document.getElementById("txt_data_inicial").className = "form-control";
            document.getElementById("txt_data_final").className = "form-control";
        }else{
            document.getElementById("txt_data_inicial").className = "form-control is-invalid";
            document.getElementById("txt_data_final").className = "form-control is-invalid";
            contador++;
        }
    }

    
    if(contador === 0){
        return true;
    }else{
        console.log(contador);
        document.getElementById("btn_realiza_filtro").className = "btn btn-info btn-block text-white";
        document.getElementById("spinner_realizando_busca").className = "esconder";
        return false;
    }
}


/**
 * Realiza Busca
 */
function Consultar() {
    
    let nome;
    let telefone;
    let data_inicial;
    let data_final;
    
    $('#switch_nome').is(':checked')     ? nome         = document.getElementById("txt_busca_nome").value       : nome         = "666";
    $('#switch_telefone').is(':checked') ? telefone     = document.getElementById("txt_busca_telefone").value   : telefone     = "666";
    $('#switch_data').is(':checked')     ? data_inicial = document.getElementById("txt_data_inicial").value     : data_inicial = "666";
    $('#switch_data').is(':checked')     ? data_final   = document.getElementById("txt_data_final").value       : data_final   = "666";
    
    console.log("Vai mandar:");
    console.log("nm: " + nome);
    console.log("tel: " + telefone);
    console.log("dti: " + data_inicial);
    console.log("dtF: " + data_final);
    $.getJSON('/realizar_busca_pedido_filtros?search=',{
        nome:nome, 
        telefone:telefone, 
        data_inicial:data_inicial, 
        data_final:data_final, 
        ajax: 'true'}, function(retorno){
        
            console.log(retorno);
            
            document.getElementById("btn_realiza_filtro").className = "btn btn-info btn-block text-white";
            document.getElementById("spinner_realizando_busca").className = "esconder";
            $('#tabela_principal').DataTable().clear().draw();
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                console.log("nenhum resultado");
            }else{
                //Setting Screen
                retorno['resultado'].forEach(PreencheTabela);
                document.getElementById('tabela_principal').scrollIntoView(true);
            }
    });
}



function PreencheTabela(item, indice) {
    $('#tabela_principal').dataTable().fnAddData( [
        indice + 1,
        item.customer_name,
        item.payment_term_name,
        item.total,
        item.payment_status == 0 ? "Pendente" : "Pago",
        item.status_name,
        item.created_at,
        '<a onclick="edit_pedido(' + item.id_order + ');" class="btn btn-outline-info  btn-block">' + item.id_order + '</a>',
    ] );
}



function edit_pedido(id_pedido) {
    LaunchLoading();
    document.getElementById('id_pedido').value = id_pedido;
    document.getElementById('form_edit_pedido').submit();
}















