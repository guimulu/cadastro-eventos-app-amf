-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema radiske
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema radiske
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `radiske` DEFAULT CHARACTER SET utf8 ;
USE `radiske` ;

-- -----------------------------------------------------
-- Table `radiske`.`USUARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`USUARIO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`USUARIO` (
  `ID_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(255) NOT NULL,
  `SENHA` VARCHAR(50) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `EXCLUIDO` BIT NOT NULL DEFAULT 0,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_SESSAO` INT NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  INDEX `fk_USUARIO_SESSAO1_idx` (`ID_SESSAO` ASC),
  UNIQUE INDEX `EMAIL_UNIQUE` (`EMAIL` ASC),
  CONSTRAINT `fk_USUARIO_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`SESSAO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`SESSAO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`SESSAO` (
  `ID_SESSAO` INT NOT NULL AUTO_INCREMENT,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_USUARIO` INT NOT NULL,
  PRIMARY KEY (`ID_SESSAO`),
  INDEX `fk_SESSAO_USUARIO1_idx` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_SESSAO_USUARIO1`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `radiske`.`USUARIO` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`CURSO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`CURSO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`CURSO` (
  `ID_CURSO` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(100) NOT NULL,
  `LOGO` LONGBLOB NOT NULL,
  `EXCLUIDO` BIT NOT NULL DEFAULT 0,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_SESSAO` INT NOT NULL,
  PRIMARY KEY (`ID_CURSO`),
  INDEX `fk_CURSO_SESSAO1_idx` (`ID_SESSAO` ASC),
  CONSTRAINT `fk_CURSO_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`EVENTO_TIPO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`EVENTO_TIPO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`EVENTO_TIPO` (
  `ID_EVENTO_TIPO` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) NOT NULL,
  `COR` INT NOT NULL DEFAULT 0,
  `EXCLUIDO` BIT NOT NULL DEFAULT 0,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_SESSAO` INT NOT NULL,
  PRIMARY KEY (`ID_EVENTO_TIPO`),
  INDEX `fk_EVENTO_TIPO_SESSAO1_idx` (`ID_SESSAO` ASC),
  CONSTRAINT `fk_EVENTO_TIPO_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`RECORRENCIA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`RECORRENCIA` ;

CREATE TABLE IF NOT EXISTS `radiske`.`RECORRENCIA` (
  `ID_RECORRENCIA` INT NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ID_RECORRENCIA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`EVENTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`EVENTO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`EVENTO` (
  `ID_EVENTO` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) NOT NULL,
  `DESCRICAO` TEXT NULL,
  `LOCALIZACAO` VARCHAR(299) NULL,
  `DATA_HORA_INICIO` DATETIME NULL,
  `DATA_HORA_TERMINO` DATETIME NULL,
  `DATA_HORA_ATUALIZACAO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LEMBRETE` SMALLINT(6) NOT NULL DEFAULT 0,
  `ATIVO` BIT NOT NULL DEFAULT 1,
  `EXCLUIDO` BIT NOT NULL DEFAULT 0,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_EVENTO_TIPO` INT NOT NULL,
  `ID_CURSO` INT NOT NULL,
  `ID_SESSAO` INT NOT NULL,
  `ID_RECORRENCIA` INT NOT NULL,
  `ID_EVENTO_ORIGEM` INT NULL,
  PRIMARY KEY (`ID_EVENTO`),
  INDEX `fk_EVENTO_EVENTO_TIPO1_idx` (`ID_EVENTO_TIPO` ASC),
  INDEX `fk_EVENTO_CURSO1_idx` (`ID_CURSO` ASC),
  INDEX `fk_EVENTO_SESSAO1_idx` (`ID_SESSAO` ASC),
  INDEX `fk_EVENTO_RECORRENCIA1_idx` (`ID_RECORRENCIA` ASC),
  CONSTRAINT `fk_EVENTO_EVENTO_TIPO1`
    FOREIGN KEY (`ID_EVENTO_TIPO`)
    REFERENCES `radiske`.`EVENTO_TIPO` (`ID_EVENTO_TIPO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_CURSO1`
    FOREIGN KEY (`ID_CURSO`)
    REFERENCES `radiske`.`CURSO` (`ID_CURSO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_RECORRENCIA1`
    FOREIGN KEY (`ID_RECORRENCIA`)
    REFERENCES `radiske`.`RECORRENCIA` (`ID_RECORRENCIA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`PERMISSAO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`PERMISSAO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`PERMISSAO` (
  `ID_PERMISSAO` INT NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(100) NOT NULL,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_PERMISSAO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`USUARIO_PERMISSAO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`USUARIO_PERMISSAO` ;

CREATE TABLE IF NOT EXISTS `radiske`.`USUARIO_PERMISSAO` (
  `ID_USUARIO_PERMISSAO` INT NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` INT NOT NULL,
  `ID_PERMISSAO` INT NOT NULL,
  `ID_SESSAO` INT NOT NULL,
  PRIMARY KEY (`ID_USUARIO_PERMISSAO`),
  INDEX `fk_USUARIO_PERMISSAO_USUARIO1_idx` (`ID_USUARIO` ASC),
  INDEX `fk_USUARIO_PERMISSAO_PERMISSAO1_idx` (`ID_PERMISSAO` ASC),
  INDEX `fk_USUARIO_PERMISSAO_SESSAO1_idx` (`ID_SESSAO` ASC),
  CONSTRAINT `fk_USUARIO_PERMISSAO_USUARIO1`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `radiske`.`USUARIO` (`ID_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USUARIO_PERMISSAO_PERMISSAO1`
    FOREIGN KEY (`ID_PERMISSAO`)
    REFERENCES `radiske`.`PERMISSAO` (`ID_PERMISSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USUARIO_PERMISSAO_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `radiske`.`LOG`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `radiske`.`LOG` ;

CREATE TABLE IF NOT EXISTS `radiske`.`LOG` (
  `ID_LOG` INT NOT NULL AUTO_INCREMENT,
  `ID_SESSAO` INT NOT NULL,
  `DADOS` TEXT NOT NULL,
  `LOGO` LONGBLOB NULL,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_LOG`),
  INDEX `fk_LOG_SESSAO1_idx` (`ID_SESSAO` ASC),
  CONSTRAINT `fk_LOG_SESSAO1`
    FOREIGN KEY (`ID_SESSAO`)
    REFERENCES `radiske`.`SESSAO` (`ID_SESSAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;