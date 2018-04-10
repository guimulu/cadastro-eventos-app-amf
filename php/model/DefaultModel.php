<?php
    /** 
 	* Model destinada para a conexão ao banco de dados
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model 
	*/ 
    $servidor = "mysql.dickow.me"; 
    $usuario = "dickow01"; 
    $senha = "5o0Aitkw3Hkz"; 
    $banco = "dickow01"; 

    $conexao = new mysqli($servidor, $usuario, $senha, $banco); 
    
    if ($conexao->connect_error) {
        die("Falha na conexão do banco: $conexao->connect_error");
    }

?>