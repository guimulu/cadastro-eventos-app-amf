<?php
	/** 
 	* Controller destinada as tarefas relacionadas aos tipos eventos
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/TipoEventoModel.php");

    $operacao = $_REQUEST['operacao'];

    $tipoEventoModel = new TipoEventoModel();

    switch ($operacao) {
        case 'cadastrarTipoEvento':
            cadastrarTipoEvento($tipoEventoModel);
            break;
        case 'apagarTipoEvento':
            apagarTipoEvento($tipoEventoModel);
            break;
        case 'alterarTipoEvento':
            alterarTipoEvento($tipoEventoModel);
            break;
        case 'buscarTiposEventos':
            buscarTiposEventos($tipoEventoModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }
    
    /** 
    * Função destinada para a busca dos tipos de eventos
    * @access public 
    * @param $tipoEventoModel 
    * @return json 
    */ 
    function buscarTiposEventos($tipoEventoModel) {
        $retorno['status'] = false;
        
        $resultado = $tipoEventoModel->buscarTiposEventos();
        
        if(!empty($resultado)){
           $retorno['status'] = true;
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

    /** 
    * Função destinada ao cadastro do tipo de evento
    * @access public 
    * @param $tipoEventoModel 
    * @return json 
    */ 
    function cadastrarTipoEvento($tipoEventoModel) {
        $retorno['status'] = false;
        
        $resultado = $tipoEventoModel->cadastrarTipoEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao cadastrar o tipo de evento';
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada para exclusão lógica do tipo de evento
    * @access public 
    * @param $tipoEventoModel 
    * @return json 
    */ 
    function apagarTipoEvento($tipoEventoModel) {
        $retorno['status'] = false;
        
        $resultado = $tipoEventoModel->apagarTipoEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao deletar o tipo de evento';
            echo json_encode($retorno);    
        }

    }

    /** 
    * Função destinada para alteração do tipo de evento
    * @access public 
    * @param $tipoEventoModel 
    * @return json 
    */ 
    function alterarTipoEvento($tipoEventoModel) {
        $retorno['status'] = false;
        
        $resultado = $tipoEventoModel->alterarTipoEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao alterar o tipo de evento';
            echo json_encode($retorno);    
        }

    }
?>


