// Listener botao ENVIAR
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {

        SalvarCliente();
});



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
























