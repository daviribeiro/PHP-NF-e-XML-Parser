-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: xmlparser
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
-- Current Database: `xmlparser`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `xmlparser` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `xmlparser`;

--
-- Table structure for table `nfs_entrada`
--

DROP TABLE IF EXISTS `nfs_entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nfs_entrada` (
  `codigo_nf` int(11) NOT NULL DEFAULT '0',
  `natureza_operacao` varchar(100) DEFAULT NULL,
  `nome_emitente` varchar(200) NOT NULL,
  `numero_nf` int(11) DEFAULT NULL,
  `data_emissao` date NOT NULL,
  `valor_base_calculo` float(10,2) NOT NULL,
  `valor_icms` float(10,2) NOT NULL,
  `valor_base_subst_trib` float(10,2) NOT NULL,
  `valor_subst_trib` float(10,2) NOT NULL,
  `valor_produtos` float(10,2) NOT NULL,
  `valor_frete` float(10,2) NOT NULL,
  `valor_seguro` float(10,2) NOT NULL,
  `valor_desconto` float(10,2) NOT NULL,
  `valor_ii` float(10,2) NOT NULL,
  `valor_ipi` float(10,2) NOT NULL,
  `valor_pis` float(10,2) NOT NULL,
  `valor_cofins` float(10,2) NOT NULL,
  `valor_outro` float(10,2) NOT NULL,
  `valor_nf` float(10,2) NOT NULL,
  `data_inclusao_nf` date NOT NULL,
  PRIMARY KEY (`codigo_nf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nfs_entrada`
--

LOCK TABLES `nfs_entrada` WRITE;
/*!40000 ALTER TABLE `nfs_entrada` DISABLE KEYS */;
/*!40000 ALTER TABLE `nfs_entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nfs_saida`
--

DROP TABLE IF EXISTS `nfs_saida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nfs_saida` (
  `codigo_nf` int(11) NOT NULL DEFAULT '0',
  `natureza_operacao` varchar(100) DEFAULT NULL,
  `nome_emitente` varchar(200) NOT NULL,
  `numero_nf` int(11) DEFAULT NULL,
  `data_emissao` date NOT NULL,
  `valor_base_calculo` float(10,2) NOT NULL,
  `valor_icms` float(10,2) NOT NULL,
  `valor_base_subst_trib` float(10,2) NOT NULL,
  `valor_subst_trib` float(10,2) NOT NULL,
  `valor_produtos` float(10,2) NOT NULL,
  `valor_frete` float(10,2) NOT NULL,
  `valor_seguro` float(10,2) NOT NULL,
  `valor_desconto` float(10,2) NOT NULL,
  `valor_ii` float(10,2) NOT NULL,
  `valor_ipi` float(10,2) NOT NULL,
  `valor_pis` float(10,2) NOT NULL,
  `valor_cofins` float(10,2) NOT NULL,
  `valor_outro` float(10,2) NOT NULL,
  `valor_nf` float(10,2) NOT NULL,
  `data_inclusao_nf` date NOT NULL,
  PRIMARY KEY (`codigo_nf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nfs_saida`
--

LOCK TABLES `nfs_saida` WRITE;
/*!40000 ALTER TABLE `nfs_saida` DISABLE KEYS */;
/*!40000 ALTER TABLE `nfs_saida` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-09-28 22:33:11
