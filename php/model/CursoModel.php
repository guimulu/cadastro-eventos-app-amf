<?php
	/** 
 	* Model destinada as tarefas de curso do sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class CursoModel {

		/** 
    	* Função para cadastrar o curso
    	* @access public 
    	* @param $nome, $logo, $sessao 
		* @return int
		* @return null
    	*/ 
		public function cadastrarCurso() {
			
			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$sessao = $_REQUEST['sessao'];

			define('tamanhoMaximo', (2 * 1024 * 1024));

			if(!isset($_FILES['logo'])){
				return "Nenhuma imagem selecionada!";
			}
			
			$foto = $_FILES['logo'];
			$nome = $foto['name'];
			$tipo = $foto['type'];
			$tamanho = $foto['size'];

			if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
				return "Imagem inválida!";
			}

			if($tamanho > tamanhoMaximo){
				return "A imagem deve possuir no máximo 2 MB!";
			}

			$conteudo = file_get_contents($foto['tmp_name']);
			
			$sql = "INSERT INTO CURSO(NOME, LOGO, ID_SESSAO) VALUES('$nome', $conteudo, $sessao)";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		
	}
?>


