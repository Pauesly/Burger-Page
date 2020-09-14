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















