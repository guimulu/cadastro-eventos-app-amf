<?php
	/** 
 	* Classe destinada ao login no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package bd 
	*/ 
    $operacao = $_REQUEST['operacao'];  
    
	switch ($operacao){
		case 'logar':
   			logar();
			break;
		default:
			echo "Nenhuma operação encontrada!";
			break;
	}    

	 /** 
    * Função para verificar se o usuário informado existe
    * @access public 
    * @param $usuario, $senha 
    * @return boolean 
    */ 
	function logar(){

		require_once 'configdb.php';
 
		$email = $_REQUEST['email'];
		$senha = $_REQUEST['senha'];

 		$sql = "SELECT ID_USUARIO FROM USUARIO WHERE EMAIL = $email AND SENHA = $senha";
 
 		$resultado = mysqli_query($conexao, $sql);

		$retorno = mysqli_fetch_assoc($resultado);
		
		echo json_encode($retorno);
		 
	}

?>


