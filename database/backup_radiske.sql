/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.6.38-log : Database - radiske
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`radiske` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `radiske`;

/*Table structure for table `CURSO` */

DROP TABLE IF EXISTS `CURSO`;

CREATE TABLE `CURSO` (
  `ID_CURSO` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(100) NOT NULL,
  `LOGO` LONGBLOB NOT NULL,
  `EXCLUIDO` BIT(1) NOT NULL DEFAULT b'0',
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_SESSAO` INT(11) NOT NULL,
  PRIMARY KEY (`ID_CURSO`),
  KEY `fk_CURSO_SESSAO1_idx` (`ID_SESSAO`),
  CONSTRAINT `fk_CURSO_SESSAO1` FOREIGN KEY (`ID_SESSAO`) REFERENCES `SESSAO` (`ID_SESSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `CURSO` */

INSERT  INTO `CURSO`(`ID_CURSO`,`NOME`,`LOGO`,`EXCLUIDO`,`MOMENTO`,`ID_SESSAO`) VALUES 
(1,'price.png','�PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0d\0\0\0\0\0\0���\0\0\0gAMA\0\0���a\0\0\0 cHRM\0\0z&\0\0��\0\0�\0\0\0��\0\0u0\0\0�`\0\0:�\0\0p��Q<\0\0\0bKGD\0���̿\0\0\0	pHYs\0\0�\0\0��o�d\0\0�IDATX��=HQ\0����[Z�:�88(*��.�IP�P����G	D!���:�`AqPЩ-��P5V��=�?���������������`�4��G�#0�o��d�ݩ*4���qEDo������SU���Ez�/\r�#=]�Yn.�)��睔E�d])N+%�{UAkl�\0�H4L�yJD�]�O��>o�y�q�H���\Z�H���\Z�MD�m�x�m@ȡ[�8/���O�5E���\"S2-R�+��=��;嗷?��E&ʓtX�X��U!����|XIO)w(�*S\"�\r������|�o����#�ZH��7{��7*S>�en�Zؑ�y����gL���K-�`�.~�((Հ��`Pq�WL�\nŒт_�e�K�B�VGZ�<,�QKd��fY�I���@G��櫵QV3��i%��u@�\n\0\0\0%tEXtdate:create\02017-11-06T05:32:02+01:00Q��\0\0\0%tEXtdate:modify\02017-11-06T05:32:02+01:00 �x�\0\0\0tEXtSoftware\0Greenshot^U\0\0\0\0IEND�B`�','\0','2018-05-22 22:02:38',49),
(2,'lod','QzpceGFtcHBcdG1wXHBocEQ5Q0YudG1w','\0','2018-05-29 18:48:04',50),
(3,'lod','QzpceGFtcHBcdG1wXHBocEQ5Q0YudG1w','\0','2018-05-29 18:48:07',50),
(4,'Ssistem','QzpceGFtcHBcdG1wXHBocENDRDgudG1w','\0','2018-05-29 19:29:44',50),
(5,'teste','','\0','2018-05-29 20:11:14',50);

/*Table structure for table `EVENTO` */

DROP TABLE IF EXISTS `EVENTO`;

CREATE TABLE `EVENTO` (
  `ID_EVENTO` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) NOT NULL,
  `DESCRICAO` TEXT,
  `LOCALIZACAO` VARCHAR(299) DEFAULT NULL,
  `DATA_HORA_INICIO` DATETIME DEFAULT NULL,
  `DATA_HORA_TERMINO` DATETIME DEFAULT NULL,
  `LEMBRETE` SMALLINT(6) NOT NULL DEFAULT '0',
  `ATIVO` BIT(1) NOT NULL DEFAULT b'1',
  `EXCLUIDO` BIT(1) NOT NULL DEFAULT b'0',
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_EVENTO_TIPO` INT(11) NOT NULL,
  `ID_CURSO` INT(11) NOT NULL,
  `ID_SESSAO` INT(11) NOT NULL,
  `ID_RECORRENCIA` INT(11) NOT NULL,
  `ID_EVENTO_ORIGEM` INT(11) DEFAULT NULL,
  PRIMARY KEY (`ID_EVENTO`),
  KEY `fk_EVENTO_EVENTO_TIPO1_idx` (`ID_EVENTO_TIPO`),
  KEY `fk_EVENTO_CURSO1_idx` (`ID_CURSO`),
  KEY `fk_EVENTO_SESSAO1_idx` (`ID_SESSAO`),
  KEY `ID_RECORRENCIA` (`ID_RECORRENCIA`),
  CONSTRAINT `FK_EVENTO_RECORRENCIA1` FOREIGN KEY (`ID_RECORRENCIA`) REFERENCES `RECORRENCIA` (`ID_RECORRENCIA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_CURSO1` FOREIGN KEY (`ID_CURSO`) REFERENCES `CURSO` (`ID_CURSO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_EVENTO_TIPO1` FOREIGN KEY (`ID_EVENTO_TIPO`) REFERENCES `EVENTO_TIPO` (`ID_EVENTO_TIPO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_EVENTO_SESSAO1` FOREIGN KEY (`ID_SESSAO`) REFERENCES `SESSAO` (`ID_SESSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Data for the table `EVENTO` */

/*Table structure for table `EVENTO_TIPO` */

DROP TABLE IF EXISTS `EVENTO_TIPO`;

CREATE TABLE `EVENTO_TIPO` (
  `ID_EVENTO_TIPO` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) NOT NULL,
  `COR` INT(11) NOT NULL DEFAULT '0',
  `EXCLUIDO` BIT(1) NOT NULL DEFAULT b'0',
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_SESSAO` INT(11) NOT NULL,
  PRIMARY KEY (`ID_EVENTO_TIPO`),
  KEY `fk_EVENTO_TIPO_SESSAO1_idx` (`ID_SESSAO`),
  CONSTRAINT `fk_EVENTO_TIPO_SESSAO1` FOREIGN KEY (`ID_SESSAO`) REFERENCES `SESSAO` (`ID_SESSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Data for the table `EVENTO_TIPO` */

/*Table structure for table `LOG` */

DROP TABLE IF EXISTS `LOG`;

CREATE TABLE `LOG` (
  `ID_LOG` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_SESSAO` INT(11) NOT NULL,
  `DADOS` LONGTEXT NOT NULL,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_LOG`),
  KEY `ID_SESSAO` (`ID_SESSAO`),
  CONSTRAINT `FK_LOG_SESSAO1` FOREIGN KEY (`ID_SESSAO`) REFERENCES `SESSAO` (`ID_SESSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Data for the table `LOG` */

/*Table structure for table `PERMISSAO` */

DROP TABLE IF EXISTS `PERMISSAO`;

CREATE TABLE `PERMISSAO` (
  `ID_PERMISSAO` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(100) NOT NULL,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_PERMISSAO`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

/*Data for the table `PERMISSAO` */

/*Table structure for table `RECORRENCIA` */

DROP TABLE IF EXISTS `RECORRENCIA`;

CREATE TABLE `RECORRENCIA` (
  `ID_RECORRENCIA` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ID_RECORRENCIA`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `RECORRENCIA` */

INSERT  INTO `RECORRENCIA`(`ID_RECORRENCIA`,`DESCRICAO`) VALUES 
(1,'Segunda a sexta'),
(2,'Semanal'),
(3,'Mensal'),
(4,'Diariamente');

/*Table structure for table `SESSAO` */

DROP TABLE IF EXISTS `SESSAO`;

CREATE TABLE `SESSAO` (
  `ID_SESSAO` INT(11) NOT NULL AUTO_INCREMENT,
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_USUARIO` INT(11) NOT NULL,
  PRIMARY KEY (`ID_SESSAO`),
  KEY `fk_SESSAO_USUARIO1_idx` (`ID_USUARIO`),
  CONSTRAINT `FK_SESSAO_USUARIO1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `SESSAO` */

INSERT  INTO `SESSAO`(`ID_SESSAO`,`MOMENTO`,`ID_USUARIO`) VALUES 
(1,'2018-04-03 21:38:11',1),
(2,'2018-04-05 00:01:00',1),
(3,'2018-04-10 23:46:00',1),
(4,'2018-04-10 23:48:00',1),
(5,'2018-04-10 23:49:00',1),
(6,'2018-04-11 00:10:00',1),
(7,'2018-04-25 01:18:00',1),
(8,'2018-04-25 01:26:00',1),
(9,'2018-04-25 02:40:00',1),
(10,'2018-04-25 02:43:00',1),
(11,'2018-04-25 02:44:00',1),
(12,'2018-04-25 02:45:00',1),
(13,'2018-04-25 03:18:00',1),
(14,'2018-04-28 15:41:00',1),
(15,'2018-04-28 15:58:00',1),
(16,'2018-04-29 01:41:00',1),
(17,'2018-04-29 01:57:00',1),
(18,'2018-04-29 05:24:00',1),
(19,'2018-04-29 05:24:00',1),
(20,'2018-04-29 05:49:00',1),
(21,'2018-04-29 05:51:00',1),
(22,'2018-04-29 05:54:00',1),
(23,'2018-04-30 03:02:00',1),
(24,'2018-05-02 03:40:00',1),
(25,'2018-05-02 03:53:00',1),
(26,'2018-05-04 00:49:00',1),
(27,'2018-05-04 00:59:00',1),
(28,'2018-05-04 01:00:00',1),
(29,'2018-05-04 01:12:00',1),
(30,'2018-05-04 02:23:00',1),
(31,'2018-05-05 02:10:00',1),
(32,'2018-05-05 02:12:00',1),
(33,'2018-05-05 02:18:00',1),
(34,'2018-05-08 03:00:00',1),
(35,'2018-05-08 04:34:00',1),
(36,'2018-05-09 00:28:00',1),
(37,'2018-05-09 00:34:00',1),
(38,'2018-05-09 00:34:00',1),
(39,'2018-05-09 00:36:00',1),
(40,'2018-05-09 01:21:00',1),
(41,'2018-05-09 01:23:00',1),
(42,'2018-05-10 00:05:00',1),
(43,'2018-05-23 00:12:00',1),
(44,'2018-05-23 00:18:00',1),
(45,'2018-05-23 00:27:00',1),
(46,'2018-05-23 00:33:00',13),
(47,'2018-05-23 01:03:00',1),
(48,'2018-05-23 01:17:00',1),
(49,'2018-05-23 01:22:00',1),
(50,'2018-05-29 23:23:00',1),
(51,'2018-05-29 23:55:00',1),
(52,'2018-05-30 01:00:00',1);

/*Table structure for table `USUARIO` */

DROP TABLE IF EXISTS `USUARIO`;

CREATE TABLE `USUARIO` (
  `ID_USUARIO` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(255) NOT NULL,
  `SENHA` VARCHAR(50) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `EXCLUIDO` BIT(1) NOT NULL DEFAULT b'0',
  `MOMENTO` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID_SESSAO` INT(11) NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `fk_USUARIO_SESSAO1_idx` (`ID_SESSAO`),
  CONSTRAINT `fk_USUARIO_SESSAO1` FOREIGN KEY (`ID_SESSAO`) REFERENCES `SESSAO` (`ID_SESSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=INNODB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `USUARIO` */

insert  into `USUARIO`(`ID_USUARIO`,`NOME`,`SENHA`,`EMAIL`,`EXCLUIDO`,`MOMENTO`,`ID_SESSAO`) values 
(1,'Andreves Dickow','202cb962ac59075b964b07152d234b70','andreves@dickow.me','\0','2018-05-22 20:04:13',47),
(2,'guiteste','202cb962ac59075b964b07152d234b70','gui@site.com','','2018-05-22 20:26:14',49),
(3,'teste2','123','teste@teste.com','\0','2018-04-29 01:09:20',22),
(4,'diego editstdaysdasd','123','diego@teste.com','','2018-05-22 20:26:35',49),
(5,'teste2','teste@teste.com','teste@teste.com','','2018-05-08 00:30:18',35),
(6,'teste3','123','teuiashd@klasjskldja.asd','\0','2018-05-08 00:44:07',35),
(7,'teste4','123','asadjh@kdsad.ds','\0','2018-05-08 00:45:06',35),
(8,'teste5','123','teyasdh@slkads.sada','\0','2018-05-08 00:45:27',35),
(9,'teste5','123','sada@skalds.sd','\0','2018-05-08 00:45:56',35),
(10,'kasskjj','123','sadkls@lskdlaks.sasa','\0','2018-05-08 00:58:51',35),
(11,'ljjhlajsl','123','lssda@dasd.sdf','\0','2018-05-08 00:59:08',35),
(12,'dsds','','sddssdsd@fhfkj.com.br','','2018-05-22 19:19:45',44),
(13,'Zeca','4c4fa194f4d99050dafbfe3d853bb353','zeca@gmail.com','','2018-05-22 20:26:46',49),
(14,'zecacacacacac','2312','hassdhas@jsjsjs.asdas','\0','2018-05-22 19:28:10',45),
(15,'abcsdehdoa','21312','sadak@kjdskdj.sds','\0','2018-05-22 19:31:14',45),
(16,'fsdfsdfsdfasdf jhsdfkj sadhkfjhas dlkfhksljdh fklj','dfsdfas dfsadfsadfsa','dfasdfasdfsadfsdfsadfsadfasdfasdfasdfsdfsdfsdfsdfsdfsdfsdfsdfsadfsdfsadfsadfsdf sdfsd fsdf sdf sdf a','','2018-05-22 19:36:48',45),
(17,'dasd','asdasd','sdas@sdas.dsa','\0','2018-05-22 19:43:46',45),
(18,'joaoaoaoao','202cb962ac59075b964b07152d234b70','lkdlasas@sdasd.sas','\0','2018-05-22 19:52:44',45),
(19,'joaoaoaoaoqqqq','f7e0ef389ac6133c88aedbd66b44a4e1','lkdlasas@sdasd.sas','\0','2018-05-22 19:53:04',45);

/*Table structure for table `USUARIO_PERMISSAO` */

DROP TABLE IF EXISTS `USUARIO_PERMISSAO`;

CREATE TABLE `USUARIO_PERMISSAO` (
  `ID_USUARIO_PERMISSAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PERMISSAO` int(11) NOT NULL,
  PRIMARY KEY (`ID_USUARIO_PERMISSAO`),
  KEY `ID_USUARIO` (`ID_USUARIO`),
  KEY `ID_PERMISSAO` (`ID_PERMISSAO`),
  CONSTRAINT `FK_USUARIO_PERMISSAO_PERMISSAO1` FOREIGN KEY (`ID_PERMISSAO`) REFERENCES `PERMISSAO` (`ID_PERMISSAO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_USUARIO_PERMISSAO_USUARIO1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `USUARIO_PERMISSAO` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
