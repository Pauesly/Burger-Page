$(document).ready(function(){
    $('#txt_preco_old').mask("#,##0.00", {reverse: true});
    $('#txt_preco_new').mask("#,##0.00", {reverse: true});
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
    
////  Coletando e preenchendo todos os dados
    document.getElementById("fk_id_category").value =           document.getElementById("select_categoria").value;
    document.getElementById("name").value =                     document.getElementById("txt_name").value;
    document.getElementById("description").value =              document.getElementById("txt_descricao").value;
    document.getElementById("star").value =                     getSelectedRadio();
    document.getElementById("price_new").value =                document.getElementById("txt_preco_new").value;
    document.getElementById("price_old").value =                document.getElementById("txt_preco_old").value;
    document.getElementById("picture_thumb").value =            busca_img();
    document.getElementById("picture_large").files =            document.getElementById("img_select2").files;
//
//    
//    //Enviando
    document.getElementById('cadastrar_novo_item').submit();

}



/**
 * Valida Campos preenchidos
 */
function ValidaCamposObrigatorios() {
    
    let validacoes = 0;
    
    //Select Categoria
    if ($('#select_categoria').val() === "0"){
        $('#select_categoria').selectpicker('setStyle', 'selectpicker form-control is-invalid');
        $('#select_categoria').selectpicker('refresh');
        $('#select_categoria').selectpicker('setStyle', 'is-valid', 'remove');
        $('#select_categoria').selectpicker('refresh');
    }else{
        $('#select_categoria').selectpicker('setStyle', 'selectpicker form-control is-valid');
        $('#select_categoria').selectpicker('refresh');
        $('#select_categoria').selectpicker('setStyle', 'is-invalid', 'remove');
        $('#select_categoria').selectpicker('refresh');
        validacoes++;
    }
    
    //Radio buttons
    if (check_radio()){
        validacoes++;
    }else{
        document.getElementById("radio_btn").className = "form-check form-check-inline is-invalid";
    }
    
    
    //Nome
    if(document.getElementById("txt_name").value.length > 1){ 
        validacoes++; 
    }else{
        document.getElementById("txt_name").className = "form-control is-invalid";
    }
    
    //Descricao
    if(document.getElementById("txt_descricao").value.length > 1){ 
        validacoes++; 
    }else{
        document.getElementById("txt_descricao").className = "form-control is-invalid";
    }
    
    //Preco normal
    if(document.getElementById("txt_preco_old").value.length > 2){ 
        validacoes++; 
    }else{
        document.getElementById("txt_preco_old").className = "form-control is-invalid";
    }
    
    //Preco promocional
    if(document.getElementById("txt_preco_new").value.length > 2){ 
        validacoes++; 
    }else{
        document.getElementById("txt_preco_new").className = "form-control is-invalid";
    }
    
    
    //Thumb
    if(busca_img() !== "0"){ 
        validacoes++; 
    }else{
        document.getElementById("card_img_1").className = "card card-body bg-warning";
    }

    //Image
    if(busca_img2() !== "0"){ 
        validacoes++; 
    }else{
        document.getElementById("card_img_2").className = "card card-body bg-warning";
    }
    
    
    if(validacoes === 8){
        return true;
    }else{
        return false;
    }
}





//Select Faculdade
$(function(){
    $('#select_categoria').change(function(){
        //Setting Screen
        if ($('#select_categoria').val() === "0"){
            $('#select_categoria').selectpicker('setStyle', 'selectpicker form-control is-invalid');
            $('#select_categoria').selectpicker('refresh');
            $('#select_categoria').selectpicker('setStyle', 'is-valid', 'remove');
            $('#select_categoria').selectpicker('refresh');
        }else{
            $('#select_categoria').selectpicker('setStyle', 'selectpicker form-control is-valid');
            $('#select_categoria').selectpicker('refresh');
            $('#select_categoria').selectpicker('setStyle', 'is-invalid', 'remove');
            $('#select_categoria').selectpicker('refresh');
        }
    });
});    


function check_radio() {
    
    let check = 0;
    if(document.getElementById("inlineRadio1").checked)
        check++;
    if(document.getElementById("inlineRadio2").checked)
        check++;
    if(document.getElementById("inlineRadio3").checked)
        check++;
    if(document.getElementById("inlineRadio4").checked)
        check++;
    if(document.getElementById("inlineRadio5").checked)
        check++;
    
    if(check !== 0){
        return true;
    }else{
        return false;
    }
}


// Listener botao ENVIAR
document.getElementById("radio_grupin").addEventListener("mousedown", function(event) {
    document.getElementById("radio_btn").className = "form-check form-check-inline";
});

//LISTENERS DE DIGITACAO
document.getElementById("txt_name").addEventListener("keyup", function(event) {
    if(document.getElementById("txt_name").value.length < 1){
        document.getElementById("txt_name").className = "form-control is-invalid";
    }else{
        document.getElementById("txt_name").className = "form-control";
    }
});
document.getElementById("txt_descricao").addEventListener("keyup", function(event) {
    if(document.getElementById("txt_descricao").value.length < 1){
        document.getElementById("txt_descricao").className = "form-control is-invalid";
    }else{
        document.getElementById("txt_descricao").className = "form-control";
    }
});
document.getElementById("txt_preco_old").addEventListener("keyup", function(event) {
    if(document.getElementById("txt_preco_old").value.length < 1){
        document.getElementById("txt_preco_old").className = "form-control is-invalid";
    }else{
        document.getElementById("txt_preco_old").className = "form-control";
    }
});
document.getElementById("txt_preco_new").addEventListener("keyup", function(event) {
    if(document.getElementById("txt_preco_new").value.length < 1){
        document.getElementById("txt_preco_new").className = "form-control is-invalid";
    }else{
        document.getElementById("txt_preco_new").className = "form-control";
    }
});








function getSelectedRadio() {
    if(document.getElementById("inlineRadio1").checked)
        return 1;
    if(document.getElementById("inlineRadio2").checked)
        return 2;
    if(document.getElementById("inlineRadio3").checked)
        return 3;
    if(document.getElementById("inlineRadio4").checked)
        return 4;
    if(document.getElementById("inlineRadio5").checked)
        return 5;
    
}


















/*
 * Comando para limpar imagem e nao carregar nada
 */
document.getElementById("btn_limpa_imagem").addEventListener("mousedown", function(event) {
    document.getElementById("img_select").value = null;
    document.getElementById("img_nome").value = null;
//    document.getElementById("btn_insert_img").disabled = false;

    var preview = document.querySelector('img[name=img-upload]');
    preview.src = "";
    
});



/*
 * Funcao para preview imagem
 */
$(document).ready( function() {
    
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
                ResizeImage();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_select").change(function(){
        readURL(this);
    }); 	
});



function busca_img(){
    if ( document.querySelector('input[name=img_select]').files[0] != null ){
        var image = new Image();
        image.src = document.getElementById("img-upload").src;
        return  getBase64Image(image);

    }else if(document.getElementById("img-upload").height != 0){
        var image = new Image();
        image.src = document.getElementById("img-upload").src;
        return  getBase64Image(image);
    }else{
        return "0";
    }
}


/*
* CONVERTE IMAGEM PARA BASE64 String
 */
function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL("image/png");
    return dataURL.replace(/^data:image\/(png|jpg);base64,/, ""); // Limpa a String FIcando Sรณ o codigo base64
}



function ResizeImage() {
    document.getElementById("card_img_1").className = "card card-body bg-light";
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var filesToUploads = document.getElementById('img_select').files;
        var file = filesToUploads[0];
        if (file) {

            var reader = new FileReader();
            // Set the image once loaded into file reader
            reader.onload = function(e) {

                var img = document.createElement("img");
                img.src = e.target.result;

                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);

                var MAX_WIDTH = 162;
                var MAX_HEIGHT = 162;
                var width = img.width;
                var height = img.height;

                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width;
                        width = MAX_WIDTH;
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height;
                        height = MAX_HEIGHT;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, width, height);

                dataurl = canvas.toDataURL(file.type);
                document.getElementById('img-upload').src = dataurl;
            }
            reader.readAsDataURL(file);

        }

    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
}


















//IMAGEM 2



/*
 * Comando para limpar imagem e nao carregar nada
 */
document.getElementById("btn_limpa_imagem2").addEventListener("mousedown", function(event) {
    document.getElementById("img_select2").value = null;
    document.getElementById("img_nome2").value = null;
//    document.getElementById("btn_insert_img2").disabled = false;

    var preview = document.querySelector('img[name=img-upload2]');
    preview.src = "";
    
});



/*
 * Funcao para preview imagem
 */
$(document).ready( function() {
    
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload2').attr('src', e.target.result);
                ResizeImage2();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_select2").change(function(){
        readURL(this);
    }); 	
});



function busca_img2(){
    if ( document.querySelector('input[name=img_select2]').files[0] != null ){
        var image = new Image();
        image.src = document.getElementById("img-upload2").src;
        return  getBase64Image2(image);

    }else if(document.getElementById("img-upload2").height != 0){
        var image = new Image();
        image.src = document.getElementById("img-upload2").src;
        return  getBase64Image2(image);
    }else{
        return "0";
    }
}


/*
* CONVERTE IMAGEM PARA BASE64 String
 */
function getBase64Image2(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL("image/png");
    return dataURL.replace(/^data:image\/(png|jpg);base64,/, ""); // Limpa a String FIcando Sรณ o codigo base64
}



function ResizeImage2() {
    
        document.getElementById("card_img_2").className = "card card-body bg-light";
        
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var filesToUploads = document.getElementById('img_select2').files;
        var file = filesToUploads[0];
        if (file) {

            var reader = new FileReader();
            // Set the image once loaded into file reader
            reader.onload = function(e) {

                var img = document.createElement("img");
                img.src = e.target.result;

                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);

                var MAX_WIDTH = 800;
                var MAX_HEIGHT = 800;
                var width = img.width;
                var height = img.height;

                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width;
                        width = MAX_WIDTH;
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height;
                        height = MAX_HEIGHT;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, width, height);

                dataurl = canvas.toDataURL(file.type);
                document.getElementById('img-upload2').src = dataurl;
            }
            reader.readAsDataURL(file);

        }

    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
}







