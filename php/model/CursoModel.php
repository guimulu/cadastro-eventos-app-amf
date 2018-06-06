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
    	* Função para buscar os cursos
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarCursos() {
			
			require 'DefaultModel.php';
			
			$sql = "SELECT ID_CURSO, NOME, ID_SESSAO FROM CURSO WHERE EXCLUIDO = 0";
			 
			$query = mysqli_query($conexao, $sql);

 			if (mysqli_num_rows($query) > 0 ) {
				
				while($dados = mysqli_fetch_assoc($query)){
					$retorno[] = $dados; 
				}    
		
				return $retorno;

			} else {
				return null;
			}

		}

		/** 
    	* Função para cadastrar o curso
    	* @access public 
    	* @param $nome, $logo, $sessao 
		* @return int
		* @return string
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
			$tipo = $foto['type'];
			$tamanho = $foto['size'];

			if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)){
				return "Imagem inválida!";
			}

			if($tamanho > tamanhoMaximo){
				return "A imagem deve possuir no máximo 2 MB!";
			}

			$conteudo = base64_encode($foto['tmp_name']);

			$sql = "INSERT INTO CURSO(NOME, LOGO, ID_SESSAO) VALUES('$nome', '$conteudo', $sessao)";

			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return "Erro na inserção no banco de dados!";
		  	}
			
		}

		/** 
    	* Função para excluir o curso
    	* @access public 
    	* @param $curso, $sessao 
		* @return int
		* @return null
    	*/ 
		public function apagarCurso() {
			
			require 'DefaultModel.php';

			$curso = $_REQUEST['curso'];
			$sessao = $_REQUEST['sessao'];
			
			$sql = "UPDATE CURSO SET EXCLUIDO = 1, ID_SESSAO = $sessao WHERE ID_CURSO = $curso";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return "Erro na exclusão do curso!";
		  	}
			
		}

		/** 
    	* Função para alteração do curso
    	* @access public 
    	* @param $nome, $logo, $sessao, $curso
		* @return int
		* @return null
    	*/ 
		public function alterarCurso() {
			
			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$sessao = $_REQUEST['sessao'];
			$curso = $_REQUEST['curso'];

			define('tamanhoMaximo', (2 * 1024 * 1024));

			if(isset($_FILES['logo'])){
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

				$sql = "UPDATE CURSO SET NOME = '$nome', LOGO = $conteudo, ID_SESSAO = $sessao WHERE ID_CURSO = $curso";
			}else{
				$sql = "UPDATE CURSO SET NOME = '$nome', ID_SESSAO = $sessao WHERE ID_CURSO = $curso";
			}
			
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return "Erro na inserção no banco de dados!";
		  	}
			
		}

		
	}
?>


