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
    	* Função para buscar as recorrências
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarRecorrencias() {
			
			require 'DefaultModel.php';
			
			$sql = "SELECT * FROM RECORRENCIA";
			 
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

			$sql = "UPDATE EVENTO SET NOME = '$nome', DESCRICAO = '$descricao', LOCALIZACAO = '$localizacao', DATA_HORA_INICIO = '$dataInicio', DATA_HORA_TERMINO = '$dataFim', LEMBRETE = $lembrete, ATIVO = $ativo, ID_EVENTO_TIPO = $eventoTipo, ID_CURSO = $curso, ID_SESSAO = $sessao, ID_RECORRENCIA = $recorrencia, ID_EVENTO_ORIGEM = $eventoOrigem WHERE ID_EVENTO = $evento";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para exclusão lógica do evento
    	* @access public 
    	* @param $evento, $sessao
		* @return boolean
    	*/ 
		public function apagarEvento() {
			
			require 'DefaultModel.php';

			$evento = $_REQUEST['evento'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE EVENTO SET ID_SESSAO = $sessao, EXCLUIDO = 1 WHERE ID_EVENTO = $evento";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}
		
	}
?>


