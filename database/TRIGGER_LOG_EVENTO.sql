USE appamf;

DELIMITER $$
CREATE TRIGGER SALVAR_LOG_EVENTO
AFTER UPDATE 
ON appamf.evento
FOR EACH ROW
BEGIN
	SELECT @id := ID_SESSAO FROM SESSAO ORDER BY ID_SESSAO DESC LIMIT 1;
	INSERT INTO LOG (ID_SESSAO, DADOS) VALUES (@id, '{"ID_EVENTO": ' + OLD.ID_EVENTO + ', "NOME": "' + OLD.NOME + '", "DESCRICAO": "' + OLD.DESCRICAO + '", "LOCALIZACAO": "' + OLD.LOCALIZACAO + '", "DATA_HORA_INICIO": ' + OLD.DATA_HORA_INICIO + ', "DATA_HORA_TERMINO": ' + OLD.DATA_HORA_TERMINO + ', "DATA_HORA_ATUALIZACAO": ' + OLD.DATA_HORA_ATUALIZACAO + ', "LEMBRETE": ' + OLD.LEMBRETE + ', "ATIVO": ' + OLD.ATIVO + ', "EXCLUIDO": ' + OLD.EXCLUIDO + ', "MOMENTO": ' + OLD.MOMENTO + ', "ID_EVENTO_TIPO": ' + OLD.ID_EVENTO_TIPO + ', "ID_CURSO": ' + OLD.ID_CURSO + ', "ID_SESSAO": ' + OLD.ID_SESSAO + ', "ID_RECORRENCIA": ' + OLD.ID_RECORRENCIA + ', "ID_EVENTO_ORIGEM": ' + OLD.ID_EVENTO_ORIGEM + '}');
END;
$$