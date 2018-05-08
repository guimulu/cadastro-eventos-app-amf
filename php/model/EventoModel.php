<?php
	/** 
 	* Model destinada as tarefas de eventos no sistema
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class EventoModel {

		/** 
    	* Função para cadastrar o evento
    	* @access public 
    	* @param $nome, $descricao, $localização, $dataInicio, $dataFim, $lembrete, $ativo, $eventoTipo, $curso, $recorrencia, $eventoOrigem, $sessao
		* @return boolean
    	*/ 
		public function cadastrarEvento() {

			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$descricao = $_REQUEST['descricao'];
			$localização = $_REQUEST['localização'];
			$dataInicio = $_REQUEST['dataInicio'];
			$dataFim = $_REQUEST['dataFim'];
			$lembrete = $_REQUEST['lembrete'];
			$ativo = $_REQUEST['ativo'];
			$eventoTipo = $_REQUEST['eventoTipo'];
			$curso = $_REQUEST['curso'];
			$recorrencia = $_REQUEST['recorrencia'];
			$eventoOrigem = $_REQUEST['eventoOrigem'];
			$sessao = $_REQUEST['sessao'];
			
			$sql = "INSERT INTO EVENTO(NOME, DESCRICAO, LOCALIZACAO, DATA_HORA_INICIO, DATA_HORA_TERMINO, LEMBRETE, ATIVO, ID_EVENTO_TIPO, ID_CURSO, ID_EVENTO_ORIGEM, ID_RECORRENCIA, ID_SESSAO) VALUES('$nome', '$descricao', '$localizacao', '$dataInicio', '$dataFim', $lembrete, $eventoTipo, $curso, $recorrencia, $eventoOrigem, $sessao)";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para buscar os eventos
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarEventos() {
			
			require 'DefaultModel.php';
			
			$sql = "SELECT * FROM EVENTO";
			 
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
    	* Função para alterar o evento
    	* @access public 
    	* @param $evento, $nome, $descricao, $localização, $dataInicio, $dataFim, $lembrete, $ativo, $eventoTipo, $curso, $recorrencia, $eventoOrigem, $sessao
		* @return boolean
    	*/ 
		public function alterarEvento() {
			
			require 'DefaultModel.php';

			$evento = $_REQUEST['evento'];
			$nome = $_REQUEST['nome'];
			$descricao = $_REQUEST['descricao'];
			$localização = $_REQUEST['localização'];
			$dataInicio = $_REQUEST['dataInicio'];
			$dataFim = $_REQUEST['dataFim'];
			$lembrete = $_REQUEST['lembrete'];
			$ativo = $_REQUEST['ativo'];
			$eventoTipo = $_REQUEST['eventoTipo'];
			$curso = $_REQUEST['curso'];
			$recorrencia = $_REQUEST['recorrencia'];
			$eventoOrigem = $_REQUEST['eventoOrigem'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE USUARIO SET NOME = '$nome', SENHA = '$senha', EMAIL = '$email', ID_SESSAO = $sessao WHERE ID_EVENTO = $usuario";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para exclusão lógica do usuário
    	* @access public 
    	* @param $usuario, $sessao
		* @return boolean
    	*/ 
		public function apagarUsuario() {
			
			require 'DefaultModel.php';

			$usuario = $_REQUEST['usuario'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE USUARIO SET ID_SESSAO = $sessao, EXCLUIDO = 1 WHERE ID_USUARIO = $usuario";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}
		
	}
?>


