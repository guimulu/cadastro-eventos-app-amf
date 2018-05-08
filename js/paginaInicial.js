$(document).ready(function(e) {
    $('#menu-topo').hide();
    var menuaberto = false;
    $('.btn-collapse').click(function(event) {
        event.preventDefault();
        $('#menu-topo').toggle('');
        if(menuaberto == true){
            menuaberto = false;
            $(".lista-collapse:nth-child(1)").removeClass('botao-lista-cima');
            $(".lista-collapse:nth-child(2)").removeClass('hidden');
            $(".lista-collapse:nth-child(3)").removeClass('botao-lista-baixo');
        }else {
            menuaberto = true;
            $(".lista-collapse:nth-child(1)").addClass('botao-lista-cima');
            $(".lista-collapse:nth-child(2)").addClass('hidden');
            $(".lista-collapse:nth-child(3)").addClass('botao-lista-baixo');
        }
    });
});

var fecharMenu = function() {
        $('#menu-topo').toggle('');
        menuaberto = false;
        $(".lista-collapse:nth-child(1)").removeClass('botao-lista-cima');
        $(".lista-collapse:nth-child(2)").removeClass('hidden');
        $(".lista-collapse:nth-child(3)").removeClass('botao-lista-baixo');
};