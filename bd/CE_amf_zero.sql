-- Tempo de geração: 16/02/2018 às 15:37
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessao`
--

CREATE TABLE IF NOT EXISTS `sessao` (
  `id_sessao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_sessao` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `email`, `id_sessao`, `excluido`) VALUES
(1, 'RADISKE', 'g(Ù}', 'diego@radiske.com.br', 0, 0),
(2, 'FÁBIO', 'JÙ¨', 'fabio@prass.com.br', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `logo` longblob,
  `id_sessao` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_tipo`
--

CREATE TABLE IF NOT EXISTS `evento_tipo` (
  `id_evento_tipo` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cor` int(11) NOT NULL DEFAULT '0',
  `id_sessao` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` text,
  `localizacao` varchar(200) DEFAULT NULL,
  `data_hora_inicio` datetime DEFAULT NULL,
  `data_hora_termino` datetime DEFAULT NULL,
  `data_hora_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lembrete` smallint(6) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL,
  `id_evento_tipo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_recorrencia` tinyint(4) DEFAULT NULL,
  `id_evento_origem` int(11) DEFAULT NULL,
  `id_sessao` int(11) NOT NULL,
  `excluido` tinyint(1) DEFAULT '0',
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Índices de tabela `evento_tipo`
--
ALTER TABLE `evento_tipo`
  ADD PRIMARY KEY (`id_evento_tipo`);

--
-- Índices de tabela `sessao`
--
ALTER TABLE `sessao`
  ADD PRIMARY KEY (`id_sessao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de tabela `evento_tipo`
--
ALTER TABLE `evento_tipo`
  MODIFY `id_evento_tipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de tabela `sessao`
--
ALTER TABLE `sessao`
  MODIFY `id_sessao` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
