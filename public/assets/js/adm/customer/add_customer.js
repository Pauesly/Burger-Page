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
    $('#txt_telefone_2').mask(SPMaskBehavior, spOptions);
    $('#txt_cpf').mask('000.000.000-00');
});




// Listener botao End 1
document.getElementById("btn_salvar_end_1").addEventListener("mousedown", function(event) {
    RegistraEndereco1();
});
// Listener botao End 2
document.getElementById("btn_salvar_end_2").addEventListener("mousedown", function(event) {
    RegistraEndereco2();
});


/**
 * ontroles Enderecos
 */
function RegistraEndereco1() {
    
    document.getElementById("p_end_1_1").innerHTML  = "Endereço: " + document.getElementById("tipo").value + "<br>\n\
    " + document.getElementById("rua").value + ", " + document.getElementById("numero").value + "\n\
    " + document.getElementById("bairro").value + " - " + document.getElementById("cidade").value + "<br>\n\
    " + "CEP: " + document.getElementById("cep").value + "<br>\n\
    Referencia: " + document.getElementById("referencia").value + "<br>\n\
    Observações: " + document.getElementById("txt_obs_endereco_1").value;
    
    document.getElementById("btn_add_Adress").className = "btn btn-outline-info";
    
    $('#add_address').modal('hide');
}
function RegistraEndereco2() {
    
    document.getElementById("p_end_1_2").innerHTML  = "Endereço: " + document.getElementById("tipo2").value + "<br>\n\
    " + document.getElementById("rua2").value + ", " + document.getElementById("numero2").value + "\n\
    " + document.getElementById("bairro2").value + " - " + document.getElementById("cidade2").value + "<br>\n\
    " + "CEP: " + document.getElementById("cep2").value + "<br>\n\
    Referencia: " + document.getElementById("referencia2").value + "<br>\n\
    Observações: " + document.getElementById("txt_obs_endereco_2").value;
    
    
    $('#add_address2').modal('hide');
}



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
    document.getElementById("phone_1").value =              document.getElementById("txt_telefone_1").value;
    document.getElementById("phone_2").value =              document.getElementById("txt_telefone_2").value;
    document.getElementById("nome").value =                 document.getElementById("txt_name").value;
    document.getElementById("cpf").value =                  document.getElementById("txt_cpf").value;
    document.getElementById("obs").value =                  document.getElementById("txt_obs_customer").value;
    document.getElementById("address_tipo1").value =        document.getElementById("tipo").value;
    document.getElementById("address_cep1").value =         document.getElementById("cep").value;
    document.getElementById("address_rua1").value =         document.getElementById("rua").value;
    document.getElementById("address_numero1").value =      document.getElementById("numero").value;
    document.getElementById("address_bairro1").value =      document.getElementById("bairro").value;
    document.getElementById("address_cidade1").value =      document.getElementById("cidade").value;
    document.getElementById("address_estado1").value =      document.getElementById("uf").value;
    document.getElementById("address_referencia1").value =  document.getElementById("referencia").value;
    document.getElementById("address_obs1").value =         document.getElementById("txt_obs_endereco_1").value;
    document.getElementById("address_tipo2").value =        document.getElementById("tipo2").value;
    document.getElementById("address_cep2").value =         document.getElementById("cep2").value;
    document.getElementById("address_rua2").value =         document.getElementById("rua2").value;
    document.getElementById("address_numero2").value =      document.getElementById("numero2").value;
    document.getElementById("address_bairro2").value =      document.getElementById("bairro2").value;
    document.getElementById("address_cidade2").value =      document.getElementById("cidade2").value;
    document.getElementById("address_estado2").value =      document.getElementById("uf2").value;
    document.getElementById("address_referencia2").value =  document.getElementById("referencia2").value;
    document.getElementById("address_obs2").value =         document.getElementById("txt_obs_endereco_2").value;
    

       
    //Enviando
    document.getElementById('cadastrar_novo_cliente').submit();

}



/**
 * Valida Campos preenchidos
 */
function ValidaCamposObrigatorios() {
    
    let validacoes = 0;
    
    if(document.getElementById("txt_telefone_1").value.length > 13){ 
        validacoes++; 
    }else{
        document.getElementById("txt_telefone_1").className = "form-control is-invalid";
    }
    
    if(document.getElementById("txt_name").value.length > 1){ 
        validacoes++; 
    }else{
        document.getElementById("txt_name").className = "form-control is-invalid";
    }
    
    if(document.getElementById("p_end_1_1").innerHTML.length > 10){ 
        validacoes++; 
    }else{
        document.getElementById("btn_add_Adress").className = "btn btn-outline-info is-invalid";
    }
    
    if(validacoes === 3){
        return true;
    }else{
        return false;
    }
}



//Valida e verifica Telefone
function validaTelefone1(tel) {
    
    document.getElementById("loading_phone1").className = "spinner-border spinner-border-sm text-warning";
    document.getElementById("txt_telefone_1").disabled = true;
    
    if(tel.length < 14){
        document.getElementById("txt_telefone_1").className = "form-control is-invalid";
        document.getElementById("btn_validar").className = "btn btn-outline-danger btn-lg btn-block disabled";
        document.getElementById("loading_phone1").className = "";
        document.getElementById("txt_telefone_1").disabled = false;
    }else{
        // Fazendo a consulta
        $.getJSON('/valida_telefone_unico?search=',{telefone_check: tel, ajax: 'true'}, function(retorno){

               if(retorno === true){
                    document.getElementById("txt_telefone_1").className = "form-control is-valid";
                    document.getElementById("btn_validar").className = "btn btn-outline-success btn-lg btn-block";
                    document.getElementById("loading_phone1").className = "";
                    document.getElementById("txt_telefone_1").disabled = false;
               }else{
                    document.getElementById("txt_telefone_1").className = "form-control is-invalid";
                    document.getElementById("btn_validar").className = "btn btn-outline-danger btn-lg btn-block disabled";
                    document.getElementById("loading_phone1").className = "";
                    document.getElementById("txt_telefone_1").disabled = false;
               }
        });
    }
    
}

function validaTelefone2(tel) {
    
    document.getElementById("loading_phone2").className = "spinner-border spinner-border-sm text-warning";
    document.getElementById("txt_telefone_2").disabled = true;
    
    if(tel == ""){
        document.getElementById("txt_telefone_2").className = "form-control";
        document.getElementById("loading_phone2").className = "";
        document.getElementById("txt_telefone_2").disabled = false;
    }else{
        // Fazendo a consulta
        $.getJSON('/valida_telefone_unico?search=',{telefone_check: tel, ajax: 'true'}, function(retorno){
                if(retorno === true){
                     document.getElementById("txt_telefone_2").className = "form-control is-valid";
                     document.getElementById("btn_validar").className = "btn btn-outline-success btn-lg btn-block";
                     document.getElementById("loading_phone2").className = "";
                     document.getElementById("txt_telefone_2").disabled = false;
                }else{
                    document.getElementById("txt_telefone_2").className = "form-control is-invalid";
                    document.getElementById("btn_validar").className = "btn btn-outline-danger btn-lg btn-block disabled";
                     document.getElementById("loading_phone2").className = "";
                     document.getElementById("txt_telefone_2").disabled = false;
                }
         });
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





//ROTINA CEP 2
function limpa_formulário_cep2() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua2').value=("");
        document.getElementById('bairro2').value=("");
        document.getElementById('cidade2').value=("");
        document.getElementById('uf2').value=("");
}

function meu_callback2(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua2').value=(conteudo.logradouro);
        document.getElementById('bairro2').value=(conteudo.bairro);
        document.getElementById('cidade2').value=(conteudo.localidade);
        document.getElementById('uf2').value=(conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep2();
        alert("CEP não encontrado.");
    }
}
        
function pesquisacep2(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua2').value="...";
            document.getElementById('bairro2').value="...";
            document.getElementById('cidade2').value="...";
            document.getElementById('uf2').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback2';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep2();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep2();
    }
};









