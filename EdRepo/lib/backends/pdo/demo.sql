-- MySQL dump 10.13  Distrib 5.5.29, for Linux (i686)
--
-- Host: localhost    Database: edrepo
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`CategoryID`, `Name`, `Description`) VALUES (2,'Testing','Used for testing EdRepo.'),(3,'Programming',''),(4,'Teaching','Lessons, etc');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `composition`
--

LOCK TABLES `composition` WRITE;
/*!40000 ALTER TABLE `composition` DISABLE KEYS */;
/*!40000 ALTER TABLE `composition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `currentlogins`
--

LOCK TABLES `currentlogins` WRITE;
/*!40000 ALTER TABLE `currentlogins` DISABLE KEYS */;
/*!40000 ALTER TABLE `currentlogins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `hierarchymodule`
--

LOCK TABLES `hierarchymodule` WRITE;
/*!40000 ALTER TABLE `hierarchymodule` DISABLE KEYS */;
INSERT INTO `hierarchymodule` (`ModuleID`, `OrderID`) VALUES (15,0),(17,2),(18,3),(34,1);
/*!40000 ALTER TABLE `hierarchymodule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `materialcomments`
--

LOCK TABLES `materialcomments` WRITE;
/*!40000 ALTER TABLE `materialcomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `materialcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` (`MaterialID`, `Name`, `Type`, `Content`, `ReadableFileName`, `DateTime`, `Format`, `Rating`, `NumberOfRatings`, `AccessFlag`) VALUES (6,'EdRepo\'s SourceForge Page','ExternalURL','https://sourceforge.net/projects/edrepo/','','2011-08-08 13:07:05','',0,0000000000,-1),(7,'Java Download','ExternalURL','http://www.java.com','','2012-03-08 18:35:12','',0,0000000000,-1),(8,'Eclipse Download','ExternalURL','http://www.eclipse.org','','2012-03-08 18:35:49','',0,0000000000,-1),(9,'Background on Java','ExternalURL','http://www.youtube.com/watch?v=b-Cr0EWwaTk','','2012-03-08 20:00:58','',0,0000000000,-1),(10,'What is Java?','ExternalURL','http://www.youtube.com/watch?v=GNTphyx-Q7o','','2012-03-08 20:05:31','',0,0000000000,-1),(11,'Introduction to Java','LocalFile','26/java01.ppt','java01.ppt','2012-03-08 20:08:21','application/vnd.ms-powerpoint',0,0000000000,-1),(12,'Lesson 3 Text','LocalFile','27/Java Lesson 3 test.docx','Java Lesson 3 test.docx','2012-03-13 21:41:05','application/vnd.openxmlformats-officedocument.word',0,0000000000,-1),(13,'Java Tutorial PDF','LocalFile','28/javatut.pdf','javatut.pdf','2012-03-13 21:44:41','application/pdf',0,0000000000,-1),(14,'Be a pro at Java!','ExternalURL','http://lmgtfy.com/?q=how+to+be+a+pro+at+java','','2012-03-13 21:53:08','',0,0000000000,-1),(15,'Homestretch motivation!','ExternalURL','http://puppydogweb.com/gallery/puppies/labradorretriever2.jpg','','2012-03-13 22:18:08','',0,0000000000,-1),(16,'Course Website','ExternalURL','http://www.cs.uwp.edu/staff/lincke/infosec/','','2012-11-09 21:24:12','',0,0000000000,-1),(18,'Syllabus','LocalFile','34/syllabus11.doc','syllabus11.doc','2012-11-09 21:33:37','application/msword',0,0000000000,-1),(19,'Fraud Lecture','LocalFile','35/Fraud.ppt','Fraud.ppt','2012-11-09 22:09:57','application/octet-stream',0,0000000000,-1),(20,'HIPAA Lecture','LocalFile','36/HIPAA.ppt','HIPAA.ppt','2012-11-09 22:16:43','application/octet-stream',0,0000000000,-1),(21,'Risk Lecture','LocalFile','38/Risk.ppt','Risk.ppt','2012-11-09 22:30:54','application/octet-stream',0,0000000000,-1),(22,'BC&DR Lecture','LocalFile','39/BusinessContinuity&DisasterRecovery.ppt','BusinessContinuity&DisasterRecovery.ppt','2012-11-09 22:43:18','application/octet-stream',0,0000000000,-1),(23,'Data Security Lecture','LocalFile','40/DataSecurity.ppt','DataSecurity.ppt','2012-11-09 22:48:51','application/octet-stream',0,0000000000,-1),(24,'Network Security Lecture','LocalFile','41/NetworkSecurity.ppt','NetworkSecurity.ppt','2012-11-09 22:52:16','application/octet-stream',0,0000000000,-1),(25,'Physical and Personnel Lecture','LocalFile','42/Physical&PersonnelSecurity.ppt','Physical&PersonnelSecurity.ppt','2012-11-12 18:25:55','application/vnd.ms-powerpoint',0,0000000000,-1),(26,'Security Program Development Lecture','LocalFile','43/SecurityProgramDevelopment.ppt','SecurityProgramDevelopment.ppt','2012-11-12 18:30:45','application/vnd.ms-powerpoint',0,0000000000,-1),(27,'IT Governance Lecture','LocalFile','44/ITGovernance.ppt','ITGovernance.ppt','2012-11-12 18:42:20','application/vnd.ms-powerpoint',0,0000000000,-1),(28,'IS Audit Lecture','LocalFile','45/ISAudit.ppt','ISAudit.ppt','2012-11-12 18:48:52','application/vnd.ms-powerpoint',0,0000000000,-1),(29,'Appplications Lecture','LocalFile','46/ApplicationControls&Audit.ppt','ApplicationControls&Audit.ppt','2012-11-12 23:07:29','application/vnd.ms-powerpoint',0,0000000000,-1),(30,'Secure Software Lecture','LocalFile','47/SecureSoftware.ppt','SecureSoftware.ppt','2012-11-12 23:19:49','application/vnd.ms-powerpoint',0,0000000000,-1),(31,'UML Lecture','LocalFile','48/SecureSoftwareDesignWithUML.ppt','SecureSoftwareDesignWithUML.ppt','2012-11-12 23:27:52','application/vnd.ms-powerpoint',0,0000000000,-1),(32,'Incident Response Lecture','LocalFile','49/IncidentResponse.ppt','IncidentResponse.ppt','2012-11-12 23:35:54','application/vnd.ms-powerpoint',0,0000000000,-1),(33,'Health First Design','LocalFile','50/HealthFirstDesign.doc','HealthFirstDesign.doc','2012-11-12 23:54:23','application/msword',0,0000000000,-1),(34,'Health First Requirements','LocalFile','50/HealthFirstRequirements.doc','HealthFirstRequirements.doc','2012-11-12 23:54:51','application/msword',0,0000000000,-1),(35,'Health First Case Study','LocalFile','50/MedCaseStudy.doc','MedCaseStudy.doc','2012-11-12 23:55:20','application/msword',0,0000000000,-1),(36,'Security WorkBook','LocalFile','50/SecurityWorkBook.doc','SecurityWorkBook.doc','2012-11-12 23:55:45','application/msword',0,0000000000,-1),(38,'User Security Awareness','LocalFile','37/UserSecurityAwareness.ppt','UserSecurityAwareness.ppt','2012-11-14 21:25:44','application/vnd.ms-powerpoint',0,0000000000,-1);
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` (`ModuleID`, `DateTime`, `Description`, `Language`, `EducationLevel`, `Minutes`, `AuthorComments`, `Status`, `MinimumUserType`, `InteractivityType`, `Rights`, `BaseID`, `Version`, `SubmitterUserID`, `CheckInComments`, `Restrictions`) VALUES (15,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',15, 1, 1,'', 'None'), (16,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',16, 1, 2,'', 'None'),(17,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',17, 1, 3,'', 'Dean'), (18,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',18, 1, 4,'', 'Admin'), (19,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',19, 1, 5,'', 'None'), (20,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',20,1 ,1,'', 'President'), (21,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',21, 1, 2,'', 'Teacher'), (22,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',22, 1, 2,'', 'Professor'),(26,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','InProgress','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',26, 1, 3,'','Student'), (27,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',27,1, 4,'', 'Student'), (28,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',28, 1, 4,'', 'Student'), (29,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',29, 1, 4,'', 'Student'), (30,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Locked','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',30,1, 5,'', 'Student'), (31,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Locked','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',31, 1, 5,'', 'Student'), (34,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','InProgress','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',34, 1, 1,'', 'Student'), (35,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','InProgress','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',35, 1 ,1,'', 'Student'), (36,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',36,1, 1,'', 'Student'), (37,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',37, 1, 1,'', 'Student'), (38,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',38, 1, 1,'', 'Student'), (39,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','PendingModeration','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',39, 1, 1,'', 'Student'), (40,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Locked','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',40, 1, 1,'', 'Student'), (41,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Locked','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',41, 1, 1,'', 'Student'), (42,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Locked','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',42, 1, 1,'', 'Student'), (43,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',43, 1, 1,'', 'Student'), (44,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',44, 1, 1,'', 'Student'), (45,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',45, 1, 1,'', 'Student'), (46,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',46, 1, 1,'', 'Student'), (47,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',47, 1, 1,'', 'Student'), (48,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',48,1, 1,'', 'Student'), (49,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',49, 1, 1,'', 'Student'), (50,'2012-11-10 23:19:58','Demonstrate how modules are used.','eng','Higher Education',0,'','Active','Unregistered','Undefined','This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.',50, 1, 1,'', 'Student');					
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moduleauthors`
--

LOCK TABLES `moduleauthors` WRITE;
/*!40000 ALTER TABLE `moduleauthors` DISABLE KEYS */;
INSERT INTO `moduleauthors` (`ModuleID`, `AuthorName`) VALUES (16,'Demo Submitter'),(30,'William'),(17,'William'),(18,'William'),(21,'William'),(27,'William'),(29,'William'),(20,'William'),(31,'Demo Editor'),(31,'john smith'),(26,'William'),(19,'William'),(34,'Susan Lincke, Phd.'),(35,'Susan Lincke, PhD '),(36,'Susan Lincke, PhD '),(37,'Susan Lincke, PhD '),(39,'Susan Lincke, PhD '),(41,'Susan Lincke, PhD '),(15,'Author One'),(15,'Author Two'),(42,'Demo Submitter'),(43,'Susan Lincke, PhD '),(40,'Susan Lincke, PhD '),(38,'Susan Lincke, PhD '),(44,'Susan Lincke, PhD '),(45,'Susan Lincke, PhD'),(46,'Susan Lincke, PhD '),(47,'Susan Lincke, PhD '),(48,'Susan Lincke, PhD '),(49,'Susan Lincke, PhD '),(50,'Susan Lincke, PhD ');
/*!40000 ALTER TABLE `moduleauthors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulebases`
--

LOCK TABLES `modulebases` WRITE; 
/*!40000 ALTER TABLE `modulebases` DISABLE KEYS */;
INSERT INTO `modulebases` (`BaseID`, `Title`, `ModuleIdentifier`) VALUES (15, 'Demo Module', ''), (16, 'A Pending Module', ''), (17, 'Exemplary Java', ''), (18, 'Java Week 1', ''), (19, 'Java Week 2', ''), (20, 'Java Week 3', ''), (21, 'Java Lesson 1', ''), (22, 'Java Lab 1', ''), (26, 'Java Lesson 2', ''), (27, 'Java Lesson 3', ''), (28, 'Java Lesson 4', ''), (29, 'Java Lesson 5', ''), (30, 'Java Lesson 6', ''), (31, 'test module GH', ''),(34, 'CS 490/790', ''),(35, 'Fraud', ''),(36, 'HIPAA', ''),(37, 'User Security Awareness', ''),(38, 'Risk Management', ''),(39, 'Business Continuity and Disaster Recovery', ''),(40, 'Data Security', ''),(41, 'Network Security', ''),(42, 'Physical and Personnel Security', ''),(43, 'Security Program Development', ''),(44, 'IT Governance', ''),(45, 'IS Audit', ''),(46, 'Application Controls and Audit', ''),(47, 'Secure Software', ''),(48, 'Secure Software Design with UML', ''), (49, 'Incident Response', ''), (50, 'Project and Presentation Info', '');
/*!40000 ALTER TABLE `modulebases` ENABLE KEYS */;
--
-- Dumping data for table `modulecategories`
--

LOCK TABLES `modulecategories` WRITE;
/*!40000 ALTER TABLE `modulecategories` DISABLE KEYS */;
INSERT INTO `modulecategories` (`ModuleID`, `CategoryID`) VALUES (31,2),(34,4),(35,4),(36,4),(37,4),(39,4),(41,4),(42,4),(43,4),(40,4),(38,4),(44,4),(45,4),(46,4),(47,4),(48,4),(49,4);
/*!40000 ALTER TABLE `modulecategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulelog`
--

LOCK TABLES `modulelog` WRITE;
/*!40000 ALTER TABLE `modulelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulematerialslink`
--

LOCK TABLES `modulematerialslink` WRITE;
/*!40000 ALTER TABLE `modulematerialslink` DISABLE KEYS */;
INSERT INTO `modulematerialslink` (`ModuleID`, `MaterialID`, `OrderID`) VALUES (15,6,0),(17,7,0),(17,8,0),(20,15,0),(21,9,0),(21,10,0),(26,11,0),(27,12,0),(28,13,0),(29,14,0),(34,16,0),(34,18,0),(35,19,0),(36,20,0),(37,38,0),(38,21,0),(39,22,0),(40,23,0),(41,24,0),(42,25,0),(43,26,0),(44,27,0),(45,28,0),(46,29,0),(47,30,0),(48,31,0),(49,32,0),(50,33,0),(50,34,0),(50,35,0),(50,36,0);
/*!40000 ALTER TABLE `modulematerialslink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moduleratings`
--

LOCK TABLES `moduleratings` WRITE;
/*!40000 ALTER TABLE `moduleratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `moduleratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `moduletype`
--

LOCK TABLES `moduletype` WRITE;
/*!40000 ALTER TABLE `moduletype` DISABLE KEYS */;
INSERT INTO `moduletype` (`ModuleID`, `TypeID`) VALUES (17,12),(18,31),(19,31),(20,31),(21,22),(22,15),(26,22),(27,22),(28,22),(29,22),(30,22),(31,5),(34,12),(35,8),(35,21),(35,31),(36,8),(36,21),(36,31),(37,8),(37,21),(37,31),(38,21),(38,31),(39,21),(39,31),(40,8),(40,21),(40,31),(41,8),(41,21),(41,31),(42,8),(42,21),(42,31),(43,8),(43,21),(43,31),(44,8),(44,21),(44,31),(45,8),(45,21),(45,31),(46,8),(46,21),(46,31),(47,8),(47,21),(47,31),(48,8),(48,21),(48,31),(49,8),(49,21),(49,31),(50,3),(50,32);
/*!40000 ALTER TABLE `moduletype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `objectives`
--

LOCK TABLES `objectives` WRITE;
/*!40000 ALTER TABLE `objectives` DISABLE KEYS */;
INSERT INTO `objectives` (`ModuleID`, `ObjectiveText`, `OrderID`) VALUES (17,'Have a basic understanding of the Java programming language.',0),(31,'To learn something',0),(34,'This Information Systems Security course involves students working with authentic projects, including small for-profit or not-for-profit organizations. Students working with a small organization get to see a broad picture of how security can be implemented for a constrained problem.',0),(35,'Learn how to minimize amount of revenue lost to fraud',0),(37,'Understand the importance of information security and how to maintain that security',0),(38,'Define: Risk Management Process, treat risk terms, threat types, agent types, risk analysis strategies, vulnerability',0),(39,'Learn how to minimize damage so the company can move on after a disaster',0),(40,'Define: information security principles, information management positions, access control techniques, authentication combination, Biometric, elements of BLP, military security policy, backup rotation',0),(41,'Define: attacks, defenses, techniques, security goals',0),(42,'Define: power failures, protections against power failures, mediums for Fire Suppression Systems, physical access controls, security awareness, security training, security education, segregation of duties',0),(43,'Define: security baseline, gap analysis, metrics, compliance, policy, standard, guideline, procedure',0),(44,'Define: quality assurance, quality control, policy, compliance, IT Balances, Scorecard, measure, ISO 9001, enterprise architecture, sourcing practices, policy documents',0),(45,'Define: audit risk, control types, audit types',0),(46,'Define: batch control, validation, batch balance, reconciliation, standing data, exception report, audit trail, system control parameters, checks, testing application techniques, online audit techniques',0),(47,'Define: jail, sandbox environment, whitelist, blacklist, nonse',0),(49,'Define: incident response plan, business continuity plan, recovery terms, computer forensics',0),(41,'Describe: techniques, security goals, service\'s data, server\'s data',1),(42,'Describe: mediums for Fire Suppression Systems, the relationship between Dead Man Door and Piggybacking, security awareness, security training, security education, segregation of duties',1),(43,'Describe: COBIT, CMM, Levels 1-5',1),(44,'Describe: IT governance committees, mission, strategic plan, tactical plan, operational plan, security organization members, ',1),(45,'Describe: substantive test, compliance test, sampling types, CAAT, GAS, Control Self-Assessment, Continuous Audit',1),(46,'Describe: batch control, validation, batch balance, reconciliation, standing data, exception report, audit trail, system control parameters',1),(49,'Describe: incident response plan, business continuity plan, incident management team, incident response team, proactive detection, triage, computer forensics',1),(41,'Define services that can enter and leave a network',2),(41,'Draw network diagram',3);
/*!40000 ALTER TABLE `objectives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `otherresources`
--

LOCK TABLES `otherresources` WRITE;
/*!40000 ALTER TABLE `otherresources` DISABLE KEYS */;
/*!40000 ALTER TABLE `otherresources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `parentchild`
--

LOCK TABLES `parentchild` WRITE;
/*!40000 ALTER TABLE `parentchild` DISABLE KEYS */;
INSERT INTO `parentchild` (`PairingID`, `ParentID`, `ChildID`, `Leaf`) VALUES (1,17,18,'\0'),(2,17,19,'\0'),(3,17,20,'\0'),(4,18,21,'\0'),(5,18,26,'\0'),(6,18,27,'\0'),(7,19,28,'\0'),(8,19,29,'\0'),(9,20,30,'\0'),(10,37,41,'\0'),(11,34,35,'\0'),(12,34,36,'\0'),(13,34,37,'\0'),(14,34,38,'\0'),(15,34,39,'\0'),(16,34,40,'\0'),(17,34,42,'\0'),(18,34,44,'\0'),(20,34,46,'\0'),(21,34,47,'\0'),(22,34,48,'\0'),(23,34,49,'\0'),(24,34,50,'\0'),(26,34,43,'\0'),(27,34,45,'\0');
/*!40000 ALTER TABLE `parentchild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `prereqs`
--

LOCK TABLES `prereqs` WRITE;
/*!40000 ALTER TABLE `prereqs` DISABLE KEYS */;
INSERT INTO `prereqs` (`ModuleID`, `PrerequisiteText`, `OrderID`) VALUES (17,'You will need the latest version of Java downloaded to your computer and an editor such as Eclipse (links provided).',0),(31,'High School sophomore',0),(34,'CS 242 Computer Science II\r\nOR\r\nMIS 328 DBMS\r\nOR\r\ninstructor permission',0);
/*!40000 ALTER TABLE `prereqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `recovery`
--

LOCK TABLES `recovery` WRITE;
/*!40000 ALTER TABLE `recovery` DISABLE KEYS */;
/*!40000 ALTER TABLE `recovery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `seealso`
--

LOCK TABLES `seealso` WRITE;
/*!40000 ALTER TABLE `seealso` DISABLE KEYS */;
/*!40000 ALTER TABLE `seealso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`ModuleID`, `TopicText`, `OrderID`) VALUES (15,'Demonstration',0),(15,'EdRepo',1),(15,'Modules',2),(16,'Demonstration',0),(31,'free form topics',0),(34,'Computer Science',0),(34,'Information Systems Security',1),(35,'The Environment of Fraud',0),(35,'Preventing Internal Fraud',1),(35,'External Fraud',2),(36,'Privacy Rule',0),(36,'Security Rule',1),(37,'User Awareness',0),(37,'Safe and Secure User Practice',1),(37,'Information Security',2),(38,'Risk Management',0),(38,'Threats',1),(38,'Threat Agents',2),(38,'Risk Analysis Strategies',3),(39,'Business Impact Analysis',0),(39,'RPO/RTO',1),(39,'Disaster Recovery',2),(39,'Testing, Backups, Audit',3),(40,'Principles of Data Security',0),(40,'Data Inventory',1),(40,'Authentication',2),(40,'Audit Trail',3),(40,'Audit Functions',4),(41,'Attacks',0),(41,'Technical Solutions',1),(42,'Physical Security',0),(42,'Personnel Security',1),(43,'Security Framework and Architecture',0),(43,'Achieving higher Maturity Levels',1),(44,'IT Governance',0),(44,'Information Security',1),(44,'Governance',2),(45,'Procedures of IS Audit',0),(45,'Advances in IS Audit',1),(46,'Batch Processing',0),(46,'Application Audit',1),(47,'Professional Recommendations',0),(47,'Input Validation',1),(47,'Server-Side Authentication',2),(47,'Input Sanitization',3),(47,'OS Command Injection',4),(47,'Critical State Data',5),(47,'Cross-Site Scripting',6),(47,'Forgery',7),(47,'Access Permissions',8),(47,'',9),(48,'Secure UML Requirements',0),(48,'Secure UML Testing',1),(48,'Secure UML System Architecture and Design',2),(48,'Business Process Program Enhancement',3),(49,'Incident Response Process',0),(49,'Forensics',1);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `Type`, `Groups`, `Locked`) VALUES (2,'Ada','Lovelace','viewer@example.com','624070fe27cf131e8e5539f5d994925fbb5af242046149444350a355e7585c04147bcfba1956dbad902c26fb26b15418bf8f0c51fff90cab534b08a949438ab1','Viewer','None', 'FALSE'),(3,'Grace','Hopper','submitter@example.com','624070fe27cf131e8e5539f5d994925fbb5af242046149444350a355e7585c04147bcfba1956dbad902c26fb26b15418bf8f0c51fff90cab534b08a949438ab1','Submitter','Dean','FALSE'),(4,'Vannevar','Bush','editor@example.com','624070fe27cf131e8e5539f5d994925fbb5af242046149444350a355e7585c04147bcfba1956dbad902c26fb26b15418bf8f0c51fff90cab534b08a949438ab1','Editor','President','FALSE'),(5,'Demo','SuperViewer','superviewer@example.com','0b4d307f8510ddeccff0e2758258ba6a6870f430c3842dcb181fe531d31649eae36ea0a40c76ff07e9196b62ad7cbcbb4f7b781374ab9c707d7c17108a734ff4','SuperViewer','Student','FALSE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-22 12:30:00
