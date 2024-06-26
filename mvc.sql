-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: mvc
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Censorship`
--

DROP TABLE IF EXISTS `Censorship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Censorship` (
  `censorship_id` int NOT NULL AUTO_INCREMENT,
  `censorship_word` varchar(255) NOT NULL,
  PRIMARY KEY (`censorship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Censorship`
--

LOCK TABLES `Censorship` WRITE;
/*!40000 ALTER TABLE `Censorship` DISABLE KEYS */;
INSERT INTO `Censorship` VALUES (20,'asd'),(21,'word');
/*!40000 ALTER TABLE `Censorship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `censorship_messages`
--

DROP TABLE IF EXISTS `censorship_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `censorship_messages` (
  `censore_message_id` int NOT NULL AUTO_INCREMENT,
  `message_id` int unsigned NOT NULL,
  `censorship_id` int NOT NULL,
  PRIMARY KEY (`censore_message_id`),
  KEY `message_id` (`message_id`),
  KEY `censorship_id` (`censorship_id`),
  CONSTRAINT `censorship_messages_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `censorship_messages_ibfk_2` FOREIGN KEY (`censorship_id`) REFERENCES `Censorship` (`censorship_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `censorship_messages`
--

LOCK TABLES `censorship_messages` WRITE;
/*!40000 ALTER TABLE `censorship_messages` DISABLE KEYS */;
INSERT INTO `censorship_messages` VALUES (1,15,21),(2,17,21);
/*!40000 ALTER TABLE `censorship_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int unsigned DEFAULT '0',
  `user_id` int unsigned NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `censorship_check_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (12,'Hello','blablablaadsasdsd','<script>alert(1)</script>','2024-05-23 18:31:37',1,6,0,NULL),(14,'asdasdasdasdasd','asdasdasdasdasdasd','asdasdasdasdasd','2024-06-18 22:13:34',0,4,0,NULL),(15,'Oriflem','Html - hypertext ....','asdlkjlkj123lkjasdlkjalksdjsad word','2024-06-20 19:24:05',1,8,1,'2024-06-27 00:03:47'),(16,'Admin','I am Admin asdasd','ssssssssssssssssssssss','2024-06-20 19:25:59',1,6,1,'2024-06-27 00:03:47'),(17,'Admin','Hello asd how are you','many many word \"word\"','2024-06-27 00:03:15',1,6,1,'2024-06-27 00:03:47');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'asdasd@gmail.com','User','$2y$10$X21HNke9w1zS.qyYR.X/Pu329YtmcI6u9aghtivzlwyVRbTA/CaN2',3),(5,'asd@gmail.com','Manager','$2y$10$Gu291Y/fllOAVekQqdHnFOXlIOQSuVbI7e8LSxfWmkT69YjGNz8XG',2),(6,'asd@gmail.com','Admin','$2y$10$DZVXnQToucGXSGaZRm2ERem7iiTeO6hehrRRZx5hig2yL/NlAF3pC',1),(7,'asd@gmail.com','123123','$2y$10$WaJeeojeAbo8qF5MVnzjfuRqW3ThshQZGFfl6cxWLYwablNBaLBse',3),(8,'luigi@gmail.com','Mario','$2y$10$x/S8eYWg6i/kOsvxCaJ4kOiHPamzxSvyBra00uXejwHvMcSsIi6KO',3);
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

-- Dump completed on 2024-06-27  0:06:47
