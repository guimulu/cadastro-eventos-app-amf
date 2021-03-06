USE radiske;

DELIMITER $$
CREATE TRIGGER SALVAR_LOG_USUARIO
AFTER UPDATE 
ON radiske.USUARIO
FOR EACH ROW
BEGIN
	SET @id := (SELECT ID_SESSAO FROM SESSAO ORDER BY ID_SESSAO DESC LIMIT 1);
	INSERT INTO LOG (ID_SESSAO, DADOS) VALUES (@id, CONCAT('{"ID_USUARIO": ' , OLD.ID_USUARIO , ', "NOME": "' , OLD.NOME , '", "SENHA": "' , OLD.SENHA , '", "EMAIL": "' , OLD.EMAIL , '", "MOMENTO": "' , OLD.MOMENTO , '", "ID_SESSAO": ' , OLD.ID_SESSAO , '}'));
END;
$$