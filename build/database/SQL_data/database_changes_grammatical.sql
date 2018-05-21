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
-- Table structure for table `changes_grammatical`
--

DROP TABLE IF EXISTS `changes_grammatical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `changes_grammatical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL,
  `changeTitle` varchar(300) DEFAULT ' ',
  `changeType` varchar(180) DEFAULT ' ',
  `domain` varchar(120) DEFAULT ' ',
  `whenChanged` varchar(100) DEFAULT ' ',
  `certainty` varchar(45) DEFAULT ' ',
  `evidenceType` varchar(180) DEFAULT ' ',
  `changeNotes` text,
  `active` varchar(10) DEFAULT 'true',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `change_gram_fk` (`lang_id`),
  CONSTRAINT `change_gram_fk` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changes_grammatical`
--

LOCK TABLES `changes_grammatical` WRITE;
/*!40000 ALTER TABLE `changes_grammatical` DISABLE KEYS */;
INSERT INTO `changes_grammatical` VALUES (1,6964,'added stuff','','',NULL,'','','','true');
/*!40000 ALTER TABLE `changes_grammatical` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-21 23:38:31
