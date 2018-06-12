<?php
    /** 
 	* Model destinada para a conexão ao banco de dados
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model 
	*/ 
    $servidor = "mysql02-farm67.uni5.net:3306"; 
    $usuario = "radiske"; 
    $senha = "radiske2018"; 
    $banco = "radiske"; 

    $conexao = new mysqli($servidor, $usuario, $senha, $banco); 
    
    if ($conexao->connect_error) {
        die("Falha na conexão do banco: $conexao->connect_error");
    }

?>