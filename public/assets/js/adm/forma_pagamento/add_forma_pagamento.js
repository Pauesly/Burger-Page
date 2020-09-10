
// Listener botao ENVIAR
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {
    if(ValidaCamposObrigatorios()){
        SalvarCliente();
    }
});





/*
 * Funcao que esconde a tela e valida dados ADM
 */
function SalvarCliente(){
    
    LaunchLoading();
    
//  Coletando e preenchendo todos os dados
    document.getElementById("name").value =                     document.getElementById("txt_name").value;

    
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
    
    
    
    if(validacoes === 1){
        return true;
    }else{
        return false;
    }
}






















