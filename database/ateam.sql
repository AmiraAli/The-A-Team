-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ATeam
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Current Database: `ATeam`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ATeam` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ATeam`;

--
-- Table structure for table `Answers`
--

DROP TABLE IF EXISTS `Answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Answers` (
  `QuestionId` int(11) DEFAULT NULL,
  `body` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Answers`
--

LOCK TABLES `Answers` WRITE;
/*!40000 ALTER TABLE `Answers` DISABLE KEYS */;
INSERT INTO `Answers` VALUES (2,'u can see the toutorial for help ',2,4);
/*!40000 ALTER TABLE `Answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'Communication'),(5,'Mobile Application'),(2,'open sourse'),(4,'System Admin'),(3,'System Developer'),(6,'User Interface');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(100) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Course_Id` int(11) DEFAULT NULL,
  `Material_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Comments_1_idx` (`User_Id`),
  KEY `fk_Comments_1_idx1` (`Course_Id`),
  CONSTRAINT `fk_Comments_0` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comments_1` FOREIGN KEY (`Course_Id`) REFERENCES `Courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (23,'nice toutorial!!',1,26,55);
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CourseCategory`
--

DROP TABLE IF EXISTS `CourseCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CourseCategory` (
  `courseid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`courseid`,`categoryid`),
  KEY `Category_Id_idx` (`categoryid`),
  CONSTRAINT `Category_Id` FOREIGN KEY (`categoryid`) REFERENCES `Category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Course_Id` FOREIGN KEY (`courseid`) REFERENCES `Courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CourseCategory`
--

LOCK TABLES `CourseCategory` WRITE;
/*!40000 ALTER TABLE `CourseCategory` DISABLE KEYS */;
INSERT INTO `CourseCategory` VALUES (25,1),(37,1),(38,1),(26,2),(27,2),(33,2),(34,2),(30,3),(32,3),(28,4),(35,4),(36,4),(23,5),(24,5),(39,5),(29,6),(30,6);
/*!40000 ALTER TABLE `CourseCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CourseTag`
--

DROP TABLE IF EXISTS `CourseTag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CourseTag` (
  `courseid` int(11) NOT NULL,
  `tagid` int(11) NOT NULL,
  PRIMARY KEY (`courseid`,`tagid`),
  KEY `Tag_Id_idx` (`tagid`),
  CONSTRAINT `Course` FOREIGN KEY (`courseid`) REFERENCES `Courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Tag` FOREIGN KEY (`tagid`) REFERENCES `Tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CourseTag`
--

LOCK TABLES `CourseTag` WRITE;
/*!40000 ALTER TABLE `CourseTag` DISABLE KEYS */;
/*!40000 ALTER TABLE `CourseTag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Courses`
--

DROP TABLE IF EXISTS `Courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `desc` varchar(2048) DEFAULT NULL,
  `startdate` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `hidden` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Courses`
--

LOCK TABLES `Courses` WRITE;
/*!40000 ALTER TABLE `Courses` DISABLE KEYS */;
INSERT INTO `Courses` VALUES (23,'Web Application','This course explores the development of web application architectures from an engineering perspective.  ','0000-00-00 00:00:00',5,'0'),(24,'Mobile Services','Part of the Mobile Cloud Computing with Android Specialization ','0000-00-00 00:00:00',7,'0'),(25,'digital communication','This course is very important for communication engineers','0000-00-00 00:00:00',1,'0'),(26,'python','django framework ','0000-00-00 00:00:00',1,'0'),(27,'php','django frameworkzend framework ','0000-00-00 00:00:00',5,'0'),(28,'Networks','7 layers of TCP/IP','0000-00-00 00:00:00',1,'0'),(29,'photoshop','7 layers of TCP/amazing for designing','0000-00-00 00:00:00',5,'0'),(30,'c# sharp','system developer ','0000-00-00 00:00:00',5,'0'),(31,'c# sharp','system developer','0000-00-00 00:00:00',9,'0'),(32,'ASP.net','system developer','0000-00-00 00:00:00',6,'0'),(33,'JAVA','most popular web tools','0000-00-00 00:00:00',11,'0'),(34,'javascript','amazing and easy tool','0000-00-00 00:00:00',6,'0'),(35,'Admin 1','readhat 1','0000-00-00 00:00:00',1,'0'),(36,'Admin 2','readhat 2','0000-00-00 00:00:00',1,'0'),(37,'VLSI','electronics and hardware','0000-00-00 00:00:00',5,'0'),(38,'embeded system','electronics and hardware','0000-00-00 00:00:00',5,'0'),(39,'Android','mobile application','0000-00-00 00:00:00',5,'0');
/*!40000 ALTER TABLE `Courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Materials`
--

DROP TABLE IF EXISTS `Materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `downloadable` enum('0','1') DEFAULT NULL,
  `path` varchar(45) DEFAULT NULL,
  `no_downloads` int(11) DEFAULT NULL,
  `Type_Id` int(11) DEFAULT NULL,
  `Course_Id` int(11) DEFAULT NULL,
  `hidden` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Materials_2_idx` (`Course_Id`),
  KEY `fk_Materials_1_idx` (`Type_Id`),
  CONSTRAINT `fk_Materials_1` FOREIGN KEY (`Type_Id`) REFERENCES `Types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Materials_2` FOREIGN KEY (`Course_Id`) REFERENCES `Courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Materials`
--

LOCK TABLES `Materials` WRITE;
/*!40000 ALTER TABLE `Materials` DISABLE KEYS */;
INSERT INTO `Materials` VALUES (50,'lec1','1','videoviewdemo.mp4',0,1,26,'0'),(52,'lab1','1','videoviewdemo.mp4',0,2,26,'0'),(53,'ass1','1','Analysis.odp',0,3,26,'0'),(55,'lec2','1','WebServices.pdf',3,1,26,'0');
/*!40000 ALTER TABLE `Materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Questions`
--

DROP TABLE IF EXISTS `Questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Questions` (
  `UserId` int(11) DEFAULT NULL,
  `CourseId` int(11) DEFAULT NULL,
  `body` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Questions`
--

LOCK TABLES `Questions` WRITE;
/*!40000 ALTER TABLE `Questions` DISABLE KEYS */;
INSERT INTO `Questions` VALUES (1,16,'  cdncjbdjv efefr',1,'  heloo1'),(1,26,'how to install django frame work !! ??',2,'pythooon instalation');
/*!40000 ALTER TABLE `Questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Requests`
--

DROP TABLE IF EXISTS `Requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(45) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Requests_1_idx` (`User_Id`),
  CONSTRAINT `fk_Requests_1` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Requests`
--

LOCK TABLES `Requests` WRITE;
/*!40000 ALTER TABLE `Requests` DISABLE KEYS */;
INSERT INTO `Requests` VALUES (2,'helooo',2),(6,'when mysql course start please!!?',1),(8,'please i want course in rubby language',5);
/*!40000 ALTER TABLE `Requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tags`
--

DROP TABLE IF EXISTS `Tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tags`
--

LOCK TABLES `Tags` WRITE;
/*!40000 ALTER TABLE `Tags` DISABLE KEYS */;
INSERT INTO `Tags` VALUES (1,'A'),(2,'B'),(3,'C');
/*!40000 ALTER TABLE `Tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Types`
--

DROP TABLE IF EXISTS `Types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Types`
--

LOCK TABLES `Types` WRITE;
/*!40000 ALTER TABLE `Types` DISABLE KEYS */;
INSERT INTO `Types` VALUES (3,'Assignments'),(2,'Labs'),(1,'Lectures');
/*!40000 ALTER TABLE `Types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserCourse`
--

DROP TABLE IF EXISTS `UserCourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserCourse` (
  `User_Id` int(11) NOT NULL,
  `Course_Id` int(11) NOT NULL,
  PRIMARY KEY (`User_Id`,`Course_Id`),
  KEY `fk_UserCourse_1_idx` (`Course_Id`),
  CONSTRAINT `fk_UserCourse_1` FOREIGN KEY (`Course_Id`) REFERENCES `Courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UserCourse_2` FOREIGN KEY (`User_Id`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserCourse`
--

LOCK TABLES `UserCourse` WRITE;
/*!40000 ALTER TABLE `UserCourse` DISABLE KEYS */;
INSERT INTO `UserCourse` VALUES (1,23),(1,24),(1,25),(1,26),(4,26),(1,27),(1,28),(1,29),(1,30),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39);
/*!40000 ALTER TABLE `UserCourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `active` enum('0','1') DEFAULT NULL,
  `type` enum('Admin','Student','Instructor') DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `facebookid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `facebookid_UNIQUE` (`facebookid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'amira','amira@amira.com','e10adc3949ba59abbe56e057f20f883e','pic.jpg','1','Instructor','female','EG',NULL),(2,'aya','aya@aya.com','e10adc3949ba59abbe56e057f20f883e','pic2.jpg','0','Student','female','egypt',NULL),(3,'ahmed','ahmed@ahmed.com','e10adc3949ba59abbe56e057f20f883e','pic3.jpg','1','Admin','male','egypt',NULL),(4,'student1','student@student.com','e10adc3949ba59abbe56e057f20f883e','cola.jpg','1','Student','male','egypt',NULL),(5,'Amira Ali','Amira Ali@ateam.com','e81a9c398fd9ba8558f190e211dbb535','facebook.png','1','Student','female','en_US','10153168214659210');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-27  0:05:12
