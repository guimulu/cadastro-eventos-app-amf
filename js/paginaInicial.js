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
    buscarPermissoes();
});

var fecharMenu = function() {
        $('#menu-topo').toggle('');
        menuaberto = false;
        $(".lista-collapse:nth-child(1)").removeClass('botao-lista-cima');
        $(".lista-collapse:nth-child(2)").removeClass('hidden');
        $(".lista-collapse:nth-child(3)").removeClass('botao-lista-baixo');
};

function buscarPermissoes() {
    var dados = new Object();
    dados.usuario = $.session.get('usuario_logado');
    dados.operacao = 'buscarPermissoesDoUsuario'; 
    $.ajax({
        url: 'php/controller/PermissaoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            var data = resultado.dados;
            console.log(resultado.dados);
            $.each(data, function(index, data) {
                if (data.ID_PERMISSAO === "1") {
                    $("#menu-topo").append('<li><a onclick="carregarHTMLPaginaInicial(\'cadUsuario.html\'); fecharMenu();">USUÁRIOS</a></li>');
                } else if (data.ID_PERMISSAO === "2") {
                    $("#menu-topo").append('<li><a onclick="carregarHTMLPaginaInicial(\'cadCurso.html\'); fecharMenu();">CURSO</a></li>');
                } else if (data.ID_PERMISSAO === "3") {
                    $("#menu-topo").append('<li><a onclick="carregarHTMLPaginaInicial(\'cadEvento.html\'); fecharMenu();">EVENTOS</a></li>');
                } else if (data.ID_PERMISSAO === "4") {
                    $("#menu-topo").append('<li><a onclick="carregarHTMLPaginaInicial(\'cadTipoEvento.html\'); fecharMenu();">TIPO EVENTO</a></li>');
                } else if (data.ID_PERMISSAO === "5") {
                    $("#menu-topo").append('<li><a onclick="carregarHTMLPaginaInicial(\'cadPermissao.html\'); fecharMenu();">PERMISSÕES</a></li>');
                }
            });
            $("#menu-topo").append('<li><a href="./index.html" onclick="encerrarSessao();">SAIR</a></li>');
        } else {
            mensagemErro("Falha ao buscar permissões do usuário!");
            $("#menu-topo").append('<li><a href="./index.html" onclick="encerrarSessao();">SAIR</a></li>');
        }
    });
}