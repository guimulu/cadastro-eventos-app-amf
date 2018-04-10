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
        url: 'php/controller/loginController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log(resultado);
    });

}