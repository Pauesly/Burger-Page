
// Listener botao ENVIAR
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {
    if(ValidaCamposObrigatorios()){
        SalvarCliente();
    }
});



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




/*
 * Funcao que esconde a tela e valida dados ADM
 */
function SalvarCliente(){
    
    LaunchLoading();
    
//  Coletando e preenchendo todos os dados
    document.getElementById("name").value =                     document.getElementById("txt_name").value;
    document.getElementById("sequence").value =                 document.getElementById("txt_ordem").value;

    
    //Enviando
    document.getElementById('cadastrar_novo_item').submit();

}



/**
 * Valida Campos preenchidos
 */
function ValidaCamposObrigatorios() {
    
    let validacoes = 0;
    
    if(document.getElementById("txt_name").value.length > 1){ 
        validacoes++; 
    }else{
        document.getElementById("txt_name").className = "form-control is-invalid";
    }
    
    if(document.getElementById("txt_ordem").value.length > 0){ 
        validacoes++; 
    }else{
        document.getElementById("txt_ordem").className = "form-control is-invalid";
    }
    
    
    
    if(validacoes === 2){
        return true;
    }else{
        return false;
    }
}






















