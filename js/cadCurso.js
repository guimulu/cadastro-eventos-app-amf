$(document).ready(function(e) { 
    $('#modal-cursos').modal();
    $('#dt-cursos').DataTable();
});

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarCurso(){
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.senha = $('#senha').val();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'cadastrarCurso';  
    $.ajax({
        url: 'php/controller/cursoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log(resultado);
        if (resultado.status) {
            limparCamposCurso();
        } else {
            console.log('deu pau');
        } 
    });
}

function buscarCursos(){
    dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarCursos';
    $.ajax({
        url: 'php/controller/cursoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado){
        console.log(resultado);
        if (resultado.status) {
            limparCamposCurso();
        } else {
            console.log('deu ruim');
        }
    });
}

function limparCamposCurso(){
    $("#nome").val("");
    $("#logo").val("");
}