$(document).ready(function() {
    
    //Date Picker
    var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		});
    
    //Mascara Telefone
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('#txt_busca_telefone').mask(SPMaskBehavior, spOptions);
    
    $('#tabela_principal').DataTable();
} );

// Switch Nome
$('#switch_nome').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_nome").className = "container";
    }else{
        document.getElementById("filter_nome").className = "esconder";
    }
});

//Switch Telefone
$('#switch_telefone').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_telefone").className = "container";
    }else{
        document.getElementById("filter_telefone").className = "esconder";
    }
});

//Switch data
$('#switch_data').on('change.bootstrapSwitch', function(e) {
    document.getElementById("erro_no_filter").className = "esconder";
    if(e.target.checked){
        document.getElementById("filter_data").className = "container";
    }else{
        document.getElementById("filter_data").className = "esconder";
    }
});



// Listener Botao Confirma filtro
document.getElementById("btn_realiza_filtro").addEventListener("mousedown", function(event) {
    if ($('#switch_nome').is(':checked') ||
            $('#switch_telefone').is(':checked') ||
            $('#switch_data').is(':checked')){
        
        RealizaBusca();
    }else{
        document.getElementById("erro_no_filter").className = "alert alert-danger";
    }
});



/**
 * Realiza Busca deacordo com filtros selecionados
 */
function RealizaBusca() {
    document.getElementById("btn_realiza_filtro").className = "btn btn-secondary btn-block text-white disabled";
    document.getElementById("spinner_realizando_busca").className = "spinner-border spinner-border-sm";
    $$$$$$$$$$$$$$$$$$$$$ CHECAR FILTROS ATIVOS E BUSCAR
}


/**
 * Verifica filtro ativo
 */
function CheckFiltrosAtivos() {
    
}



























