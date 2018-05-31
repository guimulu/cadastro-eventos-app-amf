<?php
	/** 
 	* Controller destinada ao login no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/LoginModel.php");

    $operacao = $_REQUEST['operacao'];

    $loginModel = new LoginModel();

    switch ($operacao) {
        case 'logar':
            logar($loginModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }    

    /** 
    * Função destina ao fluxo de login do sistema
    * @access public 
    * @param $loginModel 
    * @return json 
    */ 
    function logar($loginModel) {
        $retorno['status'] = false;

        $resultado = $loginModel->verificarUsuario();

        if (empty($resultado)) {
            $retorno['erro'] = 'Usuario nao encontrado';
            echo json_encode($retorno);    
        } else {
            $sessao = $loginModel->criarSessao($resultado);
            if ($sessao != false) {
                $retorno['status'] = true;
                $resultado['sessao'] = $sessao;
                $retorno['dados'] = $resultado;
                echo json_encode($retorno);    
            } else {
                $retorno['erro'] = 'Erro ao criar sessao';
                echo json_encode($retorno);    
            }
        }

        
    }
?>


