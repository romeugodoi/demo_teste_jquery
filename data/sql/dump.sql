CREATE DATABASE  IF NOT EXISTS `demojquery` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `demojquery`;
-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: demojquery
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pessoa_endereco`
--

DROP TABLE IF EXISTS `pessoa_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pessoa_id_idx` (`pessoa_id`),
  KEY `endereco_id_idx` (`endereco_id`),
  CONSTRAINT `pessoa_endereco_endereco_id_endereco_id` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pessoa_endereco_pessoa_id_pessoa_id` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_endereco`
--

LOCK TABLES `pessoa_endereco` WRITE;
/*!40000 ALTER TABLE `pessoa_endereco` DISABLE KEYS */;
INSERT INTO `pessoa_endereco` VALUES (1,9,7),(2,10,11),(3,12,12);
/*!40000 ALTER TABLE `pessoa_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_endereco`
--

DROP TABLE IF EXISTS `tipo_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_endereco`
--

LOCK TABLES `tipo_endereco` WRITE;
/*!40000 ALTER TABLE `tipo_endereco` DISABLE KEYS */;
INSERT INTO `tipo_endereco` VALUES (1,'Residencial',NULL),(2,'Comercial',''),(3,'Entrega','');
/*!40000 ALTER TABLE `tipo_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefone`
--

DROP TABLE IF EXISTS `telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_telefone_id` int(11) NOT NULL,
  `ddd` char(2) NOT NULL,
  `numero` char(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_telefone_id_idx` (`tipo_telefone_id`),
  CONSTRAINT `telefone_tipo_telefone_id_tipo_telefone_id` FOREIGN KEY (`tipo_telefone_id`) REFERENCES `tipo_telefone` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefone`
--

LOCK TABLES `telefone` WRITE;
/*!40000 ALTER TABLE `telefone` DISABLE KEYS */;
INSERT INTO `telefone` VALUES (1,1,'62','5161-6165'),(2,1,'62','5161-6165'),(3,1,'62','6651-6165'),(4,1,'62','6516-5165'),(5,1,'62','6516-5165'),(6,1,'62','6516-5165'),(7,1,'62','6516-5165'),(8,1,'64','9999-9999'),(9,1,'64','9999-9999'),(10,1,'62','1651-6651'),(11,1,'62','1651-6651'),(12,1,'62','1651-6651'),(13,2,'62','6565-1651'),(14,1,'62','9265-1619');
/*!40000 ALTER TABLE `telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_endereco_id` int(11) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `cidade` varchar(60) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_endereco_id_idx` (`tipo_endereco_id`),
  CONSTRAINT `endereco_tipo_endereco_id_tipo_endereco_id` FOREIGN KEY (`tipo_endereco_id`) REFERENCES `tipo_endereco` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,1,'Rua aslsal','Goiania','GO','23929-384'),(2,1,'Rua teste ','asiasdio','as','23492-039'),(3,1,'Rua teste ','asiasdio','as','23492-039'),(4,1,'Rua teste ','asiasdio','as','23492-039'),(5,1,'Rua teste ','asiasdio','as','23492-039'),(6,1,'Rua teste 2','Goiânia','GO','11111-111'),(7,1,'Rua teste 2','Goiânia','GO','11111-111'),(8,1,'Rua 2 ','Goiania','Go','23874-928'),(9,1,'Rua 2 ','Goiania','Go','23874-928'),(10,1,'Rua 2 ','Goiania','Go','23874-928'),(11,1,'Rua strekjl','alsdlka','go','29834-923'),(12,1,'Rua Terra ','Ap de Goiânia','GO','23842-934');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Romulo da Silva','romulo@alsk.com'),(2,'Paulo Bernardes','paulo@asl.com'),(3,'Rodrigo Pereira','rodsk@sas.com'),(4,'Amado Batista','amska@sak.com'),(5,'Diva Paula','asl@asldc.com'),(6,'Rogerio Sardinha','alsdlk@alskl.com'),(7,'JOsemir Silva','askl@lksald.com'),(8,'JOsemir Silva','askl@lksald.com'),(9,'Alvaro Dias','asdasd@asd.com.br'),(10,'Wladmir Peres','Wlad@terra.com'),(11,'asdasd',''),(12,'Ana lídia Barroso','ana@terra.com.br');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_telefone`
--

DROP TABLE IF EXISTS `tipo_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_telefone`
--

LOCK TABLES `tipo_telefone` WRITE;
/*!40000 ALTER TABLE `tipo_telefone` DISABLE KEYS */;
INSERT INTO `tipo_telefone` VALUES (1,'Celular',NULL),(2,'Residencial','');
/*!40000 ALTER TABLE `tipo_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa_telefone`
--

DROP TABLE IF EXISTS `pessoa_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa_telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) NOT NULL,
  `telefone_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pessoa_id_idx` (`pessoa_id`),
  KEY `telefone_id_idx` (`telefone_id`),
  CONSTRAINT `pessoa_telefone_pessoa_id_pessoa_id` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pessoa_telefone_telefone_id_telefone_id` FOREIGN KEY (`telefone_id`) REFERENCES `telefone` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_telefone`
--

LOCK TABLES `pessoa_telefone` WRITE;
/*!40000 ALTER TABLE `pessoa_telefone` DISABLE KEYS */;
INSERT INTO `pessoa_telefone` VALUES (1,9,9),(2,10,13),(3,12,14);
/*!40000 ALTER TABLE `pessoa_telefone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-12 18:49:18
