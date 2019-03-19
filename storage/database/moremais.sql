CREATE DATABASE  IF NOT EXISTS `moremais`;
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
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `contraproposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prop_orc` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_usr_alter` int(11) NOT NULL,
  `novo_valor` int(11) NOT NULL,
  `mensagem` varchar(200) DEFAULT NULL,
  `aceita` tinyint(1) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_prop_orc` (`id_prop_orc`),
  KEY `id_usr` (`id_usr`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `contraproposta_ibfk_1` FOREIGN KEY (`id_prop_orc`) REFERENCES `propostadeorcamento` (`id`),
  CONSTRAINT `contraproposta_ibfk_2` FOREIGN KEY (`id_usr`) REFERENCES `usuario` (`id`),
  CONSTRAINT `contraproposta_ibfk_3` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
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
-- Table structure for table `fornecedoresleilao`
--

DROP TABLE IF EXISTS `fornecedoresleilao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `fornecedoresleilao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_leilao` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_leilao` (`id_leilao`),
  CONSTRAINT `fornecedoresleilao_ibfk_1` FOREIGN KEY (`id_leilao`) REFERENCES `leilao` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedoresleilao`
--

LOCK TABLES `fornecedoresleilao` WRITE;
/*!40000 ALTER TABLE `fornecedoresleilao` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedoresleilao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leilao`
--

DROP TABLE IF EXISTS `leilao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `leilao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `vigencia_inicio` datetime NOT NULL,
  `vigencia_fim` datetime NOT NULL,
  `id_orcamento` int(11) NOT NULL,
  `id_prop_orc_aceita` int(11) NOT NULL,
  `id_usr_cad` int(11) NOT NULL,
  `id_usr_alter` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_usr_cad` (`id_usr_cad`),
  KEY `id_usr_alter` (`id_usr_alter`),
  KEY `id_prop_orc_aceita` (`id_prop_orc_aceita`),
  CONSTRAINT `leilao_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `leilao_ibfk_2` FOREIGN KEY (`id_usr_cad`) REFERENCES `usuario` (`id`),
  CONSTRAINT `leilao_ibfk_3` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`),
  CONSTRAINT `leilao_ibfk_4` FOREIGN KEY (`id_prop_orc_aceita`) REFERENCES `propostadeorcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leilao`
--

LOCK TABLES `leilao` WRITE;
/*!40000 ALTER TABLE `leilao` DISABLE KEYS */;
/*!40000 ALTER TABLE `leilao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `orcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `id_usr_cad` int(11) NOT NULL,
  `id_usr_alter` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usr_cad` (`id_usr_cad`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_usr_cad`) REFERENCES `usuario` (`id`),
  CONSTRAINT `orcamento_ibfk_2` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamento`
--

LOCK TABLES `orcamento` WRITE;
/*!40000 ALTER TABLE `orcamento` DISABLE KEYS */;
INSERT INTO `orcamento` VALUES (6,'Casa da dona Julia',1,4,NULL,'2019-02-21 01:33:55','2019-02-21 01:33:55'),(7,'Casa do tio Thales',1,4,NULL,'2019-02-25 22:33:06','2019-02-25 22:33:06'),(8,'Casa do Daniel',1,4,NULL,'2019-02-25 22:35:00','2019-02-25 22:35:00'),(9,'Casa do Daniel',1,4,NULL,'2019-02-25 22:35:23','2019-02-25 22:35:23');
/*!40000 ALTER TABLE `orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordensdeorcamento`
--

DROP TABLE IF EXISTS `ordensdeorcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `ordensdeorcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `id_orcamento` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `ordensdeorcamento_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `ordensdeorcamento_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordensdeorcamento`
--

LOCK TABLES `ordensdeorcamento` WRITE;
/*!40000 ALTER TABLE `ordensdeorcamento` DISABLE KEYS */;
INSERT INTO `ordensdeorcamento` VALUES (1,1000,6,22),(2,50000,6,18),(3,300,6,16),(4,100,7,21),(5,100,7,18),(6,100,8,21),(7,10,8,15),(8,100,8,21),(9,100,9,21),(10,10,9,15),(11,100,9,21);
/*!40000 ALTER TABLE `ordensdeorcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `und_medida` varchar(30) DEFAULT NULL,
  `id_usr_cad` int(11) NOT NULL,
  `id_usr_alter` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_alter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usr_cad` (`id_usr_cad`),
  KEY `id_usr_alter` (`id_usr_alter`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_usr_cad`) REFERENCES `usuario` (`id`),
  CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`id_usr_alter`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (13,'Madeira Ipê','','metro',4,NULL,'2019-02-20 02:53:52','2019-02-20 02:53:52'),(14,'Madeira Peroba','','metro',4,NULL,'2019-02-20 02:54:06','2019-02-20 02:54:06'),(15,'Madeira Cerejeira','','metro',4,NULL,'2019-02-20 02:54:17','2019-02-20 02:54:17'),(16,'Telha de Metal Nova Geração','','und',4,4,'2019-02-20 02:54:29','2019-02-25 22:25:57'),(17,'Telha de Argila','','und',4,NULL,'2019-02-20 02:54:49','2019-02-20 02:54:49'),(18,'Caixa d’água de Fibra de Vidro','','litro',4,NULL,'2019-02-20 02:54:58','2019-02-20 02:54:58'),(19,'Cisterna','','litro',4,NULL,'2019-02-20 02:55:12','2019-02-20 02:55:12'),(21,'Cerâmica','','metro²',4,NULL,'2019-02-20 02:57:01','2019-02-20 02:57:01'),(22,'Azulejo','','metro²',4,NULL,'2019-02-20 02:57:15','2019-02-20 02:57:15'),(23,'Produto novo','este é um produto novo','und',4,4,'2019-02-25 22:27:54','2019-02-25 22:28:08');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propostadeorcamento`
--

DROP TABLE IF EXISTS `propostadeorcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `propostadeorcamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_leilao` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_ord_orc` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor` float NOT NULL,
  `aberto` tinyint(1) NOT NULL,
  `aceita` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_leilao` (`id_leilao`),
  KEY `id_fornecedor` (`id_fornecedor`),
  KEY `id_ord_orc` (`id_ord_orc`),
  CONSTRAINT `propostadeorcamento_ibfk_1` FOREIGN KEY (`id_leilao`) REFERENCES `leilao` (`id`),
  CONSTRAINT `propostadeorcamento_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedoresleilao` (`id`),
  CONSTRAINT `propostadeorcamento_ibfk_3` FOREIGN KEY (`id_ord_orc`) REFERENCES `ordensdeorcamento` (`id`)
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
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8_general_ci ;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL,
  `nivel_acesso` varchar(15) NOT NULL,
  `num_documento` varchar(30) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `endereco` varchar(15) DEFAULT NULL,
  `cidade` varchar(15) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'daniel','123','daniel martins','daniel@gmail','992143289','a','b','12','x','Centro','Sobral',62270000,'2019-02-12 00:00:00'),(4,'matheuspaixao','12345','Matheus Paixão','matheus.tec3@gmail.com','(88) 99259-4124','desenvolvedor','1','6368570342','CPF',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2019-03-14 16:47:20
