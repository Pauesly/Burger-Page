$(document).ready(function(){
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('#txt_telefone').mask(SPMaskBehavior, spOptions);
    $('#phone_number_1').mask(SPMaskBehavior, spOptions);
    $('#phone_number_2').mask(SPMaskBehavior, spOptions);
    document.getElementById("txt_telefone").focus();
});


// Listener botao ADD
document.getElementById("btn_new_cliente").addEventListener("mousedown", function(event) {
    document.getElementById('new_tel').value = document.getElementById('txt_telefone').value;
    document.getElementById('form_add_new_cliente').submit();
});



//Valida Senha em branco
document.getElementById("txt_telefone").addEventListener("keyup", function(event) {
    document.getElementById("alert_nao_encontrado").className = "esconder";
    document.getElementById("box_dados_cliente").className = "esconder";
    if (event.keyCode === 13) {
        event.preventDefault();
        if(validaTelefone()){
            BuscaTelefone();
        }
    }
});



function BuscaTelefone() {
    
    document.getElementById("loading_phone1").className = "spinner-border spinner-border-sm";
    document.getElementById("txt_telefone").disabled = true;
//    document.getElementById("txt_name").disabled = true;
    
    let phone = document.getElementById("txt_telefone").value;
    
    $.getJSON('/busca_cliente_por_telefone?search=',{phone:phone, ajax: 'true'}, function(retorno){
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                document.getElementById("loading_phone1").className = "";
                document.getElementById("txt_telefone").disabled = false;
//                document.getElementById("txt_name").disabled = false;

                document.getElementById("alert_nao_encontrado").className = "alert alert-danger alert-dismissible fade show";
            }else{
                //Setting Screen
                document.getElementById("loading_phone1").className = "";
                document.getElementById("txt_telefone").disabled = false;
                document.getElementById("box_dados_cliente").className   = "form-row";
                
                //Dados Ocultos
                document.getElementById("id_customer").value = retorno['resultado'][0]['id_customer'];
                
                //Dados Visiveis cliente
                document.getElementById("txt_nome_cliente").innerHTML = retorno['resultado'][0]['name'];
                document.getElementById("txt_tel1_cliente").innerHTML = "<strong>Telefone 1: </strong>" + retorno['resultado'][0]['phone_number_1'];
                document.getElementById("txt_tel2_cliente").innerHTML = "<strong>Telefone 2: </strong>" + retorno['resultado'][0]['phone_number_2'];
                document.getElementById("txt_obs_cliente").innerHTML  = "<strong>Observações: </strong>" + retorno['resultado'][0]['obs'];
                
                BuscaEndereco(retorno['resultado'][0]['id_customer']);
            }
    });
}




/**
 * Comment
 */
function BuscaEndereco($id_cliente) {
    document.getElementById("loading_endereco").className   = "text-center";
    
    $.getJSON('/busca_enderecos_de_cliente?search=',{id:$id_cliente, ajax: 'true'}, function(retorno){
        
            document.getElementById("loading_endereco").className   = "esconder";
        
           //Erro. Busca vazia ou execucao da consulta
            if(retorno['erro']){
                //Setting Screen
                document.getElementById("alerto_erro_endereco").className = "text-center";
                document.getElementById("loading_endereco").className   = "esconder";
            }else{
                //Setting Screen
                document.getElementById("loading_endereco").className   = "esconder";
                document.getElementById("box_dados_enderecos").className   = "row";
                
                //Dados Visiveis cliente
                document.getElementById("txt_id_end_1").value   = retorno['resultado'][0]['id_address'];
                document.getElementById("txt_local_1").innerHTML   = "Local: " + retorno['resultado'][0]['local'];
                document.getElementById("txt_end_1").innerHTML   =  
                        retorno['resultado'][0]['rua'] + ", " +
                        retorno['resultado'][0]['numero_complemento'] +  " - " +
                        retorno['resultado'][0]['bairro'] +  " - " +
                        retorno['resultado'][0]['cidade'] +  " - " +
                        retorno['resultado'][0]['estado'] +  " - " +
                        retorno['resultado'][0]['cep'];
                document.getElementById("txt_end__ref_1").innerHTML   = "Referencia: " + retorno['resultado'][0]['referencia'];
                document.getElementById("txt_end__obs_1").innerHTML   = "Obs: " + retorno['resultado'][0]['obs'];

                document.getElementById("txt_id_end_2").value   = retorno['resultado'][1]['id_address'];
                document.getElementById("txt_local_2").innerHTML   = "Local: " + retorno['resultado'][1]['local'];
                document.getElementById("txt_end_2").innerHTML   =  
                        retorno['resultado'][1]['rua'] + ", " +
                        retorno['resultado'][1]['numero_complemento'] +  " - " +
                        retorno['resultado'][1]['bairro'] +  " - " +
                        retorno['resultado'][1]['cidade'] +  " - " +
                        retorno['resultado'][1]['estado'] +  " - " +
                        retorno['resultado'][1]['cep'];
                document.getElementById("txt_end__ref_2").innerHTML   = "Referencia: " + retorno['resultado'][1]['referencia'];
                document.getElementById("txt_end__obs_2").innerHTML   = "Obs: " + retorno['resultado'][1]['obs'];
                
                PreencheMoralEndereco(retorno);
            }
    });
}




/**
 * Preenche Enderecos no Modal
 */
function PreencheMoralEndereco(dados) {
    document.getElementById("txt_id_end1").value        = dados['resultado'][0]['id_address'];
    document.getElementById("tipo").value               = dados['resultado'][0]['local'];
    document.getElementById("cep").value                = dados['resultado'][0]['cep'];
    document.getElementById("rua").value                = dados['resultado'][0]['rua'];
    document.getElementById("numero").value             = dados['resultado'][0]['numero_complemento'];
    document.getElementById("bairro").value             = dados['resultado'][0]['bairro'];
    document.getElementById("cidade").value             = dados['resultado'][0]['cidade'];
    document.getElementById("uf").value                 = dados['resultado'][0]['estado'];
    document.getElementById("referencia").value         = dados['resultado'][0]['referencia'];
    document.getElementById("txt_obs_endereco_1").value = dados['resultado'][0]['obs'];
    
    document.getElementById("txt_id_end2").value         = dados['resultado'][1]['id_address'];
    document.getElementById("tipo2").value               = dados['resultado'][1]['local'];
    document.getElementById("cep2").value                = dados['resultado'][1]['cep'];
    document.getElementById("rua2").value                = dados['resultado'][1]['rua'];
    document.getElementById("numero2").value             = dados['resultado'][1]['numero_complemento'];
    document.getElementById("bairro2").value             = dados['resultado'][1]['bairro'];
    document.getElementById("cidade2").value             = dados['resultado'][1]['cidade'];
    document.getElementById("uf2").value                 = dados['resultado'][1]['estado'];
    document.getElementById("referencia2").value         = dados['resultado'][1]['referencia'];
    document.getElementById("txt_obs_endereco_2").value  = dados['resultado'][1]['obs'];
}





// Listener botao select Endereco
document.getElementById("btn_choose_end_1").addEventListener("mousedown", function(event) {
    document.getElementById('alert_end_1').className = "alert alert-success";
    document.getElementById('alert_end_2').className = "alert alert-secondary";
    document.getElementById('endereco_entrega').value = document.getElementById('txt_id_end_1').value;
});


// Listener botao select Endereco
document.getElementById("btn_choose_end_2").addEventListener("mousedown", function(event) {
    document.getElementById('alert_end_1').className = "alert alert-secondary";
    document.getElementById('alert_end_2').className = "alert alert-success";
    document.getElementById('endereco_entrega').value = document.getElementById('txt_id_end_2').value;
});



// Listener botao select Endereco
document.getElementById("btn_edit_end_1").addEventListener("mousedown", function(event) {
    $('#add_address').modal('show')
});

document.getElementById("btn_edit_end_2").addEventListener("mousedown", function(event) {
    $('#add_address2').modal('show')
});

document.getElementById("btn_cancelar_end_1").addEventListener("mousedown", function(event) {
    $('#add_address').modal('hide');
});
document.getElementById("btn_cancelar_end_2").addEventListener("mousedown", function(event) {
    $('#add_address2').modal('hide');
});


document.getElementById("btn_salvar_end_1").addEventListener("mousedown", function(event) {
    alert("Endereço alterado com sucesso!");
    $('#add_address').modal('hide');
    BuscaEndereco(document.getElementById("id_customer").value);
});


/**
 * Comment
 */
function validaTelefone() {
    let phone = document.getElementById("txt_telefone").value;
    if(phone.length > 13){
        return true;
    }else{
        return false;
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



















