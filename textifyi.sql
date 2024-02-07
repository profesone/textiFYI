-- MariaDB dump 10.19  Distrib 10.6.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: textifyi
-- ------------------------------------------------------
-- Server version	10.6.16-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `properties` text DEFAULT NULL,
  `host` varchar(46) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,'audit:created',1,'App\\Models\\Client#1',2,'{\"client_name\":\"Leslie Santiago\",\"company_name\":\"Powell Black Plc\",\"main_contact_number\":\"9578421744\",\"email\":\"zudyhemujo@mailinator.com\",\"texti_fyi_number_id\":null,\"default_message\":\"Illum dolore dolore\",\"default_request_message\":\"Ipsum corrupti in N\",\"default_zipcode_message\":\"Nostrum ad ad commod\",\"email_address_response\":\"Ipsum delectus adi\",\"default_messages_module\":true,\"default_message_notification\":true,\"default_message_response\":false,\"publish_keywords_module\":false,\"leads_module\":true,\"keyword_module\":true,\"mls_listing_module\":false,\"mls_agent_notification\":false,\"tips_request_module\":true,\"zip_code_module\":false,\"default_zip_notification\":true,\"email_address_module\":true,\"default_email_notification\":false,\"team_id\":1,\"updated_at\":\"2024-02-04 13:18:17\",\"created_at\":\"2024-02-04 13:18:17\",\"id\":1}','127.0.0.1','2024-02-04 19:18:17','2024-02-04 19:18:17'),(2,'audit:created',2,'App\\Models\\Client#2',2,'{\"client_name\":\"Aurora Vargas\",\"company_name\":\"Bowen and Fleming LLC\",\"main_contact_number\":\"6414862031\",\"email\":\"fyte@mailinator.com\",\"texti_fyi_number_id\":null,\"default_message\":\"Qui dolore labore am\",\"default_request_message\":\"Iure est ullamco ut \",\"default_zipcode_message\":\"Sit eligendi exerci\",\"email_address_response\":\"Ea atque ut recusand\",\"default_messages_module\":true,\"default_message_notification\":false,\"default_message_response\":false,\"publish_keywords_module\":true,\"leads_module\":true,\"keyword_module\":true,\"mls_listing_module\":false,\"mls_agent_notification\":true,\"tips_request_module\":false,\"zip_code_module\":true,\"default_zip_notification\":false,\"email_address_module\":true,\"default_email_notification\":false,\"team_id\":1,\"updated_at\":\"2024-02-04 13:18:45\",\"created_at\":\"2024-02-04 13:18:45\",\"id\":2}','127.0.0.1','2024-02-04 19:18:45','2024-02-04 19:18:45');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `main_contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `default_message` longtext DEFAULT NULL,
  `default_request_message` longtext DEFAULT NULL,
  `default_zipcode_message` longtext DEFAULT NULL,
  `email_address_response` longtext DEFAULT NULL,
  `default_messages_module` tinyint(1) DEFAULT 0,
  `default_message_notification` tinyint(1) DEFAULT 0,
  `default_message_response` tinyint(1) DEFAULT 0,
  `publish_keywords_module` tinyint(1) DEFAULT 0,
  `leads_module` tinyint(1) DEFAULT 0,
  `keyword_module` tinyint(1) DEFAULT 0,
  `mls_listing_module` tinyint(1) DEFAULT 0,
  `mls_agent_notification` tinyint(1) DEFAULT 0,
  `tips_request_module` tinyint(1) DEFAULT 0,
  `zip_code_module` tinyint(1) DEFAULT 0,
  `default_zip_notification` tinyint(1) DEFAULT 0,
  `email_address_module` tinyint(1) DEFAULT 0,
  `default_email_notification` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `texti_fyi_number_id` bigint(20) unsigned DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`),
  KEY `texti_fyi_number_fk_9314949` (`texti_fyi_number_id`),
  KEY `team_fk_9314970` (`team_id`),
  CONSTRAINT `team_fk_9314970` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `texti_fyi_number_fk_9314949` FOREIGN KEY (`texti_fyi_number_id`) REFERENCES `textifyi_numbers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Leslie Santiago','Powell Black Plc','9578421744','zudyhemujo@mailinator.com','Illum dolore dolore','Ipsum corrupti in N','Nostrum ad ad commod','Ipsum delectus adi',1,1,0,0,1,1,0,0,1,0,1,1,0,'2024-02-04 19:18:17','2024-02-04 19:18:17',NULL,NULL,1),(2,'Aurora Vargas','Bowen and Fleming LLC','6414862031','fyte@mailinator.com','Qui dolore labore am','Iure est ullamco ut ','Sit eligendi exerci','Ea atque ut recusand',1,0,0,1,1,1,0,1,0,1,0,1,0,'2024-02-04 19:18:45','2024-02-04 19:18:45',NULL,NULL,1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `im_conversations`
--

DROP TABLE IF EXISTS `im_conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_conversations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` bigint(20) unsigned NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `im_conversations_owner_id_foreign` (`owner_id`),
  CONSTRAINT `im_conversations_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `im_conversations`
--

LOCK TABLES `im_conversations` WRITE;
/*!40000 ALTER TABLE `im_conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `im_conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `im_messages`
--

DROP TABLE IF EXISTS `im_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `im_messages_conversation_id_foreign` (`conversation_id`),
  KEY `im_messages_user_id_foreign` (`user_id`),
  CONSTRAINT `im_messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `im_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `im_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `im_messages`
--

LOCK TABLES `im_messages` WRITE;
/*!40000 ALTER TABLE `im_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `im_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `im_recipients`
--

DROP TABLE IF EXISTS `im_recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_recipients` (
  `conversation_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `seen_at` timestamp NULL DEFAULT NULL,
  KEY `im_recipients_conversation_id_foreign` (`conversation_id`),
  KEY `im_recipients_user_id_foreign` (`user_id`),
  CONSTRAINT `im_recipients_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `im_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `im_recipients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `im_recipients`
--

LOCK TABLES `im_recipients` WRITE;
/*!40000 ALTER TABLE `im_recipients` DISABLE KEYS */;
/*!40000 ALTER TABLE `im_recipients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword_text_response`
--

DROP TABLE IF EXISTS `keyword_text_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword_text_response` (
  `text_response_id` bigint(20) unsigned NOT NULL,
  `keyword_id` bigint(20) unsigned NOT NULL,
  KEY `text_response_id_fk_9396979` (`text_response_id`),
  KEY `keyword_id_fk_9396979` (`keyword_id`),
  CONSTRAINT `keyword_id_fk_9396979` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE,
  CONSTRAINT `text_response_id_fk_9396979` FOREIGN KEY (`text_response_id`) REFERENCES `text_responses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_text_response`
--

LOCK TABLES `keyword_text_response` WRITE;
/*!40000 ALTER TABLE `keyword_text_response` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword_text_response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywords` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_fk_9314973` (`client_id`),
  KEY `team_fk_9314977` (`team_id`),
  CONSTRAINT `client_fk_9314973` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `team_fk_9314977` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_12_14_000001_create_personal_access_tokens_table',1),(3,'2024_01_28_000001_create_audit_logs_table',1),(4,'2024_01_28_000002_create_permissions_table',1),(5,'2024_01_28_000003_create_roles_table',1),(6,'2024_01_28_000004_create_users_table',1),(7,'2024_01_28_000005_create_teams_table',1),(8,'2024_01_28_000006_create_textifyi_numbers_table',1),(9,'2024_01_28_000007_create_clients_table',1),(10,'2024_01_28_000008_create_keywords_table',1),(11,'2024_01_28_000009_create_text_responses_table',1),(12,'2024_01_28_000010_create_permission_role_pivot_table',1),(13,'2024_01_28_000011_create_role_user_pivot_table',1),(14,'2024_01_28_000012_create_keyword_text_response_pivot_table',1),(15,'2024_01_28_000013_add_relationship_fields_to_users_table',1),(16,'2024_01_28_000014_add_relationship_fields_to_teams_table',1),(17,'2024_01_28_000015_add_relationship_fields_to_textifyi_numbers_table',1),(18,'2024_01_28_000016_add_relationship_fields_to_clients_table',1),(19,'2024_01_28_000017_add_relationship_fields_to_keywords_table',1),(20,'2024_01_28_000018_add_relationship_fields_to_text_responses_table',1),(21,'2024_01_28_000019_create_im_conversations_table',1),(22,'2024_01_28_000020_create_im_messages_table',1),(23,'2024_01_28_000021_create_im_recipients_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  KEY `role_id_fk_9314907` (`role_id`),
  KEY `permission_id_fk_9314907` (`permission_id`),
  CONSTRAINT `permission_id_fk_9314907` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_9314907` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(2,1),(2,23),(2,24),(2,27),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(2,37),(2,38),(2,39),(2,40),(2,41),(2,42),(2,43),(2,44);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'auth_profile_edit',NULL,NULL,NULL),(2,'user_management_access',NULL,NULL,NULL),(3,'permission_create',NULL,NULL,NULL),(4,'permission_edit',NULL,NULL,NULL),(5,'permission_show',NULL,NULL,NULL),(6,'permission_delete',NULL,NULL,NULL),(7,'permission_access',NULL,NULL,NULL),(8,'role_create',NULL,NULL,NULL),(9,'role_edit',NULL,NULL,NULL),(10,'role_show',NULL,NULL,NULL),(11,'role_delete',NULL,NULL,NULL),(12,'role_access',NULL,NULL,NULL),(13,'user_create',NULL,NULL,NULL),(14,'user_edit',NULL,NULL,NULL),(15,'user_show',NULL,NULL,NULL),(16,'user_delete',NULL,NULL,NULL),(17,'user_access',NULL,NULL,NULL),(18,'team_create',NULL,NULL,NULL),(19,'team_edit',NULL,NULL,NULL),(20,'team_show',NULL,NULL,NULL),(21,'team_delete',NULL,NULL,NULL),(22,'team_access',NULL,NULL,NULL),(23,'audit_log_show',NULL,NULL,NULL),(24,'audit_log_access',NULL,NULL,NULL),(25,'textifyi_number_create',NULL,NULL,NULL),(26,'textifyi_number_edit',NULL,NULL,NULL),(27,'textifyi_number_show',NULL,NULL,NULL),(28,'textifyi_number_delete',NULL,NULL,NULL),(29,'textifyi_number_access',NULL,NULL,NULL),(30,'client_create',NULL,NULL,NULL),(31,'client_edit',NULL,NULL,NULL),(32,'client_show',NULL,NULL,NULL),(33,'client_delete',NULL,NULL,NULL),(34,'client_access',NULL,NULL,NULL),(35,'keyword_create',NULL,NULL,NULL),(36,'keyword_edit',NULL,NULL,NULL),(37,'keyword_show',NULL,NULL,NULL),(38,'keyword_delete',NULL,NULL,NULL),(39,'keyword_access',NULL,NULL,NULL),(40,'text_response_create',NULL,NULL,NULL),(41,'text_response_edit',NULL,NULL,NULL),(42,'text_response_show',NULL,NULL,NULL),(43,'text_response_delete',NULL,NULL,NULL),(44,'text_response_access',NULL,NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  KEY `user_id_fk_9314916` (`user_id`),
  KEY `role_id_fk_9314916` (`role_id`),
  CONSTRAINT `role_id_fk_9314916` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_9314916` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin',NULL,NULL,NULL),(2,'User',NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_fk_9314924` (`owner_id`),
  CONSTRAINT `owner_fk_9314924` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Brun Warriors','2024-02-04 18:25:06','2024-02-04 18:25:06',NULL,2),(2,'Administrators','2024-02-04 18:51:45','2024-02-04 18:51:45',NULL,1);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `text_responses`
--

DROP TABLE IF EXISTS `text_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_responses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign` varchar(255) NOT NULL,
  `response` longtext NOT NULL,
  `notes` longtext DEFAULT NULL,
  `notification_main` varchar(255) DEFAULT NULL,
  `notification_01` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `main_keyword_id` bigint(20) unsigned DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_fk_9360208` (`client_id`),
  KEY `main_keyword_fk_9422363` (`main_keyword_id`),
  KEY `team_fk_9315149` (`team_id`),
  CONSTRAINT `client_fk_9360208` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `main_keyword_fk_9422363` FOREIGN KEY (`main_keyword_id`) REFERENCES `keywords` (`id`),
  CONSTRAINT `team_fk_9315149` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text_responses`
--

LOCK TABLES `text_responses` WRITE;
/*!40000 ALTER TABLE `text_responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `text_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `textifyi_numbers`
--

DROP TABLE IF EXISTS `textifyi_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `textifyi_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `textifyi_numbers` varchar(255) NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `textifyi_numbers_textifyi_numbers_unique` (`textifyi_numbers`),
  KEY `team_fk_9360078` (`team_id`),
  CONSTRAINT `team_fk_9360078` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `textifyi_numbers`
--

LOCK TABLES `textifyi_numbers` WRITE;
/*!40000 ALTER TABLE `textifyi_numbers` DISABLE KEYS */;
INSERT INTO `textifyi_numbers` VALUES (1,'2813131331',0,'2024-02-04 10:19:38','2024-02-04 10:19:38',NULL,NULL),(2,'3053323333',0,'2024-02-04 18:24:29','2024-02-04 18:24:29',NULL,NULL);
/*!40000 ALTER TABLE `textifyi_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `locale` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `team_fk_9314928` (`team_id`),
  CONSTRAINT `team_fk_9314928` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com',NULL,'$2y$10$e.r4Fnhg30WribppZenVpOluMp6/rEnXXH.S7rQbHFp.Bnf3gt1ri',NULL,'',NULL,NULL,NULL,NULL),(2,'Mark Henry','profesone@gmail.com',NULL,'$2y$10$CFtmVP1JYtmozPOQ0ZTEv.CZnNpStQwoPgvPrl//pYPYyKRfYyY.e',NULL,NULL,'2024-02-04 10:21:17','2024-02-04 10:21:17',NULL,NULL);
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

-- Dump completed on 2024-02-04  7:58:29
