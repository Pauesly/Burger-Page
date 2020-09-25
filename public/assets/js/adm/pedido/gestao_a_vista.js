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
                
    $('#tabela_principal').DataTable();
    
    
    AtualizaTabela();
    
} );




function AtualizaTabela() {
    document.getElementById("loading_table").className = "spinner-border text-success";

    let data =  document.getElementById("txt_data_inicial").value;
    
    $.getJSON('/carregar_gestao_a_vista?search=',{
        data_setted:data, 
        ajax: 'true'}, function(retorno){
        
            document.getElementById("loading_table").className = "";

            $('#tabela_principal').DataTable().clear().draw();
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
            }else{
                //Setting Screen
                retorno['resultado'].forEach(PreencheTabela);
                document.getElementById('tabela_principal').scrollIntoView(true);
            }
            
            cronometro(); //lanca o cronometro para  carregar novamente
    });
}



function cronometro() {
    var segundos = document.getElementById("select_time").value;
    $('#txt_count_down').text("Próxima Atualização: " + segundos);
    var contadorID = setInterval(function(){
        if(segundos == 0){
            clearInterval(contadorID);
            AtualizaTabela();
        }else{
            segundos --;
            $('#txt_count_down').text("Próxima Atualização: " + segundos);
        }
    }, 1000);
}


function PreencheTabela(item, indice) {
    $('#tabela_principal').dataTable().fnAddData( [
        indice + 1,
        item.customer_name,
        item.payment_term_name,
        item.total,
        item.payment_status == 0 ? "Pendente" : "Pago",
        '<span class="badge" style="background : #' + item.color_code + '">' + item.status_name + '</span>',
//        '<div class="alert alert-primary" role="alert">' + item.status_name + '</div>',
        item.created_at,
        '<a onclick="edit_pedido(' + item.id_order + ');" class="btn btn-outline-info  btn-block">' + item.id_order + '</a>',
    ] );
}



function edit_pedido(id_pedido) {
    LaunchLoading();
    document.getElementById('id_pedido').value = id_pedido;
    document.getElementById('form_edit_pedido').submit();
    
}















