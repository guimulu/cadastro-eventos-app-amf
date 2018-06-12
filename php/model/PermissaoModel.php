<?php
	/** 
 	* Model destinada as tarefas de permissão no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class PermissaoModel {

		/** 
    	* Função para adicionar permissão ao usuário
    	* @access public 
    	* @param $usuario, $permissao
		* @return boolean
    	*/ 
		public function adicionarPermissao() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			$permissao = $_REQUEST['permissao'];

			$sql = "INSERT INTO USUARIO_PERMISSAO(ID_USUARIO, ID_PERMISSAO) VALUES($usuario, $permissao)";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para remover permissão do usuário
    	* @access public 
    	* @param $usuario, $permissao
		* @return boolean
    	*/ 
		public function removerPermissao() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			$permissao = $_REQUEST['permissao'];

			$sql = "DELETE FROM USUARIO_PERMISSAO WHERE ID_USUARIO = $usuario AND ID_PERMISSAO = $permissao";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para buscar todas permissões
    	* @access public 
    	* @return array
		* @return null
    	*/ 
		public function buscarPermissoes() {
			
			require 'DefaultModel.php';

			$sql = "SELECT * FROM PERMISSAO";
			 
			$query = mysqli_query($conexao, $sql);

 			if (mysqli_num_rows($query) > 0 ) {
				
				while($dados = mysqli_fetch_object($query)){
					$retorno[] = $dados; 
				}    
		
				return $retorno;

			} else {
				return null;
			}
			
		}

		/** 
    	* Função destinada para a busca das permissões do usuário
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarPermissoesDoUsuario() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			
			$sql = "SELECT P.ID_PERMISSAO, P.NOME FROM PERMISSAO P INNER JOIN USUARIO_PERMISSAO UP ON UP.ID_PERMISSAO = P.ID_PERMISSAO where UP.ID_USUARIO = $usuario";
			 
			$query = mysqli_query($conexao, $sql);

 			if (mysqli_num_rows($query) > 0 ) {
				
				while($dados = mysqli_fetch_object($query)){
					$retorno[] = $dados; 
				}    
		
				return $retorno;

			} else {
				return null;
			}

		}

	}
?>


