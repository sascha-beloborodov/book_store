-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: book_store
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `public_year` int(11) NOT NULL,
  `book_cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (11,'unread messages','Adele Mccoy','Anim non aliquip consectetur laboris in ut quis. Elit enim aliquip ex dolor officia do. Duis excepteur amet deserunt veniam. Voluptate dolor adipisicing est cupidatat consequat proident labore adipisicing proident elit magna ipsum',1987,'storage\\data\\images\\1464586537519ebdb04b97c7044f8174e2f54c004a618ae16892c.jpg',4,'2016-05-30 02:36:45','2016-05-30 02:36:45'),(10,'Frances Gentry','Aurora Marsh','Et magna duis cupidatat duis cillum in est est adipisicing culpa anim minim. Eu consectetur do tempor voluptate amet et fugiat sit ut. Nostrud ea ullamco duis nulla Lorem occaecat incididunt sint pariatur esse nulla. Culpa laboris pariatur laboris voluptate. Minim in anim ut ullamco aliqua eiusmod sit aliquip esse. Ut nostrud dolor non incididunt nostrud consectetur culpa voluptate',1998,'storage\\data\\images\\1464586474550a14fd0b3ef56098378f07519d5e131a5e2c0292d.jpg',4,'2016-05-30 02:34:52','2016-05-30 02:34:52'),(9,'Boook about','Deann May','Et magna duis cupidatat duis cillum in est est adipisicing culpa anim minim. Eu consectetur do tempor voluptate amet et fugiat sit ut. Nostrud ea ullamco duis nulla Lorem occaecat incididunt sint pariatur esse nulla. Culpa laboris pariatur laboris voluptate. Minim in anim ut ullamco aliqua eiusmod sit aliquip esse. Ut nostrud dolor non incididunt nostrud consectetur culpa voluptate.',2015,'storage\\data\\images\\14645860647897ab884fb5dad3c57c236d3eb318deabb6876d2c5.jpg',4,'2016-05-30 02:25:56','2016-05-30 02:28:03'),(12,'Vivamus suscipit','Vestibulum ante','Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.',1992,'storage\\data\\images\\1464586794937d52bb492c593275ef6c723ca0ecaf78ce0c6beeb.jpg',4,'2016-05-30 02:39:56','2016-05-30 02:39:56'),(13,'Praesent sapien','Proin eget t','Pellentesque in ipsum id orci porta dapibus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat.',2001,'storage\\data\\images\\1464586830457f4717e562066d0ad6ebfa12b436c384e37daf1eb.jpg',4,'2016-05-30 02:42:07','2016-05-30 02:42:07'),(14,'eget tortor','Nulla porttito','Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Cras ultricies ligula sed magna dictum porta. Nulla porttitor accumsan tincidunt. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Proin eget tortor risus.',1992,'storage\\data\\images\\14645894307563f81151d0e9c57583901045591d794dd17b342e4.jpg',4,'2016-05-30 03:22:48','2016-05-30 03:24:02'),(16,'blandit aliquet','pulvinar a','Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.',1992,'storage\\data\\images\\14646056977554bd72957d882ed6522f1d45a4a22627838d0e5ba.jpg',5,'2016-05-30 07:55:02','2016-05-30 07:55:02'),(17,'Pellentesque in ipsum','pretium ut lacinia','Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus suscipit tortor eget felis porttitor volutpat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Pellentesque in ipsum id orci porta dapibus.',2011,'storage\\data\\images\\1464605730902f4717e562066d0ad6ebfa12b436c384e37daf1eb.jpg',5,'2016-05-30 07:55:33','2016-05-30 07:55:33'),(18,'Nulla quis lorem','Donec rutrum','Curabitur aliquet quam id dui posuere blandit. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Nulla quis lorem ut libero malesuada feugiat.',2007,'storage\\data\\images\\14646058115483f81151d0e9c57583901045591d794dd17b342e4.jpg',5,'2016-05-30 07:56:56','2016-05-30 07:56:56'),(19,'Curabitur non','Curabitur aliquet','Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur aliquet quam id dui posuere blandit. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur aliquet quam id dui posuere blandit.',1998,'storage\\data\\images\\14646059685237ab884fb5dad3c57c236d3eb318deabb6876d2c5.jpg',5,'2016-05-30 07:59:30','2016-05-30 07:59:30'),(20,'Quisque velit nisi','Cras ultricies','Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Cras ultricies ligula sed magna dictum porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Cras ultricies ligula sed magna dictum porta.',2001,'storage\\data\\images\\1464606034112ebdb04b97c7044f8174e2f54c004a618ae16892c.jpg',5,'2016-05-30 08:00:36','2016-05-30 08:00:36'),(21,'Donec sollicitudinrr','lacinia eget','Quisque velit nisi, pretium ut lacinia in, elementum id enim. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec sollicitudin molestie malesuada.',2005,'storage\\data\\images\\14646064264717ab884fb5dad3c57c236d3eb318deabb6876d2c5.jpg',6,'2016-05-30 08:03:52','2016-05-30 08:07:19'),(22,'Mauris blandit','Proin eget','Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Nulla porttitor accumsan tincidunt. Vivamus suscipit tortor eget felis porttitor volutpat.',2001,'storage\\data\\images\\14646062656643f81151d0e9c57583901045591d794dd17b342e4.jpg',6,'2016-05-30 08:04:40','2016-05-30 08:04:40'),(23,'sed sit amet dui','Pellentesque in ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur aliquet quam id dui posuere blandit. Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.',2004,'storage\\data\\images\\14646064798633f81151d0e9c57583901045591d794dd17b342e4.jpg',6,'2016-05-30 08:08:05','2016-05-30 08:08:05');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'testtt','test2@test.test2','$2y$10$R/sGRl3YLbXdWYKZExIaj.eu9AsWgtF0LsuFtsegd4eQ6p6pSOE9a','2016-05-30 08:03:20','2016-05-30 08:03:20'),(5,'testt','test1@test1.test1','$2y$10$FflphD0QtXu/gRMDYqtFMOD8n4WMJzFYknyQAkT6aifpXN0o2w5vO','2016-05-30 07:54:23','2016-05-30 07:54:23'),(4,'test','test@test.test','$2y$10$6P4JzQYI/eWBDPtesP/R6uNTubZfXJhs3gskupIhLDfQHVrdigdG2','2016-05-30 01:42:55','2016-05-30 01:42:55');
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

-- Dump completed on 2016-05-30 14:56:42
