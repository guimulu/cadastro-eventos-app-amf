<?php
	/** 
 	* Model destinada as tarefas de usuário no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class LoginModel {

		/** 
    	* Função para cadastrar o usuário
    	* @access public 
    	* @param $email, $email, $senha, $sessao
		* @return boolean
    	*/ 
		public function cadastrarUsuario() {
			
			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$email = $_REQUEST['email'];
			$senha = $_REQUEST['senha'];
			$sessao = $_REQUEST['sessao'];

			$sql = "INSERT INTO USUARIO(NOME, SENHA, EMAIL, ID_SESSAO) VALUES('$nome', '$senha', '$email', '$sessao')";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}
		
	}
?>


