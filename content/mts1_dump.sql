CREATE DATABASE  IF NOT EXISTS `mts1` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mts1`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: mts1
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `grn_details`
--

DROP TABLE IF EXISTS `grn_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn_details` (
  `grn_details_id` int(20) NOT NULL,
  `ASN NO` int(11) NOT NULL,
  `PLANT CODE` int(11) DEFAULT NULL,
  `VENDOR CODE` int(11) DEFAULT NULL,
  `VENDOR NAME` varchar(100) DEFAULT NULL,
  `SHORT NAME` varchar(45) DEFAULT NULL,
  `PO NUMBER` int(11) DEFAULT NULL,
  `PO ITEM` varchar(45) DEFAULT NULL,
  `INVOICE NO` varchar(70) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `LOT NO` varchar(45) DEFAULT NULL,
  `PART NUMBER` varchar(45) DEFAULT NULL,
  `TOTAL QTY` int(11) DEFAULT NULL,
  `TOTAL BOX COUNT` int(11) DEFAULT NULL,
  `RECEIVED QTY` int(11) DEFAULT NULL,
  `RECEIVED BOX COUNT` int(11) DEFAULT NULL,
  `RECEIVED DATE` datetime DEFAULT NULL,
  `GRN NO` varchar(150) DEFAULT NULL,
  `SECURITY NAME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`grn_details_id`),
  UNIQUE KEY `grn_data_id_UNIQUE` (`grn_details_id`),
  UNIQUE KEY `ASN NO_UNIQUE` (`ASN NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn_details`
--

LOCK TABLES `grn_details` WRITE;
/*!40000 ALTER TABLE `grn_details` DISABLE KEYS */;
INSERT INTO `grn_details` VALUES (1,1521623715,1020,100254,'OM SAKTHI INDUSTRIES','OM SAKTHI',125646887,'25487','GST/17-18/01400','2017-07-20 01:10:00','null','100341442',500,5,400,4,'2017-07-21 01:10:00','6549873210','siva'),(2,1521623716,1020,100254,'OM SAKTHI INDUSTRIES','OM SAKTHI',146536456,'232154','GST/17-18/01405','2017-07-20 01:10:00','null','100341444',300,3,300,3,'2017-07-21 01:10:00','3216549870','muthu'),(3,1521623717,1020,100200,'BALU AUTO PRODUCTS','BALU AUTO',136446897,'25498','GST/17-18/25478','2017-07-21 18:24:00','null','100341442',1000,10,1000,10,'2017-07-22 01:10:00','0321654789','siva'),(4,1521623718,1020,100200,'BALU AUTO PRODUCTS','BALU AUTO',156524876,'23214','GST/17-18/98765','2017-07-21 18:24:00','null','100341448',480,5,600,3,'2017-07-22 01:10:00','8520147963','muthu');
/*!40000 ALTER TABLE `grn_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_subdetails`
--

DROP TABLE IF EXISTS `grn_subdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn_subdetails` (
  `grn_subdetails_id` int(20) NOT NULL AUTO_INCREMENT,
  `BOX NO` int(11) DEFAULT NULL,
  `QTY PER BOX` int(11) DEFAULT NULL,
  `WEIGHT` varchar(45) DEFAULT NULL,
  `grn_details_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`grn_subdetails_id`),
  KEY `fk_temp_grn_id_idx` (`grn_details_id`),
  CONSTRAINT `fk_grn_id` FOREIGN KEY (`grn_details_id`) REFERENCES `grn_details` (`grn_details_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn_subdetails`
--

LOCK TABLES `grn_subdetails` WRITE;
/*!40000 ALTER TABLE `grn_subdetails` DISABLE KEYS */;
INSERT INTO `grn_subdetails` VALUES (1,1,100,'NULL',1),(2,2,100,'NULL',1),(3,4,100,'NULL',1),(4,5,100,'NULL',1),(5,1,100,'0.12',2),(6,2,100,'0.12',2),(7,3,100,'0.1235',2),(8,1,200,'NULL',3),(9,2,200,'NULL',3),(10,3,100,'NULL',3),(11,4,100,'NULL',3),(12,5,100,'NULL',3),(13,6,100,'NULL',3),(14,7,50,'NULL',3),(15,8,50,'NULL',3),(16,9,50,'NULL',3),(17,10,50,'NULL',3),(18,1,160,'0.654',4),(19,4,160,'0.654',4),(20,5,160,'0.654',4);
/*!40000 ALTER TABLE `grn_subdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_grn_details`
--

DROP TABLE IF EXISTS `temp_grn_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_grn_details` (
  `temp_grn_details_id` int(20) NOT NULL,
  `ASN NO` int(11) NOT NULL,
  `PLANT CODE` int(11) DEFAULT NULL,
  `VENDOR CODE` int(11) DEFAULT NULL,
  `VENDOR NAME` varchar(100) DEFAULT NULL,
  `SHORT NAME` varchar(45) DEFAULT NULL,
  `PO NUMBER` int(11) DEFAULT NULL,
  `PO ITEM` varchar(45) DEFAULT NULL,
  `INVOICE NO` varchar(70) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `LOT NO` varchar(45) DEFAULT NULL,
  `PART NUMBER` varchar(45) DEFAULT NULL,
  `TOTAL QTY` int(11) DEFAULT NULL,
  `TOTAL BOX COUNT` int(11) DEFAULT NULL,
  `RECEIVED QTY` int(11) DEFAULT NULL,
  `RECEIVED BOX COUNT` int(11) DEFAULT NULL,
  `RECEIVED DATE` datetime DEFAULT NULL,
  `GRN NO` varchar(150) DEFAULT NULL,
  `SECURITY NAME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`temp_grn_details_id`),
  UNIQUE KEY `grn_data_id_UNIQUE` (`temp_grn_details_id`),
  UNIQUE KEY `ASN NO_UNIQUE` (`ASN NO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_grn_details`
--

LOCK TABLES `temp_grn_details` WRITE;
/*!40000 ALTER TABLE `temp_grn_details` DISABLE KEYS */;
INSERT INTO `temp_grn_details` VALUES (1,1521623715,1020,100254,'OM SAKTHI INDUSTRIES','OM SAKTHI',125646887,'25487','GST/17-18/01400','2017-07-20 01:10:00','null','100341442',500,5,400,4,'2017-07-21 01:10:00','','siva'),(2,1521623716,1020,100254,'OM SAKTHI INDUSTRIES','OM SAKTHI',146536456,'232154','GST/17-18/01405','2017-07-20 01:10:00','null','100341444',300,3,300,3,'2017-07-21 01:10:00',' ','muthu'),(3,1521623717,1020,100200,'BALU AUTO PRODUCTS','BALU AUTO',136446897,'25498','GST/17-18/25478','2017-07-21 18:24:00','null','100341442',1000,10,1000,10,'2017-07-22 01:10:00','','siva'),(4,1521623718,1020,100200,'BALU AUTO PRODUCTS','BALU AUTO',156524876,'23214','GST/17-18/98765','2017-07-21 18:24:00','null','100341448',480,5,600,3,'2017-07-22 01:10:00',' ','muthu');
/*!40000 ALTER TABLE `temp_grn_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_grn_subdetails`
--

DROP TABLE IF EXISTS `temp_grn_subdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_grn_subdetails` (
  `grn_subdetails_id` int(20) NOT NULL AUTO_INCREMENT,
  `BOX NO` int(11) DEFAULT NULL,
  `QTY PER BOX` int(11) DEFAULT NULL,
  `WEIGHT` varchar(45) DEFAULT NULL,
  `grn_details_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`grn_subdetails_id`),
  KEY `fk_temp_grn_id_idx` (`grn_details_id`),
  CONSTRAINT `fk_temp_grn_id` FOREIGN KEY (`grn_details_id`) REFERENCES `temp_grn_details` (`temp_grn_details_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_grn_subdetails`
--

LOCK TABLES `temp_grn_subdetails` WRITE;
/*!40000 ALTER TABLE `temp_grn_subdetails` DISABLE KEYS */;
INSERT INTO `temp_grn_subdetails` VALUES (1,1,100,'NULL',1),(2,2,100,'NULL',1),(3,4,100,'NULL',1),(4,5,100,'NULL',1),(5,1,100,'0.12',2),(6,2,100,'0.12',2),(7,3,100,'0.1235',2),(8,1,200,'NULL',3),(9,2,200,'NULL',3),(10,3,100,'NULL',3),(11,4,100,'NULL',3),(12,5,100,'NULL',3),(13,6,100,'NULL',3),(14,7,50,'NULL',3),(15,8,50,'NULL',3),(16,9,50,'NULL',3),(17,10,50,'NULL',3),(18,1,160,'0.654',4),(19,4,160,'0.654',4),(20,5,160,'0.654',4);
/*!40000 ALTER TABLE `temp_grn_subdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mts1'
--

--
-- Dumping routines for database 'mts1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-10 15:59:26
