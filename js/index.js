function mensagemSucesso(msg){
	var titulo = 'Operação realizada com sucesso!';
	if (msg){
		titulo = msg;
	}
    swal({
        position: 'top-center',
        type: 'success',
        title: titulo,
        showConfirmButton: true,
        timer: 1500
      })
}

function mensagemErro(msg){
	var titulo = 'Erro ao realizar operação!';
	if (msg) {
		titulo = msg;
	}
    swal({
        position: 'top-center',
        type: 'error',
        title: titulo,
        showConfirmButton: true,
        timer: 1500
    })
}

function mensagemInfo(msg) {
	swal({
        position: 'bottom-right',
        type: 'info',
        title: msg,
        showConfirmButton: true,
        timer: 1500
    })
}


/**
 * Classe principal do sistema "main"
 * @author Guilherme Müller
 */
$(function() {
	if (possuiSessao()) {
		carregarHTML('paginaInicial.html')
		//carregarHTML('cadUsuario.html');
	} else {
		carregarHTML('login.html');
	}

});

/**
 * Método de inserção de html no conteudo.
 * @param {endereço da página html} url 
 */
var carregarHTML = function(url){
	return $.get(url, function(data){
		$('#conteudo').html(data);
	})
};

/**
 * Método de inserção de html no conteudo.
 * @param {endereço da página html} url 
 */
var carregarHTMLPaginaInicial = function(url){
	return $.get(url, function(data){
		$('#content').html(data);
	})
};

function encerrarSessao(){
	$.session.remove('session_login');
}

function possuiSessao() {
	if ($.session.get('session_login')) {
		return true;
	} else {
		return false;
	}
}

function isChecked(obj) {
	return obj.is(":checked") ? 1 : 0;
}

$(document)
.ajaxStart(function(){
    $('#spinner').show();
})
.ajaxStop(function(){
    $('#spinner').hide();
});