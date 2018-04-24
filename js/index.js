/**
 * Classe principal do sistema "main"
 * @author Guilherme Müller
 */
$(function() {
	//if (possuiSessao()) {
	//} else {
		carregarHTML('login.html');
	//}
	//carregarHTML('cadUsuario.html');
	//carregarHTML('paginaInicial.html');
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