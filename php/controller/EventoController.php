<?php
	/** 
 	* Controller destinada as tarefas relacionadas aos eventos
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/EventoModel.php");

    $operacao = $_REQUEST['operacao'];

    $eventoModel = new EventoModel();

    switch ($operacao) {
        case 'cadastrarEvento':
            cadastrarEvento($eventoModel);
            break;
        case 'apagarEvento':
            apagarEvento($eventoModel);
            break;
        case 'alterarEvento':
            alterarEvento($eventoModel);
            break;
        case 'buscarEventos':
            buscarEventos($eventoModel);
            break;
        case 'buscarRecorrencias':
            buscarRecorrencias($eventoModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }
     /** 
    * Função destinada para buscar as recorrências 
    * @access public 
    * @param $eventoModel 
    * @return json 
    */ 
    function buscarRecorrencias($eventoModel) {
        $resultado = $eventoModel->buscarRecorrencias();
        
        if(!empty($resultado)){
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

    /** 
    * Função destinada para a busca dos eventos
    * @access public 
    * @param $eventoModel 
    * @return json 
    */ 
    function buscarEventos($eventoModel) {
        $resultado = $eventoModel->buscarEventos();
        
        if(!empty($resultado)){
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

    /** 
    * Função destinada ao cadastro do evento
    * @access public 
    * @param $eventoModel 
    * @return json 
    */ 
    function cadastrarEvento($eventoModel) {
        $retorno['status'] = false;
        
        $resultado = $eventoModel->cadastrarEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao cadastrar evento';
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada para exclusão lógica do evento
    * @access public 
    * @param $eventoModel 
    * @return json 
    */ 
    function apagarEvento($eventoModel) {
        $retorno['status'] = false;
        
        $resultado = $eventoModel->apagarEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao deletar evento';
            echo json_encode($retorno);    
        }

    }

    /** 
    * Função destinada para alteração do evento
    * @access public 
    * @param $eventoModel 
    * @return json 
    */ 
    function alterarEvento($eventoModel) {
        $retorno['status'] = false;
        
        $resultado = $eventoModel->alterarEvento();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = 'Erro ao alterar evento';
            echo json_encode($retorno);    
        }

    }
?>


