$(document).ready(function() {
    CarregarCardapio();
} );




/**
 * Realiza Busca Cardapio
 */
function CarregarCardapio() {
    
    let categorias = "";
    let produtos = "";
    
    $.getJSON('/carregar_categorias?search=',{ajax: 'true'}, function(retorno){
        categorias = retorno;

        $.getJSON('/carregar_cardapio?search=',{ajax: 'true'}, function(retorno){
            produtos = retorno;

            for(let i = 0; i < categorias["resultado"].length; i++){
                
                ### FAZER O PREENCIMENTO DO MENU. IF CATEGORIA IGUAL PRODUTO.
                
                
                
                console.log(categorias["resultado"][i]['description']);
            }
            
            console.log(categorias);
            console.log(produtos);

         });
    });
    
    
    
    
    
    
    
    
}










