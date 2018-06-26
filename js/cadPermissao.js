$(document).ready(function(e) { 
    $('#modal-permissao').modal();
    table = $('#dt-permissoes').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
    buscarUsuarios();
    $('#dt-permissoes tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        resetRadioButtons();
        $('#titulo-modal').text("Usuário " + data[1]);
        $('#usuario').val(data[0]);
        carregarPermissoesUsuario(data[0]);
        $('#modal-permissao').modal('open');
    } );

    $("input[name='usuario'], " +
        "input[name='curso'], " +
        "input[name='evento'], " + 
        "input[name='tipoEvento'], " + 
        "input[name='permissao']"
    ).change(function() {
        usuario = $('#usuario').val();
        permissao = $(this).val();
        if ($(this).prop("class") == "nao") {
            excluirPermissao(usuario, permissao);
        } else {
            adicionarPermissao(usuario, permissao);
        }

    });

});

function buscarUsuarios(){
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarUsuariosAtivos';  
    $.ajax({
        url: 'php/controller/UsuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if(!resultado.erro){
            var data = resultado.dados;    
            table.clear().draw();
            $.each(data, function(index, data) {     
            //!!!--Here is the main catch------>fnAddData
                $('#dt-permissoes').dataTable().fnAddData( [
                    data.ID_USUARIO,
                    data.NOME,
                    data.EMAIL,
                    data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>'
                ] );      
            });
        } else {
            mensagemErro(resultado.erro);
        }
        
    });    
}

function carregarPermissoesUsuario(usuario) {
    var dados = new Object();
    dados.usuario = usuario;
    dados.operacao = 'buscarPermissoesDoUsuario'; 
    $.ajax({
        url: 'php/controller/PermissaoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            var myArray = [];
            var data = resultado.dados;
            $.each(data, function(index, data) {
                myArray.push(data.ID_PERMISSAO)
            });
            if ($.inArray("1", myArray) !== -1) {
                $("#usuarioSim").prop("checked", true);
            } else {
                $("#usuarioNao").prop("checked", true);
            }            
            if ($.inArray("2", myArray) !== -1) {
                $("#cursoSim").prop("checked", true);  
            } else {
                $("#cursoNao").prop("checked", true);
            } 
            if ($.inArray("3", myArray) !== -1) {
                $("#eventoSim").prop("checked", true);
            } else {
                $("#eventoNao").prop("checked", true);
            }
            if ($.inArray("4", myArray) !== -1) {
                $("#tipoEventoSim").prop("checked", true);
            } else {
                $("#tipoEventoNao").prop("checked", true);
            }
            if ($.inArray("5", myArray) !== -1) {
                $("#permissoesSim").prop("checked", true);
            } else {
                $("#permissoesNao").prop("checked", true);
            }
        } else {
            //mensagemErro("Falha ao buscar permissões do usuário!");
        }
    });
}

function resetRadioButtons() {
        $("#usuarioSim").prop("checked", false);
        $("#usuarioNao").prop("checked", false);            
        $("#cursoSim").prop("checked", false);  
        $("#cursoNao").prop("checked", false); 
        $("#eventoSim").prop("checked", false);
        $("#eventoNao").prop("checked", false);
        $("#tipoEventoSim").prop("checked", false);
        $("#tipoEventoNao").prop("checked", false);
        $("#permissoesSim").prop("checked", false);
        $("#permissoesNao").prop("checked", false);
}

function adicionarPermissao(usuario, permissao) {
    var dados = new Object();
    dados.usuario = usuario;
    dados.permissao = permissao;
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'adicionarPermissao'; 
    $.ajax({
        url: 'php/controller/PermissaoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
        } else {
            //mensagemErro("Falha ao buscar permissões do usuário!");
        }
    });
}

function excluirPermissao(usuario, permissao) {
    var dados = new Object();
    dados.usuario = usuario;
    dados.permissao = permissao;
    dados.operacao = 'removerPermissao';
    $.ajax({
        url: 'php/controller/PermissaoController.php',
        data: dados,
        //dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
        } else {
            //mensagemErro("Falha ao buscar permissões do usuário!");
        }
    });
}