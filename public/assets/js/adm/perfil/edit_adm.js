

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
    document.getElementById("name").value =              document.getElementById("txt_name").value;
    document.getElementById("email").value =              document.getElementById("txt_email").value;
    document.getElementById("obs").value =                 document.getElementById("txt_obs_customer").value;
    

    //Enviando
    document.getElementById('edit_cliente').submit();
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
    
    if(document.getElementById("txt_email").value.length > 5){ 
        validacoes++; 
    }else{
        document.getElementById("txt_email").className = "btn btn-outline-info is-invalid";
    }
    
    if(validacoes === 2){
        return true;
    }else{
        return false;
    }
}



function validaNome(nome) {
    if(nome.length > 1){
         document.getElementById("txt_name").className = "form-control is-valid";
         document.getElementById("btn_validar").className = "btn btn-outline-success btn-lg btn-block";
    }else{
        document.getElementById("txt_name").className = "form-control is-invalid";
        document.getElementById("btn_validar").className = "btn btn-outline-danger btn-lg btn-block disabled";
    }
}





// Listener botao ENVIAR
document.getElementById("btn_reset_senha").addEventListener("mousedown", function(event) {
    ResetSenha();
});


/**
 * Reset Senha
 */
function ResetSenha() {
    
    document.getElementById("div_confirma_senha").className = "esconder";
    document.getElementById("div_apagando_senha").className = "";
    document.getElementById("btn_validar").className = "btn btn-outline-success btn-lg btn-block disabled";
    
    let id = document.getElementById("id_adm").value;
    let id_logged = document.getElementById("id_adm_logged").value;
    
    $.getJSON('/reset_senha_adm?search=',{id:id, ajax: 'true'}, function(retorno){
        
        console.log("isso: " + retorno["erro"]);
        
        if(retorno['erro'] === "false"){
            alert("Senha resetada. No próximo login entre com a senha padrão: 123456");
            LaunchLoading();
            
            console.log(id_logged);
            if(id_logged === 1){
                document.getElementById('logout').submit();
            }else{
                document.getElementById('gerir_adm').submit();
            }
            
        }else{
            alert("### ERRO - Contate Administrador.");
        }

    });
}





