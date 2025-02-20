-- MySQL dump 10.13  Distrib 8.0.40, for macos14 (arm64)
--
-- Host: localhost    Database: leadmgmt
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Lead ID',
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Lead Name',
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Lead Email Address',
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Lead Phone Number',
  `status` enum('New','In Progress','Closed') COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Lead status',
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Lead created time',
  `last_updated` datetime DEFAULT NULL COMMENT 'Lead last updated time',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,'Lead 1','lead1@email.com','1234567890','New','2025-02-19 14:32:55','2025-02-19 14:40:53'),(2,'Lead 2','lead2@email.com','9012345678','In Progress','2025-02-19 14:41:20',NULL),(3,'Lead 3','lead3@email.com','0897654321','Closed','2025-02-19 14:41:54',NULL),(4,'Lead 4','lead4@email.com','1234567890','New','2025-02-20 04:07:40',NULL),(5,'Lead 5','lead5@email.com','9012345678','In Progress','2025-02-20 04:07:40',NULL),(6,'Lead 6','lead6@email.com','0897654321','Closed','2025-02-20 04:07:40',NULL),(7,'Lead 7','lead7@email.com','0938382684','Closed','2025-02-20 05:28:16','2025-02-20 05:36:57'),(8,'Lead 8','lead8@email.com','973482342','New','2025-02-20 05:29:43',NULL),(9,'Lead 10','lead10@email.com','2340923423','In Progress','2025-02-20 05:42:15',NULL),(12,'Lead 11','lead11@email.com','12345678190','New','2025-02-20 05:52:06','2025-02-20 05:52:28');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation_logs`
--

DROP TABLE IF EXISTS `operation_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operation_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `log` json NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation_logs`
--

LOCK TABLES `operation_logs` WRITE;
/*!40000 ALTER TABLE `operation_logs` DISABLE KEYS */;
INSERT INTO `operation_logs` VALUES (1,'{\"msg\": \"User submited the Login form\", \"action\": \"Pending\", \"operation\": \"User perfom a login action with email : \'admin@admin.admin\' and password : \'YWRtaW4=\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:45:36','2025-02-20 05:46:17'),(2,'{\"msg\": \"Successful Login\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:45:37','2025-02-20 05:46:17'),(3,'{\"msg\": \"Created New Lead\", \"action\": \"Failed\", \"operation\": \"The user with email : \'admin@admin.admin\' has failed to crate a new lead.\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:47:25',NULL),(4,'{\"msg\": \"Created New Lead\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has created a new lead. The lead id is : \'10\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:47:54',NULL),(5,'{\"msg\": \"Edited Lead\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a lead. The lead id is : \'10\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:47:59',NULL),(6,'{\"msg\": \"Edited Lead\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a lead. The lead id is : \'10\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:48:04',NULL),(7,'{\"msg\": \"Deleted Lead\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has deleted a lead. The lead id is : \'10\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:48:08','2025-02-20 05:49:27'),(8,'{\"msg\": \"Exporting InProgress\", \"action\": \"Pending\", \"operation\": \"The user with email : \'admin@admin.admin\' has started exporting leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:49:45',NULL),(9,'{\"msg\": \"Export Finished\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has downloaded the exported leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:49:45',NULL),(10,'{\"msg\": \"Exporting InProgress\", \"action\": \"Pending\", \"operation\": \"The user with email : \'admin@admin.admin\' has started exporting leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:49:46',NULL),(11,'{\"msg\": \"Export Finished\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has downloaded the exported leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:49:46',NULL),(12,'{\"msg\": \"Importing InProgress\", \"action\": \"Pending\", \"operation\": \"The user with email : \'admin@admin.admin\' has started importing leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:50:45',NULL),(13,'{\"msg\": \"Import Error\", \"action\": \"Failed\", \"operation\": \"The user with email : \'admin@admin.admin\' has supplied Invalid file format for import\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:50:45',NULL),(14,'{\"msg\": \"Importing InProgress\", \"action\": \"Pending\", \"operation\": \"The user with email : \'admin@admin.admin\' has started importing leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:51:04',NULL),(15,'{\"msg\": \"Importing InProgress\", \"action\": \"Pending\", \"operation\": \"The user with email : \'admin@admin.admin\' has started importing leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:52:06',NULL),(16,'{\"msg\": \"Import Finished\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully imported 1 leads and Failed to import 8 leads\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:52:06',NULL),(17,'{\"msg\": \"Edited Lead\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a lead. The lead id is : \'12\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 05:52:28',NULL),(18,'{\"msg\": \"Successful Logout\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 06:01:34',NULL),(19,'{\"msg\": \"User submited the Login form\", \"action\": \"Pending\", \"operation\": \"User perfom a login action with email : \'admin@admin.admin\' and password : \'YWRtaW4=\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 06:01:41','2025-02-20 06:01:41'),(20,'{\"msg\": \"Successful Login\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 06:01:41',NULL),(21,'{\"msg\": \"User submited the Login form\", \"action\": \"Pending\", \"operation\": \"User perfom a login action with email : \'admin@admin.admin\' and password : \'YWRtaW4=\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 10:07:04','2025-02-20 10:07:04'),(22,'{\"msg\": \"Successful Login\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 10:07:04',NULL),(23,'{\"msg\": \"Edited user\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a user. The user id is : \'1\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 10:58:39',NULL),(24,'{\"msg\": \"Edited user\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a user. The user id is : \'1\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 10:58:55',NULL),(25,'{\"msg\": \"Edited user\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a user. The user id is : \'1\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 10:59:15',NULL),(26,'{\"msg\": \"Edited user\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has edited a user. The user id is : \'2\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 11:07:43',NULL),(27,'{\"msg\": \"Successful Logout\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 11:17:24',NULL),(28,'{\"msg\": \"User submited the Login form\", \"action\": \"Pending\", \"operation\": \"User perfom a login action with email : \'user@user.user\' and password : \'dXNlcg==\'\", \"ip_address\": \"127.0.0.1\"}',2,'2025-02-20 11:17:31','2025-02-20 11:17:31'),(29,'{\"msg\": \"Successful Login\", \"action\": \"Success\", \"operation\": \"The user with email : \'user@user.user\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',2,'2025-02-20 11:17:31',NULL),(30,'{\"msg\": \"Successful Logout\", \"action\": \"Success\", \"operation\": \"The user with email : \'user@user.user\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',2,'2025-02-20 11:23:35',NULL),(31,'{\"msg\": \"User submited the Login form\", \"action\": \"Pending\", \"operation\": \"User perfom a login action with email : \'admin@admin.admin\' and password : \'YWRtaW4=\'\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 11:26:10','2025-02-20 11:26:10'),(32,'{\"msg\": \"Successful Login\", \"action\": \"Success\", \"operation\": \"The user with email : \'admin@admin.admin\' has successfully logged in\", \"ip_address\": \"127.0.0.1\"}',1,'2025-02-20 11:26:10',NULL);
/*!40000 ALTER TABLE `operation_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assigned_leads` text COLLATE utf8mb4_general_ci,
  `user_role` enum('admin','user') COLLATE utf8mb4_general_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.admin','$2y$12$vTPLUnAvUIjb5FyEGXx.A.crd/XZPqp/xE0AEYmK.0pOMIB1dLq3W','2,3,4','admin','2025-02-19 14:21:45','2025-02-20 10:58:55'),(2,'User','user@user.user','$2y$12$aicxfhMWA8cRA8Cp.WVuW.ep16x1043RrFikAFQdXmGc.R79SMYlC','1,2,3,4,5','user','2025-02-19 14:22:39','2025-02-20 11:07:43');
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

-- Dump completed on 2025-02-20 17:19:05
