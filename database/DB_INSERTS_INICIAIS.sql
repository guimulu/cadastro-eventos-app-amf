-- PERMISSOES
INSERT INTO radiske.PERMISSAO (ID_PERMISSAO, NOME) VALUES ('1', 'TELA_USUARIO');
INSERT INTO radiske.PERMISSAO (ID_PERMISSAO, NOME) VALUES ('2', 'TELA_CURSO');
INSERT INTO radiske.PERMISSAO (ID_PERMISSAO, NOME) VALUES ('3', 'TELA_EVENTO');
INSERT INTO radiske.PERMISSAO (ID_PERMISSAO, NOME) VALUES ('4', 'TELA_TIPO_EVENTO');
INSERT INTO radiske.PERMISSAO (ID_PERMISSAO, NOME) VALUES ('5', 'TELA_PERMISSAO');

-- RECORRENCIA
INSERT INTO radiske.RECORRENCIA (DESCRICAO) VALUES ('Semanal');
INSERT INTO radiske.RECORRENCIA (DESCRICAO) VALUES ('Mensal');
INSERT INTO radiske.RECORRENCIA (DESCRICAO) VALUES ('Semestral');
INSERT INTO radiske.RECORRENCIA (DESCRICAO) VALUES ('Anual');

-- USUARIO_PERMISSAO
INSERT INTO radiske.USUARIO_PERMISSAO (ID_USUARIO, ID_PERMISSAO, ID_SESSAO) VALUES ('1', '1', '1');
INSERT INTO radiske.USUARIO_PERMISSAO (ID_USUARIO, ID_PERMISSAO, ID_SESSAO) VALUES ('1', '2', '1');
INSERT INTO radiske.USUARIO_PERMISSAO (ID_USUARIO, ID_PERMISSAO, ID_SESSAO) VALUES ('1', '3', '1');
INSERT INTO radiske.USUARIO_PERMISSAO (ID_USUARIO, ID_PERMISSAO, ID_SESSAO) VALUES ('1', '4', '1');
INSERT INTO radiske.USUARIO_PERMISSAO (ID_USUARIO, ID_PERMISSAO, ID_SESSAO) VALUES ('1', '5', '1');