USE radiske;

DELIMITER $$
CREATE TRIGGER SALVAR_LOG_EVENTO
AFTER UPDATE 
ON radiske.EVENTO
FOR EACH ROW
BEGIN
	SET @id := (SELECT ID_SESSAO FROM SESSAO ORDER BY ID_SESSAO DESC LIMIT 1);
	INSERT INTO LOG (ID_SESSAO, DADOS) VALUES (@id, CONCAT('{"ID_EVENTO": ' , OLD.ID_EVENTO , ', "NOME": "' , OLD.NOME , '", "DESCRICAO": "' , IFNULL("null", OLD.DESCRICAO) , '", "LOCALIZACAO": "' , IFNULL("null", OLD.LOCALIZACAO) , '", "DATA_HORA_INICIO": "' , IFNULL("null", OLD.DATA_HORA_INICIO) , '", "DATA_HORA_TERMINO": "' , IFNULL("null", OLD.DATA_HORA_TERMINO) , '", "LEMBRETE": ' , OLD.LEMBRETE , ', "MOMENTO": "' , OLD.MOMENTO , '", "ID_EVENTO_TIPO": ' , OLD.ID_EVENTO_TIPO , ', "ID_CURSO": ' , OLD.ID_CURSO , ', "ID_SESSAO": ' , OLD.ID_SESSAO , ', "ID_RECORRENCIA": ' , OLD.ID_RECORRENCIA , ', "ID_EVENTO_ORIGEM": ' , IFNULL(0, OLD.ID_EVENTO_ORIGEM) , '}'));
END;
$$