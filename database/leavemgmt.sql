-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: leavemgmt
-- ------------------------------------------------------
-- Server version 	10.4.24-MariaDB
-- Date: Sun, 09 Jul 2023 13:17:24 +0200

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departmentmaster`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departmentmaster` (
  `DeptID` int(5) NOT NULL AUTO_INCREMENT,
  `DeptName` varchar(20) NOT NULL,
  `Flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`DeptID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departmentmaster`
--

LOCK TABLES `departmentmaster` WRITE;
/*!40000 ALTER TABLE `departmentmaster` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `departmentmaster` VALUES (1,'COMPUTER DEPARTMENT',0),(2,'MECHENICAL DEPARTMEN',0),(3,'Ci',1),(4,'CIVIL DEPARTMENT',0),(5,'ELECTRICAL DEPARTMEN',0),(6,'CDDM DEPARTMENT',0),(7,'gfggg',1),(8,'gfggg',1),(9,'ESTA DEPARTMENT',0);
/*!40000 ALTER TABLE `departmentmaster` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `departmentmaster` with 9 row(s)
--

--
-- Table structure for table `facultyinfo`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultyinfo` (
  `FacultyInfoID` int(5) NOT NULL AUTO_INCREMENT,
  `FacultyName` varchar(20) NOT NULL,
  `ContactNo` varchar(10) NOT NULL,
  `JoiningDate` date NOT NULL,
  `RelievingDate` date NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `DeptID` int(5) NOT NULL,
  PRIMARY KEY (`FacultyInfoID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultyinfo`
--

LOCK TABLES `facultyinfo` WRITE;
/*!40000 ALTER TABLE `facultyinfo` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `facultyinfo` VALUES (18,'ARpit','6454567565','2023-03-23','2023-04-26','PPUD Lecturer',1),(13,'PSP','8866530357','2023-04-10','2023-04-23','MC Lecturer',1),(14,'VBB','5474467475','2023-03-29','2023-04-11','PPUD Lecturer',1);
/*!40000 ALTER TABLE `facultyinfo` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `facultyinfo` with 3 row(s)
--

--
-- Table structure for table `facultyleaveallocation`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultyleaveallocation` (
  `FacultyLeaveAllocationID` int(5) NOT NULL AUTO_INCREMENT,
  `FacultyInfoID` int(5) NOT NULL,
  `TypeOfLeaveID` int(5) NOT NULL,
  `Date` date NOT NULL,
  `DeptID` int(5) NOT NULL,
  PRIMARY KEY (`FacultyLeaveAllocationID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultyleaveallocation`
--

LOCK TABLES `facultyleaveallocation` WRITE;
/*!40000 ALTER TABLE `facultyleaveallocation` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `facultyleaveallocation` VALUES (2,13,2,'2023-04-23',1),(3,13,1,'2023-05-23',1),(4,14,6,'2023-04-23',1),(5,13,1,'2023-04-24',1),(9,18,1,'2023-05-07',1),(10,18,3,'2023-05-07',1),(11,18,2,'2023-05-07',1),(12,18,2,'2023-05-06',1),(13,18,2,'2023-05-08',1),(14,18,2,'2023-05-08',1),(15,18,2,'2023-05-08',1),(16,14,1,'2023-06-22',1);
/*!40000 ALTER TABLE `facultyleaveallocation` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `facultyleaveallocation` with 12 row(s)
--

--
-- Table structure for table `facultyleavemaster`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultyleavemaster` (
  `FacultyLeaveMasterID` int(5) NOT NULL AUTO_INCREMENT,
  `FacultyInfoID` int(5) NOT NULL,
  `TypeOfLeaveID` int(5) NOT NULL,
  `LeaveCount` int(5) NOT NULL,
  `YearID` int(5) NOT NULL,
  `DeptID` int(5) NOT NULL,
  PRIMARY KEY (`FacultyLeaveMasterID`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultyleavemaster`
--

LOCK TABLES `facultyleavemaster` WRITE;
/*!40000 ALTER TABLE `facultyleavemaster` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `facultyleavemaster` VALUES (42,13,1,5,2,1),(37,13,2,12,2,1),(39,13,1,12,2,1),(41,13,10,11,2,1),(40,18,9,1,2,1),(43,18,2,12,2,1),(44,18,5,5,2,1),(45,18,5,5,2,1),(46,18,5,5,2,1);
/*!40000 ALTER TABLE `facultyleavemaster` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `facultyleavemaster` with 9 row(s)
--

--
-- Table structure for table `typeofleave`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeofleave` (
  `TypeOfLeaveID` int(5) NOT NULL AUTO_INCREMENT,
  `LeaveType` varchar(10) NOT NULL,
  `Flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`TypeOfLeaveID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeofleave`
--

LOCK TABLES `typeofleave` WRITE;
/*!40000 ALTER TABLE `typeofleave` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `typeofleave` VALUES (1,'HCL',0),(2,'CL',0),(3,'RH',0),(4,'HPL',0),(6,'ML',0),(5,'SPL',0),(8,'EL',0),(7,'LWP',0),(9,'Vacation',0),(10,'OD',0);
/*!40000 ALTER TABLE `typeofleave` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `typeofleave` with 10 row(s)
--

--
-- Table structure for table `usermaster`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usermaster` (
  `UserMasterID` int(5) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserType` varchar(15) NOT NULL,
  `DeptID` int(5) NOT NULL,
  PRIMARY KEY (`UserMasterID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usermaster`
--

LOCK TABLES `usermaster` WRITE;
/*!40000 ALTER TABLE `usermaster` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usermaster` VALUES (10,'Admin','111111','Admin',444),(15,'yash','12345','Admin',444),(11,'esta','33333','ESTA',555),(16,'Arpit1','123','Department User',9),(17,'PSP','123321','Department User',1);
/*!40000 ALTER TABLE `usermaster` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usermaster` with 5 row(s)
--

--
-- Table structure for table `yearmaster`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yearmaster` (
  `YearID` int(5) NOT NULL AUTO_INCREMENT,
  `Year` int(4) NOT NULL,
  `Flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`YearID`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yearmaster`
--

LOCK TABLES `yearmaster` WRITE;
/*!40000 ALTER TABLE `yearmaster` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `yearmaster` VALUES (2,2023,0),(20,2022,1),(21,2024,0);
/*!40000 ALTER TABLE `yearmaster` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `yearmaster` with 3 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sun, 09 Jul 2023 13:17:25 +0200
