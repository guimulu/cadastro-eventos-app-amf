<?php
	/** 
 	* Model destinada ao login no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class LoginModel {

		/** 
    	* Função para verificar se o usuário informado existe
    	* @access public 
    	* @param $email, $senha 
		* @return int
		* @return null
    	*/ 
		public function verificarUsuario() {
			
			require 'DefaultModel.php';

			$email = $_REQUEST['email'];
			$senha = md5($_REQUEST['senha']);

 			$sql = "SELECT * FROM USUARIO WHERE EMAIL = '$email' AND SENHA = '$senha' AND EXCLUIDO <> 1 ";

			$query = mysqli_query($conexao, $sql);

 			if (mysqli_num_rows($query) > 0 ) {
				return mysqli_fetch_assoc($query);
			} else {
				return null;
			}
		 
		}

		/** 
    	* Função para criar a sessão do usuário
    	* @access public 
    	* @param $dataAtual, $idUsuario 
		* @return int
		* @return null
    	*/ 
		public function criarSessao($resultado) {

			require 'DefaultModel.php';
			
			$dataAtual = date('Y-m-d H:i');
			$idUsuario = $resultado['ID_USUARIO'];

			$sql = "INSERT INTO SESSAO(MOMENTO, ID_USUARIO) VALUES('$dataAtual' , $idUsuario)";

    		if($conexao->query($sql) === FALSE) {
        		return false;
    		}else{
    			return $conexao->insert_id;
    		}
		}
	}
?>


