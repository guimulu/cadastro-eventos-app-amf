/**
 * Classe onde será feita as validações de login do usuário.
 * @author Guilherme Müller
 */
window.document.onload = function(e) {
    console.log('e', e);  
}


// $(function() {
// 	if (possuiSessao()) {
// 		carregarHTML('index.html')
// 		//carregarHTML('cadUsuario.html');
// 	} else {
// 		carregarHTML('login.html');
// 	}

// });

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
        url: 'php/controller/LoginController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado.status == true) {
            $.session.set('session_login', resultado.dados.sessao);
            carregarHTML('paginaInicial.html');
        } else {
            mensagemErro('Informações incorretas!');
        }
        
    });
}