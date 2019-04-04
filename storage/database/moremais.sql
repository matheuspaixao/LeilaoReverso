CREATE DATABASE IF NOT EXISTS `moremais`;

USE `moremais`;

-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: moremais
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contraproposta`
--

DROP TABLE IF EXISTS `contraproposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `contraproposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prop_orc` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_usr_alter` int(11) NOT NULL,
  `novo_valor` int(11) NOT NULL,
  `mensagem` text,
  `aceita` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_prop_orc` (`id_prop_orc`),
  KEY `id_usr` (`id_usr`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `contraProposta_ibfk_1` FOREIGN KEY (`id_prop_orc`) REFERENCES `propostadeorcamento` (`id`),
  CONSTRAINT `contraProposta_ibfk_2` FOREIGN KEY (`id_usr`) REFERENCES `usuario` (`id`),
  CONSTRAINT `contraProposta_ibfk_3` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contraproposta`
--

LOCK TABLES `contraproposta` WRITE;
/*!40000 ALTER TABLE `contraproposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `contraproposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedoresorcamento`
--

DROP TABLE IF EXISTS `fornecedoresorcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `fornecedoresorcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orcamento` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  CONSTRAINT `fornecedoresOrcamento_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedoresorcamento`
--

LOCK TABLES `fornecedoresorcamento` WRITE;
/*!40000 ALTER TABLE `fornecedoresorcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedoresorcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `orcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `vigencia_inicio` datetime NOT NULL,
  `vigencia_fim` datetime NOT NULL,
  `id_usr_cad` int(11) NOT NULL,
  `id_usr_alter` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usr_cad` (`id_usr_cad`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_usr_cad`) REFERENCES `usuario` (`id`),
  CONSTRAINT `orcamento_ibfk_2` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamento`
--

LOCK TABLES `orcamento` WRITE;
/*!40000 ALTER TABLE `orcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordensdeorcamento`
--

DROP TABLE IF EXISTS `ordensdeorcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `ordensdeorcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orcamento` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `ordensDeOrcamento_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `ordensDeOrcamento_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordensdeorcamento`
--

LOCK TABLES `ordensdeorcamento` WRITE;
/*!40000 ALTER TABLE `ordensdeorcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordensdeorcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordensdeproposta`
--

DROP TABLE IF EXISTS `ordensdeproposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `ordensdeproposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prop_orc` int(11) NOT NULL,
  `id_ord_orc` int(11) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `aceita` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_prop_orc` (`id_prop_orc`),
  KEY `id_ord_orc` (`id_ord_orc`),
  CONSTRAINT `ordensDeProposta_ibfk_1` FOREIGN KEY (`id_prop_orc`) REFERENCES `propostadeorcamento` (`id`),
  CONSTRAINT `ordensDeProposta_ibfk_2` FOREIGN KEY (`id_ord_orc`) REFERENCES `ordensdeorcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordensdeproposta`
--

LOCK TABLES `ordensdeproposta` WRITE;
/*!40000 ALTER TABLE `ordensdeproposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordensdeproposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `id_und_medida` int(11) NOT NULL,
  `id_usr_cad` int(11) NOT NULL,
  `id_usr_alter` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_und_medida` (`id_und_medida`),
  KEY `id_usr_cad` (`id_usr_cad`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_und_medida`) REFERENCES `undmedida` (`id`),
  CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`id_usr_cad`) REFERENCES `usuario` (`id`),
  CONSTRAINT `produto_ibfk_3` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (1,'Cimento','',15,1,NULL,'2019-03-23 21:03:03','2019-03-23 21:03:03'),(4,'Tijolo Argila tipo 1','',14,1,NULL,'2019-03-23 22:40:44','2019-03-23 22:40:44');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propostadeorcamento`
--

DROP TABLE IF EXISTS `propostadeorcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `propostadeorcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orcamento` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `aceita` tinyint(1) NOT NULL DEFAULT '0',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `propostaDeOrcamento_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `propostaDeOrcamento_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedoresorcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propostadeorcamento`
--

LOCK TABLES `propostadeorcamento` WRITE;
/*!40000 ALTER TABLE `propostadeorcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `propostadeorcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `tipousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `nivel_acesso` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (1,'Administrador do sistema',10,'Possui nivel de acesso máximo e pode usufruir de todas as funcionalidades do sistema'),(2,'Funcionario',5,'Não possui acessos a relatórios gerenciais e não pode criar outros usuários'),(3,'Fornecedor Ativo',3,'Possui acesso a relatórios pertinentes a fornecedores e é capaz de fazer propostas a orçamentos ativos'),(4,'Fornecedor Desativado',1,'Possui acesso apenas a editar seu perfil e ver os orcamentos ativos');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `undmedida`
--

DROP TABLE IF EXISTS `undmedida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `undmedida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidade` varchar(15) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `undmedida`
--

LOCK TABLES `undmedida` WRITE;
/*!40000 ALTER TABLE `undmedida` DISABLE KEYS */;
INSERT INTO `undmedida` VALUES (1,'BARRA','BARRA'),(2,'BLOCO','BLOCO'),(3,'CJ','CONJUNTO'),(4,'CM','CENTIMETRO'),(5,'CM2','CENTIMETRO QUADRADO'),(6,'CX','CAIXA'),(7,'CENTO','CENTO'),(8,'GALAO','GALÃO'),(9,'LATA','LATA'),(10,'LITRO','LITRO'),(11,'M','METRO'),(12,'M2','METRO QUADRADO'),(13,'M3','METRO CÚBICO'),(14,'MILHEI','MILHEIRO'),(15,'KG','QUILOGRAMA'),(16,'UNID','UNIDADE'),(17,'MWH','MEGAWATT HORA');
/*!40000 ALTER TABLE `undmedida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `UF` varchar(3) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT UK_login unique (`login`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipousuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario`() VALUES (1,'matheuspaixao','12345','Matheus Paixão de Oliveira','matheus.tec3@gmail.com','(88) 99259-4124',1,'063.685.703-42','CPF',NULL,NULL,NULL,NULL,NULL,'2019-03-23 19:18:05'),(2,'hugofirmino','12345','Hugo Firmino Damasceno','teste1@teste.com','(88) 90000-0000',1,'000.000.000-00','CPF',NULL,NULL,NULL,NULL,NULL,'2019-03-23 19:18:05'),(3,'franciscodaniel','12345','Francisco Daniel Freitas Martins','teste2@teste.com','(88) 90000-0000',1,'000.000.000-00','CPF',NULL,NULL,NULL,NULL,NULL,'2019-03-23 19:18:05'),(4,'thalesandrade','12345','Thales Andrade','teste3@teste.com','(88) 90000-0000',1,'000.000.000-00','CPF',NULL,NULL,NULL,NULL,NULL,'2019-03-23 19:18:05');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-23 19:48:23
