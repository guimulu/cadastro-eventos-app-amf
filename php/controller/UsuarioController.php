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
        case 'apagarUsuario':
            apagarUsuario($usuarioModel);
            break;
        case 'alterarUsuario':
            alterarUsuario($usuarioModel);
            break;
        case 'buscarUsuarios':
            buscarUsuarios($usuarioModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }
    
    /** 
    * Função destinada para a busca dos cursos
    * @access public 
    * @param $usuarioModel 
    * @return json 
    */ 
    function buscarUsuarios($cursoModel) {
        $retorno['status'] = false;
        
        $resultado = $usuarioModel->buscarUsuarios();
        
        if(!empty($resultado)){
           $retorno['status'] = true;
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
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

    /** 
    * Função destinada para exclusão lógica do usuário
    * @access public 
    * @param $usuarioModel 
    * @return json 
    */ 
    function apagarUsuario($usuarioModel) {
        $retorno['status'] = false;
        
        $resultado = $usuarioModel->apagarUsuario();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao deletar usuário';
            echo json_encode($retorno);    
        }

    }

    /** 
    * Função destinada para alteração do usuário
    * @access public 
    * @param $usuarioModel 
    * @return json 
    */ 
    function alterarUsuario($usuarioModel) {
        $retorno['status'] = false;
        
        $resultado = $usuarioModel->alterarUsuario();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao alterar usuário';
            echo json_encode($retorno);    
        }

    }
?>


