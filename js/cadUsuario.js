$(document).ready(function(e) { 
    $('#modal-usuario').modal();
    $('#dt-usuarios').DataTable( {
        "ajax": buscarUsuarios(),
        "columns": [
            { dados: "ID_USUARIO" },
            { dados: "NOME" },
            { dados: "EMAIL" },
            { dados: "EXCLUIDO" }
        ]
    });
});

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarUsuario(){
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.senha = $('#senha').val();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'cadastrarUsuario';  
    $.ajax({
        url: 'php/controller/usuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log(resultado);
        if (resultado.status) {
            limparCamposUsuario();
        } else {
            console.log('deu pau');
        } 
    });
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function buscarUsuarios(){
    var data;
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarUsuarios';  
    $.ajax({
        url: 'php/controller/usuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        //console.log(resultado)
        data = resultado.dados;
    });
    console.log(data);
    return data;
}

function limparCamposUsuario(){
    $('#nome').val('');
    $('#email').val('');
    $('#senha').val('');
}
