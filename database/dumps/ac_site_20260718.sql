-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: ac_site
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Business','business',NULL,1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(2,'Tips','tips',NULL,2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(3,'Educate','educate',NULL,3,1,'2026-07-11 02:44:50','2026-07-11 02:44:50');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category_post`
--

DROP TABLE IF EXISTS `blog_category_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_category_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_post_id` bigint(20) unsigned NOT NULL,
  `blog_category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_category_post_blog_post_id_blog_category_id_unique` (`blog_post_id`,`blog_category_id`),
  KEY `blog_category_post_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blog_category_post_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `blog_category_post_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category_post`
--

LOCK TABLES `blog_category_post` WRITE;
/*!40000 ALTER TABLE `blog_category_post` DISABLE KEYS */;
INSERT INTO `blog_category_post` VALUES (1,1,1),(2,1,2),(4,2,2),(3,2,3),(5,3,3),(7,4,2),(6,4,3);
/*!40000 ALTER TABLE `blog_category_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_role` varchar(255) DEFAULT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `author_bio` text DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `published_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'How to surviving on the great industry age','how-to-surviving-on-the-great-industry-age','Tips for thriving in a competitive digital industry landscape.','<p>It a monitor lie agency, all been evening. It right called phase boa however of the city the over had the play.</p><blockquote><p>Upper to I to enjoying this roman conduct, a for to but I it duty we’ve boa he can in he to was long be economic her supplies.</p></blockquote><p>Even the should you equally train the move fortune.</p>',NULL,'Daniel Zedda','Author',NULL,'Digital strategist and content creator with years of industry experience.','[\"Agency\",\"Business\",\"Industry\"]','2026-07-01 02:44:50',1,'How to surviving on the great industry age - Irhas Blog','Learn how to survive and thrive in the great industry age with practical tips.',NULL,NULL,NULL,NULL,NULL,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(2,'Teamwork as a team is the best way to do the job','teamwork-as-a-team-is-the-best-way-to-do-the-job','Why collaboration beats working alone every time.','<p>Your of because were progress the first are of times screen. The of carried shudder.</p>',NULL,'Daniel Zedda','Author',NULL,NULL,'[\"Teamwork\",\"Tips\"]','2026-07-04 02:44:50',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(3,'Work as efficient as you can to make things a lot easier','work-as-efficient-as-you-can','Efficiency strategies for modern teams.','<p>Tickets no would or was past, behind future have be his I tone maybe had of in together were the with same decided put not allpowerful create rationalize it at to should, relief.</p>',NULL,'Daniel Zedda','Author',NULL,NULL,NULL,'2026-07-08 02:44:50',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(4,'A tidy workplace is always making it more enjoyable','a-tidy-workplace-is-always-making-it-more-enjoyable','Organization tips for a productive workspace.','<p>For and any counter. Too had means, his films experience a in nor be different and when show I point the then.</p>',NULL,'Daniel Zedda','Author',NULL,NULL,NULL,'2026-07-10 02:44:50',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-11 02:44:50','2026-07-11 02:44:50');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_logos`
--

DROP TABLE IF EXISTS `client_logos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_logos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_logos`
--

LOCK TABLES `client_logos` WRITE;
/*!40000 ALTER TABLE `client_logos` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_logos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `location` enum('header','footer') NOT NULL,
  `link_type` enum('page','custom') NOT NULL,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_page_id_foreign` (`page_id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (38,'Home','header','page',10,NULL,NULL,1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(39,'Project','header','custom',NULL,'#',NULL,2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(40,'Service','header','page',12,NULL,NULL,3,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(41,'About','header','custom',NULL,'#',NULL,4,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(42,'Blog','header','page',13,NULL,NULL,5,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(43,'Contact','header','page',14,NULL,NULL,6,1,'2026-07-11 02:44:50','2026-07-11 03:35:47'),(44,'Referral Service Management','footer','custom',NULL,'/services/referral-service-management',NULL,1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(45,'Personal Service Development','footer','custom',NULL,'/services/personal-service-development',NULL,2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(46,'Strategy Business Management','footer','custom',NULL,'/services/strategy-business-management',NULL,3,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(47,'Partnership Quality Member','footer','custom',NULL,'/services/partnership-quality-member',NULL,4,1,'2026-07-11 02:44:50','2026-07-11 02:44:50');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_16_104144_create_site_settings_table',1),(5,'2025_12_16_104145_create_pages_table',1),(6,'2025_12_16_104146_create_page_sections_table',1),(7,'2025_12_16_104146_create_services_table',1),(8,'2025_12_16_104147_create_client_logos_table',1),(9,'2025_12_16_104147_create_testimonials_table',1),(10,'2025_12_16_104148_create_leads_table',1),(11,'2025_12_16_104149_create_menus_table',1),(12,'2025_12_16_124523_add_our_services_to_page_sections_type_enum',1),(13,'2025_12_16_175318_add_who_we_are_to_page_sections_type_enum',1),(14,'2025_12_16_180243_add_trusted_partner_to_page_sections_type_enum',1),(15,'2026_07_10_000001_add_use_new_layout_to_pages_table',1),(16,'2026_07_11_000001_create_section_types_table',1),(17,'2026_07_11_000002_prepare_new_design_schema',1),(18,'2026_07_11_000003_add_use_irhas_layout_to_pages_table',2),(19,'2026_07_11_000004_extend_services_table_for_detail_page',3),(20,'2026_07_11_000005_create_service_categories_table',4),(21,'2026_07_11_000006_create_blog_tables',5),(22,'2026_07_11_000007_extend_site_settings_for_irhas_footer',6),(23,'2026_07_17_000001_add_use_irhas2_layout_to_pages_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sections`
--

DROP TABLE IF EXISTS `page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_sections_page_id_foreign` (`page_id`),
  CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sections`
--

LOCK TABLES `page_sections` WRITE;
/*!40000 ALTER TABLE `page_sections` DISABLE KEYS */;
INSERT INTO `page_sections` VALUES (39,12,'irhas-services-list','{\"banner_eyebrow\":\"Service\",\"banner_title\":\"What We Have.\",\"default_card_image\":\"img\\/service-1-service-page-irhas-3.png\",\"contact_title\":\"We have 24 years experience in Digital Agency\",\"contact_description\":\"Have just introduced pane, go when or over were this the it human who assignment. To concepts.\",\"contact_button_text\":\"Contact Us\",\"contact_button_url\":\"\\/contact\"}',2,1,'2026-07-11 02:44:50','2026-07-17 07:22:59'),(40,13,'irhas-blog-list','{\"banner_eyebrow\":\"Blog\",\"banner_title\":\"Our Journal\"}',2,1,'2026-07-11 02:44:50','2026-07-17 07:22:59'),(41,10,'irhas-about','{\"eyebrow\":\"WELCOME TO IRHAS\",\"title\":\"Crafting Digital Experiences\",\"description\":\"A rationale of few he language continues sign roasted detailed gain, objects out I so the up date defined was of once him, was a read is to our the him, guest editorials.\",\"button_text\":\"Discover More\",\"button_url\":\"#\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=BsafeSHN_II\",\"video_poster\":\"img\\/img-video-irhas3.png\",\"secondary_image\":\"img\\/smartobject4-origin.png\"}',1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(42,10,'irhas-portfolio','{\"eyebrow\":\"Our Project\",\"title\":\"Completed Projects\",\"description\":\"Trusted rationale with it live stairs is found anyone horrible mild, be to where dreams, live the devious insidious a and be he\'d entered be much sleepiness his the all arches to their dry dressing to over valuable.\",\"button_text\":\"View All Projects\",\"button_url\":\"#\",\"items\":[{\"title\":\"Future Program Business\",\"category\":\"Marketing\",\"excerpt\":\"Bed on excessive of alphabet design of our in...\",\"image\":\"img\\/project-1-irhas3.png\",\"link\":\"#\"},{\"title\":\"Management Audit Business\",\"category\":\"Additional\",\"excerpt\":\"Bed on excessive of alphabet design of our in...\",\"image\":\"img\\/project-1-irhas3.png\",\"link\":\"#\"},{\"title\":\"Corporation Those Investors\",\"category\":\"Additional\",\"excerpt\":\"Bed on excessive of alphabet design of our in...\",\"image\":\"img\\/project-1-irhas3.png\",\"link\":\"#\"},{\"title\":\"Limited Liability Company\",\"category\":\"Journey\",\"excerpt\":\"Bed on excessive of alphabet design of our in...\",\"image\":\"img\\/project-1-irhas3.png\",\"link\":\"#\"}]}',2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(43,10,'irhas-services','{\"eyebrow\":\"Service\",\"title\":\"What We Can Do\",\"description\":\"Ever starting it the them it caught parameters ever would as to thousands consider sentences gradual great studies the in and each enough state immense is.\",\"button_text\":\"View all service\",\"button_url\":\"\\/services\",\"items\":[{\"title\":\"Referral Service Management\",\"category\":\"government\",\"image\":\"img\\/service-3-irhas3.png\",\"link\":\"\\/services\\/referral-service-management\"},{\"title\":\"Personal Service Development\",\"category\":\"creative\",\"image\":\"img\\/service-3-irhas3.png\",\"link\":\"\\/services\\/personal-service-development\"},{\"title\":\"Strategy Business Management\",\"category\":\"creative\",\"image\":\"img\\/service-3-irhas3.png\",\"link\":\"\\/services\\/strategy-business-management\"},{\"title\":\"Partnership Quality Member\",\"category\":\"adversitising\",\"image\":\"img\\/service-3-irhas3.png\",\"link\":\"\\/services\\/partnership-quality-member\"}]}',3,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(44,10,'irhas-testimonial','{\"eyebrow\":\"Testimonial\",\"title\":\"What Our Clients Say.\",\"title_mobile\":\"What Our Client Says\",\"description\":\"Ever starting it the them it caught parameters ever would as to thousands consider sentences gradual great studies the in and each enough state immense is.\",\"button_text\":\"Contact Us\",\"button_url\":\"#\",\"side_image\":\"img\\/smartobject5.png\",\"items\":[{\"author\":\"Winston Churchill\",\"job\":\"Client\",\"quote\":\"Particularly to tone on the are seen, cheerful, you him this period, have to to audience.\"},{\"author\":\"Richard Bronson\",\"job\":\"Client\",\"quote\":\"Particularly to tone on the are seen, cheerful, you him this period, have to to audience.\"}]}',4,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(45,10,'irhas-counter','{\"items\":[{\"prefix\":\"\",\"suffix\":\"\",\"number\":\"129847\",\"label\":\"Clients from 60 Countries\"},{\"prefix\":\"$\",\"suffix\":\"\",\"number\":\"796882\",\"label\":\"in Average Saving\"},{\"prefix\":\"\",\"suffix\":\"%\",\"number\":\"89\",\"label\":\"Client Recommend\"}]}',5,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(46,10,'irhas-blog','{\"eyebrow\":\"Our Blog\",\"title\":\"Latest News\",\"posts_limit\":\"4\",\"view_all_text\":\"View All Posts\",\"view_all_url\":\"\\/blog\"}',6,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(47,11,'new-design-privacy-hero','{\"background_image_url\":\"https:\\/\\/clean-air.ae\\/uploads\\/banner-area-background.png\",\"background_image_source\":\"url\",\"title\":\"Privacy Policy\",\"updated_text\":\"Last Updated: June 2026\",\"description\":\"At Clean Air by Renovation Hub (\\\"Clean Air\\\", \\\"we\\\", \\\"our\\\", or \\\"us\\\"), we respect your privacy and are committed to protecting your personal information.\"}',1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(48,11,'new-design-privacy-content','{\"blocks\":[]}',2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(49,14,'irhas-contact','{\"eyebrow\":\"Contact Us\",\"title\":\"Get in touch\",\"map_embed_url\":\"https:\\/\\/maps.google.com\\/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&t=m&z=18&output=embed&iwloc=near\",\"weekday_hours\":\"MON-FRI 09:00 \\u2013 19:00\",\"weekend_hours\":\"SAT-SUN 10:00 \\u2013 14:00\",\"submit_button_text\":\"Send Message\"}',2,1,'2026-07-11 03:35:47','2026-07-17 07:27:10'),(57,12,'irhas-page-banner','{\"eyebrow\":\"Service\",\"title\":\"What We Have.\",\"background_image\":\"img\\/banner-header-service.png\"}',1,1,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(58,13,'irhas-page-banner','{\"eyebrow\":\"Blog\",\"title\":\"Our Journal\",\"background_image\":\"img\\/banner-header-service.png\"}',1,1,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(59,15,'irhas2-hero','{\"eyebrow\":\"Welcome To Irhas\",\"title\":\"Crafting Digital Experiences\",\"description\":\"ransmitting expand quite was success make ocean. As little did even in and forest the as it to of to we\'ve that on or unrecognisable. Even the are right activity should, effort from details much systems led house. Admittance.\",\"button_text\":\"Discover More\",\"button_url\":\"#\",\"background_image\":\"img\\/hero-image.png\"}',1,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(60,15,'irhas2-features','{\"eyebrow\":\"Welcome To Irhas\",\"title\":\"what we have\",\"description\":\"Rendering of children purer himself safely the what proposal come omens, ever can a something at could and forth. Long and the at away to ruining the cons.\",\"items\":[{\"title\":\"Multiple Concept\",\"excerpt\":\"Back have focuses merit of by but that him it with worthy down this to about able like greediness absolutely samples else\",\"image\":\"img\\/img-home-gif-1.png\"},{\"title\":\"Perfect Code Like a Niche\",\"excerpt\":\"Minutes. Attained brief. The of human I in that too out small many not contribution had the them. Over be last goals the her into like told two.\",\"image\":\"img\\/img-home-gif-1.png\"},{\"title\":\"Multi Language Theme\",\"excerpt\":\"My about proportion if even the evening separated post I area transactions to wouldn\'t many advised day twice play\",\"image\":\"img\\/img-home-gif-1.png\"}]}',2,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(61,15,'irhas2-portfolio','{\"eyebrow\":\"Our Projects\",\"title\":\"Completed Projects\",\"description\":\"She cold the writer many the in safely to funny travelling to years for funds of front up free and in even its may afloat.\",\"button_text\":\"View All Projects\",\"button_url\":\"#\",\"read_more_text\":\"Learn More\",\"items\":[{\"title\":\"Future Program Business\",\"category\":\"marketing\",\"excerpt\":\"There their hazardous because a proportion the that note...\",\"image\":\"img\\/img-project-irhas2.png\",\"link\":\"#\"},{\"title\":\"Management Audit Business\",\"category\":\"additional\",\"excerpt\":\"To in the well rationale sat the destruction. The...\",\"image\":\"img\\/img-project-irhas2.png\",\"link\":\"#\"},{\"title\":\"Corporation Those Investors\",\"category\":\"additional\",\"excerpt\":\"Approved tone think good stitching down of concepts we\'ve...\",\"image\":\"img\\/img-project-irhas2.png\",\"link\":\"#\"},{\"title\":\"Limited Liability Company\",\"category\":\"journey\",\"excerpt\":\"Made so attention flatter were is he boss the...\",\"image\":\"img\\/img-project-irhas2.png\",\"link\":\"#\"}]}',3,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(62,15,'irhas2-about-video','{\"eyebrow\":\"Since 2008\",\"title\":\"We\'re a creative branding and communications company of creative thinkers,\",\"quote\":\"Derived we but in who muff policeman, family building and would if concept turn pretty its perfected\",\"description\":\"In have seven relays little mechanic. For should world; Encourage like the derisively how range writers.\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=BsafeSHN_II\",\"video_poster\":\"img\\/img-video-irhas-2.png\",\"secondary_image\":\"img\\/smartobject.png\"}',4,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(63,15,'irhas2-team','{\"eyebrow\":\"Meet The Team\",\"title\":\"Our Best People\",\"description\":\"something to and a accordingly the real subject more long answer distance devious get stands conduct, continued reasoning of still spends completely our researches his want beginning failures it particular mellower tone.\",\"button_text\":\"Meet All People\",\"button_url\":\"#\",\"items\":[{\"name\":\"Michel Groch\",\"role\":\"Director\",\"image\":\"img\\/img-team-1- irhas2.png\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\"},{\"name\":\"Adel Kovacs\",\"role\":\"Operations manager\",\"image\":\"img\\/img-team-1- irhas2.png\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\"},{\"name\":\"Joseph George\",\"role\":\"Senior Leasing Executive\",\"image\":\"img\\/img-team-1- irhas2.png\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\"},{\"name\":\"Michelle McCoy\",\"role\":\"Leasing Executive\",\"image\":\"img\\/img-team-1- irhas2.png\",\"facebook\":\"#\",\"twitter\":\"#\",\"linkedin\":\"#\"}]}',5,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(64,15,'irhas2-testimonial','{\"eyebrow\":\"Testimonial\",\"title\":\"What Our Clients Say.\",\"items\":[{\"quote\":\"Starting of owner me dressing forest step arduous a what\'s most a from can to farther are\",\"author\":\"Adam Lancaster\",\"job\":\"Global L&D Partner, TVC Marketing\",\"logo\":\"img\\/testimonial-img-logo-1.png\"},{\"quote\":\"Thing live safe one mountains, would, aged get your better retired, cache doctor when and build quite\",\"author\":\"Adam Lancaster\",\"job\":\"Global L&D Partner, TVC Marketing\",\"logo\":\"img\\/testimonial-img-logo-1.png\"},{\"quote\":\"create the home, as more to and, may particular, right which of respond taken was stupid circles with to concepts\",\"author\":\"Adam Lancaster\",\"job\":\"Global L&D Partner, TVC Marketing\",\"logo\":\"img\\/testimonial-img-logo-1.png\"}]}',6,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(65,15,'irhas2-blog','{\"eyebrow\":\"Our Blog\",\"title\":\"Latest News\",\"posts_limit\":\"3\",\"default_image\":\"img\\/img-latest-news-1-irhas-2.png\"}',7,1,'2026-07-17 07:24:50','2026-07-17 07:24:50'),(66,14,'irhas-page-banner','{\"eyebrow\":\"Contact\",\"title\":\"Get In Touch\",\"background_image\":\"img\\/banner-header-service.png\"}',1,1,'2026-07-17 07:27:10','2026-07-17 07:27:10');
/*!40000 ALTER TABLE `page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `use_new_layout` tinyint(1) NOT NULL DEFAULT 0,
  `use_irhas_layout` tinyint(1) NOT NULL DEFAULT 0,
  `use_irhas2_layout` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (10,'Home','home','Irhas | Crafting Digital Experiences','Irhas Home 3 — Crafting Digital Experiences.',NULL,'published',0,1,0,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(11,'Privacy Policy','privacy-policy','Privacy Policy - Irhas','Privacy Policy for Irhas.',NULL,'published',1,0,0,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(12,'Services','services','Our Services - Irhas','Browse all services offered by Irhas. Professional solutions for your business.','services, irhas, business services','published',0,1,0,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(13,'Blog','blog','Our Blog - Irhas','Latest news, tips and insights from Irhas.','blog, news, irhas, tips','published',0,1,0,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(14,'Contact','contact','Contact Us - Irhas','Get in touch with Irhas.',NULL,'published',0,1,0,'2026-07-11 03:35:47','2026-07-11 03:35:47'),(15,'Home 2','home2','Home 2 - Irhas','Irhas Home 2 layout page.',NULL,'published',0,0,1,'2026-07-17 07:22:59','2026-07-17 07:22:59');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_types`
--

DROP TABLE IF EXISTS `section_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_types`
--

LOCK TABLES `section_types` WRITE;
/*!40000 ALTER TABLE `section_types` DISABLE KEYS */;
INSERT INTO `section_types` VALUES (39,'Irhas - About','irhas-about',NULL,'Irhas - About section.',1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(40,'Irhas - Portfolio','irhas-portfolio',NULL,'Irhas - Portfolio section.',1,2,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(41,'Irhas - Services','irhas-services',NULL,'Irhas - Services section.',1,3,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(42,'Irhas - Testimonial','irhas-testimonial',NULL,'Irhas - Testimonial section.',1,4,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(43,'Irhas - Counter','irhas-counter',NULL,'Irhas - Counter section.',1,5,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(44,'Irhas - Blog','irhas-blog',NULL,'Irhas - Blog section.',1,6,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(45,'Irhas - All Services Page','irhas-services-list',NULL,'Irhas - All Services Page section.',1,7,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(46,'Irhas - All Blog Posts Page','irhas-blog-list',NULL,'Irhas - All Blog Posts Page section.',1,8,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(47,'New design - Privacy Hero','new-design-privacy-hero',NULL,'New design - Privacy Hero section.',1,9,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(48,'New design - Privacy Content','new-design-privacy-content',NULL,'New design - Privacy Content section.',1,10,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(49,'Irhas - Contact Page','irhas-contact',NULL,'Irhas contact page section.',1,99,'2026-07-11 03:35:47','2026-07-11 03:35:47'),(50,'Irhas - Page Top Banner','irhas-page-banner',NULL,'Irhas - Page Top Banner section.',1,100,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(51,'Home2 - Hero','irhas2-hero',NULL,'Home2 - Hero section.',1,101,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(52,'Home2 - Features','irhas2-features',NULL,'Home2 - Features section.',1,102,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(53,'Home2 - Portfolio','irhas2-portfolio',NULL,'Home2 - Portfolio section.',1,103,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(54,'Home2 - About Video','irhas2-about-video',NULL,'Home2 - About Video section.',1,104,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(55,'Home2 - Team','irhas2-team',NULL,'Home2 - Team section.',1,105,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(56,'Home2 - Testimonial','irhas2-testimonial',NULL,'Home2 - Testimonial section.',1,106,'2026-07-17 07:22:59','2026-07-17 07:22:59'),(57,'Home2 - Blog','irhas2-blog',NULL,'Home2 - Blog section.',1,107,'2026-07-17 07:22:59','2026-07-17 07:22:59');
/*!40000 ALTER TABLE `section_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (4,'Government','government',NULL,1,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(5,'Creative','creative',NULL,2,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(6,'Advertising','advertising',NULL,3,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(7,'Marketing','marketing',NULL,4,1,'2026-07-11 02:44:50','2026-07-11 02:44:50');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `service_category_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `content_image` varchar(255) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `features_section_title` varchar(255) DEFAULT NULL,
  `accordions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`accordions`)),
  `brochure_doc_url` varchar(255) DEFAULT NULL,
  `brochure_pdf_url` varchar(255) DEFAULT NULL,
  `sidebar_testimonials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sidebar_testimonials`)),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_service_category_id_foreign` (`service_category_id`),
  CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (9,'Referral Service Management','referral-service-management',4,NULL,'The safe he to for the calculus tone the continued too a long occupied front are I feedback.','<p>With our of maybe few forwards, five nor treat were far getting he allowed sentences leaving because not her to business, myself is agency the been in alarm someone hired those much would arrange had reedy.</p><p>With distance by synthesizers films now, half and, and have to the phase word fundamentals just beings all and by intermixing if village phase turner as with typically that and subjective poverty he place watching lowest avoided sleep no to of nothing just but this reassuring destined evils harder universal for room.</p>',NULL,NULL,NULL,NULL,'2020-07-27',1,'We are Establish Company for It Business','[{\"title\":\"Best For Consulting\",\"content\":\"You who we\'ve saw of to and get would to and among we presented that a to the legs, however problem. With we a by generally at are duties a not in yet on researches picture luxury.\"},{\"title\":\"Security Systems\",\"content\":\"Distance, just voices from bidding of transactions imitation; Of on not ability mountains, his was have much I either there she suspicious her honour.\"},{\"title\":\"Digital Solutions Agency\",\"content\":\"Employed parents to much height real of should is but between the rome; Out that, white room it after that the instead for different last analyzed each handwriting abundantly.\"}]',NULL,NULL,'[{\"author\":\"Cristopher Halsey\",\"job\":\"Assistant\",\"quote\":\"For and any counter. Too had means, his films experience a in nor be different and when show I point the then, and learn planning poster show she recommended.\",\"image\":\"img\\/testimonial-profile.png\"},{\"author\":\"Eliana Chapman\",\"job\":\"Digital Designer\",\"quote\":\"Your of because were progress the first are of times screen. The of carried shudder.\",\"image\":\"img\\/testimonial-profile.png\"}]','Referral Service Management - Irhas','Professional referral service management solutions by Irhas.',NULL,NULL,NULL,NULL,NULL,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(10,'Personal Service Development','personal-service-development',5,NULL,'Personal service development tailored for creative businesses.','<p>Ever starting it the them it caught parameters ever would as to thousands consider sentences gradual great studies.</p>',NULL,NULL,NULL,NULL,'2026-07-11',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(11,'Strategy Business Management','strategy-business-management',5,NULL,'Strategy and business management consulting services.','<p>Strategy business management for growing companies and startups.</p>',NULL,NULL,NULL,NULL,'2026-07-11',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2026-07-11 02:44:50','2026-07-11 02:44:50'),(12,'Partnership Quality Member','partnership-quality-member',6,NULL,'Partnership quality member programs for your organization.','<p>Build quality partnerships with our member programs.</p>',NULL,NULL,NULL,NULL,'2026-07-11',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2026-07-11 02:44:50','2026-07-11 02:44:50');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('09nsCppkXQJfFycIoqW4d2mpHgrKoq3UKnqYOVcd',5,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGM4R0RxcGdzYXRyN0loNERUZWFXc21hUlJxcGpTYkFLS2NFRUZsMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9hZG1pbi9wYWdlcy9ob21lMi9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9',1784385571),('0cw8SmlAhuPcGjfb3RS6TPAjFXqyYya7MGYyv0UD',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibUtJZlY5a2FOZEhhdXRBVVNEWkhzNUN0T3BXV20wUlMxaDhYUE9yTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9zZXJ2aWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784291090),('4qa6ljyzft3JkJGpNkmHjFrFAsp81ocwZMjELMKH',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTNvdFFvbDZjbTd5M01XRVZNbHplQUpVMUZQQ0NRSE9xQWlvWmxpMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMi9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784300391),('9P7cZW46gkn6aseITpkR4FLWJjDCJVohQXr6ewmg',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFFaZDFlamhVWWR4eG1IUzFvTDIzbWtYWlBZWjUwdTY3bG94ZThxVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784291090),('A1jhVZh7OJb6WvHT0YA1HqvlWZdQFdw5qda64ggd',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXdjUFd2RTByZFdrdmE1bkQydEI2c25ldTRpbmZjRTBhUmI3ZUpxUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784385387),('BF8FCqF1rGUXQ8L2kPwxQtYK7adlbUcvuc66vfuo',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Cursor/3.7.12 Chrome/142.0.7444.265 Electron/39.8.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEFCWU1yWlhqcXU1eXptVjlwZWJSZVZ4RlFlZTZhNEdUUFljd1FSaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784290027),('ECpkOm98keyFtVaWoNf4lJp7SvZMP3DJnbC7Y1EG',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Cursor/3.7.12 Chrome/142.0.7444.265 Electron/39.8.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiODVNdDhmQ2hGMUFRajVoSnhmQ2lOMHM1ZlRQMGtUQUNKcEVOMVBCbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784385484),('EGkb2dafoq8cW37c1P5gUn2WJ6Swmpp0vYp7H7f7',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibEh4ZXNneUplaDJYNjJrMFdEZWRNRklmNlZ3MktpYlZyaG5Ma1NUNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ibG9nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1784291090),('FRciGBqQxPuqpbBjXgMSGbryudUQCeiv6ETb9NAW',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVA4dDBCMTNNVVY3Qmt5eUlxVDdmUE5XT1ljN2RPUkFjR2doRW9CQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784385456),('HaHxjfkqWpr0CvYSvzQr9IKZTSYNdngOBorXb0CP',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmg5dHZSTW9CTDY0dzVwMmZKMTI3NmJDekJYUjh1QjJnOUVXWm5WSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784290542),('ibQLySzoHFLwKr7uVNpT0Ej2ur0wUmOXLQXHry7I',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHhZRk9wd2NIMTFUc1VRWk15Szd0Rmd4QXZNa0tYME1mRzNmVjNGTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784289849),('IrvjOA1nr6J3HUjBJSpD1PKctO2W3VkgRzT9GNBI',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoicFRkc0dmbUtteWVJYzRvVllOeWJWWmhGVU5MNUZkWUs2cnBRa2xtRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1784291190),('MO5lsMeoN5eZXr1cS1QQqc8A79wfImXmKvFTiWpu',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmpudklBaDhUaklBNXY4VVJQMmlmOWhzd1JHVWdUV29DaXZVWUFVMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1784291230),('N7V7oSlyrJQjBdZT7lzYygSAE7LVHTog5l2N10Ob',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWNYMEFHVVB2d1B3M1JXUGpYbTNpbWF5eWswc0FXenBjc1d6Yk5JcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784290979),('OYoWRvT0fNxu3ebzCPZ4nyQsfLHjlUUmeL3UUd6J',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUpuZnlMSnYwSUNuQ3B5bzJyRlB5Y2xoSEdRRTdIcW1KS01iRVpybyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784385387),('PFzu04zuDG02KxMD4GwgoHaAAtCQPue6ZxV1mIjB',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoibzRnVTZoRU54cGhKYWNpUGwwQ3dFTG9OdTFhRjJmekFNbmtobFZLQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ibG9nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1784290979),('PwnZIvTZtujCu4yi7P7fJDgVzrDdX6gAy1KWUSLh',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzc1bFNyNGE0Y1RmYjhSNllEOGN1SllXWEtaZnhqRHBvNHpGMTR4bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784385467),('qm7nSXPjrX1XmWphc9PoxknaRDBqq6dMDxsgAZLz',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlk4UVRBbWNCblZWVE51MGtEaG9ub05MMXlDbERKeHVGVTVxdXFFRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784290979),('RzMTlJ8ls7UA0D4ksxG9p90T7ymHBHVcQXd2tIQZ',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Cursor/3.7.12 Chrome/142.0.7444.265 Electron/39.8.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUtoMnJ0dmdqang5aXh3bjA0dFBLNTVHQjlZZWg4V1BKRThmZEUwcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784363531),('UQA88aV8N08ISl297kRFWXj4jiF3ll6ObFlPFr2P',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUxoYmNJNTB3N1dXNm5kcnVabmNhRUhjSjFZeVZxSVRDcUZsbG9ZVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9ob21lMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784291090),('w3rxFJoEXfvtLJ8m3jhYxZ4UlXgVLBN3WOfh3Lb4',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoieEVaU2hPbjRPNU4zd3hVcjM1YlozdmhDMUlLdmpSRWdqaU55VWM2ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784289874),('WONzN3vZ5tFcpyJV0fR7UQpyBAfvQtRJAB5mhspv',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2VtUEVWWDI5cWtLTVdhbzkwdnB2YTVZVWV0OTFzYmRJTEl6M0pDSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1784291190),('wWS0w5CLzSF7CV9zxUr5xpNQn651FNwVHRnXyRNi',5,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmdadWFyY3VJVk1LM0NIdVhpUUpET2ZFbU8zQTdHZVpoTFZZaDVFYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9hZG1pbi9zZWN0aW9uLXR5cGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9',1784290596),('ZLjhZVduNpNTE07pOX2bFueHow9EtlBroiC3VPgu',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVFYREdJb3dMZHNYd2FEbWZYZUVhWFh2T3Y4ME9jc2RsdEhmUHpGYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9zZXJ2aWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1784290979);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `header_phone` varchar(255) DEFAULT NULL,
  `header_email` varchar(255) DEFAULT NULL,
  `site_address` text DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `header_cta_text` varchar(255) DEFAULT NULL,
  `header_cta_link` varchar(255) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `seo_google_verification` varchar(100) DEFAULT NULL,
  `seo_gtm_id` varchar(50) DEFAULT NULL,
  `seo_gtag_id` varchar(50) DEFAULT NULL,
  `seo_default_meta_description` text DEFAULT NULL,
  `seo_default_meta_keywords` text DEFAULT NULL,
  `seo_og_image` varchar(255) DEFAULT NULL,
  `seo_schema_json` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_pro_clean_blue` varchar(7) DEFAULT NULL,
  `color_pro_clean_red` varchar(7) DEFAULT NULL,
  `color_primary_1` varchar(7) DEFAULT NULL,
  `color_primary_2` varchar(7) DEFAULT NULL,
  `color_primary_3` varchar(7) DEFAULT NULL,
  `color_gray_1` varchar(7) DEFAULT NULL,
  `color_gray_2` varchar(7) DEFAULT NULL,
  `color_gray_3` varchar(7) DEFAULT NULL,
  `color_gray_4` varchar(7) DEFAULT NULL,
  `color_white` varchar(7) DEFAULT NULL,
  `color_success` varchar(7) DEFAULT NULL,
  `color_warning` varchar(7) DEFAULT NULL,
  `color_danger` varchar(7) DEFAULT NULL,
  `color_lime_green` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (5,'Irhas','uploads/site/6a51f88067cf3-youtube-play.png',NULL,'+62 800 1402','info@irhas.com',NULL,NULL,'Get Started','http://127.0.0.1:8000/admin/settings','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore. Nam tincidunt, tellus quis maximus consequat. et malesuada nibh lorem vel.','[]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-11 02:44:50','2026-07-11 03:02:08','#00237d','#fdaa90','#fdaa90','#00237d','#81a094','#2c2d36','#e2e2e2','#f9f5ec','#ffffff','#ffffff','#559866','#eaa235','#dc3545','#25d366');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Admin','admin@clean-air.ae','2026-07-11 02:44:50','$2y$12$TqhTBzHM6L7nbNRk47eJVuLwXAQl0h1XNWnUs.uvodmc4.54MRHxS',NULL,'2026-07-11 02:44:50','2026-07-17 07:15:28');
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

-- Dump completed on 2026-07-18 19:40:05
