// Listener botao ENVIAR
document.getElementById("btn_entrar").addEventListener("mousedown", function(event) {
    FazLoginAdm();
});




//Valida Senha em branco
document.getElementById("txt_password1").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("txt_password2").focus();
    }
});


//Valida Senha em branco
document.getElementById("txt_password2").addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        FazLoginAdm();
    }
});




/*
 * Funcao que esconde a tela e valida dados ADM
 */
function FazLoginAdm(){
    
    //Coletando dados
    var password1 = document.getElementById("txt_password1").value;
    var password2 = document.getElementById("txt_password2").value;
    
    if(password1 !== password2){
        document.getElementById("txt_password2").className = "form-control is-invalid";
    }else{
        document.getElementById("txt_password1").disabled = true;
        document.getElementById("txt_password2").disabled = true;

        document.getElementById("show_load").className = "col-md-6 offset-md-4";
        document.getElementById("show_btn").className = "esconder";

        //Coleta dados
        document.getElementById("password").value          = password1;

//        Enviando
        document.getElementById('form_valida_login').submit();
    }
}





