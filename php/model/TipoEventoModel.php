<?php
	/** 
 	* Model destinada as tarefas drelacionadas aos tipos de eventos
	*
	* @author Augusto Gehrke <augustogehrke@outlook.com>
	* @copyright  AMF © 2018
	* @access public  
	* @package php/model
	*/
	 class TipoEventoModel {

		/** 
    	* Função para cadastrar o tipo de evento
    	* @access public 
    	* @param $nome, $cor, $sessao
		* @return boolean
    	*/ 
		public function cadastrarTipoEvento() {
			
			require 'DefaultModel.php';

			$nome = $_REQUEST['nome'];
			$cor = $_REQUEST['cor'];
			$sessao = $_REQUEST['sessao'];

			$sql = "INSERT INTO EVENTO_TIPO(NOME, COR, ID_SESSAO) VALUES('$nome', $cor, $sessao)";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para buscar os tipos de eventos
    	* @access public 
		* @return array
		* @return null
    	*/ 
		public function buscarTiposEventos() {
			
			require 'DefaultModel.php';
			
			$sql = "SELECT * FROM EVENTO_TIPO";
			 
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
    	* Função para alterar o tipo de evento
    	* @access public 
    	* @param $eventoTipo, $nome, $cor, $sessao
		* @return boolean
    	*/ 
		public function alterarTipoEvento() {
			
			require 'DefaultModel.php';

			$eventoTipo = $_REQUEST['eventoTipo'];
			$nome = $_REQUEST['nome'];
			$cor = $_REQUEST['cor'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE EVENTO_TIPO SET NOME = '$nome', COR = $cor, ID_SESSAO = $sessao WHERE ID_EVENTO_TIPO = $eventoTipo";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}

		/** 
    	* Função para exclusão lógica do tipo de evento
    	* @access public 
    	* @param $eventoTipo, $sessao
		* @return boolean
    	*/ 
		public function apagarTipoEvento() {
			
			require 'DefaultModel.php';

			$eventoTipo = $_REQUEST['eventoTipo'];
			$sessao = $_REQUEST['sessao'];

			$sql = "UPDATE EVENTO_TIPO SET ID_SESSAO = $sessao, EXCLUIDO = 1 WHERE ID_EVENTO_TIPO = $eventoTipo";
			 
			if($conexao->query($sql) === TRUE) {
				return true;
		  	}else{
				return false;
		  	}
			
		}
		
	}
?>


