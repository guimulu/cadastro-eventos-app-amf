<?php
	/** 
 	* Controller destinada as tarefas de curso do sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/controller 
    */
    include_once("../model/CursoModel.php");

    $operacao = $_REQUEST['operacao'];

    $cursoModel = new CursoModel();

    switch ($operacao) {
        case 'cadastrarCurso':
            cadastrarCurso($cursoModel);
            break;
        case 'alterarCurso':
            alterarCurso($cursoModel);
            break;
        case 'apagarCurso':
            apagarCurso($cursoModel);
            break;
        case 'buscarCursos':
            buscarCursos($cursoModel);
            break;
        default:
            echo "Nenhuma operação encontrada!";
            break;
    }    

    /** 
    * Função destinada ao cadastro de curso
    * @access public 
    * @param $cursoModel 
    * @return json 
    */ 
    function cadastrarCurso($cursoModel) {
        $retorno['status'] = false;
        
        $resultado = $cursoModel->cadastrarCurso();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = $resultado;
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada para a busca dos cursos
    * @access public 
    * @param $cursoModel 
    * @return json 
    */ 
    function buscarCursos($cursoModel) {
        $retorno['status'] = false;
        
        $resultado = $cursoModel->buscarCursos();
        
        if(!empty($resultado)){
           $retorno['status'] = true;
           $retorno['dados'] = $resultado; 
        }else{
            $retorno['erro'] = 'Nenhum dado encontrado';
        }

        echo json_encode($retorno);
    }

    /** 
    * Função destinada a alteração de curso
    * @access public 
    * @param $cursoModel 
    * @return json 
    */ 
    function alterarCurso($cursoModel) {
        $retorno['status'] = false;
        
        $resultado = $cursoModel->alterarCurso();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = $resultado;
            echo json_encode($retorno);    
        }
    }

    /** 
    * Função destinada a exclusão lógica de curso
    * @access public 
    * @param $cursoModel 
    * @return json 
    */ 
    function apagarCurso($cursoModel) {
        $retorno['status'] = false;
        
        $resultado = $cursoModel->apagarCurso();

        if ($resultado) {
            $retorno['status'] = true;
            echo json_encode($retorno);
        } else {
            $retorno['erro'] = $resultado;
            echo json_encode($retorno);    
        }
    }
?>


