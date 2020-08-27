// Listener botao ENVIAR
document.getElementById("btn_entrar").addEventListener("mousedown", function(event) {
    FazLoginAdm();
});






/*
 * Funcao que esconde a tela e valida dados ADM
 */
function FazLoginAdm(){
    
    document.getElementById("txt_email").disabled = true;
    document.getElementById("txt_password").disabled = true;
    document.getElementById("btn_entrar").disabled = true;
    document.getElementById("btn_entrar").className = "btn btn-outline-warning disabled";
    
    
    //Coletando dados
    var email = document.getElementById("txt_email").value;
    var senha = document.getElementById("txt_password").value;
    var keep  = document.getElementById("remember").checked;
    

        //Coleta dados
        document.getElementById("email").value          = email;
        document.getElementById("password").value       = senha;
        document.getElementById("keep_conected").value  = keep;

       
        //Enviando
        document.getElementById('form_valida_login').submit();

}





