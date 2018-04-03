/**
 * Classe principal do sistema "main"
 * @author Guilherme Müller
 */
$(function() {
    carregarHTML('login.html');
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