-- MySQL dump 10.13  Distrib 9.3.0, for macos15.2 (arm64)
--
-- Host: localhost    Database: fitness_app
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'demo@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','Demo User','2025-06-15 13:29:16'),(2,'admin@gmail.com','0192023a7bbd73250516f069df18b500','Administrator','2025-06-15 13:29:16'),(3,'test@gmail.com','05a671c66aefea124cc08b76ea6d30bb','Test User','2025-06-15 13:29:16');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `challenges` (
  `id` int NOT NULL AUTO_INCREMENT,
  `challenge_name` varchar(255) NOT NULL,
  `challenge_image` varchar(255) DEFAULT NULL,
  `challenge_description` text,
  `challenge_reward` varchar(255) DEFAULT NULL,
  `challenge_difficulty` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_challenges_user` (`user_id`),
  CONSTRAINT `fk_challenges_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges`
--

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;
INSERT INTO `challenges` VALUES (1,'30-Day Fitness Challenge','images/fitness_challenge.jpg','Complete daily workouts for 30 days to improve your fitness.','Fitness badge + 100 points','Medium','2025-07-01','2025-07-30','2025-06-15 13:37:59',NULL),(2,'Hydration Challenge','images/hydration_challenge.jpg','Drink at least 8 glasses of water daily for 2 weeks.','Hydration champion badge','Easy','2025-06-20','2025-07-04','2025-06-15 13:37:59',NULL),(3,'Step Up Challenge','images/step_up_challenge.jpg','Walk 10,000 steps every day for a month.','Step master medal','Medium','2025-06-15','2025-07-15','2025-06-15 13:37:59',NULL),(4,'No Sugar Week','images/no_sugar_week.jpg','Avoid all added sugar for 7 days.','Sugar free badge','Hard','2025-06-10','2025-06-17','2025-06-15 13:37:59',NULL),(5,'Yoga Flexibility Challenge','images/yoga_flexibility.jpg','Practice daily yoga for increased flexibility over 21 days.','Yoga pro certificate','Medium','2025-07-05','2025-07-26','2025-06-15 13:37:59',NULL);
/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meal_name` varchar(255) NOT NULL,
  `meal_image` varchar(255) DEFAULT NULL,
  `meal_description` text,
  `meal_price` decimal(10,2) NOT NULL,
  `meal_calories` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meals_user_FK` (`user_id`),
  CONSTRAINT `meals_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meals`
--

LOCK TABLES `meals` WRITE;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `user_admin_FK` FOREIGN KEY (`id`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'user1@example.com','7c6a180b36896a0a8c02787eeafb0e4c','User One','2025-06-15 13:29:00'),(2,'user2@example.com','6cb75f652a9b52798eb6cf2201057c73','User Two','2025-06-15 13:29:00'),(3,'user3@example.com','819b0643d6b89dc9b579fdfc9094f28e','User Three','2025-06-15 13:29:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weight`
--

DROP TABLE IF EXISTS `weight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weight` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `weight_kg` decimal(5,2) NOT NULL,
  `recorded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_weight_user` (`user_id`),
  CONSTRAINT `fk_weight_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weight`
--

LOCK TABLES `weight` WRITE;
/*!40000 ALTER TABLE `weight` DISABLE KEYS */;
INSERT INTO `weight` VALUES (1,1,78.50,'2025-06-01 09:00:00'),(2,1,78.20,'2025-06-05 09:00:00'),(3,1,77.80,'2025-06-10 09:00:00'),(4,2,85.00,'2025-06-01 10:30:00'),(5,2,84.70,'2025-06-07 10:30:00'),(6,3,92.30,'2025-06-01 08:45:00'),(7,3,91.90,'2025-06-08 08:45:00');
/*!40000 ALTER TABLE `weight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workoutplan`
--

DROP TABLE IF EXISTS `workoutplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workoutplan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `duration_minutes` int DEFAULT NULL,
  `difficulty` enum('beginner','intermediate','advanced') DEFAULT 'beginner',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workoutplan_user` (`user_id`),
  CONSTRAINT `fk_workoutplan_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workoutplan`
--

LOCK TABLES `workoutplan` WRITE;
/*!40000 ALTER TABLE `workoutplan` DISABLE KEYS */;
INSERT INTO `workoutplan` VALUES (1,'Full Body Blast','Complete workout for all muscle groups.',45,'intermediate','2025-06-15 11:16:59',NULL),(2,'Morning Yoga','Light stretching and breathing.',30,'beginner','2025-06-15 11:16:59',NULL);
/*!40000 ALTER TABLE `workoutplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workouts`
--

DROP TABLE IF EXISTS `workouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workouts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `workoutplan_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `reps` int DEFAULT NULL,
  `sets` int DEFAULT NULL,
  `duration_seconds` int DEFAULT NULL,
  `rest_seconds` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workouts_workoutplan` (`workoutplan_id`),
  CONSTRAINT `fk_workouts_workoutplan` FOREIGN KEY (`workoutplan_id`) REFERENCES `workoutplan` (`id`) ON DELETE SET NULL,
  CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`workoutplan_id`) REFERENCES `workoutplan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workouts`
--

LOCK TABLES `workouts` WRITE;
/*!40000 ALTER TABLE `workouts` DISABLE KEYS */;
INSERT INTO `workouts` VALUES (1,1,'Push Ups',15,3,NULL,30,'2025-06-15 11:23:48',0),(2,1,'Squats',20,3,NULL,30,'2025-06-15 11:23:48',0),(3,1,'Plank',NULL,1,60,30,'2025-06-15 11:23:48',0),(4,1,'Lunges',12,3,NULL,30,'2025-06-15 11:23:48',0),(5,1,'Burpees',10,3,NULL,45,'2025-06-15 11:23:48',0),(6,1,'Mountain Climbers',NULL,3,40,30,'2025-06-15 11:23:48',0),(7,1,'Jumping Jacks',NULL,3,60,30,'2025-06-15 11:23:48',0),(8,1,'Sit Ups',20,3,NULL,30,'2025-06-15 11:23:48',0),(9,1,'High Knees',NULL,3,45,30,'2025-06-15 11:23:48',0),(10,1,'Bicycle Crunches',25,3,NULL,30,'2025-06-15 11:23:48',0);
/*!40000 ALTER TABLE `workouts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-15 14:03:48
