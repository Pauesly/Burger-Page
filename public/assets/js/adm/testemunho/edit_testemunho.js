
// Listener botao ENVIAR
document.getElementById("btn_validar").addEventListener("mousedown", function(event) {
    if(ValidaCamposObrigatorios()){
        SalvarCliente();
    }
});



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




/*
 * Funcao que esconde a tela e valida dados ADM
 */
function SalvarCliente(){
    
    LaunchLoading();
    
//  Coletando e preenchendo todos os dados
    document.getElementById("name").value =                   document.getElementById("txt_name").value;
    document.getElementById("testimony").value =              document.getElementById("txt_testemunho").value;
    document.getElementById("status").value =                 document.getElementById("txt_titulo").value;
    document.getElementById("thumb").value =                  busca_img();

    
    //Enviando
    document.getElementById('cadastrar_novo_item').submit();

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
    
    if(document.getElementById("txt_testemunho").value.length > 1){ 
        validacoes++; 
    }else{
        document.getElementById("txt_testemunho").className = "form-control is-invalid";
    }
    
    if(document.getElementById("txt_titulo").value.length > 2){ 
        validacoes++; 
    }else{
        document.getElementById("txt_titulo").className = "form-control is-invalid";
    }
    
    if(validacoes === 3){
        return true;
    }else{
        return false;
    }
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

//        document.getElementById("btn_insert_img").disabled = true;
        
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

                var MAX_WIDTH = 115;
                var MAX_HEIGHT = 115;
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













