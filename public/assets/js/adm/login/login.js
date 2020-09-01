// Listener botao ENVIAR
document.getElementById("btn_entrar").addEventListener("mousedown", function(event) {
    FazLoginAdm();
});

//Valida Senha em branco
document.getElementById("txt_password").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        FazLoginAdm();
    }
});




/*
 * Funcao que esconde a tela e valida dados ADM
 */
function FazLoginAdm(){
    document.getElementById("remember").disabled = true;
    document.getElementById("txt_email").disabled = true;
    document.getElementById("txt_password").disabled = true;
    
    document.getElementById("show_load").className = "col-md-6 offset-md-4";
    document.getElementById("show_btn").className = "esconder";
    
    
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





