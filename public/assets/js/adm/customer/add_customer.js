$(document).ready(function(){
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('#txt_telefone_1').mask(SPMaskBehavior, spOptions);
    $('#txt_cpf').mask('000.000.000-00');
});




// Listener botao End 1
document.getElementById("btn_salvar_end_1").addEventListener("mousedown", function(event) {
    RegistraEndereco1();
});

/**
 * Comment
 */
function RegistraEndereco1() {
    
    document.getElementById("p_end_1_1").innerHTML  = "Endereço: " + document.getElementById("tipo").value + "<br>\n\
    " + document.getElementById("rua").value + ", " + document.getElementById("numero").value + "\n\
    " + document.getElementById("bairro").value + " - " + document.getElementById("cidade").value + "<br>\n\
    " + "CEP: " + document.getElementById("cep").value + "<br>\n\
    Referencia: " + document.getElementById("referencia").value + "<br>\n\
    Observações: " + document.getElementById("txt_obs_endereco_1").value;
    
    
    $('#add_address').modal('hide');
}


//
//
//// Listener botao ENVIAR
//document.getElementById("btn_entrar").addEventListener("mousedown", function(event) {
//    FazLoginAdm();
//});
//
//













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















//ROTINA CEP 1
function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };












