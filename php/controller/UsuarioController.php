<?php
	/** 
 	* Controller destinada as tarefas relacionadas ao usuário
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/UsuarioModel.php");

    $operacao = $_REQUEST['operacao'];

    $usuarioModel = new UsuarioModel();

    switch ($operacao) {
        case 'cadastrarUsuario':
            cadastrarUsuario($usuarioModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }    

    /** 
    * Função destinada ao cadastro do usuário
    * @access public 
    * @param $usuarioModel 
    * @return json 
    */ 
    function cadastrarUsuario($usuarioModel) {
        $retorno['status'] = false;
        
        $resultado = $usuarioModel->cadastrarUsuario();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao cadastrar usuário';
            echo json_encode($retorno);    
        }

    }
?>


