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
?>


