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
    
    
    cronometro();
    
} );


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


function AtualizaTabela() {
    document.getElementById("loading_table").className = "spinner-border text-success";
    console.log("Zerou");
    cronometro();
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
    document.getElementById('id_pedido').value = id_pedido;
    document.getElementById('form_edit_pedido').submit();
}













var tempo = new Number();
// Tempo em segundos
tempo = 5;

function startCountdown(){

	// Se o tempo não for zerado
	if((tempo - 1) >= 0){

		// Pega a parte inteira dos minutos
		var min = parseInt(tempo);
		// Calcula os segundos restantes
		var seg = tempo;

		// Formata o número menor que dez, ex: 08, 07, ...
		if(min < 10){
			min = "0"+min;
			min = min.substr(0, 2);
		}
		if(seg <=9){
			seg = "0"+seg;
		}

		// Cria a variável para formatar no estilo hora/cronômetro
		horaImprimivel = '00:' + min + ':' + seg;
		//JQuery pra setar o valor
		$("#sessao").html(horaImprimivel);
                document.getElementById('txt_count_down').value = horaImprimivel;

		// Define que a função será executada novamente em 1000ms = 1 segundo
		setTimeout('startCountdown()',1000);

		// diminui o tempo
		tempo--;

	// Quando o contador chegar a zero faz esta ação
	} else {
        console.log("Acabou");
	}

}

















