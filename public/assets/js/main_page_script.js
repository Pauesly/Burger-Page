$(document).ready(function() {
//    CarregarCardapio();
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
            
//            document.getElementById("loading_abrir_pedido").className = "esconder";
            produtos = retorno;

            for(let i = 0; i < categorias["resultado"].length; i++){
                
                    var divPai = $('#div_pai');
                    divPai.append('<div class="col-sm-6 col-lg-4 col-xl-3">' + 
                                    '<article class="product wow fadeInLeft" data-wow-delay=".1s">' +
                                        '<div class="product-figure"><img src="images/product-2-161x162.png" alt="" width="161" height="162"/>'+
                                        '</div>'+
                                        '<div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span>'+
                                        '</div>'+
                                        '<h6 class="product-title">Original EGG</h6>'+
                                        '<div class="product-price-wrap">'+
                                            '<div class="product-price">$17.00</div>'+
                                        '</div>'+
                                        '<div class="product-button">'+
                                            '<div class="button-wrap">'+
                                                '<a class="button button-xs button-primary button-winona" href="http://api.whatsapp.com/send?1=pt_br&phone=5527981641870&text=Eu%20quero%20este%20hamburger" target="_blank">'+
                                                    'Peça pelo Whatsapp'+
                                                '</a>'+
                                            '</div>'+
                                            '<div class="button-wrap">'+
                                                '<a class="button button-xs button-secondary button-winona" href="https://source.unsplash.com/0JYgd2QuMfw/1500x1000" data-fancybox data-caption="This image has a caption">'+
                                                        'Ver detalhes'+
                                                '</a>'+
                                            '</div>'+
                                        '</div>'+
                                        '<span class="product-badge product-badge-new">#2</span>'+
                                    '</article>'+
                                '</div>');
                    
                
//                // cria um novo elemento div 
//                // e dá à ele conteúdo
//                var divNova = document.createElement("div"); 
//                var conteudoNovo = document.createTextNode("Olá, cumprimentos!"); 
//                divNova.appendChild(conteudoNovo); //adiciona o nó de texto à nova div criada 
//
//                // adiciona o novo elemento criado e seu conteúdo ao DOM 
//                var divAtual = document.getElementById("div1"); 
//                document.body.insertBefore(divNova, referencia); 
                
                
                
//                console.log(categorias["resultado"][i]['description']);
            }
            
            console.log(categorias);
            console.log(produtos);

         });
    });
    
    
    
    
    
    
    
    
}










