<?php
	/** 
 	* Controller destinada as tarefas relacionadas as permissões
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/PermissaoModel.php");
    
    $operacao = $_REQUEST['operacao'];

    $permissaoModel = new PermissaoModel();

    switch ($operacao) {
        case 'buscarPermissoes':
            buscarPermissoes($permissaoModel);
            break;
        case 'buscarPermissoesDoUsuario':
            buscarPermissoesDoUsuario($permissaoModel);
            break;
        case 'adicionarPermissao':
            adicionarPermissao($permissaoModel);
            break;
        case 'removerPermissao':
            removerPermissao($permissaoModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }

    /** 
    * Função destinada a adição de permissão para um usuário
    * @access public 
    * @param $permissaoModel 
    * @return json 
    */ 
    function adicionarPermissao($permissaoModel) {
        $retorno['status'] = false;
        $resultado = $permissaoModel->adicionarPermissao();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao adicionar permissão';
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada a remoção de permissão do usuário
    * @access public 
    * @param $permissaoModel 
    * @return json 
    */ 
    function removerPermissao($permissaoModel) {
        $retorno['status'] = false;
        
        $resultado = $permissaoModel->removerPermissao();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao remover permissão';
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada para a busca de todas permissões
    * @access public 
    * @param $permissaoModel 
    * @return json 
    */ 
    function buscarPermissoes($permissaoModel) {
        $resultado = $permissaoModel->buscarPermissoes();
        
        if(!empty($resultado)){
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

    /** 
    * Função destinada para a busca das permissões do usuário
    * @access public 
    * @param $permissaoModel 
    * @return json 
    */ 
    function buscarPermissoesDoUsuario($permissaoModel) {
        $resultado = $permissaoModel->buscarPermissoesDoUsuario();
        
        if(!empty($resultado)){
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

?>


