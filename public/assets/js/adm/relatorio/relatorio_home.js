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
        
        $("#txt_data_inicial").datepicker().datepicker('setDate', new Date());
        $("#txt_data_final").datepicker().datepicker('setDate', new Date());
        
} );



// Listener botao ATIVA
document.getElementById("ativo_sim").addEventListener("mousedown", function(event) {
    document.getElementById("ativo_sim").className = "btn btn-success btn-block";
    document.getElementById("ativo_nao").className = "btn btn-outline-danger btn-block";
    document.getElementById("active").value = "1";
});

// Listener botao INATIVA
document.getElementById("ativo_nao").addEventListener("mousedown", function(event) {
    document.getElementById("ativo_sim").className = "btn btn-outline-success btn-block";
    document.getElementById("ativo_nao").className = "btn btn-danger btn-block";
    document.getElementById("active").value = "0";
});






// Confirma realizar consulta
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {
    if(ValidaDados()){
        RealizaConsulta();
    }
});



/**
 * Valida dados para consultar
 */
function ValidaDados() {
    return true;
}



/**
 * Realiza consulta
 */
function RealizaConsulta() {
    console.log("Vai consultar");;
}

























/*
 * Funcao que esconde a tela e valida dados ADM
 */
function SalvarCliente(){
    
    LaunchLoading();
    
//  Coletando e preenchendo todos os dados
    document.getElementById("name").value =               document.getElementById("txt_name").value;
    document.getElementById("email").value =              document.getElementById("txt_email").value;
    document.getElementById("obs").value =                document.getElementById("txt_obs_customer").value;

    
    //Enviando
    document.getElementById('cadastrar_novo_item').submit();

}
























