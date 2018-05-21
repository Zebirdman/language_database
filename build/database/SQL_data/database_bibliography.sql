-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: ec2-13-211-2-121.ap-southeast-2.compute.amazonaws.com    Database: database
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

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
-- Table structure for table `bibliography`
--

DROP TABLE IF EXISTS `bibliography`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bibliography` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT ' ',
  `title` varchar(120) DEFAULT ' ',
  `author` varchar(100) DEFAULT ' ',
  `journal` varchar(100) DEFAULT ' ',
  `year` int(4) DEFAULT '0',
  `month` varchar(15) DEFAULT ' ',
  `pages` int(11) DEFAULT '0',
  `volume` int(11) DEFAULT '0',
  `arxiv` int(10) DEFAULT '0',
  `doi` varchar(60) DEFAULT ' ',
  `gsid` int(11) DEFAULT '0',
  `issue` int(11) DEFAULT '0',
  `numpages` int(11) DEFAULT '0',
  `publisher` varchar(80) DEFAULT ' ',
  `url` varchar(255) DEFAULT ' ',
  `active` varchar(10) DEFAULT 'true',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bibliography`
--

LOCK TABLES `bibliography` WRITE;
/*!40000 ALTER TABLE `bibliography` DISABLE KEYS */;
INSERT INTO `bibliography` VALUES (1,'Waffle','My Peabody','','',0,'',0,0,0,'',0,0,0,'','','true');
/*!40000 ALTER TABLE `bibliography` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-21 23:38:37
