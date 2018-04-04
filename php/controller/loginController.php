<?php
	/** 
 	* Controller destinada ao login no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/loginModel.php");

    $operacao = $_REQUEST['operacao'];

    $loginModel = new loginModel();

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
                //... fazer o update do usuário passando a sessão.
            } else {
                $retorno['erro'] = 'Erro ao criar sessao';
                echo json_encode($retorno);    
            }
        }

        
    }
?>


