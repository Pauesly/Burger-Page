// Listener botao ENVIAR
document.getElementById("btn_entrar").addEventListener("mousedown", function(event) {
    FazLoginAdm();
});






/*
 * Funcao que esconde a tela e valida dados ADM
 */
function FazLoginAdm(){
    
    //Coletando dados
    var email = document.getElementById("txt_email").value;
    var senha = document.getElementById("txt_password").value;
    


        //Coleta dados
        document.getElementById("email").value          = email;
        document.getElementById("nome").value           = senha;

       
        //Enviando
        document.getElementById('form_valida_login').submit();

}





