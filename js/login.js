/**
 * Classe onde será feita as validações de login do usuário.
 * @author Guilherme Müller
 */

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
*/
function logar(){
	var dados = new Object();
    dados.senha = $('#senha').val();
    dados.email = $('#email').val();
    dados.operacao = 'logar';  
    $.ajax({
        url: '../bd/login.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
    	if (resultado){
           // TODO: Insert na Sessão e buscar o id que retornar.
           // ID_SESSAO vai validar todas as operações realizadas no sistema.
 		}
    });

}