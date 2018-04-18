<?php
	/** 
 	* Model destinada as tarefas de usuário no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class UsuarioModel {

		/** 
    	* Função para cadastrar o usuário
    	* @access public 
    	* @param $nome, $email, $senha, $sessao
		* @return boolean
    	*/ 
		public function cadastrarUsuario() {
			
			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$email = $_REQUEST['email'];
			$senha = $_REQUEST['senha'];
			$sessao = $_REQUEST['sessao'];

			$sql = "INSERT INTO USUARIO(NOME, SENHA, EMAIL, ID_SESSAO) VALUES('$nome', '$senha', '$email', $sessao)";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para buscar os usuarios
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarUsuarios() {
			
			require 'DefaultModel.php';
			
			$sql = "SELECT * FROM USUARIO";
			 
			$query = mysqli_query($conexao, $sql);

 			if (mysqli_num_rows($query) > 0 ) {
				
				while($dados = mysqli_fetch_assoc($query)){
					$retorno[] = $dados; 
				}    
		
				return $retorno;

			} else {
				return null;
			}

		}

		/** 
    	* Função para alterar o usuário
    	* @access public 
    	* @param $usuario, $nome, $email, $senha, $sessao
		* @return boolean
    	*/ 
		public function alterarUsuario() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			$nome = $_REQUEST['nome'];
			$email = $_REQUEST['email'];
			$senha = $_REQUEST['senha'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE USUARIO SET NOME = '$nome', SENHA = '$senha', EMAIL = '$email', ID_SESSAO = $sessao WHERE ID_USUARIO = $usuario";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para exclusão lógica do usuário
    	* @access public 
    	* @param $usuario, $sessao
		* @return boolean
    	*/ 
		public function apagarUsuario() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE USUARIO SET ID_SESSAO = $sessao, EXCLUIDO = 1 WHERE ID_USUARIO = $usuario";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}
		
	}
?>


