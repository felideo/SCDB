$(document).ready(function() {
	$('.botao_voltar').on('click', function(){
        history.back();
    });

    // $("#main-nav-mouseover, .main-nav-wrapper").mouseover(function(){
    //     $('body').addClass("nav-toggled");
    // }).mouseout(function() {
    //     // $('body').removeClass("nav-toggled");
    // });

    autosize($('textarea'));
});

// $(window).load(function(){
//     $('body').addClass("nav-toggled");
// });


String.prototype.replace_all = function(search, replacement){
    var target = this;
    return target.split(search).join(replacement);
}

function carregar_loader(tipo) {
    if (tipo == 'show') {
        swal({
            title: "Aguarde",
            allowEscapeKey: false,
            showConfirmButton: false,
            showCancelButton: false,
            imageUrl: '/public/images/ajax-loader-2.gif',
            animation: false
        });
    }

    if (tipo == 'hide') {
        swal.close();
    }
}

function limpar_alertas_ajax(){
    $.ajax({
        url: '/master/limpar_alertas_ajax',
        success: function(retorno){
            console.log(retorno);
        }
    })
}




