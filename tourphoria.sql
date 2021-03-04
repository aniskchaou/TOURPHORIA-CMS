-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 09:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourphoria`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_actionscheduler_actions`
--

CREATE TABLE `wp_actionscheduler_actions` (
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `hook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduled_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `args` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_attempt_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `extended_args` varchar(8000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_actionscheduler_actions`
--

INSERT INTO `wp_actionscheduler_actions` (`action_id`, `hook`, `status`, `scheduled_date_gmt`, `scheduled_date_local`, `args`, `schedule`, `group_id`, `attempts`, `last_attempt_gmt`, `last_attempt_local`, `claim_id`, `extended_args`) VALUES
(22, 'action_scheduler/migration_hook', 'complete', '2021-02-26 18:24:24', '2021-02-26 18:24:24', '[]', 'O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1614363864;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1614363864;}', 1, 1, '2021-02-26 18:24:25', '2021-02-26 18:24:25', 0, NULL),
(23, 'action_scheduler/migration_hook', 'complete', '2021-02-27 22:57:10', '2021-02-27 22:57:10', '[]', 'O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1614466630;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1614466630;}', 1, 1, '2021-02-27 22:57:39', '2021-02-27 22:57:39', 0, NULL),
(24, 'action_scheduler/migration_hook', 'complete', '2021-02-27 22:58:39', '2021-02-27 22:58:39', '[]', 'O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1614466719;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1614466719;}', 1, 1, '2021-02-27 22:58:51', '2021-02-27 22:58:51', 0, NULL),
(25, 'action_scheduler/migration_hook', 'complete', '2021-02-27 23:06:25', '2021-02-27 23:06:25', '[]', 'O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1614467185;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1614467185;}', 1, 1, '2021-02-27 23:06:46', '2021-02-27 23:06:46', 0, NULL),
(26, 'action_scheduler/migration_hook', 'complete', '2021-02-27 23:07:46', '2021-02-27 23:07:46', '[]', 'O:30:\"ActionScheduler_SimpleSchedule\":2:{s:22:\"\0*\0scheduled_timestamp\";i:1614467266;s:41:\"\0ActionScheduler_SimpleSchedule\0timestamp\";i:1614467266;}', 1, 1, '2021-02-27 23:07:49', '2021-02-27 23:07:49', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_actionscheduler_claims`
--

CREATE TABLE `wp_actionscheduler_claims` (
  `claim_id` bigint(20) UNSIGNED NOT NULL,
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_actionscheduler_groups`
--

CREATE TABLE `wp_actionscheduler_groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_actionscheduler_groups`
--

INSERT INTO `wp_actionscheduler_groups` (`group_id`, `slug`) VALUES
(1, 'action-scheduler-migration');

-- --------------------------------------------------------

--
-- Table structure for table `wp_actionscheduler_logs`
--

CREATE TABLE `wp_actionscheduler_logs` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_actionscheduler_logs`
--

INSERT INTO `wp_actionscheduler_logs` (`log_id`, `action_id`, `message`, `log_date_gmt`, `log_date_local`) VALUES
(1, 22, 'action created', '2021-02-26 18:23:24', '2021-02-26 18:23:24'),
(2, 22, 'action started via WP Cron', '2021-02-26 18:24:25', '2021-02-26 18:24:25'),
(3, 22, 'action complete via WP Cron', '2021-02-26 18:24:25', '2021-02-26 18:24:25'),
(4, 23, 'action created', '2021-02-27 22:56:10', '2021-02-27 22:56:10'),
(5, 23, 'action started via WP Cron', '2021-02-27 22:57:39', '2021-02-27 22:57:39'),
(6, 23, 'action complete via WP Cron', '2021-02-27 22:57:39', '2021-02-27 22:57:39'),
(7, 24, 'action created', '2021-02-27 22:57:39', '2021-02-27 22:57:39'),
(8, 24, 'action started via Async Request', '2021-02-27 22:58:51', '2021-02-27 22:58:51'),
(9, 24, 'action complete via Async Request', '2021-02-27 22:58:51', '2021-02-27 22:58:51'),
(10, 25, 'action created', '2021-02-27 23:05:25', '2021-02-27 23:05:25'),
(11, 25, 'action started via WP Cron', '2021-02-27 23:06:46', '2021-02-27 23:06:46'),
(12, 25, 'action complete via WP Cron', '2021-02-27 23:06:46', '2021-02-27 23:06:46'),
(13, 26, 'action created', '2021-02-27 23:06:46', '2021-02-27 23:06:46'),
(14, 26, 'action started via WP Cron', '2021-02-27 23:07:49', '2021-02-27 23:07:49'),
(15, 26, 'action complete via WP Cron', '2021-02-27 23:07:49', '2021-02-27 23:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2021-02-26 14:59:13', '2021-02-26 14:59:13', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', 'comment', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_hotel_room`
--

CREATE TABLE `wp_hotel_room` (
  `post_id` int(11) DEFAULT NULL,
  `room_parent` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_full_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/tourphoria', 'yes'),
(2, 'home', 'http://localhost/tourphoria', 'yes'),
(3, 'blogname', 'tourphoria', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'kchaouanis26@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:353:{s:10:\"/([^/]+)?$\";s:34:\"index.php?pagename=&sc=$matches[1]\";s:27:\"/([^/]+)/page/([0-9]{1,})?$\";s:52:\"index.php?pagename=&sc=$matches[1]&paged=$matches[2]\";s:24:\"^wc-auth/v([1]{1})/(.*)?\";s:63:\"index.php?wc-auth-version=$matches[1]&wc-auth-route=$matches[2]\";s:22:\"^wc-api/v([1-3]{1})/?$\";s:51:\"index.php?wc-api-version=$matches[1]&wc-api-route=/\";s:24:\"^wc-api/v([1-3]{1})(.*)?\";s:61:\"index.php?wc-api-version=$matches[1]&wc-api-route=$matches[2]\";s:7:\"shop/?$\";s:27:\"index.php?post_type=product\";s:37:\"shop/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:32:\"shop/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:24:\"shop/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=product&paged=$matches[1]\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:14:\"st_location/?$\";s:28:\"index.php?post_type=location\";s:44:\"st_location/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=location&feed=$matches[1]\";s:39:\"st_location/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?post_type=location&feed=$matches[1]\";s:31:\"st_location/page/([0-9]{1,})/?$\";s:46:\"index.php?post_type=location&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:32:\"category/(.+?)/wc-api(/(.*))?/?$\";s:54:\"index.php?category_name=$matches[1]&wc-api=$matches[3]\";s:38:\"category/(.+?)/social-login(/(.*))?/?$\";s:60:\"index.php?category_name=$matches[1]&social-login=$matches[3]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:29:\"tag/([^/]+)/wc-api(/(.*))?/?$\";s:44:\"index.php?tag=$matches[1]&wc-api=$matches[3]\";s:35:\"tag/([^/]+)/social-login(/(.*))?/?$\";s:50:\"index.php?tag=$matches[1]&social-login=$matches[3]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:55:\"product-category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:50:\"product-category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:31:\"product-category/(.+?)/embed/?$\";s:44:\"index.php?product_cat=$matches[1]&embed=true\";s:43:\"product-category/(.+?)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_cat=$matches[1]&paged=$matches[2]\";s:25:\"product-category/(.+?)/?$\";s:33:\"index.php?product_cat=$matches[1]\";s:52:\"product-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:47:\"product-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:28:\"product-tag/([^/]+)/embed/?$\";s:44:\"index.php?product_tag=$matches[1]&embed=true\";s:40:\"product-tag/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_tag=$matches[1]&paged=$matches[2]\";s:22:\"product-tag/([^/]+)/?$\";s:33:\"index.php?product_tag=$matches[1]\";s:35:\"product/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"product/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"product/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"product/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"product/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"product/([^/]+)/embed/?$\";s:40:\"index.php?product=$matches[1]&embed=true\";s:28:\"product/([^/]+)/trackback/?$\";s:34:\"index.php?product=$matches[1]&tb=1\";s:48:\"product/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:43:\"product/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:36:\"product/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&paged=$matches[2]\";s:43:\"product/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&cpage=$matches[2]\";s:33:\"product/([^/]+)/wc-api(/(.*))?/?$\";s:48:\"index.php?product=$matches[1]&wc-api=$matches[3]\";s:39:\"product/([^/]+)/social-login(/(.*))?/?$\";s:54:\"index.php?product=$matches[1]&social-login=$matches[3]\";s:39:\"product/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:50:\"product/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:45:\"product/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:56:\"product/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:32:\"product/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?product=$matches[1]&page=$matches[2]\";s:24:\"product/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"product/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"product/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"product/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"product/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:35:\"st_tour/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:45:\"st_tour/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:65:\"st_tour/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"st_tour/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:60:\"st_tour/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:41:\"st_tour/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:24:\"st_tour/([^/]+)/embed/?$\";s:41:\"index.php?st_tours=$matches[1]&embed=true\";s:28:\"st_tour/([^/]+)/trackback/?$\";s:35:\"index.php?st_tours=$matches[1]&tb=1\";s:36:\"st_tour/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?st_tours=$matches[1]&paged=$matches[2]\";s:43:\"st_tour/([^/]+)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?st_tours=$matches[1]&cpage=$matches[2]\";s:33:\"st_tour/([^/]+)/wc-api(/(.*))?/?$\";s:49:\"index.php?st_tours=$matches[1]&wc-api=$matches[3]\";s:39:\"st_tour/([^/]+)/social-login(/(.*))?/?$\";s:55:\"index.php?st_tours=$matches[1]&social-login=$matches[3]\";s:39:\"st_tour/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:50:\"st_tour/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:45:\"st_tour/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:56:\"st_tour/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:32:\"st_tour/([^/]+)(?:/([0-9]+))?/?$\";s:47:\"index.php?st_tours=$matches[1]&page=$matches[2]\";s:24:\"st_tour/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:34:\"st_tour/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:54:\"st_tour/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"st_tour/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:49:\"st_tour/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:30:\"st_tour/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:53:\"st_tour_type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?st_tour_type=$matches[1]&feed=$matches[2]\";s:48:\"st_tour_type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:51:\"index.php?st_tour_type=$matches[1]&feed=$matches[2]\";s:29:\"st_tour_type/([^/]+)/embed/?$\";s:45:\"index.php?st_tour_type=$matches[1]&embed=true\";s:41:\"st_tour_type/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?st_tour_type=$matches[1]&paged=$matches[2]\";s:23:\"st_tour_type/([^/]+)/?$\";s:34:\"index.php?st_tour_type=$matches[1]\";s:40:\"vc_grid_item/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:50:\"vc_grid_item/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:70:\"vc_grid_item/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"vc_grid_item/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:65:\"vc_grid_item/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:46:\"vc_grid_item/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:29:\"vc_grid_item/([^/]+)/embed/?$\";s:45:\"index.php?vc_grid_item=$matches[1]&embed=true\";s:33:\"vc_grid_item/([^/]+)/trackback/?$\";s:39:\"index.php?vc_grid_item=$matches[1]&tb=1\";s:41:\"vc_grid_item/([^/]+)/page/?([0-9]{1,})/?$\";s:52:\"index.php?vc_grid_item=$matches[1]&paged=$matches[2]\";s:48:\"vc_grid_item/([^/]+)/comment-page-([0-9]{1,})/?$\";s:52:\"index.php?vc_grid_item=$matches[1]&cpage=$matches[2]\";s:38:\"vc_grid_item/([^/]+)/wc-api(/(.*))?/?$\";s:53:\"index.php?vc_grid_item=$matches[1]&wc-api=$matches[3]\";s:44:\"vc_grid_item/([^/]+)/social-login(/(.*))?/?$\";s:59:\"index.php?vc_grid_item=$matches[1]&social-login=$matches[3]\";s:44:\"vc_grid_item/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:55:\"vc_grid_item/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:50:\"vc_grid_item/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:61:\"vc_grid_item/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:37:\"vc_grid_item/([^/]+)(?:/([0-9]+))?/?$\";s:51:\"index.php?vc_grid_item=$matches[1]&page=$matches[2]\";s:29:\"vc_grid_item/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:39:\"vc_grid_item/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:59:\"vc_grid_item/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"vc_grid_item/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:54:\"vc_grid_item/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:35:\"vc_grid_item/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:38:\"mc4wp-form/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:48:\"mc4wp-form/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:68:\"mc4wp-form/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"mc4wp-form/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"mc4wp-form/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:44:\"mc4wp-form/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:27:\"mc4wp-form/([^/]+)/embed/?$\";s:43:\"index.php?mc4wp-form=$matches[1]&embed=true\";s:31:\"mc4wp-form/([^/]+)/trackback/?$\";s:37:\"index.php?mc4wp-form=$matches[1]&tb=1\";s:39:\"mc4wp-form/([^/]+)/page/?([0-9]{1,})/?$\";s:50:\"index.php?mc4wp-form=$matches[1]&paged=$matches[2]\";s:46:\"mc4wp-form/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?mc4wp-form=$matches[1]&cpage=$matches[2]\";s:36:\"mc4wp-form/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?mc4wp-form=$matches[1]&wc-api=$matches[3]\";s:42:\"mc4wp-form/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?mc4wp-form=$matches[1]&social-login=$matches[3]\";s:42:\"mc4wp-form/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:53:\"mc4wp-form/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:48:\"mc4wp-form/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:59:\"mc4wp-form/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:35:\"mc4wp-form/([^/]+)(?:/([0-9]+))?/?$\";s:49:\"index.php?mc4wp-form=$matches[1]&page=$matches[2]\";s:27:\"mc4wp-form/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"mc4wp-form/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"mc4wp-form/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"mc4wp-form/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"mc4wp-form/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"mc4wp-form/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:37:\"st_location/.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"st_location/.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"st_location/.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"st_location/.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"st_location/.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"st_location/.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"st_location/(.+?)/embed/?$\";s:41:\"index.php?location=$matches[1]&embed=true\";s:30:\"st_location/(.+?)/trackback/?$\";s:35:\"index.php?location=$matches[1]&tb=1\";s:50:\"st_location/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?location=$matches[1]&feed=$matches[2]\";s:45:\"st_location/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?location=$matches[1]&feed=$matches[2]\";s:38:\"st_location/(.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?location=$matches[1]&paged=$matches[2]\";s:45:\"st_location/(.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?location=$matches[1]&cpage=$matches[2]\";s:35:\"st_location/(.+?)/wc-api(/(.*))?/?$\";s:49:\"index.php?location=$matches[1]&wc-api=$matches[3]\";s:41:\"st_location/(.+?)/social-login(/(.*))?/?$\";s:55:\"index.php?location=$matches[1]&social-login=$matches[3]\";s:41:\"st_location/.+?/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:52:\"st_location/.+?/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:47:\"st_location/.+?/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:58:\"st_location/.+?/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:34:\"st_location/(.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?location=$matches[1]&page=$matches[2]\";s:57:\"st_location_type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?st_location_type=$matches[1]&feed=$matches[2]\";s:52:\"st_location_type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:55:\"index.php?st_location_type=$matches[1]&feed=$matches[2]\";s:33:\"st_location_type/([^/]+)/embed/?$\";s:49:\"index.php?st_location_type=$matches[1]&embed=true\";s:45:\"st_location_type/([^/]+)/page/?([0-9]{1,})/?$\";s:56:\"index.php?st_location_type=$matches[1]&paged=$matches[2]\";s:27:\"st_location_type/([^/]+)/?$\";s:38:\"index.php?st_location_type=$matches[1]\";s:36:\"st_order/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:46:\"st_order/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:66:\"st_order/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"st_order/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:61:\"st_order/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:42:\"st_order/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:25:\"st_order/([^/]+)/embed/?$\";s:41:\"index.php?st_order=$matches[1]&embed=true\";s:29:\"st_order/([^/]+)/trackback/?$\";s:35:\"index.php?st_order=$matches[1]&tb=1\";s:37:\"st_order/([^/]+)/page/?([0-9]{1,})/?$\";s:48:\"index.php?st_order=$matches[1]&paged=$matches[2]\";s:44:\"st_order/([^/]+)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?st_order=$matches[1]&cpage=$matches[2]\";s:34:\"st_order/([^/]+)/wc-api(/(.*))?/?$\";s:49:\"index.php?st_order=$matches[1]&wc-api=$matches[3]\";s:40:\"st_order/([^/]+)/social-login(/(.*))?/?$\";s:55:\"index.php?st_order=$matches[1]&social-login=$matches[3]\";s:40:\"st_order/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:51:\"st_order/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:46:\"st_order/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:57:\"st_order/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:33:\"st_order/([^/]+)(?:/([0-9]+))?/?$\";s:47:\"index.php?st_order=$matches[1]&page=$matches[2]\";s:25:\"st_order/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:35:\"st_order/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:55:\"st_order/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"st_order/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:50:\"st_order/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:31:\"st_order/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:38:\"st_layouts/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:48:\"st_layouts/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:68:\"st_layouts/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"st_layouts/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:63:\"st_layouts/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:44:\"st_layouts/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:27:\"st_layouts/([^/]+)/embed/?$\";s:43:\"index.php?st_layouts=$matches[1]&embed=true\";s:31:\"st_layouts/([^/]+)/trackback/?$\";s:37:\"index.php?st_layouts=$matches[1]&tb=1\";s:39:\"st_layouts/([^/]+)/page/?([0-9]{1,})/?$\";s:50:\"index.php?st_layouts=$matches[1]&paged=$matches[2]\";s:46:\"st_layouts/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?st_layouts=$matches[1]&cpage=$matches[2]\";s:36:\"st_layouts/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?st_layouts=$matches[1]&wc-api=$matches[3]\";s:42:\"st_layouts/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?st_layouts=$matches[1]&social-login=$matches[3]\";s:42:\"st_layouts/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:53:\"st_layouts/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:48:\"st_layouts/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:59:\"st_layouts/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:35:\"st_layouts/([^/]+)(?:/([0-9]+))?/?$\";s:49:\"index.php?st_layouts=$matches[1]&page=$matches[2]\";s:27:\"st_layouts/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"st_layouts/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"st_layouts/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"st_layouts/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"st_layouts/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"st_layouts/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:39:\"coupon_code/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:49:\"coupon_code/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:69:\"coupon_code/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:64:\"coupon_code/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:64:\"coupon_code/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:45:\"coupon_code/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:28:\"coupon_code/([^/]+)/embed/?$\";s:47:\"index.php?st_coupon_code=$matches[1]&embed=true\";s:32:\"coupon_code/([^/]+)/trackback/?$\";s:41:\"index.php?st_coupon_code=$matches[1]&tb=1\";s:40:\"coupon_code/([^/]+)/page/?([0-9]{1,})/?$\";s:54:\"index.php?st_coupon_code=$matches[1]&paged=$matches[2]\";s:47:\"coupon_code/([^/]+)/comment-page-([0-9]{1,})/?$\";s:54:\"index.php?st_coupon_code=$matches[1]&cpage=$matches[2]\";s:37:\"coupon_code/([^/]+)/wc-api(/(.*))?/?$\";s:55:\"index.php?st_coupon_code=$matches[1]&wc-api=$matches[3]\";s:43:\"coupon_code/([^/]+)/social-login(/(.*))?/?$\";s:61:\"index.php?st_coupon_code=$matches[1]&social-login=$matches[3]\";s:43:\"coupon_code/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:54:\"coupon_code/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:49:\"coupon_code/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:60:\"coupon_code/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:36:\"coupon_code/([^/]+)(?:/([0-9]+))?/?$\";s:53:\"index.php?st_coupon_code=$matches[1]&page=$matches[2]\";s:28:\"coupon_code/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:38:\"coupon_code/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:58:\"coupon_code/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:53:\"coupon_code/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:53:\"coupon_code/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:34:\"coupon_code/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=27&cpage=$matches[1]\";s:17:\"wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:23:\"social-login(/(.*))?/?$\";s:35:\"index.php?&social-login=$matches[2]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:26:\"comments/wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:32:\"comments/social-login(/(.*))?/?$\";s:35:\"index.php?&social-login=$matches[2]\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:29:\"search/(.+)/wc-api(/(.*))?/?$\";s:42:\"index.php?s=$matches[1]&wc-api=$matches[3]\";s:35:\"search/(.+)/social-login(/(.*))?/?$\";s:48:\"index.php?s=$matches[1]&social-login=$matches[3]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:32:\"author/([^/]+)/wc-api(/(.*))?/?$\";s:52:\"index.php?author_name=$matches[1]&wc-api=$matches[3]\";s:38:\"author/([^/]+)/social-login(/(.*))?/?$\";s:58:\"index.php?author_name=$matches[1]&social-login=$matches[3]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:54:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:82:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc-api=$matches[5]\";s:60:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/social-login(/(.*))?/?$\";s:88:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&social-login=$matches[5]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:41:\"([0-9]{4})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:66:\"index.php?year=$matches[1]&monthnum=$matches[2]&wc-api=$matches[4]\";s:47:\"([0-9]{4})/([0-9]{1,2})/social-login(/(.*))?/?$\";s:72:\"index.php?year=$matches[1]&monthnum=$matches[2]&social-login=$matches[4]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:28:\"([0-9]{4})/wc-api(/(.*))?/?$\";s:45:\"index.php?year=$matches[1]&wc-api=$matches[3]\";s:34:\"([0-9]{4})/social-login(/(.*))?/?$\";s:51:\"index.php?year=$matches[1]&social-login=$matches[3]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:58:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:68:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:88:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:64:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:53:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:77:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:65:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:62:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/wc-api(/(.*))?/?$\";s:99:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&wc-api=$matches[6]\";s:68:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/social-login(/(.*))?/?$\";s:105:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&social-login=$matches[6]\";s:62:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:73:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:68:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:79:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:61:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:47:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:57:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:77:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:53:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:38:\"([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:25:\"(.?.+?)/wc-api(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&wc-api=$matches[3]\";s:28:\"(.?.+?)/order-pay(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&order-pay=$matches[3]\";s:33:\"(.?.+?)/order-received(/(.*))?/?$\";s:57:\"index.php?pagename=$matches[1]&order-received=$matches[3]\";s:25:\"(.?.+?)/orders(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&orders=$matches[3]\";s:29:\"(.?.+?)/view-order(/(.*))?/?$\";s:53:\"index.php?pagename=$matches[1]&view-order=$matches[3]\";s:28:\"(.?.+?)/downloads(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&downloads=$matches[3]\";s:31:\"(.?.+?)/edit-account(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-account=$matches[3]\";s:31:\"(.?.+?)/edit-address(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-address=$matches[3]\";s:34:\"(.?.+?)/payment-methods(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&payment-methods=$matches[3]\";s:32:\"(.?.+?)/lost-password(/(.*))?/?$\";s:56:\"index.php?pagename=$matches[1]&lost-password=$matches[3]\";s:34:\"(.?.+?)/customer-logout(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&customer-logout=$matches[3]\";s:37:\"(.?.+?)/add-payment-method(/(.*))?/?$\";s:61:\"index.php?pagename=$matches[1]&add-payment-method=$matches[3]\";s:40:\"(.?.+?)/delete-payment-method(/(.*))?/?$\";s:64:\"index.php?pagename=$matches[1]&delete-payment-method=$matches[3]\";s:45:\"(.?.+?)/set-default-payment-method(/(.*))?/?$\";s:69:\"index.php?pagename=$matches[1]&set-default-payment-method=$matches[3]\";s:31:\"(.?.+?)/social-login(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&social-login=$matches[3]\";s:31:\".?.+?/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\".?.+?/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:37:\".?.+?/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:48:\".?.+?/attachment/([^/]+)/social-login(/(.*))?/?$\";s:57:\"index.php?attachment=$matches[1]&social-login=$matches[3]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:6:{i:0;s:36:\"contact-form-7/wp-contact-form-7.php\";i:1;s:27:\"js_composer/js_composer.php\";i:2;s:37:\"mailchimp-for-wp/mailchimp-for-wp.php\";i:3;s:25:\"option-tree/ot-loader.php\";i:4;s:31:\"traveler-code/traveler-code.php\";i:5;s:27:\"woocommerce/woocommerce.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'traveler', 'yes'),
(41, 'stylesheet', 'traveler', 'yes'),
(42, 'comment_registration', '0', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '49752', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '1', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'page', 'yes'),
(52, 'tag_base', '', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '300', 'yes'),
(60, 'medium_size_h', '300', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '1024', 'yes'),
(63, 'large_size_h', '1024', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '0', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '0', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(77, 'widget_text', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(78, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'no'),
(80, 'timezone_string', '', 'yes'),
(81, 'page_for_posts', '0', 'yes'),
(82, 'page_on_front', '27', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '768', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '3', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '1629903553', 'yes'),
(92, 'disallowed_keys', '', 'no'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
(95, 'auto_update_core_dev', 'enabled', 'yes'),
(96, 'auto_update_core_minor', 'enabled', 'yes'),
(97, 'auto_update_core_major', 'enabled', 'yes'),
(98, 'initial_db_version', '49752', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(99, 'wp_user_roles', 'a:9:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:126:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:31:\"vc_access_rules_post_types/page\";b:1;s:26:\"vc_access_rules_post_types\";s:6:\"custom\";s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:24:\"vc_access_rules_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;s:49:\"vc_access_rules_backend_editor/disabled_ce_editor\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:43:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";s:7:\"default\";s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:19:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:14:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:25:\"wp-travel-engine-customer\";a:2:{s:4:\"name\";s:25:\"WP Travel Engine Customer\";s:12:\"capabilities\";a:1:{s:4:\"read\";b:1;}}s:7:\"partner\";a:2:{s:4:\"name\";s:7:\"Partner\";s:12:\"capabilities\";a:20:{s:4:\"read\";b:1;s:12:\"delete_posts\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:12:\"upload_files\";b:1;s:22:\"delete_published_posts\";b:1;s:14:\"manage_options\";b:0;s:23:\"wpcf7_edit_contact_form\";b:0;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}s:8:\"customer\";a:2:{s:4:\"name\";s:8:\"Customer\";s:12:\"capabilities\";a:1:{s:4:\"read\";b:1;}}s:12:\"shop_manager\";a:2:{s:4:\"name\";s:12:\"Shop manager\";s:12:\"capabilities\";a:101:{s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:4:\"read\";b:1;s:18:\"read_private_pages\";b:1;s:18:\"read_private_posts\";b:1;s:10:\"edit_posts\";b:1;s:10:\"edit_pages\";b:1;s:20:\"edit_published_posts\";b:1;s:20:\"edit_published_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"edit_private_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:17:\"edit_others_pages\";b:1;s:13:\"publish_posts\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_posts\";b:1;s:12:\"delete_pages\";b:1;s:20:\"delete_private_pages\";b:1;s:20:\"delete_private_posts\";b:1;s:22:\"delete_published_pages\";b:1;s:22:\"delete_published_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:19:\"delete_others_pages\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:17:\"moderate_comments\";b:1;s:12:\"upload_files\";b:1;s:6:\"export\";b:1;s:6:\"import\";b:1;s:10:\"list_users\";b:1;s:18:\"edit_theme_options\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:26:\"vc_access_rules_post_types\";b:1;s:30:\"vc_access_rules_backend_editor\";b:1;s:31:\"vc_access_rules_frontend_editor\";b:1;s:29:\"vc_access_rules_post_settings\";b:1;s:25:\"vc_access_rules_templates\";b:1;s:26:\"vc_access_rules_shortcodes\";b:1;s:28:\"vc_access_rules_grid_builder\";b:1;s:23:\"vc_access_rules_presets\";b:1;s:25:\"vc_access_rules_dragndrop\";b:1;}}}', 'yes'),
(100, 'fresh_site', '0', 'yes'),
(101, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'sidebars_widgets', 'a:17:{s:19:\"wp_inactive_widgets\";a:0:{}s:14:\"wte-sidebar-id\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:12:\"blog-sidebar\";a:0:{}s:12:\"page-sidebar\";a:0:{}s:4:\"shop\";a:0:{}s:13:\"hotel-sidebar\";a:0:{}s:15:\"hotel-sidebar-2\";a:0:{}s:16:\"activity-sidebar\";a:0:{}s:18:\"activity-sidebar-2\";a:0:{}s:13:\"tours-sidebar\";a:0:{}s:19:\"tour-single-sidebar\";a:0:{}s:12:\"cars-sidebar\";a:0:{}s:14:\"cars-sidebar-2\";a:0:{}s:14:\"rental-sidebar\";a:0:{}s:16:\"rental-sidebar-2\";a:0:{}s:16:\"location-sidebar\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(107, 'cron', 'a:18:{i:1614847458;a:1:{s:26:\"action_scheduler_run_queue\";a:1:{s:32:\"0d04ed39571b55704c122d726248bbac\";a:3:{s:8:\"schedule\";s:12:\"every_minute\";s:4:\"args\";a:1:{i:0;s:7:\"WP Cron\";}s:8:\"interval\";i:60;}}}i:1614848354;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1614849802;a:1:{s:33:\"wc_admin_process_orders_milestone\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1614849809;a:1:{s:29:\"wc_admin_unsnooze_admin_notes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1614850747;a:1:{s:32:\"woocommerce_cancel_unpaid_orders\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1614869953;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614869954;a:3:{s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1614869966;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614869967;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614876969;a:1:{s:28:\"woocommerce_cleanup_sessions\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1614882203;a:1:{s:14:\"wc_admin_daily\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614898579;a:2:{s:33:\"woocommerce_cleanup_personal_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:30:\"woocommerce_tracker_send_event\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614902400;a:1:{s:27:\"woocommerce_scheduled_sales\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614906000;a:1:{s:23:\"st_availability_cronjob\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1614909369;a:1:{s:24:\"woocommerce_cleanup_logs\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1615042753;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1615762629;a:1:{s:25:\"woocommerce_geoip_updater\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:11:\"fifteendays\";s:4:\"args\";a:0:{}s:8:\"interval\";i:1296000;}}}s:7:\"version\";i:2;}', 'yes'),
(108, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(116, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(118, 'recovery_keys', 'a:0:{}', 'yes'),
(120, 'theme_mods_twentytwentyone', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1614351768;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";}s:9:\"sidebar-2\";a:3:{i:0;s:10:\"archives-2\";i:1;s:12:\"categories-2\";i:2;s:6:\"meta-2\";}}}}', 'yes'),
(127, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.2.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.2.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.6.2-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.6.2-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"5.6.2\";s:7:\"version\";s:5:\"5.6.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1614847157;s:15:\"version_checked\";s:5:\"5.6.2\";s:12:\"translations\";a:0:{}}', 'no'),
(128, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:22:\"kchaouanis26@gmail.com\";s:7:\"version\";s:5:\"5.6.2\";s:9:\"timestamp\";i:1614351564;}', 'no'),
(130, '_site_transient_timeout_browser_0dfb3ef9c1b48f7db77c2e3064864c91', '1614956367', 'no'),
(131, '_site_transient_browser_0dfb3ef9c1b48f7db77c2e3064864c91', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"88.0.4324.190\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(132, '_site_transient_timeout_php_check_787617df3522cd9d9182823c87ee367d', '1614956367', 'no'),
(133, '_site_transient_php_check_787617df3522cd9d9182823c87ee367d', 'a:5:{s:19:\"recommended_version\";s:3:\"7.4\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(141, 'can_compress_scripts', '1', 'no'),
(150, 'finished_updating_comment_type', '1', 'yes'),
(153, 'current_theme', 'Traveler', 'yes'),
(154, 'theme_mods_travel-booking', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1614362895;s:4:\"data\";a:9:{s:19:\"wp_inactive_widgets\";a:0:{}s:7:\"sidebar\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:5:\"about\";a:0:{}s:7:\"cta-one\";a:0:{}s:7:\"cta-two\";a:0:{}s:10:\"footer-one\";a:0:{}s:10:\"footer-two\";a:0:{}s:12:\"footer-three\";a:0:{}s:11:\"footer-four\";a:0:{}}}}', 'yes'),
(155, 'theme_switched', '', 'yes'),
(158, 'theme_mods_twentytwenty', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1614352058;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}}}}', 'yes'),
(164, 'recently_activated', 'a:3:{s:9:\"hello.php\";i:1614363066;s:49:\"travel-booking-toolkit/travel-booking-toolkit.php\";i:1614363066;s:37:\"wp-travel-engine/wp-travel-engine.php\";i:1614363066;}', 'yes'),
(166, 'fs_active_plugins', 'O:8:\"stdClass\":0:{}', 'yes'),
(167, 'fs_debug_mode', '', 'yes'),
(168, 'fs_accounts', 'a:6:{s:21:\"id_slug_type_path_map\";a:1:{i:5392;a:3:{s:4:\"slug\";s:16:\"wp-travel-engine\";s:4:\"type\";s:6:\"plugin\";s:4:\"path\";s:37:\"wp-travel-engine/wp-travel-engine.php\";}}s:11:\"plugin_data\";a:1:{s:16:\"wp-travel-engine\";a:15:{s:16:\"plugin_main_file\";O:8:\"stdClass\":1:{s:4:\"path\";s:37:\"wp-travel-engine/wp-travel-engine.php\";}s:20:\"is_network_activated\";b:0;s:17:\"install_timestamp\";i:1614352122;s:17:\"was_plugin_loaded\";b:1;s:21:\"is_plugin_new_install\";b:1;s:16:\"sdk_last_version\";N;s:11:\"sdk_version\";s:5:\"2.4.2\";s:16:\"sdk_upgrade_mode\";b:1;s:18:\"sdk_downgrade_mode\";b:0;s:19:\"plugin_last_version\";N;s:14:\"plugin_version\";s:5:\"4.3.5\";s:19:\"plugin_upgrade_mode\";b:1;s:21:\"plugin_downgrade_mode\";b:0;s:17:\"connectivity_test\";a:6:{s:12:\"is_connected\";b:1;s:4:\"host\";s:9:\"localhost\";s:9:\"server_ip\";s:3:\"::1\";s:9:\"is_active\";b:1;s:9:\"timestamp\";i:1614352122;s:7:\"version\";s:5:\"4.3.5\";}s:15:\"prev_is_premium\";b:0;}}s:13:\"file_slug_map\";a:1:{s:37:\"wp-travel-engine/wp-travel-engine.php\";s:16:\"wp-travel-engine\";}s:7:\"plugins\";a:1:{s:16:\"wp-travel-engine\";O:9:\"FS_Plugin\":23:{s:16:\"parent_plugin_id\";N;s:5:\"title\";s:50:\"WordPress Travel Booking Plugin - WP Travel Engine\";s:4:\"slug\";s:16:\"wp-travel-engine\";s:12:\"premium_slug\";s:24:\"wp-travel-engine-premium\";s:4:\"type\";s:6:\"plugin\";s:20:\"affiliate_moderation\";b:0;s:19:\"is_wp_org_compliant\";b:1;s:22:\"premium_releases_count\";N;s:4:\"file\";s:37:\"wp-travel-engine/wp-travel-engine.php\";s:7:\"version\";s:5:\"4.3.5\";s:11:\"auto_update\";N;s:4:\"info\";N;s:10:\"is_premium\";b:0;s:14:\"premium_suffix\";s:9:\"(Premium)\";s:7:\"is_live\";b:1;s:9:\"bundle_id\";N;s:17:\"bundle_public_key\";N;s:10:\"public_key\";s:32:\"pk_d9913f744dc4867caeec5b60fc76d\";s:10:\"secret_key\";N;s:2:\"id\";s:4:\"5392\";s:7:\"updated\";N;s:7:\"created\";N;s:22:\"\0FS_Entity\0_is_updated\";b:0;}}s:9:\"unique_id\";s:32:\"19c96823c9d7702303a8cb89b5393601\";s:13:\"admin_notices\";a:1:{s:16:\"wp-travel-engine\";a:0:{}}}', 'yes'),
(169, 'fs_gdpr', 'a:1:{s:2:\"u1\";a:1:{s:8:\"required\";b:0;}}', 'yes'),
(170, 'fs_api_cache', 'a:0:{}', 'no'),
(173, 'wp_travel_engine_settings', 'a:4:{s:5:\"pages\";a:5:{s:7:\"enquiry\";i:11;s:26:\"wp_travel_engine_thank_you\";i:12;s:28:\"wp_travel_engine_place_order\";i:13;s:37:\"wp_travel_engine_terms_and_conditions\";i:14;s:34:\"wp_travel_engine_confirmation_page\";i:15;}s:9:\"trip_tabs\";a:3:{s:4:\"name\";a:6:{i:1;s:8:\"Overview\";i:2;s:9:\"Itinerary\";i:3;s:4:\"Cost\";i:4;s:5:\"Dates\";i:5;s:4:\"FAQs\";i:6;s:3:\"Map\";}s:5:\"field\";a:6:{i:1;s:9:\"wp_editor\";i:2;s:9:\"itinerary\";i:3;s:4:\"cost\";i:4;s:5:\"dates\";i:5;s:4:\"faqs\";i:6;s:3:\"map\";}s:2:\"id\";a:6:{i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"6\";}}s:10:\"trip_facts\";a:4:{s:8:\"field_id\";a:12:{i:1;s:14:\"Transportation\";i:2;s:10:\"Group Size\";i:3;s:16:\"Maximum Altitude\";i:4;s:12:\"Accomodation\";i:5;s:13:\"Fitness level\";i:6;s:10:\"Arrival on\";i:7;s:14:\"Departure from\";i:8;s:11:\"Best season\";i:9;s:14:\"Guiding method\";i:10;s:9:\"Tour type\";i:11;s:5:\"Meals\";i:12;s:8:\"Language\";}s:10:\"field_icon\";a:12:{i:1;s:10:\"fas fa-bus\";i:2;s:11:\"fas fa-user\";i:3;s:15:\"fas fa-mountain\";i:4;s:12:\"fas fa-hotel\";i:5;s:14:\"fas fa-running\";i:6;s:20:\"fas fa-plane-arrival\";i:7;s:22:\"fas fa-plane-departure\";i:8;s:16:\"fas fa-cloud-sun\";i:9;s:16:\"fas fa-map-signs\";i:10;s:13:\"fas fa-hiking\";i:11;s:15:\"fas fa-utensils\";i:12;s:15:\"fas fa-language\";}s:10:\"field_type\";a:12:{i:1;s:4:\"text\";i:2;s:4:\"text\";i:3;s:4:\"text\";i:4;s:4:\"text\";i:5;s:4:\"text\";i:6;s:4:\"text\";i:7;s:4:\"text\";i:8;s:4:\"text\";i:9;s:4:\"text\";i:10;s:4:\"text\";i:11;s:4:\"text\";i:12;s:4:\"text\";}s:3:\"fid\";a:12:{i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"6\";i:7;s:1:\"7\";i:8;s:1:\"8\";i:9;s:1:\"9\";i:10;s:2:\"10\";i:11;s:2:\"11\";i:12;s:2:\"12\";}}s:5:\"email\";a:1:{s:6:\"emails\";s:22:\"kchaouanis26@gmail.com\";}}', 'yes'),
(174, '_transient_wte_show_getting_started_page', '1', 'yes'),
(175, 'wp_travel_engine_wp-travel-engine-cart_page_id', '16', 'yes'),
(176, 'wp_travel_engine_wp-travel-engine-checkout_page_id', '17', 'yes'),
(177, 'wp_travel_engine_my-account_page_id', '18', 'yes'),
(178, '_wp_session_0096e2b1670faa4c3d6bdf67f8f66307', 'a:0:{}', 'yes'),
(179, '_wp_session_expires_0096e2b1670faa4c3d6bdf67f8f66307', '1614353925', 'yes'),
(180, 'widget_travel_booking_toolkit_icon_text_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(181, 'widget_travel_booking_toolkit_cta_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(182, 'widget_wptravelengine_client_logo_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(183, 'widget_travel_booking_toolkit_recent_post', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(184, 'widget_travel_booking_toolkit_contact_social_links', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(185, 'widget_travel_booking_toolkit_image_text_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(186, 'widget_travel_booking_toolkit_taxonomy_list', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(187, 'widget_wte_featured_trips_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(188, 'wpte_updated_actual_price_for_filter', '1', 'yes'),
(192, '_wp_session_4fa936d0d60a2d591751836098ebe717', 'a:0:{}', 'yes'),
(193, '_wp_session_expires_4fa936d0d60a2d591751836098ebe717', '1614364651', 'yes'),
(194, '_wp_session_9039b239e4719b926071e00454672a4d', 'a:0:{}', 'yes'),
(195, '_wp_session_expires_9039b239e4719b926071e00454672a4d', '1614364651', 'yes'),
(199, 'theme_mods_twentynineteen', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1614363016;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:14:\"wte-sidebar-id\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-1\";a:0:{}}}}', 'yes'),
(203, '_site_transient_update_themes', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1614847156;s:7:\"checked\";a:4:{s:8:\"traveler\";s:5:\"2.7.1\";s:14:\"twentynineteen\";s:3:\"1.9\";s:12:\"twentytwenty\";s:3:\"1.6\";s:15:\"twentytwentyone\";s:3:\"1.1\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:3:{s:14:\"twentynineteen\";a:6:{s:5:\"theme\";s:14:\"twentynineteen\";s:11:\"new_version\";s:3:\"1.9\";s:3:\"url\";s:44:\"https://wordpress.org/themes/twentynineteen/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/theme/twentynineteen.1.9.zip\";s:8:\"requires\";s:5:\"4.9.6\";s:12:\"requires_php\";s:5:\"5.2.4\";}s:12:\"twentytwenty\";a:6:{s:5:\"theme\";s:12:\"twentytwenty\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/themes/twentytwenty/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/theme/twentytwenty.1.6.zip\";s:8:\"requires\";s:3:\"4.7\";s:12:\"requires_php\";s:5:\"5.2.4\";}s:15:\"twentytwentyone\";a:6:{s:5:\"theme\";s:15:\"twentytwentyone\";s:11:\"new_version\";s:3:\"1.1\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentyone/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentyone.1.1.zip\";s:8:\"requires\";s:3:\"5.3\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}', 'no'),
(205, 'theme_mods_traveler', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:1:{s:7:\"primary\";i:18;}s:18:\"custom_css_post_id\";i:-1;}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(206, '_transient_last_minute_deal', 'a:752:{s:8:\"activity\";s:8:\"Activity\";s:10:\"activities\";s:10:\"activities\";s:19:\"search_for_activity\";s:19:\"Search for Activity\";s:6:\"filter\";s:6:\"Filter\";s:9:\"filter_by\";s:9:\"Filter By\";s:4:\"sort\";s:4:\"Sort\";s:7:\"showing\";s:7:\"Showing\";s:24:\"not_what_you_looking_for\";s:28:\"Not what you\'re looking for?\";s:21:\"try_your_search_again\";s:21:\"Try your search again\";s:24:\"sorry_activity_not_found\";s:26:\"Sorry!. Activity Not Found\";s:5:\"event\";s:5:\"Event\";s:6:\"guests\";s:6:\"Guests\";s:5:\"price\";s:5:\"Price\";s:5:\"total\";s:5:\"Total\";s:5:\"clean\";s:5:\"Clean\";s:4:\"good\";s:4:\"Good\";s:9:\"very_good\";s:9:\"Very Good\";s:8:\"superior\";s:8:\"Superior\";s:11:\"exceptional\";s:11:\"Exceptional\";s:19:\"of_guests_recommend\";s:19:\"of guests recommend\";s:15:\"traveler_rating\";s:15:\"Traveler rating\";s:8:\"exellent\";s:9:\"Excellent\";s:7:\"average\";s:7:\"Average\";s:4:\"poor\";s:4:\"Poor\";s:8:\"terrible\";s:8:\"Terrible\";s:14:\"write_a_review\";s:14:\"Write a review\";s:7:\"summary\";s:7:\"Summary\";s:13:\"activity_near\";s:13:\"Activity Near\";s:15:\"activities_near\";s:15:\"Activities Near\";s:13:\"activity_time\";s:13:\"Activity Time\";s:8:\"duration\";s:8:\"Duration\";s:12:\"availability\";s:12:\"Availability\";s:16:\"venue_facilities\";s:16:\"Venue Facilities\";s:8:\"book_now\";s:8:\"Book now\";s:20:\"best_price_guarantee\";s:20:\"Best Price Guarantee\";s:23:\"activity_or_us_zip_code\";s:25:\"Activity or U.S. Zip Code\";s:8:\"1_review\";s:8:\"1 Review\";s:7:\"reviews\";s:7:\"Reviews\";s:4:\"date\";s:4:\"Date\";s:4:\"from\";s:4:\"From\";s:2:\"of\";s:2:\"of\";s:14:\"activity_email\";s:12:\"Owner E-mail\";s:16:\"activity_website\";s:13:\"Owner Website\";s:14:\"activity_price\";s:5:\"Price\";s:23:\"activity_not_set_layout\";s:24:\"Not set default layout !\";s:3:\"car\";s:3:\"Car\";s:4:\"cars\";s:4:\"cars\";s:15:\"search_for_cars\";s:15:\"Search for Cars\";s:15:\"change_for_cars\";s:15:\"Change for Cars\";s:24:\"change_location_and_date\";s:26:\"Change Location &amp; Date\";s:19:\"car_pickup_features\";s:15:\"Pickup Features\";s:26:\"car_search_pickup_features\";s:22:\"Search Pickup Features\";s:10:\"car_filter\";s:6:\"Filter\";s:13:\"car_filter_by\";s:9:\"Filter By\";s:8:\"car_sort\";s:4:\"Sort\";s:11:\"car_showing\";s:7:\"Showing\";s:28:\"car_not_what_you_looking_for\";s:29:\"Not what you\'re looking for? \";s:25:\"car_try_your_search_again\";s:21:\"Try your search again\";s:7:\"car_day\";s:3:\"day\";s:8:\"car_days\";s:4:\"days\";s:7:\"car_for\";s:7:\"Car for\";s:18:\"car_due_at_pick_up\";s:14:\"Due at pick-up\";s:14:\"car_passengers\";s:10:\"Passengers\";s:13:\"car_passenger\";s:9:\"Passenger\";s:13:\"car_equipment\";s:9:\"Equipment\";s:13:\"car_price_per\";s:9:\"Price Per\";s:16:\"car_rental_price\";s:12:\"Rental Price\";s:16:\"car_rental_total\";s:12:\"Rental Total\";s:31:\"car_city_airport_or_us_zip_code\";s:30:\"City, Airport or U.S. Zip Code\";s:10:\"car_select\";s:6:\"Select\";s:9:\"car_price\";s:5:\"Price\";s:12:\"car_book_now\";s:8:\"Book Now\";s:18:\"car_not_set_layout\";s:24:\"Not set default layout !\";s:9:\"car_email\";s:5:\"Email\";s:9:\"car_total\";s:5:\"Total\";s:11:\"car_pick_up\";s:7:\"Pick Up\";s:12:\"car_drop_off\";s:8:\"Drop Off\";s:9:\"car_about\";s:5:\"About\";s:9:\"car_phone\";s:5:\"Phone\";s:10:\"car_number\";s:6:\"Number\";s:10:\"driver_age\";s:14:\"Driver’s Age\";s:11:\"driver_name\";s:15:\"Driver’s Name\";s:11:\"driver_info\";s:11:\"Driver info\";s:6:\"cruise\";s:6:\"Cruise\";s:23:\"cruise_adults_occupancy\";s:16:\"Adults Occupancy\";s:13:\"cruise_childs\";s:6:\"Childs\";s:11:\"cruise_bebs\";s:4:\"Beds\";s:19:\"cruise_room_footage\";s:26:\"Room footage (square feet)\";s:18:\"booking_infomation\";s:19:\"Booking Information\";s:4:\"item\";s:4:\"Item\";s:10:\"infomation\";s:11:\"Information\";s:9:\"sub_total\";s:9:\"Sub Total\";s:3:\"tax\";s:3:\"Tax\";s:19:\"customer_infomation\";s:20:\"Customer Information\";s:19:\"confirmation_needed\";s:19:\"Confirmation needed\";s:34:\"you_added_an_email_to_your_account\";s:42:\"You added an email address to your account\";s:35:\"click_confirm_to_import_the_booking\";s:68:\"Click \"confirm\" to import the bookings you\'ve made with that address\";s:13:\"email_confirm\";s:7:\"Confirm\";s:24:\"email_can_see_the_button\";s:36:\"Can\'t see the button? Try this link:\";s:27:\"your_payment_was_successful\";s:28:\"your payment was successful!\";s:25:\"your_order_was_successful\";s:38:\"your order was submitted successfully!\";s:32:\"booking_details_has_been_sent_to\";s:34:\"Booking details has been sent to: \";s:26:\"login_register_on_traveler\";s:26:\"Login/Register on Traveler\";s:5:\"login\";s:5:\"Login\";s:15:\"new_to_traveler\";s:16:\"New To Traveler?\";s:18:\"booking_submission\";s:18:\"Booking Submission\";s:28:\"and_we_will_contact_you_back\";s:28:\"And we will contact you back\";s:23:\"create_traveler_account\";s:23:\"Create Traveler account\";s:35:\"password_will_be_send_to_your_email\";s:38:\"(password will be sent to your e-mail)\";s:26:\"i_have_read_and_accept_the\";s:26:\"I have read and accept the\";s:20:\"terms_and_conditions\";s:20:\"terms and conditions\";s:14:\"submit_request\";s:14:\"Submit Booking\";s:2:\"or\";s:2:\"OR\";s:32:\"you_will_be_redirected_to_payPal\";s:88:\"Important: You will be redirected to PayPal\'s website to securely complete your payment.\";s:19:\"checkout_via_paypal\";s:18:\"Payment via Paypal\";s:10:\"sub_total:\";s:11:\"Sub Total: \";s:4:\"tax:\";s:4:\"Tax:\";s:6:\"total:\";s:13:\"Total Amount:\";s:12:\"tag_archives\";s:12:\"Tag Archives\";s:9:\"search...\";s:10:\"Search ...\";s:14:\"edit_this_page\";s:15:\"Edit this page.\";s:14:\"edit_this_post\";s:15:\"Edit this post.\";s:4:\"blog\";s:4:\"Blog\";s:9:\"read_more\";s:9:\"Read More\";s:15:\"post_discussion\";s:15:\"Post Discussion\";s:18:\"comment_navigation\";s:18:\"Comment navigation\";s:14:\"older_comments\";s:21:\"&larr; Older Comments\";s:14:\"newer_comments\";s:21:\"Newer Comments &rarr;\";s:19:\"comments_are_closed\";s:20:\"Comments are closed.\";s:13:\"add_a_comment\";s:13:\"Add a comment\";s:23:\"be_the_first_to_comment\";s:23:\"Be the first to comment\";s:12:\"post_comment\";s:12:\"Post Comment\";s:7:\"message\";s:7:\"Message\";s:18:\"your_email_address\";s:20:\"Your email address *\";s:4:\"name\";s:6:\"Name *\";s:18:\"leave_a_reply_to_s\";s:19:\"Leave a Reply to %s\";s:14:\"leave_a_review\";s:14:\"Leave a Review\";s:14:\"all_posts_by_s\";s:15:\"All posts by %s\";s:16:\"daily_archives_s\";s:19:\"Daily Archives : %s\";s:18:\"monthly_archives_s\";s:21:\"Monthly Archives : %s\";s:17:\"yearly_archives_s\";s:20:\"Yearly Archives : %s\";s:8:\"archives\";s:8:\"Archives\";s:11:\"to_homepage\";s:11:\"to Homepage\";s:7:\"sign_in\";s:7:\"Sign In\";s:12:\"connect_with\";s:14:\"Connect with :\";s:17:\"username_or_email\";s:17:\"Username or email\";s:8:\"password\";s:8:\"Password\";s:18:\"my_secret_password\";s:18:\"my secret password\";s:9:\"full_name\";s:9:\"Full Name\";s:5:\"email\";s:5:\"Email\";s:7:\"sign_up\";s:20:\"Sign up for Traveler\";s:2:\"hi\";s:2:\"Hi\";s:21:\"thank_you_for_booking\";s:63:\"Thank you for booking with us. Bellow are your booking details:\";s:14:\"booking_number\";s:16:\"Booking Number :\";s:12:\"booking_date\";s:14:\"Booking Date :\";s:15:\"booking_address\";s:9:\"Address :\";s:13:\"booking_email\";s:7:\"Email :\";s:13:\"booking_phone\";s:7:\"Phone :\";s:12:\"booking_room\";s:6:\"Room :\";s:19:\"booking_room_number\";s:13:\"Room Number :\";s:14:\"booking_method\";s:16:\"Payment Method :\";s:14:\"booking_amount\";s:8:\"Amount :\";s:13:\"booking_price\";s:7:\"Price :\";s:16:\"booking_check_in\";s:10:\"Check In :\";s:17:\"booking_check_out\";s:11:\"Check Out :\";s:11:\"booking_web\";s:9:\"Website :\";s:16:\"booking_activity\";s:10:\"Activity :\";s:11:\"booking_car\";s:5:\"Car :\";s:12:\"booking_tour\";s:6:\"Tour :\";s:12:\"booking_hour\";s:4:\"hour\";s:8:\"0_review\";s:8:\"0 Review\";s:35:\"your_comment_is_awaiting_moderation\";s:36:\"Your comment is awaiting moderation.\";s:23:\"was_this_review_helpful\";s:25:\"Was this review helpful? \";s:22:\"want_to_write_a_review\";s:23:\"Want to write a review?\";s:20:\"only_verified_guests\";s:107:\"Only verified guests can leave a review. After check-out, you\"ll  receive an invitation to review your stay\";s:7:\"on_this\";s:7:\"on this\";s:2:\"to\";s:2:\"to\";s:17:\"review_are_closed\";s:17:\"Review are closed\";s:11:\"your_rating\";s:11:\"Your Rating\";s:12:\"review_title\";s:12:\"Review Title\";s:11:\"review_text\";s:14:\"Review Content\";s:27:\"reviewing_are_not_available\";s:27:\"Reviewing are not available\";s:27:\"you_have_been_post_a_review\";s:36:\"You have been post a review for this\";s:8:\"you_must\";s:9:\"You must \";s:15:\"to_write_review\";s:15:\"to write review\";s:8:\"added_on\";s:8:\"added on\";s:6:\"remove\";s:6:\"remove\";s:15:\"add_to_wishlist\";s:15:\"Add to wishlist\";s:16:\"account_settings\";s:16:\"Account Settings\";s:11:\"no_wishlist\";s:11:\"No Wishlist\";s:9:\"load_more\";s:9:\"Load More\";s:18:\"remove_to_wishlist\";s:18:\"Remove to wishlist\";s:22:\"find_your_perfect_trip\";s:22:\"Find Your Perfect Trip\";s:44:\"show_email_and_phone_number_to_other_account\";s:45:\"Show email and phone number to other accounts\";i:404;s:3:\"404\";s:3:\"day\";s:3:\"day\";s:4:\"days\";s:4:\"days\";s:4:\"home\";s:4:\"Home\";s:14:\"search_results\";s:17:\"Search results : \";s:12:\"your_booking\";s:12:\"Your Booking\";s:11:\"coupon_code\";s:11:\"Coupon Code\";s:10:\"coupon_key\";s:10:\"Coupon: %s\";s:10:\"cart_empty\";s:36:\"Sorry! Your cart is currently empty.\";s:6:\"delete\";s:6:\"Delete\";s:13:\"change_search\";s:13:\"Change search\";s:5:\"night\";s:5:\"night\";s:10:\"price_from\";s:10:\"price from\";s:27:\"it_will_take_couple_seconds\";s:32:\"it will take a couple of seconds\";s:13:\"looking_for_s\";s:14:\"Looking for %s\";s:10:\"first_name\";s:10:\"First Name\";s:9:\"last_name\";s:9:\"Last Name\";s:5:\"phone\";s:5:\"Phone\";s:14:\"address_line_1\";s:14:\"Address Line 1\";s:14:\"address_line_2\";s:14:\"Address Line 2\";s:4:\"city\";s:4:\"City\";s:21:\"state_province_region\";s:21:\"State/Province/Region\";s:20:\"zip_code_postal_code\";s:20:\"ZIP code/Postal code\";s:7:\"country\";s:7:\"Country\";s:20:\"special_requirements\";s:20:\"Special Requirements\";s:18:\"booking_management\";s:18:\"Booking Management\";s:11:\"search_blog\";s:11:\"Search Blog\";s:5:\"tags:\";s:5:\"Tags:\";s:18:\"ready_publish_post\";s:65:\"Ready to publish your first post? <a href=#>Get started here</a>.\";s:54:\"sorry_but_nothing_matched_your_search_please_try_again\";s:92:\"Sorry, but nothing matched your search terms. Please try again with some different keywords.\";s:46:\"it_seems_we_can_not_find_what_your_looking_for\";s:87:\"It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.\";s:16:\"one_thought_on_2\";s:33:\"One thought on &ldquo;%2$s&rdquo;\";s:15:\"1_thoughts_on_2\";s:35:\"%1$s thoughts on &ldquo;%2$s&rdquo;\";s:19:\"category_archives_s\";s:21:\"Category Archives: %s\";s:8:\"sign_out\";s:8:\"Sign Out\";s:5:\"hotel\";s:5:\"Hotel\";s:6:\"hotels\";s:6:\"hotels\";s:16:\"we_accepted_card\";s:23:\"We Accepted There Cards\";s:4:\"bebs\";s:4:\"Beds\";s:15:\"adults_occupany\";s:16:\"Adults Occupancy\";s:6:\"childs\";s:6:\"Childs\";s:12:\"room_footage\";s:26:\"Room footage (square feet)\";s:4:\"book\";s:4:\"Book\";s:13:\"no_room_found\";s:31:\"Sorry! No available rooms found\";s:11:\"hotels_near\";s:11:\"Hotels Near\";s:10:\"hotel_near\";s:10:\"Hotel Near\";s:8:\"pleasant\";s:8:\"Pleasant\";s:9:\"wonderful\";s:9:\"Wonderful\";s:17:\"of_5_guest_rating\";s:53:\"of 5 <small class=\"text-smaller\">guest rating</small>\";s:18:\"of_guest_recommend\";s:19:\"of guests recommend\";s:9:\"no_review\";s:9:\"no review\";s:17:\"based_on_1_review\";s:17:\"based on 1 review\";s:17:\"based_on_s_review\";s:18:\"based on % reviews\";s:8:\"check_in\";s:8:\"Check in\";s:9:\"check_out\";s:9:\"Check out\";s:6:\"adults\";s:6:\"Adults\";s:8:\"children\";s:8:\"Children\";s:10:\"__select__\";s:12:\"-- Select --\";s:5:\"rooms\";s:7:\"Room(s)\";s:6:\"search\";s:6:\"Search\";s:5:\"clear\";s:5:\"Clear\";s:9:\"host_name\";s:9:\"Host Name\";s:15:\"age_of_children\";s:16:\"Ages of Children\";s:16:\"try_search_again\";s:21:\"Try your search again\";s:2:\"OR\";s:2:\"OR\";s:5:\"Email\";s:5:\"Email\";s:12:\"email_domain\";s:16:\"email@domain.com\";s:5:\"Phone\";s:5:\"Phone\";s:10:\"Your_Phone\";s:10:\"Your Phone\";s:19:\"your_address_line_1\";s:19:\"Your Address Line 1\";s:19:\"your_address_line_2\";s:19:\"Your Address Line 2\";s:9:\"your_city\";s:9:\"Your City\";s:15:\"zip_postal_code\";s:20:\"ZIP code/Postal code\";s:7:\"captcha\";s:7:\"Captcha\";s:16:\"read_accept_term\";s:29:\"I have read and accept the %s\";s:14:\"no_hotel_found\";s:23:\"Sorry!. Hotel Not Found\";s:19:\"booking_for_1_night\";s:19:\"Booking for 1 night\";s:19:\"booking_for_d_night\";s:21:\"Booking for %d nights\";s:7:\"d_night\";s:9:\"%d Nights\";s:7:\"1_night\";s:7:\"1 Night\";s:9:\"per_night\";s:9:\"per night\";s:4:\"room\";s:4:\"Room\";s:4:\"of_5\";s:4:\"of 5\";s:9:\"s_reviews\";s:10:\"%d reviews\";s:6:\"s_star\";s:7:\"%d star\";s:15:\"lastest_booking\";s:15:\"Lastest booking\";s:9:\"avg/night\";s:9:\"avg/night\";s:16:\"search_for_hotel\";s:17:\"Search for Hotels\";s:14:\"advance_search\";s:15:\"Advanced Search\";s:4:\"less\";s:4:\"Less\";s:5:\"share\";s:5:\"Share\";s:15:\"available_rooms\";s:15:\"Available Rooms\";s:11:\"about_hotel\";s:11:\"About Hotel\";s:13:\"hotel_reviews\";s:13:\"Hotel Reviews\";s:11:\"hotel_email\";s:12:\"Hotel E-mail\";s:13:\"hotel_website\";s:13:\"Hotel Website\";s:9:\"_aged_18_\";s:11:\"( Age 18+ )\";s:21:\"city_name_or_zip_code\";s:21:\"City Name or Zip Code\";s:15:\"hotel_room_info\";s:16:\"Room Information\";s:12:\"hotel_room_s\";s:7:\"Room %d\";s:6:\"rental\";s:6:\"Rental\";s:7:\"rentals\";s:7:\"rentals\";s:17:\"search_for_rental\";s:17:\"Search for rental\";s:21:\"rental_advance_search\";s:15:\"Advanced Search\";s:11:\"rental_less\";s:4:\"Less\";s:27:\"rental_property_description\";s:20:\"Property Description\";s:22:\"rental_property_review\";s:15:\"Property Review\";s:34:\"rental_search_for_vacation_rentals\";s:27:\"Search for Vacation Rentals\";s:16:\"rental_no_review\";s:9:\"no review\";s:15:\"rental_1_review\";s:8:\"1 review\";s:16:\"rental_d_reviews\";s:11:\" %d reviews\";s:15:\"rental_book_now\";s:8:\"Book Now\";s:12:\"rental_night\";s:5:\"night\";s:13:\"rental_filter\";s:6:\"Filter\";s:16:\"rental_filter_by\";s:10:\"Filter By:\";s:20:\"rental_booking_for_d\";s:15:\"Booking for %d \";s:13:\"rental_nights\";s:6:\"nights\";s:15:\"rental_property\";s:8:\"Property\";s:14:\"rental_d_adult\";s:8:\"%d adult\";s:15:\"rental_d_adults\";s:9:\"%d adults\";s:14:\"rental_d_child\";s:8:\"%d child\";s:17:\"rental_d_children\";s:11:\"%d children\";s:14:\"rental_per_day\";s:7:\"per day\";s:31:\"rental_not_what_you_looking_for\";s:29:\"Not what you\'re looking for? \";s:28:\"rental_try_your_search_again\";s:21:\"Try your search again\";s:14:\"rental_showing\";s:7:\"Showing\";s:15:\"rental_pleasant\";s:8:\"Pleasant\";s:11:\"rental_good\";s:4:\"Good\";s:16:\"rental_very_good\";s:9:\"Very Good\";s:16:\"rental_wonderful\";s:9:\"Wonderful\";s:24:\"rental_based_on_1_review\";s:17:\"based on 1 review\";s:22:\"rental_traveler_rating\";s:15:\"Traveler rating\";s:15:\"rental_exellent\";s:9:\"Excellent\";s:14:\"rental_average\";s:7:\"Average\";s:11:\"rental_poor\";s:4:\"Poor\";s:15:\"rental_terrible\";s:8:\"Terrible\";s:21:\"rental_write_a_review\";s:14:\"Write a Review\";s:14:\"rental_summary\";s:7:\"Summary\";s:24:\"rental_properties_near_d\";s:18:\"Properties Near %s\";s:17:\"rental_agent_mail\";s:12:\"Agent E-mail\";s:20:\"rental_agent_website\";s:13:\"Agent Website\";s:15:\"rental_check_in\";s:8:\"Check in\";s:16:\"rental_check_out\";s:9:\"Check out\";s:15:\"rental_children\";s:8:\"Children\";s:11:\"rental_of_5\";s:4:\"of 5\";s:12:\"rental_adult\";s:5:\"Adult\";s:35:\"check_in_and_check_out_are_required\";s:35:\"Check-in and Check-out are required\";s:15:\"rental_s_nights\";s:9:\"%d nights\";s:14:\"rental_1_night\";s:7:\"1 night\";s:4:\"tour\";s:4:\"Tour\";s:5:\"tours\";s:5:\"tours\";s:9:\"tour_date\";s:4:\"Date\";s:15:\"search_for_tour\";s:15:\"Search for Tour\";s:11:\"tour_filter\";s:6:\"Filter\";s:14:\"tour_filter_by\";s:9:\"Filter By\";s:9:\"tour_sort\";s:4:\"Sort\";s:12:\"tour_showing\";s:7:\"Showing\";s:29:\"tour_not_what_you_looking_for\";s:29:\"Not what you\'re looking for? \";s:26:\"tour_try_your_search_again\";s:21:\"Try your search again\";s:20:\"sorry_tour_not_found\";s:22:\"Sorry!. Tour Not Found\";s:17:\"tours_information\";s:17:\"Tours information\";s:18:\"tour_duration_days\";s:13:\"Duration Days\";s:15:\"tour_max_people\";s:24:\"Maximum number of people\";s:10:\"tour_price\";s:5:\"Price\";s:11:\"tour_number\";s:6:\"Number\";s:10:\"tour_total\";s:5:\"Total\";s:15:\"tour_price_from\";s:10:\"price from\";s:9:\"tour_from\";s:4:\"from\";s:12:\"similar_tour\";s:12:\"SIMILAR TOUR\";s:13:\"similar_tours\";s:15:\"SIMILAR TOUR(S)\";s:8:\"tour_day\";s:3:\"day\";s:9:\"tour_days\";s:4:\"days\";s:12:\"tour_peoples\";s:7:\"peoples\";s:11:\"tour_people\";s:6:\"people\";s:13:\"tour_location\";s:8:\"Location\";s:9:\"tour_rate\";s:4:\"Rate\";s:13:\"tour_book_now\";s:8:\"Book Now\";s:13:\"tour_duration\";s:8:\"Duration\";s:20:\"tours_or_us_zip_Code\";s:22:\"Tours or U.S. Zip Code\";s:14:\"tour_no_review\";s:9:\"no review\";s:13:\"tour_1_review\";s:8:\"1 review\";s:12:\"tour_reviews\";s:7:\"reviews\";s:10:\"tour_email\";s:11:\"Tour E-mail\";s:12:\"tour_website\";s:12:\"Tour Website\";s:19:\"tour_not_set_layout\";s:24:\"Not set default layout !\";s:7:\"tour_to\";s:3:\"to \";s:9:\"tour_of_5\";s:4:\"of 5\";s:26:\"tour_you_are_booking_for_d\";s:22:\"You are booking for %s\";s:22:\"tour_last_minute_deals\";s:18:\"LAST MINUTE DEALS!\";s:12:\"tour_program\";s:14:\"Tour\'s Program\";s:9:\"tour_none\";s:4:\"none\";s:4:\"More\";s:4:\"More\";s:4:\"Less\";s:4:\"Less\";s:8:\"s_review\";s:9:\"%d review\";s:6:\"d_to_d\";s:8:\"%d to %d\";s:5:\"Name*\";s:5:\"Name*\";s:8:\"pingback\";s:9:\"Pingback:\";s:4:\"edit\";s:4:\"Edit\";s:26:\"your_comment_need_approved\";s:36:\"Your comment is awaiting moderation.\";s:4:\"_ago\";s:4:\" ago\";s:9:\"1_comment\";s:9:\"1 comment\";s:9:\"0_comment\";s:10:\"no comment\";s:9:\"s_comment\";s:10:\"% comments\";s:21:\"you_are_booking_for_s\";s:22:\"You are booking for %s\";s:6:\"photos\";s:6:\"Photos\";s:10:\"on_the_map\";s:10:\"On the Map\";s:5:\"video\";s:5:\"Video\";s:17:\"owner_description\";s:17:\"Owner description\";s:16:\"activity_reviews\";s:16:\"Activity Reviews\";s:6:\"paypal\";s:6:\"Paypal\";s:25:\"now_s_users_seeing_this_s\";s:29:\"Now %d user(s) seeing this %s\";s:36:\"most_revent_booking_for_this_s_was_s\";s:38:\"Most recent booking for this %s was %s\";s:11:\"user_remove\";s:6:\"Remove\";s:15:\"user_no_reviews\";s:10:\"No reviews\";s:13:\"user_1_review\";s:8:\"1 review\";s:12:\"user_reviews\";s:7:\"reviews\";s:7:\"user_of\";s:2:\"of\";s:17:\"user_availability\";s:12:\"Availability\";s:18:\"user_activity_time\";s:15:\"Activity Timing\";s:13:\"user_duration\";s:8:\"Duration\";s:9:\"user_from\";s:4:\"from\";s:13:\"user_activity\";s:8:\"activity\";s:8:\"user_day\";s:3:\"day\";s:9:\"user_days\";s:4:\"days\";s:10:\"user_night\";s:5:\"night\";s:15:\"user_max_people\";s:24:\"Maximum number of people\";s:11:\"user_people\";s:6:\"people\";s:12:\"user_peoples\";s:7:\"peoples\";s:18:\"user_duration_days\";s:14:\"Duration Days \";s:9:\"user_tour\";s:4:\"Tour\";s:13:\"user_book_now\";s:8:\"Book now\";s:12:\"user_average\";s:7:\"average\";s:16:\"user_add_to_trip\";s:11:\"Add to Trip\";s:11:\"user_person\";s:6:\"person\";s:9:\"user_type\";s:4:\"Type\";s:10:\"user_title\";s:5:\"Title\";s:13:\"user_location\";s:8:\"Location\";s:15:\"user_order_date\";s:10:\"Order Date\";s:19:\"user_execution_date\";s:14:\"Execution Time\";s:9:\"user_cost\";s:4:\"Cost\";s:23:\"user_no_booking_history\";s:18:\"No Booking History\";s:14:\"user_load_more\";s:9:\"Load More\";s:17:\"user_member_since\";s:6:\"Since:\";s:13:\"user_settings\";s:8:\"Settings\";s:21:\"user_my_travel_photos\";s:16:\"My Travel Photos\";s:20:\"user_booking_history\";s:15:\"Booking History\";s:13:\"user_wishlist\";s:8:\"Wishlist\";s:17:\"user_create_hotel\";s:13:\"Add new hotel\";s:16:\"user_create_room\";s:12:\"Add new room\";s:16:\"user_create_tour\";s:12:\"Add new tour\";s:20:\"user_create_activity\";s:16:\"Add new activity\";s:15:\"user_create_car\";s:11:\"Add new car\";s:18:\"user_create_rental\";s:14:\"Add new rental\";s:18:\"user_create_cruise\";s:13:\"Create Cruise\";s:24:\"user_create_cruise_cabin\";s:19:\"Create Cruise Cabin\";s:13:\"user_my_hotel\";s:8:\"My Hotel\";s:12:\"user_my_room\";s:7:\"My Room\";s:12:\"user_my_tour\";s:7:\"My Tour\";s:16:\"user_my_activity\";s:13:\"My Activities\";s:11:\"user_my_car\";s:6:\"My Car\";s:14:\"user_my_rental\";s:9:\"My Rental\";s:14:\"user_my_cruise\";s:9:\"My Cruise\";s:20:\"user_my_cruise_cabin\";s:15:\"My Cruise Cabin\";s:17:\"user_setting_info\";s:9:\"User Info\";s:9:\"user_edit\";s:4:\"Edit\";s:11:\"user_status\";s:6:\"Status\";s:24:\"user_personal_infomation\";s:20:\"Personal Information\";s:17:\"user_display_name\";s:8:\"Username\";s:9:\"user_mail\";s:6:\"E-mail\";s:17:\"user_phone_number\";s:12:\"Phone Number\";s:17:\"user_home_airport\";s:12:\"Home Airport\";s:19:\"user_street_address\";s:7:\"Address\";s:9:\"user_city\";s:4:\"City\";s:26:\"user_state_province_region\";s:21:\"State/Province/Region\";s:25:\"user_zip_code_postal_code\";s:20:\"ZIP code/Postal code\";s:12:\"user_country\";s:7:\"Country\";s:17:\"user_save_changes\";s:12:\"Save Changes\";s:20:\"user_change_password\";s:15:\"Change Password\";s:21:\"user_current_password\";s:16:\"Current Password\";s:17:\"user_new_password\";s:12:\"New Password\";s:23:\"user_new_password_again\";s:18:\"New Password Again\";s:11:\"user_delete\";s:6:\"Delete\";s:11:\"user_avatar\";s:6:\"Avatar\";s:11:\"user_upload\";s:6:\"Upload\";s:24:\"user_update_successfully\";s:19:\"Update successfully\";s:6:\"action\";s:6:\"Action\";s:17:\"user_write_review\";s:12:\"Write Review\";s:21:\"user_write_review_for\";s:20:\"Write Review For: %s\";s:19:\"user_total_traveled\";s:14:\"Total Traveled\";s:13:\"user_overview\";s:8:\"Overview\";s:9:\"user_of_5\";s:4:\"of 5\";s:21:\"user_adults_occupancy\";s:16:\"Adults Occupancy\";s:11:\"user_childs\";s:6:\"Childs\";s:9:\"user_bebs\";s:4:\"Beds\";s:17:\"user_room_footage\";s:26:\"Room footage (square feet)\";s:11:\"no_activity\";s:11:\"No Activity\";s:7:\"no_cars\";s:7:\"No Cars\";s:9:\"no_cruise\";s:9:\"No Cruise\";s:15:\"no_cruise_cabin\";s:15:\"No Cruise Cabin\";s:8:\"no_hotel\";s:8:\"No Hotel\";s:9:\"no_rental\";s:9:\"No Rental\";s:7:\"no_room\";s:7:\"No Room\";s:8:\"no_tours\";s:8:\"No Tours\";s:13:\"my_activities\";s:13:\"My Activities\";s:7:\"my_cars\";s:7:\"My Cars\";s:9:\"my_cruise\";s:9:\"My Cruise\";s:15:\"my_cruise_cabin\";s:15:\"My Cruise Cabin\";s:8:\"my_hotel\";s:8:\"My Hotel\";s:9:\"my_rental\";s:9:\"My Rental\";s:7:\"my_room\";s:7:\"My Room\";s:8:\"my_tours\";s:8:\"My Tours\";s:26:\"user_create_activity_title\";s:5:\"Title\";s:28:\"user_create_activity_content\";s:7:\"Content\";s:32:\"user_create_activity_description\";s:11:\"Description\";s:35:\"user_create_activity_featured_image\";s:14:\"Featured Image\";s:28:\"user_create_activity_general\";s:7:\"General\";s:26:\"user_create_activity_email\";s:5:\"Email\";s:26:\"user_create_activity_phone\";s:5:\"Phone\";s:28:\"user_create_activity_website\";s:7:\"Website\";s:26:\"user_create_activity_video\";s:5:\"Video\";s:34:\"user_create_activity_style_gallery\";s:13:\"Gallery Style\";s:25:\"user_create_activity_grid\";s:4:\"Grid\";s:27:\"user_create_activity_slider\";s:6:\"Slider\";s:28:\"user_create_activity_gallery\";s:7:\"Gallery\";s:29:\"user_create_activity_location\";s:8:\"Location\";s:36:\"user_create_activity_location_search\";s:15:\"Location search\";s:28:\"user_create_activity_address\";s:7:\"Address\";s:29:\"user_create_activity_latitude\";s:8:\"Latitude\";s:30:\"user_create_activity_longitude\";s:9:\"Longitude\";s:29:\"user_create_activity_map_zoom\";s:8:\"Map Zoom\";s:25:\"user_create_activity_info\";s:4:\"Info\";s:31:\"user_create_activity_start_date\";s:10:\"Start date\";s:29:\"user_create_activity_end_date\";s:8:\"End date\";s:34:\"user_create_activity_activity_time\";s:15:\"Activity Timing\";s:29:\"user_create_activity_duration\";s:8:\"Duration\";s:37:\"user_create_activity_venue_facilities\";s:16:\"Venue Facilities\";s:26:\"user_create_activity_price\";s:5:\"Price\";s:29:\"user_create_activity_discount\";s:13:\"Discount rate\";s:41:\"user_create_activity_best_price_guarantee\";s:20:\"Best Price Guarantee\";s:46:\"user_create_activity_best_price_guarantee_text\";s:25:\"Best Price Guarantee Text\";s:37:\"user_create_activity_external_booking\";s:29:\"Activity External booking URL\";s:27:\"user_create_activity_on_off\";s:6:\"On-Off\";s:27:\"user_create_activity_submit\";s:6:\"SUBMIT\";s:21:\"user_create_car_title\";s:5:\"Title\";s:23:\"user_create_car_content\";s:7:\"Content\";s:27:\"user_create_car_description\";s:11:\"Description\";s:30:\"user_create_car_featured_image\";s:14:\"Featured Image\";s:22:\"user_create_car_detail\";s:11:\"Car Details\";s:24:\"user_create_car_category\";s:14:\"Car Categories\";s:31:\"user_create_car_pickup_features\";s:15:\"Pickup Features\";s:36:\"user_create_car_equipment_price_list\";s:20:\"Equipment Price List\";s:29:\"user_create_car_add_equipment\";s:13:\"Add Equipment\";s:24:\"user_create_car_features\";s:8:\"Features\";s:28:\"user_create_car_add_features\";s:12:\"Add Features\";s:21:\"user_create_car_video\";s:5:\"Video\";s:27:\"user_create_car_car_contact\";s:11:\"Car Contact\";s:20:\"user_create_car_logo\";s:4:\"Logo\";s:20:\"user_create_car_name\";s:4:\"Name\";s:21:\"user_create_car_email\";s:5:\"Email\";s:21:\"user_create_car_phone\";s:5:\"Phone\";s:21:\"user_create_car_about\";s:5:\"About\";s:24:\"user_create_car_location\";s:8:\"Location\";s:31:\"user_create_car_location_search\";s:15:\"Location search\";s:23:\"user_create_car_address\";s:7:\"Address\";s:21:\"user_create_car_price\";s:5:\"Price\";s:24:\"user_create_car_discount\";s:13:\"Discount rate\";s:32:\"user_create_car_external_booking\";s:24:\"Car external booking URL\";s:22:\"user_create_car_submit\";s:6:\"SUBMIT\";s:31:\"user_create_car_equipment_title\";s:5:\"Title\";s:31:\"user_create_car_equipment_price\";s:5:\"Price\";s:19:\"user_create_car_del\";s:3:\"Del\";s:35:\"user_create_car_features_attributes\";s:9:\"Amenities\";s:40:\"user_create_car_features_attributes_info\";s:15:\"Attributes Info\";s:23:\"user_create_car_no_data\";s:7:\"No data\";s:24:\"user_create_cruise_title\";s:5:\"Title\";s:26:\"user_create_cruise_content\";s:7:\"Content\";s:30:\"user_create_cruise_description\";s:11:\"Description\";s:33:\"user_create_cruise_featured_image\";s:14:\"Featured Image\";s:25:\"user_create_cruise_detail\";s:13:\"cruise Detail\";s:29:\"user_create_cruise_attributes\";s:9:\"Amenities\";s:47:\"user_create_cruise_number_of_children_stay_free\";s:28:\"Number of children stay free\";s:24:\"user_create_cruise_email\";s:12:\"Cruise Email\";s:26:\"user_create_cruise_website\";s:14:\"Cruise Website\";s:24:\"user_create_cruise_phone\";s:12:\"Cruise Phone\";s:29:\"user_create_cruise_fax_number\";s:10:\"Fax Number\";s:24:\"user_create_cruise_video\";s:5:\"Video\";s:28:\"user_create_cruise_programes\";s:9:\"Programes\";s:30:\"user_create_cruise_add_program\";s:11:\"Add Program\";s:27:\"user_create_cruise_location\";s:8:\"Location\";s:26:\"user_create_cruise_address\";s:7:\"Address\";s:27:\"user_create_cruise_latitude\";s:8:\"Latitude\";s:28:\"user_create_cruise_longitude\";s:9:\"Longitude\";s:27:\"user_create_cruise_map_zoom\";s:8:\"Map Zoom\";s:26:\"user_create_cruise_gallery\";s:7:\"Gallery\";s:25:\"user_create_cruise_submit\";s:6:\"SUBMIT\";s:32:\"user_create_cruise_program_title\";s:5:\"Title\";s:31:\"user_create_cruise_program_desc\";s:11:\"Description\";s:22:\"user_create_cruise_del\";s:3:\"Del\";s:30:\"user_create_cruise_cabin_title\";s:5:\"Title\";s:32:\"user_create_cruise_cabin_content\";s:7:\"Content\";s:36:\"user_create_cruise_cabin_description\";s:11:\"Description\";s:39:\"user_create_cruise_cabin_featured_image\";s:14:\"Featured Image\";s:31:\"user_create_cruise_cabin_detail\";s:19:\"Cruise Cabin Detail\";s:29:\"user_create_cruise_cabin_type\";s:10:\"Cabin Type\";s:35:\"user_create_cruise_cabin_attributes\";s:9:\"Amenities\";s:37:\"user_create_cruise_cabin_title_cruise\";s:6:\"Cruise\";s:31:\"user_create_cruise_cabin_search\";s:6:\"Search\";s:35:\"user_create_cruise_cabin_max_adults\";s:10:\"Max Adults\";s:37:\"user_create_cruise_cabin_max_children\";s:12:\"Max children\";s:33:\"user_create_cruise_cabin_beb_size\";s:8:\"Beb size\";s:29:\"user_create_cruise_cabin_size\";s:10:\"Cabin size\";s:33:\"user_create_cruise_cabin_features\";s:8:\"Features\";s:37:\"user_create_cruise_cabin_add_features\";s:12:\"Add Features\";s:30:\"user_create_cruise_cabin_price\";s:5:\"Price\";s:33:\"user_create_cruise_cabin_discount\";s:13:\"Discount rate\";s:31:\"user_create_cruise_cabin_submit\";s:6:\"SUBMIT\";s:39:\"user_create_cruise_cabin_features_title\";s:5:\"Title\";s:40:\"user_create_cruise_cabin_features_number\";s:6:\"Number\";s:38:\"user_create_cruise_cabin_features_icon\";s:4:\"Icon\";s:37:\"user_create_cruise_cabin_features_del\";s:3:\"Del\";s:23:\"user_create_hotel_title\";s:5:\"Title\";s:25:\"user_create_hotel_content\";s:7:\"Content\";s:29:\"user_create_hotel_description\";s:11:\"Description\";s:32:\"user_create_hotel_featured_image\";s:14:\"Featured Image\";s:24:\"user_create_hotel_detail\";s:13:\"Hotel Details\";s:28:\"user_create_hotel_attributes\";s:9:\"Amenities\";s:23:\"user_create_hotel_email\";s:11:\"Hotel Email\";s:25:\"user_create_hotel_website\";s:13:\"Hotel Website\";s:23:\"user_create_hotel_phone\";s:11:\"Hotel Phone\";s:28:\"user_create_hotel_fax_number\";s:10:\"Fax Number\";s:23:\"user_create_hotel_video\";s:5:\"Video\";s:24:\"user_create_hotel_search\";s:6:\"Search\";s:26:\"user_create_hotel_location\";s:8:\"Location\";s:25:\"user_create_hotel_address\";s:7:\"Address\";s:26:\"user_create_hotel_latitude\";s:8:\"Latitude\";s:27:\"user_create_hotel_longitude\";s:9:\"Longitude\";s:26:\"user_create_hotel_map_zoom\";s:8:\"Map Zoom\";s:22:\"user_create_hotel_logo\";s:4:\"Logo\";s:25:\"user_create_hotel_gallery\";s:7:\"Gallery\";s:24:\"user_create_hotel_submit\";s:6:\"SUBMIT\";s:24:\"user_create_rental_title\";s:5:\"Title\";s:26:\"user_create_rental_content\";s:7:\"Content\";s:30:\"user_create_rental_description\";s:11:\"Description\";s:33:\"user_create_rental_featured_image\";s:14:\"Featured Image\";s:25:\"user_create_rental_detail\";s:14:\"Rental Details\";s:29:\"user_create_rental_attributes\";s:9:\"Amenities\";s:24:\"user_create_rental_email\";s:12:\"Rental Email\";s:26:\"user_create_rental_website\";s:14:\"Rental Website\";s:24:\"user_create_rental_phone\";s:12:\"Rental Phone\";s:24:\"user_create_rental_video\";s:5:\"Video\";s:27:\"user_create_rental_features\";s:8:\"Features\";s:31:\"user_create_rental_add_features\";s:12:\"Add Features\";s:25:\"user_create_rental_search\";s:6:\"Search\";s:27:\"user_create_rental_location\";s:8:\"Location\";s:26:\"user_create_rental_address\";s:7:\"Address\";s:27:\"user_create_rental_latitude\";s:8:\"Latitude\";s:28:\"user_create_rental_longitude\";s:9:\"Longitude\";s:27:\"user_create_rental_map_zoom\";s:8:\"Map Zoom\";s:24:\"user_create_rental_price\";s:5:\"Price\";s:27:\"user_create_rental_discount\";s:13:\"Discount rate\";s:35:\"user_create_rental_external_booking\";s:23:\"Rental external booking\";s:26:\"user_create_rental_gallery\";s:7:\"Gallery\";s:25:\"user_create_rental_submit\";s:6:\"SUBMIT\";s:33:\"user_create_rental_features_title\";s:5:\"Title\";s:34:\"user_create_rental_features_number\";s:6:\"Number\";s:32:\"user_create_rental_features_icon\";s:4:\"Icon\";s:31:\"user_create_rental_features_del\";s:3:\"Del\";s:22:\"user_create_room_title\";s:5:\"Title\";s:24:\"user_create_room_content\";s:7:\"Content\";s:28:\"user_create_room_description\";s:11:\"Description\";s:21:\"user_create_room_type\";s:9:\"Room Type\";s:27:\"user_create_room_attributes\";s:9:\"Amenities\";s:29:\"user_create_room_select_hotel\";s:5:\"Hotel\";s:23:\"user_create_room_search\";s:6:\"Search\";s:31:\"user_create_room_featured_image\";s:14:\"Featured Image\";s:28:\"user_create_room_number_room\";s:15:\"Number of Rooms\";s:32:\"user_create_room_price_per_night\";s:15:\"Price Per night\";s:39:\"user_create_hotel_room_external_booking\";s:22:\"Room external booking \";s:25:\"user_create_room_facility\";s:9:\"Room Info\";s:30:\"user_create_room_adults_number\";s:16:\"Number of Adults\";s:32:\"user_create_room_children_number\";s:18:\"Number of Children\";s:28:\"user_create_room_beds_number\";s:14:\"Number of Beds\";s:29:\"user_create_room_room_footage\";s:26:\"Room footage (square feet)\";s:25:\"user_create_room_location\";s:8:\"Location\";s:24:\"user_create_room_address\";s:7:\"Address\";s:25:\"user_create_room_latitude\";s:8:\"Latitude\";s:26:\"user_create_room_longitude\";s:9:\"Longitude\";s:25:\"user_create_room_map_zoom\";s:8:\"Map Zoom\";s:22:\"user_create_room_price\";s:5:\"Price\";s:25:\"user_create_room_discount\";s:13:\"Discount rate\";s:24:\"user_create_room_gallery\";s:7:\"Gallery\";s:23:\"user_create_room_submit\";s:6:\"SUBMIT\";s:31:\"user_create_room_features_title\";s:5:\"Title\";s:32:\"user_create_room_features_number\";s:6:\"Number\";s:30:\"user_create_room_features_icon\";s:4:\"Icon\";s:29:\"user_create_room_features_del\";s:3:\"Del\";s:22:\"user_create_tour_title\";s:5:\"Title\";s:24:\"user_create_tour_content\";s:7:\"Content\";s:28:\"user_create_tour_description\";s:11:\"Description\";s:31:\"user_create_tour_featured_image\";s:14:\"Featured Image\";s:24:\"user_create_tour_general\";s:7:\"General\";s:21:\"user_create_tour_type\";s:9:\"Tour Type\";s:22:\"user_create_tour_email\";s:5:\"Email\";s:22:\"user_create_tour_video\";s:5:\"Video\";s:30:\"user_create_tour_style_gallery\";s:13:\"Gallery Style\";s:21:\"user_create_tour_grid\";s:4:\"Grid\";s:23:\"user_create_tour_slider\";s:6:\"Slider\";s:24:\"user_create_tour_gallery\";s:7:\"Gallery\";s:25:\"user_create_tour_location\";s:8:\"Location\";s:32:\"user_create_tour_location_search\";s:15:\"Location search\";s:24:\"user_create_tour_address\";s:7:\"Address\";s:25:\"user_create_tour_latitude\";s:8:\"Latitude\";s:26:\"user_create_tour_longitude\";s:9:\"Longitude\";s:25:\"user_create_tour_map_zoom\";s:8:\"Map Zoom\";s:22:\"user_create_tour_price\";s:5:\"Price\";s:25:\"user_create_tour_discount\";s:13:\"Discount rate\";s:33:\"user_create_tour_external_booking\";s:25:\"Tour external booking URL\";s:21:\"user_create_tour_info\";s:4:\"Info\";s:25:\"user_create_tour_duration\";s:15:\"Duration (days)\";s:27:\"user_create_tour_max_people\";s:24:\"Maximum number of people\";s:24:\"user_create_tour_program\";s:13:\"Tours program\";s:28:\"user_create_tour_add_program\";s:11:\"Add Program\";s:23:\"user_create_tour_submit\";s:6:\"SUBMIT\";s:30:\"user_create_tour_program_title\";s:5:\"Title\";s:29:\"user_create_tour_program_desc\";s:11:\"Description\";s:28:\"user_create_tour_program_del\";s:3:\"Del\";s:8:\"required\";s:25:\"The %s field is required.\";s:5:\"isset\";s:31:\"The %s field must have a value.\";s:11:\"valid_email\";s:48:\"The %s field must contain a valid email address.\";s:12:\"valid_emails\";s:52:\"The %s field must contain all valid email addresses.\";s:9:\"valid_url\";s:61:\"The %s field must contain a valid URL. Ex \"http://domain.com\"\";s:8:\"valid_ip\";s:37:\"The %s field must contain a valid IP.\";s:10:\"min_length\";s:54:\"The %s field must be at least %s characters in length.\";s:10:\"max_length\";s:52:\"The %s field can not exceed %s characters in length.\";s:12:\"exact_length\";s:53:\"The %s field must be exactly %s characters in length.\";s:5:\"alpha\";s:54:\"The %s field may only contain alphabetical characters.\";s:13:\"alpha_numeric\";s:55:\"The %s field may only contain alpha-numeric characters.\";s:10:\"alpha_dash\";s:80:\"The %s field may only contain alpha-numeric characters, underscores, and dashes.\";s:7:\"numeric\";s:39:\"The %s field must contain only numbers.\";s:10:\"is_numeric\";s:50:\"The %s field must contain only numeric characters.\";s:7:\"integer\";s:37:\"The %s field must contain an integer.\";s:11:\"regex_match\";s:42:\"The %s field is not in the correct format.\";s:7:\"matches\";s:41:\"The %s field does not match the %s field.\";s:9:\"is_unique\";s:41:\"The %s field must contain a unique value.\";s:10:\"is_natural\";s:48:\"The %s field must contain only positive numbers.\";s:18:\"is_natural_no_zero\";s:53:\"The %s field must contain a number greater than zero.\";s:7:\"decimal\";s:43:\"The %s field must contain a decimal number.\";s:9:\"less_than\";s:48:\"The %s field must contain a number less than %s.\";s:12:\"greater_than\";s:51:\"The %s field must contain a number greater than %s.\";s:16:\"unsigned_integer\";s:27:\"The %s field positive digit\";s:7:\"explore\";s:7:\"Explore\";s:11:\"hotels_from\";s:11:\"Hotels from\";s:12:\"rentals_from\";s:12:\"Rentals from\";s:9:\"cars_from\";s:9:\"Cars from\";s:10:\"tours_from\";s:10:\"Tours from\";s:20:\"activities_this_week\";s:20:\"Activities this Week\";s:6:\"person\";s:6:\"person\";s:16:\"last_minute_deal\";s:16:\"Last Minute Deal\";}', 'yes'),
(207, 'st_withdrawal_table_version', '1.2.10', 'yes'),
(208, 'st_inbox_table_version', '1.5.2', 'yes'),
(209, 'neworder_table_version', '2.0.3', 'yes'),
(210, 'st_hotel_table_version', '1.3.5', 'yes'),
(211, 'st_hotel_room_table_version', '1.3.1', 'yes'),
(212, 'st_activity_table_version', '1.3.0', 'yes'),
(213, 'st_tours_table_version', '1.3.2', 'yes'),
(214, 'st_cars_table_version', '1.3.1', 'yes'),
(215, 'st_journey_car_table_version', '1.0.1', 'yes'),
(216, 'st_rental_table_version', '1.3.0', 'yes'),
(217, 'availability_table_version', '1.2.9', 'yes'),
(218, 'st_cronjob_log_version', '1.0', 'yes'),
(219, 'st_room_availability_version', '1.1', 'yes'),
(220, 'st_activity_availability_version', '1.0.5', 'yes'),
(221, 'st_tour_availability_version', '1.1.9', 'yes'),
(222, 'st_rental_availability_version', '1.2.4', 'yes'),
(223, 'st_user_online_table_version', '1.6.0', 'yes'),
(224, 'st_form_builder_table_version', '1.0.1', 'yes'),
(225, 'st_flight_airport_table_version', '1.0.1', 'yes'),
(226, 'st_flight_availability_version', '1.1.7', 'yes'),
(227, 'st_flight_location_table_version', '2.0.0', 'yes'),
(228, 'st_flights_table_version', '1.0.4', 'yes'),
(229, 'st_upgrade_order', '1', 'yes'),
(230, 'st_upgrade_availability', '1', 'yes'),
(231, 'location_nested_table_version', '1.0.1', 'yes'),
(232, 'properties_table_version', '1.0.0', 'yes'),
(233, 'location_relationships_table_version', '1.0.0', 'yes'),
(234, 'st_availability_cronjob', '1', 'yes'),
(236, 'member_packages_version', '1.0.5', 'yes'),
(237, 'member_packages_order_version', '1.0.6', 'yes'),
(238, 'st_activity_availability_fill_old_data', '1', 'yes'),
(239, 'st_tour_availability_fill_old_data', '1', 'yes'),
(240, 'st_tour_availability_fill_old_starttime_data', '1', 'yes'),
(241, 'st_allow_save_location', 'not_allow', 'yes'),
(242, '_wp_session_46dde1fc9cff90e3aec8cad71f73a4ce', 'a:0:{}', 'yes'),
(243, '_wp_session_expires_46dde1fc9cff90e3aec8cad71f73a4ce', '1614364817', 'yes'),
(244, 'st_run_fill_old_order_once_st_hotel_2018_04_21', '1', 'yes'),
(245, 'st_run_fill_old_order_once_hotel_room_2018_04_21', '1', 'yes'),
(246, 'st_run_fill_old_order_once_st_tours_2018_04_21', '1', 'yes'),
(247, 'st_run_fill_old_order_once_st_activity_2018_04_21', '1', 'yes'),
(248, 'st_upgrade_order_2_0_3', 'updated', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(249, 'st_option_tree_settings_new', 'a:389:{i:0;a:4:{s:2:\"id\";s:11:\"general_tab\";s:5:\"label\";s:15:\"General Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_general\";}i:1;a:6:{s:2:\"id\";s:23:\"enable_user_online_noti\";s:5:\"label\";s:22:\"User notification info\";s:4:\"desc\";s:42:\"Enable/disable online notification of user\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:2:\"on\";}i:2;a:6:{s:2:\"id\";s:24:\"enable_last_booking_noti\";s:5:\"label\";s:25:\"Last booking notification\";s:4:\"desc\";s:43:\"Enable/disable notification of last booking\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:2:\"on\";}i:3;a:6:{s:2:\"id\";s:15:\"enable_user_nav\";s:5:\"label\";s:14:\"User navigator\";s:4:\"desc\";s:34:\"Enable/disable user dashboard menu\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:2:\"on\";}i:4;a:7:{s:2:\"id\";s:13:\"noti_position\";s:5:\"label\";s:21:\"Notification position\";s:4:\"desc\";s:30:\"The position to appear notices\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:8:\"topRight\";s:7:\"choices\";a:4:{i:0;a:2:{s:5:\"label\";s:9:\"Top Right\";s:5:\"value\";s:8:\"topRight\";}i:1;a:2:{s:5:\"label\";s:8:\"Top Left\";s:5:\"value\";s:7:\"topLeft\";}i:2;a:2:{s:5:\"label\";s:12:\"Bottom Right\";s:5:\"value\";s:11:\"bottomRight\";}i:3;a:2:{s:5:\"label\";s:11:\"Bottom Left\";s:5:\"value\";s:10:\"bottomLeft\";}}}i:5;a:6:{s:2:\"id\";s:22:\"admin_menu_normal_user\";s:5:\"label\";s:20:\"Normal user adminbar\";s:4:\"desc\";s:27:\"Show/hide adminbar for user\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:3:\"off\";}i:6;a:6:{s:2:\"id\";s:34:\"once_notification_per_each_session\";s:5:\"label\";s:38:\"Only show notification for per session\";s:4:\"desc\";s:57:\"Only show the unique notification for each user\'s session\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:3:\"off\";}i:7;a:7:{s:2:\"id\";s:20:\"st_weather_temp_unit\";s:5:\"label\";s:12:\"Weather unit\";s:4:\"desc\";s:64:\"The unit of weather- you can use Fahrenheit or Celsius or Kelvin\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:1:\"c\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"label\";s:14:\"Fahrenheit (f)\";s:5:\"value\";s:1:\"f\";}i:1;a:2:{s:5:\"label\";s:11:\"Celsius (c)\";s:5:\"value\";s:1:\"c\";}i:2;a:2:{s:5:\"label\";s:10:\"Kelvin (k)\";s:5:\"value\";s:1:\"k\";}}}i:8;a:6:{s:2:\"id\";s:21:\"search_enable_preload\";s:5:\"label\";s:14:\"Preload option\";s:4:\"desc\";s:32:\"Enable Preload when loading site\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:2:\"on\";}i:9;a:6:{s:2:\"id\";s:20:\"search_preload_image\";s:5:\"label\";s:13:\"Preload image\";s:4:\"desc\";s:34:\"This is the background for preload\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";s:9:\"condition\";s:28:\"search_enable_preload:is(on)\";}i:10;a:7:{s:2:\"id\";s:27:\"search_preload_icon_default\";s:5:\"label\";s:24:\"Customize preloader icon\";s:4:\"desc\";s:25:\"Using custom preload icon\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:9:\"condition\";s:28:\"search_enable_preload:is(on)\";s:3:\"std\";s:3:\"off\";}i:11;a:7:{s:2:\"id\";s:26:\"search_preload_icon_custom\";s:5:\"label\";s:27:\"Upload custom preload image\";s:4:\"desc\";s:29:\"This is the image for preload\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";s:8:\"operator\";s:3:\"and\";s:9:\"condition\";s:63:\"search_preload_icon_default:is(on),search_enable_preload:is(on)\";}i:12;a:6:{s:2:\"id\";s:21:\"list_disabled_feature\";s:5:\"label\";s:28:\"Disable Theme Service Option\";s:4:\"desc\";s:123:\"Hide one or many services of theme. In order to disable services (holtel, tour,..) you do not use, please tick the checkbox\";s:4:\"type\";s:8:\"checkbox\";s:7:\"section\";s:14:\"option_general\";s:7:\"choices\";a:6:{i:0;a:2:{s:5:\"label\";s:5:\"Hotel\";s:5:\"value\";s:8:\"st_hotel\";}i:1;a:2:{s:5:\"label\";s:3:\"Car\";s:5:\"value\";s:7:\"st_cars\";}i:2;a:2:{s:5:\"label\";s:6:\"Rental\";s:5:\"value\";s:9:\"st_rental\";}i:3;a:2:{s:5:\"label\";s:4:\"Tour\";s:5:\"value\";s:8:\"st_tours\";}i:4;a:2:{s:5:\"label\";s:8:\"Activity\";s:5:\"value\";s:11:\"st_activity\";}i:5;a:2:{s:5:\"label\";s:6:\"Flight\";s:5:\"value\";s:9:\"st_flight\";}}}i:13;a:4:{s:2:\"id\";s:8:\"logo_tab\";s:5:\"label\";s:4:\"Logo\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_general\";}i:14;a:5:{s:2:\"id\";s:4:\"logo\";s:5:\"label\";s:12:\"Logo options\";s:4:\"desc\";s:14:\"To change logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";}i:15;a:5:{s:2:\"id\";s:8:\"logo_new\";s:5:\"label\";s:11:\"Modern Logo\";s:4:\"desc\";s:21:\"To change modern logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";}i:16;a:5:{s:2:\"id\";s:14:\"logo_dashboard\";s:5:\"label\";s:19:\"Logo user dashboard\";s:4:\"desc\";s:29:\"To change user dashboard logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";}i:17;a:7:{s:2:\"id\";s:11:\"logo_retina\";s:5:\"label\";s:11:\"Retina logo\";s:4:\"desc\";s:190:\"Note: You MUST re-name Logo Retina to logo-name@2x.ext-name. Example:<br>\r\n                                    Logo is: <em>my-logo.jpg</em><br>Logo Retina must be: <em>my-logo@2x.jpg</em>  \";s:6:\"v_hint\";s:3:\"yes\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:70:\"http://localhost/tourphoria/wp-content/themes/traveler/img/logo@2x.png\";}i:18;a:6:{s:2:\"id\";s:11:\"logo_mobile\";s:5:\"label\";s:11:\"Mobile logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";s:3:\"std\";s:0:\"\";s:4:\"desc\";s:37:\"To change logo used for mobile screen\";}i:19;a:5:{s:2:\"id\";s:7:\"favicon\";s:5:\"label\";s:7:\"Favicon\";s:4:\"desc\";s:17:\"To change favicon\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";}i:20;a:4:{s:2:\"id\";s:7:\"404_tab\";s:5:\"label\";s:11:\"404 Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_general\";}i:21;a:5:{s:2:\"id\";s:6:\"404_bg\";s:5:\"label\";s:23:\"Background for 404 page\";s:4:\"desc\";s:39:\"To change background for 404 error page\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_general\";}i:22;a:6:{s:2:\"id\";s:8:\"404_text\";s:5:\"label\";s:16:\"Text of 404 page\";s:4:\"desc\";s:27:\"To change text for 404 page\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:1:\"3\";s:7:\"section\";s:14:\"option_general\";}i:23;a:4:{s:2:\"id\";s:7:\"seo_tab\";s:5:\"label\";s:11:\"SEO Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_general\";}i:24;a:7:{s:2:\"id\";s:13:\"st_seo_option\";s:5:\"label\";s:15:\"Enable SEO info\";s:4:\"desc\";s:21:\"Show/hide SEO feature\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";}i:25;a:8:{s:2:\"id\";s:12:\"st_seo_title\";s:5:\"label\";s:10:\"Site title\";s:4:\"desc\";s:19:\"To change SEO title\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";s:9:\"condition\";s:20:\"st_seo_option:is(on)\";}i:26;a:9:{s:2:\"id\";s:11:\"st_seo_desc\";s:5:\"label\";s:16:\"Site description\";s:4:\"desc\";s:25:\"To change SEO description\";s:3:\"std\";s:0:\"\";s:4:\"rows\";s:1:\"5\";s:4:\"type\";s:15:\"textarea-simple\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";s:9:\"condition\";s:20:\"st_seo_option:is(on)\";}i:27;a:9:{s:2:\"id\";s:15:\"st_seo_keywords\";s:5:\"label\";s:13:\"Site keywords\";s:4:\"desc\";s:34:\"To change the list of SEO keywords\";s:3:\"std\";s:0:\"\";s:4:\"rows\";s:1:\"5\";s:4:\"type\";s:15:\"textarea-simple\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";s:9:\"condition\";s:20:\"st_seo_option:is(on)\";}i:28;a:4:{s:2:\"id\";s:9:\"login_tab\";s:5:\"label\";s:13:\"Login Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_general\";}i:29;a:7:{s:2:\"id\";s:20:\"enable_captcha_login\";s:5:\"label\";s:27:\"Enable Google Captcha Login\";s:4:\"desc\";s:120:\"Show/hide google captcha for page login and register. Note: This function not support for popup login and popup register\";s:3:\"std\";s:3:\"off\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";}i:30;a:8:{s:2:\"id\";s:13:\"recaptcha_key\";s:5:\"label\";s:14:\"Re-Captcha Key\";s:4:\"desc\";s:0:\"\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";s:9:\"condition\";s:27:\"enable_captcha_login:is(on)\";}i:31;a:8:{s:2:\"id\";s:19:\"recaptcha_secretkey\";s:5:\"label\";s:21:\"Re-Captcha Secret Key\";s:4:\"desc\";s:0:\"\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_general\";s:5:\"class\";s:0:\"\";s:9:\"condition\";s:27:\"enable_captcha_login:is(on)\";}i:32;a:4:{s:2:\"id\";s:17:\"general_style_tab\";s:5:\"label\";s:7:\"General\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:12:\"option_style\";}i:33;a:7:{s:2:\"id\";s:14:\"st_theme_style\";s:5:\"label\";s:11:\"Theme style\";s:4:\"desc\";s:42:\"Showing classic or modern style for theme.\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:12:\"option_style\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:7:\"classic\";s:5:\"label\";s:7:\"Classic\";}i:1;a:2:{s:5:\"value\";s:6:\"modern\";s:5:\"label\";s:6:\"Modern\";}}s:3:\"std\";s:7:\"classic\";}i:34;a:7:{s:2:\"id\";s:13:\"right_to_left\";s:5:\"label\";s:18:\"Right to left mode\";s:4:\"desc\";s:49:\"Enable \"Right to let\" displaying mode for content\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:0:\"\";s:3:\"std\";s:3:\"off\";}i:35;a:6:{s:2:\"id\";s:12:\"style_layout\";s:5:\"label\";s:6:\"Layout\";s:4:\"desc\";s:42:\"You can choose wide layout or boxed layout\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:12:\"option_style\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"wide\";s:5:\"label\";s:4:\"Wide\";}i:1;a:2:{s:5:\"value\";s:5:\"boxed\";s:5:\"label\";s:5:\"Boxed\";}}}i:36;a:7:{s:2:\"id\";s:10:\"typography\";s:5:\"label\";s:24:\"Typography, Google Fonts\";s:4:\"desc\";s:29:\"To change the display of text\";s:4:\"type\";s:10:\"typography\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:4:\"body\";s:5:\"fonts\";b:0;}i:37;a:6:{s:2:\"id\";s:12:\"google_fonts\";s:5:\"label\";s:12:\"Google Fonts\";s:4:\"type\";s:12:\"google-fonts\";s:7:\"section\";s:12:\"option_style\";s:6:\"choose\";a:0:{}s:3:\"std\";b:0;}i:38;a:5:{s:2:\"id\";s:10:\"star_color\";s:5:\"label\";s:10:\"Star color\";s:4:\"desc\";s:33:\"To change the color of star hotel\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";}i:39;a:7:{s:2:\"id\";s:15:\"body_background\";s:5:\"label\";s:15:\"Body Background\";s:4:\"desc\";s:45:\"To change the color, background image of body\";s:4:\"type\";s:10:\"background\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:4:\"body\";s:3:\"std\";a:2:{s:16:\"background-color\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}}i:40;a:7:{s:2:\"id\";s:20:\"main_wrap_background\";s:5:\"label\";s:15:\"Wrap background\";s:4:\"desc\";s:75:\"To change background color, bachground image of box surrounding the content\";s:4:\"type\";s:10:\"background\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:12:\".global-wrap\";s:3:\"std\";a:2:{s:16:\"background-color\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}}i:41;a:8:{s:2:\"id\";s:20:\"style_default_scheme\";s:5:\"label\";s:20:\"Default Color Scheme\";s:4:\"desc\";s:41:\"Select  available color scheme to display\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:0:\"\";s:3:\"std\";s:0:\"\";s:7:\"choices\";a:16:{i:0;a:2:{s:5:\"label\";s:20:\"-- Please Select ---\";s:5:\"value\";s:0:\"\";}i:1;a:2:{s:5:\"label\";s:16:\"Bright Turquoise\";s:5:\"value\";s:7:\"#0EBCF2\";}i:2;a:2:{s:5:\"label\";s:12:\"Turkish Rose\";s:5:\"value\";s:7:\"#B66672\";}i:3;a:2:{s:5:\"label\";s:5:\"Salem\";s:5:\"value\";s:7:\"#12A641\";}i:4;a:2:{s:5:\"label\";s:11:\"Hippie Blue\";s:5:\"value\";s:7:\"#4F96B6\";}i:5;a:2:{s:5:\"label\";s:5:\"Mandy\";s:5:\"value\";s:7:\"#E45E66\";}i:6;a:2:{s:5:\"label\";s:11:\"Green Smoke\";s:5:\"value\";s:7:\"#96AA66\";}i:7;a:2:{s:5:\"label\";s:7:\"Horizon\";s:5:\"value\";s:7:\"#5B84AA\";}i:8;a:2:{s:5:\"label\";s:6:\"Cerise\";s:5:\"value\";s:7:\"#CA2AC6\";}i:9;a:2:{s:5:\"label\";s:9:\"Brick red\";s:5:\"value\";s:7:\"#cf315a\";}i:10;a:2:{s:5:\"label\";s:7:\"De-York\";s:5:\"value\";s:7:\"#74C683\";}i:11;a:2:{s:5:\"label\";s:8:\"Shamrock\";s:5:\"value\";s:7:\"#30BBB1\";}i:12;a:2:{s:5:\"label\";s:6:\"Studio\";s:5:\"value\";s:7:\"#7646B8\";}i:13;a:2:{s:5:\"label\";s:7:\"Leather\";s:5:\"value\";s:7:\"#966650\";}i:14;a:2:{s:5:\"label\";s:5:\"Denim\";s:5:\"value\";s:7:\"#1A5AE4\";}i:15;a:2:{s:5:\"label\";s:7:\"Scarlet\";s:5:\"value\";s:7:\"#FF1D13\";}}}i:42;a:6:{s:2:\"id\";s:10:\"main_color\";s:5:\"label\";s:10:\"Main Color\";s:4:\"desc\";s:32:\"To change the main color for web\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:7:\"#ed8323\";}i:43;a:5:{s:2:\"id\";s:10:\"custom_css\";s:5:\"label\";s:10:\"CSS custom\";s:4:\"desc\";s:39:\"Use CSS Code to customize the interface\";s:4:\"type\";s:3:\"css\";s:7:\"section\";s:12:\"option_style\";}i:44;a:4:{s:2:\"id\";s:10:\"header_tab\";s:5:\"label\";s:6:\"Header\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:12:\"option_style\";}i:45;a:7:{s:2:\"id\";s:17:\"header_background\";s:5:\"label\";s:17:\"Header background\";s:4:\"desc\";s:62:\"To change background color, background image of header section\";s:4:\"type\";s:10:\"background\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:38:\".header-top, .menu-style-2 .header-top\";s:3:\"std\";a:2:{s:16:\"background-color\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}}i:46;a:6:{s:2:\"id\";s:24:\"gen_enable_sticky_header\";s:5:\"label\";s:13:\"Sticky header\";s:4:\"desc\";s:28:\"Enable fixed mode for header\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:3:\"off\";}i:47;a:6:{s:2:\"id\";s:16:\"sort_header_menu\";s:5:\"label\";s:17:\"Header menu items\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_style\";s:4:\"desc\";s:50:\"Select  items displaying at the right of main menu\";s:8:\"settings\";a:4:{i:0;a:5:{s:2:\"id\";s:11:\"header_item\";s:5:\"label\";s:4:\"Item\";s:4:\"type\";s:6:\"select\";s:4:\"desc\";s:40:\"Select header item shown in header right\";s:7:\"choices\";a:6:{i:0;a:2:{s:5:\"value\";s:5:\"login\";s:5:\"label\";s:5:\"Login\";}i:1;a:2:{s:5:\"value\";s:8:\"currency\";s:5:\"label\";s:8:\"Currency\";}i:2;a:2:{s:5:\"value\";s:8:\"language\";s:5:\"label\";s:8:\"Language\";}i:3;a:2:{s:5:\"value\";s:6:\"search\";s:5:\"label\";s:13:\"Search Header\";}i:4;a:2:{s:5:\"value\";s:13:\"shopping_cart\";s:5:\"label\";s:13:\"Shopping Cart\";}i:5;a:2:{s:5:\"value\";s:4:\"link\";s:5:\"label\";s:11:\"Custom Link\";}}}i:1;a:4:{s:2:\"id\";s:18:\"header_custom_link\";s:5:\"label\";s:4:\"Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"header_item:is(link)\";}i:2;a:4:{s:2:\"id\";s:24:\"header_custom_link_title\";s:5:\"label\";s:10:\"Title Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"header_item:is(link)\";}i:3;a:5:{s:2:\"id\";s:23:\"header_custom_link_icon\";s:5:\"label\";s:9:\"Icon Link\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:60:\"Enter a awesome font icon. Example: <code>fa-facebook</code>\";s:9:\"condition\";s:20:\"header_item:is(link)\";}}}i:48;a:4:{s:2:\"id\";s:8:\"menu_bar\";s:5:\"label\";s:4:\"Menu\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:12:\"option_style\";}i:49;a:6:{s:2:\"id\";s:22:\"gen_enable_sticky_menu\";s:5:\"label\";s:11:\"Sticky menu\";s:4:\"desc\";s:55:\"This allows you to turn on or off \"Sticky Menu Feature\"\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:3:\"off\";}i:50;a:8:{s:2:\"id\";s:10:\"menu_style\";s:5:\"label\";s:17:\"Select menu style\";s:4:\"desc\";s:50:\"Select  styles of menu ( it is default as style 1)\";s:4:\"type\";s:11:\"radio-image\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:1:\"1\";s:7:\"choices\";a:2:{i:0;a:3:{s:2:\"id\";s:1:\"1\";s:3:\"alt\";s:7:\"Default\";s:3:\"src\";s:67:\"http://localhost/tourphoria/wp-content/themes/traveler/img/nav1.png\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:3:\"alt\";s:11:\"Logo Center\";s:3:\"src\";s:71:\"http://localhost/tourphoria/wp-content/themes/traveler/img/nav2-new.png\";}}s:9:\"condition\";s:26:\"st_theme_style:is(classic)\";}i:51;a:8:{s:2:\"id\";s:17:\"menu_style_modern\";s:5:\"label\";s:17:\"Select menu style\";s:4:\"desc\";s:50:\"Select  styles of menu ( it is default as style 1)\";s:4:\"type\";s:11:\"radio-image\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:1:\"1\";s:7:\"choices\";a:1:{i:0;a:3:{s:2:\"id\";s:1:\"1\";s:3:\"alt\";s:7:\"Default\";s:3:\"src\";s:67:\"http://localhost/tourphoria/wp-content/themes/traveler/img/nav3.png\";}}s:9:\"condition\";s:25:\"st_theme_style:is(modern)\";}i:52;a:6:{s:2:\"id\";s:14:\"allow_megamenu\";s:5:\"label\";s:9:\"Mega menu\";s:4:\"desc\";s:16:\"Enable Mega Menu\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:3:\"off\";}i:53;a:6:{s:2:\"id\";s:20:\"mega_menu_background\";s:5:\"label\";s:20:\"Mega Menu background\";s:4:\"desc\";s:32:\"To change mega menu\'s background\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:7:\"#ffffff\";}i:54;a:6:{s:2:\"id\";s:15:\"mega_menu_color\";s:5:\"label\";s:15:\"Mega Menu color\";s:4:\"desc\";s:27:\"To change mega menu\'s color\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:7:\"#333333\";}i:55;a:8:{s:2:\"id\";s:10:\"menu_color\";s:5:\"label\";s:10:\"Menu color\";s:4:\"desc\";s:28:\"To change the color for menu\";s:4:\"type\";s:10:\"typography\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:7:\"#333333\";s:6:\"output\";s:174:\".st_menu ul.slimmenu li a, .st_menu ul.slimmenu li .sub-toggle>i,.menu-style-2 ul.slimmenu li a, .menu-style-2 ul.slimmenu li .sub-toggle>i, .menu-style-2 .nav .collapse-user\";s:5:\"fonts\";b:0;}i:56;a:7:{s:2:\"id\";s:15:\"menu_background\";s:5:\"label\";s:15:\"Menu background\";s:4:\"desc\";s:33:\"To change menu\'s background image\";s:4:\"type\";s:10:\"background\";s:7:\"section\";s:12:\"option_style\";s:6:\"output\";s:84:\"#menu1,#menu1 .menu-collapser, #menu2 .menu-wrapper, .menu-style-2 .user-nav-wrapper\";s:3:\"std\";a:2:{s:16:\"background-color\";s:7:\"#ffffff\";s:16:\"background-image\";s:0:\"\";}}i:57;a:4:{s:2:\"id\";s:7:\"top_bar\";s:5:\"label\";s:7:\"Top Bar\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:12:\"option_style\";}i:58;a:6:{s:2:\"id\";s:13:\"enable_topbar\";s:5:\"label\";s:11:\"Topbar menu\";s:4:\"desc\";s:21:\"On to Enable Top bar \";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:3:\"off\";}i:59;a:6:{s:2:\"id\";s:16:\"sort_topbar_menu\";s:5:\"label\";s:19:\"Topbar menu options\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_style\";s:4:\"desc\";s:40:\"Select topbar item shown in topbar right\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:11:\"topbar_item\";s:5:\"label\";s:4:\"Item\";s:4:\"type\";s:6:\"select\";s:4:\"desc\";s:27:\"Select item shown in topbar\";s:7:\"choices\";a:6:{i:0;a:2:{s:5:\"value\";s:5:\"login\";s:5:\"label\";s:5:\"Login\";}i:1;a:2:{s:5:\"value\";s:8:\"currency\";s:5:\"label\";s:8:\"Currency\";}i:2;a:2:{s:5:\"value\";s:8:\"language\";s:5:\"label\";s:8:\"Language\";}i:3;a:2:{s:5:\"value\";s:6:\"search\";s:5:\"label\";s:13:\"Search Topbar\";}i:4;a:2:{s:5:\"value\";s:13:\"shopping_cart\";s:5:\"label\";s:13:\"Shopping Cart\";}i:5;a:2:{s:5:\"value\";s:4:\"link\";s:5:\"label\";s:11:\"Custom Link\";}}}i:1;a:4:{s:2:\"id\";s:18:\"topbar_custom_link\";s:5:\"label\";s:4:\"Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:2;a:4:{s:2:\"id\";s:24:\"topbar_custom_link_title\";s:5:\"label\";s:10:\"Title Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:3;a:5:{s:2:\"id\";s:23:\"topbar_custom_link_icon\";s:5:\"label\";s:9:\"Icon Link\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:60:\"Enter a awesome font icon. Example: <code>fa-facebook</code>\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:4;a:5:{s:2:\"id\";s:25:\"topbar_custom_link_target\";s:5:\"label\";s:15:\"Open new window\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:15:\"Open new window\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:5;a:4:{s:2:\"id\";s:15:\"topbar_position\";s:5:\"label\";s:8:\"Position\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:1;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}}i:6;a:4:{s:2:\"id\";s:16:\"topbar_is_social\";s:5:\"label\";s:14:\"is Social Link\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:7;a:4:{s:2:\"id\";s:19:\"topbar_custom_class\";s:5:\"label\";s:12:\"Custom Class\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:21:\"Add your Custom Class\";}}}i:60;a:7:{s:2:\"id\";s:23:\"hidden_topbar_in_mobile\";s:5:\"label\";s:23:\"Hidden topbar in mobile\";s:4:\"desc\";s:24:\"Hidden top bar in mobile\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:2:\"on\";s:9:\"condition\";s:20:\"enable_topbar:is(on)\";}i:61;a:6:{s:2:\"id\";s:24:\"gen_enable_sticky_topbar\";s:5:\"label\";s:13:\"Sticky topbar\";s:4:\"desc\";s:28:\"Enable fixed mode for topbar\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:3:\"off\";}i:62;a:7:{s:2:\"id\";s:10:\"topbar_bgr\";s:5:\"label\";s:17:\"Topbar background\";s:4:\"desc\";s:37:\"To change background color for topbar\";s:4:\"type\";s:11:\"colorpicker\";s:9:\"condition\";s:20:\"enable_topbar:is(on)\";s:7:\"section\";s:12:\"option_style\";s:3:\"std\";s:4:\"#333\";}i:63;a:4:{s:2:\"id\";s:12:\"featured_tab\";s:5:\"label\";s:8:\"Featured\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:12:\"option_style\";}i:64;a:8:{s:2:\"id\";s:16:\"st_text_featured\";s:5:\"label\";s:12:\"Feature text\";s:4:\"desc\";s:113:\"To change text to display featured content:<br>Example: <br>-  Feature<xmp>- BEST <br><small>CHOICE</small></xmp>\";s:4:\"type\";s:11:\"custom-text\";s:7:\"section\";s:12:\"option_style\";s:5:\"class\";s:0:\"\";s:3:\"std\";s:8:\"Featured\";s:6:\"v_hint\";s:3:\"yes\";}i:65;a:6:{s:2:\"id\";s:13:\"st_ft_label_w\";s:5:\"label\";s:31:\"Label style fixed width (pixel)\";s:4:\"desc\";s:38:\"Type label width, Default : automatic \";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:23:\"feature_style:is(label)\";s:7:\"section\";s:12:\"option_style\";}i:66;a:7:{s:2:\"id\";s:19:\"st_text_featured_bg\";s:5:\"label\";s:24:\"Feature background color\";s:4:\"desc\";s:27:\"Text color of featured word\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";s:5:\"class\";s:0:\"\";s:3:\"std\";s:7:\"#19A1E5\";}i:67;a:6:{s:2:\"id\";s:12:\"st_sl_height\";s:5:\"label\";s:31:\"Sale label fixed height (pixel)\";s:4:\"desc\";s:39:\"Type label height, Default : automatic \";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"sale_style:is(label)\";s:7:\"section\";s:12:\"option_style\";}i:68;a:7:{s:2:\"id\";s:15:\"st_text_sale_bg\";s:5:\"label\";s:26:\"Promotion background color\";s:4:\"desc\";s:53:\"To change background color of the box displaying sale\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:12:\"option_style\";s:5:\"class\";s:0:\"\";s:3:\"std\";s:7:\"#cc0033\";}i:69;a:7:{s:2:\"id\";s:25:\"page_my_account_dashboard\";s:5:\"label\";s:26:\"Select user dashboard page\";s:4:\"desc\";s:46:\"Select the page to display dashboard user page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:70;a:7:{s:2:\"id\";s:28:\"page_redirect_to_after_login\";s:5:\"label\";s:25:\"Redirect page after login\";s:4:\"desc\";s:59:\"Select the page to display after users login to the system \";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:71;a:7:{s:2:\"id\";s:29:\"page_redirect_to_after_logout\";s:5:\"label\";s:26:\"Redirect page after logout\";s:4:\"desc\";s:62:\"Select the page to display after users logout from the system \";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:72;a:6:{s:2:\"id\";s:18:\"enable_popup_login\";s:5:\"label\";s:24:\"Show popup when register\";s:4:\"desc\";s:52:\"Enable/disable login/ register mode in form of popup\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:11:\"option_page\";s:3:\"std\";s:3:\"off\";}i:73;a:7:{s:2:\"id\";s:15:\"page_user_login\";s:5:\"label\";s:10:\"User Login\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";s:9:\"condition\";s:26:\"enable_popup_login:is(off)\";}i:74;a:7:{s:2:\"id\";s:18:\"page_user_register\";s:5:\"label\";s:13:\"User Register\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";s:9:\"condition\";s:26:\"enable_popup_login:is(off)\";}i:75;a:7:{s:2:\"id\";s:19:\"page_reset_password\";s:5:\"label\";s:30:\"Select page for reset password\";s:4:\"desc\";s:34:\"Select page for resetting password\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:76;a:7:{s:2:\"id\";s:13:\"page_checkout\";s:5:\"label\";s:24:\"Select page for checkout\";s:4:\"desc\";s:24:\"Select page for checkout\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:77;a:7:{s:2:\"id\";s:20:\"page_payment_success\";s:5:\"label\";s:36:\"Select page for successfully booking\";s:4:\"desc\";s:34:\"Select page for successful booking\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:78;a:7:{s:2:\"id\";s:18:\"page_order_confirm\";s:5:\"label\";s:23:\"Order Confirmation Page\";s:4:\"desc\";s:33:\"Select page to show booking order\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:79;a:7:{s:2:\"id\";s:21:\"page_terms_conditions\";s:5:\"label\";s:25:\"Terms and Conditions Page\";s:4:\"desc\";s:40:\"Select page to show Terms and Conditions\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:80;a:7:{s:2:\"id\";s:15:\"footer_template\";s:5:\"label\";s:11:\"Footer Page\";s:4:\"desc\";s:26:\"Select page to show Footer\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:81;a:7:{s:2:\"id\";s:19:\"footer_template_new\";s:5:\"label\";s:18:\"Modern Footer Page\";s:4:\"desc\";s:33:\"Select page to show Modern Footer\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:82;a:7:{s:2:\"id\";s:17:\"partner_info_page\";s:5:\"label\";s:12:\"Partner Page\";s:4:\"desc\";s:39:\"Select page to show Partner Information\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:11:\"option_page\";}i:83;a:7:{s:2:\"id\";s:16:\"blog_sidebar_pos\";s:5:\"label\";s:16:\"Sidebar position\";s:4:\"desc\";s:35:\"Select the position to show sidebar\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:11:\"option_blog\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:2:\"no\";s:5:\"label\";s:2:\"No\";}i:1;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:2;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}s:3:\"std\";s:5:\"right\";}i:84;a:8:{s:2:\"id\";s:15:\"blog_sidebar_id\";s:5:\"label\";s:27:\"Widget position on slidebar\";s:4:\"desc\";s:28:\"You can choose from the list\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:0:\"\";s:6:\"sparam\";s:7:\"sidebar\";s:7:\"section\";s:11:\"option_blog\";s:3:\"std\";s:12:\"blog-sidebar\";}i:85;a:4:{s:2:\"id\";s:17:\"header_blog_image\";s:5:\"label\";s:22:\"Header Blog Background\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:11:\"option_blog\";}i:86;a:4:{s:2:\"id\";s:11:\"booking_tab\";s:5:\"label\";s:15:\"Booking Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_booking\";}i:87;a:7:{s:2:\"id\";s:13:\"booking_modal\";s:5:\"label\";s:23:\"Show popup booking form\";s:4:\"desc\";s:100:\"Show/hide booking mode with popup form. This option only works when turning off Woocommerce Checkout\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:35:\"use_woocommerce_for_booking:is(off)\";}i:88;a:6:{s:2:\"id\";s:22:\"booking_enable_captcha\";s:5:\"label\";s:12:\"Show captcha\";s:4:\"desc\";s:32:\"Only use for submit form booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:14:\"option_booking\";}i:89;a:7:{s:2:\"id\";s:21:\"booking_card_accepted\";s:5:\"label\";s:14:\"Accepted cards\";s:4:\"desc\";s:35:\"Add, remove accepted payment cards \";s:4:\"type\";s:9:\"list-item\";s:8:\"settings\";a:1:{i:0;a:4:{s:2:\"id\";s:5:\"image\";s:5:\"label\";s:5:\"Image\";s:4:\"desc\";s:5:\"Image\";s:4:\"type\";s:6:\"upload\";}}s:3:\"std\";a:5:{i:0;a:2:{s:5:\"title\";s:11:\"Master Card\";s:5:\"image\";s:78:\"http://localhost/tourphoria/wp-content/themes/traveler/img/card/mastercard.png\";}i:1;a:2:{s:5:\"title\";s:3:\"JCB\";s:5:\"image\";s:71:\"http://localhost/tourphoria/wp-content/themes/traveler/img/card/jcb.png\";}i:2;a:2:{s:5:\"title\";s:9:\"Union Pay\";s:5:\"image\";s:76:\"http://localhost/tourphoria/wp-content/themes/traveler/img/card/unionpay.png\";}i:3;a:2:{s:5:\"title\";s:4:\"VISA\";s:5:\"image\";s:72:\"http://localhost/tourphoria/wp-content/themes/traveler/img/card/visa.png\";}i:4;a:2:{s:5:\"title\";s:16:\"American Express\";s:5:\"image\";s:83:\"http://localhost/tourphoria/wp-content/themes/traveler/img/card/americanexpress.png\";}}s:7:\"section\";s:14:\"option_booking\";}i:90;a:7:{s:2:\"id\";s:16:\"booking_currency\";s:5:\"label\";s:18:\"List of currencies\";s:4:\"desc\";s:42:\"Add, remove a kind of currency for payment\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:14:\"option_booking\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:13:\"Currency Name\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:129:{i:0;a:2:{s:5:\"value\";s:3:\"ALL\";s:5:\"label\";s:17:\"Albania Lek(ALL )\";}i:1;a:2:{s:5:\"value\";s:4:\"DZD \";s:5:\"label\";s:14:\"Algeria(DZD  )\";}i:2;a:2:{s:5:\"value\";s:3:\"AFN\";s:5:\"label\";s:25:\"Afghanistan Afghani(AFN )\";}i:3;a:2:{s:5:\"value\";s:3:\"ARS\";s:5:\"label\";s:20:\"Argentina Peso(ARS )\";}i:4;a:2:{s:5:\"value\";s:3:\"AWG\";s:5:\"label\";s:19:\"Aruba Guilder(AWG )\";}i:5;a:2:{s:5:\"value\";s:3:\"AUD\";s:5:\"label\";s:22:\"Australia Dollar(AUD )\";}i:6;a:2:{s:5:\"value\";s:3:\"AZN\";s:5:\"label\";s:26:\"Azerbaijan New Manat(AZN )\";}i:7;a:2:{s:5:\"value\";s:3:\"BSD\";s:5:\"label\";s:20:\"Bahamas Dollar(BSD )\";}i:8;a:2:{s:5:\"value\";s:3:\"BHD\";s:5:\"label\";s:20:\"Bahraini Dinar(BHD )\";}i:9;a:2:{s:5:\"value\";s:3:\"BBD\";s:5:\"label\";s:21:\"Barbados Dollar(BBD )\";}i:10;a:2:{s:5:\"value\";s:3:\"BDT\";s:5:\"label\";s:22:\"Bangladeshi taka(BDT )\";}i:11;a:2:{s:5:\"value\";s:3:\"BYN\";s:5:\"label\";s:19:\"Belarus Ruble(BYN )\";}i:12;a:2:{s:5:\"value\";s:3:\"BZD\";s:5:\"label\";s:19:\"Belize Dollar(BZD )\";}i:13;a:2:{s:5:\"value\";s:3:\"BMD\";s:5:\"label\";s:20:\"Bermuda Dollar(BMD )\";}i:14;a:2:{s:5:\"value\";s:3:\"BOB\";s:5:\"label\";s:23:\"Bolivia Boliviano(BOB )\";}i:15;a:2:{s:5:\"value\";s:3:\"BAM\";s:5:\"label\";s:46:\"Bosnia and Herzegovina Convertible Marka(BAM )\";}i:16;a:2:{s:5:\"value\";s:3:\"BWP\";s:5:\"label\";s:19:\"Botswana Pula(BWP )\";}i:17;a:2:{s:5:\"value\";s:3:\"BGN\";s:5:\"label\";s:18:\"Bulgaria Lev(BGN )\";}i:18;a:2:{s:5:\"value\";s:3:\"BRL\";s:5:\"label\";s:17:\"Brazil Real(BRL )\";}i:19;a:2:{s:5:\"value\";s:3:\"BND\";s:5:\"label\";s:30:\"Brunei Darussalam Dollar(BND )\";}i:20;a:2:{s:5:\"value\";s:3:\"KHR\";s:5:\"label\";s:19:\"Cambodia Riel(KHR )\";}i:21;a:2:{s:5:\"value\";s:3:\"CAD\";s:5:\"label\";s:19:\"Canada Dollar(CAD )\";}i:22;a:2:{s:5:\"value\";s:3:\"KYD\";s:5:\"label\";s:27:\"Cayman Islands Dollar(KYD )\";}i:23;a:2:{s:5:\"value\";s:3:\"CLP\";s:5:\"label\";s:16:\"Chile Peso(CLP )\";}i:24;a:2:{s:5:\"value\";s:3:\"CNY\";s:5:\"label\";s:25:\"China Yuan Renminbi(CNY )\";}i:25;a:2:{s:5:\"value\";s:3:\"COP\";s:5:\"label\";s:19:\"Colombia Peso(COP )\";}i:26;a:2:{s:5:\"value\";s:3:\"CRC\";s:5:\"label\";s:22:\"Costa Rica Colon(CRC )\";}i:27;a:2:{s:5:\"value\";s:3:\"HRK\";s:5:\"label\";s:18:\"Croatia Kuna(HRK )\";}i:28;a:2:{s:5:\"value\";s:3:\"CUP\";s:5:\"label\";s:15:\"Cuba Peso(CUP )\";}i:29;a:2:{s:5:\"value\";s:3:\"CZK\";s:5:\"label\";s:27:\"Czech Republic Koruna(CZK )\";}i:30;a:2:{s:5:\"value\";s:3:\"DKK\";s:5:\"label\";s:19:\"Denmark Krone(DKK )\";}i:31;a:2:{s:5:\"value\";s:3:\"DOP\";s:5:\"label\";s:29:\"Dominican Republic Peso(DOP )\";}i:32;a:2:{s:5:\"value\";s:3:\"XCD\";s:5:\"label\";s:27:\"East Caribbean Dollar(XCD )\";}i:33;a:2:{s:5:\"value\";s:3:\"EGP\";s:5:\"label\";s:17:\"Egypt Pound(EGP )\";}i:34;a:2:{s:5:\"value\";s:3:\"SVC\";s:5:\"label\";s:23:\"El Salvador Colon(SVC )\";}i:35;a:2:{s:5:\"value\";s:3:\"EEK\";s:5:\"label\";s:19:\"Estonia Kroon(EEK )\";}i:36;a:2:{s:5:\"value\";s:3:\"EUR\";s:5:\"label\";s:27:\"Euro Member Countries(EUR )\";}i:37;a:2:{s:5:\"value\";s:3:\"FKP\";s:5:\"label\";s:39:\"Falkland Islands (Malvinas) Pound(FKP )\";}i:38;a:2:{s:5:\"value\";s:3:\"FJD\";s:5:\"label\";s:17:\"Fiji Dollar(FJD )\";}i:39;a:2:{s:5:\"value\";s:3:\"GHC\";s:5:\"label\";s:17:\"Ghana Cedis(GHC )\";}i:40;a:2:{s:5:\"value\";s:3:\"GIP\";s:5:\"label\";s:21:\"Gibraltar Pound(GIP )\";}i:41;a:2:{s:5:\"value\";s:3:\"GTQ\";s:5:\"label\";s:23:\"Guatemala Quetzal(GTQ )\";}i:42;a:2:{s:5:\"value\";s:3:\"GGP\";s:5:\"label\";s:20:\"Guernsey Pound(GGP )\";}i:43;a:2:{s:5:\"value\";s:3:\"GYD\";s:5:\"label\";s:19:\"Guyana Dollar(GYD )\";}i:44;a:2:{s:5:\"value\";s:3:\"GEL\";s:5:\"label\";s:13:\"Georgia(GEL )\";}i:45;a:2:{s:5:\"value\";s:3:\"HNL\";s:5:\"label\";s:22:\"Honduras Lempira(HNL )\";}i:46;a:2:{s:5:\"value\";s:3:\"HKD\";s:5:\"label\";s:22:\"Hong Kong Dollar(HKD )\";}i:47;a:2:{s:5:\"value\";s:3:\"HUF\";s:5:\"label\";s:20:\"Hungary Forint(HUF )\";}i:48;a:2:{s:5:\"value\";s:3:\"ISK\";s:5:\"label\";s:19:\"Iceland Krona(ISK )\";}i:49;a:2:{s:5:\"value\";s:3:\"INR\";s:5:\"label\";s:17:\"India Rupee(INR )\";}i:50;a:2:{s:5:\"value\";s:3:\"IDR\";s:5:\"label\";s:22:\"Indonesia Rupiah(IDR )\";}i:51;a:2:{s:5:\"value\";s:3:\"IRR\";s:5:\"label\";s:15:\"Iran Rial(IRR )\";}i:52;a:2:{s:5:\"value\";s:3:\"IMP\";s:5:\"label\";s:23:\"Isle of Man Pound(IMP )\";}i:53;a:2:{s:5:\"value\";s:3:\"ILS\";s:5:\"label\";s:19:\"Israel Shekel(ILS )\";}i:54;a:2:{s:5:\"value\";s:3:\"JMD\";s:5:\"label\";s:20:\"Jamaica Dollar(JMD )\";}i:55;a:2:{s:5:\"value\";s:3:\"JPY\";s:5:\"label\";s:15:\"Japan Yen(JPY )\";}i:56;a:2:{s:5:\"value\";s:3:\"JEP\";s:5:\"label\";s:18:\"Jersey Pound(JEP )\";}i:57;a:2:{s:5:\"value\";s:3:\"KZT\";s:5:\"label\";s:22:\"Kazakhstan Tenge(KZT )\";}i:58;a:2:{s:5:\"value\";s:3:\"KPW\";s:5:\"label\";s:23:\"Korea (North) Won(KPW )\";}i:59;a:2:{s:5:\"value\";s:3:\"KRW\";s:5:\"label\";s:23:\"Korea (South) Won(KRW )\";}i:60;a:2:{s:5:\"value\";s:3:\"KGS\";s:5:\"label\";s:20:\"Kyrgyzstan Som(KGS )\";}i:61;a:2:{s:5:\"value\";s:3:\"KDS\";s:5:\"label\";s:21:\"Kenyan Shilling(KDS )\";}i:62;a:2:{s:5:\"value\";s:3:\"LAK\";s:5:\"label\";s:14:\"Laos Kip(LAK )\";}i:63;a:2:{s:5:\"value\";s:3:\"LVL\";s:5:\"label\";s:16:\"Latvia Lat(LVL )\";}i:64;a:2:{s:5:\"value\";s:3:\"LBP\";s:5:\"label\";s:19:\"Lebanon Pound(LBP )\";}i:65;a:2:{s:5:\"value\";s:3:\"LRD\";s:5:\"label\";s:20:\"Liberia Dollar(LRD )\";}i:66;a:2:{s:5:\"value\";s:3:\"LTL\";s:5:\"label\";s:21:\"Lithuania Litas(LTL )\";}i:67;a:2:{s:5:\"value\";s:3:\"MKD\";s:5:\"label\";s:21:\"Macedonia Denar(MKD )\";}i:68;a:2:{s:5:\"value\";s:3:\"MYR\";s:5:\"label\";s:22:\"Malaysia Ringgit(MYR )\";}i:69;a:2:{s:5:\"value\";s:3:\"MUR\";s:5:\"label\";s:21:\"Mauritius Rupee(MUR )\";}i:70;a:2:{s:5:\"value\";s:3:\"MXN\";s:5:\"label\";s:17:\"Mexico Peso(MXN )\";}i:71;a:2:{s:5:\"value\";s:3:\"MNT\";s:5:\"label\";s:22:\"Mongolia Tughrik(MNT )\";}i:72;a:2:{s:5:\"value\";s:3:\"MMK\";s:5:\"label\";s:19:\"Myanmar Kyats(MMK )\";}i:73;a:2:{s:5:\"value\";s:3:\"MAD\";s:5:\"label\";s:21:\"Morocco Dirhams(MAD )\";}i:74;a:2:{s:5:\"value\";s:3:\"MZN\";s:5:\"label\";s:24:\"Mozambique Metical(MZN )\";}i:75;a:2:{s:5:\"value\";s:3:\"MGA\";s:5:\"label\";s:21:\"Malagasy ariary(MGA )\";}i:76;a:2:{s:5:\"value\";s:3:\"NAD\";s:5:\"label\";s:20:\"Namibia Dollar(NAD )\";}i:77;a:2:{s:5:\"value\";s:3:\"NPR\";s:5:\"label\";s:17:\"Nepal Rupee(NPR )\";}i:78;a:2:{s:5:\"value\";s:3:\"ANG\";s:5:\"label\";s:34:\"Netherlands Antilles Guilder(ANG )\";}i:79;a:2:{s:5:\"value\";s:3:\"NZD\";s:5:\"label\";s:24:\"New Zealand Dollar(NZD )\";}i:80;a:2:{s:5:\"value\";s:3:\"NIO\";s:5:\"label\";s:23:\"Nicaragua Cordoba(NIO )\";}i:81;a:2:{s:5:\"value\";s:3:\"NGN\";s:5:\"label\";s:19:\"Nigeria Naira(NGN )\";}i:82;a:2:{s:5:\"value\";s:3:\"NOK\";s:5:\"label\";s:18:\"Norway Krone(NOK )\";}i:83;a:2:{s:5:\"value\";s:3:\"OMR\";s:5:\"label\";s:15:\"Oman Rial(OMR )\";}i:84;a:2:{s:5:\"value\";s:3:\"PKR\";s:5:\"label\";s:20:\"Pakistan Rupee(PKR )\";}i:85;a:2:{s:5:\"value\";s:3:\"PAB\";s:5:\"label\";s:19:\"Panama Balboa(PAB )\";}i:86;a:2:{s:5:\"value\";s:3:\"PYG\";s:5:\"label\";s:22:\"Paraguay Guarani(PYG )\";}i:87;a:2:{s:5:\"value\";s:3:\"PEN\";s:5:\"label\";s:20:\"Peru Nuevo Sol(PEN )\";}i:88;a:2:{s:5:\"value\";s:3:\"SOL\";s:5:\"label\";s:18:\"Peruvian Sol(SOL )\";}i:89;a:2:{s:5:\"value\";s:3:\"PHP\";s:5:\"label\";s:22:\"Philippines Peso(PHP )\";}i:90;a:2:{s:5:\"value\";s:3:\"PLN\";s:5:\"label\";s:18:\"Poland Zloty(PLN )\";}i:91;a:2:{s:5:\"value\";s:3:\"QAR\";s:5:\"label\";s:17:\"Qatar Riyal(QAR )\";}i:92;a:2:{s:5:\"value\";s:3:\"RON\";s:5:\"label\";s:21:\"Romania New Leu(RON )\";}i:93;a:2:{s:5:\"value\";s:3:\"RUB\";s:5:\"label\";s:18:\"Russia Ruble(RUB )\";}i:94;a:2:{s:5:\"value\";s:3:\"RWF\";s:5:\"label\";s:19:\"Rwandan Frank(RWF )\";}i:95;a:2:{s:5:\"value\";s:3:\"SHP\";s:5:\"label\";s:24:\"Saint Helena Pound(SHP )\";}i:96;a:2:{s:5:\"value\";s:3:\"SAR\";s:5:\"label\";s:24:\"Saudi Arabia Riyal(SAR )\";}i:97;a:2:{s:5:\"value\";s:3:\"RSD\";s:5:\"label\";s:18:\"Serbia Dinar(RSD )\";}i:98;a:2:{s:5:\"value\";s:3:\"SCR\";s:5:\"label\";s:22:\"Seychelles Rupee(SCR )\";}i:99;a:2:{s:5:\"value\";s:3:\"SGD\";s:5:\"label\";s:22:\"Singapore Dollar(SGD )\";}i:100;a:2:{s:5:\"value\";s:3:\"SBD\";s:5:\"label\";s:28:\"Solomon Islands Dollar(SBD )\";}i:101;a:2:{s:5:\"value\";s:3:\"SOS\";s:5:\"label\";s:22:\"Somalia Shilling(SOS )\";}i:102;a:2:{s:5:\"value\";s:3:\"ZAR\";s:5:\"label\";s:23:\"South Africa Rand(ZAR )\";}i:103;a:2:{s:5:\"value\";s:3:\"LKR\";s:5:\"label\";s:21:\"Sri Lanka Rupee(LKR )\";}i:104;a:2:{s:5:\"value\";s:3:\"SEK\";s:5:\"label\";s:18:\"Sweden Krona(SEK )\";}i:105;a:2:{s:5:\"value\";s:3:\"CHF\";s:5:\"label\";s:23:\"Switzerland Franc(CHF )\";}i:106;a:2:{s:5:\"value\";s:3:\"SRD\";s:5:\"label\";s:21:\"Suriname Dollar(SRD )\";}i:107;a:2:{s:5:\"value\";s:3:\"SYP\";s:5:\"label\";s:17:\"Syria Pound(SYP )\";}i:108;a:2:{s:5:\"value\";s:3:\"TWD\";s:5:\"label\";s:23:\"Taiwan New Dollar(TWD )\";}i:109;a:2:{s:5:\"value\";s:3:\"THB\";s:5:\"label\";s:19:\"Thailand Baht(THB )\";}i:110;a:2:{s:5:\"value\";s:3:\"TTD\";s:5:\"label\";s:32:\"Trinidad and Tobago Dollar(TTD )\";}i:111;a:2:{s:5:\"value\";s:3:\"TRY\";s:5:\"label\";s:17:\"Turkey Lira(TRY )\";}i:112;a:2:{s:5:\"value\";s:3:\"TRL\";s:5:\"label\";s:17:\"Turkey Lira(TRL )\";}i:113;a:2:{s:5:\"value\";s:3:\"TVD\";s:5:\"label\";s:19:\"Tuvalu Dollar(TVD )\";}i:114;a:2:{s:5:\"value\";s:2:\"TD\";s:5:\"label\";s:19:\"Tunisian Dinar(TD )\";}i:115;a:2:{s:5:\"value\";s:3:\"TZS\";s:5:\"label\";s:24:\"Tanzanian Shilling(TZS )\";}i:116;a:2:{s:5:\"value\";s:3:\"UAH\";s:5:\"label\";s:20:\"Ukraine Hryvna(UAH )\";}i:117;a:2:{s:5:\"value\";s:3:\"AED\";s:5:\"label\";s:26:\"United Arab Emirates(AED )\";}i:118;a:2:{s:5:\"value\";s:3:\"GBP\";s:5:\"label\";s:26:\"United Kingdom Pound(GBP )\";}i:119;a:2:{s:5:\"value\";s:3:\"USD\";s:5:\"label\";s:26:\"United States Dollar(USD )\";}i:120;a:2:{s:5:\"value\";s:3:\"UYU\";s:5:\"label\";s:18:\"Uruguay Peso(UYU )\";}i:121;a:2:{s:5:\"value\";s:3:\"UZS\";s:5:\"label\";s:20:\"Uzbekistan Som(UZS )\";}i:122;a:2:{s:5:\"value\";s:3:\"UGX\";s:5:\"label\";s:23:\"Ugandian Shilling(UGX )\";}i:123;a:2:{s:5:\"value\";s:3:\"VEF\";s:5:\"label\";s:23:\"Venezuela Bolivar(VEF )\";}i:124;a:2:{s:5:\"value\";s:3:\"VND\";s:5:\"label\";s:19:\"Viet Nam Dong(VND )\";}i:125;a:2:{s:5:\"value\";s:3:\"YER\";s:5:\"label\";s:16:\"Yemen Rial(YER )\";}i:126;a:2:{s:5:\"value\";s:3:\"CFA\";s:5:\"label\";s:24:\"West African Franc(CFA )\";}i:127;a:2:{s:5:\"value\";s:3:\"ZWD\";s:5:\"label\";s:21:\"Zimbabwe Dollar(ZWD )\";}i:128;a:2:{s:5:\"value\";s:3:\"ZMW\";s:5:\"label\";s:20:\"Zambian Kwacha(ZMW )\";}}}i:1;a:4:{s:2:\"id\";s:6:\"symbol\";s:5:\"label\";s:15:\"Currency Symbol\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:5:{s:2:\"id\";s:4:\"rate\";s:5:\"label\";s:13:\"Exchange rate\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:4:\"desc\";s:33:\"Exchange rate vs Primary Currency\";}i:3;a:7:{s:2:\"id\";s:20:\"booking_currency_pos\";s:5:\"label\";s:17:\"Currency Position\";s:4:\"desc\";s:71:\"This controls the position of the currency symbol.<br>Ex: $400 or 400 $\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:4:{i:0;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:14:\"Left (£99.99)\";}i:1;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:15:\"Right (99.99£)\";}i:2;a:2:{s:5:\"value\";s:10:\"left_space\";s:5:\"label\";s:26:\"Left with space (£ 99.99)\";}i:3;a:2:{s:5:\"value\";s:11:\"right_space\";s:5:\"label\";s:27:\"Right with space (99.99 £)\";}}s:3:\"std\";s:4:\"left\";s:6:\"v_hint\";s:3:\"yes\";}i:4;a:4:{s:2:\"id\";s:20:\"currency_rtl_support\";s:4:\"type\";s:6:\"on-off\";s:5:\"label\";s:39:\"This currency is use for RTL languages?\";s:3:\"std\";s:3:\"off\";}i:5;a:5:{s:2:\"id\";s:18:\"thousand_separator\";s:5:\"label\";s:18:\"Thousand Separator\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:1:\".\";s:4:\"desc\";s:63:\"Optional. Specifies what string to use for thousands separator.\";}i:6;a:5:{s:2:\"id\";s:17:\"decimal_separator\";s:5:\"label\";s:17:\"Decimal Separator\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:1:\",\";s:4:\"desc\";s:56:\"Optional. Specifies what string to use for decimal point\";}i:7;a:8:{s:2:\"id\";s:26:\"booking_currency_precision\";s:5:\"label\";s:16:\"Currency decimal\";s:4:\"desc\";s:34:\"Sets the number of decimal points.\";s:4:\"type\";s:6:\"number\";s:3:\"min\";i:0;s:3:\"max\";i:5;s:4:\"step\";i:1;s:3:\"std\";i:2;}}s:3:\"std\";a:3:{i:0;a:8:{s:5:\"title\";s:3:\"USD\";s:4:\"name\";s:3:\"USD\";s:6:\"symbol\";s:1:\"$\";s:4:\"rate\";i:1;s:20:\"booking_currency_pos\";s:4:\"left\";s:18:\"thousand_separator\";s:1:\".\";s:17:\"decimal_separator\";s:1:\",\";s:26:\"booking_currency_precision\";i:2;}i:1;a:8:{s:5:\"title\";s:3:\"EUR\";s:4:\"name\";s:3:\"EUR\";s:6:\"symbol\";s:3:\"€\";s:4:\"rate\";d:0.796491;s:20:\"booking_currency_pos\";s:4:\"left\";s:18:\"thousand_separator\";s:1:\".\";s:17:\"decimal_separator\";s:1:\",\";s:26:\"booking_currency_precision\";i:2;}i:2;a:8:{s:5:\"title\";s:3:\"GBP\";s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:4:\"rate\";d:0.636169;s:20:\"booking_currency_pos\";s:5:\"right\";s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\",\";s:26:\"booking_currency_precision\";i:2;}}}i:91;a:7:{s:2:\"id\";s:24:\"booking_primary_currency\";s:5:\"label\";s:16:\"Primary Currency\";s:4:\"desc\";s:42:\"Select a unit of currency as main currency\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:14:\"option_booking\";s:7:\"choices\";a:0:{}s:3:\"std\";s:3:\"USD\";}i:92;a:6:{s:2:\"id\";s:27:\"booking_currency_conversion\";s:5:\"label\";s:19:\"Currency conversion\";s:4:\"desc\";s:127:\"It is used to convert any currency into dollars (USD) when booking in paypal with the currencies having not been supported yet.\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:14:\"option_booking\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:13:\"Currency Name\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:129:{i:0;a:2:{s:5:\"value\";s:3:\"ALL\";s:5:\"label\";s:17:\"Albania Lek(ALL )\";}i:1;a:2:{s:5:\"value\";s:4:\"DZD \";s:5:\"label\";s:14:\"Algeria(DZD  )\";}i:2;a:2:{s:5:\"value\";s:3:\"AFN\";s:5:\"label\";s:25:\"Afghanistan Afghani(AFN )\";}i:3;a:2:{s:5:\"value\";s:3:\"ARS\";s:5:\"label\";s:20:\"Argentina Peso(ARS )\";}i:4;a:2:{s:5:\"value\";s:3:\"AWG\";s:5:\"label\";s:19:\"Aruba Guilder(AWG )\";}i:5;a:2:{s:5:\"value\";s:3:\"AUD\";s:5:\"label\";s:22:\"Australia Dollar(AUD )\";}i:6;a:2:{s:5:\"value\";s:3:\"AZN\";s:5:\"label\";s:26:\"Azerbaijan New Manat(AZN )\";}i:7;a:2:{s:5:\"value\";s:3:\"BSD\";s:5:\"label\";s:20:\"Bahamas Dollar(BSD )\";}i:8;a:2:{s:5:\"value\";s:3:\"BHD\";s:5:\"label\";s:20:\"Bahraini Dinar(BHD )\";}i:9;a:2:{s:5:\"value\";s:3:\"BBD\";s:5:\"label\";s:21:\"Barbados Dollar(BBD )\";}i:10;a:2:{s:5:\"value\";s:3:\"BDT\";s:5:\"label\";s:22:\"Bangladeshi taka(BDT )\";}i:11;a:2:{s:5:\"value\";s:3:\"BYN\";s:5:\"label\";s:19:\"Belarus Ruble(BYN )\";}i:12;a:2:{s:5:\"value\";s:3:\"BZD\";s:5:\"label\";s:19:\"Belize Dollar(BZD )\";}i:13;a:2:{s:5:\"value\";s:3:\"BMD\";s:5:\"label\";s:20:\"Bermuda Dollar(BMD )\";}i:14;a:2:{s:5:\"value\";s:3:\"BOB\";s:5:\"label\";s:23:\"Bolivia Boliviano(BOB )\";}i:15;a:2:{s:5:\"value\";s:3:\"BAM\";s:5:\"label\";s:46:\"Bosnia and Herzegovina Convertible Marka(BAM )\";}i:16;a:2:{s:5:\"value\";s:3:\"BWP\";s:5:\"label\";s:19:\"Botswana Pula(BWP )\";}i:17;a:2:{s:5:\"value\";s:3:\"BGN\";s:5:\"label\";s:18:\"Bulgaria Lev(BGN )\";}i:18;a:2:{s:5:\"value\";s:3:\"BRL\";s:5:\"label\";s:17:\"Brazil Real(BRL )\";}i:19;a:2:{s:5:\"value\";s:3:\"BND\";s:5:\"label\";s:30:\"Brunei Darussalam Dollar(BND )\";}i:20;a:2:{s:5:\"value\";s:3:\"KHR\";s:5:\"label\";s:19:\"Cambodia Riel(KHR )\";}i:21;a:2:{s:5:\"value\";s:3:\"CAD\";s:5:\"label\";s:19:\"Canada Dollar(CAD )\";}i:22;a:2:{s:5:\"value\";s:3:\"KYD\";s:5:\"label\";s:27:\"Cayman Islands Dollar(KYD )\";}i:23;a:2:{s:5:\"value\";s:3:\"CLP\";s:5:\"label\";s:16:\"Chile Peso(CLP )\";}i:24;a:2:{s:5:\"value\";s:3:\"CNY\";s:5:\"label\";s:25:\"China Yuan Renminbi(CNY )\";}i:25;a:2:{s:5:\"value\";s:3:\"COP\";s:5:\"label\";s:19:\"Colombia Peso(COP )\";}i:26;a:2:{s:5:\"value\";s:3:\"CRC\";s:5:\"label\";s:22:\"Costa Rica Colon(CRC )\";}i:27;a:2:{s:5:\"value\";s:3:\"HRK\";s:5:\"label\";s:18:\"Croatia Kuna(HRK )\";}i:28;a:2:{s:5:\"value\";s:3:\"CUP\";s:5:\"label\";s:15:\"Cuba Peso(CUP )\";}i:29;a:2:{s:5:\"value\";s:3:\"CZK\";s:5:\"label\";s:27:\"Czech Republic Koruna(CZK )\";}i:30;a:2:{s:5:\"value\";s:3:\"DKK\";s:5:\"label\";s:19:\"Denmark Krone(DKK )\";}i:31;a:2:{s:5:\"value\";s:3:\"DOP\";s:5:\"label\";s:29:\"Dominican Republic Peso(DOP )\";}i:32;a:2:{s:5:\"value\";s:3:\"XCD\";s:5:\"label\";s:27:\"East Caribbean Dollar(XCD )\";}i:33;a:2:{s:5:\"value\";s:3:\"EGP\";s:5:\"label\";s:17:\"Egypt Pound(EGP )\";}i:34;a:2:{s:5:\"value\";s:3:\"SVC\";s:5:\"label\";s:23:\"El Salvador Colon(SVC )\";}i:35;a:2:{s:5:\"value\";s:3:\"EEK\";s:5:\"label\";s:19:\"Estonia Kroon(EEK )\";}i:36;a:2:{s:5:\"value\";s:3:\"EUR\";s:5:\"label\";s:27:\"Euro Member Countries(EUR )\";}i:37;a:2:{s:5:\"value\";s:3:\"FKP\";s:5:\"label\";s:39:\"Falkland Islands (Malvinas) Pound(FKP )\";}i:38;a:2:{s:5:\"value\";s:3:\"FJD\";s:5:\"label\";s:17:\"Fiji Dollar(FJD )\";}i:39;a:2:{s:5:\"value\";s:3:\"GHC\";s:5:\"label\";s:17:\"Ghana Cedis(GHC )\";}i:40;a:2:{s:5:\"value\";s:3:\"GIP\";s:5:\"label\";s:21:\"Gibraltar Pound(GIP )\";}i:41;a:2:{s:5:\"value\";s:3:\"GTQ\";s:5:\"label\";s:23:\"Guatemala Quetzal(GTQ )\";}i:42;a:2:{s:5:\"value\";s:3:\"GGP\";s:5:\"label\";s:20:\"Guernsey Pound(GGP )\";}i:43;a:2:{s:5:\"value\";s:3:\"GYD\";s:5:\"label\";s:19:\"Guyana Dollar(GYD )\";}i:44;a:2:{s:5:\"value\";s:3:\"GEL\";s:5:\"label\";s:13:\"Georgia(GEL )\";}i:45;a:2:{s:5:\"value\";s:3:\"HNL\";s:5:\"label\";s:22:\"Honduras Lempira(HNL )\";}i:46;a:2:{s:5:\"value\";s:3:\"HKD\";s:5:\"label\";s:22:\"Hong Kong Dollar(HKD )\";}i:47;a:2:{s:5:\"value\";s:3:\"HUF\";s:5:\"label\";s:20:\"Hungary Forint(HUF )\";}i:48;a:2:{s:5:\"value\";s:3:\"ISK\";s:5:\"label\";s:19:\"Iceland Krona(ISK )\";}i:49;a:2:{s:5:\"value\";s:3:\"INR\";s:5:\"label\";s:17:\"India Rupee(INR )\";}i:50;a:2:{s:5:\"value\";s:3:\"IDR\";s:5:\"label\";s:22:\"Indonesia Rupiah(IDR )\";}i:51;a:2:{s:5:\"value\";s:3:\"IRR\";s:5:\"label\";s:15:\"Iran Rial(IRR )\";}i:52;a:2:{s:5:\"value\";s:3:\"IMP\";s:5:\"label\";s:23:\"Isle of Man Pound(IMP )\";}i:53;a:2:{s:5:\"value\";s:3:\"ILS\";s:5:\"label\";s:19:\"Israel Shekel(ILS )\";}i:54;a:2:{s:5:\"value\";s:3:\"JMD\";s:5:\"label\";s:20:\"Jamaica Dollar(JMD )\";}i:55;a:2:{s:5:\"value\";s:3:\"JPY\";s:5:\"label\";s:15:\"Japan Yen(JPY )\";}i:56;a:2:{s:5:\"value\";s:3:\"JEP\";s:5:\"label\";s:18:\"Jersey Pound(JEP )\";}i:57;a:2:{s:5:\"value\";s:3:\"KZT\";s:5:\"label\";s:22:\"Kazakhstan Tenge(KZT )\";}i:58;a:2:{s:5:\"value\";s:3:\"KPW\";s:5:\"label\";s:23:\"Korea (North) Won(KPW )\";}i:59;a:2:{s:5:\"value\";s:3:\"KRW\";s:5:\"label\";s:23:\"Korea (South) Won(KRW )\";}i:60;a:2:{s:5:\"value\";s:3:\"KGS\";s:5:\"label\";s:20:\"Kyrgyzstan Som(KGS )\";}i:61;a:2:{s:5:\"value\";s:3:\"KDS\";s:5:\"label\";s:21:\"Kenyan Shilling(KDS )\";}i:62;a:2:{s:5:\"value\";s:3:\"LAK\";s:5:\"label\";s:14:\"Laos Kip(LAK )\";}i:63;a:2:{s:5:\"value\";s:3:\"LVL\";s:5:\"label\";s:16:\"Latvia Lat(LVL )\";}i:64;a:2:{s:5:\"value\";s:3:\"LBP\";s:5:\"label\";s:19:\"Lebanon Pound(LBP )\";}i:65;a:2:{s:5:\"value\";s:3:\"LRD\";s:5:\"label\";s:20:\"Liberia Dollar(LRD )\";}i:66;a:2:{s:5:\"value\";s:3:\"LTL\";s:5:\"label\";s:21:\"Lithuania Litas(LTL )\";}i:67;a:2:{s:5:\"value\";s:3:\"MKD\";s:5:\"label\";s:21:\"Macedonia Denar(MKD )\";}i:68;a:2:{s:5:\"value\";s:3:\"MYR\";s:5:\"label\";s:22:\"Malaysia Ringgit(MYR )\";}i:69;a:2:{s:5:\"value\";s:3:\"MUR\";s:5:\"label\";s:21:\"Mauritius Rupee(MUR )\";}i:70;a:2:{s:5:\"value\";s:3:\"MXN\";s:5:\"label\";s:17:\"Mexico Peso(MXN )\";}i:71;a:2:{s:5:\"value\";s:3:\"MNT\";s:5:\"label\";s:22:\"Mongolia Tughrik(MNT )\";}i:72;a:2:{s:5:\"value\";s:3:\"MMK\";s:5:\"label\";s:19:\"Myanmar Kyats(MMK )\";}i:73;a:2:{s:5:\"value\";s:3:\"MAD\";s:5:\"label\";s:21:\"Morocco Dirhams(MAD )\";}i:74;a:2:{s:5:\"value\";s:3:\"MZN\";s:5:\"label\";s:24:\"Mozambique Metical(MZN )\";}i:75;a:2:{s:5:\"value\";s:3:\"MGA\";s:5:\"label\";s:21:\"Malagasy ariary(MGA )\";}i:76;a:2:{s:5:\"value\";s:3:\"NAD\";s:5:\"label\";s:20:\"Namibia Dollar(NAD )\";}i:77;a:2:{s:5:\"value\";s:3:\"NPR\";s:5:\"label\";s:17:\"Nepal Rupee(NPR )\";}i:78;a:2:{s:5:\"value\";s:3:\"ANG\";s:5:\"label\";s:34:\"Netherlands Antilles Guilder(ANG )\";}i:79;a:2:{s:5:\"value\";s:3:\"NZD\";s:5:\"label\";s:24:\"New Zealand Dollar(NZD )\";}i:80;a:2:{s:5:\"value\";s:3:\"NIO\";s:5:\"label\";s:23:\"Nicaragua Cordoba(NIO )\";}i:81;a:2:{s:5:\"value\";s:3:\"NGN\";s:5:\"label\";s:19:\"Nigeria Naira(NGN )\";}i:82;a:2:{s:5:\"value\";s:3:\"NOK\";s:5:\"label\";s:18:\"Norway Krone(NOK )\";}i:83;a:2:{s:5:\"value\";s:3:\"OMR\";s:5:\"label\";s:15:\"Oman Rial(OMR )\";}i:84;a:2:{s:5:\"value\";s:3:\"PKR\";s:5:\"label\";s:20:\"Pakistan Rupee(PKR )\";}i:85;a:2:{s:5:\"value\";s:3:\"PAB\";s:5:\"label\";s:19:\"Panama Balboa(PAB )\";}i:86;a:2:{s:5:\"value\";s:3:\"PYG\";s:5:\"label\";s:22:\"Paraguay Guarani(PYG )\";}i:87;a:2:{s:5:\"value\";s:3:\"PEN\";s:5:\"label\";s:20:\"Peru Nuevo Sol(PEN )\";}i:88;a:2:{s:5:\"value\";s:3:\"SOL\";s:5:\"label\";s:18:\"Peruvian Sol(SOL )\";}i:89;a:2:{s:5:\"value\";s:3:\"PHP\";s:5:\"label\";s:22:\"Philippines Peso(PHP )\";}i:90;a:2:{s:5:\"value\";s:3:\"PLN\";s:5:\"label\";s:18:\"Poland Zloty(PLN )\";}i:91;a:2:{s:5:\"value\";s:3:\"QAR\";s:5:\"label\";s:17:\"Qatar Riyal(QAR )\";}i:92;a:2:{s:5:\"value\";s:3:\"RON\";s:5:\"label\";s:21:\"Romania New Leu(RON )\";}i:93;a:2:{s:5:\"value\";s:3:\"RUB\";s:5:\"label\";s:18:\"Russia Ruble(RUB )\";}i:94;a:2:{s:5:\"value\";s:3:\"RWF\";s:5:\"label\";s:19:\"Rwandan Frank(RWF )\";}i:95;a:2:{s:5:\"value\";s:3:\"SHP\";s:5:\"label\";s:24:\"Saint Helena Pound(SHP )\";}i:96;a:2:{s:5:\"value\";s:3:\"SAR\";s:5:\"label\";s:24:\"Saudi Arabia Riyal(SAR )\";}i:97;a:2:{s:5:\"value\";s:3:\"RSD\";s:5:\"label\";s:18:\"Serbia Dinar(RSD )\";}i:98;a:2:{s:5:\"value\";s:3:\"SCR\";s:5:\"label\";s:22:\"Seychelles Rupee(SCR )\";}i:99;a:2:{s:5:\"value\";s:3:\"SGD\";s:5:\"label\";s:22:\"Singapore Dollar(SGD )\";}i:100;a:2:{s:5:\"value\";s:3:\"SBD\";s:5:\"label\";s:28:\"Solomon Islands Dollar(SBD )\";}i:101;a:2:{s:5:\"value\";s:3:\"SOS\";s:5:\"label\";s:22:\"Somalia Shilling(SOS )\";}i:102;a:2:{s:5:\"value\";s:3:\"ZAR\";s:5:\"label\";s:23:\"South Africa Rand(ZAR )\";}i:103;a:2:{s:5:\"value\";s:3:\"LKR\";s:5:\"label\";s:21:\"Sri Lanka Rupee(LKR )\";}i:104;a:2:{s:5:\"value\";s:3:\"SEK\";s:5:\"label\";s:18:\"Sweden Krona(SEK )\";}i:105;a:2:{s:5:\"value\";s:3:\"CHF\";s:5:\"label\";s:23:\"Switzerland Franc(CHF )\";}i:106;a:2:{s:5:\"value\";s:3:\"SRD\";s:5:\"label\";s:21:\"Suriname Dollar(SRD )\";}i:107;a:2:{s:5:\"value\";s:3:\"SYP\";s:5:\"label\";s:17:\"Syria Pound(SYP )\";}i:108;a:2:{s:5:\"value\";s:3:\"TWD\";s:5:\"label\";s:23:\"Taiwan New Dollar(TWD )\";}i:109;a:2:{s:5:\"value\";s:3:\"THB\";s:5:\"label\";s:19:\"Thailand Baht(THB )\";}i:110;a:2:{s:5:\"value\";s:3:\"TTD\";s:5:\"label\";s:32:\"Trinidad and Tobago Dollar(TTD )\";}i:111;a:2:{s:5:\"value\";s:3:\"TRY\";s:5:\"label\";s:17:\"Turkey Lira(TRY )\";}i:112;a:2:{s:5:\"value\";s:3:\"TRL\";s:5:\"label\";s:17:\"Turkey Lira(TRL )\";}i:113;a:2:{s:5:\"value\";s:3:\"TVD\";s:5:\"label\";s:19:\"Tuvalu Dollar(TVD )\";}i:114;a:2:{s:5:\"value\";s:2:\"TD\";s:5:\"label\";s:19:\"Tunisian Dinar(TD )\";}i:115;a:2:{s:5:\"value\";s:3:\"TZS\";s:5:\"label\";s:24:\"Tanzanian Shilling(TZS )\";}i:116;a:2:{s:5:\"value\";s:3:\"UAH\";s:5:\"label\";s:20:\"Ukraine Hryvna(UAH )\";}i:117;a:2:{s:5:\"value\";s:3:\"AED\";s:5:\"label\";s:26:\"United Arab Emirates(AED )\";}i:118;a:2:{s:5:\"value\";s:3:\"GBP\";s:5:\"label\";s:26:\"United Kingdom Pound(GBP )\";}i:119;a:2:{s:5:\"value\";s:3:\"USD\";s:5:\"label\";s:26:\"United States Dollar(USD )\";}i:120;a:2:{s:5:\"value\";s:3:\"UYU\";s:5:\"label\";s:18:\"Uruguay Peso(UYU )\";}i:121;a:2:{s:5:\"value\";s:3:\"UZS\";s:5:\"label\";s:20:\"Uzbekistan Som(UZS )\";}i:122;a:2:{s:5:\"value\";s:3:\"UGX\";s:5:\"label\";s:23:\"Ugandian Shilling(UGX )\";}i:123;a:2:{s:5:\"value\";s:3:\"VEF\";s:5:\"label\";s:23:\"Venezuela Bolivar(VEF )\";}i:124;a:2:{s:5:\"value\";s:3:\"VND\";s:5:\"label\";s:19:\"Viet Nam Dong(VND )\";}i:125;a:2:{s:5:\"value\";s:3:\"YER\";s:5:\"label\";s:16:\"Yemen Rial(YER )\";}i:126;a:2:{s:5:\"value\";s:3:\"CFA\";s:5:\"label\";s:24:\"West African Franc(CFA )\";}i:127;a:2:{s:5:\"value\";s:3:\"ZWD\";s:5:\"label\";s:21:\"Zimbabwe Dollar(ZWD )\";}i:128;a:2:{s:5:\"value\";s:3:\"ZMW\";s:5:\"label\";s:20:\"Zambian Kwacha(ZMW )\";}}}i:1;a:5:{s:2:\"id\";s:4:\"rate\";s:5:\"label\";s:13:\"Exchange rate\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:4:\"desc\";s:33:\"Exchange rate vs Primary Currency\";}}}i:93;a:6:{s:2:\"id\";s:16:\"is_guest_booking\";s:5:\"label\";s:19:\"Allow guest booking\";s:4:\"desc\";s:70:\"Enable/disable this mode to allow users who have not logged in to book\";s:7:\"section\";s:14:\"option_booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:94;a:7:{s:2:\"id\";s:33:\"st_booking_enabled_create_account\";s:5:\"label\";s:28:\"Enable create account option\";s:4:\"desc\";s:63:\"Enable create account option in checkout page. Default: Enabled\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:23:\"is_guest_booking:is(on)\";}i:95;a:7:{s:2:\"id\";s:25:\"guest_create_acc_required\";s:5:\"label\";s:40:\"Always create new account after checkout\";s:4:\"desc\";s:75:\"This options required input checker \"Create new account\" for Guest booking \";s:7:\"section\";s:14:\"option_booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:63:\"is_guest_booking:is(on)st_booking_enabled_create_account:is(on)\";}i:96;a:5:{s:2:\"id\";s:26:\"enable_send_message_button\";s:5:\"label\";s:54:\"Enable/disable send message button in the booking form\";s:7:\"section\";s:14:\"option_booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:97;a:4:{s:2:\"id\";s:15:\"woocommerce_tab\";s:5:\"label\";s:19:\"Woocommerce Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_booking\";}i:98;a:6:{s:2:\"id\";s:27:\"use_woocommerce_for_booking\";s:7:\"section\";s:14:\"option_booking\";s:5:\"label\";s:24:\"Use WooCommerce checkout\";s:4:\"desc\";s:37:\"Enable/disable Woocomerce for Booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:99;a:6:{s:2:\"id\";s:26:\"woo_checkout_show_shipping\";s:7:\"section\";s:14:\"option_booking\";s:5:\"label\";s:25:\"Show Shipping Information\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:34:\"use_woocommerce_for_booking:is(on)\";}i:100;a:6:{s:2:\"id\";s:23:\"st_woo_cart_is_collapse\";s:7:\"section\";s:14:\"option_booking\";s:5:\"label\";s:36:\"Show Cart item Information collapsed\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:34:\"use_woocommerce_for_booking:is(on)\";}i:101;a:4:{s:2:\"id\";s:7:\"tax_tab\";s:5:\"label\";s:11:\"Tax Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_booking\";}i:102;a:6:{s:2:\"id\";s:10:\"tax_enable\";s:5:\"label\";s:10:\"Enable tax\";s:4:\"desc\";s:35:\"Enable/disable this feature for tax\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_booking\";s:3:\"std\";s:3:\"off\";}i:103;a:7:{s:2:\"id\";s:21:\"st_tax_include_enable\";s:5:\"label\";s:18:\"Price included tax\";s:4:\"desc\";s:106:\"ON: Tax has been included in the price of product - OFF: Tax has not been included in the price of product\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:17:\"tax_enable:is(on)\";s:3:\"std\";s:3:\"off\";}i:104;a:7:{s:2:\"id\";s:9:\"tax_value\";s:5:\"label\";s:13:\"Tax value (%)\";s:4:\"desc\";s:14:\"Tax percentage\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:17:\"tax_enable:is(on)\";s:3:\"std\";i:10;}i:105;a:4:{s:2:\"id\";s:11:\"invoice_tab\";s:5:\"label\";s:15:\"Invoice Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_booking\";}i:106;a:6:{s:2:\"id\";s:14:\"invoice_enable\";s:5:\"label\";s:14:\"Enable invoice\";s:4:\"desc\";s:39:\"Enable/disable this feature for invoice\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_booking\";s:3:\"std\";s:3:\"off\";}i:107;a:6:{s:2:\"id\";s:12:\"invoice_logo\";s:5:\"label\";s:12:\"Company Logo\";s:4:\"desc\";s:12:\"Company Logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:108;a:6:{s:2:\"id\";s:20:\"invoice_company_name\";s:5:\"label\";s:12:\"Company Name\";s:4:\"desc\";s:12:\"Company Name\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:109;a:6:{s:2:\"id\";s:15:\"invoice_address\";s:5:\"label\";s:7:\"Address\";s:4:\"desc\";s:7:\"Address\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:110;a:6:{s:2:\"id\";s:20:\"invoice_phone_number\";s:5:\"label\";s:12:\"Phone Number\";s:4:\"desc\";s:12:\"Phone Number\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:111;a:6:{s:2:\"id\";s:11:\"invoice_zpc\";s:5:\"label\";s:17:\"Zip / Postal Code\";s:4:\"desc\";s:17:\"Zip / Postal Code\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:112;a:6:{s:2:\"id\";s:27:\"invoice_registration_number\";s:5:\"label\";s:19:\"Registration Number\";s:4:\"desc\";s:19:\"Registration Number\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:113;a:6:{s:2:\"id\";s:22:\"invoice_tax_vat_number\";s:5:\"label\";s:16:\"Tax / VAT Number\";s:4:\"desc\";s:16:\"Tax / VAT Number\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:114;a:7:{s:2:\"id\";s:28:\"invoice_show_link_page_order\";s:5:\"label\";s:40:\"Show download link in page order success\";s:4:\"desc\";s:40:\"Show download link in page order success\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_booking\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:21:\"invoice_enable:is(on)\";}i:115;a:4:{s:2:\"id\";s:15:\"booking_fee_tab\";s:5:\"label\";s:19:\"Booking Fee Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_booking\";}i:116;a:6:{s:2:\"id\";s:18:\"booking_fee_enable\";s:5:\"label\";s:18:\"Enable Booking Fee\";s:4:\"desc\";s:36:\"This feature only for normal booking\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_booking\";s:3:\"std\";s:3:\"off\";}i:117;a:6:{s:2:\"id\";s:16:\"booking_fee_type\";s:5:\"label\";s:8:\"Fee Type\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:7:\"percent\";s:5:\"label\";s:14:\"Fee by percent\";}i:1;a:2:{s:5:\"value\";s:6:\"amount\";s:5:\"label\";s:13:\"Fee by amount\";}}s:7:\"section\";s:14:\"option_booking\";s:9:\"condition\";s:25:\"booking_fee_enable:is(on)\";}i:118;a:7:{s:2:\"id\";s:18:\"booking_fee_amount\";s:5:\"label\";s:10:\"Fee amount\";s:4:\"desc\";s:36:\"Leave empty for disallow booking fee\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_booking\";s:3:\"std\";s:1:\"0\";s:9:\"condition\";s:25:\"booking_fee_enable:is(on)\";}i:119;a:9:{s:2:\"id\";s:23:\"location_posts_per_page\";s:5:\"label\";s:31:\"Number of items in one location\";s:4:\"desc\";s:49:\"Default number of posts are shown in Location tab\";s:4:\"type\";s:6:\"number\";s:3:\"min\";i:1;s:3:\"max\";i:15;s:4:\"step\";i:1;s:7:\"section\";s:15:\"option_location\";s:3:\"std\";i:5;}i:120;a:6:{s:2:\"id\";s:20:\"bc_show_location_url\";s:5:\"label\";s:21:\"Location link options\";s:4:\"desc\";s:105:\"ON: Link of items will redirect to results search page - OFF: Link of items will redirect to details page\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:15:\"option_location\";s:3:\"std\";s:2:\"on\";}i:121;a:6:{s:2:\"id\";s:21:\"bc_show_location_tree\";s:5:\"label\";s:33:\"Build locations by tree structure\";s:4:\"desc\";s:33:\"Build locations by tree structure\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:15:\"option_location\";s:3:\"std\";s:3:\"off\";}i:122;a:6:{s:2:\"id\";s:17:\"location_tab_type\";s:5:\"label\";s:32:\"Type of the content location tab\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:15:\"option_location\";s:3:\"std\";s:4:\"list\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"list\";s:5:\"label\";s:4:\"List\";}i:1;a:2:{s:5:\"value\";s:4:\"grid\";s:5:\"label\";s:4:\"Grid\";}}}i:123;a:6:{s:2:\"id\";s:20:\"review_without_login\";s:5:\"label\";s:12:\"Write review\";s:4:\"desc\";s:97:\"ON: Reviews can be written without logging in - OFF: Reviews cannot be written without logging in\";s:7:\"section\";s:13:\"option_review\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";}i:124;a:6:{s:2:\"id\";s:18:\"review_need_booked\";s:5:\"label\";s:32:\"User who booked can write review\";s:4:\"desc\";s:65:\"ON: User booked can write review - OFF: Everyone can write review\";s:7:\"section\";s:13:\"option_review\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:125;a:6:{s:2:\"id\";s:11:\"review_once\";s:5:\"label\";s:16:\"Times for review\";s:4:\"desc\";s:57:\"ON: Only one time for review - OFF: Many times for review\";s:7:\"section\";s:13:\"option_review\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:126;a:6:{s:2:\"id\";s:23:\"is_review_must_approved\";s:5:\"label\";s:15:\"Review approved\";s:4:\"desc\";s:76:\"ON: Review must be approved by admin - OFF: Review is automatically approved\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:13:\"option_review\";s:3:\"std\";s:3:\"off\";}i:127;a:6:{s:2:\"id\";s:22:\"hotel_single_book_room\";s:5:\"label\";s:28:\"Booking room in single hotel\";s:4:\"desc\";s:0:\"\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";s:3:\"off\";}i:128;a:7:{s:2:\"id\";s:20:\"hotel_show_min_price\";s:5:\"label\";s:21:\"Price show on listing\";s:4:\"desc\";s:97:\"AVG: Show average price on results search page <br>MIN: Show minimum price on results search page\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:9:\"avg_price\";s:5:\"label\";s:9:\"Avg Price\";}i:1;a:2:{s:5:\"value\";s:9:\"min_price\";s:5:\"label\";s:9:\"Min Price\";}}s:7:\"section\";s:12:\"option_hotel\";s:6:\"v_hint\";s:3:\"yes\";}i:129;a:7:{s:2:\"id\";s:16:\"view_star_review\";s:5:\"label\";s:33:\"Show Hotel Stars or Hotel Reviews\";s:4:\"desc\";s:131:\"Hotel star: Show hotel stars on elements of hotel list <br>Hotel review: Show the number of review stars on elements of hotel list \";s:4:\"type\";s:13:\"custom-select\";s:7:\"section\";s:12:\"option_hotel\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"label\";s:11:\"Hotel Stars\";s:5:\"value\";s:4:\"star\";}i:1;a:2:{s:5:\"label\";s:13:\"Hotel Reviews\";s:5:\"value\";s:6:\"review\";}}s:6:\"v_hint\";s:3:\"yes\";}i:130;a:7:{s:2:\"id\";s:24:\"hotel_search_result_page\";s:5:\"label\";s:24:\"Hotel search result page\";s:4:\"desc\";s:45:\"Select page to show hotel results search page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:12:\"option_hotel\";}i:131;a:9:{s:2:\"id\";s:20:\"hotel_posts_per_page\";s:5:\"label\";s:14:\"Items per page\";s:4:\"desc\";s:46:\"Number of items on a hotel results search page\";s:4:\"type\";s:6:\"number\";s:3:\"max\";i:50;s:3:\"min\";i:1;s:4:\"step\";i:1;s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";s:2:\"12\";}i:132;a:7:{s:2:\"id\";s:19:\"hotel_single_layout\";s:5:\"label\";s:20:\"Hotel details layout\";s:4:\"desc\";s:45:\"Select layout to display default single hotel\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"st_hotel\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:12:\"option_hotel\";}i:133;a:7:{s:2:\"id\";s:19:\"hotel_search_layout\";s:5:\"label\";s:19:\"Hotel search layout\";s:4:\"desc\";s:40:\"Select page to display hotel search page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:15:\"st_hotel_search\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:12:\"option_hotel\";}i:134;a:6:{s:2:\"id\";s:15:\"hotel_max_adult\";s:5:\"label\";s:26:\"Max Adults in search field\";s:4:\"desc\";s:34:\"Select max adults for search field\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";i:14;}i:135;a:6:{s:2:\"id\";s:15:\"hotel_max_child\";s:5:\"label\";s:28:\"Max Children in search field\";s:4:\"desc\";s:36:\"Select max children for search field\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";i:14;}i:136;a:6:{s:2:\"id\";s:12:\"hotel_review\";s:5:\"label\";s:13:\"Enable Review\";s:4:\"desc\";s:68:\"ON: Users can review for hotel  - OFF: User can not review for hotel\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";s:2:\"on\";}i:137;a:8:{s:2:\"id\";s:18:\"hotel_review_stats\";s:5:\"label\";s:16:\"Review criterias\";s:4:\"desc\";s:54:\"You can add, edit, delete an review criteria for hotel\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_hotel\";s:9:\"condition\";s:19:\"hotel_review:is(on)\";s:8:\"settings\";a:2:{i:0;a:4:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:9:\"Stat Name\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:1;a:4:{s:2:\"id\";s:4:\"icon\";s:5:\"label\";s:11:\"Icon review\";s:4:\"type\";s:6:\"upload\";s:8:\"operator\";s:3:\"and\";}}s:3:\"std\";a:5:{i:0;a:1:{s:5:\"title\";s:5:\"Sleep\";}i:1;a:1:{s:5:\"title\";s:8:\"Location\";}i:2;a:1:{s:5:\"title\";s:7:\"Service\";}i:3;a:1:{s:5:\"title\";s:11:\"Cleanliness\";}i:4;a:1:{s:5:\"title\";s:7:\"Room(s)\";}}}i:138;a:6:{s:2:\"id\";s:17:\"hotel_sidebar_pos\";s:5:\"label\";s:23:\"Hotel slidebar position\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:12:\"option_hotel\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:2:\"no\";s:5:\"label\";s:2:\"No\";}i:1;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:2;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}s:3:\"std\";s:4:\"left\";}i:139;a:6:{s:2:\"id\";s:18:\"hotel_sidebar_area\";s:5:\"label\";s:12:\"Sidebar Area\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:0:\"\";s:6:\"sparam\";s:7:\"sidebar\";s:7:\"section\";s:12:\"option_hotel\";}i:140;a:6:{s:2:\"id\";s:24:\"is_featured_search_hotel\";s:5:\"label\";s:44:\"Show featured hotels on top of search result\";s:4:\"desc\";s:52:\"ON: Show featured items on top of result search page\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:12:\"option_hotel\";}s:11:\"flied_hotel\";a:7:{s:2:\"id\";s:19:\"hotel_search_fields\";s:5:\"label\";s:24:\"Hotel custom search form\";s:4:\"desc\";s:72:\"You can add, edit, delete or sort fields to make a search form for hotel\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";a:5:{i:0;a:5:{s:5:\"title\";s:20:\"Where are you going?\";s:4:\"name\";s:8:\"location\";s:11:\"placeholder\";s:17:\"Location/ Zipcode\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;}i:1;a:4:{s:5:\"title\";s:8:\"Check in\";s:4:\"name\";s:7:\"checkin\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}i:2;a:4:{s:5:\"title\";s:9:\"Check out\";s:4:\"name\";s:8:\"checkout\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}i:3;a:4:{s:5:\"title\";s:7:\"Room(s)\";s:4:\"name\";s:8:\"room_num\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}i:4;a:4:{s:5:\"title\";s:5:\"Adult\";s:4:\"name\";s:5:\"adult\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}}s:8:\"settings\";a:10:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:10:{s:8:\"location\";a:2:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}s:7:\"checkin\";a:2:{s:5:\"value\";s:7:\"checkin\";s:5:\"label\";s:8:\"Check in\";}s:8:\"checkout\";a:2:{s:5:\"value\";s:8:\"checkout\";s:5:\"label\";s:9:\"Check out\";}s:5:\"adult\";a:2:{s:5:\"value\";s:5:\"adult\";s:5:\"label\";s:5:\"Adult\";}s:8:\"children\";a:2:{s:5:\"value\";s:8:\"children\";s:5:\"label\";s:8:\"Children\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}s:8:\"room_num\";a:2:{s:5:\"value\";s:8:\"room_num\";s:5:\"label\";s:7:\"Room(s)\";}s:13:\"taxonomy_room\";a:2:{s:5:\"value\";s:13:\"taxonomy_room\";s:5:\"label\";s:13:\"Taxonomy Room\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:8:\"st_hotel\";}i:5;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_hotel\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:13:\"taxonomy_room\";s:5:\"label\";s:13:\"Taxonomy Room\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:10:\"hotel_room\";}i:7;a:6:{s:2:\"id\";s:29:\"type_show_taxonomy_hotel_room\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:8;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:9;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}}i:141;a:6:{s:2:\"id\";s:26:\"hotel_allow_search_advance\";s:5:\"label\";s:21:\"Allow advanced search\";s:4:\"desc\";s:70:\"ON: Turn on the mode to add advanced search field in hotel search form\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";s:3:\"off\";}i:142;a:8:{s:2:\"id\";s:20:\"hotel_search_advance\";s:5:\"label\";s:28:\"Hotel Advanced Search fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_hotel\";s:9:\"condition\";s:33:\"hotel_allow_search_advance:is(on)\";s:4:\"desc\";s:85:\"You can add, edit, delete, drag and drop any field for settingup advanced search form\";s:8:\"settings\";a:9:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:5:\"Field\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:10:{s:8:\"location\";a:2:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}s:7:\"checkin\";a:2:{s:5:\"value\";s:7:\"checkin\";s:5:\"label\";s:8:\"Check in\";}s:8:\"checkout\";a:2:{s:5:\"value\";s:8:\"checkout\";s:5:\"label\";s:9:\"Check out\";}s:5:\"adult\";a:2:{s:5:\"value\";s:5:\"adult\";s:5:\"label\";s:5:\"Adult\";}s:8:\"children\";a:2:{s:5:\"value\";s:8:\"children\";s:5:\"label\";s:8:\"Children\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}s:8:\"room_num\";a:2:{s:5:\"value\";s:8:\"room_num\";s:5:\"label\";s:7:\"Room(s)\";}s:13:\"taxonomy_room\";a:2:{s:5:\"value\";s:13:\"taxonomy_room\";s:5:\"label\";s:13:\"Taxonomy Room\";}}}i:1;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:2;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:5:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:8:\"st_hotel\";}i:4;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_hotel\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:5;a:6:{s:2:\"id\";s:13:\"taxonomy_room\";s:5:\"label\";s:13:\"Taxonomy Room\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:10:\"hotel_room\";}i:6;a:6:{s:2:\"id\";s:29:\"type_show_taxonomy_hotel_room\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:7;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:8;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:2:{i:0;a:5:{s:5:\"title\";s:11:\"Hotel Theme\";s:4:\"name\";s:8:\"taxonomy\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:8:\"taxonomy\";s:11:\"hotel_theme\";}i:1;a:5:{s:5:\"title\";s:16:\"Room Facilitites\";s:4:\"name\";s:13:\"taxonomy_room\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:8:\"taxonomy\";s:16:\"hotel_facilities\";}}}i:143;a:6:{s:2:\"id\";s:18:\"hotel_nearby_range\";s:5:\"label\";s:18:\"Hotel Nearby Range\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:12:\"option_hotel\";s:4:\"desc\";s:50:\"You can input distance (km) to find nearby hotels \";s:3:\"std\";i:10;}i:144;a:6:{s:2:\"id\";s:28:\"hotel_unlimited_custom_field\";s:5:\"label\";s:19:\"Hotel custom fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:12:\"option_hotel\";s:4:\"desc\";s:49:\"You can add, edit, delete custom fields for hotel\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:10:\"type_field\";s:5:\"label\";s:10:\"Field type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:4:\"text\";s:5:\"label\";s:10:\"Text field\";}i:1;a:2:{s:5:\"value\";s:8:\"textarea\";s:5:\"label\";s:14:\"Textarea field\";}i:2;a:2:{s:5:\"value\";s:11:\"date-picker\";s:5:\"label\";s:10:\"Date field\";}}}i:1;a:4:{s:2:\"id\";s:13:\"default_field\";s:5:\"label\";s:7:\"Default\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}}i:145;a:6:{s:2:\"id\";s:24:\"st_hotel_icon_map_marker\";s:5:\"label\";s:15:\"Map marker icon\";s:4:\"desc\";s:43:\"Select map icon to show hotel on Map Google\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:12:\"option_hotel\";s:3:\"std\";s:48:\"http://maps.google.com/mapfiles/marker_black.png\";}i:146;a:7:{s:2:\"id\";s:24:\"hotel_room_search_layout\";s:5:\"label\";s:25:\"Select room search layout\";s:4:\"desc\";s:32:\"Select layout for searching room\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:10:\"hotel_room\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:17:\"option_hotel_room\";}i:147;a:7:{s:2:\"id\";s:29:\"hotel_room_search_result_page\";s:5:\"label\";s:23:\"Room Search Result Page\";s:4:\"desc\";s:39:\"Select page to show room search results\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:17:\"option_hotel_room\";}i:148;a:7:{s:2:\"id\";s:24:\"hotel_single_room_layout\";s:5:\"label\";s:18:\"Single room layout\";s:4:\"desc\";s:33:\"Select layout to show single room\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:10:\"hotel_room\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:17:\"option_hotel_room\";}s:10:\"flied_room\";a:7:{s:2:\"id\";s:18:\"room_search_fields\";s:5:\"label\";s:27:\"Room advanced search fields\";s:4:\"desc\";s:74:\"You can add, edit, delete, drag and drop any fields to setup advanced form\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:17:\"option_hotel_room\";s:3:\"std\";a:4:{i:0;a:5:{s:5:\"title\";s:20:\"Where are you going?\";s:4:\"name\";s:8:\"location\";s:11:\"placeholder\";s:17:\"Location/ Zipcode\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;}i:1;a:4:{s:5:\"title\";s:8:\"Check in\";s:4:\"name\";s:7:\"checkin\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}i:2;a:4:{s:5:\"title\";s:9:\"Check out\";s:4:\"name\";s:8:\"checkout\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}i:3;a:4:{s:5:\"title\";s:7:\"Room(s)\";s:4:\"name\";s:8:\"room_num\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;}}s:8:\"settings\";a:10:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:8:\"location\";a:2:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";}s:7:\"checkin\";a:2:{s:5:\"value\";s:7:\"checkin\";s:5:\"label\";s:8:\"Check in\";}s:8:\"checkout\";a:2:{s:5:\"value\";s:8:\"checkout\";s:5:\"label\";s:9:\"Check out\";}s:5:\"adult\";a:2:{s:5:\"value\";s:5:\"adult\";s:5:\"label\";s:5:\"Adult\";}s:8:\"children\";a:2:{s:5:\"value\";s:8:\"children\";s:5:\"label\";s:8:\"Children\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:9:\"Room Name\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}s:8:\"room_num\";a:2:{s:5:\"value\";s:8:\"room_num\";s:5:\"label\";s:7:\"Room(s)\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:10:\"hotel_room\";}i:5;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_hotel\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:13:\"taxonomy_room\";s:5:\"label\";s:13:\"Taxonomy Room\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:10:\"hotel_room\";}i:7;a:6:{s:2:\"id\";s:29:\"type_show_taxonomy_hotel_room\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:8;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:9;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}}i:149;a:5:{s:2:\"id\";s:31:\"hotel_room_allow_search_advance\";s:5:\"label\";s:21:\"Allow advanced search\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:17:\"option_hotel_room\";s:3:\"std\";s:3:\"off\";}i:150;a:8:{s:2:\"id\";s:25:\"hotel_room_search_advance\";s:5:\"label\";s:27:\"Room advanced search fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:17:\"option_hotel_room\";s:9:\"condition\";s:38:\"hotel_room_allow_search_advance:is(on)\";s:4:\"desc\";s:74:\"You can add, edit, delete, drag and drop any field for setup advanced form\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:5:\"Field\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:8:\"location\";a:2:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";}s:7:\"checkin\";a:2:{s:5:\"value\";s:7:\"checkin\";s:5:\"label\";s:8:\"Check in\";}s:8:\"checkout\";a:2:{s:5:\"value\";s:8:\"checkout\";s:5:\"label\";s:9:\"Check out\";}s:5:\"adult\";a:2:{s:5:\"value\";s:5:\"adult\";s:5:\"label\";s:5:\"Adult\";}s:8:\"children\";a:2:{s:5:\"value\";s:8:\"children\";s:5:\"label\";s:8:\"Children\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:9:\"Room Name\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}s:8:\"room_num\";a:2:{s:5:\"value\";s:8:\"room_num\";s:5:\"label\";s:7:\"Room(s)\";}}}i:1;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:2;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:5:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:10:\"hotel_room\";}i:4;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_hotel\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:5;a:6:{s:2:\"id\";s:29:\"type_show_taxonomy_hotel_room\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:22:\"name:is(taxonomy_room)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";s:0:\"\";}i:151;a:7:{s:2:\"id\";s:25:\"rental_search_result_page\";s:5:\"label\";s:25:\"Select Search Result Page\";s:4:\"desc\";s:50:\"Select page to show search results page for rental\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:13:\"option_rental\";}i:152;a:7:{s:2:\"id\";s:20:\"rental_single_layout\";s:5:\"label\";s:20:\"Rental Single Layout\";s:4:\"desc\";s:34:\"Select layout to show single retal\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:9:\"st_rental\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:13:\"option_rental\";}i:153;a:7:{s:2:\"id\";s:20:\"rental_search_layout\";s:5:\"label\";s:20:\"Rental Search Layout\";s:4:\"desc\";s:40:\"Select layout to show rental search page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:16:\"st_rental_search\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:13:\"option_rental\";}i:154;a:7:{s:2:\"id\";s:18:\"rental_room_layout\";s:5:\"label\";s:26:\"Rental Room Default Layout\";s:4:\"desc\";s:45:\"Select layout to show single room rental page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:11:\"rental_room\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:13:\"option_rental\";}i:155;a:6:{s:2:\"id\";s:13:\"rental_review\";s:5:\"label\";s:14:\"Review options\";s:4:\"desc\";s:37:\"ON: Turn on review feature for rental\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:13:\"option_rental\";s:3:\"std\";s:2:\"on\";}i:156;a:8:{s:2:\"id\";s:19:\"rental_review_stats\";s:5:\"label\";s:22:\"Rental Review Criteria\";s:4:\"desc\";s:52:\"You can add, delete, sort review criteria for rental\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_rental\";s:9:\"condition\";s:20:\"rental_review:is(on)\";s:8:\"settings\";a:1:{i:0;a:3:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:9:\"Stat Name\";s:4:\"type\";s:4:\"text\";}}s:3:\"std\";a:5:{i:0;a:1:{s:5:\"title\";s:5:\"Sleep\";}i:1;a:1:{s:5:\"title\";s:8:\"Location\";}i:2;a:1:{s:5:\"title\";s:7:\"Service\";}i:3;a:1:{s:5:\"title\";s:11:\"Cleanliness\";}i:4;a:1:{s:5:\"title\";s:7:\"Room(s)\";}}}i:157;a:7:{s:2:\"id\";s:18:\"rental_sidebar_pos\";s:5:\"label\";s:24:\"Rental slidebar position\";s:4:\"desc\";s:39:\"The position to show sidebar for rental\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:13:\"option_rental\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:2:\"no\";s:5:\"label\";s:2:\"No\";}i:1;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:2;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}s:3:\"std\";s:4:\"left\";}i:158;a:8:{s:2:\"id\";s:19:\"rental_sidebar_area\";s:5:\"label\";s:12:\"Sidebar Area\";s:4:\"desc\";s:45:\"Select a sidebar widget to display for rental\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:0:\"\";s:6:\"sparam\";s:7:\"sidebar\";s:7:\"section\";s:13:\"option_rental\";s:3:\"std\";s:14:\"rental-sidebar\";}i:159;a:6:{s:2:\"id\";s:25:\"is_featured_search_rental\";s:5:\"label\";s:45:\"Show featured rentals on top of search result\";s:4:\"desc\";s:52:\"ON: Show featured items on top of result search page\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:13:\"option_rental\";}i:160;a:7:{s:2:\"id\";s:20:\"rental_search_fields\";s:5:\"label\";s:20:\"Rental Search Fields\";s:4:\"desc\";s:46:\"You can add, delete, sort rental search fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_rental\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{s:10:\"--Select--\";s:0:\"\";i:0;a:2:{s:5:\"label\";s:8:\"Location\";s:5:\"value\";s:8:\"location\";}i:1;a:2:{s:5:\"label\";s:13:\"Location List\";s:5:\"value\";s:13:\"list_location\";}i:2;a:2:{s:5:\"label\";s:8:\"Check in\";s:5:\"value\";s:7:\"checkin\";}i:3;a:2:{s:5:\"label\";s:9:\"Check out\";s:5:\"value\";s:8:\"checkout\";}i:4;a:2:{s:5:\"label\";s:7:\"Room(s)\";s:5:\"value\";s:8:\"room_num\";}i:5;a:2:{s:5:\"label\";s:5:\"Adult\";s:5:\"value\";s:5:\"adult\";}i:6;a:2:{s:5:\"label\";s:8:\"Children\";s:5:\"value\";s:8:\"children\";}i:7;a:2:{s:5:\"label\";s:8:\"Taxonomy\";s:5:\"value\";s:8:\"taxonomy\";}i:8;a:2:{s:5:\"label\";s:11:\"Rental Name\";s:5:\"value\";s:9:\"item_name\";}i:9;a:2:{s:5:\"label\";s:9:\"List Name\";s:5:\"value\";s:9:\"list_name\";}i:10;a:2:{s:5:\"label\";s:13:\"Price slider \";s:5:\"value\";s:12:\"price_slider\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:21:\"Large-box column size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout_col2\";s:5:\"label\";s:21:\"Small-box column size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:8:\"operator\";s:3:\"and\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:9:\"st_rental\";}i:5;a:6:{s:2:\"id\";s:25:\"type_show_taxonomy_rental\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:20;}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:5:{i:0;a:5:{s:5:\"title\";s:20:\"Where are you going?\";s:4:\"name\";s:8:\"location\";s:11:\"placeholder\";s:17:\"Location/ Zipcode\";s:10:\"layout_col\";s:2:\"12\";s:11:\"layout_col2\";s:2:\"12\";}i:1;a:4:{s:5:\"title\";s:8:\"Check in\";s:4:\"name\";s:7:\"checkin\";s:10:\"layout_col\";s:1:\"3\";s:11:\"layout_col2\";s:1:\"3\";}i:2;a:4:{s:5:\"title\";s:9:\"Check out\";s:4:\"name\";s:8:\"checkout\";s:10:\"layout_col\";s:1:\"3\";s:11:\"layout_col2\";s:1:\"3\";}i:3;a:4:{s:5:\"title\";s:7:\"Room(s)\";s:4:\"name\";s:8:\"room_num\";s:10:\"layout_col\";s:1:\"3\";s:11:\"layout_col2\";s:1:\"3\";}i:4;a:4:{s:5:\"title\";s:6:\"Adults\";s:4:\"name\";s:5:\"adult\";s:10:\"layout_col\";s:1:\"3\";s:11:\"layout_col2\";s:1:\"3\";}}}i:161;a:6:{s:2:\"id\";s:27:\"allow_rental_advance_search\";s:5:\"label\";s:30:\"Allowed Rental Advanced Search\";s:4:\"desc\";s:51:\"ON: Turn on this mode to add advanced search fields\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:13:\"option_rental\";}i:162;a:8:{s:2:\"id\";s:28:\"rental_advance_search_fields\";s:5:\"label\";s:29:\"Rental advanced search fields\";s:4:\"desc\";s:40:\"You can add, sort advanced search fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_rental\";s:9:\"condition\";s:34:\"allow_rental_advance_search:is(on)\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{s:10:\"--Select--\";s:0:\"\";i:0;a:2:{s:5:\"label\";s:8:\"Location\";s:5:\"value\";s:8:\"location\";}i:1;a:2:{s:5:\"label\";s:13:\"Location List\";s:5:\"value\";s:13:\"list_location\";}i:2;a:2:{s:5:\"label\";s:8:\"Check in\";s:5:\"value\";s:7:\"checkin\";}i:3;a:2:{s:5:\"label\";s:9:\"Check out\";s:5:\"value\";s:8:\"checkout\";}i:4;a:2:{s:5:\"label\";s:7:\"Room(s)\";s:5:\"value\";s:8:\"room_num\";}i:5;a:2:{s:5:\"label\";s:5:\"Adult\";s:5:\"value\";s:5:\"adult\";}i:6;a:2:{s:5:\"label\";s:8:\"Children\";s:5:\"value\";s:8:\"children\";}i:7;a:2:{s:5:\"label\";s:8:\"Taxonomy\";s:5:\"value\";s:8:\"taxonomy\";}i:8;a:2:{s:5:\"label\";s:11:\"Rental Name\";s:5:\"value\";s:9:\"item_name\";}i:9;a:2:{s:5:\"label\";s:9:\"List Name\";s:5:\"value\";s:9:\"list_name\";}i:10;a:2:{s:5:\"label\";s:13:\"Price slider \";s:5:\"value\";s:12:\"price_slider\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:21:\"Large-box column size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout_col2\";s:5:\"label\";s:21:\"Small-box column size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:8:\"operator\";s:3:\"and\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:9:\"st_rental\";}i:5;a:6:{s:2:\"id\";s:25:\"type_show_taxonomy_rental\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:17:\"name:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:18:\"name:is(list_name)\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:20;}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:2:{i:0;a:5:{s:5:\"title\";s:9:\"Amenities\";s:4:\"name\";s:8:\"taxonomy\";s:10:\"layout_col\";s:2:\"12\";s:11:\"layout_col2\";s:2:\"12\";s:8:\"taxonomy\";s:9:\"amenities\";}i:1;a:5:{s:5:\"title\";s:13:\"Suitabilities\";s:4:\"name\";s:8:\"taxonomy\";s:10:\"layout_col\";s:2:\"12\";s:11:\"layout_col2\";s:2:\"12\";s:8:\"taxonomy\";s:11:\"suitability\";}}}i:163;a:6:{s:2:\"id\";s:29:\"rental_unlimited_custom_field\";s:5:\"label\";s:20:\"Rental custom fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_rental\";s:4:\"desc\";s:44:\"You can create, add custom fields for rental\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:10:\"type_field\";s:5:\"label\";s:10:\"Field type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:4:\"text\";s:5:\"label\";s:10:\"Text field\";}i:1;a:2:{s:5:\"value\";s:8:\"textarea\";s:5:\"label\";s:14:\"Textarea field\";}i:2;a:2:{s:5:\"value\";s:11:\"date-picker\";s:5:\"label\";s:10:\"Date field\";}}}i:1;a:4:{s:2:\"id\";s:13:\"default_field\";s:5:\"label\";s:7:\"Default\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}}i:164;a:6:{s:2:\"id\";s:25:\"st_rental_icon_map_marker\";s:5:\"label\";s:15:\"Map marker icon\";s:4:\"desc\";s:44:\"Select map icon to show rental on Map Google\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:13:\"option_rental\";s:3:\"std\";s:48:\"http://maps.google.com/mapfiles/marker_brown.png\";}i:165;a:8:{s:2:\"id\";s:24:\"car_equipment_info_limit\";s:5:\"label\";s:15:\"Equipment Limit\";s:4:\"desc\";s:45:\"Number of equipment showing on search results\";s:4:\"type\";s:6:\"number\";s:3:\"min\";i:0;s:3:\"max\";i:50;s:4:\"step\";i:1;s:7:\"section\";s:10:\"option_car\";}i:166;a:7:{s:2:\"id\";s:23:\"cars_search_result_page\";s:5:\"label\";s:18:\"Search Result Page\";s:4:\"desc\";s:42:\"Select page to show search results for car\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:10:\"option_car\";}i:167;a:7:{s:2:\"id\";s:18:\"cars_single_layout\";s:5:\"label\";s:18:\"Cars Single Layout\";s:4:\"desc\";s:32:\"Select layout to show single car\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:7:\"st_cars\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:10:\"option_car\";}i:168;a:7:{s:2:\"id\";s:18:\"cars_layout_layout\";s:5:\"label\";s:18:\"Cars Search Layout\";s:4:\"desc\";s:41:\"Select layout to show search page for car\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:14:\"st_cars_search\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:10:\"option_car\";}i:169;a:8:{s:2:\"id\";s:15:\"cars_price_unit\";s:5:\"label\";s:10:\"Price unit\";s:4:\"desc\";s:200:\"The unit to calculate the price of car<br/>Day: The price is calculated according to day<br/>Hour: The price is calculated according to hour<br/>Distance: The price is calculated according to distance\";s:4:\"type\";s:13:\"custom-select\";s:7:\"section\";s:10:\"option_car\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:3:\"day\";s:5:\"label\";s:3:\"Day\";}i:1;a:2:{s:5:\"value\";s:4:\"hour\";s:5:\"label\";s:4:\"Hour\";}i:2;a:2:{s:5:\"value\";s:8:\"distance\";s:5:\"label\";s:8:\"Distance\";}}s:3:\"std\";s:3:\"day\";s:6:\"v_hint\";s:3:\"yes\";}i:170;a:7:{s:2:\"id\";s:22:\"cars_price_by_distance\";s:5:\"label\";s:17:\"Price by distance\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:10:\"option_car\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:9:\"kilometer\";s:5:\"label\";s:9:\"Kilometer\";}i:1;a:2:{s:5:\"value\";s:4:\"mile\";s:5:\"label\";s:4:\"Mile\";}}s:3:\"std\";s:9:\"kilometer\";s:9:\"condition\";s:28:\"cars_price_unit:is(distance)\";}i:171;a:6:{s:2:\"id\";s:21:\"booking_days_included\";s:5:\"label\";s:24:\"Set default booking info\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:10:\"option_car\";s:4:\"desc\";s:95:\"ON: Add one day / hour into day / hour for check in. For example: 22-23/11/2017 will be 2 days.\";}i:172;a:6:{s:2:\"id\";s:22:\"is_featured_search_car\";s:5:\"label\";s:43:\"Show featured cars on top of search results\";s:4:\"desc\";s:47:\"Show featured cars on top of result search page\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:10:\"option_car\";}i:173;a:7:{s:2:\"id\";s:17:\"car_search_fields\";s:5:\"label\";s:17:\"Car Search Fields\";s:4:\"desc\";s:39:\"You can add, sort search fields for car\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:10:\"option_car\";s:8:\"settings\";a:7:{i:0;a:5:{s:2:\"id\";s:15:\"field_atrribute\";s:5:\"label\";s:15:\"Field Atrribute\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{s:8:\"location\";a:3:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";s:10:\"field_name\";s:7:\"pick-up\";}s:13:\"list_location\";a:3:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location list\";s:10:\"field_name\";s:10:\"location_?\";}s:12:\"pick-up-date\";a:3:{s:5:\"value\";s:12:\"pick-up-date\";s:5:\"label\";s:12:\"Pick-up Date\";s:10:\"field_name\";s:12:\"pick-up-date\";}s:13:\"drop-off-time\";a:3:{s:5:\"value\";s:13:\"drop-off-time\";s:5:\"label\";s:13:\"Drop-off Time\";s:10:\"field_name\";s:13:\"drop-off-time\";}s:13:\"drop-off-date\";a:3:{s:5:\"value\";s:13:\"drop-off-date\";s:5:\"label\";s:13:\"Drop-off Date\";s:10:\"field_name\";s:13:\"drop-off-date\";}s:12:\"pick-up-time\";a:3:{s:5:\"value\";s:12:\"pick-up-time\";s:5:\"label\";s:12:\"Pick-up Time\";s:10:\"field_name\";s:12:\"pick-up-time\";}s:17:\"pick-up-date-time\";a:3:{s:5:\"value\";s:17:\"pick-up-date-time\";s:5:\"label\";s:17:\"Pick-up Date Time\";s:10:\"field_name\";a:2:{i:0;s:12:\"pick-up-date\";i:1;s:12:\"pick-up-time\";}}s:18:\"drop-off-date-time\";a:3:{s:5:\"value\";s:18:\"drop-off-date-time\";s:5:\"label\";s:18:\"Drop-off Date Time\";s:10:\"field_name\";a:2:{i:0;s:13:\"drop-off-date\";i:1;s:13:\"drop-off-time\";}}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:3:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:8:\"Car Name\";s:10:\"field_name\";s:1:\"s\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:12:\"price_slider\";a:3:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";s:10:\"field_name\";s:1:\"s\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:5:{s:2:\"id\";s:17:\"layout_col_normal\";s:5:\"label\";s:18:\"Layout Normal size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:7:\"st_cars\";}i:4;a:6:{s:2:\"id\";s:23:\"type_show_taxonomy_cars\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:5;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:29:\"field_atrribute:is(list_name)\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:20;}i:6;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:3:{i:0;a:3:{s:5:\"title\";s:25:\"Pick Up From, Drop Off To\";s:17:\"layout_col_normal\";i:12;s:15:\"field_atrribute\";s:8:\"location\";}i:1;a:3:{s:5:\"title\";s:26:\"Pick-up Date ,Pick-up Time\";s:17:\"layout_col_normal\";i:6;s:15:\"field_atrribute\";s:17:\"pick-up-date-time\";}i:2;a:3:{s:5:\"title\";s:28:\"Drop-off Date ,Drop-off Time\";s:17:\"layout_col_normal\";i:6;s:15:\"field_atrribute\";s:18:\"drop-off-date-time\";}}}i:174;a:5:{s:2:\"id\";s:24:\"car_allow_search_advance\";s:5:\"label\";s:21:\"Allow advanced search\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:10:\"option_car\";}i:175;a:8:{s:2:\"id\";s:25:\"car_advance_search_fields\";s:5:\"label\";s:25:\"Allowed Advanced Search  \";s:4:\"desc\";s:47:\"ON: Turn on thiis mode to add advanced search  \";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:10:\"option_car\";s:9:\"condition\";s:31:\"car_allow_search_advance:is(on)\";s:8:\"settings\";a:7:{i:0;a:5:{s:2:\"id\";s:15:\"field_atrribute\";s:5:\"label\";s:15:\"Field Atrribute\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{s:8:\"location\";a:3:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";s:10:\"field_name\";s:7:\"pick-up\";}s:13:\"list_location\";a:3:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location list\";s:10:\"field_name\";s:10:\"location_?\";}s:12:\"pick-up-date\";a:3:{s:5:\"value\";s:12:\"pick-up-date\";s:5:\"label\";s:12:\"Pick-up Date\";s:10:\"field_name\";s:12:\"pick-up-date\";}s:13:\"drop-off-time\";a:3:{s:5:\"value\";s:13:\"drop-off-time\";s:5:\"label\";s:13:\"Drop-off Time\";s:10:\"field_name\";s:13:\"drop-off-time\";}s:13:\"drop-off-date\";a:3:{s:5:\"value\";s:13:\"drop-off-date\";s:5:\"label\";s:13:\"Drop-off Date\";s:10:\"field_name\";s:13:\"drop-off-date\";}s:12:\"pick-up-time\";a:3:{s:5:\"value\";s:12:\"pick-up-time\";s:5:\"label\";s:12:\"Pick-up Time\";s:10:\"field_name\";s:12:\"pick-up-time\";}s:17:\"pick-up-date-time\";a:3:{s:5:\"value\";s:17:\"pick-up-date-time\";s:5:\"label\";s:17:\"Pick-up Date Time\";s:10:\"field_name\";a:2:{i:0;s:12:\"pick-up-date\";i:1;s:12:\"pick-up-time\";}}s:18:\"drop-off-date-time\";a:3:{s:5:\"value\";s:18:\"drop-off-date-time\";s:5:\"label\";s:18:\"Drop-off Date Time\";s:10:\"field_name\";a:2:{i:0;s:13:\"drop-off-date\";i:1;s:13:\"drop-off-time\";}}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:3:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:8:\"Car Name\";s:10:\"field_name\";s:1:\"s\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:12:\"price_slider\";a:3:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";s:10:\"field_name\";s:1:\"s\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:5:{s:2:\"id\";s:17:\"layout_col_normal\";s:5:\"label\";s:18:\"Layout Normal size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:3;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:7:\"st_cars\";}i:4;a:6:{s:2:\"id\";s:23:\"type_show_taxonomy_cars\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:5;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:29:\"field_atrribute:is(list_name)\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:20;}i:6;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:2:{i:0;a:3:{s:5:\"title\";s:8:\"Taxonomy\";s:17:\"layout_col_normal\";i:12;s:15:\"field_atrribute\";s:8:\"taxonomy\";}i:1;a:3:{s:5:\"title\";s:12:\"Filter Price\";s:17:\"layout_col_normal\";i:12;s:15:\"field_atrribute\";s:12:\"price_slider\";}}}i:176;a:7:{s:2:\"id\";s:21:\"car_search_fields_box\";s:5:\"label\";s:26:\"Location & Date Change Box\";s:4:\"desc\";s:80:\"You can add, sort fields in the change box for car search in the car single page\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:10:\"option_car\";s:8:\"settings\";a:7:{i:0;a:5:{s:2:\"id\";s:15:\"field_atrribute\";s:5:\"label\";s:15:\"Field Atrribute\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{s:8:\"location\";a:3:{s:5:\"value\";s:8:\"location\";s:5:\"label\";s:8:\"Location\";s:10:\"field_name\";s:7:\"pick-up\";}s:13:\"list_location\";a:3:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location list\";s:10:\"field_name\";s:10:\"location_?\";}s:12:\"pick-up-date\";a:3:{s:5:\"value\";s:12:\"pick-up-date\";s:5:\"label\";s:12:\"Pick-up Date\";s:10:\"field_name\";s:12:\"pick-up-date\";}s:13:\"drop-off-time\";a:3:{s:5:\"value\";s:13:\"drop-off-time\";s:5:\"label\";s:13:\"Drop-off Time\";s:10:\"field_name\";s:13:\"drop-off-time\";}s:13:\"drop-off-date\";a:3:{s:5:\"value\";s:13:\"drop-off-date\";s:5:\"label\";s:13:\"Drop-off Date\";s:10:\"field_name\";s:13:\"drop-off-date\";}s:12:\"pick-up-time\";a:3:{s:5:\"value\";s:12:\"pick-up-time\";s:5:\"label\";s:12:\"Pick-up Time\";s:10:\"field_name\";s:12:\"pick-up-time\";}s:17:\"pick-up-date-time\";a:3:{s:5:\"value\";s:17:\"pick-up-date-time\";s:5:\"label\";s:17:\"Pick-up Date Time\";s:10:\"field_name\";a:2:{i:0;s:12:\"pick-up-date\";i:1;s:12:\"pick-up-time\";}}s:18:\"drop-off-date-time\";a:3:{s:5:\"value\";s:18:\"drop-off-date-time\";s:5:\"label\";s:18:\"Drop-off Date Time\";s:10:\"field_name\";a:2:{i:0;s:13:\"drop-off-date\";i:1;s:13:\"drop-off-time\";}}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:3:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:8:\"Car Name\";s:10:\"field_name\";s:1:\"s\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:12:\"price_slider\";a:3:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";s:10:\"field_name\";s:1:\"s\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:14:\"layout_col_box\";s:5:\"label\";s:15:\"Layout Box size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:11:\"column 1/12\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:11:\"column 2/12\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:11:\"column 3/12\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:11:\"column 4/12\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:11:\"column 5/12\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:11:\"column 6/12\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:11:\"column 7/12\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:11:\"column 8/12\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:11:\"column 9/12\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:12:\"column 10/12\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:12:\"column 11/12\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:12:\"column 12/12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:7:\"st_cars\";}i:4;a:6:{s:2:\"id\";s:23:\"type_show_taxonomy_cars\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:28:\"field_atrribute:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:5;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:29:\"field_atrribute:is(list_name)\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:20;}i:6;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:5:{i:0;a:3:{s:5:\"title\";s:25:\"Pick Up From, Drop Off To\";s:14:\"layout_col_box\";i:6;s:15:\"field_atrribute\";s:8:\"location\";}i:1;a:3:{s:5:\"title\";s:12:\"Pick-up Date\";s:14:\"layout_col_box\";i:3;s:15:\"field_atrribute\";s:12:\"pick-up-date\";}i:2;a:3:{s:5:\"title\";s:12:\"Pick-up Time\";s:14:\"layout_col_box\";i:3;s:15:\"field_atrribute\";s:12:\"pick-up-time\";}i:3;a:3:{s:5:\"title\";s:13:\"Drop-off Date\";s:14:\"layout_col_box\";i:3;s:15:\"field_atrribute\";s:13:\"drop-off-date\";}i:4;a:3:{s:5:\"title\";s:13:\"Drop-off Time\";s:14:\"layout_col_box\";i:3;s:15:\"field_atrribute\";s:13:\"drop-off-time\";}}}i:177;a:6:{s:2:\"id\";s:10:\"car_review\";s:5:\"label\";s:14:\"Review options\";s:4:\"desc\";s:34:\"ON: Turn on the mode of car review\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:10:\"option_car\";s:3:\"std\";s:2:\"on\";}i:178;a:8:{s:2:\"id\";s:16:\"car_review_stats\";s:5:\"label\";s:16:\"Review criterias\";s:4:\"desc\";s:41:\"You can add, sort review criteria for car\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:10:\"option_car\";s:9:\"condition\";s:17:\"car_review:is(on)\";s:8:\"settings\";a:1:{i:0;a:4:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:9:\"Stat Name\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}s:3:\"std\";a:5:{i:0;a:1:{s:5:\"title\";s:11:\"stat name 1\";}i:1;a:1:{s:5:\"title\";s:11:\"stat name 2\";}i:2;a:1:{s:5:\"title\";s:11:\"stat name 3\";}i:3;a:1:{s:5:\"title\";s:11:\"stat name 4\";}i:4;a:1:{s:5:\"title\";s:11:\"stat name 5\";}}}i:179;a:6:{s:2:\"id\";s:30:\"st_cars_unlimited_custom_field\";s:5:\"label\";s:17:\"Car custom fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:10:\"option_car\";s:4:\"desc\";s:41:\"You can create, add custom fields for car\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:10:\"type_field\";s:5:\"label\";s:10:\"Field type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:4:\"text\";s:5:\"label\";s:10:\"Text field\";}i:1;a:2:{s:5:\"value\";s:8:\"textarea\";s:5:\"label\";s:14:\"Textarea field\";}i:2;a:2:{s:5:\"value\";s:11:\"date-picker\";s:5:\"label\";s:10:\"Date field\";}}}i:1;a:4:{s:2:\"id\";s:13:\"default_field\";s:5:\"label\";s:7:\"Default\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}}i:180;a:6:{s:2:\"id\";s:23:\"st_cars_icon_map_marker\";s:5:\"label\";s:15:\"Map marker icon\";s:4:\"desc\";s:41:\"Select map icon to show car on Map Google\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:10:\"option_car\";s:3:\"std\";s:48:\"http://maps.google.com/mapfiles/marker_green.png\";}i:181;a:6:{s:2:\"id\";s:21:\"car_hide_partner_info\";s:5:\"label\";s:33:\"Show/hide contact info of partner\";s:4:\"desc\";s:47:\"Show/hide contact info of partner in single car\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:10:\"option_car\";s:3:\"std\";s:2:\"on\";}i:182;a:8:{s:2:\"id\";s:18:\"tour_show_calendar\";s:5:\"label\";s:13:\"Show calendar\";s:4:\"desc\";s:63:\"ON: Show calendar<br/>OFF: Show small calendar in form of popup\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"label\";s:28:\"Big calendar show in content\";s:5:\"value\";s:2:\"on\";}i:1;a:2:{s:5:\"label\";s:28:\"Show calendar as date picker\";s:5:\"value\";s:3:\"off\";}}s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:2:\"on\";s:6:\"v_hint\";s:3:\"yes\";}i:183;a:9:{s:2:\"id\";s:24:\"tour_show_calendar_below\";s:5:\"label\";s:17:\"Calendar position\";s:4:\"desc\";s:71:\"ON: Show calendar below book form<br/>OF: Show calendar above book form\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"label\";s:24:\"Under check availability\";s:5:\"value\";s:3:\"off\";}i:1;a:2:{s:5:\"label\";s:24:\"Below check availability\";s:5:\"value\";s:2:\"on\";}}s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:25:\"tour_show_calendar:is(on)\";s:6:\"v_hint\";s:3:\"yes\";}i:184;a:6:{s:2:\"id\";s:20:\"activity_tour_review\";s:5:\"label\";s:14:\"Review options\";s:4:\"desc\";s:39:\"ON: Turn on the mode for reviewing tour\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:2:\"on\";}i:185;a:8:{s:2:\"id\";s:17:\"tour_review_stats\";s:5:\"label\";s:15:\"Review criteria\";s:4:\"desc\";s:42:\"You can add, sort review criteria for tour\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:20:\"option_activity_tour\";s:9:\"condition\";s:27:\"activity_tour_review:is(on)\";s:8:\"settings\";a:1:{i:0;a:4:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:9:\"Stat Name\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}s:3:\"std\";a:5:{i:0;a:1:{s:5:\"title\";s:5:\"Sleep\";}i:1;a:1:{s:5:\"title\";s:8:\"Location\";}i:2;a:1:{s:5:\"title\";s:7:\"Service\";}i:3;a:1:{s:5:\"title\";s:11:\"Cleanliness\";}i:4;a:1:{s:5:\"title\";s:7:\"Room(s)\";}}}i:186;a:6:{s:2:\"id\";s:24:\"tours_search_result_page\";s:5:\"label\";s:29:\"Select layout for result page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:20:\"option_activity_tour\";}i:187;a:7:{s:2:\"id\";s:12:\"tours_layout\";s:5:\"label\";s:11:\"Tour Layout\";s:4:\"desc\";s:34:\"Select layout to show single tour \";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"st_tours\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:20:\"option_activity_tour\";}i:188;a:7:{s:2:\"id\";s:19:\"tours_search_layout\";s:5:\"label\";s:23:\"Tour Search Result Page\";s:4:\"desc\";s:43:\"Select page to show search results for tour\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:15:\"st_tours_search\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:20:\"option_activity_tour\";}i:189;a:9:{s:2:\"id\";s:19:\"tour_posts_per_page\";s:5:\"label\";s:14:\"Items per page\";s:4:\"desc\";s:45:\"Number of items on a tour results search page\";s:4:\"type\";s:6:\"number\";s:3:\"max\";i:50;s:3:\"min\";i:1;s:4:\"step\";i:1;s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:2:\"12\";}i:190;a:8:{s:2:\"id\";s:16:\"tour_sidebar_pos\";s:5:\"label\";s:16:\"Sidebar position\";s:4:\"desc\";s:36:\"Just apply for default search layout\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:20:\"option_activity_tour\";s:9:\"condition\";s:24:\"tours_search_layout:is()\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:2:\"no\";s:5:\"label\";s:2:\"No\";}i:1;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:2;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}s:3:\"std\";s:4:\"left\";}i:191;a:6:{s:2:\"id\";s:23:\"is_featured_search_tour\";s:5:\"label\";s:43:\"Show featured tours on top of search result\";s:4:\"desc\";s:52:\"ON: Show featured tours on top of result search page\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:20:\"option_activity_tour\";}i:192;a:7:{s:2:\"id\";s:27:\"activity_tour_search_fields\";s:5:\"label\";s:18:\"Tour Search Fields\";s:4:\"desc\";s:40:\"You can add, sort search fields for tour\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:20:\"option_activity_tour\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:18:\"tours_field_search\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:7:\"address\";a:2:{s:5:\"value\";s:7:\"address\";s:5:\"label\";s:8:\"Location\";}s:6:\"people\";a:2:{s:5:\"value\";s:6:\"people\";s:5:\"label\";s:6:\"People\";}s:8:\"check_in\";a:2:{s:5:\"value\";s:8:\"check_in\";s:5:\"label\";s:14:\"Departure date\";}s:9:\"check_out\";a:2:{s:5:\"value\";s:9:\"check_out\";s:5:\"label\";s:12:\"Arrival Date\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:9:\"Tour Name\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:13:\"Price slider \";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:31:\"tours_field_search:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:8:\"st_tours\";}i:5;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_tours\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:31:\"tours_field_search:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:32:\"tours_field_search:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:3:{i:0;a:5:{s:5:\"title\";s:5:\"Where\";s:10:\"layout_col\";i:6;s:11:\"layout2_col\";i:6;s:18:\"tours_field_search\";s:7:\"address\";s:11:\"placeholder\";s:17:\"Location/ Zipcode\";}i:1;a:4:{s:5:\"title\";s:14:\"Departure date\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;s:18:\"tours_field_search\";s:8:\"check_in\";}i:2;a:4:{s:5:\"title\";s:12:\"Arrival Date\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;s:18:\"tours_field_search\";s:9:\"check_out\";}}}i:193;a:6:{s:2:\"id\";s:25:\"tour_allow_search_advance\";s:5:\"label\";s:29:\"Allowed Tour  Advanced Search\";s:4:\"desc\";s:53:\"ON: Turn on thiis mode to add advanced search of tour\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:20:\"option_activity_tour\";}i:194;a:8:{s:2:\"id\";s:26:\"tour_advance_search_fields\";s:5:\"label\";s:27:\"Tour advanced search fields\";s:4:\"desc\";s:48:\"You can add, sort advanced search fields of tour\";s:9:\"condition\";s:32:\"tour_allow_search_advance:is(on)\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:20:\"option_activity_tour\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:18:\"tours_field_search\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:7:\"address\";a:2:{s:5:\"value\";s:7:\"address\";s:5:\"label\";s:8:\"Location\";}s:6:\"people\";a:2:{s:5:\"value\";s:6:\"people\";s:5:\"label\";s:6:\"People\";}s:8:\"check_in\";a:2:{s:5:\"value\";s:8:\"check_in\";s:5:\"label\";s:14:\"Departure date\";}s:9:\"check_out\";a:2:{s:5:\"value\";s:9:\"check_out\";s:5:\"label\";s:12:\"Arrival Date\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:9:\"Tour Name\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:13:\"Price slider \";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:31:\"tours_field_search:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:8:\"st_tours\";}i:5;a:6:{s:2:\"id\";s:24:\"type_show_taxonomy_tours\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:31:\"tours_field_search:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:5:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:32:\"tours_field_search:is(list_name)\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:20;}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:2:{i:0;a:4:{s:5:\"title\";s:14:\"Tour Duration \";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:18:\"tours_field_search\";s:17:\"duration-dropdown\";}i:1;a:5:{s:5:\"title\";s:8:\"Taxonomy\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:18:\"tours_field_search\";s:8:\"taxonomy\";s:8:\"taxonomy\";s:12:\"st_tour_type\";}}}i:195;a:6:{s:2:\"id\";s:24:\"st_show_number_user_book\";s:5:\"label\";s:27:\"Number of tour booked users\";s:4:\"desc\";s:76:\"ON: Show number of users who booked tour on each item in search results page\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:3:\"off\";}i:196;a:6:{s:2:\"id\";s:19:\"st_show_number_avai\";s:5:\"label\";s:38:\"Number seat availability in list tours\";s:4:\"desc\";s:69:\"ON: Show number seat availability on each item in search results page\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:3:\"off\";}i:197;a:6:{s:2:\"id\";s:28:\"tours_unlimited_custom_field\";s:5:\"label\";s:18:\"Tour custom fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:20:\"option_activity_tour\";s:4:\"desc\";s:89:\"You can create custom fields for tour. Fields will be displayed in metabox of single tour\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:10:\"type_field\";s:5:\"label\";s:10:\"Field type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:4:\"text\";s:5:\"label\";s:10:\"Text field\";}i:1;a:2:{s:5:\"value\";s:8:\"textarea\";s:5:\"label\";s:14:\"Textarea field\";}i:2;a:2:{s:5:\"value\";s:11:\"date-picker\";s:5:\"label\";s:10:\"Date field\";}}}i:1;a:4:{s:2:\"id\";s:13:\"default_field\";s:5:\"label\";s:7:\"Default\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}}i:198;a:6:{s:2:\"id\";s:24:\"st_tours_icon_map_marker\";s:5:\"label\";s:15:\"Map marker icon\";s:4:\"desc\";s:43:\"Select map icon to show hotel on Map Google\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:20:\"option_activity_tour\";s:3:\"std\";s:49:\"http://maps.google.com/mapfiles/marker_purple.png\";}i:199;a:8:{s:2:\"id\";s:22:\"activity_show_calendar\";s:5:\"label\";s:13:\"Show calendar\";s:4:\"desc\";s:63:\"ON: Show calendar<br/>OFF: Show small calendar in form of popup\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"label\";s:28:\"Big calendar show in content\";s:5:\"value\";s:2:\"on\";}i:1;a:2:{s:5:\"label\";s:28:\"Show calendar as date picker\";s:5:\"value\";s:3:\"off\";}}s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:2:\"on\";s:6:\"v_hint\";s:3:\"yes\";}i:200;a:9:{s:2:\"id\";s:28:\"activity_show_calendar_below\";s:5:\"label\";s:17:\"Calendar position\";s:4:\"desc\";s:72:\"ON: Show calendar below book form<br/>OFF: Show calendar above book form\";s:4:\"type\";s:13:\"custom-select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"label\";s:24:\"Under check availability\";s:5:\"value\";s:3:\"off\";}i:1;a:2:{s:5:\"label\";s:24:\"Below check availability\";s:5:\"value\";s:2:\"on\";}}s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:3:\"off\";s:9:\"condition\";s:29:\"activity_show_calendar:is(on)\";s:6:\"v_hint\";s:3:\"yes\";}i:201;a:7:{s:2:\"id\";s:27:\"activity_search_result_page\";s:5:\"label\";s:27:\"Activity Search Result Page\";s:4:\"desc\";s:47:\"Select page to show search results for activity\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:15:\"option_activity\";}i:202;a:6:{s:2:\"id\";s:15:\"activity_review\";s:5:\"label\";s:14:\"Review options\";s:4:\"desc\";s:43:\"ON: Turn on the mode for reviewing activity\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:2:\"on\";}i:203;a:8:{s:2:\"id\";s:21:\"activity_review_stats\";s:5:\"label\";s:15:\"Review criteria\";s:4:\"desc\";s:46:\"You can add, sort review criteria for activity\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:15:\"option_activity\";s:9:\"condition\";s:22:\"activity_review:is(on)\";s:8:\"settings\";a:1:{i:0;a:4:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:9:\"Stat Name\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}s:3:\"std\";a:5:{i:0;a:1:{s:5:\"title\";s:5:\"Sleep\";}i:1;a:1:{s:5:\"title\";s:8:\"Location\";}i:2;a:1:{s:5:\"title\";s:7:\"Service\";}i:3;a:1:{s:5:\"title\";s:11:\"Cleanliness\";}i:4;a:1:{s:5:\"title\";s:7:\"Room(s)\";}}}i:204;a:6:{s:2:\"id\";s:15:\"activity_layout\";s:5:\"label\";s:37:\"Select layout to show single activity\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:11:\"st_activity\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:15:\"option_activity\";}i:205;a:7:{s:2:\"id\";s:22:\"activity_search_layout\";s:5:\"label\";s:22:\"Activity Search Layout\";s:4:\"desc\";s:49:\"Select layout to show search results for activity\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:18:\"st_activity_search\";s:6:\"sparam\";s:6:\"layout\";s:7:\"section\";s:15:\"option_activity\";}i:206;a:8:{s:2:\"id\";s:20:\"activity_sidebar_pos\";s:5:\"label\";s:16:\"Sidebar Position\";s:4:\"desc\";s:36:\"Just apply for default search layout\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:15:\"option_activity\";s:9:\"condition\";s:27:\"activity_search_layout:is()\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:2:\"no\";s:5:\"label\";s:2:\"No\";}i:1;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:2;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}s:3:\"std\";s:4:\"left\";}i:207;a:6:{s:2:\"id\";s:27:\"is_featured_search_activity\";s:5:\"label\";s:48:\"Show featured activities on top of search result\";s:4:\"desc\";s:57:\"ON: Show featured activities on top of result search page\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:15:\"option_activity\";}i:208;a:7:{s:2:\"id\";s:22:\"activity_search_fields\";s:5:\"label\";s:23:\"Activity  Search Fields\";s:4:\"desc\";s:44:\"You can add, sort search fields for activity\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:15:\"option_activity\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:21:\"activity_field_search\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:7:\"address\";a:2:{s:5:\"value\";s:7:\"address\";s:5:\"label\";s:8:\"Location\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}i:0;a:2:{s:5:\"value\";s:8:\"check_in\";s:5:\"label\";s:8:\"Check In\";}i:1;a:2:{s:5:\"value\";s:9:\"check_out\";s:5:\"label\";s:9:\"Check Out\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:13:\"Activity Name\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:6:\"people\";a:2:{s:5:\"value\";s:6:\"people\";s:5:\"label\";s:6:\"People\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:34:\"activity_field_search:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:11:\"st_activity\";}i:5;a:6:{s:2:\"id\";s:27:\"type_show_taxonomy_activity\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:34:\"activity_field_search:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:35:\"activity_field_search:is(list_name)\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"20\";}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:3:{i:0;a:5:{s:5:\"title\";s:7:\"Address\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:6;s:21:\"activity_field_search\";s:7:\"address\";s:11:\"placeholder\";s:17:\"Location/ Zipcode\";}i:1;a:4:{s:5:\"title\";s:4:\"From\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;s:21:\"activity_field_search\";s:8:\"check_in\";}i:2;a:4:{s:5:\"title\";s:2:\"To\";s:10:\"layout_col\";i:3;s:11:\"layout2_col\";i:3;s:21:\"activity_field_search\";s:9:\"check_out\";}}}i:209;a:6:{s:2:\"id\";s:29:\"allow_activity_advance_search\";s:5:\"label\";s:33:\"Allowed Activity  Advanced Search\";s:4:\"desc\";s:59:\"ON: Turn on thiis mode to add advanced search of activities\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:15:\"option_activity\";}i:210;a:8:{s:2:\"id\";s:30:\"activity_advance_search_fields\";s:5:\"label\";s:31:\"Activity Advanced Search Fields\";s:4:\"desc\";s:52:\"You can add, sort advanced search fields of activity\";s:9:\"condition\";s:36:\"allow_activity_advance_search:is(on)\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:15:\"option_activity\";s:8:\"settings\";a:8:{i:0;a:5:{s:2:\"id\";s:21:\"activity_field_search\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:9:{s:7:\"address\";a:2:{s:5:\"value\";s:7:\"address\";s:5:\"label\";s:8:\"Location\";}s:13:\"list_location\";a:2:{s:5:\"value\";s:13:\"list_location\";s:5:\"label\";s:13:\"Location List\";}i:0;a:2:{s:5:\"value\";s:8:\"check_in\";s:5:\"label\";s:8:\"Check In\";}i:1;a:2:{s:5:\"value\";s:9:\"check_out\";s:5:\"label\";s:9:\"Check Out\";}s:8:\"taxonomy\";a:2:{s:5:\"value\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";}s:9:\"item_name\";a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:13:\"Activity Name\";}s:9:\"list_name\";a:2:{s:5:\"value\";s:9:\"list_name\";s:5:\"label\";s:9:\"List Name\";}s:6:\"people\";a:2:{s:5:\"value\";s:6:\"people\";s:5:\"label\";s:6:\"People\";}s:12:\"price_slider\";a:2:{s:5:\"value\";s:12:\"price_slider\";s:5:\"label\";s:12:\"Price slider\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:6:{s:2:\"id\";s:8:\"taxonomy\";s:5:\"label\";s:8:\"Taxonomy\";s:9:\"condition\";s:34:\"activity_field_search:is(taxonomy)\";s:8:\"operator\";s:3:\"and\";s:4:\"type\";s:13:\"st_select_tax\";s:9:\"post_type\";s:11:\"st_activity\";}i:5;a:6:{s:2:\"id\";s:27:\"type_show_taxonomy_activity\";s:5:\"label\";s:9:\"Type show\";s:9:\"condition\";s:34:\"activity_field_search:is(taxonomy)\";s:8:\"operator\";s:2:\"or\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:8:\"checkbox\";s:5:\"label\";s:8:\"Checkbox\";}i:1;a:2:{s:5:\"value\";s:6:\"select\";s:5:\"label\";s:6:\"Select\";}}}i:6;a:6:{s:2:\"id\";s:7:\"max_num\";s:5:\"label\";s:10:\"Max number\";s:9:\"condition\";s:35:\"activity_field_search:is(list_name)\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"20\";}i:7;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:2:{i:0;a:5:{s:5:\"title\";s:8:\"Taxonomy\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:21:\"activity_field_search\";s:8:\"taxonomy\";s:8:\"taxonomy\";s:11:\"attractions\";}i:1;a:4:{s:5:\"title\";s:12:\"Price Filter\";s:10:\"layout_col\";i:12;s:11:\"layout2_col\";i:12;s:21:\"activity_field_search\";s:12:\"price_slider\";}}}i:211;a:6:{s:2:\"id\";s:34:\"st_activity_unlimited_custom_field\";s:5:\"label\";s:22:\"Activity custom fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:15:\"option_activity\";s:4:\"desc\";s:97:\"You can create custom fields for activity. Fields will be displayed in metabox of single activity\";s:8:\"settings\";a:2:{i:0;a:5:{s:2:\"id\";s:10:\"type_field\";s:5:\"label\";s:10:\"Field type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:4:\"text\";s:5:\"label\";s:10:\"Text field\";}i:1;a:2:{s:5:\"value\";s:8:\"textarea\";s:5:\"label\";s:14:\"Textarea field\";}i:2;a:2:{s:5:\"value\";s:11:\"date-picker\";s:5:\"label\";s:10:\"Date field\";}}}i:1;a:4:{s:2:\"id\";s:13:\"default_field\";s:5:\"label\";s:7:\"Default\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}}}i:212;a:6:{s:2:\"id\";s:28:\"st_show_number_activity_avai\";s:5:\"label\";s:41:\"Number seat availability in list activity\";s:4:\"desc\";s:69:\"ON: Show number seat availability on each item in search results page\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:3:\"off\";}i:213;a:6:{s:2:\"id\";s:27:\"st_activity_icon_map_marker\";s:5:\"label\";s:15:\"Map marker icon\";s:4:\"desc\";s:43:\"Select map icon to show hotel on Map Google\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:49:\"http://maps.google.com/mapfiles/marker_yellow.png\";}i:214;a:6:{s:2:\"id\";s:26:\"activity_hide_partner_info\";s:5:\"label\";s:33:\"Show/hide contact info of partner\";s:4:\"desc\";s:41:\"Show/hide partner info in single activity\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:15:\"option_activity\";s:3:\"std\";s:2:\"on\";}i:215;a:6:{s:2:\"id\";s:24:\"car_transfer_search_page\";s:5:\"label\";s:47:\"Select page to show search results for transfer\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:19:\"option_car_transfer\";}i:216;a:6:{s:2:\"id\";s:24:\"car_transfer_by_location\";s:5:\"label\";s:41:\"Set car transfer search field by location\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:19:\"option_car_transfer\";s:3:\"std\";s:3:\"off\";s:4:\"desc\";s:79:\"ON: Search car transfer by location - Off: Search car transfer by hotel/airport\";}i:217;a:6:{s:2:\"id\";s:26:\"car_transfer_search_fields\";s:5:\"label\";s:22:\"Transfer Search Fields\";s:4:\"desc\";s:44:\"You can add, sort search fields for transfer\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:19:\"option_car_transfer\";s:8:\"settings\";a:5:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:4:{s:13:\"transfer_from\";a:2:{s:5:\"value\";s:13:\"transfer_from\";s:5:\"label\";s:4:\"From\";}s:11:\"transfer_to\";a:2:{s:5:\"value\";s:11:\"transfer_to\";s:5:\"label\";s:2:\"To\";}s:9:\"passenger\";a:2:{s:5:\"value\";s:9:\"passenger\";s:5:\"label\";s:10:\"Passengers\";}s:11:\"checkin_out\";a:2:{s:5:\"value\";s:11:\"checkin_out\";s:5:\"label\";s:4:\"Date\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:6:{s:2:\"id\";s:11:\"layout2_col\";s:5:\"label\";s:13:\"Layout 2 Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:4;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}i:4;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}}i:218;a:4:{s:2:\"id\";s:27:\"hotel_alone_general_setting\";s:5:\"label\";s:15:\"General Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:219;a:5:{s:2:\"id\";s:16:\"hotel_alone_logo\";s:5:\"label\";s:12:\"Logo options\";s:4:\"desc\";s:14:\"To change logo\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:220;a:6:{s:2:\"id\";s:25:\"st_hotel_alone_main_color\";s:5:\"label\";s:10:\"Main Color\";s:4:\"desc\";s:32:\"To change the main color for web\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:18:\"option_hotel_alone\";s:3:\"std\";s:7:\"#ed8323\";}i:221;a:7:{s:2:\"id\";s:26:\"st_hotel_alone_footer_page\";s:5:\"label\";s:18:\"Select footer page\";s:4:\"desc\";s:36:\"Select the page to display as footer\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:222;a:7:{s:2:\"id\";s:31:\"st_hotel_alone_room_search_page\";s:5:\"label\";s:23:\"Select room search page\";s:4:\"desc\";s:38:\"Select the page to display room result\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:223;a:5:{s:2:\"id\";s:30:\"st_hotel_alone_blog_list_style\";s:5:\"label\";s:10:\"Blog style\";s:7:\"section\";s:18:\"option_hotel_alone\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"list\";s:5:\"label\";s:4:\"List\";}i:1;a:2:{s:5:\"value\";s:4:\"grid\";s:5:\"label\";s:4:\"Grid\";}}}i:224;a:4:{s:2:\"id\";s:26:\"hotel_alone_topbar_setting\";s:5:\"label\";s:14:\"Topbar Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:225;a:7:{s:2:\"id\";s:27:\"st_hotel_alone_topbar_style\";s:5:\"label\";s:12:\"TopBar style\";s:4:\"desc\";s:30:\"Choose a layout for your theme\";s:4:\"type\";s:11:\"radio-image\";s:7:\"section\";s:18:\"option_hotel_alone\";s:3:\"std\";s:4:\"none\";s:7:\"choices\";a:5:{i:0;a:3:{s:2:\"id\";s:4:\"none\";s:3:\"alt\";s:9:\"No Topbar\";s:3:\"src\";s:113:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/topbar/no_topbar.jpg\";}i:1;a:3:{s:2:\"id\";s:7:\"style_1\";s:3:\"alt\";s:7:\"Style 1\";s:3:\"src\";s:111:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/topbar/topbar1.jpg\";}i:2;a:3:{s:2:\"id\";s:7:\"style_2\";s:3:\"alt\";s:7:\"Style 2\";s:3:\"src\";s:111:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/topbar/topbar2.jpg\";}i:3;a:3:{s:2:\"id\";s:7:\"style_3\";s:3:\"alt\";s:7:\"Style 3\";s:3:\"src\";s:111:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/topbar/topbar3.jpg\";}i:4;a:3:{s:2:\"id\";s:7:\"style_4\";s:3:\"alt\";s:7:\"Style 4\";s:3:\"src\";s:111:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/topbar/topbar4.jpg\";}}}i:226;a:5:{s:2:\"id\";s:44:\"st_hotel_alone_topbar_background_transparent\";s:5:\"label\";s:29:\"Topbar Background Transparent\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:227;a:8:{s:2:\"id\";s:32:\"st_hotel_alone_topbar_background\";s:5:\"label\";s:17:\"Topbar Background\";s:4:\"desc\";s:17:\"Topbar Background\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:18:\"option_hotel_alone\";s:9:\"condition\";s:52:\"st_hotel_alone_topbar_background_transparent:is(off)\";s:8:\"operator\";s:2:\"or\";s:3:\"std\";s:7:\"#ffffff\";}i:228;a:4:{s:2:\"id\";s:36:\"st_hotel_alone_topbar_contact_number\";s:5:\"label\";s:14:\"Contact Number\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:229;a:4:{s:2:\"id\";s:35:\"st_hotel_alone_topbar_email_address\";s:5:\"label\";s:13:\"Email Address\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:230;a:6:{s:2:\"id\";s:30:\"st_hotel_alone_topbar_location\";s:5:\"label\";s:15:\"Location Select\";s:7:\"section\";s:18:\"option_hotel_alone\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"location\";s:6:\"sparam\";s:15:\"posttype_select\";}i:231;a:4:{s:2:\"id\";s:31:\"hotel_alone_form_search_setting\";s:5:\"label\";s:29:\"Form Search On Topbar Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:232;a:4:{s:2:\"id\";s:39:\"st_hotel_alone_topbar_title_search_form\";s:5:\"label\";s:17:\"Title Form Search\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:233;a:7:{s:2:\"id\";s:33:\"st_hotel_alone_topbar_search_form\";s:5:\"label\";s:16:\"Room search form\";s:4:\"desc\";s:18:\"Room search fields\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:18:\"option_hotel_alone\";s:3:\"std\";a:4:{i:0;a:4:{s:5:\"title\";s:8:\"Check in\";s:11:\"placeholder\";s:8:\"Check in\";s:4:\"name\";s:8:\"check_in\";s:11:\"layout_size\";i:6;}i:1;a:4:{s:5:\"title\";s:9:\"Check out\";s:11:\"placeholder\";s:9:\"Check out\";s:4:\"name\";s:9:\"check_out\";s:11:\"layout_size\";i:6;}i:2;a:3:{s:5:\"title\";s:4:\"Room\";s:4:\"name\";s:11:\"room_number\";s:11:\"layout_size\";i:6;}i:3;a:3:{s:5:\"title\";s:5:\"Adult\";s:4:\"name\";s:6:\"adults\";s:11:\"layout_size\";i:6;}}s:8:\"settings\";a:3:{i:0;a:5:{s:2:\"id\";s:4:\"name\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:4:{i:0;a:2:{s:5:\"value\";s:8:\"check_in\";s:5:\"label\";s:8:\"Check In\";}i:1;a:2:{s:5:\"value\";s:11:\"room_number\";s:5:\"label\";s:11:\"Room Number\";}i:2;a:2:{s:5:\"value\";s:6:\"adults\";s:5:\"label\";s:5:\"Adult\";}i:3;a:2:{s:5:\"value\";s:8:\"children\";s:5:\"label\";s:8:\"Children\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:11:\"layout_size\";s:5:\"label\";s:18:\"Layout Normal Size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";i:6;s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}}}}i:234;a:4:{s:2:\"id\";s:38:\"st_hotel_alone_topbar_desc_search_form\";s:5:\"label\";s:11:\"Description\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:235;a:4:{s:2:\"id\";s:24:\"hotel_alone_menu_setting\";s:5:\"label\";s:12:\"Menu Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:18:\"option_hotel_alone\";}i:236;a:6:{s:2:\"id\";s:28:\"st_hotel_alone_menu_location\";s:5:\"label\";s:11:\"Menu Select\";s:7:\"section\";s:18:\"option_hotel_alone\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"nav_menu\";s:6:\"sparam\";s:15:\"posttype_select\";}i:237;a:7:{s:2:\"id\";s:25:\"st_hotel_alone_menu_style\";s:5:\"label\";s:10:\"Menu style\";s:4:\"desc\";s:30:\"Choose a layout for your theme\";s:4:\"type\";s:11:\"radio-image\";s:7:\"section\";s:18:\"option_hotel_alone\";s:7:\"choices\";a:4:{i:0;a:3:{s:2:\"id\";s:4:\"none\";s:3:\"alt\";s:4:\"None\";s:3:\"src\";s:111:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/menu/menu_none.jpg\";}i:1;a:3:{s:2:\"id\";s:7:\"style_1\";s:3:\"alt\";s:7:\"Style 1\";s:3:\"src\";s:107:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/menu/menu1.jpg\";}i:2;a:3:{s:2:\"id\";s:7:\"style_2\";s:3:\"alt\";s:7:\"Style 2\";s:3:\"src\";s:107:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/menu/menu2.jpg\";}i:3;a:3:{s:2:\"id\";s:7:\"style_3\";s:3:\"alt\";s:7:\"Style 3\";s:3:\"src\";s:107:\"http://localhost/tourphoria/wp-content/themes/traveler/inc/modules/hotel-alone/assets/images/menu/menu3.jpg\";}}s:3:\"std\";s:7:\"style_2\";}i:238;a:7:{s:2:\"id\";s:24:\"st_hotel_alone_left_menu\";s:5:\"label\";s:9:\"Left Menu\";s:7:\"section\";s:18:\"option_hotel_alone\";s:9:\"condition\";s:37:\"st_hotel_alone_menu_style:is(style_1)\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"nav_menu\";s:6:\"sparam\";s:15:\"posttype_select\";}i:239;a:7:{s:2:\"id\";s:25:\"st_hotel_alone_right_menu\";s:5:\"label\";s:10:\"Right Menu\";s:7:\"section\";s:18:\"option_hotel_alone\";s:9:\"condition\";s:37:\"st_hotel_alone_menu_style:is(style_1)\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:8:\"nav_menu\";s:6:\"sparam\";s:15:\"posttype_select\";}i:240;a:5:{s:2:\"id\";s:25:\"st_hotel_alone_menu_color\";s:5:\"label\";s:10:\"Menu color\";s:4:\"type\";s:11:\"colorpicker\";s:7:\"section\";s:18:\"option_hotel_alone\";s:3:\"std\";s:4:\"#fff\";}i:241;a:5:{s:2:\"id\";s:25:\"st_hotel_alone_fixed_menu\";s:5:\"label\";s:11:\"Sticky Menu\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:18:\"option_hotel_alone\";s:3:\"std\";s:3:\"off\";}i:242;a:4:{s:2:\"id\";s:19:\"tour_modern_general\";s:4:\"type\";s:3:\"tab\";s:5:\"label\";s:15:\"General Options\";s:7:\"section\";s:18:\"option_tour_modern\";}i:243;a:6:{s:2:\"id\";s:23:\"tour_modern_topbar_menu\";s:5:\"label\";s:19:\"Topbar menu options\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:18:\"option_tour_modern\";s:4:\"desc\";s:34:\"Select topbar item shown in topbar\";s:8:\"settings\";a:5:{i:0;a:5:{s:2:\"id\";s:11:\"topbar_item\";s:5:\"label\";s:4:\"Item\";s:4:\"type\";s:6:\"select\";s:4:\"desc\";s:11:\"Select item\";s:7:\"choices\";a:4:{i:0;a:2:{s:5:\"value\";s:5:\"login\";s:5:\"label\";s:5:\"Login\";}i:1;a:2:{s:5:\"value\";s:8:\"currency\";s:5:\"label\";s:8:\"Currency\";}i:2;a:2:{s:5:\"value\";s:8:\"language\";s:5:\"label\";s:8:\"Language\";}i:3;a:2:{s:5:\"value\";s:4:\"link\";s:5:\"label\";s:11:\"Custom Link\";}}}i:1;a:4:{s:2:\"id\";s:18:\"topbar_custom_link\";s:5:\"label\";s:4:\"Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:2;a:4:{s:2:\"id\";s:24:\"topbar_custom_link_title\";s:5:\"label\";s:10:\"Title Link\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:3;a:4:{s:2:\"id\";s:23:\"topbar_custom_link_icon\";s:5:\"label\";s:4:\"Icon\";s:4:\"type\";s:6:\"upload\";s:9:\"condition\";s:20:\"topbar_item:is(link)\";}i:4;a:4:{s:2:\"id\";s:15:\"topbar_position\";s:5:\"label\";s:8:\"Position\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"left\";s:5:\"label\";s:4:\"Left\";}i:1;a:2:{s:5:\"value\";s:5:\"right\";s:5:\"label\";s:5:\"Right\";}}}}}i:244;a:4:{s:2:\"id\";s:19:\"partner_general_tab\";s:5:\"label\";s:15:\"General Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_partner\";}i:245;a:6:{s:2:\"id\";s:33:\"enable_automatic_approval_partner\";s:5:\"label\";s:18:\"Automatic approval\";s:4:\"desc\";s:30:\"Partner be automatic approval.\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:14:\"option_partner\";}i:246;a:6:{s:2:\"id\";s:26:\"enable_pretty_link_partner\";s:5:\"label\";s:41:\"Allowed custom sort link for partner page\";s:4:\"desc\";s:52:\"ON: show link of partner page in form of pretty link\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:14:\"option_partner\";}i:247;a:7:{s:2:\"id\";s:17:\"slug_partner_page\";s:5:\"label\";s:24:\"Slug of the partner page\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:17:\"page-user-setting\";s:4:\"desc\";s:51:\"Enter slug name of partner page to show pretty link\";s:9:\"condition\";s:33:\"enable_pretty_link_partner:is(on)\";s:7:\"section\";s:14:\"option_partner\";}i:248;a:6:{s:2:\"id\";s:25:\"partner_show_contact_info\";s:5:\"label\";s:23:\"Show email contact info\";s:4:\"desc\";s:112:\"ON: Show email of author(who posts service) in single, email page. OFF: Show email entered in metabox of service\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_partner\";s:3:\"std\";s:3:\"off\";}i:249;a:6:{s:2:\"id\";s:22:\"partner_enable_feature\";s:5:\"label\";s:22:\"Enable Partner Feature\";s:4:\"desc\";s:131:\"ON: Show services for partner. OFF: Turn off services, partner is not allowed to register service, it is not displayed in dashboard\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_partner\";s:3:\"std\";s:3:\"off\";}i:250;a:6:{s:2:\"id\";s:21:\"partner_post_by_admin\";s:5:\"label\";s:40:\"Partner\'s post must be aprroved by admin\";s:4:\"desc\";s:75:\"ON: When partner posts a service, it needs to be approved by administrator \";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_partner\";s:3:\"std\";s:2:\"on\";}i:251;a:6:{s:2:\"id\";s:18:\"admin_menu_partner\";s:5:\"label\";s:15:\"Partner menubar\";s:4:\"desc\";s:58:\"ON: Turn on partner menubar. OFF: Turn off partner menubar\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_partner\";s:3:\"std\";s:3:\"off\";}i:252;a:8:{s:2:\"id\";s:18:\"partner_commission\";s:5:\"label\";s:13:\"Commission(%)\";s:4:\"desc\";s:64:\"Enter commission of partner for admin after each item is booked \";s:4:\"type\";s:6:\"number\";s:3:\"min\";i:0;s:3:\"max\";i:100;s:4:\"step\";i:1;s:7:\"section\";s:14:\"option_partner\";}i:253;a:6:{s:2:\"id\";s:19:\"partner_set_feature\";s:5:\"label\";s:24:\"Partner can set featured\";s:7:\"section\";s:14:\"option_partner\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:47:\"It allows partner to set an item to be featured\";s:3:\"std\";s:3:\"off\";}i:254;a:6:{s:2:\"id\";s:25:\"partner_set_external_link\";s:5:\"label\";s:42:\"Partner can set external link for services\";s:7:\"section\";s:14:\"option_partner\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:51:\"It allows partner to set external link for services\";s:3:\"std\";s:3:\"off\";}i:255;a:5:{s:2:\"id\";s:22:\"avatar_in_list_service\";s:5:\"label\";s:33:\"Show avatar user in list services\";s:7:\"section\";s:14:\"option_partner\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:256;a:7:{s:2:\"id\";s:25:\"display_list_partner_info\";s:5:\"label\";s:28:\"Show contact info of partner\";s:4:\"desc\";s:66:\"Display or hide contact information of partner in the partner page\";s:4:\"type\";s:8:\"checkbox\";s:7:\"section\";s:14:\"option_partner\";s:7:\"choices\";a:7:{i:0;a:2:{s:5:\"label\";s:3:\"All\";s:5:\"value\";s:3:\"all\";}i:1;a:2:{s:5:\"label\";s:5:\"Email\";s:5:\"value\";s:5:\"email\";}i:2;a:2:{s:5:\"label\";s:5:\"Phone\";s:5:\"value\";s:5:\"phone\";}i:3;a:2:{s:5:\"label\";s:12:\"Email PayPal\";s:5:\"value\";s:12:\"email_paypal\";}i:4;a:2:{s:5:\"label\";s:12:\"Home Airport\";s:5:\"value\";s:12:\"home_airport\";}i:5;a:2:{s:5:\"label\";s:7:\"Address\";s:5:\"value\";s:7:\"address\";}i:6;a:2:{s:5:\"label\";s:11:\"Description\";s:5:\"value\";s:3:\"bio\";}}s:3:\"std\";s:3:\"all\";}i:257;a:4:{s:2:\"id\";s:14:\"membership_tab\";s:5:\"label\";s:10:\"Membership\";s:7:\"section\";s:14:\"option_partner\";s:4:\"type\";s:3:\"tab\";}i:258;a:5:{s:2:\"id\";s:17:\"enable_membership\";s:5:\"label\";s:17:\"Enable Membership\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:14:\"option_partner\";}i:259;a:7:{s:2:\"id\";s:20:\"member_packages_page\";s:5:\"label\";s:20:\"Member Packages Page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:4:\"desc\";s:38:\"Select a page for member packages page\";s:7:\"section\";s:14:\"option_partner\";}i:260;a:7:{s:2:\"id\";s:20:\"member_checkout_page\";s:5:\"label\";s:20:\"Member Checkout Page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:4:\"desc\";s:42:\"Select a checkout page for member packages\";s:7:\"section\";s:14:\"option_partner\";}i:261;a:7:{s:2:\"id\";s:19:\"member_success_page\";s:5:\"label\";s:28:\"Member Checkout Success Page\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:4:\"desc\";s:50:\"Select a checkout success page for member packages\";s:7:\"section\";s:14:\"option_partner\";}i:262;a:4:{s:2:\"id\";s:25:\"partner_custom_layout_tab\";s:5:\"label\";s:16:\"Layout Dashboard\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_partner\";}i:263;a:6:{s:2:\"id\";s:21:\"partner_custom_layout\";s:5:\"label\";s:34:\"Configuration partner profile info\";s:4:\"desc\";s:40:\"Show/hide sections for partner dashboard\";s:7:\"section\";s:14:\"option_partner\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";}i:264;a:7:{s:2:\"id\";s:35:\"partner_custom_layout_total_earning\";s:5:\"label\";s:18:\"Show total earning\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:64:\"ON: Display earnings information in accordance with time periods\";s:3:\"std\";s:2:\"on\";s:9:\"condition\";s:28:\"partner_custom_layout:is(on)\";s:7:\"section\";s:14:\"option_partner\";}i:265;a:7:{s:2:\"id\";s:37:\"partner_custom_layout_service_earning\";s:5:\"label\";s:25:\"Show each service earning\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:46:\"ON: Display earnings according to each service\";s:3:\"std\";s:2:\"on\";s:9:\"condition\";s:28:\"partner_custom_layout:is(on)\";s:7:\"section\";s:14:\"option_partner\";}i:266;a:7:{s:2:\"id\";s:32:\"partner_custom_layout_chart_info\";s:5:\"label\";s:15:\"Show chart info\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:67:\"ON: Display visual graphs to follow your earnings through each time\";s:3:\"std\";s:2:\"on\";s:9:\"condition\";s:28:\"partner_custom_layout:is(on)\";s:7:\"section\";s:14:\"option_partner\";}i:267;a:7:{s:2:\"id\";s:37:\"partner_custom_layout_booking_history\";s:5:\"label\";s:20:\"Show booking history\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:36:\"ON: Show book ing history of partner\";s:3:\"std\";s:2:\"on\";s:9:\"condition\";s:28:\"partner_custom_layout:is(on)\";s:7:\"section\";s:14:\"option_partner\";}i:268;a:4:{s:2:\"id\";s:26:\"partner_withdrawal_options\";s:5:\"label\";s:18:\"Withdrawal Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_partner\";}i:269;a:6:{s:2:\"id\";s:17:\"enable_withdrawal\";s:5:\"label\";s:24:\"Allow request withdrawal\";s:4:\"desc\";s:40:\"ON: Partner is allowed to withdraw money\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:14:\"option_partner\";}i:270;a:6:{s:2:\"id\";s:35:\"partner_withdrawal_payout_price_min\";s:5:\"label\";s:37:\"Minimum value request when withdrawal\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_partner\";s:4:\"desc\";s:50:\"Enter minimum value when a withdrawal is conducted\";s:3:\"std\";s:3:\"100\";}i:271;a:6:{s:2:\"id\";s:30:\"partner_date_payout_this_month\";s:5:\"label\";s:42:\"Date of sucessful payment in current month\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_partner\";s:4:\"desc\";s:38:\"Enter the date monthly payment. Ex: 25\";s:3:\"std\";s:2:\"25\";}i:272;a:4:{s:2:\"id\";s:21:\"partner_inbox_options\";s:5:\"label\";s:13:\"Inbox Options\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:14:\"option_partner\";}i:273;a:6:{s:2:\"id\";s:12:\"enable_inbox\";s:5:\"label\";s:19:\"Allow request inbox\";s:4:\"desc\";s:31:\"ON: Partner is allowed to inbox\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:3:\"off\";s:7:\"section\";s:14:\"option_partner\";}i:274;a:6:{s:2:\"id\";s:25:\"enable_send_email_partner\";s:5:\"label\";s:21:\"Allow send to partner\";s:4:\"desc\";s:62:\"It allows partner to receive email when there is a new message\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:14:\"option_partner\";}i:275;a:6:{s:2:\"id\";s:23:\"enable_send_email_buyer\";s:5:\"label\";s:19:\"Allow send to buyer\";s:4:\"desc\";s:60:\"It allows users to receive email when there is a new message\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:14:\"option_partner\";}i:276;a:4:{s:2:\"id\";s:27:\"tab_partner_email_for_admin\";s:5:\"label\";s:26:\"[Register] Email For Admin\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:20:\"option_email_partner\";}i:277;a:6:{s:2:\"id\";s:23:\"partner_email_for_admin\";s:5:\"label\";s:33:\"[Register] Email to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:278;a:6:{s:2:\"id\";s:30:\"partner_resend_email_for_admin\";s:5:\"label\";s:40:\"[Register] Resend email to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:279;a:6:{s:2:\"id\";s:29:\"user_register_email_for_admin\";s:5:\"label\";s:45:\"[Register normal user] Email to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:280;a:4:{s:2:\"id\";s:30:\"tab_partner_email_for_customer\";s:5:\"label\";s:29:\"[Register] Email for customer\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:20:\"option_email_partner\";}i:281;a:6:{s:2:\"id\";s:26:\"partner_email_for_customer\";s:5:\"label\";s:28:\"[Register] Email to customer\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:282;a:6:{s:2:\"id\";s:22:\"partner_email_approved\";s:5:\"label\";s:27:\"[Register] Email to partner\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:283;a:6:{s:2:\"id\";s:20:\"partner_email_cancel\";s:5:\"label\";s:33:\"[Register] Email for cancellation\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:284;a:4:{s:2:\"id\";s:30:\"tab_withdrawal_email_for_admin\";s:5:\"label\";s:28:\"[Withdrawal] Email For Admin\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:20:\"option_email_partner\";}i:285;a:6:{s:2:\"id\";s:33:\"send_admin_new_request_withdrawal\";s:5:\"label\";s:32:\"[Request] Email to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:286;a:6:{s:2:\"id\";s:30:\"send_admin_approved_withdrawal\";s:5:\"label\";s:33:\"[Approved] Email to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:287;a:4:{s:2:\"id\";s:33:\"tab_withdrawal_email_for_customer\";s:5:\"label\";s:31:\"[Withdrawal] Email For Customer\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:20:\"option_email_partner\";}i:288;a:6:{s:2:\"id\";s:32:\"send_user_new_request_withdrawal\";s:5:\"label\";s:23:\"[Request] Email to user\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:289;a:6:{s:2:\"id\";s:29:\"send_user_approved_withdrawal\";s:5:\"label\";s:24:\"[Approved] Email to user\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:290;a:6:{s:2:\"id\";s:27:\"send_user_cancel_withdrawal\";s:5:\"label\";s:22:\"[Cancel] Email to user\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:291;a:4:{s:2:\"id\";s:19:\"member_packages_tab\";s:5:\"label\";s:28:\"[Membership] Email For Admin\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:20:\"option_email_partner\";}i:292;a:5:{s:2:\"id\";s:22:\"membership_email_admin\";s:5:\"label\";s:39:\"Email for admin when have a new member.\";s:4:\"type\";s:8:\"textarea\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:293;a:5:{s:2:\"id\";s:24:\"membership_email_partner\";s:5:\"label\";s:41:\"Email for partner when have a new member.\";s:4:\"type\";s:8:\"textarea\";s:7:\"section\";s:20:\"option_email_partner\";s:3:\"std\";b:0;}i:294;a:6:{s:2:\"id\";s:19:\"search_results_view\";s:5:\"label\";s:35:\"Select default search result layout\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:13:\"option_search\";s:4:\"desc\";s:22:\"List view or Grid view\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:4:\"list\";s:5:\"label\";s:9:\"List view\";}i:1;a:2:{s:5:\"value\";s:4:\"grid\";s:5:\"label\";s:9:\"Grid view\";}}}i:295;a:7:{s:2:\"id\";s:11:\"search_tabs\";s:5:\"label\";s:22:\"Display searching tabs\";s:4:\"desc\";s:24:\"Search Tabs on home page\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_search\";s:8:\"settings\";a:5:{i:0;a:3:{s:2:\"id\";s:9:\"check_tab\";s:5:\"label\";s:8:\"Show tab\";s:4:\"type\";s:6:\"on-off\";}i:1;a:4:{s:2:\"id\";s:8:\"tab_icon\";s:5:\"label\";s:4:\"Icon\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:48:\"This allows you to change icon next to the title\";}i:2;a:4:{s:2:\"id\";s:16:\"tab_search_title\";s:5:\"label\";s:10:\"Form Title\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:49:\"This allows you to change the text above the form\";}i:3;a:4:{s:2:\"id\";s:8:\"tab_name\";s:5:\"label\";s:10:\"Choose Tab\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:16:{i:0;a:2:{s:5:\"value\";s:5:\"hotel\";s:5:\"label\";s:5:\"Hotel\";}i:1;a:2:{s:5:\"value\";s:6:\"rental\";s:5:\"label\";s:6:\"Rental\";}i:2;a:2:{s:5:\"value\";s:4:\"tour\";s:5:\"label\";s:4:\"Tour\";}i:3;a:2:{s:5:\"value\";s:4:\"cars\";s:5:\"label\";s:3:\"Car\";}i:4;a:2:{s:5:\"value\";s:10:\"activities\";s:5:\"label\";s:10:\"Activities\";}i:5;a:2:{s:5:\"value\";s:10:\"hotel_room\";s:5:\"label\";s:4:\"Room\";}i:6;a:2:{s:5:\"value\";s:6:\"flight\";s:5:\"label\";s:6:\"Flight\";}i:7;a:2:{s:5:\"value\";s:13:\"all_post_type\";s:5:\"label\";s:13:\"All Post Type\";}i:8;a:2:{s:5:\"value\";s:9:\"tp_flight\";s:5:\"label\";s:20:\"TravelPayouts Flight\";}i:9;a:2:{s:5:\"value\";s:8:\"tp_hotel\";s:5:\"label\";s:18:\"TravelPayout Hotel\";}i:10;a:2:{s:5:\"value\";s:9:\"ss_flight\";s:5:\"label\";s:17:\"Skyscanner Flight\";}i:11;a:2:{s:5:\"value\";s:12:\"car_transfer\";s:5:\"label\";s:12:\"Car Transfer\";}i:12;a:2:{s:5:\"value\";s:5:\"cbapi\";s:5:\"label\";s:11:\"Colibri API\";}i:13;a:2:{s:5:\"value\";s:15:\"hotels_combined\";s:5:\"label\";s:14:\"HotelsCombined\";}i:14;a:2:{s:5:\"value\";s:9:\"bookingdc\";s:5:\"label\";s:11:\"Booking.com\";}i:15;a:2:{s:5:\"value\";s:7:\"expedia\";s:5:\"label\";s:7:\"Expedia\";}}}i:4;a:5:{s:2:\"id\";s:15:\"tab_html_custom\";s:5:\"label\";s:15:\"Use HTML bellow\";s:4:\"type\";s:15:\"textarea-simple\";s:4:\"rows\";i:7;s:4:\"desc\";s:40:\"This allows you to do short code or HTML\";}}s:3:\"std\";a:5:{i:0;a:5:{s:5:\"title\";s:5:\"Hotel\";s:9:\"check_tab\";s:2:\"on\";s:8:\"tab_icon\";s:13:\"fa-building-o\";s:16:\"tab_search_title\";s:25:\"Search and Save on Hotels\";s:8:\"tab_name\";s:5:\"hotel\";}i:1;a:5:{s:5:\"title\";s:4:\"Cars\";s:9:\"check_tab\";s:2:\"on\";s:8:\"tab_icon\";s:6:\"fa-car\";s:16:\"tab_search_title\";s:28:\"Search for Cheap Rental Cars\";s:8:\"tab_name\";s:4:\"cars\";}i:2;a:5:{s:5:\"title\";s:5:\"Tours\";s:9:\"check_tab\";s:2:\"on\";s:8:\"tab_icon\";s:9:\"fa-flag-o\";s:16:\"tab_search_title\";s:5:\"Tours\";s:8:\"tab_name\";s:4:\"tour\";}i:3;a:5:{s:5:\"title\";s:7:\"Rentals\";s:9:\"check_tab\";s:2:\"on\";s:8:\"tab_icon\";s:7:\"fa-home\";s:16:\"tab_search_title\";s:22:\"Find Your Perfect Home\";s:8:\"tab_name\";s:6:\"rental\";}i:4;a:5:{s:5:\"title\";s:8:\"Activity\";s:9:\"check_tab\";s:2:\"on\";s:8:\"tab_icon\";s:7:\"fa-bolt\";s:16:\"tab_search_title\";s:26:\"Find Your Perfect Activity\";s:8:\"tab_name\";s:10:\"activities\";}}}i:296;a:6:{s:2:\"id\";s:32:\"all_post_type_search_result_page\";s:5:\"label\";s:51:\"Select page display search results for all services\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:4:\"page\";s:6:\"sparam\";s:4:\"page\";s:7:\"section\";s:13:\"option_search\";}i:297;a:7:{s:2:\"id\";s:27:\"all_post_type_search_fields\";s:5:\"label\";s:35:\"Custom search form for all services\";s:4:\"desc\";s:35:\"Custom search form for all services\";s:4:\"type\";s:9:\"list-item\";s:7:\"section\";s:13:\"option_search\";s:8:\"settings\";a:4:{i:0;a:5:{s:2:\"id\";s:12:\"field_search\";s:5:\"label\";s:10:\"Field Type\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:3:{i:0;a:2:{s:5:\"value\";s:7:\"address\";s:5:\"label\";s:7:\"Address\";}i:1;a:2:{s:5:\"value\";s:9:\"item_name\";s:5:\"label\";s:4:\"Name\";}i:2;a:2:{s:5:\"value\";s:9:\"post_type\";s:5:\"label\";s:9:\"Post Type\";}}}i:1;a:5:{s:2:\"id\";s:11:\"placeholder\";s:5:\"label\";s:11:\"Placeholder\";s:4:\"desc\";s:11:\"Placeholder\";s:4:\"type\";s:4:\"text\";s:8:\"operator\";s:3:\"and\";}i:2;a:6:{s:2:\"id\";s:10:\"layout_col\";s:5:\"label\";s:13:\"Layout 1 size\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:12:{i:0;a:2:{s:5:\"value\";s:1:\"1\";s:5:\"label\";s:8:\"column 1\";}i:1;a:2:{s:5:\"value\";s:1:\"2\";s:5:\"label\";s:8:\"column 2\";}i:2;a:2:{s:5:\"value\";s:1:\"3\";s:5:\"label\";s:8:\"column 3\";}i:3;a:2:{s:5:\"value\";s:1:\"4\";s:5:\"label\";s:8:\"column 4\";}i:4;a:2:{s:5:\"value\";s:1:\"5\";s:5:\"label\";s:8:\"column 5\";}i:5;a:2:{s:5:\"value\";s:1:\"6\";s:5:\"label\";s:8:\"column 6\";}i:6;a:2:{s:5:\"value\";s:1:\"7\";s:5:\"label\";s:8:\"column 7\";}i:7;a:2:{s:5:\"value\";s:1:\"8\";s:5:\"label\";s:8:\"column 8\";}i:8;a:2:{s:5:\"value\";s:1:\"9\";s:5:\"label\";s:8:\"column 9\";}i:9;a:2:{s:5:\"value\";s:2:\"10\";s:5:\"label\";s:9:\"column 10\";}i:10;a:2:{s:5:\"value\";s:2:\"11\";s:5:\"label\";s:9:\"column 11\";}i:11;a:2:{s:5:\"value\";s:2:\"12\";s:5:\"label\";s:9:\"column 12\";}}s:3:\"std\";i:4;}i:3;a:5:{s:2:\"id\";s:11:\"is_required\";s:5:\"label\";s:14:\"Field required\";s:4:\"type\";s:6:\"on-off\";s:8:\"operator\";s:3:\"and\";s:3:\"std\";s:2:\"on\";}}s:3:\"std\";a:1:{i:0;a:3:{s:5:\"title\";s:7:\"Address\";s:10:\"layout_col\";i:12;s:12:\"field_search\";s:7:\"address\";}}}i:298;a:6:{s:2:\"id\";s:19:\"search_header_onoff\";s:5:\"label\";s:19:\"Allow header search\";s:4:\"desc\";s:19:\"Allow header search\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:13:\"option_search\";s:3:\"std\";s:2:\"on\";}i:299;a:7:{s:2:\"id\";s:21:\"search_header_orderby\";s:5:\"label\";s:24:\"Header search - Order by\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:13:\"option_search\";s:4:\"desc\";s:24:\"Header search - Order by\";s:9:\"condition\";s:26:\"search_header_onoff:is(on)\";s:7:\"choices\";a:7:{i:0;a:2:{s:5:\"value\";s:4:\"none\";s:5:\"label\";s:4:\"None\";}i:1;a:2:{s:5:\"value\";s:2:\"ID\";s:5:\"label\";s:2:\"ID\";}i:2;a:2:{s:5:\"value\";s:6:\"author\";s:5:\"label\";s:6:\"Author\";}i:3;a:2:{s:5:\"value\";s:5:\"title\";s:5:\"label\";s:5:\"Title\";}i:4;a:2:{s:5:\"value\";s:4:\"name\";s:5:\"label\";s:4:\"Name\";}i:5;a:2:{s:5:\"value\";s:4:\"date\";s:5:\"label\";s:4:\"Date\";}i:6;a:2:{s:5:\"value\";s:4:\"rand\";s:5:\"label\";s:6:\"Random\";}}}i:300;a:7:{s:2:\"id\";s:19:\"search_header_order\";s:5:\"label\";s:21:\"Header search - order\";s:4:\"type\";s:6:\"select\";s:7:\"section\";s:13:\"option_search\";s:4:\"desc\";s:21:\"Header search - order\";s:9:\"condition\";s:26:\"search_header_onoff:is(on)\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:3:\"ASC\";s:5:\"label\";s:3:\"ASC\";}i:1;a:2:{s:5:\"value\";s:4:\"DESC\";s:5:\"label\";s:4:\"DESC\";}}}i:301;a:7:{s:2:\"id\";s:18:\"search_header_list\";s:5:\"label\";s:25:\"Header search - Search by\";s:4:\"type\";s:8:\"checkbox\";s:7:\"section\";s:13:\"option_search\";s:4:\"desc\";s:25:\"Header search - Search by\";s:9:\"condition\";s:26:\"search_header_onoff:is(on)\";s:7:\"choices\";a:5:{i:0;a:2:{s:5:\"value\";s:4:\"post\";s:5:\"label\";s:5:\"Posts\";}i:1;a:2:{s:5:\"value\";s:4:\"page\";s:5:\"label\";s:5:\"Pages\";}i:2;a:2:{s:5:\"value\";s:10:\"attachment\";s:5:\"label\";s:5:\"Media\";}i:3;a:2:{s:5:\"value\";s:12:\"wte-payments\";s:5:\"label\";s:8:\"Payments\";}i:4;a:2:{s:5:\"value\";s:4:\"trip\";s:5:\"label\";s:5:\"Trips\";}}}i:302;a:6:{s:2:\"id\";s:10:\"email_from\";s:5:\"label\";s:9:\"From name\";s:4:\"desc\";s:15:\"Email from name\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:12:\"option_email\";s:3:\"std\";s:19:\"Traveler Shinetheme\";}i:303;a:6:{s:2:\"id\";s:18:\"email_from_address\";s:5:\"label\";s:12:\"From address\";s:4:\"desc\";s:18:\"Email from address\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:12:\"option_email\";s:3:\"std\";s:23:\"traveler@shinetheme.com\";}i:304;a:6:{s:2:\"id\";s:10:\"email_logo\";s:5:\"label\";s:20:\"Select logo in email\";s:4:\"type\";s:6:\"upload\";s:7:\"section\";s:12:\"option_email\";s:4:\"desc\";s:13:\"Logo in Email\";s:3:\"std\";s:67:\"http://localhost/tourphoria/wp-content/themes/traveler/img/logo.png\";}i:305;a:6:{s:2:\"id\";s:26:\"enable_email_for_custommer\";s:5:\"label\";s:31:\"Email to customer after booking\";s:4:\"desc\";s:31:\"Email to customer after booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:12:\"option_email\";}i:306;a:6:{s:2:\"id\";s:33:\"enable_email_confirm_for_customer\";s:5:\"label\";s:39:\"Email confirm to customer after booking\";s:4:\"desc\";s:39:\"Email confirm to customer after booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:12:\"option_email\";}i:307;a:6:{s:2:\"id\";s:22:\"enable_email_for_admin\";s:5:\"label\";s:36:\"Email to administrator after booking\";s:4:\"desc\";s:36:\"Email to administrator after booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:12:\"option_email\";}i:308;a:6:{s:2:\"id\";s:19:\"email_admin_address\";s:5:\"label\";s:25:\"Input administrator email\";s:4:\"desc\";s:40:\"Booking information will be sent to here\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:0:\"\";s:7:\"section\";s:12:\"option_email\";}i:309;a:6:{s:2:\"id\";s:27:\"enable_email_for_owner_item\";s:5:\"label\";s:42:\"Email after booking for partner/owner item\";s:4:\"desc\";s:42:\"Email after booking for partner/owner item\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:12:\"option_email\";}i:310;a:6:{s:2:\"id\";s:26:\"enable_email_approved_item\";s:5:\"label\";s:52:\"Email to partner when item approved by administrator\";s:4:\"desc\";s:52:\"Email to partner when item approved by administrator\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:12:\"option_email\";}i:311;a:6:{s:2:\"id\";s:19:\"enable_email_cancel\";s:5:\"label\";s:50:\"Email to administrator when have an cancel booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:4:\"desc\";s:50:\"Email to administrator when have an cancel booking\";s:7:\"section\";s:12:\"option_email\";}i:312;a:6:{s:2:\"id\";s:27:\"enable_partner_email_cancel\";s:5:\"label\";s:44:\"Email to partner when have an cancel booking\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:4:\"desc\";s:44:\"Email to partner when have an cancel booking\";s:7:\"section\";s:12:\"option_email\";}i:313;a:6:{s:2:\"id\";s:27:\"enable_email_cancel_success\";s:5:\"label\";s:39:\"Email to user when booking is cancelled\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:4:\"desc\";s:39:\"Email to user when booking is cancelled\";s:7:\"section\";s:12:\"option_email\";}i:314;a:4:{s:2:\"id\";s:18:\"tab_email_document\";s:5:\"label\";s:15:\"Email Documents\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:315;a:4:{s:2:\"id\";s:14:\"email_document\";s:5:\"label\";s:15:\"Email Documents\";s:4:\"type\";s:23:\"email_template_document\";s:7:\"section\";s:21:\"option_email_template\";}i:316;a:4:{s:2:\"id\";s:23:\"tab_email_header_footer\";s:5:\"label\";s:19:\"Email Header/Footer\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:317;a:5:{s:2:\"id\";s:22:\"email_head_foot_on_off\";s:5:\"label\";s:44:\"User this header and footer for all template\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";s:3:\"off\";}i:318;a:7:{s:2:\"id\";s:12:\"email_header\";s:5:\"label\";s:21:\"Email header template\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:21:\"option_email_template\";s:9:\"condition\";s:29:\"email_head_foot_on_off:is(on)\";s:3:\"std\";b:0;}i:319;a:7:{s:2:\"id\";s:12:\"email_footer\";s:5:\"label\";s:21:\"Email footer template\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:21:\"option_email_template\";s:9:\"condition\";s:29:\"email_head_foot_on_off:is(on)\";s:3:\"std\";b:0;}i:320;a:4:{s:2:\"id\";s:19:\"tab_email_for_admin\";s:5:\"label\";s:15:\"Email For Admin\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:321;a:6:{s:2:\"id\";s:15:\"email_for_admin\";s:5:\"label\";s:36:\"Email template send to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"10\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:322;a:4:{s:2:\"id\";s:21:\"tab_email_for_partner\";s:5:\"label\";s:17:\"Email For Partner\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:323;a:6:{s:2:\"id\";s:17:\"email_for_partner\";s:5:\"label\";s:36:\"Email template send to partner/owner\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:324;a:6:{s:2:\"id\";s:30:\"email_for_partner_expired_date\";s:5:\"label\";s:59:\"Email template send to partner when package is expired date\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:325;a:4:{s:2:\"id\";s:22:\"tab_email_for_customer\";s:5:\"label\";s:18:\"Email For Customer\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:326;a:6:{s:2:\"id\";s:18:\"email_for_customer\";s:5:\"label\";s:48:\"Email template for booking info send to customer\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:327;a:6:{s:2:\"id\";s:39:\"email_for_customer_out_of_depature_date\";s:5:\"label\";s:66:\"Email template for notification of departure date send to customer\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:328;a:4:{s:2:\"id\";s:17:\"tab_email_confirm\";s:5:\"label\";s:13:\"Email Confirm\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:329;a:6:{s:2:\"id\";s:13:\"email_confirm\";s:5:\"label\";s:43:\"Email template for confirm send to customer\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:330;a:4:{s:2:\"id\";s:18:\"tab_email_approved\";s:5:\"label\";s:14:\"Email Approved\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:331;a:5:{s:2:\"id\";s:22:\"email_approved_subject\";s:5:\"label\";s:13:\"Email Subject\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";s:27:\"You have a item is approved\";}i:332;a:6:{s:2:\"id\";s:14:\"email_approved\";s:5:\"label\";s:48:\"Email template for approve send to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:333;a:4:{s:2:\"id\";s:24:\"tab_email_cancel_booking\";s:5:\"label\";s:20:\"Email Cancel Booking\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:21:\"option_email_template\";}i:334;a:6:{s:2:\"id\";s:16:\"email_has_refund\";s:5:\"label\";s:55:\"Email template for cancel booking send to administrator\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:335;a:6:{s:2:\"id\";s:28:\"email_has_refund_for_partner\";s:5:\"label\";s:49:\"Email template for cancel booking send to partner\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:2:\"50\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:336;a:6:{s:2:\"id\";s:40:\"email_cancel_booking_success_for_partner\";s:5:\"label\";s:54:\"Email template for successful canceled send to partner\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:3:\"100\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:337;a:6:{s:2:\"id\";s:28:\"email_cancel_booking_success\";s:5:\"label\";s:55:\"Email template for successful canceled send to customer\";s:4:\"type\";s:8:\"textarea\";s:4:\"rows\";s:3:\"100\";s:7:\"section\";s:21:\"option_email_template\";s:3:\"std\";b:0;}i:338;a:4:{s:2:\"id\";s:13:\"social_fb_tab\";s:5:\"label\";s:8:\"Facebook\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:13:\"option_social\";}i:339;a:5:{s:2:\"id\";s:15:\"social_fb_login\";s:5:\"label\";s:14:\"Facebook Login\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:13:\"option_social\";}i:340;a:5:{s:2:\"id\";s:16:\"social_fb_app_id\";s:5:\"label\";s:15:\"Facebook App ID\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:7:\"section\";s:13:\"option_social\";}i:341;a:4:{s:2:\"id\";s:17:\"social_google_tab\";s:5:\"label\";s:6:\"Google\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:13:\"option_social\";}i:342;a:5:{s:2:\"id\";s:15:\"social_gg_login\";s:5:\"label\";s:12:\"Google Login\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:13:\"option_social\";}i:343;a:5:{s:2:\"id\";s:19:\"social_gg_client_id\";s:5:\"label\";s:9:\"Client ID\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:7:\"section\";s:13:\"option_social\";}i:344;a:5:{s:2:\"id\";s:23:\"social_gg_client_secret\";s:5:\"label\";s:13:\"Client Secret\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:7:\"section\";s:13:\"option_social\";}i:345;a:6:{s:2:\"id\";s:29:\"social_gg_client_redirect_uri\";s:5:\"label\";s:15:\"Origin site URL\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:4:\"desc\";s:30:\"Example: http://yourdomain.com\";s:7:\"section\";s:13:\"option_social\";}i:346;a:4:{s:2:\"id\";s:13:\"social_tw_tab\";s:5:\"label\";s:7:\"Twitter\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:13:\"option_social\";}i:347;a:5:{s:2:\"id\";s:15:\"social_tw_login\";s:5:\"label\";s:13:\"Twitter Login\";s:4:\"type\";s:6:\"on-off\";s:3:\"std\";s:2:\"on\";s:7:\"section\";s:13:\"option_social\";}i:348;a:5:{s:2:\"id\";s:19:\"social_tw_client_id\";s:5:\"label\";s:9:\"Client ID\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:7:\"section\";s:13:\"option_social\";}i:349;a:5:{s:2:\"id\";s:23:\"social_tw_client_secret\";s:5:\"label\";s:13:\"Client Secret\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:7:\"section\";s:13:\"option_social\";}i:350;a:7:{s:2:\"id\";s:15:\"datetime_format\";s:5:\"label\";s:17:\"Input date format\";s:4:\"type\";s:11:\"custom-text\";s:3:\"std\";s:16:\"{mm}/{dd}/{yyyy}\";s:7:\"section\";s:14:\"option_advance\";s:4:\"desc\";s:514:\"The date format, combination of d, dd, mm, yy, yyyy. It is surrounded by <code>\'{}\'</code>. Ex: {dd}/{mm}/{yyyy}.\r\n                <ul>\r\n                <li><code>d, dd</code>: Numeric date, no leading zero and leading zero, respectively. Eg, 5, 05.</li>\r\n                <li><code>m, mm</code>: Numeric month, no leading zero and leading zero, respectively. Eg, 7, 07.</li>\r\n                <li><code>yy, yyyy:</code> 2- and 4-digit years, respectively. Eg, 12, 2012.</li>\r\n                </ul>\r\n                \";s:6:\"v_hint\";s:3:\"yes\";}i:351;a:6:{s:2:\"id\";s:11:\"time_format\";s:5:\"label\";s:18:\"Select time format\";s:4:\"type\";s:6:\"select\";s:3:\"std\";s:3:\"12h\";s:7:\"choices\";a:2:{i:0;a:2:{s:5:\"value\";s:3:\"12h\";s:5:\"label\";s:3:\"12h\";}i:1;a:2:{s:5:\"value\";s:3:\"24h\";s:5:\"label\";s:3:\"24h\";}}s:7:\"section\";s:14:\"option_advance\";}i:352;a:9:{s:2:\"id\";s:17:\"update_weather_by\";s:5:\"label\";s:26:\"Weather auto update after:\";s:4:\"type\";s:6:\"number\";s:3:\"min\";i:1;s:3:\"max\";i:12;s:4:\"step\";i:1;s:3:\"std\";i:12;s:7:\"section\";s:14:\"option_advance\";s:4:\"desc\";s:28:\"Weather updates (Unit: hour)\";}i:353;a:6:{s:2:\"id\";s:15:\"show_price_free\";s:5:\"label\";s:30:\"Show info when service is free\";s:4:\"type\";s:6:\"on-off\";s:4:\"desc\";s:45:\"Price is not shown when accommodation is free\";s:7:\"section\";s:14:\"option_advance\";s:3:\"std\";s:3:\"off\";}i:354;a:5:{s:2:\"id\";s:23:\"adv_before_body_content\";s:5:\"label\";s:19:\"Before Body Content\";s:4:\"desc\";s:31:\"Input content after <body> tag.\";s:4:\"type\";s:15:\"textarea-simple\";s:7:\"section\";s:14:\"option_advance\";}i:355;a:6:{s:2:\"id\";s:20:\"edv_enable_demo_mode\";s:5:\"label\";s:14:\"Show demo mode\";s:4:\"desc\";s:15:\"Do some magical\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:14:\"option_advance\";s:3:\"std\";s:3:\"off\";}i:356;a:5:{s:2:\"id\";s:19:\"mailchimp_shortcode\";s:5:\"label\";s:24:\"MailChimp Shortcode Form\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:14:\"option_advance\";s:3:\"std\";s:0:\"\";}i:357;a:4:{s:2:\"id\";s:20:\"tab_general_document\";s:5:\"label\";s:18:\" General Configure\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:358;a:6:{s:2:\"id\";s:15:\"booking_room_by\";s:5:\"label\";s:41:\"Booking immediately in search result page\";s:4:\"desc\";s:67:\"Booking immediately in search result page without go to single page\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:2:\"on\";}i:359;a:4:{s:2:\"id\";s:20:\"travelpayouts_option\";s:5:\"label\";s:13:\"TravelPayouts\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:360;a:5:{s:2:\"id\";s:9:\"tp_marker\";s:5:\"label\";s:11:\"Your Marker\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:17:\"Enter your marker\";s:7:\"section\";s:17:\"option_api_update\";}i:361;a:7:{s:2:\"id\";s:17:\"tp_locale_default\";s:5:\"label\";s:16:\"Default Language\";s:4:\"type\";s:6:\"select\";s:8:\"operator\";s:3:\"and\";s:7:\"choices\";a:26:{i:0;a:2:{s:5:\"value\";s:2:\"ez\";s:5:\"label\";s:10:\"Azerbaijan\";}i:1;a:2:{s:5:\"value\";s:2:\"ms\";s:5:\"label\";s:13:\"Bahasa Melayu\";}i:2;a:2:{s:5:\"value\";s:2:\"br\";s:5:\"label\";s:9:\"Brazilian\";}i:3;a:2:{s:5:\"value\";s:2:\"bg\";s:5:\"label\";s:9:\"Bulgarian\";}i:4;a:2:{s:5:\"value\";s:2:\"zh\";s:5:\"label\";s:7:\"Chinese\";}i:5;a:2:{s:5:\"value\";s:2:\"da\";s:5:\"label\";s:6:\"Danish\";}i:6;a:2:{s:5:\"value\";s:2:\"de\";s:5:\"label\";s:12:\"Deutsch (DE)\";}i:7;a:2:{s:5:\"value\";s:2:\"en\";s:5:\"label\";s:7:\"English\";}i:8;a:2:{s:5:\"value\";s:5:\"en-AU\";s:5:\"label\";s:12:\"English (AU)\";}i:9;a:2:{s:5:\"value\";s:5:\"en-GB\";s:5:\"label\";s:12:\"English (GB)\";}i:10;a:2:{s:5:\"value\";s:2:\"fr\";s:5:\"label\";s:6:\"French\";}i:11;a:2:{s:5:\"value\";s:2:\"ka\";s:5:\"label\";s:8:\"Georgian\";}i:12;a:2:{s:5:\"value\";s:2:\"el\";s:5:\"label\";s:20:\"Greek (Modern Greek)\";}i:13;a:2:{s:5:\"value\";s:2:\"it\";s:5:\"label\";s:7:\"Italian\";}i:14;a:2:{s:5:\"value\";s:2:\"ja\";s:5:\"label\";s:8:\"Japanese\";}i:15;a:2:{s:5:\"value\";s:2:\"lv\";s:5:\"label\";s:7:\"Latvian\";}i:16;a:2:{s:5:\"value\";s:2:\"pl\";s:5:\"label\";s:6:\"Polish\";}i:17;a:2:{s:5:\"value\";s:2:\"pt\";s:5:\"label\";s:10:\"Portuguese\";}i:18;a:2:{s:5:\"value\";s:2:\"ro\";s:5:\"label\";s:8:\"Romanian\";}i:19;a:2:{s:5:\"value\";s:2:\"ru\";s:5:\"label\";s:7:\"Russian\";}i:20;a:2:{s:5:\"value\";s:2:\"sr\";s:5:\"label\";s:7:\"Serbian\";}i:21;a:2:{s:5:\"value\";s:2:\"es\";s:5:\"label\";s:7:\"Spanish\";}i:22;a:2:{s:5:\"value\";s:2:\"th\";s:5:\"label\";s:4:\"Thai\";}i:23;a:2:{s:5:\"value\";s:2:\"tr\";s:5:\"label\";s:7:\"Turkish\";}i:24;a:2:{s:5:\"value\";s:2:\"uk\";s:5:\"label\";s:9:\"Ukrainian\";}i:25;a:2:{s:5:\"value\";s:2:\"vi\";s:5:\"label\";s:10:\"Vietnamese\";}}s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:2:\"en\";}i:362;a:6:{s:2:\"id\";s:19:\"tp_currency_default\";s:5:\"label\";s:16:\"Default Currency\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:48:{i:0;a:2:{s:5:\"value\";s:3:\"amd\";s:5:\"label\";s:16:\"UAE dirham (AED)\";}i:1;a:2:{s:5:\"value\";s:3:\"amd\";s:5:\"label\";s:19:\"Armenian Dram (AMD)\";}i:2;a:2:{s:5:\"value\";s:3:\"ars\";s:5:\"label\";s:20:\"Argentine peso (ARS)\";}i:3;a:2:{s:5:\"value\";s:3:\"aud\";s:5:\"label\";s:23:\"Australian Dollar (AUD)\";}i:4;a:2:{s:5:\"value\";s:3:\"azn\";s:5:\"label\";s:23:\"Azerbaijani Manat (AZN)\";}i:5;a:2:{s:5:\"value\";s:3:\"bdt\";s:5:\"label\";s:22:\"Bangladeshi taka (BDT)\";}i:6;a:2:{s:5:\"value\";s:3:\"bgn\";s:5:\"label\";s:19:\"Bulgarian lev (BGN)\";}i:7;a:2:{s:5:\"value\";s:3:\"brl\";s:5:\"label\";s:20:\"Brazilian real (BRL)\";}i:8;a:2:{s:5:\"value\";s:3:\"byr\";s:5:\"label\";s:22:\"Belarusian ruble (BYR)\";}i:9;a:2:{s:5:\"value\";s:3:\"chf\";s:5:\"label\";s:17:\"Swiss Franc (CHF)\";}i:10;a:2:{s:5:\"value\";s:3:\"clp\";s:5:\"label\";s:18:\"Chilean peso (CLP)\";}i:11;a:2:{s:5:\"value\";s:3:\"cny\";s:5:\"label\";s:18:\"Chinese Yuan (CNY)\";}i:12;a:2:{s:5:\"value\";s:3:\"cop\";s:5:\"label\";s:20:\"Colombian peso (COP)\";}i:13;a:2:{s:5:\"value\";s:3:\"dkk\";s:5:\"label\";s:18:\"Danish krone (DKK)\";}i:14;a:2:{s:5:\"value\";s:3:\"egp\";s:5:\"label\";s:20:\"Egyptian Pound (EGP)\";}i:15;a:2:{s:5:\"value\";s:3:\"eur\";s:5:\"label\";s:10:\"Euro (EUR)\";}i:16;a:2:{s:5:\"value\";s:3:\"gpb\";s:5:\"label\";s:28:\"British Pound Sterling (GPB)\";}i:17;a:2:{s:5:\"value\";s:3:\"gel\";s:5:\"label\";s:19:\"Georgian lari (GEL)\";}i:18;a:2:{s:5:\"value\";s:3:\"hkd\";s:5:\"label\";s:22:\"Hong Kong Dollar (HKD)\";}i:19;a:2:{s:5:\"value\";s:3:\"huf\";s:5:\"label\";s:22:\"Hungarian forint (HUF)\";}i:20;a:2:{s:5:\"value\";s:3:\"idr\";s:5:\"label\";s:23:\"Indonesian Rupiah (IDR)\";}i:21;a:2:{s:5:\"value\";s:3:\"inr\";s:5:\"label\";s:18:\"Indian Rupee (INR)\";}i:22;a:2:{s:5:\"value\";s:3:\"jpy\";s:5:\"label\";s:18:\"Japanese Yen (JPY)\";}i:23;a:2:{s:5:\"value\";s:3:\"kgs\";s:5:\"label\";s:9:\"Som (KGS)\";}i:24;a:2:{s:5:\"value\";s:3:\"krw\";s:5:\"label\";s:22:\"South Korean won (KRW)\";}i:25;a:2:{s:5:\"value\";s:3:\"mxn\";s:5:\"label\";s:18:\"Mexican peso (MXN)\";}i:26;a:2:{s:5:\"value\";s:3:\"myr\";s:5:\"label\";s:23:\"Malaysian ringgit (MYR)\";}i:27;a:2:{s:5:\"value\";s:3:\"nok\";s:5:\"label\";s:21:\"Norwegian Krone (NOK)\";}i:28;a:2:{s:5:\"value\";s:3:\"kzt\";s:5:\"label\";s:23:\"Kazakhstani Tenge (KZT)\";}i:29;a:2:{s:5:\"value\";s:3:\"ltl\";s:5:\"label\";s:17:\"Latvian Lat (LTL)\";}i:30;a:2:{s:5:\"value\";s:3:\"nzd\";s:5:\"label\";s:24:\"New Zealand Dollar (NZD)\";}i:31;a:2:{s:5:\"value\";s:3:\"pen\";s:5:\"label\";s:18:\"Peruvian sol (PEN)\";}i:32;a:2:{s:5:\"value\";s:3:\"php\";s:5:\"label\";s:21:\"Philippine Peso (PHP)\";}i:33;a:2:{s:5:\"value\";s:3:\"pkr\";s:5:\"label\";s:20:\"Pakistan Rupee (PKR)\";}i:34;a:2:{s:5:\"value\";s:3:\"pln\";s:5:\"label\";s:18:\"Polish zloty (PLN)\";}i:35;a:2:{s:5:\"value\";s:3:\"ron\";s:5:\"label\";s:18:\"Romanian leu (RON)\";}i:36;a:2:{s:5:\"value\";s:3:\"rsd\";s:5:\"label\";s:19:\"Serbian dinar (RSD)\";}i:37;a:2:{s:5:\"value\";s:3:\"rub\";s:5:\"label\";s:19:\"Russian Ruble (RUB)\";}i:38;a:2:{s:5:\"value\";s:3:\"sar\";s:5:\"label\";s:17:\"Saudi riyal (SAR)\";}i:39;a:2:{s:5:\"value\";s:3:\"sek\";s:5:\"label\";s:19:\"Swedish krona (SEK)\";}i:40;a:2:{s:5:\"value\";s:3:\"sgd\";s:5:\"label\";s:22:\"Singapore Dollar (SGD)\";}i:41;a:2:{s:5:\"value\";s:3:\"thb\";s:5:\"label\";s:15:\"Thai Baht (THB)\";}i:42;a:2:{s:5:\"value\";s:3:\"try\";s:5:\"label\";s:18:\"Turkish lira (TRY)\";}i:43;a:2:{s:5:\"value\";s:3:\"uah\";s:5:\"label\";s:23:\"Ukrainian Hryvnia (UAH)\";}i:44;a:2:{s:5:\"value\";s:3:\"usd\";s:5:\"label\";s:15:\"US Dollar (USD)\";}i:45;a:2:{s:5:\"value\";s:3:\"vnd\";s:5:\"label\";s:21:\"Vietnamese dong (VND)\";}i:46;a:2:{s:5:\"value\";s:3:\"xof\";s:5:\"label\";s:15:\"CFA Franc (XOF)\";}i:47;a:2:{s:5:\"value\";s:3:\"zar\";s:5:\"label\";s:24:\"South African Rand (ZAR)\";}}s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:3:\"usd\";}i:363;a:5:{s:2:\"id\";s:18:\"tp_redirect_option\";s:5:\"label\";s:14:\"Use Whitelabel\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:3:\"off\";}i:364;a:5:{s:2:\"id\";s:13:\"tp_whitelabel\";s:5:\"label\";s:15:\"Whitelabel Name\";s:4:\"type\";s:4:\"text\";s:7:\"section\";s:17:\"option_api_update\";s:9:\"condition\";s:25:\"tp_redirect_option:is(on)\";}i:365;a:7:{s:2:\"id\";s:18:\"tp_whitelabel_page\";s:5:\"label\";s:22:\"Whitelabel Page Search\";s:4:\"type\";s:16:\"post-select-ajax\";s:9:\"post_type\";s:13:\"travel_payout\";s:6:\"sparam\";s:15:\"posttype_select\";s:7:\"section\";s:17:\"option_api_update\";s:9:\"condition\";s:25:\"tp_redirect_option:is(on)\";}i:366;a:5:{s:2:\"id\";s:16:\"tp_show_api_info\";s:5:\"label\";s:13:\"Show API Info\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:2:\"on\";}i:367;a:4:{s:2:\"id\";s:17:\"skyscanner_option\";s:5:\"label\";s:10:\"Skyscanner\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:368;a:5:{s:2:\"id\";s:10:\"ss_api_key\";s:5:\"label\";s:7:\"Api Key\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:15:\"Enter a api key\";s:7:\"section\";s:17:\"option_api_update\";}i:369;a:7:{s:2:\"id\";s:9:\"ss_locale\";s:5:\"label\";s:6:\"Locale\";s:4:\"desc\";s:61:\"The locales that Skyscanner support to translate your content\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:5:\"en-US\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:43:{i:0;a:2:{s:5:\"value\";s:5:\"fi-FI\";s:5:\"label\";s:13:\"suomi (Suomi)\";}i:1;a:2:{s:5:\"value\";s:5:\"nb-NO\";s:5:\"label\";s:22:\"norsk, bokmål (Norge)\";}i:2;a:2:{s:5:\"value\";s:5:\"uk-UA\";s:5:\"label\";s:37:\"українська (Україна)\";}i:3;a:2:{s:5:\"value\";s:5:\"az-AZ\";s:5:\"label\";s:32:\"Azərbaycan­ılı (Azərbaycan)\";}i:4;a:2:{s:5:\"value\";s:5:\"en-US\";s:5:\"label\";s:23:\"English (United States)\";}i:5;a:2:{s:5:\"value\";s:5:\"hr-HR\";s:5:\"label\";s:19:\"hrvatski (Hrvatska)\";}i:6;a:2:{s:5:\"value\";s:5:\"en-GG\";s:5:\"label\";s:24:\"English (United Kingdom)\";}i:7;a:2:{s:5:\"value\";s:5:\"lv-LV\";s:5:\"label\";s:19:\"latviešu (Latvija)\";}i:8;a:2:{s:5:\"value\";s:5:\"ms-MY\";s:5:\"label\";s:24:\"Bahasa Melayu (Malaysia)\";}i:9;a:2:{s:5:\"value\";s:5:\"lt-LT\";s:5:\"label\";s:19:\"lietuvių (Lietuva)\";}i:10;a:2:{s:5:\"value\";s:5:\"ar-AE\";s:5:\"label\";s:17:\"العربية‏\";}i:11;a:2:{s:5:\"value\";s:5:\"zh-CN\";s:5:\"label\";s:12:\"简体中文\";}i:12;a:2:{s:5:\"value\";s:5:\"el-GR\";s:5:\"label\";s:31:\"Ελληνικά (Ελλάδα)\";}i:13;a:2:{s:5:\"value\";s:5:\"nl-NL\";s:5:\"label\";s:22:\"Nederlands (Nederland)\";}i:14;a:2:{s:5:\"value\";s:5:\"bg-BG\";s:5:\"label\";s:37:\"български (България)\";}i:15;a:2:{s:5:\"value\";s:5:\"cs-CZ\";s:5:\"label\";s:30:\"čeština (Česká republika)\";}i:16;a:2:{s:5:\"value\";s:5:\"ja-JP\";s:5:\"label\";s:18:\"日本語 (日本)\";}i:17;a:2:{s:5:\"value\";s:5:\"ca-ES\";s:5:\"label\";s:17:\"Català (Català)\";}i:18;a:2:{s:5:\"value\";s:5:\"de-DE\";s:5:\"label\";s:21:\"Deutsch (Deutschland)\";}i:19;a:2:{s:5:\"value\";s:5:\"hu-HU\";s:5:\"label\";s:22:\"magyar (Magyarország)\";}i:20;a:2:{s:5:\"value\";s:5:\"zh-HK\";s:5:\"label\";s:12:\"繁體中文\";}i:21;a:2:{s:5:\"value\";s:5:\"zh-TW\";s:5:\"label\";s:12:\"繁體中文\";}i:22;a:2:{s:5:\"value\";s:5:\"ko-KR\";s:5:\"label\";s:24:\"한국어 (대한민국)\";}i:23;a:2:{s:5:\"value\";s:5:\"pt-BR\";s:5:\"label\";s:19:\"Português (Brasil)\";}i:24;a:2:{s:5:\"value\";s:5:\"sk-SK\";s:5:\"label\";s:34:\"slovenčina (Slovenská republika)\";}i:25;a:2:{s:5:\"value\";s:5:\"es-ES\";s:5:\"label\";s:18:\"Español (España)\";}i:26;a:2:{s:5:\"value\";s:5:\"es-MX\";s:5:\"label\";s:18:\"Español (México)\";}i:27;a:2:{s:5:\"value\";s:5:\"it-IT\";s:5:\"label\";s:17:\"italiano (Italia)\";}i:28;a:2:{s:5:\"value\";s:5:\"pl-PL\";s:5:\"label\";s:15:\"polski (Polska)\";}i:29;a:2:{s:5:\"value\";s:5:\"ru-RU\";s:5:\"label\";s:29:\"русский (Россия)\";}i:30;a:2:{s:5:\"value\";s:5:\"pt-PT\";s:5:\"label\";s:21:\"português (Portugal)\";}i:31;a:2:{s:5:\"value\";s:5:\"ro-RO\";s:5:\"label\";s:19:\"română (România)\";}i:32;a:2:{s:5:\"value\";s:5:\"zh-SG\";s:5:\"label\";s:17:\"中文(新加坡)\";}i:33;a:2:{s:5:\"value\";s:5:\"sv-SE\";s:5:\"label\";s:17:\"svenska (Sverige)\";}i:34;a:2:{s:5:\"value\";s:5:\"id-ID\";s:5:\"label\";s:28:\"Bahasa Indonesia (Indonesia)\";}i:35;a:2:{s:5:\"value\";s:5:\"tl-PH\";s:5:\"label\";s:20:\"Filipino (Pilipinas)\";}i:36;a:2:{s:5:\"value\";s:5:\"da-DK\";s:5:\"label\";s:15:\"dansk (Danmark)\";}i:37;a:2:{s:5:\"value\";s:5:\"et-EE\";s:5:\"label\";s:13:\"eesti (Eesti)\";}i:38;a:2:{s:5:\"value\";s:5:\"tr-TR\";s:5:\"label\";s:19:\"Türkçe (Türkiye)\";}i:39;a:2:{s:5:\"value\";s:5:\"fr-FR\";s:5:\"label\";s:18:\"français (France)\";}i:40;a:2:{s:5:\"value\";s:5:\"vi-VN\";s:5:\"label\";s:27:\"Tiếng Việt (Việt Nam)\";}i:41;a:2:{s:5:\"value\";s:5:\"en-GB\";s:5:\"label\";s:24:\"English (United Kingdom)\";}i:42;a:2:{s:5:\"value\";s:5:\"th-TH\";s:5:\"label\";s:21:\"ไทย (ไทย)\";}}}i:370;a:7:{s:2:\"id\";s:11:\"ss_currency\";s:5:\"label\";s:8:\"Currency\";s:4:\"desc\";s:38:\"The currencies that Skyscanner support\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:3:\"USD\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:152:{i:0;a:2:{s:5:\"value\";s:3:\"AED\";s:5:\"label\";s:9:\"AED (AED)\";}i:1;a:2:{s:5:\"value\";s:3:\"AFN\";s:5:\"label\";s:9:\"AFN (AFN)\";}i:2;a:2:{s:5:\"value\";s:3:\"ALL\";s:5:\"label\";s:9:\"ALL (Lek)\";}i:3;a:2:{s:5:\"value\";s:3:\"AMD\";s:5:\"label\";s:11:\"AMD (դր.)\";}i:4;a:2:{s:5:\"value\";s:3:\"ANG\";s:5:\"label\";s:10:\"ANG (NAf.)\";}i:5;a:2:{s:5:\"value\";s:3:\"AOA\";s:5:\"label\";s:8:\"AOA (Kz)\";}i:6;a:2:{s:5:\"value\";s:3:\"ARS\";s:5:\"label\";s:7:\"ARS ($)\";}i:7;a:2:{s:5:\"value\";s:3:\"AUD\";s:5:\"label\";s:7:\"AUD ($)\";}i:8;a:2:{s:5:\"value\";s:3:\"AWG\";s:5:\"label\";s:10:\"AWG (Afl.)\";}i:9;a:2:{s:5:\"value\";s:3:\"AZN\";s:5:\"label\";s:9:\"AZN (₼)\";}i:10;a:2:{s:5:\"value\";s:3:\"BAM\";s:5:\"label\";s:10:\"BAM (КМ)\";}i:11;a:2:{s:5:\"value\";s:3:\"BBD\";s:5:\"label\";s:7:\"BBD ($)\";}i:12;a:2:{s:5:\"value\";s:3:\"BDT\";s:5:\"label\";s:9:\"BDT (BDT)\";}i:13;a:2:{s:5:\"value\";s:3:\"BGN\";s:5:\"label\";s:11:\"BGN (лв.)\";}i:14;a:2:{s:5:\"value\";s:3:\"BHD\";s:5:\"label\";s:15:\"BHD (د.ب.‏)\";}i:15;a:2:{s:5:\"value\";s:3:\"BIF\";s:5:\"label\";s:9:\"BIF (FBu)\";}i:16;a:2:{s:5:\"value\";s:3:\"BMD\";s:5:\"label\";s:7:\"BMD ($)\";}i:17;a:2:{s:5:\"value\";s:3:\"BND\";s:5:\"label\";s:7:\"BND ($)\";}i:18;a:2:{s:5:\"value\";s:3:\"BOB\";s:5:\"label\";s:8:\"BOB (Bs)\";}i:19;a:2:{s:5:\"value\";s:3:\"BRL\";s:5:\"label\";s:8:\"BRL (R$)\";}i:20;a:2:{s:5:\"value\";s:3:\"BSD\";s:5:\"label\";s:7:\"BSD ($)\";}i:21;a:2:{s:5:\"value\";s:3:\"BTN\";s:5:\"label\";s:9:\"BTN (Nu.)\";}i:22;a:2:{s:5:\"value\";s:3:\"BWP\";s:5:\"label\";s:7:\"BWP (P)\";}i:23;a:2:{s:5:\"value\";s:3:\"BYN\";s:5:\"label\";s:8:\"BYN (Br)\";}i:24;a:2:{s:5:\"value\";s:3:\"BZD\";s:5:\"label\";s:9:\"BZD (BZ$)\";}i:25;a:2:{s:5:\"value\";s:3:\"CAD\";s:5:\"label\";s:8:\"CAD (C$)\";}i:26;a:2:{s:5:\"value\";s:3:\"CDF\";s:5:\"label\";s:8:\"CDF (FC)\";}i:27;a:2:{s:5:\"value\";s:3:\"CHF\";s:5:\"label\";s:9:\"CHF (CHF)\";}i:28;a:2:{s:5:\"value\";s:3:\"CLP\";s:5:\"label\";s:7:\"CLP ($)\";}i:29;a:2:{s:5:\"value\";s:3:\"CNY\";s:5:\"label\";s:8:\"CNY (¥)\";}i:30;a:2:{s:5:\"value\";s:3:\"COP\";s:5:\"label\";s:7:\"COP ($)\";}i:31;a:2:{s:5:\"value\";s:3:\"CRC\";s:5:\"label\";s:9:\"CRC (₡)\";}i:32;a:2:{s:5:\"value\";s:3:\"CUC\";s:5:\"label\";s:9:\"CUC (CUC)\";}i:33;a:2:{s:5:\"value\";s:3:\"CUP\";s:5:\"label\";s:9:\"CUP ($MN)\";}i:34;a:2:{s:5:\"value\";s:3:\"CVE\";s:5:\"label\";s:7:\"CVE ($)\";}i:35;a:2:{s:5:\"value\";s:3:\"CZK\";s:5:\"label\";s:9:\"CZK (Kč)\";}i:36;a:2:{s:5:\"value\";s:3:\"DJF\";s:5:\"label\";s:9:\"DJF (Fdj)\";}i:37;a:2:{s:5:\"value\";s:3:\"DKK\";s:5:\"label\";s:9:\"DKK (kr.)\";}i:38;a:2:{s:5:\"value\";s:3:\"DOP\";s:5:\"label\";s:9:\"DOP (RD$)\";}i:39;a:2:{s:5:\"value\";s:3:\"DZD\";s:5:\"label\";s:15:\"DZD (د.ج.‏)\";}i:40;a:2:{s:5:\"value\";s:3:\"EGP\";s:5:\"label\";s:15:\"EGP (ج.م.‏)\";}i:41;a:2:{s:5:\"value\";s:3:\"ERN\";s:5:\"label\";s:9:\"ERN (Nfk)\";}i:42;a:2:{s:5:\"value\";s:3:\"ETB\";s:5:\"label\";s:8:\"ETB (Br)\";}i:43;a:2:{s:5:\"value\";s:3:\"EUR\";s:5:\"label\";s:9:\"EUR (€)\";}i:44;a:2:{s:5:\"value\";s:3:\"FJD\";s:5:\"label\";s:7:\"FJD ($)\";}i:45;a:2:{s:5:\"value\";s:3:\"GBP\";s:5:\"label\";s:8:\"GBP (£)\";}i:46;a:2:{s:5:\"value\";s:3:\"GEL\";s:5:\"label\";s:9:\"GEL (₾)\";}i:47;a:2:{s:5:\"value\";s:3:\"GHS\";s:5:\"label\";s:10:\"GHS (GH¢)\";}i:48;a:2:{s:5:\"value\";s:3:\"GIP\";s:5:\"label\";s:8:\"GIP (£)\";}i:49;a:2:{s:5:\"value\";s:3:\"GMD\";s:5:\"label\";s:7:\"GMD (D)\";}i:50;a:2:{s:5:\"value\";s:3:\"GNF\";s:5:\"label\";s:8:\"GNF (FG)\";}i:51;a:2:{s:5:\"value\";s:3:\"GTQ\";s:5:\"label\";s:7:\"GTQ (Q)\";}i:52;a:2:{s:5:\"value\";s:3:\"GYD\";s:5:\"label\";s:7:\"GYD ($)\";}i:53;a:2:{s:5:\"value\";s:3:\"HKD\";s:5:\"label\";s:9:\"HKD (HK$)\";}i:54;a:2:{s:5:\"value\";s:3:\"HNL\";s:5:\"label\";s:8:\"HNL (L.)\";}i:55;a:2:{s:5:\"value\";s:3:\"HRK\";s:5:\"label\";s:8:\"HRK (kn)\";}i:56;a:2:{s:5:\"value\";s:3:\"HTG\";s:5:\"label\";s:7:\"HTG (G)\";}i:57;a:2:{s:5:\"value\";s:3:\"HUF\";s:5:\"label\";s:8:\"HUF (Ft)\";}i:58;a:2:{s:5:\"value\";s:3:\"IDR\";s:5:\"label\";s:8:\"IDR (Rp)\";}i:59;a:2:{s:5:\"value\";s:3:\"ILS\";s:5:\"label\";s:9:\"ILS (₪)\";}i:60;a:2:{s:5:\"value\";s:3:\"INR\";s:5:\"label\";s:9:\"INR (₹)\";}i:61;a:2:{s:5:\"value\";s:3:\"IQD\";s:5:\"label\";s:15:\"IQD (د.ع.‏)\";}i:62;a:2:{s:5:\"value\";s:3:\"IRR\";s:5:\"label\";s:14:\"IRR (ريال)\";}i:63;a:2:{s:5:\"value\";s:3:\"ISK\";s:5:\"label\";s:9:\"ISK (kr.)\";}i:64;a:2:{s:5:\"value\";s:3:\"JMD\";s:5:\"label\";s:8:\"JMD (J$)\";}i:65;a:2:{s:5:\"value\";s:3:\"JOD\";s:5:\"label\";s:15:\"JOD (د.ا.‏)\";}i:66;a:2:{s:5:\"value\";s:3:\"JPY\";s:5:\"label\";s:8:\"JPY (¥)\";}i:67;a:2:{s:5:\"value\";s:3:\"KES\";s:5:\"label\";s:7:\"KES (S)\";}i:68;a:2:{s:5:\"value\";s:3:\"KGS\";s:5:\"label\";s:12:\"KGS (сом)\";}i:69;a:2:{s:5:\"value\";s:3:\"KHR\";s:5:\"label\";s:9:\"KHR (KHR)\";}i:70;a:2:{s:5:\"value\";s:3:\"KMF\";s:5:\"label\";s:8:\"KMF (CF)\";}i:71;a:2:{s:5:\"value\";s:3:\"KPW\";s:5:\"label\";s:9:\"KPW (₩)\";}i:72;a:2:{s:5:\"value\";s:3:\"KRW\";s:5:\"label\";s:9:\"KRW (₩)\";}i:73;a:2:{s:5:\"value\";s:3:\"KWD\";s:5:\"label\";s:15:\"KWD (د.ك.‏)\";}i:74;a:2:{s:5:\"value\";s:3:\"KYD\";s:5:\"label\";s:7:\"KYD ($)\";}i:75;a:2:{s:5:\"value\";s:3:\"KZT\";s:5:\"label\";s:8:\"KZT (Т)\";}i:76;a:2:{s:5:\"value\";s:3:\"LAK\";s:5:\"label\";s:9:\"LAK (₭)\";}i:77;a:2:{s:5:\"value\";s:3:\"LBP\";s:5:\"label\";s:15:\"LBP (ل.ل.‏)\";}i:78;a:2:{s:5:\"value\";s:3:\"LKR\";s:5:\"label\";s:8:\"LKR (Rp)\";}i:79;a:2:{s:5:\"value\";s:3:\"LRD\";s:5:\"label\";s:7:\"LRD ($)\";}i:80;a:2:{s:5:\"value\";s:3:\"LSL\";s:5:\"label\";s:7:\"LSL (M)\";}i:81;a:2:{s:5:\"value\";s:3:\"LYD\";s:5:\"label\";s:15:\"LYD (د.ل.‏)\";}i:82;a:2:{s:5:\"value\";s:3:\"MAD\";s:5:\"label\";s:15:\"MAD (د.م.‏)\";}i:83;a:2:{s:5:\"value\";s:3:\"MDL\";s:5:\"label\";s:9:\"MDL (lei)\";}i:84;a:2:{s:5:\"value\";s:3:\"MGA\";s:5:\"label\";s:8:\"MGA (Ar)\";}i:85;a:2:{s:5:\"value\";s:3:\"MKD\";s:5:\"label\";s:13:\"MKD (ден.)\";}i:86;a:2:{s:5:\"value\";s:3:\"MMK\";s:5:\"label\";s:7:\"MMK (K)\";}i:87;a:2:{s:5:\"value\";s:3:\"MNT\";s:5:\"label\";s:9:\"MNT (₮)\";}i:88;a:2:{s:5:\"value\";s:3:\"MOP\";s:5:\"label\";s:10:\"MOP (MOP$)\";}i:89;a:2:{s:5:\"value\";s:3:\"MRO\";s:5:\"label\";s:8:\"MRO (UM)\";}i:90;a:2:{s:5:\"value\";s:3:\"MUR\";s:5:\"label\";s:8:\"MUR (Rs)\";}i:91;a:2:{s:5:\"value\";s:3:\"MVR\";s:5:\"label\";s:9:\"MVR (MVR)\";}i:92;a:2:{s:5:\"value\";s:3:\"MWK\";s:5:\"label\";s:8:\"MWK (MK)\";}i:93;a:2:{s:5:\"value\";s:3:\"MXN\";s:5:\"label\";s:7:\"MXN ($)\";}i:94;a:2:{s:5:\"value\";s:3:\"MYR\";s:5:\"label\";s:8:\"MYR (RM)\";}i:95;a:2:{s:5:\"value\";s:3:\"MZN\";s:5:\"label\";s:8:\"MZN (MT)\";}i:96;a:2:{s:5:\"value\";s:3:\"NAD\";s:5:\"label\";s:7:\"NAD ($)\";}i:97;a:2:{s:5:\"value\";s:3:\"NGN\";s:5:\"label\";s:9:\"NGN (₦)\";}i:98;a:2:{s:5:\"value\";s:3:\"NIO\";s:5:\"label\";s:8:\"NIO (C$)\";}i:99;a:2:{s:5:\"value\";s:3:\"NOK\";s:5:\"label\";s:8:\"NOK (kr)\";}i:100;a:2:{s:5:\"value\";s:3:\"NPR\";s:5:\"label\";s:12:\"NPR (रु)\";}i:101;a:2:{s:5:\"value\";s:3:\"NZD\";s:5:\"label\";s:7:\"NZD ($)\";}i:102;a:2:{s:5:\"value\";s:3:\"OMR\";s:5:\"label\";s:15:\"OMR (ر.ع.‏)\";}i:103;a:2:{s:5:\"value\";s:3:\"PAB\";s:5:\"label\";s:9:\"PAB (B/.)\";}i:104;a:2:{s:5:\"value\";s:3:\"PEN\";s:5:\"label\";s:9:\"PEN (S/.)\";}i:105;a:2:{s:5:\"value\";s:3:\"PGK\";s:5:\"label\";s:7:\"PGK (K)\";}i:106;a:2:{s:5:\"value\";s:3:\"PHP\";s:5:\"label\";s:7:\"PHP (P)\";}i:107;a:2:{s:5:\"value\";s:3:\"PKR\";s:5:\"label\";s:8:\"PKR (Rs)\";}i:108;a:2:{s:5:\"value\";s:3:\"PLN\";s:5:\"label\";s:9:\"PLN (zł)\";}i:109;a:2:{s:5:\"value\";s:3:\"PYG\";s:5:\"label\";s:8:\"PYG (Gs)\";}i:110;a:2:{s:5:\"value\";s:3:\"QAR\";s:5:\"label\";s:15:\"QAR (ر.ق.‏)\";}i:111;a:2:{s:5:\"value\";s:3:\"RON\";s:5:\"label\";s:9:\"RON (lei)\";}i:112;a:2:{s:5:\"value\";s:3:\"RSD\";s:5:\"label\";s:13:\"RSD (Дин.)\";}i:113;a:2:{s:5:\"value\";s:3:\"RUB\";s:5:\"label\";s:9:\"RUB (₽)\";}i:114;a:2:{s:5:\"value\";s:3:\"RWF\";s:5:\"label\";s:9:\"RWF (RWF)\";}i:115;a:2:{s:5:\"value\";s:3:\"SAR\";s:5:\"label\";s:9:\"SAR (SAR)\";}i:116;a:2:{s:5:\"value\";s:3:\"SBD\";s:5:\"label\";s:7:\"SBD ($)\";}i:117;a:2:{s:5:\"value\";s:3:\"SCR\";s:5:\"label\";s:8:\"SCR (Rs)\";}i:118;a:2:{s:5:\"value\";s:3:\"SDG\";s:5:\"label\";s:15:\"SDG (ج.س.‏)\";}i:119;a:2:{s:5:\"value\";s:3:\"SEK\";s:5:\"label\";s:9:\"SEK (SEK)\";}i:120;a:2:{s:5:\"value\";s:3:\"SGD\";s:5:\"label\";s:7:\"SGD ($)\";}i:121;a:2:{s:5:\"value\";s:3:\"SHP\";s:5:\"label\";s:8:\"SHP (£)\";}i:122;a:2:{s:5:\"value\";s:3:\"SLL\";s:5:\"label\";s:8:\"SLL (Le)\";}i:123;a:2:{s:5:\"value\";s:3:\"SOS\";s:5:\"label\";s:7:\"SOS (S)\";}i:124;a:2:{s:5:\"value\";s:3:\"SRD\";s:5:\"label\";s:7:\"SRD ($)\";}i:125;a:2:{s:5:\"value\";s:3:\"STD\";s:5:\"label\";s:8:\"STD (Db)\";}i:126;a:2:{s:5:\"value\";s:3:\"SYP\";s:5:\"label\";s:15:\"SYP (ل.س.‏)\";}i:127;a:2:{s:5:\"value\";s:3:\"SZL\";s:5:\"label\";s:7:\"SZL (E)\";}i:128;a:2:{s:5:\"value\";s:3:\"THB\";s:5:\"label\";s:9:\"THB (฿)\";}i:129;a:2:{s:5:\"value\";s:3:\"TJS\";s:5:\"label\";s:9:\"TJS (TJS)\";}i:130;a:2:{s:5:\"value\";s:3:\"TMT\";s:5:\"label\";s:7:\"TMT (m)\";}i:131;a:2:{s:5:\"value\";s:3:\"TND\";s:5:\"label\";s:15:\"TND (د.ت.‏)\";}i:132;a:2:{s:5:\"value\";s:3:\"TOP\";s:5:\"label\";s:8:\"TOP (T$)\";}i:133;a:2:{s:5:\"value\";s:3:\"TRY\";s:5:\"label\";s:8:\"TRY (TL)\";}i:134;a:2:{s:5:\"value\";s:3:\"TTD\";s:5:\"label\";s:9:\"TTD (TT$)\";}i:135;a:2:{s:5:\"value\";s:3:\"TWD\";s:5:\"label\";s:9:\"TWD (NT$)\";}i:136;a:2:{s:5:\"value\";s:3:\"TZS\";s:5:\"label\";s:9:\"TZS (TSh)\";}i:137;a:2:{s:5:\"value\";s:3:\"UAH\";s:5:\"label\";s:13:\"UAH (грн.)\";}i:138;a:2:{s:5:\"value\";s:3:\"UGX\";s:5:\"label\";s:9:\"UGX (USh)\";}i:139;a:2:{s:5:\"value\";s:3:\"USD\";s:5:\"label\";s:7:\"USD ($)\";}i:140;a:2:{s:5:\"value\";s:3:\"UYU\";s:5:\"label\";s:8:\"UYU ($U)\";}i:141;a:2:{s:5:\"value\";s:3:\"UZS\";s:5:\"label\";s:12:\"UZS (сўм)\";}i:142;a:2:{s:5:\"value\";s:3:\"VND\";s:5:\"label\";s:9:\"VND (₫)\";}i:143;a:2:{s:5:\"value\";s:3:\"VUV\";s:5:\"label\";s:8:\"VUV (VT)\";}i:144;a:2:{s:5:\"value\";s:3:\"WST\";s:5:\"label\";s:9:\"WST (WS$)\";}i:145;a:2:{s:5:\"value\";s:3:\"XAF\";s:5:\"label\";s:7:\"XAF (F)\";}i:146;a:2:{s:5:\"value\";s:3:\"XCD\";s:5:\"label\";s:7:\"XCD ($)\";}i:147;a:2:{s:5:\"value\";s:3:\"XOF\";s:5:\"label\";s:7:\"XOF (F)\";}i:148;a:2:{s:5:\"value\";s:3:\"XPF\";s:5:\"label\";s:7:\"XPF (F)\";}i:149;a:2:{s:5:\"value\";s:3:\"YER\";s:5:\"label\";s:15:\"YER (ر.ي.‏)\";}i:150;a:2:{s:5:\"value\";s:3:\"ZAR\";s:5:\"label\";s:7:\"ZAR (R)\";}i:151;a:2:{s:5:\"value\";s:3:\"ZMW\";s:5:\"label\";s:8:\"ZMW (ZK)\";}}}i:371;a:7:{s:2:\"id\";s:17:\"ss_market_country\";s:5:\"label\";s:14:\"Market Country\";s:4:\"desc\";s:44:\"The market countries that Skyscanner support\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:2:\"US\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:234:{i:0;a:2:{s:5:\"value\";s:2:\"AD\";s:5:\"label\";s:7:\"Andorra\";}i:1;a:2:{s:5:\"value\";s:2:\"AE\";s:5:\"label\";s:20:\"United Arab Emirates\";}i:2;a:2:{s:5:\"value\";s:2:\"AF\";s:5:\"label\";s:11:\"Afghanistan\";}i:3;a:2:{s:5:\"value\";s:2:\"AG\";s:5:\"label\";s:19:\"Antigua and Barbuda\";}i:4;a:2:{s:5:\"value\";s:2:\"AI\";s:5:\"label\";s:8:\"Anguilla\";}i:5;a:2:{s:5:\"value\";s:2:\"AL\";s:5:\"label\";s:7:\"Albania\";}i:6;a:2:{s:5:\"value\";s:2:\"AM\";s:5:\"label\";s:7:\"Armenia\";}i:7;a:2:{s:5:\"value\";s:2:\"AO\";s:5:\"label\";s:6:\"Angola\";}i:8;a:2:{s:5:\"value\";s:2:\"AQ\";s:5:\"label\";s:10:\"Antarctica\";}i:9;a:2:{s:5:\"value\";s:2:\"AR\";s:5:\"label\";s:9:\"Argentina\";}i:10;a:2:{s:5:\"value\";s:2:\"AS\";s:5:\"label\";s:14:\"American Samoa\";}i:11;a:2:{s:5:\"value\";s:2:\"AT\";s:5:\"label\";s:7:\"Austria\";}i:12;a:2:{s:5:\"value\";s:2:\"AU\";s:5:\"label\";s:9:\"Australia\";}i:13;a:2:{s:5:\"value\";s:2:\"AW\";s:5:\"label\";s:5:\"Aruba\";}i:14;a:2:{s:5:\"value\";s:2:\"AZ\";s:5:\"label\";s:10:\"Azerbaijan\";}i:15;a:2:{s:5:\"value\";s:2:\"BA\";s:5:\"label\";s:22:\"Bosnia and Herzegovina\";}i:16;a:2:{s:5:\"value\";s:2:\"BB\";s:5:\"label\";s:8:\"Barbados\";}i:17;a:2:{s:5:\"value\";s:2:\"BD\";s:5:\"label\";s:10:\"Bangladesh\";}i:18;a:2:{s:5:\"value\";s:2:\"BE\";s:5:\"label\";s:7:\"Belgium\";}i:19;a:2:{s:5:\"value\";s:2:\"BF\";s:5:\"label\";s:12:\"Burkina Faso\";}i:20;a:2:{s:5:\"value\";s:2:\"BG\";s:5:\"label\";s:8:\"Bulgaria\";}i:21;a:2:{s:5:\"value\";s:2:\"BH\";s:5:\"label\";s:7:\"Bahrain\";}i:22;a:2:{s:5:\"value\";s:2:\"BI\";s:5:\"label\";s:7:\"Burundi\";}i:23;a:2:{s:5:\"value\";s:2:\"BJ\";s:5:\"label\";s:5:\"Benin\";}i:24;a:2:{s:5:\"value\";s:2:\"BL\";s:5:\"label\";s:16:\"Saint Barthelemy\";}i:25;a:2:{s:5:\"value\";s:2:\"BM\";s:5:\"label\";s:7:\"Bermuda\";}i:26;a:2:{s:5:\"value\";s:2:\"BN\";s:5:\"label\";s:6:\"Brunei\";}i:27;a:2:{s:5:\"value\";s:2:\"BO\";s:5:\"label\";s:7:\"Bolivia\";}i:28;a:2:{s:5:\"value\";s:2:\"BQ\";s:5:\"label\";s:21:\"Caribbean Netherlands\";}i:29;a:2:{s:5:\"value\";s:2:\"BR\";s:5:\"label\";s:6:\"Brazil\";}i:30;a:2:{s:5:\"value\";s:2:\"BS\";s:5:\"label\";s:7:\"Bahamas\";}i:31;a:2:{s:5:\"value\";s:2:\"BT\";s:5:\"label\";s:6:\"Bhutan\";}i:32;a:2:{s:5:\"value\";s:2:\"BW\";s:5:\"label\";s:8:\"Botswana\";}i:33;a:2:{s:5:\"value\";s:2:\"BY\";s:5:\"label\";s:7:\"Belarus\";}i:34;a:2:{s:5:\"value\";s:2:\"BZ\";s:5:\"label\";s:6:\"Belize\";}i:35;a:2:{s:5:\"value\";s:2:\"CA\";s:5:\"label\";s:6:\"Canada\";}i:36;a:2:{s:5:\"value\";s:2:\"CC\";s:5:\"label\";s:23:\"Cocos (Keeling) Islands\";}i:37;a:2:{s:5:\"value\";s:2:\"CD\";s:5:\"label\";s:8:\"DR Congo\";}i:38;a:2:{s:5:\"value\";s:2:\"CF\";s:5:\"label\";s:24:\"Central African Republic\";}i:39;a:2:{s:5:\"value\";s:2:\"CG\";s:5:\"label\";s:5:\"Congo\";}i:40;a:2:{s:5:\"value\";s:2:\"CH\";s:5:\"label\";s:11:\"Switzerland\";}i:41;a:2:{s:5:\"value\";s:2:\"CI\";s:5:\"label\";s:11:\"Ivory Coast\";}i:42;a:2:{s:5:\"value\";s:2:\"CK\";s:5:\"label\";s:12:\"Cook Islands\";}i:43;a:2:{s:5:\"value\";s:2:\"CL\";s:5:\"label\";s:5:\"Chile\";}i:44;a:2:{s:5:\"value\";s:2:\"CM\";s:5:\"label\";s:8:\"Cameroon\";}i:45;a:2:{s:5:\"value\";s:2:\"CN\";s:5:\"label\";s:5:\"China\";}i:46;a:2:{s:5:\"value\";s:2:\"CO\";s:5:\"label\";s:8:\"Colombia\";}i:47;a:2:{s:5:\"value\";s:2:\"CR\";s:5:\"label\";s:10:\"Costa Rica\";}i:48;a:2:{s:5:\"value\";s:2:\"CU\";s:5:\"label\";s:4:\"Cuba\";}i:49;a:2:{s:5:\"value\";s:2:\"CV\";s:5:\"label\";s:10:\"Cape Verde\";}i:50;a:2:{s:5:\"value\";s:2:\"CW\";s:5:\"label\";s:7:\"Curacao\";}i:51;a:2:{s:5:\"value\";s:2:\"CX\";s:5:\"label\";s:16:\"Christmas Island\";}i:52;a:2:{s:5:\"value\";s:2:\"CY\";s:5:\"label\";s:6:\"Cyprus\";}i:53;a:2:{s:5:\"value\";s:2:\"CZ\";s:5:\"label\";s:14:\"Czech Republic\";}i:54;a:2:{s:5:\"value\";s:2:\"DE\";s:5:\"label\";s:7:\"Germany\";}i:55;a:2:{s:5:\"value\";s:2:\"DJ\";s:5:\"label\";s:8:\"Djibouti\";}i:56;a:2:{s:5:\"value\";s:2:\"DK\";s:5:\"label\";s:7:\"Denmark\";}i:57;a:2:{s:5:\"value\";s:2:\"DM\";s:5:\"label\";s:8:\"Dominica\";}i:58;a:2:{s:5:\"value\";s:2:\"DO\";s:5:\"label\";s:18:\"Dominican Republic\";}i:59;a:2:{s:5:\"value\";s:2:\"DZ\";s:5:\"label\";s:7:\"Algeria\";}i:60;a:2:{s:5:\"value\";s:2:\"EC\";s:5:\"label\";s:7:\"Ecuador\";}i:61;a:2:{s:5:\"value\";s:2:\"EE\";s:5:\"label\";s:7:\"Estonia\";}i:62;a:2:{s:5:\"value\";s:2:\"EG\";s:5:\"label\";s:5:\"Egypt\";}i:63;a:2:{s:5:\"value\";s:2:\"ER\";s:5:\"label\";s:7:\"Eritrea\";}i:64;a:2:{s:5:\"value\";s:2:\"ES\";s:5:\"label\";s:5:\"Spain\";}i:65;a:2:{s:5:\"value\";s:2:\"ET\";s:5:\"label\";s:8:\"Ethiopia\";}i:66;a:2:{s:5:\"value\";s:2:\"FI\";s:5:\"label\";s:7:\"Finland\";}i:67;a:2:{s:5:\"value\";s:2:\"FJ\";s:5:\"label\";s:4:\"Fiji\";}i:68;a:2:{s:5:\"value\";s:2:\"FK\";s:5:\"label\";s:16:\"Falkland Islands\";}i:69;a:2:{s:5:\"value\";s:2:\"FM\";s:5:\"label\";s:10:\"Micronesia\";}i:70;a:2:{s:5:\"value\";s:2:\"FO\";s:5:\"label\";s:13:\"Faroe Islands\";}i:71;a:2:{s:5:\"value\";s:2:\"FR\";s:5:\"label\";s:6:\"France\";}i:72;a:2:{s:5:\"value\";s:2:\"GA\";s:5:\"label\";s:5:\"Gabon\";}i:73;a:2:{s:5:\"value\";s:2:\"GD\";s:5:\"label\";s:7:\"Grenada\";}i:74;a:2:{s:5:\"value\";s:2:\"GE\";s:5:\"label\";s:7:\"Georgia\";}i:75;a:2:{s:5:\"value\";s:2:\"GF\";s:5:\"label\";s:13:\"French Guiana\";}i:76;a:2:{s:5:\"value\";s:2:\"GG\";s:5:\"label\";s:8:\"Guernsey\";}i:77;a:2:{s:5:\"value\";s:2:\"GH\";s:5:\"label\";s:5:\"Ghana\";}i:78;a:2:{s:5:\"value\";s:2:\"GI\";s:5:\"label\";s:9:\"Gibraltar\";}i:79;a:2:{s:5:\"value\";s:2:\"GL\";s:5:\"label\";s:9:\"Greenland\";}i:80;a:2:{s:5:\"value\";s:2:\"GM\";s:5:\"label\";s:6:\"Gambia\";}i:81;a:2:{s:5:\"value\";s:2:\"GN\";s:5:\"label\";s:6:\"Guinea\";}i:82;a:2:{s:5:\"value\";s:2:\"GP\";s:5:\"label\";s:10:\"Guadeloupe\";}i:83;a:2:{s:5:\"value\";s:2:\"GQ\";s:5:\"label\";s:17:\"Equatorial Guinea\";}i:84;a:2:{s:5:\"value\";s:2:\"GR\";s:5:\"label\";s:6:\"Greece\";}i:85;a:2:{s:5:\"value\";s:2:\"GS\";s:5:\"label\";s:38:\"South Georgia & South Sandwich Islands\";}i:86;a:2:{s:5:\"value\";s:2:\"GT\";s:5:\"label\";s:9:\"Guatemala\";}i:87;a:2:{s:5:\"value\";s:2:\"GU\";s:5:\"label\";s:4:\"Guam\";}i:88;a:2:{s:5:\"value\";s:2:\"GW\";s:5:\"label\";s:13:\"Guinea-Bissau\";}i:89;a:2:{s:5:\"value\";s:2:\"GY\";s:5:\"label\";s:6:\"Guyana\";}i:90;a:2:{s:5:\"value\";s:2:\"HK\";s:5:\"label\";s:9:\"Hong Kong\";}i:91;a:2:{s:5:\"value\";s:2:\"HN\";s:5:\"label\";s:8:\"Honduras\";}i:92;a:2:{s:5:\"value\";s:2:\"HR\";s:5:\"label\";s:7:\"Croatia\";}i:93;a:2:{s:5:\"value\";s:2:\"HT\";s:5:\"label\";s:5:\"Haiti\";}i:94;a:2:{s:5:\"value\";s:2:\"HU\";s:5:\"label\";s:7:\"Hungary\";}i:95;a:2:{s:5:\"value\";s:2:\"ID\";s:5:\"label\";s:9:\"Indonesia\";}i:96;a:2:{s:5:\"value\";s:2:\"IE\";s:5:\"label\";s:7:\"Ireland\";}i:97;a:2:{s:5:\"value\";s:2:\"IL\";s:5:\"label\";s:6:\"Israel\";}i:98;a:2:{s:5:\"value\";s:2:\"IN\";s:5:\"label\";s:5:\"India\";}i:99;a:2:{s:5:\"value\";s:2:\"IQ\";s:5:\"label\";s:4:\"Iraq\";}i:100;a:2:{s:5:\"value\";s:2:\"IR\";s:5:\"label\";s:4:\"Iran\";}i:101;a:2:{s:5:\"value\";s:2:\"IS\";s:5:\"label\";s:7:\"Iceland\";}i:102;a:2:{s:5:\"value\";s:2:\"IT\";s:5:\"label\";s:5:\"Italy\";}i:103;a:2:{s:5:\"value\";s:2:\"JM\";s:5:\"label\";s:7:\"Jamaica\";}i:104;a:2:{s:5:\"value\";s:2:\"JO\";s:5:\"label\";s:6:\"Jordan\";}i:105;a:2:{s:5:\"value\";s:2:\"JP\";s:5:\"label\";s:5:\"Japan\";}i:106;a:2:{s:5:\"value\";s:2:\"KE\";s:5:\"label\";s:5:\"Kenya\";}i:107;a:2:{s:5:\"value\";s:2:\"KG\";s:5:\"label\";s:10:\"Kyrgyzstan\";}i:108;a:2:{s:5:\"value\";s:2:\"KH\";s:5:\"label\";s:8:\"Cambodia\";}i:109;a:2:{s:5:\"value\";s:2:\"KI\";s:5:\"label\";s:8:\"Kiribati\";}i:110;a:2:{s:5:\"value\";s:2:\"KM\";s:5:\"label\";s:7:\"Comoros\";}i:111;a:2:{s:5:\"value\";s:2:\"KN\";s:5:\"label\";s:21:\"Saint Kitts and Nevis\";}i:112;a:2:{s:5:\"value\";s:2:\"KO\";s:5:\"label\";s:6:\"Kosovo\";}i:113;a:2:{s:5:\"value\";s:2:\"KP\";s:5:\"label\";s:11:\"North Korea\";}i:114;a:2:{s:5:\"value\";s:2:\"KR\";s:5:\"label\";s:11:\"South Korea\";}i:115;a:2:{s:5:\"value\";s:2:\"KW\";s:5:\"label\";s:6:\"Kuwait\";}i:116;a:2:{s:5:\"value\";s:2:\"KY\";s:5:\"label\";s:14:\"Cayman Islands\";}i:117;a:2:{s:5:\"value\";s:2:\"KZ\";s:5:\"label\";s:10:\"Kazakhstan\";}i:118;a:2:{s:5:\"value\";s:2:\"LA\";s:5:\"label\";s:4:\"Laos\";}i:119;a:2:{s:5:\"value\";s:2:\"LB\";s:5:\"label\";s:7:\"Lebanon\";}i:120;a:2:{s:5:\"value\";s:2:\"LC\";s:5:\"label\";s:11:\"Saint Lucia\";}i:121;a:2:{s:5:\"value\";s:2:\"LI\";s:5:\"label\";s:13:\"Liechtenstein\";}i:122;a:2:{s:5:\"value\";s:2:\"LK\";s:5:\"label\";s:9:\"Sri Lanka\";}i:123;a:2:{s:5:\"value\";s:2:\"LR\";s:5:\"label\";s:7:\"Liberia\";}i:124;a:2:{s:5:\"value\";s:2:\"LS\";s:5:\"label\";s:7:\"Lesotho\";}i:125;a:2:{s:5:\"value\";s:2:\"LT\";s:5:\"label\";s:9:\"Lithuania\";}i:126;a:2:{s:5:\"value\";s:2:\"LU\";s:5:\"label\";s:10:\"Luxembourg\";}i:127;a:2:{s:5:\"value\";s:2:\"LV\";s:5:\"label\";s:6:\"Latvia\";}i:128;a:2:{s:5:\"value\";s:2:\"LY\";s:5:\"label\";s:5:\"Libya\";}i:129;a:2:{s:5:\"value\";s:2:\"MA\";s:5:\"label\";s:7:\"Morocco\";}i:130;a:2:{s:5:\"value\";s:2:\"MC\";s:5:\"label\";s:6:\"Monaco\";}i:131;a:2:{s:5:\"value\";s:2:\"MD\";s:5:\"label\";s:7:\"Moldova\";}i:132;a:2:{s:5:\"value\";s:2:\"ME\";s:5:\"label\";s:10:\"Montenegro\";}i:133;a:2:{s:5:\"value\";s:2:\"MG\";s:5:\"label\";s:10:\"Madagascar\";}i:134;a:2:{s:5:\"value\";s:2:\"MH\";s:5:\"label\";s:16:\"Marshall Islands\";}i:135;a:2:{s:5:\"value\";s:2:\"MK\";s:5:\"label\";s:21:\"Republic of Macedonia\";}i:136;a:2:{s:5:\"value\";s:2:\"ML\";s:5:\"label\";s:4:\"Mali\";}i:137;a:2:{s:5:\"value\";s:2:\"MM\";s:5:\"label\";s:7:\"Myanmar\";}i:138;a:2:{s:5:\"value\";s:2:\"MN\";s:5:\"label\";s:8:\"Mongolia\";}i:139;a:2:{s:5:\"value\";s:2:\"MO\";s:5:\"label\";s:5:\"Macau\";}i:140;a:2:{s:5:\"value\";s:2:\"MP\";s:5:\"label\";s:24:\"Northern Mariana Islands\";}i:141;a:2:{s:5:\"value\";s:2:\"MQ\";s:5:\"label\";s:10:\"Martinique\";}i:142;a:2:{s:5:\"value\";s:2:\"MR\";s:5:\"label\";s:10:\"Mauritania\";}i:143;a:2:{s:5:\"value\";s:2:\"MS\";s:5:\"label\";s:10:\"Montserrat\";}i:144;a:2:{s:5:\"value\";s:2:\"MT\";s:5:\"label\";s:5:\"Malta\";}i:145;a:2:{s:5:\"value\";s:2:\"MU\";s:5:\"label\";s:9:\"Mauritius\";}i:146;a:2:{s:5:\"value\";s:2:\"MV\";s:5:\"label\";s:8:\"Maldives\";}i:147;a:2:{s:5:\"value\";s:2:\"MW\";s:5:\"label\";s:6:\"Malawi\";}i:148;a:2:{s:5:\"value\";s:2:\"MX\";s:5:\"label\";s:6:\"Mexico\";}i:149;a:2:{s:5:\"value\";s:2:\"MY\";s:5:\"label\";s:8:\"Malaysia\";}i:150;a:2:{s:5:\"value\";s:2:\"MZ\";s:5:\"label\";s:10:\"Mozambique\";}i:151;a:2:{s:5:\"value\";s:2:\"NA\";s:5:\"label\";s:7:\"Namibia\";}i:152;a:2:{s:5:\"value\";s:2:\"NC\";s:5:\"label\";s:13:\"New Caledonia\";}i:153;a:2:{s:5:\"value\";s:2:\"NE\";s:5:\"label\";s:5:\"Niger\";}i:154;a:2:{s:5:\"value\";s:2:\"NG\";s:5:\"label\";s:7:\"Nigeria\";}i:155;a:2:{s:5:\"value\";s:2:\"NI\";s:5:\"label\";s:9:\"Nicaragua\";}i:156;a:2:{s:5:\"value\";s:2:\"NL\";s:5:\"label\";s:11:\"Netherlands\";}i:157;a:2:{s:5:\"value\";s:2:\"NO\";s:5:\"label\";s:6:\"Norway\";}i:158;a:2:{s:5:\"value\";s:2:\"NP\";s:5:\"label\";s:5:\"Nepal\";}i:159;a:2:{s:5:\"value\";s:2:\"NR\";s:5:\"label\";s:5:\"Nauru\";}i:160;a:2:{s:5:\"value\";s:2:\"NU\";s:5:\"label\";s:4:\"Niue\";}i:161;a:2:{s:5:\"value\";s:2:\"NZ\";s:5:\"label\";s:11:\"New Zealand\";}i:162;a:2:{s:5:\"value\";s:2:\"OM\";s:5:\"label\";s:4:\"Oman\";}i:163;a:2:{s:5:\"value\";s:2:\"PA\";s:5:\"label\";s:6:\"Panama\";}i:164;a:2:{s:5:\"value\";s:2:\"PE\";s:5:\"label\";s:4:\"Peru\";}i:165;a:2:{s:5:\"value\";s:2:\"PF\";s:5:\"label\";s:16:\"French Polynesia\";}i:166;a:2:{s:5:\"value\";s:2:\"PG\";s:5:\"label\";s:16:\"Papua New Guinea\";}i:167;a:2:{s:5:\"value\";s:2:\"PH\";s:5:\"label\";s:11:\"Philippines\";}i:168;a:2:{s:5:\"value\";s:2:\"PK\";s:5:\"label\";s:8:\"Pakistan\";}i:169;a:2:{s:5:\"value\";s:2:\"PL\";s:5:\"label\";s:6:\"Poland\";}i:170;a:2:{s:5:\"value\";s:2:\"PM\";s:5:\"label\";s:23:\"St. Pierre and Miquelon\";}i:171;a:2:{s:5:\"value\";s:2:\"PR\";s:5:\"label\";s:11:\"Puerto Rico\";}i:172;a:2:{s:5:\"value\";s:2:\"PT\";s:5:\"label\";s:8:\"Portugal\";}i:173;a:2:{s:5:\"value\";s:2:\"PW\";s:5:\"label\";s:5:\"Palau\";}i:174;a:2:{s:5:\"value\";s:2:\"PY\";s:5:\"label\";s:8:\"Paraguay\";}i:175;a:2:{s:5:\"value\";s:2:\"QA\";s:5:\"label\";s:5:\"Qatar\";}i:176;a:2:{s:5:\"value\";s:2:\"RE\";s:5:\"label\";s:7:\"Reunion\";}i:177;a:2:{s:5:\"value\";s:2:\"RO\";s:5:\"label\";s:7:\"Romania\";}i:178;a:2:{s:5:\"value\";s:2:\"RS\";s:5:\"label\";s:6:\"Serbia\";}i:179;a:2:{s:5:\"value\";s:2:\"RU\";s:5:\"label\";s:6:\"Russia\";}i:180;a:2:{s:5:\"value\";s:2:\"RW\";s:5:\"label\";s:6:\"Rwanda\";}i:181;a:2:{s:5:\"value\";s:2:\"SA\";s:5:\"label\";s:12:\"Saudi Arabia\";}i:182;a:2:{s:5:\"value\";s:2:\"SB\";s:5:\"label\";s:15:\"Solomon Islands\";}i:183;a:2:{s:5:\"value\";s:2:\"SC\";s:5:\"label\";s:10:\"Seychelles\";}i:184;a:2:{s:5:\"value\";s:2:\"SD\";s:5:\"label\";s:5:\"Sudan\";}i:185;a:2:{s:5:\"value\";s:2:\"SE\";s:5:\"label\";s:6:\"Sweden\";}i:186;a:2:{s:5:\"value\";s:2:\"SG\";s:5:\"label\";s:9:\"Singapore\";}i:187;a:2:{s:5:\"value\";s:2:\"SH\";s:5:\"label\";s:10:\"St. Helena\";}i:188;a:2:{s:5:\"value\";s:2:\"SI\";s:5:\"label\";s:8:\"Slovenia\";}i:189;a:2:{s:5:\"value\";s:2:\"SK\";s:5:\"label\";s:8:\"Slovakia\";}i:190;a:2:{s:5:\"value\";s:2:\"SL\";s:5:\"label\";s:12:\"Sierra Leone\";}i:191;a:2:{s:5:\"value\";s:2:\"SN\";s:5:\"label\";s:7:\"Senegal\";}i:192;a:2:{s:5:\"value\";s:2:\"SO\";s:5:\"label\";s:7:\"Somalia\";}i:193;a:2:{s:5:\"value\";s:2:\"SR\";s:5:\"label\";s:8:\"Suriname\";}i:194;a:2:{s:5:\"value\";s:2:\"SS\";s:5:\"label\";s:11:\"South Sudan\";}i:195;a:2:{s:5:\"value\";s:2:\"ST\";s:5:\"label\";s:21:\"Sao Tome and Principe\";}i:196;a:2:{s:5:\"value\";s:2:\"SV\";s:5:\"label\";s:11:\"El Salvador\";}i:197;a:2:{s:5:\"value\";s:2:\"SX\";s:5:\"label\";s:10:\"St Maarten\";}i:198;a:2:{s:5:\"value\";s:2:\"SY\";s:5:\"label\";s:5:\"Syria\";}i:199;a:2:{s:5:\"value\";s:2:\"SZ\";s:5:\"label\";s:9:\"Swaziland\";}i:200;a:2:{s:5:\"value\";s:2:\"TC\";s:5:\"label\";s:24:\"Turks and Caicos Islands\";}i:201;a:2:{s:5:\"value\";s:2:\"TD\";s:5:\"label\";s:4:\"Chad\";}i:202;a:2:{s:5:\"value\";s:2:\"TG\";s:5:\"label\";s:4:\"Togo\";}i:203;a:2:{s:5:\"value\";s:2:\"TH\";s:5:\"label\";s:8:\"Thailand\";}i:204;a:2:{s:5:\"value\";s:2:\"TJ\";s:5:\"label\";s:10:\"Tajikistan\";}i:205;a:2:{s:5:\"value\";s:2:\"TL\";s:5:\"label\";s:10:\"East Timor\";}i:206;a:2:{s:5:\"value\";s:2:\"TM\";s:5:\"label\";s:12:\"Turkmenistan\";}i:207;a:2:{s:5:\"value\";s:2:\"TN\";s:5:\"label\";s:7:\"Tunisia\";}i:208;a:2:{s:5:\"value\";s:2:\"TO\";s:5:\"label\";s:5:\"Tonga\";}i:209;a:2:{s:5:\"value\";s:2:\"TR\";s:5:\"label\";s:6:\"Turkey\";}i:210;a:2:{s:5:\"value\";s:2:\"TT\";s:5:\"label\";s:19:\"Trinidad and Tobago\";}i:211;a:2:{s:5:\"value\";s:2:\"TV\";s:5:\"label\";s:6:\"Tuvalu\";}i:212;a:2:{s:5:\"value\";s:2:\"TW\";s:5:\"label\";s:6:\"Taiwan\";}i:213;a:2:{s:5:\"value\";s:2:\"TZ\";s:5:\"label\";s:8:\"Tanzania\";}i:214;a:2:{s:5:\"value\";s:2:\"UA\";s:5:\"label\";s:7:\"Ukraine\";}i:215;a:2:{s:5:\"value\";s:2:\"UG\";s:5:\"label\";s:6:\"Uganda\";}i:216;a:2:{s:5:\"value\";s:2:\"UK\";s:5:\"label\";s:14:\"United Kingdom\";}i:217;a:2:{s:5:\"value\";s:2:\"US\";s:5:\"label\";s:13:\"United States\";}i:218;a:2:{s:5:\"value\";s:2:\"UY\";s:5:\"label\";s:7:\"Uruguay\";}i:219;a:2:{s:5:\"value\";s:2:\"UZ\";s:5:\"label\";s:10:\"Uzbekistan\";}i:220;a:2:{s:5:\"value\";s:2:\"VA\";s:5:\"label\";s:12:\"Vatican City\";}i:221;a:2:{s:5:\"value\";s:2:\"VC\";s:5:\"label\";s:32:\"Saint Vincent and the Grenadines\";}i:222;a:2:{s:5:\"value\";s:2:\"VE\";s:5:\"label\";s:9:\"Venezuela\";}i:223;a:2:{s:5:\"value\";s:2:\"VG\";s:5:\"label\";s:22:\"British Virgin Islands\";}i:224;a:2:{s:5:\"value\";s:2:\"VI\";s:5:\"label\";s:17:\"US Virgin Islands\";}i:225;a:2:{s:5:\"value\";s:2:\"VN\";s:5:\"label\";s:7:\"Vietnam\";}i:226;a:2:{s:5:\"value\";s:2:\"VU\";s:5:\"label\";s:7:\"Vanuatu\";}i:227;a:2:{s:5:\"value\";s:2:\"WF\";s:5:\"label\";s:25:\"Wallis and Futuna Islands\";}i:228;a:2:{s:5:\"value\";s:2:\"WS\";s:5:\"label\";s:5:\"Samoa\";}i:229;a:2:{s:5:\"value\";s:2:\"YE\";s:5:\"label\";s:5:\"Yemen\";}i:230;a:2:{s:5:\"value\";s:2:\"YT\";s:5:\"label\";s:7:\"Mayotte\";}i:231;a:2:{s:5:\"value\";s:2:\"ZA\";s:5:\"label\";s:12:\"South Africa\";}i:232;a:2:{s:5:\"value\";s:2:\"ZM\";s:5:\"label\";s:6:\"Zambia\";}i:233;a:2:{s:5:\"value\";s:2:\"ZW\";s:5:\"label\";s:8:\"Zimbabwe\";}}}i:372;a:4:{s:2:\"id\";s:15:\"hotelscb_option\";s:5:\"label\";s:14:\"HotelsCombined\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:373;a:5:{s:2:\"id\";s:15:\"hotelscb_aff_id\";s:5:\"label\";s:12:\"Affiliate ID\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:23:\"Enter your affiliate ID\";s:7:\"section\";s:17:\"option_api_update\";}i:374;a:5:{s:2:\"id\";s:21:\"hotelscb_searchbox_id\";s:5:\"label\";s:12:\"Searchbox ID\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:24:\"Enter your search box ID\";s:7:\"section\";s:17:\"option_api_update\";}i:375;a:4:{s:2:\"id\";s:16:\"bookingdc_option\";s:5:\"label\";s:11:\"Booking.com\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:376;a:6:{s:2:\"id\";s:16:\"bookingdc_iframe\";s:5:\"label\";s:24:\"Using iframe search form\";s:4:\"desc\";s:25:\"Enable iframe search form\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:2:\"on\";}i:377;a:7:{s:2:\"id\";s:21:\"bookingdc_iframe_code\";s:5:\"label\";s:16:\"Search form code\";s:4:\"desc\";s:43:\"Enter your search box code from booking.com\";s:4:\"type\";s:15:\"textarea-simple\";s:4:\"rows\";s:1:\"4\";s:9:\"condition\";s:23:\"bookingdc_iframe:is(on)\";s:7:\"section\";s:17:\"option_api_update\";}i:378;a:6:{s:2:\"id\";s:13:\"bookingdc_aid\";s:5:\"label\";s:17:\"Your affiliate ID\";s:4:\"desc\";s:40:\"Enter your affiliate ID from booking.com\";s:4:\"type\";s:4:\"text\";s:9:\"condition\";s:24:\"bookingdc_iframe:is(off)\";s:7:\"section\";s:17:\"option_api_update\";}i:379;a:7:{s:2:\"id\";s:18:\"bookingdc_currency\";s:5:\"label\";s:16:\"Default Currency\";s:4:\"type\";s:6:\"select\";s:7:\"choices\";a:48:{i:0;a:2:{s:5:\"value\";s:3:\"amd\";s:5:\"label\";s:16:\"UAE dirham (AED)\";}i:1;a:2:{s:5:\"value\";s:3:\"amd\";s:5:\"label\";s:19:\"Armenian Dram (AMD)\";}i:2;a:2:{s:5:\"value\";s:3:\"ars\";s:5:\"label\";s:20:\"Argentine peso (ARS)\";}i:3;a:2:{s:5:\"value\";s:3:\"aud\";s:5:\"label\";s:23:\"Australian Dollar (AUD)\";}i:4;a:2:{s:5:\"value\";s:3:\"azn\";s:5:\"label\";s:23:\"Azerbaijani Manat (AZN)\";}i:5;a:2:{s:5:\"value\";s:3:\"bdt\";s:5:\"label\";s:22:\"Bangladeshi taka (BDT)\";}i:6;a:2:{s:5:\"value\";s:3:\"bgn\";s:5:\"label\";s:19:\"Bulgarian lev (BGN)\";}i:7;a:2:{s:5:\"value\";s:3:\"brl\";s:5:\"label\";s:20:\"Brazilian real (BRL)\";}i:8;a:2:{s:5:\"value\";s:3:\"byr\";s:5:\"label\";s:22:\"Belarusian ruble (BYR)\";}i:9;a:2:{s:5:\"value\";s:3:\"chf\";s:5:\"label\";s:17:\"Swiss Franc (CHF)\";}i:10;a:2:{s:5:\"value\";s:3:\"clp\";s:5:\"label\";s:18:\"Chilean peso (CLP)\";}i:11;a:2:{s:5:\"value\";s:3:\"cny\";s:5:\"label\";s:18:\"Chinese Yuan (CNY)\";}i:12;a:2:{s:5:\"value\";s:3:\"cop\";s:5:\"label\";s:20:\"Colombian peso (COP)\";}i:13;a:2:{s:5:\"value\";s:3:\"dkk\";s:5:\"label\";s:18:\"Danish krone (DKK)\";}i:14;a:2:{s:5:\"value\";s:3:\"egp\";s:5:\"label\";s:20:\"Egyptian Pound (EGP)\";}i:15;a:2:{s:5:\"value\";s:3:\"eur\";s:5:\"label\";s:10:\"Euro (EUR)\";}i:16;a:2:{s:5:\"value\";s:3:\"gpb\";s:5:\"label\";s:28:\"British Pound Sterling (GPB)\";}i:17;a:2:{s:5:\"value\";s:3:\"gel\";s:5:\"label\";s:19:\"Georgian lari (GEL)\";}i:18;a:2:{s:5:\"value\";s:3:\"hkd\";s:5:\"label\";s:22:\"Hong Kong Dollar (HKD)\";}i:19;a:2:{s:5:\"value\";s:3:\"huf\";s:5:\"label\";s:22:\"Hungarian forint (HUF)\";}i:20;a:2:{s:5:\"value\";s:3:\"idr\";s:5:\"label\";s:23:\"Indonesian Rupiah (IDR)\";}i:21;a:2:{s:5:\"value\";s:3:\"inr\";s:5:\"label\";s:18:\"Indian Rupee (INR)\";}i:22;a:2:{s:5:\"value\";s:3:\"jpy\";s:5:\"label\";s:18:\"Japanese Yen (JPY)\";}i:23;a:2:{s:5:\"value\";s:3:\"kgs\";s:5:\"label\";s:9:\"Som (KGS)\";}i:24;a:2:{s:5:\"value\";s:3:\"krw\";s:5:\"label\";s:22:\"South Korean won (KRW)\";}i:25;a:2:{s:5:\"value\";s:3:\"mxn\";s:5:\"label\";s:18:\"Mexican peso (MXN)\";}i:26;a:2:{s:5:\"value\";s:3:\"myr\";s:5:\"label\";s:23:\"Malaysian ringgit (MYR)\";}i:27;a:2:{s:5:\"value\";s:3:\"nok\";s:5:\"label\";s:21:\"Norwegian Krone (NOK)\";}i:28;a:2:{s:5:\"value\";s:3:\"kzt\";s:5:\"label\";s:23:\"Kazakhstani Tenge (KZT)\";}i:29;a:2:{s:5:\"value\";s:3:\"ltl\";s:5:\"label\";s:17:\"Latvian Lat (LTL)\";}i:30;a:2:{s:5:\"value\";s:3:\"nzd\";s:5:\"label\";s:24:\"New Zealand Dollar (NZD)\";}i:31;a:2:{s:5:\"value\";s:3:\"pen\";s:5:\"label\";s:18:\"Peruvian sol (PEN)\";}i:32;a:2:{s:5:\"value\";s:3:\"php\";s:5:\"label\";s:21:\"Philippine Peso (PHP)\";}i:33;a:2:{s:5:\"value\";s:3:\"pkr\";s:5:\"label\";s:20:\"Pakistan Rupee (PKR)\";}i:34;a:2:{s:5:\"value\";s:3:\"pln\";s:5:\"label\";s:18:\"Polish zloty (PLN)\";}i:35;a:2:{s:5:\"value\";s:3:\"ron\";s:5:\"label\";s:18:\"Romanian leu (RON)\";}i:36;a:2:{s:5:\"value\";s:3:\"rsd\";s:5:\"label\";s:19:\"Serbian dinar (RSD)\";}i:37;a:2:{s:5:\"value\";s:3:\"rub\";s:5:\"label\";s:19:\"Russian Ruble (RUB)\";}i:38;a:2:{s:5:\"value\";s:3:\"sar\";s:5:\"label\";s:17:\"Saudi riyal (SAR)\";}i:39;a:2:{s:5:\"value\";s:3:\"sek\";s:5:\"label\";s:19:\"Swedish krona (SEK)\";}i:40;a:2:{s:5:\"value\";s:3:\"sgd\";s:5:\"label\";s:22:\"Singapore Dollar (SGD)\";}i:41;a:2:{s:5:\"value\";s:3:\"thb\";s:5:\"label\";s:15:\"Thai Baht (THB)\";}i:42;a:2:{s:5:\"value\";s:3:\"try\";s:5:\"label\";s:18:\"Turkish lira (TRY)\";}i:43;a:2:{s:5:\"value\";s:3:\"uah\";s:5:\"label\";s:23:\"Ukrainian Hryvnia (UAH)\";}i:44;a:2:{s:5:\"value\";s:3:\"usd\";s:5:\"label\";s:15:\"US Dollar (USD)\";}i:45;a:2:{s:5:\"value\";s:3:\"vnd\";s:5:\"label\";s:21:\"Vietnamese dong (VND)\";}i:46;a:2:{s:5:\"value\";s:3:\"xof\";s:5:\"label\";s:15:\"CFA Franc (XOF)\";}i:47;a:2:{s:5:\"value\";s:3:\"zar\";s:5:\"label\";s:24:\"South African Rand (ZAR)\";}}s:7:\"section\";s:17:\"option_api_update\";s:3:\"std\";s:3:\"usd\";s:9:\"condition\";s:24:\"bookingdc_iframe:is(off)\";}i:380;a:4:{s:2:\"id\";s:14:\"expedia_option\";s:5:\"label\";s:7:\"Expedia\";s:4:\"type\";s:3:\"tab\";s:7:\"section\";s:17:\"option_api_update\";}i:381;a:6:{s:2:\"id\";s:19:\"expedia_iframe_code\";s:5:\"label\";s:16:\"Search form code\";s:4:\"desc\";s:39:\"Enter your search box code from expedia\";s:4:\"type\";s:15:\"textarea-simple\";s:4:\"rows\";s:1:\"4\";s:7:\"section\";s:17:\"option_api_update\";}i:382;a:6:{s:2:\"id\";s:19:\"gen_enable_smscroll\";s:5:\"label\";s:18:\"Enable Nice Scroll\";s:4:\"desc\";s:54:\"This allows you to turn on or off \"Nice Scroll Effect\"\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:9:\"option_bc\";s:3:\"std\";s:3:\"off\";}i:383;a:6:{s:2:\"id\";s:21:\"sp_disable_javascript\";s:5:\"label\";s:26:\"Support Disable javascript\";s:4:\"desc\";s:62:\"This allows css friendly with browsers what disable javascript\";s:4:\"type\";s:6:\"on-off\";s:7:\"section\";s:9:\"option_bc\";s:3:\"std\";s:3:\"off\";}i:384;a:7:{s:2:\"id\";s:14:\"google_api_key\";s:5:\"label\";s:14:\"Google API key\";s:4:\"desc\";s:142:\"Input your Google API key <a target=\'_blank\' href=\'https://developers.google.com/maps/documentation/javascript/get-api-key\'>How to get it?</a>\";s:4:\"type\";s:11:\"custom-text\";s:7:\"section\";s:9:\"option_bc\";s:3:\"std\";s:39:\"AIzaSyA1l5FlclOzqDpkx5jSH5WBcC0XFkqmYOY\";s:6:\"v_hint\";s:3:\"yes\";}i:385;a:6:{s:2:\"id\";s:19:\"google_font_api_key\";s:5:\"label\";s:20:\"Google Fonts API key\";s:4:\"desc\";s:131:\"Input your Google Fonts API key <a target=\'_blank\' href=\'https://developers.google.com/fonts/docs/developer_api\'>How to get it?</a>\";s:4:\"type\";s:11:\"custom-text\";s:7:\"section\";s:9:\"option_bc\";s:6:\"v_hint\";s:3:\"yes\";}i:386;a:7:{s:2:\"id\";s:15:\"weather_api_key\";s:5:\"label\";s:15:\"Weather API key\";s:4:\"desc\";s:116:\"Input your Weather API key <a target=\'_blank\' href=\'https://home.openweathermap.org/api_keys\'>openweathermap.org</a>\";s:4:\"type\";s:11:\"custom-text\";s:7:\"section\";s:9:\"option_bc\";s:3:\"std\";s:32:\"a82498aa9918914fa4ac5ba584a7e623\";s:6:\"v_hint\";s:3:\"yes\";}}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(250, 'st_option_tree_settings_new_version', '1.1', 'yes'),
(251, 'wb_form_builder_demo', '1', 'yes'),
(253, 'wpcf7', 'a:2:{s:7:\"version\";s:3:\"5.4\";s:13:\"bulk_validate\";a:4:{s:9:\"timestamp\";i:1614363797;s:7:\"version\";s:3:\"5.4\";s:11:\"count_valid\";i:1;s:13:\"count_invalid\";i:0;}}', 'yes'),
(254, 'action_scheduler_hybrid_store_demarkation', '21', 'yes'),
(255, 'schema-ActionScheduler_StoreSchema', '3.0.1614363798', 'yes'),
(256, 'schema-ActionScheduler_LoggerSchema', '2.0.1614363798', 'yes'),
(259, 'woocommerce_schema_version', '430', 'yes'),
(260, 'woocommerce_store_address', '', 'yes'),
(261, 'woocommerce_store_address_2', '', 'yes'),
(262, 'woocommerce_store_city', '', 'yes'),
(263, 'woocommerce_default_country', 'GB', 'yes'),
(264, 'woocommerce_store_postcode', '', 'yes'),
(265, 'woocommerce_allowed_countries', 'all', 'yes'),
(266, 'woocommerce_all_except_countries', '', 'yes'),
(267, 'woocommerce_specific_allowed_countries', '', 'yes'),
(268, 'woocommerce_ship_to_countries', '', 'yes'),
(269, 'woocommerce_specific_ship_to_countries', '', 'yes'),
(270, 'woocommerce_default_customer_address', 'base', 'yes'),
(271, 'woocommerce_calc_taxes', 'no', 'yes'),
(272, 'woocommerce_enable_coupons', 'yes', 'yes'),
(273, 'woocommerce_calc_discounts_sequentially', 'no', 'no'),
(274, 'woocommerce_currency', 'GBP', 'yes'),
(275, 'woocommerce_currency_pos', 'left', 'yes'),
(276, 'woocommerce_price_thousand_sep', ',', 'yes'),
(277, 'woocommerce_price_decimal_sep', '.', 'yes'),
(278, 'woocommerce_price_num_decimals', '2', 'yes'),
(279, 'woocommerce_shop_page_id', '22', 'yes'),
(280, 'woocommerce_cart_redirect_after_add', 'no', 'yes'),
(281, 'woocommerce_enable_ajax_add_to_cart', 'yes', 'yes'),
(282, 'woocommerce_placeholder_image', '21', 'yes'),
(283, 'woocommerce_weight_unit', 'kg', 'yes'),
(284, 'woocommerce_dimension_unit', 'cm', 'yes'),
(285, 'woocommerce_enable_reviews', 'yes', 'yes'),
(286, 'woocommerce_review_rating_verification_label', 'yes', 'no'),
(287, 'woocommerce_review_rating_verification_required', 'no', 'no'),
(288, 'woocommerce_enable_review_rating', 'yes', 'yes'),
(289, 'woocommerce_review_rating_required', 'yes', 'no'),
(290, 'woocommerce_manage_stock', 'yes', 'yes'),
(291, 'woocommerce_hold_stock_minutes', '60', 'no'),
(292, 'woocommerce_notify_low_stock', 'yes', 'no'),
(293, 'woocommerce_notify_no_stock', 'yes', 'no'),
(294, 'woocommerce_stock_email_recipient', 'kchaouanis26@gmail.com', 'no'),
(295, 'woocommerce_notify_low_stock_amount', '2', 'no'),
(296, 'woocommerce_notify_no_stock_amount', '0', 'yes'),
(297, 'woocommerce_hide_out_of_stock_items', 'no', 'yes'),
(298, 'woocommerce_stock_format', '', 'yes'),
(299, 'woocommerce_file_download_method', 'force', 'no'),
(300, 'woocommerce_downloads_require_login', 'no', 'no'),
(301, 'woocommerce_downloads_grant_access_after_payment', 'yes', 'no'),
(302, 'woocommerce_downloads_add_hash_to_filename', 'yes', 'yes'),
(303, 'woocommerce_prices_include_tax', 'no', 'yes'),
(304, 'woocommerce_tax_based_on', 'shipping', 'yes'),
(305, 'woocommerce_shipping_tax_class', 'inherit', 'yes'),
(306, 'woocommerce_tax_round_at_subtotal', 'no', 'yes'),
(307, 'woocommerce_tax_classes', '', 'yes'),
(308, 'woocommerce_tax_display_shop', 'excl', 'yes'),
(309, 'woocommerce_tax_display_cart', 'excl', 'yes'),
(310, 'woocommerce_price_display_suffix', '', 'yes'),
(311, 'woocommerce_tax_total_display', 'itemized', 'no'),
(312, 'woocommerce_enable_shipping_calc', 'yes', 'no'),
(313, 'woocommerce_shipping_cost_requires_address', 'no', 'yes'),
(314, 'woocommerce_ship_to_destination', 'billing', 'no'),
(315, 'woocommerce_shipping_debug_mode', 'no', 'yes'),
(316, 'woocommerce_enable_guest_checkout', 'yes', 'no'),
(317, 'woocommerce_enable_checkout_login_reminder', 'no', 'no'),
(318, 'woocommerce_enable_signup_and_login_from_checkout', 'no', 'no'),
(319, 'woocommerce_enable_myaccount_registration', 'no', 'no'),
(320, 'woocommerce_registration_generate_username', 'yes', 'no'),
(321, 'woocommerce_registration_generate_password', 'yes', 'no'),
(322, 'woocommerce_erasure_request_removes_order_data', 'no', 'no'),
(323, 'woocommerce_erasure_request_removes_download_data', 'no', 'no'),
(324, 'woocommerce_allow_bulk_remove_personal_data', 'no', 'no'),
(325, 'woocommerce_registration_privacy_policy_text', 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our [privacy_policy].', 'yes'),
(326, 'woocommerce_checkout_privacy_policy_text', 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our [privacy_policy].', 'yes'),
(327, 'woocommerce_delete_inactive_accounts', 'a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}', 'no'),
(328, 'woocommerce_trash_pending_orders', '', 'no'),
(329, 'woocommerce_trash_failed_orders', '', 'no'),
(330, 'woocommerce_trash_cancelled_orders', '', 'no'),
(331, 'woocommerce_anonymize_completed_orders', 'a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}', 'no'),
(332, 'woocommerce_email_from_name', 'tourphoria', 'no'),
(333, 'woocommerce_email_from_address', 'kchaouanis26@gmail.com', 'no'),
(334, 'woocommerce_email_header_image', '', 'no'),
(335, 'woocommerce_email_footer_text', '{site_title} &mdash; Built with {WooCommerce}', 'no'),
(336, 'woocommerce_email_base_color', '#96588a', 'no'),
(337, 'woocommerce_email_background_color', '#f7f7f7', 'no'),
(338, 'woocommerce_email_body_background_color', '#ffffff', 'no'),
(339, 'woocommerce_email_text_color', '#3c3c3c', 'no'),
(340, 'woocommerce_merchant_email_notifications', 'yes', 'no'),
(341, 'woocommerce_cart_page_id', '23', 'no'),
(342, 'woocommerce_checkout_page_id', '24', 'no'),
(343, 'woocommerce_myaccount_page_id', '25', 'no'),
(344, 'woocommerce_terms_page_id', '', 'no'),
(345, 'woocommerce_force_ssl_checkout', 'no', 'yes'),
(346, 'woocommerce_unforce_ssl_checkout', 'no', 'yes'),
(347, 'woocommerce_checkout_pay_endpoint', 'order-pay', 'yes'),
(348, 'woocommerce_checkout_order_received_endpoint', 'order-received', 'yes'),
(349, 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method', 'yes'),
(350, 'woocommerce_myaccount_delete_payment_method_endpoint', 'delete-payment-method', 'yes'),
(351, 'woocommerce_myaccount_set_default_payment_method_endpoint', 'set-default-payment-method', 'yes'),
(352, 'woocommerce_myaccount_orders_endpoint', 'orders', 'yes'),
(353, 'woocommerce_myaccount_view_order_endpoint', 'view-order', 'yes'),
(354, 'woocommerce_myaccount_downloads_endpoint', 'downloads', 'yes'),
(355, 'woocommerce_myaccount_edit_account_endpoint', 'edit-account', 'yes'),
(356, 'woocommerce_myaccount_edit_address_endpoint', 'edit-address', 'yes'),
(357, 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods', 'yes'),
(358, 'woocommerce_myaccount_lost_password_endpoint', 'lost-password', 'yes'),
(359, 'woocommerce_logout_endpoint', 'customer-logout', 'yes'),
(360, 'woocommerce_api_enabled', 'no', 'yes'),
(361, 'woocommerce_allow_tracking', 'no', 'no'),
(362, 'woocommerce_show_marketplace_suggestions', 'yes', 'no'),
(363, 'woocommerce_single_image_width', '600', 'yes'),
(364, 'woocommerce_thumbnail_image_width', '300', 'yes'),
(365, 'woocommerce_checkout_highlight_required_fields', 'yes', 'yes'),
(366, 'woocommerce_demo_store', 'no', 'no'),
(367, 'woocommerce_permalinks', 'a:5:{s:12:\"product_base\";s:7:\"product\";s:13:\"category_base\";s:16:\"product-category\";s:8:\"tag_base\";s:11:\"product-tag\";s:14:\"attribute_base\";s:0:\"\";s:22:\"use_verbose_page_rules\";b:0;}', 'yes'),
(368, 'current_theme_supports_woocommerce', 'yes', 'yes'),
(369, 'woocommerce_queue_flush_rewrite_rules', 'no', 'yes'),
(371, 'product_cat_children', 'a:0:{}', 'yes'),
(372, 'default_product_cat', '15', 'yes'),
(375, 'woocommerce_version', '5.0.0', 'yes'),
(376, 'woocommerce_db_version', '5.0.0', 'yes'),
(382, '_transient_jetpack_autoloader_plugin_paths', 'a:1:{i:0;s:29:\"{{WP_PLUGIN_DIR}}/woocommerce\";}', 'yes'),
(383, 'action_scheduler_lock_async-request-runner', '1614847479', 'yes'),
(384, 'woocommerce_admin_notices', 'a:2:{i:0;s:20:\"no_secure_connection\";i:1;s:14:\"template_files\";}', 'yes'),
(385, 'woocommerce_maxmind_geolocation_settings', 'a:1:{s:15:\"database_prefix\";s:32:\"LpYkImDBlqQAJaKYbhICJMNYXaCRSttM\";}', 'yes'),
(386, '_transient_woocommerce_webhook_ids_status_active', 'a:0:{}', 'yes'),
(387, 'widget_woocommerce_widget_cart', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(388, 'widget_woocommerce_layered_nav_filters', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(389, 'widget_woocommerce_layered_nav', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(390, 'widget_woocommerce_price_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(391, 'widget_woocommerce_product_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(392, 'widget_woocommerce_product_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(393, 'widget_woocommerce_product_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(394, 'widget_woocommerce_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(395, 'widget_woocommerce_recently_viewed_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(396, 'widget_woocommerce_top_rated_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(397, 'widget_woocommerce_recent_reviews', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(398, 'widget_woocommerce_rating_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(399, 'widget_mc4wp_form_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(400, 'widget_st_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(401, 'widget_st_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(402, 'widget_st_location_widget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(403, 'widget_st_search_blog', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(404, 'widget_st_section_wrap_end', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(405, 'widget_st_section_wrap_start', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(406, 'widget_st_shop_reset_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(407, 'widget_st_wd_text', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(408, 'widget_sttwitterwidget', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(411, 'woocommerce_admin_version', '1.9.0', 'yes'),
(412, 'woocommerce_admin_install_timestamp', '1614363803', 'yes'),
(413, 'vc_version', '5.7', 'yes'),
(417, '_transient_wc_count_comments', 'O:8:\"stdClass\":7:{s:14:\"total_comments\";i:1;s:3:\"all\";i:1;s:8:\"approved\";s:1:\"1\";s:9:\"moderated\";i:0;s:4:\"spam\";i:0;s:5:\"trash\";i:0;s:12:\"post-trashed\";i:0;}', 'yes'),
(418, 'option_tree_settings', 'a:2:{s:8:\"sections\";a:1:{i:0;a:2:{s:2:\"id\";s:7:\"general\";s:5:\"title\";s:7:\"General\";}}s:8:\"settings\";a:1:{i:0;a:10:{s:2:\"id\";s:11:\"sample_text\";s:5:\"label\";s:23:\"Sample Text Field Label\";s:4:\"desc\";s:38:\"Description for the sample text field.\";s:7:\"section\";s:7:\"general\";s:4:\"type\";s:4:\"text\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"post_type\";s:0:\"\";s:7:\"choices\";a:0:{}}}}', 'yes'),
(419, 'mc4wp_version', '4.8.3', 'yes'),
(420, 'wc_blocks_db_schema_version', '260', 'yes'),
(421, 'wc_remote_inbox_notifications_stored_state', 'O:8:\"stdClass\":2:{s:22:\"there_were_no_products\";b:1;s:22:\"there_are_now_products\";b:0;}', 'yes'),
(422, 'option_tree', 'a:171:{s:11:\"sample_text\";s:0:\"\";s:23:\"enable_user_online_noti\";s:0:\"\";s:24:\"enable_last_booking_noti\";s:0:\"\";s:15:\"enable_user_nav\";s:0:\"\";s:13:\"noti_position\";s:8:\"topRight\";s:22:\"admin_menu_normal_user\";s:0:\"\";s:34:\"once_notification_per_each_session\";s:0:\"\";s:20:\"st_weather_temp_unit\";s:1:\"c\";s:21:\"search_enable_preload\";s:0:\"\";s:27:\"search_preload_icon_default\";s:0:\"\";s:11:\"logo_retina\";s:0:\"\";s:11:\"logo_mobile\";s:0:\"\";s:13:\"st_seo_option\";s:0:\"\";s:12:\"st_seo_title\";s:0:\"\";s:11:\"st_seo_desc\";s:0:\"\";s:15:\"st_seo_keywords\";s:0:\"\";s:20:\"enable_captcha_login\";s:0:\"\";s:13:\"recaptcha_key\";s:0:\"\";s:19:\"recaptcha_secretkey\";s:0:\"\";s:11:\"general_tab\";s:0:\"\";s:20:\"search_preload_image\";s:0:\"\";s:26:\"search_preload_icon_custom\";s:0:\"\";s:21:\"list_disabled_feature\";a:5:{i:0;s:8:\"st_hotel\";i:1;s:7:\"st_cars\";i:2;s:9:\"st_rental\";i:3;s:11:\"st_activity\";i:4;s:9:\"st_flight\";}s:8:\"logo_tab\";s:0:\"\";s:4:\"logo\";s:0:\"\";s:8:\"logo_new\";s:0:\"\";s:14:\"logo_dashboard\";s:0:\"\";s:7:\"favicon\";s:0:\"\";s:7:\"404_tab\";s:0:\"\";s:6:\"404_bg\";s:0:\"\";s:8:\"404_text\";s:0:\"\";s:7:\"seo_tab\";s:0:\"\";s:9:\"login_tab\";s:0:\"\";s:14:\"st_theme_style\";s:6:\"modern\";s:13:\"right_to_left\";s:0:\"\";s:12:\"google_fonts\";a:1:{i:0;a:5:{s:2:\"id\";s:6:\"gfont0\";s:7:\"fontVal\";s:2:\"-1\";s:6:\"family\";s:0:\"\";s:8:\"variants\";a:0:{}s:7:\"subsets\";a:0:{}}}s:15:\"body_background\";a:0:{}s:20:\"main_wrap_background\";a:0:{}s:20:\"style_default_scheme\";s:0:\"\";s:10:\"main_color\";s:0:\"\";s:17:\"header_background\";a:0:{}s:24:\"gen_enable_sticky_header\";s:2:\"on\";s:22:\"gen_enable_sticky_menu\";s:2:\"on\";s:10:\"menu_style\";s:0:\"\";s:17:\"menu_style_modern\";s:1:\"3\";s:14:\"allow_megamenu\";s:0:\"\";s:20:\"mega_menu_background\";s:0:\"\";s:15:\"mega_menu_color\";s:0:\"\";s:10:\"menu_color\";a:0:{}s:15:\"menu_background\";a:0:{}s:13:\"enable_topbar\";s:0:\"\";s:23:\"hidden_topbar_in_mobile\";s:0:\"\";s:24:\"gen_enable_sticky_topbar\";s:0:\"\";s:10:\"topbar_bgr\";s:0:\"\";s:16:\"st_text_featured\";s:8:\"Featured\";s:19:\"st_text_featured_bg\";s:0:\"\";s:15:\"st_text_sale_bg\";s:0:\"\";s:17:\"general_style_tab\";s:0:\"\";s:12:\"style_layout\";s:4:\"wide\";s:10:\"typography\";a:0:{}s:10:\"star_color\";s:0:\"\";s:10:\"custom_css\";s:0:\"\";s:10:\"header_tab\";s:0:\"\";s:16:\"sort_header_menu\";a:2:{i:0;a:5:{s:5:\"title\";s:5:\"Login\";s:11:\"header_item\";s:5:\"login\";s:18:\"header_custom_link\";s:0:\"\";s:24:\"header_custom_link_title\";s:0:\"\";s:23:\"header_custom_link_icon\";s:0:\"\";}i:1;a:5:{s:5:\"title\";s:0:\"\";s:11:\"header_item\";s:0:\"\";s:18:\"header_custom_link\";s:0:\"\";s:24:\"header_custom_link_title\";s:0:\"\";s:23:\"header_custom_link_icon\";s:0:\"\";}}s:8:\"menu_bar\";s:0:\"\";s:7:\"top_bar\";s:0:\"\";s:16:\"sort_topbar_menu\";a:0:{}s:12:\"featured_tab\";s:0:\"\";s:13:\"st_ft_label_w\";s:0:\"\";s:12:\"st_sl_height\";s:0:\"\";s:18:\"enable_popup_login\";s:2:\"on\";s:25:\"page_my_account_dashboard\";i:30;s:28:\"page_redirect_to_after_login\";i:30;s:29:\"page_redirect_to_after_logout\";s:0:\"\";s:15:\"page_user_login\";s:0:\"\";s:18:\"page_user_register\";s:0:\"\";s:19:\"page_reset_password\";i:45;s:13:\"page_checkout\";i:24;s:20:\"page_payment_success\";i:36;s:18:\"page_order_confirm\";i:39;s:21:\"page_terms_conditions\";s:0:\"\";s:15:\"footer_template\";s:0:\"\";s:19:\"footer_template_new\";s:0:\"\";s:17:\"partner_info_page\";s:0:\"\";s:13:\"booking_modal\";s:0:\"\";s:22:\"booking_enable_captcha\";s:0:\"\";s:21:\"booking_card_accepted\";a:2:{i:0;a:2:{s:5:\"title\";s:4:\"Visa\";s:5:\"image\";s:63:\"http://localhost/tourphoria/wp-content/uploads/2021/02/visa.png\";}i:1;a:2:{s:5:\"title\";s:10:\"MasterCard\";s:5:\"image\";s:69:\"http://localhost/tourphoria/wp-content/uploads/2021/02/mastercard.png\";}}s:16:\"booking_currency\";a:2:{i:0;a:9:{s:5:\"title\";s:3:\"USD\";s:4:\"name\";s:3:\"USD\";s:6:\"symbol\";s:1:\"$\";s:4:\"rate\";s:0:\"\";s:20:\"booking_currency_pos\";s:4:\"left\";s:20:\"currency_rtl_support\";s:0:\"\";s:18:\"thousand_separator\";s:0:\"\";s:17:\"decimal_separator\";s:0:\"\";s:26:\"booking_currency_precision\";s:0:\"\";}i:1;a:9:{s:5:\"title\";s:0:\"\";s:4:\"name\";s:0:\"\";s:6:\"symbol\";s:0:\"\";s:4:\"rate\";s:0:\"\";s:20:\"booking_currency_pos\";s:4:\"left\";s:20:\"currency_rtl_support\";s:0:\"\";s:18:\"thousand_separator\";s:0:\"\";s:17:\"decimal_separator\";s:0:\"\";s:26:\"booking_currency_precision\";s:0:\"\";}}s:24:\"booking_primary_currency\";s:3:\"USD\";s:16:\"is_guest_booking\";s:2:\"on\";s:33:\"st_booking_enabled_create_account\";s:2:\"on\";s:25:\"guest_create_acc_required\";s:0:\"\";s:26:\"enable_send_message_button\";s:0:\"\";s:27:\"use_woocommerce_for_booking\";s:0:\"\";s:26:\"woo_checkout_show_shipping\";s:0:\"\";s:23:\"st_woo_cart_is_collapse\";s:0:\"\";s:10:\"tax_enable\";s:0:\"\";s:21:\"st_tax_include_enable\";s:0:\"\";s:9:\"tax_value\";s:0:\"\";s:14:\"invoice_enable\";s:0:\"\";s:28:\"invoice_show_link_page_order\";s:0:\"\";s:18:\"booking_fee_enable\";s:0:\"\";s:18:\"booking_fee_amount\";s:0:\"\";s:11:\"booking_tab\";s:0:\"\";s:27:\"booking_currency_conversion\";a:0:{}s:15:\"woocommerce_tab\";s:0:\"\";s:7:\"tax_tab\";s:0:\"\";s:11:\"invoice_tab\";s:0:\"\";s:12:\"invoice_logo\";s:0:\"\";s:20:\"invoice_company_name\";s:0:\"\";s:15:\"invoice_address\";s:0:\"\";s:20:\"invoice_phone_number\";s:0:\"\";s:11:\"invoice_zpc\";s:0:\"\";s:27:\"invoice_registration_number\";s:0:\"\";s:22:\"invoice_tax_vat_number\";s:0:\"\";s:15:\"booking_fee_tab\";s:0:\"\";s:16:\"booking_fee_type\";s:0:\"\";s:23:\"location_posts_per_page\";s:0:\"\";s:20:\"bc_show_location_url\";s:2:\"on\";s:21:\"bc_show_location_tree\";s:0:\"\";s:17:\"location_tab_type\";s:4:\"list\";s:18:\"tour_show_calendar\";s:2:\"on\";s:24:\"tour_show_calendar_below\";s:3:\"off\";s:20:\"activity_tour_review\";s:2:\"on\";s:17:\"tour_review_stats\";a:3:{i:0;a:2:{s:5:\"title\";s:5:\"Sleep\";s:4:\"name\";s:0:\"\";}i:1;a:2:{s:5:\"title\";s:7:\"Service\";s:4:\"name\";s:0:\"\";}i:2;a:2:{s:5:\"title\";s:0:\"\";s:4:\"name\";s:0:\"\";}}s:15:\"tours_layout_v2\";s:1:\"1\";s:19:\"tour_posts_per_page\";i:12;s:16:\"tour_sidebar_pos\";s:4:\"left\";s:23:\"is_featured_search_tour\";s:2:\"on\";s:27:\"activity_tour_search_fields\";a:0:{}s:25:\"tour_allow_search_advance\";s:2:\"on\";s:26:\"tour_advance_search_fields\";a:0:{}s:24:\"st_show_number_user_book\";s:0:\"\";s:19:\"st_show_number_avai\";s:0:\"\";s:24:\"st_tours_icon_map_marker\";s:63:\"http://localhost/tourphoria/wp-content/uploads/2021/02/tour.png\";s:24:\"tours_search_result_page\";i:42;s:19:\"tours_search_layout\";s:0:\"\";s:28:\"tours_unlimited_custom_field\";a:0:{}s:33:\"enable_automatic_approval_partner\";s:2:\"on\";s:26:\"enable_pretty_link_partner\";s:0:\"\";s:17:\"slug_partner_page\";s:0:\"\";s:25:\"partner_show_contact_info\";s:0:\"\";s:22:\"partner_enable_feature\";s:2:\"on\";s:21:\"partner_post_by_admin\";s:2:\"on\";s:18:\"admin_menu_partner\";s:0:\"\";s:19:\"partner_set_feature\";s:0:\"\";s:25:\"partner_set_external_link\";s:0:\"\";s:22:\"avatar_in_list_service\";s:0:\"\";s:25:\"display_list_partner_info\";a:0:{}s:17:\"enable_membership\";s:2:\"on\";s:21:\"partner_custom_layout\";s:2:\"on\";s:35:\"partner_custom_layout_total_earning\";s:2:\"on\";s:37:\"partner_custom_layout_service_earning\";s:2:\"on\";s:32:\"partner_custom_layout_chart_info\";s:2:\"on\";s:37:\"partner_custom_layout_booking_history\";s:2:\"on\";s:17:\"enable_withdrawal\";s:2:\"on\";s:35:\"partner_withdrawal_payout_price_min\";s:3:\"100\";s:30:\"partner_date_payout_this_month\";s:1:\"7\";s:12:\"enable_inbox\";s:0:\"\";s:25:\"enable_send_email_partner\";s:0:\"\";s:23:\"enable_send_email_buyer\";s:0:\"\";s:19:\"partner_general_tab\";s:0:\"\";s:21:\"patner_page_header_bg\";s:70:\"http://localhost/tourphoria/wp-content/uploads/2021/02/banner-bg-2.png\";s:18:\"partner_commission\";i:10;s:14:\"membership_tab\";s:0:\"\";s:20:\"member_packages_page\";s:0:\"\";s:20:\"member_checkout_page\";s:0:\"\";s:19:\"member_success_page\";s:0:\"\";s:25:\"partner_custom_layout_tab\";s:0:\"\";s:26:\"partner_withdrawal_options\";s:0:\"\";s:21:\"partner_inbox_options\";s:0:\"\";}', 'yes'),
(423, 'ot_media_post_ID', '26', 'yes'),
(424, 'woocommerce_meta_box_errors', 'a:0:{}', 'yes'),
(425, 'mc4wp_flash_messages', 'a:0:{}', 'no'),
(426, 'wc_remote_inbox_notifications_specs', 'a:12:{s:23:\"facebook_pixel_api_2021\";O:8:\"stdClass\":8:{s:4:\"slug\";s:23:\"facebook_pixel_api_2021\";s:4:\"type\";s:9:\"marketing\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:44:\"Improve the performance of your Facebook ads\";s:7:\"content\";s:168:\"Enable Facebook Pixel and Conversions API through the latest version of Facebook for WooCommerce for improved performance and measurement of your Facebook ad campaigns.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:30:\"upgrade_now_facebook_pixel_api\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:11:\"Upgrade now\";}}s:3:\"url\";s:67:\"plugin-install.php?tab=plugin-information&plugin=&section=changelog\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:3:{i:0;O:8:\"stdClass\":2:{s:4:\"type\";s:18:\"publish_after_time\";s:13:\"publish_after\";s:19:\"2021-02-15 00:00:00\";}i:1;O:8:\"stdClass\":2:{s:4:\"type\";s:19:\"publish_before_time\";s:14:\"publish_before\";s:19:\"2021-02-29 00:00:00\";}i:2;O:8:\"stdClass\":4:{s:4:\"type\";s:14:\"plugin_version\";s:6:\"plugin\";s:24:\"facebook-for-woocommerce\";s:7:\"version\";s:5:\"2.1.4\";s:8:\"operator\";s:2:\"<=\";}}}s:16:\"facebook_ec_2021\";O:8:\"stdClass\":8:{s:4:\"slug\";s:16:\"facebook_ec_2021\";s:4:\"type\";s:9:\"marketing\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:59:\"Sync your product catalog with Facebook to help boost sales\";s:7:\"content\";s:170:\"A single click adds all products to your Facebook Business Page shop. Product changes are automatically synced, with the flexibility to control which products are listed.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:22:\"learn_more_facebook_ec\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:42:\"https://woocommerce.com/products/facebook/\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:10:\"unactioned\";}}s:5:\"rules\";a:3:{i:0;O:8:\"stdClass\":2:{s:4:\"type\";s:18:\"publish_after_time\";s:13:\"publish_after\";s:19:\"2021-03-01 00:00:00\";}i:1;O:8:\"stdClass\":2:{s:4:\"type\";s:19:\"publish_before_time\";s:14:\"publish_before\";s:19:\"2021-03-15 00:00:00\";}i:2;O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:1:{i:0;s:24:\"facebook-for-woocommerce\";}}}}s:37:\"ecomm-need-help-setting-up-your-store\";O:8:\"stdClass\":8:{s:4:\"slug\";s:37:\"ecomm-need-help-setting-up-your-store\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:32:\"Need help setting up your Store?\";s:7:\"content\";s:350:\"Schedule a free 30-min <a href=\"https://wordpress.com/support/concierge-support/\">quick start session</a> and get help from our specialists. We’re happy to walk through setup steps, show you around the WordPress.com dashboard, troubleshoot any issues you may have, and help you the find the features you need to accomplish your goals for your site.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:16:\"set-up-concierge\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:21:\"Schedule free session\";}}s:3:\"url\";s:34:\"https://wordpress.com/me/concierge\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:1:{i:0;O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:3:{i:0;s:35:\"woocommerce-shipping-australia-post\";i:1;s:32:\"woocommerce-shipping-canada-post\";i:2;s:30:\"woocommerce-shipping-royalmail\";}}}}s:20:\"woocommerce-services\";O:8:\"stdClass\":8:{s:4:\"slug\";s:20:\"woocommerce-services\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:26:\"WooCommerce Shipping & Tax\";s:7:\"content\";s:255:\"WooCommerce Shipping & Tax helps get your store “ready to sell” as quickly as possible. You create your products. We take care of tax calculation, payment processing, and shipping label printing! Learn more about the extension that you just installed.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:10:\"learn-more\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:84:\"https://docs.woocommerce.com/document/woocommerce-shipping-and-tax/?utm_source=inbox\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:10:\"unactioned\";}}s:5:\"rules\";a:2:{i:0;O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:1:{i:0;s:20:\"woocommerce-services\";}}i:1;O:8:\"stdClass\":3:{s:4:\"type\";s:18:\"wcadmin_active_for\";s:9:\"operation\";s:1:\"<\";s:4:\"days\";i:2;}}}s:32:\"ecomm-unique-shopping-experience\";O:8:\"stdClass\":8:{s:4:\"slug\";s:32:\"ecomm-unique-shopping-experience\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:53:\"For a shopping experience as unique as your customers\";s:7:\"content\";s:274:\"Product Add-Ons allow your customers to personalize products while they’re shopping on your online store. No more follow-up email requests—customers get what they want, before they’re done checking out. Learn more about this extension that comes included in your plan.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:43:\"learn-more-ecomm-unique-shopping-experience\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:71:\"https://docs.woocommerce.com/document/product-add-ons/?utm_source=inbox\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:2:{i:0;O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:3:{i:0;s:35:\"woocommerce-shipping-australia-post\";i:1;s:32:\"woocommerce-shipping-canada-post\";i:2;s:30:\"woocommerce-shipping-royalmail\";}}i:1;O:8:\"stdClass\":3:{s:4:\"type\";s:18:\"wcadmin_active_for\";s:9:\"operation\";s:1:\"<\";s:4:\"days\";i:2;}}}s:37:\"wc-admin-getting-started-in-ecommerce\";O:8:\"stdClass\":8:{s:4:\"slug\";s:37:\"wc-admin-getting-started-in-ecommerce\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:38:\"Getting Started in eCommerce - webinar\";s:7:\"content\";s:174:\"We want to make eCommerce and this process of getting started as easy as possible for you. Watch this webinar to get tips on how to have our store up and running in a breeze.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:17:\"watch-the-webinar\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:17:\"Watch the webinar\";}}s:3:\"url\";s:28:\"https://youtu.be/V_2XtCOyZ7o\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:2:{i:0;O:8:\"stdClass\":4:{s:4:\"type\";s:18:\"onboarding_profile\";s:5:\"index\";s:12:\"setup_client\";s:9:\"operation\";s:2:\"!=\";s:5:\"value\";b:1;}i:1;O:8:\"stdClass\":2:{s:4:\"type\";s:2:\"or\";s:8:\"operands\";a:3:{i:0;O:8:\"stdClass\":4:{s:4:\"type\";s:18:\"onboarding_profile\";s:5:\"index\";s:13:\"product_count\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:1:\"0\";}i:1;O:8:\"stdClass\":4:{s:4:\"type\";s:18:\"onboarding_profile\";s:5:\"index\";s:7:\"revenue\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:4:\"none\";}i:2;O:8:\"stdClass\":4:{s:4:\"type\";s:18:\"onboarding_profile\";s:5:\"index\";s:7:\"revenue\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:10:\"up-to-2500\";}}}}}s:18:\"your-first-product\";O:8:\"stdClass\":8:{s:4:\"slug\";s:18:\"your-first-product\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:18:\"Your first product\";s:7:\"content\";s:461:\"That\'s huge! You\'re well on your way to building a successful online store — now it’s time to think about how you\'ll fulfill your orders.<br/><br/>Read our shipping guide to learn best practices and options for putting together your shipping strategy. And for WooCommerce stores in the United States, you can print discounted shipping labels via USPS with <a href=\"https://href.li/?https://woocommerce.com/shipping\" target=\"_blank\">WooCommerce Shipping</a>.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:10:\"learn-more\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:82:\"https://woocommerce.com/posts/ecommerce-shipping-solutions-guide/?utm_source=inbox\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:4:{i:0;O:8:\"stdClass\":4:{s:4:\"type\";s:12:\"stored_state\";s:5:\"index\";s:22:\"there_were_no_products\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";b:1;}i:1;O:8:\"stdClass\":4:{s:4:\"type\";s:12:\"stored_state\";s:5:\"index\";s:22:\"there_are_now_products\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";b:1;}i:2;O:8:\"stdClass\":3:{s:4:\"type\";s:13:\"product_count\";s:9:\"operation\";s:2:\">=\";s:5:\"value\";i:1;}i:3;O:8:\"stdClass\":4:{s:4:\"type\";s:18:\"onboarding_profile\";s:5:\"index\";s:13:\"product_types\";s:9:\"operation\";s:8:\"contains\";s:5:\"value\";s:8:\"physical\";}}}s:31:\"wc-square-apple-pay-boost-sales\";O:8:\"stdClass\":8:{s:4:\"slug\";s:31:\"wc-square-apple-pay-boost-sales\";s:4:\"type\";s:9:\"marketing\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:26:\"Boost sales with Apple Pay\";s:7:\"content\";s:191:\"Now that you accept Apple Pay® with Square you can increase conversion rates by letting your customers know that Apple Pay® is available. Here’s a marketing guide to help you get started.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:27:\"boost-sales-marketing-guide\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:19:\"See marketing guide\";}}s:3:\"url\";s:97:\"https://developer.apple.com/apple-pay/marketing/?utm_source=inbox&utm_campaign=square-boost-sales\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:5:{i:0;O:8:\"stdClass\":4:{s:4:\"type\";s:14:\"plugin_version\";s:6:\"plugin\";s:11:\"woocommerce\";s:8:\"operator\";s:2:\">=\";s:7:\"version\";s:3:\"4.8\";}i:1;O:8:\"stdClass\":4:{s:4:\"type\";s:14:\"plugin_version\";s:6:\"plugin\";s:18:\"woocommerce-square\";s:8:\"operator\";s:2:\">=\";s:7:\"version\";s:3:\"2.3\";}i:2;O:8:\"stdClass\":5:{s:4:\"type\";s:6:\"option\";s:11:\"option_name\";s:27:\"wc_square_apple_pay_enabled\";s:5:\"value\";i:1;s:7:\"default\";b:0;s:9:\"operation\";s:1:\"=\";}i:3;O:8:\"stdClass\":4:{s:4:\"type\";s:11:\"note_status\";s:9:\"note_name\";s:38:\"wc-square-apple-pay-grow-your-business\";s:6:\"status\";s:8:\"actioned\";s:9:\"operation\";s:2:\"!=\";}i:4;O:8:\"stdClass\":4:{s:4:\"type\";s:11:\"note_status\";s:9:\"note_name\";s:38:\"wc-square-apple-pay-grow-your-business\";s:6:\"status\";s:10:\"unactioned\";s:9:\"operation\";s:2:\"!=\";}}}s:38:\"wc-square-apple-pay-grow-your-business\";O:8:\"stdClass\":8:{s:4:\"slug\";s:38:\"wc-square-apple-pay-grow-your-business\";s:4:\"type\";s:9:\"marketing\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:45:\"Grow your business with Square and Apple Pay \";s:7:\"content\";s:178:\"Now more than ever, shoppers want a fast, simple, and secure online checkout experience. Increase conversion rates by letting your customers know that you now accept Apple Pay®.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:34:\"grow-your-business-marketing-guide\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:19:\"See marketing guide\";}}s:3:\"url\";s:104:\"https://developer.apple.com/apple-pay/marketing/?utm_source=inbox&utm_campaign=square-grow-your-business\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:5:{i:0;O:8:\"stdClass\":4:{s:4:\"type\";s:14:\"plugin_version\";s:6:\"plugin\";s:11:\"woocommerce\";s:8:\"operator\";s:2:\">=\";s:7:\"version\";s:3:\"4.8\";}i:1;O:8:\"stdClass\":4:{s:4:\"type\";s:14:\"plugin_version\";s:6:\"plugin\";s:18:\"woocommerce-square\";s:8:\"operator\";s:2:\">=\";s:7:\"version\";s:3:\"2.3\";}i:2;O:8:\"stdClass\":5:{s:4:\"type\";s:6:\"option\";s:11:\"option_name\";s:27:\"wc_square_apple_pay_enabled\";s:5:\"value\";i:2;s:7:\"default\";b:0;s:9:\"operation\";s:1:\"=\";}i:3;O:8:\"stdClass\":4:{s:4:\"type\";s:11:\"note_status\";s:9:\"note_name\";s:31:\"wc-square-apple-pay-boost-sales\";s:6:\"status\";s:8:\"actioned\";s:9:\"operation\";s:2:\"!=\";}i:4;O:8:\"stdClass\":4:{s:4:\"type\";s:11:\"note_status\";s:9:\"note_name\";s:31:\"wc-square-apple-pay-boost-sales\";s:6:\"status\";s:10:\"unactioned\";s:9:\"operation\";s:2:\"!=\";}}}s:37:\"wc-admin-optimizing-the-checkout-flow\";O:8:\"stdClass\":8:{s:4:\"slug\";s:37:\"wc-admin-optimizing-the-checkout-flow\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:28:\"Optimizing the checkout flow\";s:7:\"content\";s:171:\"It\'s crucial to get your store\'s checkout as smooth as possible to avoid losing sales. Let\'s take a look at how you can optimize the checkout experience for your shoppers.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:28:\"optimizing-the-checkout-flow\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:78:\"https://woocommerce.com/posts/optimizing-woocommerce-checkout?utm_source=inbox\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:2:{i:0;O:8:\"stdClass\":3:{s:4:\"type\";s:18:\"wcadmin_active_for\";s:9:\"operation\";s:1:\">\";s:4:\"days\";i:3;}i:1;O:8:\"stdClass\":4:{s:4:\"type\";s:6:\"option\";s:11:\"option_name\";s:45:\"woocommerce_task_list_tracked_completed_tasks\";s:9:\"operation\";s:8:\"contains\";s:5:\"value\";s:8:\"payments\";}}}s:39:\"wc-admin-first-five-things-to-customize\";O:8:\"stdClass\":8:{s:4:\"slug\";s:39:\"wc-admin-first-five-things-to-customize\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:45:\"The first 5 things to customize in your store\";s:7:\"content\";s:173:\"Deciding what to start with first is tricky. To help you properly prioritize, we\'ve put together this short list of the first few things you should customize in WooCommerce.\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:10:\"learn-more\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:10:\"Learn more\";}}s:3:\"url\";s:82:\"https://woocommerce.com/posts/first-things-customize-woocommerce/?utm_source=inbox\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:10:\"unactioned\";}}s:5:\"rules\";a:2:{i:0;O:8:\"stdClass\":3:{s:4:\"type\";s:18:\"wcadmin_active_for\";s:9:\"operation\";s:1:\">\";s:4:\"days\";i:2;}i:1;O:8:\"stdClass\":5:{s:4:\"type\";s:6:\"option\";s:11:\"option_name\";s:45:\"woocommerce_task_list_tracked_completed_tasks\";s:5:\"value\";s:9:\"NOT EMPTY\";s:7:\"default\";s:9:\"NOT EMPTY\";s:9:\"operation\";s:2:\"!=\";}}}s:38:\"wc-admin-effortless-payments-by-mollie\";O:8:\"stdClass\":8:{s:4:\"slug\";s:38:\"wc-admin-effortless-payments-by-mollie\";s:4:\"type\";s:4:\"info\";s:6:\"status\";s:10:\"unactioned\";s:12:\"is_snoozable\";i:0;s:6:\"source\";s:15:\"woocommerce.com\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":3:{s:6:\"locale\";s:5:\"en_US\";s:5:\"title\";s:29:\"Effortless payments by Mollie\";s:7:\"content\";s:111:\"Offer global and local payment methods, get onboarded in minutes and supported in your language – try it now!\";}}s:7:\"actions\";a:1:{i:0;O:8:\"stdClass\":6:{s:4:\"name\";s:14:\"install-mollie\";s:7:\"locales\";a:1:{i:0;O:8:\"stdClass\":2:{s:6:\"locale\";s:5:\"en_US\";s:5:\"label\";s:14:\"Install Mollie\";}}s:3:\"url\";s:62:\"https://wordpress.org/plugins/mollie-payments-for-woocommerce/\";s:18:\"url_is_admin_query\";b:0;s:10:\"is_primary\";b:1;s:6:\"status\";s:8:\"actioned\";}}s:5:\"rules\";a:5:{i:0;O:8:\"stdClass\":3:{s:4:\"type\";s:18:\"wcadmin_active_for\";s:9:\"operation\";s:1:\">\";s:4:\"days\";i:3;}i:1;O:8:\"stdClass\":2:{s:4:\"type\";s:2:\"or\";s:8:\"operands\";a:8:{i:0;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"DE\";}i:1;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"FR\";}i:2;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"NL\";}i:3;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"BE\";}i:4;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"IT\";}i:5;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"AT\";}i:6;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"FI\";}i:7;O:8:\"stdClass\":3:{s:4:\"type\";s:21:\"base_location_country\";s:9:\"operation\";s:1:\"=\";s:5:\"value\";s:2:\"CH\";}}}i:2;O:8:\"stdClass\":2:{s:4:\"type\";s:3:\"not\";s:7:\"operand\";O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:1:{i:0;s:31:\"klarna-payments-for-woocommerce\";}}}i:3;O:8:\"stdClass\":2:{s:4:\"type\";s:3:\"not\";s:7:\"operand\";O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:1:{i:0;s:43:\"woocommerce-gateway-paypal-express-checkout\";}}}i:4;O:8:\"stdClass\":2:{s:4:\"type\";s:3:\"not\";s:7:\"operand\";O:8:\"stdClass\":2:{s:4:\"type\";s:17:\"plugins_activated\";s:7:\"plugins\";a:1:{i:0;s:26:\"woocommerce-gateway-stripe\";}}}}}}', 'yes'),
(430, '_transient_timeout_wc_low_stock_count', '1616955822', 'no'),
(431, '_transient_wc_low_stock_count', '0', 'no'),
(432, '_transient_timeout_wc_outofstock_count', '1616955822', 'no'),
(433, '_transient_wc_outofstock_count', '0', 'no'),
(473, '_transient_health-check-site-status-result', '{\"good\":\"13\",\"recommended\":\"5\",\"critical\":\"2\"}', 'yes'),
(484, '_transient_woocommerce_reports-transient-version', '1614466311', 'yes'),
(485, '_transient_timeout_orders-all-statuses', '1615071111', 'no'),
(486, '_transient_orders-all-statuses', 'a:2:{s:7:\"version\";s:10:\"1614466311\";s:5:\"value\";a:0:{}}', 'no'),
(493, '_transient_wc_attribute_taxonomies', 'a:0:{}', 'yes'),
(510, '_transient_timeout_wc_term_counts', '1617058710', 'no'),
(511, '_transient_wc_term_counts', 'a:1:{i:15;s:0:\"\";}', 'no'),
(517, 'auto_update_plugins', 'a:1:{i:0;s:27:\"js_composer/js_composer.php\";}', 'no'),
(523, 'widget_st_widget_search_activity', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(524, 'widget_st_widget_search_cars', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(525, 'widget_st_widget_search_hotel', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(526, 'widget_st_widget_list_gallery', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(527, 'widget_st_widget_list_post', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(528, 'widget_st_widget_search_rental', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(529, 'widget_st_widget_search_tour', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(532, 'action_scheduler_migration_status', 'complete', 'yes'),
(566, 'widget_st_categories_new', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(604, 'st_tour_type_children', 'a:0:{}', 'yes'),
(606, 'st_allow_save_cache_location', 'allow', 'yes'),
(608, '_transient_product_query-transient-version', '1614495885', 'yes'),
(650, 'wpb_js_not_responsive_css', '1', 'yes'),
(651, 'wpb_js_google_fonts_subsets', 'a:1:{i:0;s:5:\"latin\";}', 'yes'),
(652, 'wpb_js_gutenberg_disable', '1', 'yes'),
(653, 'wpb_js_default_template_post_type', 'a:0:{}', 'yes'),
(794, 'nav_menu_options', 'a:2:{i:0;b:0;s:8:\"auto_add\";a:0:{}}', 'yes'),
(816, '_transient_timeout__woocommerce_helper_subscriptions', '1614848047', 'no'),
(817, '_transient__woocommerce_helper_subscriptions', 'a:0:{}', 'no'),
(818, '_site_transient_timeout_theme_roots', '1614848947', 'no'),
(819, '_site_transient_theme_roots', 'a:4:{s:8:\"traveler\";s:7:\"/themes\";s:14:\"twentynineteen\";s:7:\"/themes\";s:12:\"twentytwenty\";s:7:\"/themes\";s:15:\"twentytwentyone\";s:7:\"/themes\";}', 'no'),
(820, '_transient_timeout__woocommerce_helper_updates', '1614890347', 'no'),
(821, '_transient__woocommerce_helper_updates', 'a:4:{s:4:\"hash\";s:32:\"d751713988987e9331980363e24189ce\";s:7:\"updated\";i:1614847147;s:8:\"products\";a:0:{}s:6:\"errors\";a:1:{i:0;s:10:\"http-error\";}}', 'no'),
(823, '_site_transient_update_plugins', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1614847158;s:8:\"response\";a:1:{s:27:\"js_composer/js_composer.php\";O:8:\"stdClass\":6:{s:4:\"slug\";s:11:\"js_composer\";s:11:\"new_version\";s:3:\"6.6\";s:6:\"plugin\";s:27:\"js_composer/js_composer.php\";s:3:\"url\";s:0:\"\";s:7:\"package\";b:0;s:4:\"name\";s:21:\"WPBakery Page Builder\";}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:4:{s:36:\"contact-form-7/wp-contact-form-7.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:28:\"w.org/plugins/contact-form-7\";s:4:\"slug\";s:14:\"contact-form-7\";s:6:\"plugin\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:11:\"new_version\";s:3:\"5.4\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/contact-form-7/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/contact-form-7.5.4.zip\";s:5:\"icons\";a:3:{s:2:\"2x\";s:67:\"https://ps.w.org/contact-form-7/assets/icon-256x256.png?rev=2279696\";s:2:\"1x\";s:59:\"https://ps.w.org/contact-form-7/assets/icon.svg?rev=2339255\";s:3:\"svg\";s:59:\"https://ps.w.org/contact-form-7/assets/icon.svg?rev=2339255\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/contact-form-7/assets/banner-1544x500.png?rev=860901\";s:2:\"1x\";s:68:\"https://ps.w.org/contact-form-7/assets/banner-772x250.png?rev=880427\";}s:11:\"banners_rtl\";a:0:{}}s:37:\"mailchimp-for-wp/mailchimp-for-wp.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:30:\"w.org/plugins/mailchimp-for-wp\";s:4:\"slug\";s:16:\"mailchimp-for-wp\";s:6:\"plugin\";s:37:\"mailchimp-for-wp/mailchimp-for-wp.php\";s:11:\"new_version\";s:5:\"4.8.3\";s:3:\"url\";s:47:\"https://wordpress.org/plugins/mailchimp-for-wp/\";s:7:\"package\";s:65:\"https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.8.3.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/mailchimp-for-wp/assets/icon-256x256.png?rev=1224577\";s:2:\"1x\";s:69:\"https://ps.w.org/mailchimp-for-wp/assets/icon-128x128.png?rev=1224577\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:71:\"https://ps.w.org/mailchimp-for-wp/assets/banner-772x250.png?rev=1184706\";}s:11:\"banners_rtl\";a:0:{}}s:25:\"option-tree/ot-loader.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/option-tree\";s:4:\"slug\";s:11:\"option-tree\";s:6:\"plugin\";s:25:\"option-tree/ot-loader.php\";s:11:\"new_version\";s:5:\"2.7.3\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/option-tree/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/option-tree.2.7.3.zip\";s:5:\"icons\";a:1:{s:7:\"default\";s:62:\"https://s.w.org/plugins/geopattern-icon/option-tree_363534.svg\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:65:\"https://ps.w.org/option-tree/assets/banner-772x250.png?rev=845297\";}s:11:\"banners_rtl\";a:0:{}}s:27:\"woocommerce/woocommerce.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/woocommerce\";s:4:\"slug\";s:11:\"woocommerce\";s:6:\"plugin\";s:27:\"woocommerce/woocommerce.php\";s:11:\"new_version\";s:5:\"5.0.0\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/woocommerce/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/woocommerce.5.0.0.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=2366418\";s:2:\"1x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-128x128.png?rev=2366418\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=2366418\";s:2:\"1x\";s:66:\"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=2366418\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(829, '_transient_timeout_wc_report_sales_by_date', '1614933636', 'no'),
(830, '_transient_wc_report_sales_by_date', 'a:8:{s:32:\"c9c548a7c525cff1cfe98fd486b70a94\";a:0:{}s:32:\"1f57e4f6df98fdc5c646283fac69bb1c\";a:0:{}s:32:\"3f255c681510bb119244dd9e4f0adb94\";a:0:{}s:32:\"ab7c0198c90f935f2aee2373868595e0\";N;s:32:\"a43a57203e93cbd97ca342ffb072dbc6\";a:0:{}s:32:\"13f2505d5cf4da234b8afba530eb4e48\";a:0:{}s:32:\"be6bc05f71349d0c2bc5a01e86a6c052\";a:0:{}s:32:\"c0c706237e6cd8971d60969c45e514d1\";a:0:{}}', 'no'),
(831, '_transient_timeout_wc_admin_report', '1614933636', 'no'),
(832, '_transient_wc_admin_report', 'a:1:{s:32:\"6e095c4a593092176095a353a4307f69\";a:0:{}}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(13, 8, '_wp_page_template', 'templates/template-trip_types.php'),
(14, 9, '_wp_page_template', 'templates/template-destination.php'),
(15, 10, '_wp_page_template', 'templates/template-activities.php'),
(18, 20, 'min_price', ''),
(19, 20, 'rate_review', '0'),
(20, 20, '_form', '<label> Your name\n    [text* your-name] </label>\n\n<label> Your email\n    [email* your-email] </label>\n\n<label> Subject\n    [text* your-subject] </label>\n\n<label> Your message (optional)\n    [textarea your-message] </label>\n\n[submit \"Submit\"]'),
(21, 20, '_mail', 'a:8:{s:7:\"subject\";s:30:\"[_site_title] \"[your-subject]\"\";s:6:\"sender\";s:38:\"[_site_title] <kchaouanis26@gmail.com>\";s:4:\"body\";s:163:\"From: [your-name] <[your-email]>\nSubject: [your-subject]\n\nMessage Body:\n[your-message]\n\n-- \nThis e-mail was sent from a contact form on [_site_title] ([_site_url])\";s:9:\"recipient\";s:19:\"[_site_admin_email]\";s:18:\"additional_headers\";s:22:\"Reply-To: [your-email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(22, 20, '_mail_2', 'a:9:{s:6:\"active\";b:0;s:7:\"subject\";s:30:\"[_site_title] \"[your-subject]\"\";s:6:\"sender\";s:38:\"[_site_title] <kchaouanis26@gmail.com>\";s:4:\"body\";s:105:\"Message Body:\n[your-message]\n\n-- \nThis e-mail was sent from a contact form on [_site_title] ([_site_url])\";s:9:\"recipient\";s:12:\"[your-email]\";s:18:\"additional_headers\";s:29:\"Reply-To: [_site_admin_email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(23, 20, '_messages', 'a:12:{s:12:\"mail_sent_ok\";s:45:\"Thank you for your message. It has been sent.\";s:12:\"mail_sent_ng\";s:71:\"There was an error trying to send your message. Please try again later.\";s:16:\"validation_error\";s:61:\"One or more fields have an error. Please check and try again.\";s:4:\"spam\";s:71:\"There was an error trying to send your message. Please try again later.\";s:12:\"accept_terms\";s:69:\"You must accept the terms and conditions before sending your message.\";s:16:\"invalid_required\";s:22:\"The field is required.\";s:16:\"invalid_too_long\";s:22:\"The field is too long.\";s:17:\"invalid_too_short\";s:23:\"The field is too short.\";s:13:\"upload_failed\";s:46:\"There was an unknown error uploading the file.\";s:24:\"upload_file_type_invalid\";s:49:\"You are not allowed to upload files of this type.\";s:21:\"upload_file_too_large\";s:20:\"The file is too big.\";s:23:\"upload_failed_php_error\";s:38:\"There was an error uploading the file.\";}'),
(24, 20, '_additional_settings', NULL),
(25, 20, '_locale', 'en_US'),
(26, 21, '_wp_attached_file', 'woocommerce-placeholder.png'),
(27, 21, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1200;s:6:\"height\";i:1200;s:4:\"file\";s:27:\"woocommerce-placeholder.png\";s:5:\"sizes\";a:7:{s:6:\"medium\";a:4:{s:4:\"file\";s:35:\"woocommerce-placeholder-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:37:\"woocommerce-placeholder-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:35:\"woocommerce-placeholder-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:35:\"woocommerce-placeholder-768x768.png\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:37:\"woocommerce-placeholder-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:37:\"woocommerce-placeholder-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:6:{s:4:\"file\";s:35:\"woocommerce-placeholder-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:11:\"width_query\";i:300;s:12:\"height_query\";i:300;}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(28, 22, 'min_price', ''),
(29, 22, 'rate_review', '0'),
(30, 23, 'min_price', ''),
(31, 23, 'rate_review', '0'),
(32, 24, 'min_price', ''),
(33, 24, 'rate_review', '0'),
(34, 25, 'min_price', ''),
(35, 25, 'rate_review', '0'),
(36, 26, 'min_price', ''),
(37, 26, 'rate_review', '0'),
(38, 27, 'min_price', ''),
(39, 27, 'rate_review', '0'),
(40, 27, '_edit_lock', '1614495325:1'),
(41, 28, 'min_price', ''),
(42, 28, 'rate_review', '0'),
(43, 28, '_edit_lock', '1614466314:1'),
(44, 27, '_wp_page_template', 'template-home-modern.php'),
(45, 27, '_edit_last', '1'),
(46, 27, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(47, 27, 'custom_header_page', 'off'),
(48, 27, 'st_topbar_background_transparent', 'off'),
(49, 27, 'st_topbar_background', '#ffffff'),
(50, 27, 'custom_menu_style', 'off'),
(51, 27, 'st_menu_color', '#fff'),
(52, 27, 'custom_logo', 'off'),
(53, 27, 'custom_footer', 'off'),
(54, 27, 'st_footer_page', '22'),
(55, 27, '_wpb_vc_js_status', 'true'),
(56, 27, 'post_views_count', ''),
(57, 18, 'post_views_count', ''),
(58, 30, 'min_price', ''),
(59, 30, 'rate_review', '0'),
(60, 30, '_edit_lock', '1614479463:1'),
(61, 31, 'min_price', ''),
(62, 31, 'rate_review', '0'),
(63, 31, '_edit_lock', '1614477999:1'),
(64, 30, '_wp_page_template', 'template-user.php'),
(65, 30, '_edit_last', '1'),
(66, 30, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(67, 30, 'custom_header_page', 'off'),
(68, 30, 'st_topbar_background_transparent', 'off'),
(69, 30, 'st_topbar_background', '#ffffff'),
(70, 30, 'custom_menu_style', 'off'),
(71, 30, 'st_menu_color', '#fff'),
(72, 30, 'custom_logo', 'off'),
(73, 30, 'custom_footer', 'off'),
(74, 30, 'st_footer_page', '27'),
(75, 30, '_wpb_vc_js_status', 'false'),
(76, 30, 'post_views_count', ''),
(77, 33, 'min_price', ''),
(78, 33, 'rate_review', '0'),
(79, 33, '_edit_lock', '1614478292:1'),
(80, 34, 'min_price', ''),
(81, 34, 'rate_review', '0'),
(82, 34, '_edit_lock', '1614478265:1'),
(83, 33, '_wp_page_template', 'template-register.php'),
(84, 33, '_edit_last', '1'),
(85, 33, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(86, 33, 'custom_header_page', 'off'),
(87, 33, 'st_topbar_background_transparent', 'off'),
(88, 33, 'st_topbar_background', '#ffffff'),
(89, 33, 'custom_menu_style', 'off'),
(90, 33, 'st_menu_color', '#fff'),
(91, 33, 'custom_logo', 'off'),
(92, 33, 'custom_footer', 'off'),
(93, 33, 'st_footer_page', '30'),
(94, 33, '_wpb_vc_js_status', 'false'),
(95, 36, 'min_price', ''),
(96, 36, 'rate_review', '0'),
(97, 36, '_edit_lock', '1614478368:1'),
(98, 37, 'min_price', ''),
(99, 37, 'rate_review', '0'),
(100, 37, '_edit_lock', '1614478326:1'),
(101, 36, '_wp_page_template', 'template-payment-success.php'),
(102, 36, '_edit_last', '1'),
(103, 36, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(104, 36, 'custom_header_page', 'off'),
(105, 36, 'st_topbar_background_transparent', 'off'),
(106, 36, 'st_topbar_background', '#ffffff'),
(107, 36, 'custom_menu_style', 'off'),
(108, 36, 'st_menu_color', '#fff'),
(109, 36, 'custom_logo', 'off'),
(110, 36, 'custom_footer', 'off'),
(111, 36, 'st_footer_page', '33'),
(112, 36, '_wpb_vc_js_status', 'false'),
(113, 39, 'min_price', ''),
(114, 39, 'rate_review', '0'),
(115, 39, '_edit_lock', '1614478516:1'),
(116, 40, 'min_price', ''),
(117, 40, 'rate_review', '0'),
(118, 40, '_edit_lock', '1614478415:1'),
(119, 39, '_wp_page_template', 'template-confirm.php'),
(120, 39, '_edit_last', '1'),
(121, 39, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(122, 39, 'custom_header_page', 'off'),
(123, 39, 'st_topbar_background_transparent', 'off'),
(124, 39, 'st_topbar_background', '#ffffff'),
(125, 39, 'custom_menu_style', 'off'),
(126, 39, 'st_menu_color', '#fff'),
(127, 39, 'custom_logo', 'off'),
(128, 39, 'custom_footer', 'off'),
(129, 39, 'st_footer_page', '36'),
(130, 39, '_wpb_vc_js_status', 'false'),
(131, 39, 'post_views_count', ''),
(132, 42, 'min_price', ''),
(133, 42, 'rate_review', '0'),
(134, 42, '_edit_lock', '1614478873:1'),
(135, 43, 'min_price', ''),
(136, 43, 'rate_review', '0'),
(137, 43, '_edit_lock', '1614478669:1'),
(138, 42, '_wp_page_template', 'template-hotel-search.php'),
(139, 42, '_edit_last', '1'),
(140, 42, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(141, 42, 'custom_header_page', 'off'),
(142, 42, 'st_topbar_background_transparent', 'off'),
(143, 42, 'st_topbar_background', '#ffffff'),
(144, 42, 'custom_menu_style', 'off'),
(145, 42, 'st_menu_color', '#fff'),
(146, 42, 'custom_logo', 'off'),
(147, 42, 'custom_footer', 'off'),
(148, 42, 'st_footer_page', '39'),
(149, 42, '_wpb_vc_js_status', 'false'),
(150, 42, 'post_views_count', ''),
(151, 45, 'min_price', ''),
(152, 45, 'rate_review', '0'),
(153, 45, '_edit_lock', '1614479055:1'),
(154, 46, 'min_price', ''),
(155, 46, 'rate_review', '0'),
(156, 46, '_edit_lock', '1614479027:1'),
(157, 45, '_wp_page_template', 'template-reset-pasword.php'),
(158, 45, '_edit_last', '1'),
(159, 45, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(160, 45, 'custom_header_page', 'off'),
(161, 45, 'st_topbar_background_transparent', 'off'),
(162, 45, 'st_topbar_background', '#ffffff'),
(163, 45, 'custom_menu_style', 'off'),
(164, 45, 'st_menu_color', '#fff'),
(165, 45, 'custom_logo', 'off'),
(166, 45, 'custom_footer', 'off'),
(167, 45, 'st_footer_page', '42'),
(168, 45, '_wpb_vc_js_status', 'false'),
(169, 27, 'rs_layout', '1'),
(170, 27, 'rs_style', 'grid'),
(171, 27, 'rs_filter', 'a:5:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:10:\"Hotel Star\";s:14:\"rs_filter_type\";s:10:\"hotel_star\";}i:3;a:2:{s:5:\"title\";s:10:\"Facilities\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}i:4;a:2:{s:5:\"title\";s:11:\"Hotel Theme\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(172, 27, 'rs_layout_tour', '1'),
(173, 27, 'rs_style_tour', 'grid'),
(174, 27, 'rs_filter_tour', 'a:3:{i:0;a:3:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}i:1;a:3:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}i:2;a:3:{s:5:\"title\";s:10:\"Categories\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}}'),
(175, 27, 'rs_layout_activity', '1'),
(176, 27, 'rs_style_activity', 'grid'),
(177, 27, 'rs_filter_activity', 'a:3:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:11:\"Attractions\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(178, 27, 'rs_layout_rental', '1'),
(179, 27, 'rs_style_rental', 'grid'),
(180, 27, 'rs_filter_rental', 'a:3:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:16:\"Rental Amenities\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(181, 27, 'rs_layout_car', '1'),
(182, 27, 'rs_style_car', 'list'),
(183, 27, 'rs_filter_car', 'a:2:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:10:\"Categories\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(184, 48, '_wp_attached_file', '2021/02/mastercard.png'),
(185, 48, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:45;s:6:\"height\";i:28;s:4:\"file\";s:22:\"2021/02/mastercard.png\";s:5:\"sizes\";a:12:{s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"mastercard-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:24:\"mastercard-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"mastercard-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"mastercard-768x477.png\";s:5:\"width\";i:768;s:6:\"height\";i:477;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:24:\"mastercard-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:24:\"mastercard-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:22:\"mastercard-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:22:\"mastercard-600x373.png\";s:5:\"width\";i:600;s:6:\"height\";i:373;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:22:\"mastercard-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:22:\"mastercard-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:22:\"mastercard-600x373.png\";s:5:\"width\";i:600;s:6:\"height\";i:373;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:22:\"mastercard-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(186, 49, '_wp_attached_file', '2021/02/visa.png'),
(187, 49, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:45;s:6:\"height\";i:28;s:4:\"file\";s:16:\"2021/02/visa.png\";s:5:\"sizes\";a:12:{s:6:\"medium\";a:4:{s:4:\"file\";s:16:\"visa-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:18:\"visa-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:16:\"visa-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:16:\"visa-768x477.png\";s:5:\"width\";i:768;s:6:\"height\";i:477;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:18:\"visa-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:18:\"visa-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:16:\"visa-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:16:\"visa-600x373.png\";s:5:\"width\";i:600;s:6:\"height\";i:373;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:16:\"visa-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:16:\"visa-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:16:\"visa-600x373.png\";s:5:\"width\";i:600;s:6:\"height\";i:373;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:16:\"visa-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(188, 50, '_wp_attached_file', '2021/02/tour.png'),
(189, 50, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:44;s:6:\"height\";i:48;s:4:\"file\";s:16:\"2021/02/tour.png\";s:5:\"sizes\";a:12:{s:6:\"medium\";a:4:{s:4:\"file\";s:16:\"tour-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:18:\"tour-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:16:\"tour-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:16:\"tour-768x837.png\";s:5:\"width\";i:768;s:6:\"height\";i:837;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:18:\"tour-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:18:\"tour-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:16:\"tour-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:16:\"tour-600x654.png\";s:5:\"width\";i:600;s:6:\"height\";i:654;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:16:\"tour-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:16:\"tour-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:16:\"tour-600x654.png\";s:5:\"width\";i:600;s:6:\"height\";i:654;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:16:\"tour-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(190, 51, '_wp_attached_file', '2021/02/banner-bg-2.png'),
(191, 51, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1440;s:6:\"height\";i:550;s:4:\"file\";s:23:\"2021/02/banner-bg-2.png\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-768x293.png\";s:5:\"width\";i:768;s:6:\"height\";i:293;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:23:\"banner-bg-2-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-600x229.png\";s:5:\"width\";i:600;s:6:\"height\";i:229;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-600x229.png\";s:5:\"width\";i:600;s:6:\"height\";i:229;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-870x555.png\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:9:\"image/png\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:23:\"banner-bg-2-800x600.png\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(192, 52, 'min_price', ''),
(193, 52, 'rate_review', '0'),
(194, 53, 'min_price', ''),
(195, 53, 'rate_review', '0'),
(196, 52, '_edit_last', '1'),
(197, 52, '_edit_lock', '1614481935:1'),
(198, 54, '_wp_attached_file', '2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017.jpg'),
(199, 54, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:825;s:6:\"height\";i:550;s:4:\"file\";s:82:\"2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017.jpg\";s:5:\"sizes\";a:16:{s:6:\"medium\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"266x266\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-266x266.jpg\";s:5:\"width\";i:266;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"263x197\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-263x197.jpg\";s:5:\"width\";i:263;s:6:\"height\";i:197;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"260x200\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-260x200.jpg\";s:5:\"width\";i:260;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"370x370\";a:4:{s:4:\"file\";s:82:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-370x370.jpg\";s:5:\"width\";i:370;s:6:\"height\";i:370;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:12:\"TriggerPhoto\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(200, 52, '_thumbnail_id', '54'),
(201, 52, 'logo', 'http://localhost/tourphoria/wp-content/uploads/2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017.jpg'),
(202, 52, 'is_featured', 'on'),
(203, 52, 'location_country', 'US'),
(204, 52, 'st_google_map', 'a:4:{s:3:\"lat\";s:17:\"40.65033829051721\";s:3:\"lng\";s:18:\"-74.09301553527857\";s:4:\"zoom\";s:1:\"4\";s:4:\"type\";s:7:\"roadmap\";}'),
(205, 52, 'st_location_use_build_layout', 'off'),
(206, 52, 'is_gallery', 'on'),
(207, 52, 'is_tabs', 'on'),
(208, 52, 'location_tab_item', 'a:3:{i:0;a:9:{s:5:\"title\";s:11:\"Information\";s:9:\"tab_icon_\";s:10:\"fa fa-info\";s:8:\"tab_type\";s:11:\"information\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:1;a:9:{s:5:\"title\";s:3:\"Map\";s:9:\"tab_icon_\";s:16:\"fa fa-map-marker\";s:8:\"tab_type\";s:6:\"st_map\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:2;a:9:{s:5:\"title\";s:4:\"Tour\";s:9:\"tab_icon_\";s:12:\"fa fa-flag-o\";s:8:\"tab_type\";s:8:\"st_tours\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}}'),
(209, 52, 'info_location_tab_item_position', 'top'),
(210, 52, 'map_lat', '40.65033829051721'),
(211, 52, 'map_lng', '-74.09301553527857'),
(212, 52, 'map_zoom', '4'),
(213, 52, 'map_type', 'roadmap'),
(214, 55, 'min_price', ''),
(215, 55, 'rate_review', '0'),
(216, 56, 'min_price', ''),
(217, 56, 'rate_review', '0'),
(218, 55, '_edit_last', '1'),
(219, 55, '_edit_lock', '1614482097:1'),
(220, 57, '_wp_attached_file', '2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1.jpg'),
(221, 57, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:825;s:6:\"height\";i:550;s:4:\"file\";s:84:\"2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1.jpg\";s:5:\"sizes\";a:17:{s:6:\"medium\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"266x266\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-266x266.jpg\";s:5:\"width\";i:266;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"263x197\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-263x197.jpg\";s:5:\"width\";i:263;s:6:\"height\";i:197;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"260x200\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-260x200.jpg\";s:5:\"width\";i:260;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"370x370\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1-370x370.jpg\";s:5:\"width\";i:370;s:6:\"height\";i:370;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:12:\"TriggerPhoto\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(222, 55, '_thumbnail_id', '57'),
(223, 55, 'logo', 'http://localhost/tourphoria/wp-content/uploads/2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1.jpg'),
(224, 55, 'is_featured', 'off'),
(225, 55, 'location_country', 'US'),
(226, 55, 'st_google_map', 'a:4:{s:3:\"lat\";s:17:\"40.71951615778414\";s:3:\"lng\";s:18:\"-74.04378358584913\";s:4:\"zoom\";s:1:\"8\";s:4:\"type\";s:7:\"roadmap\";}'),
(227, 55, 'st_location_use_build_layout', 'off'),
(228, 55, 'is_gallery', 'on'),
(229, 55, 'is_tabs', 'on'),
(230, 55, 'location_tab_item', 'a:3:{i:0;a:9:{s:5:\"title\";s:11:\"Information\";s:9:\"tab_icon_\";s:10:\"fa fa-info\";s:8:\"tab_type\";s:11:\"information\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:1;a:9:{s:5:\"title\";s:3:\"Map\";s:9:\"tab_icon_\";s:16:\"fa fa-map-marker\";s:8:\"tab_type\";s:6:\"st_map\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:2;a:9:{s:5:\"title\";s:4:\"Tour\";s:9:\"tab_icon_\";s:12:\"fa fa-flag-o\";s:8:\"tab_type\";s:8:\"st_tours\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}}'),
(231, 55, 'info_location_tab_item_position', 'top'),
(232, 55, 'map_lat', '40.71951615778414'),
(233, 55, 'map_lng', '-74.04378358584913'),
(234, 55, 'map_zoom', '8'),
(235, 55, 'map_type', 'roadmap'),
(236, 58, 'min_price', ''),
(237, 58, 'rate_review', '0'),
(238, 59, 'min_price', ''),
(239, 59, 'rate_review', '0'),
(240, 58, '_edit_last', '1'),
(241, 58, '_edit_lock', '1614482220:1'),
(242, 60, '_wp_attached_file', '2021/02/united.jpg'),
(243, 60, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1500;s:6:\"height\";i:844;s:4:\"file\";s:18:\"2021/02/united.jpg\";s:5:\"sizes\";a:17:{s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"united-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:20:\"united-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"united-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"united-768x432.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:432;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:20:\"united-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:20:\"united-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:18:\"united-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:18:\"united-600x337.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:337;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:18:\"united-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:18:\"united-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:18:\"united-600x337.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:337;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:18:\"united-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"266x266\";a:4:{s:4:\"file\";s:18:\"united-266x266.jpg\";s:5:\"width\";i:266;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:18:\"united-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"263x197\";a:4:{s:4:\"file\";s:18:\"united-263x197.jpg\";s:5:\"width\";i:263;s:6:\"height\";i:197;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"260x200\";a:4:{s:4:\"file\";s:18:\"united-260x200.jpg\";s:5:\"width\";i:260;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"370x370\";a:4:{s:4:\"file\";s:18:\"united-370x370.jpg\";s:5:\"width\";i:370;s:6:\"height\";i:370;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(244, 58, '_thumbnail_id', '60'),
(245, 58, 'logo', 'http://localhost/tourphoria/wp-content/uploads/2021/02/united.jpg'),
(246, 58, 'is_featured', 'off'),
(247, 58, 'location_country', 'US'),
(248, 58, 'st_google_map', 'a:4:{s:3:\"lat\";s:18:\"37.778967150086075\";s:3:\"lng\";s:19:\"-122.32793013248238\";s:4:\"zoom\";s:1:\"6\";s:4:\"type\";s:7:\"roadmap\";}'),
(249, 58, 'st_location_use_build_layout', 'off'),
(250, 58, 'is_gallery', 'on'),
(251, 58, 'is_tabs', 'on'),
(252, 58, 'location_tab_item', 'a:3:{i:0;a:9:{s:5:\"title\";s:11:\"Information\";s:9:\"tab_icon_\";s:10:\"fa fa-info\";s:8:\"tab_type\";s:11:\"information\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:1;a:9:{s:5:\"title\";s:3:\"Map\";s:9:\"tab_icon_\";s:16:\"fa fa-map-marker\";s:8:\"tab_type\";s:6:\"st_map\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}i:2;a:9:{s:5:\"title\";s:4:\"Tour\";s:9:\"tab_icon_\";s:12:\"fa fa-flag-o\";s:8:\"tab_type\";s:8:\"st_tours\";s:10:\"map_height\";s:3:\"500\";s:9:\"map_spots\";s:3:\"500\";s:18:\"map_location_style\";s:6:\"normal\";s:19:\"information_content\";s:7:\"content\";s:17:\"hight_light_posts\";s:1:\"1\";s:12:\"tab_item_key\";s:0:\"\";}}'),
(253, 58, 'info_location_tab_item_position', 'top'),
(254, 58, 'map_lat', '37.778967150086075'),
(255, 58, 'map_lng', '-122.32793013248238'),
(256, 58, 'map_zoom', '6'),
(257, 58, 'map_type', 'roadmap'),
(258, 61, 'sale_price', '100'),
(259, 61, 'min_price', '0'),
(260, 61, 'rate_review', '0'),
(261, 62, 'sale_price', ''),
(262, 62, 'min_price', ''),
(263, 62, 'rate_review', '0'),
(264, 61, '_edit_last', '1'),
(265, 61, '_edit_lock', '1614483070:1'),
(266, 63, '_wp_attached_file', '2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2.jpg'),
(267, 63, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:825;s:6:\"height\";i:550;s:4:\"file\";s:84:\"2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:86:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:84:\"Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:12:\"TriggerPhoto\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(268, 64, '_wp_attached_file', '2021/02/Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1.jpg'),
(269, 64, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:870;s:6:\"height\";i:555;s:4:\"file\";s:113:\"2021/02/Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1.jpg\";s:5:\"sizes\";a:16:{s:6:\"medium\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:115:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-768x489.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:489;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:115:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:115:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-600x382.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:382;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-600x382.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:382;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"266x266\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-266x266.jpg\";s:5:\"width\";i:266;s:6:\"height\";i:266;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"180x135\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-180x135.jpg\";s:5:\"width\";i:180;s:6:\"height\";i:135;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"680x500\";a:4:{s:4:\"file\";s:113:\"Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1-680x500.jpg\";s:5:\"width\";i:680;s:6:\"height\";i:500;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(270, 65, '_wp_attached_file', '2021/02/TheCommonWanderer_-870x555-1.jpg');
INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(271, 65, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:870;s:6:\"height\";i:555;s:4:\"file\";s:40:\"2021/02/TheCommonWanderer_-870x555-1.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:42:\"TheCommonWanderer_-870x555-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-768x489.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:489;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:42:\"TheCommonWanderer_-870x555-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:42:\"TheCommonWanderer_-870x555-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-600x382.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:382;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-600x382.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:382;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:40:\"TheCommonWanderer_-870x555-1-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(272, 66, '_wp_attached_file', '2021/02/tour_img-1355873-145-1.jpg'),
(273, 66, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:640;s:4:\"file\";s:34:\"2021/02/tour_img-1355873-145-1.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:36:\"tour_img-1355873-145-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:36:\"tour_img-1355873-145-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:36:\"tour_img-1355873-145-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:34:\"tour_img-1355873-145-1-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(274, 67, '_wp_attached_file', '2021/02/tour_img-1355897-145-1.jpg'),
(275, 67, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:640;s:4:\"file\";s:34:\"2021/02/tour_img-1355897-145-1.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:36:\"tour_img-1355897-145-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:36:\"tour_img-1355897-145-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:36:\"tour_img-1355897-145-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:34:\"tour_img-1355897-145-1-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(276, 68, '_wp_attached_file', '2021/02/tour_img-1355906-145.jpg'),
(277, 68, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:960;s:6:\"height\";i:640;s:4:\"file\";s:32:\"2021/02/tour_img-1355906-145.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:34:\"tour_img-1355906-145-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-768x512.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:512;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:34:\"tour_img-1355906-145-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:34:\"tour_img-1355906-145-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:32:\"tour_img-1355906-145-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-600x400.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:400;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"870x555\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-870x555.jpg\";s:5:\"width\";i:870;s:6:\"height\";i:555;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:32:\"tour_img-1355906-145-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(278, 69, '_wp_attached_file', '2021/02/tour-1@2x.png'),
(279, 69, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:740;s:6:\"height\";i:480;s:4:\"file\";s:21:\"2021/02/tour-1@2x.png\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:23:\"tour-1@2x-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-768x498.png\";s:5:\"width\";i:768;s:6:\"height\";i:498;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:23:\"tour-1@2x-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:23:\"tour-1@2x-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:21:\"tour-1@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-600x389.png\";s:5:\"width\";i:600;s:6:\"height\";i:389;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-600x389.png\";s:5:\"width\";i:600;s:6:\"height\";i:389;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:21:\"tour-1@2x-800x600.png\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(280, 70, '_wp_attached_file', '2021/02/tour-2@2x.png'),
(281, 70, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:740;s:6:\"height\";i:480;s:4:\"file\";s:21:\"2021/02/tour-2@2x.png\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:23:\"tour-2@2x-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-768x498.png\";s:5:\"width\";i:768;s:6:\"height\";i:498;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:23:\"tour-2@2x-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:23:\"tour-2@2x-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:21:\"tour-2@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-600x389.png\";s:5:\"width\";i:600;s:6:\"height\";i:389;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-600x389.png\";s:5:\"width\";i:600;s:6:\"height\";i:389;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:21:\"tour-2@2x-800x600.png\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(282, 61, '_thumbnail_id', '64'),
(283, 61, 'is_featured', 'on'),
(284, 61, 'st_google_map', 'a:4:{s:3:\"lat\";s:18:\"45.596429226305816\";s:3:\"lng\";s:11:\"-74.2890625\";s:4:\"zoom\";s:1:\"1\";s:4:\"type\";s:7:\"roadmap\";}'),
(285, 61, 'discount_type', 'percent'),
(286, 61, 'multi_location', '_52_,_55_'),
(287, 61, 'address', 'new york'),
(288, 61, 'enable_street_views_google_map', 'on'),
(289, 61, 'tour_price_by', 'person'),
(290, 61, 'discount_by_people_type', 'percent'),
(291, 61, 'hide_adult_in_booking_form', 'off'),
(292, 61, 'hide_children_in_booking_form', 'off'),
(293, 61, 'hide_infant_in_booking_form', 'off'),
(294, 61, 'disable_adult_name', 'off'),
(295, 61, 'disable_children_name', 'off'),
(296, 61, 'disable_infant_name', 'off'),
(297, 61, 'is_sale_schedule', 'off'),
(298, 61, 'type_tour', 'daily_tour'),
(299, 61, 'tours_booking_period', '0'),
(300, 61, 'st_tour_external_booking', 'off'),
(301, 61, 'min_people', '1'),
(302, 61, 'tours_program_style', 'style1'),
(303, 61, 'st_allow_cancel', 'off'),
(304, 61, 'st_cancel_percent', '0'),
(305, 61, 'is_meta_payment_gateway_st_submit_form', 'on'),
(306, 61, 'map_lat', '45.596429226305816'),
(307, 61, 'map_lng', '-74.2890625'),
(308, 61, 'map_zoom', '1'),
(309, 61, 'map_type', 'roadmap'),
(310, 61, 'id_location', ''),
(311, 61, 'gallery', '66,57,63,65,67,68,51'),
(312, 61, 'st_custom_layout_new', '2'),
(313, 61, 'show_agent_contact_info', 'user_item_info'),
(314, 61, 'contact_email', 'kchaouanis25@gmail.com'),
(315, 61, 'website', '30 Rue du Manège'),
(316, 61, 'phone', '0643824870'),
(317, 61, 'adult_price', '100'),
(318, 61, 'child_price', '10'),
(319, 61, 'infant_price', '0'),
(320, 61, 'post_views_count', ''),
(321, 82, '_wpb_shortcodes_custom_css', '.vc_custom_1614487119436{margin-right: 0px !important;margin-left: 0px !important;}'),
(323, 83, '_wpb_shortcodes_custom_css', '.vc_custom_1614487311785{margin-right: 0px !important;margin-left: 0px !important;}'),
(324, 27, 'post_sidebar_pos', 'no'),
(325, 84, '_wpb_shortcodes_custom_css', '.vc_custom_1614487311785{margin-right: 0px !important;margin-left: 0px !important;}'),
(326, 27, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(327, 85, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(328, 86, '_wp_attached_file', '2021/02/106355_a16e498a.jpg'),
(329, 86, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1015;s:6:\"height\";i:716;s:4:\"file\";s:27:\"2021/02/106355_a16e498a.jpg\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:29:\"106355_a16e498a-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-768x541.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:541;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:29:\"106355_a16e498a-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:29:\"106355_a16e498a-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:27:\"106355_a16e498a-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-600x423.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:423;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-600x423.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:423;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:27:\"106355_a16e498a-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(330, 87, '_wp_attached_file', '2021/02/banner-bg-2-1.png'),
(331, 87, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1440;s:6:\"height\";i:550;s:4:\"file\";s:25:\"2021/02/banner-bg-2-1.png\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:5:\"large\";a:4:{s:4:\"file\";s:27:\"banner-bg-2-1-1024x1024.png\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-768x293.png\";s:5:\"width\";i:768;s:6:\"height\";i:293;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:27:\"banner-bg-2-1-1536x1536.png\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:9:\"image/png\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:27:\"banner-bg-2-1-2048x2048.png\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:9:\"image/png\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:25:\"banner-bg-2-1-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-600x229.png\";s:5:\"width\";i:600;s:6:\"height\";i:229;s:9:\"mime-type\";s:9:\"image/png\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-300x300.png\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-600x229.png\";s:5:\"width\";i:600;s:6:\"height\";i:229;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-100x100.png\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:9:\"image/png\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:25:\"banner-bg-2-1-800x600.png\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(332, 88, '_wp_attached_file', '2021/02/detail_2.jpg'),
(333, 88, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1600;s:6:\"height\";i:1066;s:4:\"file\";s:20:\"2021/02/detail_2.jpg\";s:5:\"sizes\";a:14:{s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"detail_2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"detail_2-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_2-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"detail_2-768x511.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:511;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:22:\"detail_2-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:22:\"detail_2-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:20:\"detail_2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:20:\"detail_2-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:20:\"detail_2-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:20:\"detail_2-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_2-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:20:\"detail_2-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"262x197\";a:4:{s:4:\"file\";s:20:\"detail_2-262x197.jpg\";s:5:\"width\";i:262;s:6:\"height\";i:197;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(334, 89, '_wp_attached_file', '2021/02/detail_4.jpg'),
(335, 89, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1600;s:6:\"height\";i:1066;s:4:\"file\";s:20:\"2021/02/detail_4.jpg\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"detail_4-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"detail_4-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_4-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"detail_4-768x511.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:511;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:22:\"detail_4-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:22:\"detail_4-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:20:\"detail_4-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:20:\"detail_4-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_4-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:20:\"detail_4-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:20:\"detail_4-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_4-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:20:\"detail_4-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(336, 90, '_wp_attached_file', '2021/02/detail_5.jpg'),
(337, 90, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1600;s:6:\"height\";i:1066;s:4:\"file\";s:20:\"2021/02/detail_5.jpg\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"detail_5-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"detail_5-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_5-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"detail_5-768x511.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:511;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:22:\"detail_5-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:22:\"detail_5-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:20:\"detail_5-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:20:\"detail_5-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_5-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:20:\"detail_5-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:20:\"detail_5-600x399.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:399;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:20:\"detail_5-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:20:\"detail_5-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(338, 91, '_wp_attached_file', '2021/02/united-1.jpg'),
(339, 91, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:1500;s:6:\"height\";i:844;s:4:\"file\";s:20:\"2021/02/united-1.jpg\";s:5:\"sizes\";a:13:{s:6:\"medium\";a:4:{s:4:\"file\";s:20:\"united-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:22:\"united-1-1024x1024.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:1024;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:20:\"united-1-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:20:\"united-1-768x432.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:432;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"1536x1536\";a:4:{s:4:\"file\";s:22:\"united-1-1536x1536.jpg\";s:5:\"width\";i:1536;s:6:\"height\";i:1536;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"2048x2048\";a:4:{s:4:\"file\";s:22:\"united-1-2048x2048.jpg\";s:5:\"width\";i:2048;s:6:\"height\";i:2048;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:21:\"woocommerce_thumbnail\";a:5:{s:4:\"file\";s:20:\"united-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";s:9:\"uncropped\";b:0;}s:18:\"woocommerce_single\";a:4:{s:4:\"file\";s:20:\"united-1-600x337.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:337;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_gallery_thumbnail\";a:4:{s:4:\"file\";s:20:\"united-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:20:\"united-1-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:20:\"united-1-600x337.jpg\";s:5:\"width\";i:600;s:6:\"height\";i:337;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:20:\"united-1-100x100.jpg\";s:5:\"width\";i:100;s:6:\"height\";i:100;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:7:\"800x600\";a:4:{s:4:\"file\";s:20:\"united-1-800x600.jpg\";s:5:\"width\";i:800;s:6:\"height\";i:600;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(340, 92, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(341, 93, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(342, 94, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(343, 95, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(344, 96, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(345, 97, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(346, 98, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(347, 99, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(348, 99, '_wpb_shortcodes_custom_css', '.vc_custom_1614492296897{padding-right: 0px !important;padding-left: 0px !important;}'),
(350, 101, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(351, 101, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(352, 102, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(353, 102, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(354, 103, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(355, 103, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(356, 104, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(357, 104, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(358, 105, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(359, 105, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(360, 106, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(361, 106, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(362, 107, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(363, 107, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(364, 108, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(365, 108, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(366, 52, 'post_views_count', ''),
(367, 109, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(368, 109, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(369, 110, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(370, 110, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(371, 111, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(372, 111, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(373, 112, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(374, 112, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(375, 113, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(376, 113, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(377, 114, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(378, 114, '_wpb_shortcodes_custom_css', '.vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}'),
(379, 115, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(380, 116, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(381, 117, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(382, 118, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(383, 119, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(384, 120, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(385, 121, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(386, 122, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(387, 123, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(388, 124, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(389, 125, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(390, 126, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(391, 127, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(392, 128, '_wpb_post_custom_css', '.fotorama{\r\n    width:100%;\r\n}'),
(393, 129, 'min_price', ''),
(394, 129, 'rate_review', '0'),
(395, 129, '_menu_item_type', 'post_type'),
(396, 129, '_menu_item_menu_item_parent', '0'),
(397, 129, '_menu_item_object_id', '27'),
(398, 129, '_menu_item_object', 'page'),
(399, 129, '_menu_item_target', ''),
(400, 129, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(401, 129, '_menu_item_xfn', ''),
(402, 129, '_menu_item_url', ''),
(404, 130, 'min_price', ''),
(405, 130, 'rate_review', '0'),
(406, 130, '_menu_item_type', 'post_type'),
(407, 130, '_menu_item_menu_item_parent', '0'),
(408, 130, '_menu_item_object_id', '10'),
(409, 130, '_menu_item_object', 'page'),
(410, 130, '_menu_item_target', ''),
(411, 130, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(412, 130, '_menu_item_xfn', ''),
(413, 130, '_menu_item_url', ''),
(415, 131, 'min_price', ''),
(416, 131, 'rate_review', '0'),
(417, 131, '_menu_item_type', 'post_type'),
(418, 131, '_menu_item_menu_item_parent', '0'),
(419, 131, '_menu_item_object_id', '23'),
(420, 131, '_menu_item_object', 'page'),
(421, 131, '_menu_item_target', ''),
(422, 131, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(423, 131, '_menu_item_xfn', ''),
(424, 131, '_menu_item_url', ''),
(425, 131, '_menu_item_orphaned', '1614495356'),
(426, 132, 'min_price', ''),
(427, 132, 'rate_review', '0'),
(428, 132, '_menu_item_type', 'post_type'),
(429, 132, '_menu_item_menu_item_parent', '0'),
(430, 132, '_menu_item_object_id', '13'),
(431, 132, '_menu_item_object', 'page'),
(432, 132, '_menu_item_target', ''),
(433, 132, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(434, 132, '_menu_item_xfn', ''),
(435, 132, '_menu_item_url', ''),
(436, 132, '_menu_item_orphaned', '1614495356'),
(437, 133, 'min_price', ''),
(438, 133, 'rate_review', '0'),
(439, 133, '_menu_item_type', 'post_type'),
(440, 133, '_menu_item_menu_item_parent', '0'),
(441, 133, '_menu_item_object_id', '24'),
(442, 133, '_menu_item_object', 'page'),
(443, 133, '_menu_item_target', ''),
(444, 133, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(445, 133, '_menu_item_xfn', ''),
(446, 133, '_menu_item_url', ''),
(447, 133, '_menu_item_orphaned', '1614495356'),
(448, 134, 'min_price', ''),
(449, 134, 'rate_review', '0'),
(450, 134, '_menu_item_type', 'post_type'),
(451, 134, '_menu_item_menu_item_parent', '0'),
(452, 134, '_menu_item_object_id', '30'),
(453, 134, '_menu_item_object', 'page'),
(454, 134, '_menu_item_target', ''),
(455, 134, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(456, 134, '_menu_item_xfn', ''),
(457, 134, '_menu_item_url', ''),
(458, 134, '_menu_item_orphaned', '1614495356'),
(470, 136, 'min_price', ''),
(471, 136, 'rate_review', '0'),
(472, 136, '_menu_item_type', 'post_type'),
(473, 136, '_menu_item_menu_item_parent', '0'),
(474, 136, '_menu_item_object_id', '11'),
(475, 136, '_menu_item_object', 'page'),
(476, 136, '_menu_item_target', ''),
(477, 136, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(478, 136, '_menu_item_xfn', ''),
(479, 136, '_menu_item_url', ''),
(480, 136, '_menu_item_orphaned', '1614495356'),
(481, 137, 'min_price', ''),
(482, 137, 'rate_review', '0'),
(483, 137, '_menu_item_type', 'post_type'),
(484, 137, '_menu_item_menu_item_parent', '0'),
(485, 137, '_menu_item_object_id', '25'),
(486, 137, '_menu_item_object', 'page'),
(487, 137, '_menu_item_target', ''),
(488, 137, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(489, 137, '_menu_item_xfn', ''),
(490, 137, '_menu_item_url', ''),
(491, 137, '_menu_item_orphaned', '1614495356'),
(503, 139, 'min_price', ''),
(504, 139, 'rate_review', '0'),
(505, 139, '_menu_item_type', 'post_type'),
(506, 139, '_menu_item_menu_item_parent', '0'),
(507, 139, '_menu_item_object_id', '33'),
(508, 139, '_menu_item_object', 'page'),
(509, 139, '_menu_item_target', ''),
(510, 139, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(511, 139, '_menu_item_xfn', ''),
(512, 139, '_menu_item_url', ''),
(513, 139, '_menu_item_orphaned', '1614495356'),
(514, 140, 'min_price', ''),
(515, 140, 'rate_review', '0'),
(516, 140, '_menu_item_type', 'post_type'),
(517, 140, '_menu_item_menu_item_parent', '0'),
(518, 140, '_menu_item_object_id', '45'),
(519, 140, '_menu_item_object', 'page'),
(520, 140, '_menu_item_target', ''),
(521, 140, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(522, 140, '_menu_item_xfn', ''),
(523, 140, '_menu_item_url', ''),
(524, 140, '_menu_item_orphaned', '1614495356'),
(525, 141, 'min_price', ''),
(526, 141, 'rate_review', '0'),
(527, 141, '_menu_item_type', 'post_type'),
(528, 141, '_menu_item_menu_item_parent', '0'),
(529, 141, '_menu_item_object_id', '2'),
(530, 141, '_menu_item_object', 'page'),
(531, 141, '_menu_item_target', ''),
(532, 141, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(533, 141, '_menu_item_xfn', ''),
(534, 141, '_menu_item_url', ''),
(535, 141, '_menu_item_orphaned', '1614495357'),
(547, 143, 'min_price', ''),
(548, 143, 'rate_review', '0'),
(549, 143, '_menu_item_type', 'post_type'),
(550, 143, '_menu_item_menu_item_parent', '0'),
(551, 143, '_menu_item_object_id', '22'),
(552, 143, '_menu_item_object', 'page'),
(553, 143, '_menu_item_target', ''),
(554, 143, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(555, 143, '_menu_item_xfn', ''),
(556, 143, '_menu_item_url', ''),
(557, 143, '_menu_item_orphaned', '1614495357'),
(558, 144, 'min_price', ''),
(559, 144, 'rate_review', '0'),
(560, 144, '_menu_item_type', 'post_type'),
(561, 144, '_menu_item_menu_item_parent', '0'),
(562, 144, '_menu_item_object_id', '36'),
(563, 144, '_menu_item_object', 'page'),
(564, 144, '_menu_item_target', ''),
(565, 144, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(566, 144, '_menu_item_xfn', ''),
(567, 144, '_menu_item_url', ''),
(568, 144, '_menu_item_orphaned', '1614495357'),
(569, 145, 'min_price', ''),
(570, 145, 'rate_review', '0'),
(571, 145, '_menu_item_type', 'post_type'),
(572, 145, '_menu_item_menu_item_parent', '0'),
(573, 145, '_menu_item_object_id', '14'),
(574, 145, '_menu_item_object', 'page'),
(575, 145, '_menu_item_target', ''),
(576, 145, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(577, 145, '_menu_item_xfn', ''),
(578, 145, '_menu_item_url', ''),
(579, 145, '_menu_item_orphaned', '1614495357'),
(580, 146, 'min_price', ''),
(581, 146, 'rate_review', '0'),
(582, 146, '_menu_item_type', 'post_type'),
(583, 146, '_menu_item_menu_item_parent', '0'),
(584, 146, '_menu_item_object_id', '12'),
(585, 146, '_menu_item_object', 'page'),
(586, 146, '_menu_item_target', ''),
(587, 146, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(588, 146, '_menu_item_xfn', ''),
(589, 146, '_menu_item_url', ''),
(590, 146, '_menu_item_orphaned', '1614495357'),
(591, 147, 'min_price', ''),
(592, 147, 'rate_review', '0'),
(593, 147, '_menu_item_type', 'post_type'),
(594, 147, '_menu_item_menu_item_parent', '0'),
(595, 147, '_menu_item_object_id', '15'),
(596, 147, '_menu_item_object', 'page'),
(597, 147, '_menu_item_target', ''),
(598, 147, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(599, 147, '_menu_item_xfn', ''),
(600, 147, '_menu_item_url', ''),
(601, 147, '_menu_item_orphaned', '1614495357'),
(602, 148, 'min_price', ''),
(603, 148, 'rate_review', '0'),
(604, 148, '_menu_item_type', 'post_type'),
(605, 148, '_menu_item_menu_item_parent', '0'),
(606, 148, '_menu_item_object_id', '8'),
(607, 148, '_menu_item_object', 'page'),
(608, 148, '_menu_item_target', ''),
(609, 148, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(610, 148, '_menu_item_xfn', ''),
(611, 148, '_menu_item_url', ''),
(613, 149, 'min_price', ''),
(614, 149, 'rate_review', '0'),
(615, 149, '_menu_item_type', 'post_type'),
(616, 149, '_menu_item_menu_item_parent', '0'),
(617, 149, '_menu_item_object_id', '16'),
(618, 149, '_menu_item_object', 'page'),
(619, 149, '_menu_item_target', ''),
(620, 149, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(621, 149, '_menu_item_xfn', ''),
(622, 149, '_menu_item_url', ''),
(623, 149, '_menu_item_orphaned', '1614495357'),
(624, 150, 'min_price', ''),
(625, 150, 'rate_review', '0'),
(626, 150, '_menu_item_type', 'post_type'),
(627, 150, '_menu_item_menu_item_parent', '0'),
(628, 150, '_menu_item_object_id', '17'),
(629, 150, '_menu_item_object', 'page'),
(630, 150, '_menu_item_target', ''),
(631, 150, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(632, 150, '_menu_item_xfn', ''),
(633, 150, '_menu_item_url', ''),
(634, 150, '_menu_item_orphaned', '1614495357'),
(635, 151, 'min_price', ''),
(636, 151, 'rate_review', '0'),
(637, 151, '_menu_item_type', 'post_type'),
(638, 151, '_menu_item_menu_item_parent', '0'),
(639, 151, '_menu_item_object_id', '18'),
(640, 151, '_menu_item_object', 'page'),
(641, 151, '_menu_item_target', ''),
(642, 151, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(643, 151, '_menu_item_xfn', ''),
(644, 151, '_menu_item_url', ''),
(645, 151, '_menu_item_orphaned', '1614495357'),
(646, 10, 'post_views_count', ''),
(647, 9, 'post_views_count', ''),
(648, 152, 'min_price', ''),
(649, 152, 'rate_review', '0'),
(650, 152, '_menu_item_type', 'post_type'),
(651, 152, '_menu_item_menu_item_parent', '0'),
(652, 152, '_menu_item_object_id', '10'),
(653, 152, '_menu_item_object', 'page'),
(654, 152, '_menu_item_target', ''),
(655, 152, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(656, 152, '_menu_item_xfn', ''),
(657, 152, '_menu_item_url', ''),
(658, 152, '_menu_item_orphaned', '1614495617'),
(659, 153, 'min_price', ''),
(660, 153, 'rate_review', '0'),
(661, 154, 'min_price', ''),
(662, 154, 'rate_review', '0'),
(663, 153, '_edit_last', '1'),
(664, 153, '_edit_lock', '1614495817:1'),
(665, 153, '_wp_page_template', 'template-hotel-activity.php'),
(666, 153, '_wpb_vc_js_status', 'true'),
(667, 153, 'cs_bgr', 'a:6:{s:16:\"background-color\";s:0:\"\";s:17:\"background-repeat\";s:0:\"\";s:21:\"background-attachment\";s:0:\"\";s:19:\"background-position\";s:0:\"\";s:15:\"background-size\";s:0:\"\";s:16:\"background-image\";s:0:\"\";}'),
(668, 153, 'rs_layout', '1'),
(669, 153, 'rs_style', 'grid'),
(670, 153, 'rs_filter', 'a:5:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:10:\"Hotel Star\";s:14:\"rs_filter_type\";s:10:\"hotel_star\";}i:3;a:2:{s:5:\"title\";s:10:\"Facilities\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}i:4;a:2:{s:5:\"title\";s:11:\"Hotel Theme\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(671, 153, 'rs_layout_tour', '1'),
(672, 153, 'rs_style_tour', 'grid');
INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(673, 153, 'rs_filter_tour', 'a:3:{i:0;a:3:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}i:1;a:3:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}i:2;a:3:{s:5:\"title\";s:10:\"Categories\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";s:23:\"rs_filter_type_taxonomy\";s:12:\"st_tour_type\";}}'),
(674, 153, 'rs_layout_activity', '1'),
(675, 153, 'rs_style_activity', 'grid'),
(676, 153, 'rs_filter_activity', 'a:3:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:11:\"Attractions\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(677, 153, 'rs_layout_rental', '1'),
(678, 153, 'rs_style_rental', 'grid'),
(679, 153, 'rs_filter_rental', 'a:3:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:12:\"Review Score\";s:14:\"rs_filter_type\";s:12:\"review_score\";}i:2;a:2:{s:5:\"title\";s:16:\"Rental Amenities\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(680, 153, 'rs_layout_car', '1'),
(681, 153, 'rs_style_car', 'grid'),
(682, 153, 'rs_filter_car', 'a:2:{i:0;a:2:{s:5:\"title\";s:12:\"Filter Price\";s:14:\"rs_filter_type\";s:5:\"price\";}i:1;a:2:{s:5:\"title\";s:10:\"Categories\";s:14:\"rs_filter_type\";s:8:\"taxonomy\";}}'),
(683, 156, 'min_price', ''),
(684, 156, 'rate_review', '0'),
(685, 156, '_menu_item_type', 'post_type'),
(686, 156, '_menu_item_menu_item_parent', '0'),
(687, 156, '_menu_item_object_id', '153'),
(688, 156, '_menu_item_object', 'page'),
(689, 156, '_menu_item_target', ''),
(690, 156, '_menu_item_classes', 'a:1:{i:0;s:0:\"\";}'),
(691, 156, '_menu_item_xfn', ''),
(692, 156, '_menu_item_url', ''),
(694, 153, 'post_views_count', ''),
(695, 8, 'post_views_count', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2021-02-26 14:59:13', '2021-02-26 14:59:13', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2021-02-26 14:59:13', '2021-02-26 14:59:13', '', 0, 'http://localhost/tourphoria/?p=1', 0, 'post', '', 1),
(2, 1, '2021-02-26 14:59:13', '2021-02-26 14:59:13', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"http://localhost/tourphoria/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2021-02-26 14:59:13', '2021-02-26 14:59:13', '', 0, 'http://localhost/tourphoria/?page_id=2', 0, 'page', '', 0),
(3, 1, '2021-02-26 14:59:13', '2021-02-26 14:59:13', '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Our website address is: http://localhost/tourphoria.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What personal data we collect and why we collect it</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Comments</h3><!-- /wp:heading --><!-- wp:paragraph --><p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Media</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Contact forms</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Embedded content from other websites</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Analytics</h3><!-- /wp:heading --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you request a password reset, your IP address will be included in the reset email.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where we send your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Your contact information</h2><!-- /wp:heading --><!-- wp:heading --><h2>Additional information</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>How we protect your data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What data breach procedures we have in place</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What third parties we receive data from</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What automated decision making and/or profiling we do with user data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Industry regulatory disclosure requirements</h3><!-- /wp:heading -->', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2021-02-26 14:59:13', '2021-02-26 14:59:13', '', 0, 'http://localhost/tourphoria/?page_id=3', 0, 'page', '', 0),
(4, 1, '2021-02-26 14:59:27', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2021-02-26 14:59:27', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=4', 0, 'post', '', 0),
(8, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 'Trip Types', '', 'publish', 'closed', 'closed', '', 'trip-types', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/trip-types/', 0, 'page', '', 0),
(9, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 'Destination', '', 'publish', 'closed', 'closed', '', 'destination', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/destination/', 0, 'page', '', 0),
(10, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 'Activities', '', 'publish', 'closed', 'closed', '', 'activities', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/activities/', 0, 'page', '', 0),
(11, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', 'Thank you for the enquiry. We will soon get in touch with you.', 'Enquiry Thank You Page', '', 'publish', 'closed', 'closed', '', 'enquiry-thank-you-page', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/enquiry-thank-you-page/', 0, 'page', '', 0),
(12, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[WP_TRAVEL_ENGINE_THANK_YOU]', 'THANK YOU', '', 'publish', 'closed', 'closed', '', 'thank-you', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/thank-you/', 0, 'page', '', 0),
(13, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[WP_TRAVEL_ENGINE_PLACE_ORDER]', 'CHECKOUT', '', 'publish', 'closed', 'closed', '', 'checkout', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/checkout/', 0, 'page', '', 0),
(14, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 'TERMS AND CONDITIONS', '', 'publish', 'closed', 'closed', '', 'terms-and-conditions', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/terms-and-conditions/', 0, 'page', '', 0),
(15, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[WP_TRAVEL_ENGINE_BOOK_CONFIRMATION]', 'TRAVELERS INFORMATION', '', 'publish', 'closed', 'closed', '', 'travelers-information', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/travelers-information/', 0, 'page', '', 0),
(16, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[wp_travel_engine_cart]', 'WP Travel Engine Cart', '', 'publish', 'closed', 'closed', '', 'wp-travel-engine-cart', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/wp-travel-engine-cart/', 0, 'page', '', 0),
(17, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[wp_travel_engine_checkout]', 'WP Travel Engine Checkout', '', 'publish', 'closed', 'closed', '', 'wp-travel-engine-checkout', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/wp-travel-engine-checkout/', 0, 'page', '', 0),
(18, 1, '2021-02-26 15:08:45', '2021-02-26 15:08:45', '[wp_travel_engine_dashboard]', 'WP Travel Engine Dashboard', '', 'publish', 'closed', 'closed', '', 'my-account', '', '', '2021-02-26 15:08:45', '2021-02-26 15:08:45', '', 0, 'http://localhost/tourphoria/my-account/', 0, 'page', '', 0),
(20, 1, '2021-02-26 18:23:17', '2021-02-26 18:23:17', '<label> Your name\n    [text* your-name] </label>\n\n<label> Your email\n    [email* your-email] </label>\n\n<label> Subject\n    [text* your-subject] </label>\n\n<label> Your message (optional)\n    [textarea your-message] </label>\n\n[submit \"Submit\"]\n[_site_title] \"[your-subject]\"\n[_site_title] <kchaouanis26@gmail.com>\nFrom: [your-name] <[your-email]>\nSubject: [your-subject]\n\nMessage Body:\n[your-message]\n\n-- \nThis e-mail was sent from a contact form on [_site_title] ([_site_url])\n[_site_admin_email]\nReply-To: [your-email]\n\n0\n0\n\n[_site_title] \"[your-subject]\"\n[_site_title] <kchaouanis26@gmail.com>\nMessage Body:\n[your-message]\n\n-- \nThis e-mail was sent from a contact form on [_site_title] ([_site_url])\n[your-email]\nReply-To: [_site_admin_email]\n\n0\n0\nThank you for your message. It has been sent.\nThere was an error trying to send your message. Please try again later.\nOne or more fields have an error. Please check and try again.\nThere was an error trying to send your message. Please try again later.\nYou must accept the terms and conditions before sending your message.\nThe field is required.\nThe field is too long.\nThe field is too short.\nThere was an unknown error uploading the file.\nYou are not allowed to upload files of this type.\nThe file is too big.\nThere was an error uploading the file.', 'Contact form 1', '', 'publish', 'closed', 'closed', '', 'contact-form-1', '', '', '2021-02-26 18:23:17', '2021-02-26 18:23:17', '', 0, 'http://localhost/tourphoria/?post_type=wpcf7_contact_form&p=20', 0, 'wpcf7_contact_form', '', 0),
(21, 1, '2021-02-26 18:23:19', '2021-02-26 18:23:19', '', 'woocommerce-placeholder', '', 'inherit', 'open', 'closed', '', 'woocommerce-placeholder', '', '', '2021-02-26 18:23:19', '2021-02-26 18:23:19', '', 0, 'http://localhost/tourphoria/wp-content/uploads/2021/02/woocommerce-placeholder.png', 0, 'attachment', 'image/png', 0),
(22, 1, '2021-02-26 18:23:21', '2021-02-26 18:23:21', '', 'Shop', '', 'publish', 'closed', 'closed', '', 'shop', '', '', '2021-02-26 18:23:21', '2021-02-26 18:23:21', '', 0, 'http://localhost/tourphoria/shop/', 0, 'page', '', 0),
(23, 1, '2021-02-26 18:23:21', '2021-02-26 18:23:21', '<!-- wp:shortcode -->[woocommerce_cart]<!-- /wp:shortcode -->', 'Cart', '', 'publish', 'closed', 'closed', '', 'cart', '', '', '2021-02-26 18:23:21', '2021-02-26 18:23:21', '', 0, 'http://localhost/tourphoria/cart/', 0, 'page', '', 0),
(24, 1, '2021-02-26 18:23:21', '2021-02-26 18:23:21', '<!-- wp:shortcode -->[woocommerce_checkout]<!-- /wp:shortcode -->', 'Checkout', '', 'publish', 'closed', 'closed', '', 'checkout-2', '', '', '2021-02-26 18:23:21', '2021-02-26 18:23:21', '', 0, 'http://localhost/tourphoria/checkout-2/', 0, 'page', '', 0),
(25, 1, '2021-02-26 18:23:21', '2021-02-26 18:23:21', '<!-- wp:shortcode -->[woocommerce_my_account]<!-- /wp:shortcode -->', 'My account', '', 'publish', 'closed', 'closed', '', 'my-account-2', '', '', '2021-02-26 18:23:21', '2021-02-26 18:23:21', '', 0, 'http://localhost/tourphoria/my-account-2/', 0, 'page', '', 0),
(26, 1, '2021-02-26 18:23:24', '2021-02-26 18:23:24', '', 'Media', '', 'private', 'closed', 'closed', '', 'media', '', '', '2021-02-26 18:23:24', '2021-02-26 18:23:24', '', 0, 'http://localhost/tourphoria/?option-tree=media', 0, 'option-tree', '', 0),
(27, 1, '2021-02-27 22:52:14', '2021-02-27 22:52:14', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"91,90,89,88\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2021-02-28 06:55:22', '2021-02-28 06:55:22', '', 0, 'http://localhost/tourphoria/?page_id=27', 0, 'page', '', 0),
(28, 1, '2021-02-27 22:51:53', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-27 22:51:53', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=28', 0, 'page', '', 0),
(29, 1, '2021-02-27 22:52:14', '2021-02-27 22:52:14', '', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-27 22:52:14', '2021-02-27 22:52:14', '', 27, 'http://localhost/tourphoria/2021/02/27/27-revision-v1/', 0, 'revision', '', 0),
(30, 1, '2021-02-28 02:07:12', '2021-02-28 02:07:12', '', 'Dashboard', '', 'publish', 'closed', 'closed', '', 'dashboard', '', '', '2021-02-28 02:07:14', '2021-02-28 02:07:14', '', 0, 'http://localhost/tourphoria/?page_id=30', 0, 'page', '', 0),
(31, 1, '2021-02-28 02:06:39', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:06:39', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=31', 0, 'page', '', 0),
(32, 1, '2021-02-28 02:07:12', '2021-02-28 02:07:12', '', 'Dashboard', '', 'inherit', 'closed', 'closed', '', '30-revision-v1', '', '', '2021-02-28 02:07:12', '2021-02-28 02:07:12', '', 30, 'http://localhost/tourphoria/2021/02/28/30-revision-v1/', 0, 'revision', '', 0),
(33, 1, '2021-02-28 02:11:29', '2021-02-28 02:11:29', '', 'Register', '', 'publish', 'closed', 'closed', '', 'register', '', '', '2021-02-28 02:11:31', '2021-02-28 02:11:31', '', 0, 'http://localhost/tourphoria/?page_id=33', 0, 'page', '', 0),
(34, 1, '2021-02-28 02:11:04', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:11:04', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=34', 0, 'page', '', 0),
(35, 1, '2021-02-28 02:11:29', '2021-02-28 02:11:29', '', 'Register', '', 'inherit', 'closed', 'closed', '', '33-revision-v1', '', '', '2021-02-28 02:11:29', '2021-02-28 02:11:29', '', 33, 'http://localhost/tourphoria/2021/02/28/33-revision-v1/', 0, 'revision', '', 0),
(36, 1, '2021-02-28 02:12:44', '2021-02-28 02:12:44', '', 'Success', '', 'publish', 'closed', 'closed', '', 'success', '', '', '2021-02-28 02:12:46', '2021-02-28 02:12:46', '', 0, 'http://localhost/tourphoria/?page_id=36', 0, 'page', '', 0),
(37, 1, '2021-02-28 02:12:05', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:12:05', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=37', 0, 'page', '', 0),
(38, 1, '2021-02-28 02:12:44', '2021-02-28 02:12:44', '', 'Success', '', 'inherit', 'closed', 'closed', '', '36-revision-v1', '', '', '2021-02-28 02:12:44', '2021-02-28 02:12:44', '', 36, 'http://localhost/tourphoria/2021/02/28/36-revision-v1/', 0, 'revision', '', 0),
(39, 1, '2021-02-28 02:14:24', '2021-02-28 02:14:24', '', 'Order Confirm', '', 'publish', 'closed', 'closed', '', 'order-confirm', '', '', '2021-02-28 02:14:25', '2021-02-28 02:14:25', '', 0, 'http://localhost/tourphoria/?page_id=39', 0, 'page', '', 0),
(40, 1, '2021-02-28 02:13:34', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:13:34', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=40', 0, 'page', '', 0),
(41, 1, '2021-02-28 02:14:24', '2021-02-28 02:14:24', '', 'Order Confirm', '', 'inherit', 'closed', 'closed', '', '39-revision-v1', '', '', '2021-02-28 02:14:24', '2021-02-28 02:14:24', '', 39, 'http://localhost/tourphoria/2021/02/28/39-revision-v1/', 0, 'revision', '', 0),
(42, 1, '2021-02-28 02:21:45', '2021-02-28 02:21:45', '', 'Search', '', 'publish', 'closed', 'closed', '', 'search', '', '', '2021-02-28 02:21:47', '2021-02-28 02:21:47', '', 0, 'http://localhost/tourphoria/?page_id=42', 0, 'page', '', 0),
(43, 1, '2021-02-28 02:17:48', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:17:48', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=43', 0, 'page', '', 0),
(44, 1, '2021-02-28 02:21:45', '2021-02-28 02:21:45', '', 'Search', '', 'inherit', 'closed', 'closed', '', '42-revision-v1', '', '', '2021-02-28 02:21:45', '2021-02-28 02:21:45', '', 42, 'http://localhost/tourphoria/2021/02/28/42-revision-v1/', 0, 'revision', '', 0),
(45, 1, '2021-02-28 02:24:11', '2021-02-28 02:24:11', '', 'Reset password', '', 'publish', 'closed', 'closed', '', 'reset-password', '', '', '2021-02-28 02:24:13', '2021-02-28 02:24:13', '', 0, 'http://localhost/tourphoria/?page_id=45', 0, 'page', '', 0),
(46, 1, '2021-02-28 02:23:47', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 02:23:47', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=46', 0, 'page', '', 0),
(47, 1, '2021-02-28 02:24:11', '2021-02-28 02:24:11', '', 'Reset password', '', 'inherit', 'closed', 'closed', '', '45-revision-v1', '', '', '2021-02-28 02:24:11', '2021-02-28 02:24:11', '', 45, 'http://localhost/tourphoria/2021/02/28/45-revision-v1/', 0, 'revision', '', 0),
(48, 1, '2021-02-28 02:43:39', '2021-02-28 02:43:39', '', 'mastercard', '', 'inherit', 'open', 'closed', '', 'mastercard', '', '', '2021-02-28 02:43:39', '2021-02-28 02:43:39', '', 26, 'http://localhost/tourphoria/wp-content/uploads/2021/02/mastercard.png', 0, 'attachment', 'image/png', 0),
(49, 1, '2021-02-28 02:43:42', '2021-02-28 02:43:42', '', 'visa', '', 'inherit', 'open', 'closed', '', 'visa', '', '', '2021-02-28 02:43:42', '2021-02-28 02:43:42', '', 26, 'http://localhost/tourphoria/wp-content/uploads/2021/02/visa.png', 0, 'attachment', 'image/png', 0),
(50, 1, '2021-02-28 02:50:58', '2021-02-28 02:50:58', '', 'tour', '', 'inherit', 'open', 'closed', '', 'tour', '', '', '2021-02-28 02:50:58', '2021-02-28 02:50:58', '', 26, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour.png', 0, 'attachment', 'image/png', 0),
(51, 1, '2021-02-28 02:54:18', '2021-02-28 02:54:18', '', 'banner-bg-2', '', 'inherit', 'open', 'closed', '', 'banner-bg-2', '', '', '2021-02-28 02:54:18', '2021-02-28 02:54:18', '', 26, 'http://localhost/tourphoria/wp-content/uploads/2021/02/banner-bg-2.png', 0, 'attachment', 'image/png', 0),
(52, 1, '2021-02-28 03:12:13', '2021-02-28 03:12:13', '', 'USA', '', 'publish', 'closed', 'closed', '', 'usa', '', '', '2021-02-28 03:12:13', '2021-02-28 03:12:13', '', 0, 'http://localhost/tourphoria/?post_type=location&#038;p=52', 0, 'location', '', 0),
(53, 1, '2021-02-28 03:10:03', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 03:10:03', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?post_type=location&p=53', 0, 'location', '', 0),
(54, 1, '2021-02-28 03:10:24', '2021-02-28 03:10:24', '', 'Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017', '', 'inherit', 'open', 'closed', '', 'image-image-etats-unis-new-york-statue-liberte-33-it_99300851-09032017', '', '', '2021-02-28 03:10:24', '2021-02-28 03:10:24', '', 52, 'http://localhost/tourphoria/wp-content/uploads/2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017.jpg', 0, 'attachment', 'image/jpeg', 0),
(55, 1, '2021-02-28 03:14:54', '2021-02-28 03:14:54', '', 'New york', '', 'publish', 'closed', 'closed', '', 'new-york', '', '', '2021-02-28 03:14:54', '2021-02-28 03:14:54', '', 52, 'http://localhost/tourphoria/?post_type=location&#038;p=55', 0, 'location', '', 0),
(56, 1, '2021-02-28 03:13:15', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 03:13:15', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?post_type=location&p=56', 0, 'location', '', 0),
(57, 1, '2021-02-28 03:13:40', '2021-02-28 03:13:40', '', 'Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017', '', 'inherit', 'open', 'closed', '', 'image-image-etats-unis-new-york-statue-liberte-33-it_99300851-09032017-2', '', '', '2021-02-28 03:13:40', '2021-02-28 03:13:40', '', 55, 'http://localhost/tourphoria/wp-content/uploads/2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(58, 1, '2021-02-28 03:16:57', '2021-02-28 03:16:57', '', 'San Fancisco', '', 'publish', 'closed', 'closed', '', 'san-fancisco', '', '', '2021-02-28 03:16:58', '2021-02-28 03:16:58', '', 52, 'http://localhost/tourphoria/?post_type=location&#038;p=58', 0, 'location', '', 0),
(59, 1, '2021-02-28 03:15:04', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 03:15:04', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?post_type=location&p=59', 0, 'location', '', 0),
(60, 1, '2021-02-28 03:15:43', '2021-02-28 03:15:43', '', 'united', '', 'inherit', 'open', 'closed', '', 'united', '', '', '2021-02-28 03:15:43', '2021-02-28 03:15:43', '', 58, 'http://localhost/tourphoria/wp-content/uploads/2021/02/united.jpg', 0, 'attachment', 'image/jpeg', 0),
(61, 1, '2021-02-28 03:31:05', '2021-02-28 03:31:05', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a nisi eros. In efficitur vehicula urna consequat laoreet. Nulla facilisi. Sed varius nulla at risus finibus semper. Ut at varius felis. Sed orci lorem, efficitur a lectus ut, efficitur dignissim turpis. Cras elementum eros eget augue maximus, sed blandit enim blandit. Aliquam erat volutpat. Nullam tincidunt nisi nec odio lacinia, non faucibus metus interdum. Nulla vestibulum purus eu felis ultricies fringilla eu eget sem. Morbi eget pretium mauris. Fusce sit amet malesuada justo, eu bibendum ex. Donec vulputate nibh odio, id egestas lorem tristique sit amet.', '4 days New york tour', '', 'publish', 'open', 'closed', '', '4-days-new-york-tour', '', '', '2021-02-28 03:31:05', '2021-02-28 03:31:05', '', 0, 'http://localhost/tourphoria/?post_type=st_tours&#038;p=61', 0, 'st_tours', '', 0),
(62, 1, '2021-02-28 03:17:58', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2021-02-28 03:17:58', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?post_type=st_tours&p=62', 0, 'st_tours', '', 0),
(63, 1, '2021-02-28 03:19:48', '2021-02-28 03:19:48', '', 'Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017', '', 'inherit', 'open', 'closed', '', 'image-image-etats-unis-new-york-statue-liberte-33-it_99300851-09032017-3', '', '', '2021-02-28 03:19:48', '2021-02-28 03:19:48', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/Image-image-Etats-Unis-New-York-Statue-Liberte-33-it_99300851-09032017-2.jpg', 0, 'attachment', 'image/jpeg', 0),
(64, 1, '2021-02-28 03:19:51', '2021-02-28 03:19:51', '', 'Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555', '', 'inherit', 'open', 'closed', '', 'statue2bof2bliberty2band2bmanhattan2bskyline2bwalking2btour2bnew2byork2b_by_laurence2bnorah-870x555', '', '', '2021-02-28 03:19:51', '2021-02-28 03:19:51', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/Statue2Bof2BLiberty2Band2BManhattan2BSkyline2Bwalking2Btour2Bnew2Byork2B_by_Laurence2BNorah-870x555-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(65, 1, '2021-02-28 03:19:53', '2021-02-28 03:19:53', '', 'TheCommonWanderer_-870x555', '', 'inherit', 'open', 'closed', '', 'thecommonwanderer_-870x555', '', '', '2021-02-28 03:19:53', '2021-02-28 03:19:53', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/TheCommonWanderer_-870x555-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(66, 1, '2021-02-28 03:19:56', '2021-02-28 03:19:56', '', 'tour_img-1355873-145-1', '', 'inherit', 'open', 'closed', '', 'tour_img-1355873-145-1', '', '', '2021-02-28 03:19:56', '2021-02-28 03:19:56', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour_img-1355873-145-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(67, 1, '2021-02-28 03:19:59', '2021-02-28 03:19:59', '', 'tour_img-1355897-145-1', '', 'inherit', 'open', 'closed', '', 'tour_img-1355897-145-1', '', '', '2021-02-28 03:19:59', '2021-02-28 03:19:59', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour_img-1355897-145-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(68, 1, '2021-02-28 03:20:02', '2021-02-28 03:20:02', '', 'tour_img-1355906-145', '', 'inherit', 'open', 'closed', '', 'tour_img-1355906-145', '', '', '2021-02-28 03:20:02', '2021-02-28 03:20:02', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour_img-1355906-145.jpg', 0, 'attachment', 'image/jpeg', 0),
(69, 1, '2021-02-28 03:20:04', '2021-02-28 03:20:04', '', 'tour-1@2x', '', 'inherit', 'open', 'closed', '', 'tour-12x', '', '', '2021-02-28 03:20:04', '2021-02-28 03:20:04', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour-1@2x.png', 0, 'attachment', 'image/png', 0),
(70, 1, '2021-02-28 03:20:09', '2021-02-28 03:20:09', '', 'tour-2@2x', '', 'inherit', 'open', 'closed', '', 'tour-22x', '', '', '2021-02-28 03:20:09', '2021-02-28 03:20:09', '', 61, 'http://localhost/tourphoria/wp-content/uploads/2021/02/tour-2@2x.png', 0, 'attachment', 'image/png', 0),
(71, 1, '2021-02-28 04:12:35', '2021-02-28 04:12:35', '<p>[vc_row][vc_column][st_slider_activity speed_slider=\"3000\" list_slider=\"%5B%7B%22image%22%3A%2265%22%7D%2C%7B%22image%22%3A%2270%22%7D%2C%7B%22image%22%3A%2265%22%7D%2C%7B%22image%22%3A%2251%22%7D%2C%7B%22image%22%3A%2268%22%7D%5D\" style_gallery=\"style2\"][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:12:35', '2021-02-28 04:12:35', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(72, 1, '2021-02-28 04:16:35', '2021-02-28 04:16:35', '<p>[vc_row full_width=\"stretch_row_content_no_spaces\" row_fullwidth=\"yes\"][vc_column parallax=\"content-moving-fade\"][st_location_slider st_location_list_image=\"60,63,64,70,69,68,67\"][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:16:35', '2021-02-28 04:16:35', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(73, 1, '2021-02-28 04:18:24', '2021-02-28 04:18:24', '[vc_row full_width=\"stretch_row_content_no_spaces\" row_fullwidth=\"yes\"][vc_column parallax=\"content-moving-fade\"][st_location_slider st_location_list_image=\"60,63,64,70,69,68,67\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:18:24', '2021-02-28 04:18:24', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(74, 1, '2021-02-28 04:25:00', '2021-02-28 04:25:00', '<p>[vc_row full_width=\"stretch_row_content_no_spaces\" row_fullwidth=\"yes\"][vc_column][vc_images_carousel images=\"66,67\" autoplay=\"yes\"][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:25:00', '2021-02-28 04:25:00', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(75, 1, '2021-02-28 04:25:16', '2021-02-28 04:25:16', '[vc_row full_width=\"stretch_row_content_no_spaces\" row_fullwidth=\"yes\"][vc_column][vc_images_carousel images=\"66,67\" autoplay=\"yes\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:25:16', '2021-02-28 04:25:16', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(76, 1, '2021-02-28 06:54:11', '2021-02-28 06:54:11', '<p>[vc_row][vc_column][/vc_column][/vc_row][vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '27-autosave-v1', '', '', '2021-02-28 06:54:11', '2021-02-28 06:54:11', '', 27, 'http://localhost/tourphoria/2021/02/28/27-autosave-v1/', 0, 'revision', '', 0),
(77, 1, '2021-02-28 04:27:06', '2021-02-28 04:27:06', '[vc_row full_width=\"stretch_row\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"69,70,68,67\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:27:06', '2021-02-28 04:27:06', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(78, 1, '2021-02-28 04:30:06', '2021-02-28 04:30:06', '[vc_row full_width=\"stretch_row\" row_fullwidth=\"yes\"][vc_column][st_slider_activity speed_slider=\"3000\" list_slider=\"%5B%7B%22image%22%3A%2268%22%7D%2C%7B%7D%5D\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:30:06', '2021-02-28 04:30:06', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(79, 1, '2021-02-28 04:31:27', '2021-02-28 04:31:27', '[vc_row full_width=\"stretch_row_content\" row_fullwidth=\"yes\"][vc_column][st_slider_activity speed_slider=\"3000\" list_slider=\"%5B%7B%22image%22%3A%2268%22%7D%2C%7B%7D%5D\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:31:27', '2021-02-28 04:31:27', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(80, 1, '2021-02-28 04:33:09', '2021-02-28 04:33:09', '[vc_row full_width=\"stretch_row_content\" row_fullwidth=\"yes\"][vc_column][st_slider_activity speed_slider=\"3000\" list_slider=\"%5B%7B%22image%22%3A%2268%22%2C%22title_slider%22%3A%22welcome%20%22%7D%2C%7B%22image%22%3A%2269%22%7D%5D\" style_gallery=\"style2\" text_animation=\"text-rotate\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:33:09', '2021-02-28 04:33:09', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(81, 1, '2021-02-28 04:34:38', '2021-02-28 04:34:38', '[vc_row full_width=\"stretch_row_content\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"69,68,67,66,65,60,63\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:34:38', '2021-02-28 04:34:38', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(82, 1, '2021-02-28 04:38:45', '2021-02-28 04:38:45', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" row_fullwidth=\"yes\" parallax_class=\"yes\" css=\".vc_custom_1614487119436{margin-right: 0px !important;margin-left: 0px !important;}\"][vc_column][st_location_slider st_location_list_image=\"69,68,67,66,65,60,63\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:38:45', '2021-02-28 04:38:45', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(83, 1, '2021-02-28 04:41:55', '2021-02-28 04:41:55', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" row_fullwidth=\"yes\" parallax_class=\"yes\" css=\".vc_custom_1614487311785{margin-right: 0px !important;margin-left: 0px !important;}\"][vc_column][st_location_slider st_location_list_image=\"69,68,67,66,65,60,63\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:41:55', '2021-02-28 04:41:55', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(84, 1, '2021-02-28 04:48:54', '2021-02-28 04:48:54', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" row_fullwidth=\"yes\" parallax_class=\"yes\" css=\".vc_custom_1614487311785{margin-right: 0px !important;margin-left: 0px !important;}\"][vc_column][st_location_slider st_location_list_image=\"69,68,67,66,65,60,63\"][st_slider_activity speed_slider=\"3000\" list_slider=\"%5B%7B%22image%22%3A%2268%22%7D%5D\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 04:48:54', '2021-02-28 04:48:54', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(85, 1, '2021-02-28 05:09:47', '2021-02-28 05:09:47', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"69,68,67,66,65,60,63\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:09:47', '2021-02-28 05:09:47', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(86, 1, '2021-02-28 05:11:27', '2021-02-28 05:11:27', '', '106355_a16e498a', '', 'inherit', 'open', 'closed', '', '106355_a16e498a', '', '', '2021-02-28 05:11:27', '2021-02-28 05:11:27', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/106355_a16e498a.jpg', 0, 'attachment', 'image/jpeg', 0),
(87, 1, '2021-02-28 05:11:30', '2021-02-28 05:11:30', '', 'banner-bg-2', '', 'inherit', 'open', 'closed', '', 'banner-bg-2-2', '', '', '2021-02-28 05:11:30', '2021-02-28 05:11:30', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/banner-bg-2-1.png', 0, 'attachment', 'image/png', 0),
(88, 1, '2021-02-28 05:11:36', '2021-02-28 05:11:36', '', 'detail_2', '', 'inherit', 'open', 'closed', '', 'detail_2', '', '', '2021-02-28 05:11:36', '2021-02-28 05:11:36', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/detail_2.jpg', 0, 'attachment', 'image/jpeg', 0),
(89, 1, '2021-02-28 05:11:39', '2021-02-28 05:11:39', '', 'detail_4', '', 'inherit', 'open', 'closed', '', 'detail_4', '', '', '2021-02-28 05:11:39', '2021-02-28 05:11:39', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/detail_4.jpg', 0, 'attachment', 'image/jpeg', 0),
(90, 1, '2021-02-28 05:11:42', '2021-02-28 05:11:42', '', 'detail_5', '', 'inherit', 'open', 'closed', '', 'detail_5', '', '', '2021-02-28 05:11:42', '2021-02-28 05:11:42', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/detail_5.jpg', 0, 'attachment', 'image/jpeg', 0),
(91, 1, '2021-02-28 05:11:46', '2021-02-28 05:11:46', '', 'united', '', 'inherit', 'open', 'closed', '', 'united-2', '', '', '2021-02-28 05:11:46', '2021-02-28 05:11:46', '', 27, 'http://localhost/tourphoria/wp-content/uploads/2021/02/united-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(92, 1, '2021-02-28 05:12:02', '2021-02-28 05:12:02', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"86,87,88,89,90,91\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:12:02', '2021-02-28 05:12:02', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(93, 1, '2021-02-28 05:15:39', '2021-02-28 05:15:39', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_bg_gallery st_speed=\"1200\" st_col=\"8\" st_row=\"4\" st_images_in=\"89\"][st_location_slider st_location_list_image=\"86,87,88,89,90,91\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:15:39', '2021-02-28 05:15:39', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(94, 1, '2021-02-28 05:17:17', '2021-02-28 05:17:17', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_bg_gallery st_speed=\"1200\" st_col=\"1\" st_row=\"1\" st_images_in=\"89\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:17:17', '2021-02-28 05:17:17', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(95, 1, '2021-02-28 05:18:16', '2021-02-28 05:18:16', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_search_form][/st_search_form][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:18:16', '2021-02-28 05:18:16', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(96, 1, '2021-02-28 05:19:03', '2021-02-28 05:19:03', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_search_form st_post_type=\"st_tours\" st_title_form=\"hhh\"][/st_search_form][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:19:03', '2021-02-28 05:19:03', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(97, 1, '2021-02-28 05:59:39', '2021-02-28 05:59:39', '[vc_row full_width=\"stretch_row_content\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 05:59:39', '2021-02-28 05:59:39', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(98, 1, '2021-02-28 06:03:49', '2021-02-28 06:03:49', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:03:49', '2021-02-28 06:03:49', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(99, 1, '2021-02-28 06:05:00', '2021-02-28 06:05:00', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492296897{padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:05:00', '2021-02-28 06:05:00', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(100, 1, '2021-02-28 06:10:53', '2021-02-28 06:10:53', '<p>[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][/vc_column][/vc_row][vc_row][vc_column][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][/vc_column][/vc_row]</p>\n', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:10:53', '2021-02-28 06:10:53', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(101, 1, '2021-02-28 06:11:36', '2021-02-28 06:11:36', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:11:36', '2021-02-28 06:11:36', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(102, 1, '2021-02-28 06:15:05', '2021-02-28 06:15:05', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title][st_header][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:15:05', '2021-02-28 06:15:05', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(103, 1, '2021-02-28 06:15:39', '2021-02-28 06:15:39', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:15:39', '2021-02-28 06:15:39', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(104, 1, '2021-02-28 06:19:20', '2021-02-28 06:19:20', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:19:20', '2021-02-28 06:19:20', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(105, 1, '2021-02-28 06:24:02', '2021-02-28 06:24:02', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Activity\" layout_title=\"st_default\"][/st_title_line][st_location_list_tour st_location_num=\"4\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:24:02', '2021-02-28 06:24:02', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(106, 1, '2021-02-28 06:25:24', '2021-02-28 06:25:24', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Activity\" layout_title=\"st_default\"][/st_title_line][st_list_location link_to=\"single\" st_number=\"4\" st_col=\"4\" st_style=\"curved\" st_type=\"st_tours\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:25:24', '2021-02-28 06:25:24', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0);
INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(107, 1, '2021-02-28 06:26:34', '2021-02-28 06:26:34', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_location link_to=\"single\" st_number=\"4\" st_show_logo=\"yes\" st_type=\"st_tours\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:26:34', '2021-02-28 06:26:34', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(108, 1, '2021-02-28 06:27:37', '2021-02-28 06:27:37', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_location link_to=\"single\" st_number=\"4\" st_show_logo=\"yes\" st_logo_position=\"left\" st_type=\"st_tours\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:27:37', '2021-02-28 06:27:37', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(109, 1, '2021-02-28 06:29:52', '2021-02-28 06:29:52', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:29:52', '2021-02-28 06:29:52', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(110, 1, '2021-02-28 06:30:31', '2021-02-28 06:30:31', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:30:31', '2021-02-28 06:30:31', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(111, 1, '2021-02-28 06:34:04', '2021-02-28 06:34:04', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][st_search_filter_ajax style=\"light\" title=\"Search\"][/st_search_filter_ajax][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:34:04', '2021-02-28 06:34:04', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(112, 1, '2021-02-28 06:38:28', '2021-02-28 06:38:28', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][iconimg_text image_icon=\"89\" text_icon=\"hello\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:38:28', '2021-02-28 06:38:28', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(113, 1, '2021-02-28 06:39:17', '2021-02-28 06:39:17', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][iconimg_text style=\"style-2\" image_icon=\"89\" text_icon=\"hello\"][st_location_slider st_location_list_image=\"91,90,89,88,87,86\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:39:17', '2021-02-28 06:39:17', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(114, 1, '2021-02-28 06:40:30', '2021-02-28 06:40:30', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" css_animation=\"fadeIn\" row_fullwidth=\"yes\"][vc_column css=\".vc_custom_1614492413326{margin-right: 0px !important;margin-left: 0px !important;padding-right: 0px !important;padding-left: 0px !important;}\"][st_image_effect st_image=\"88\" st_title=\"jhgjgkjh\"][/st_image_effect][iconimg_text style=\"style-2\" image_icon=\"89\" text_icon=\"hello\"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:40:30', '2021-02-28 06:40:30', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(115, 1, '2021-02-28 06:41:36', '2021-02-28 06:41:36', '[vc_row][vc_column][st_tour_gallery_map style=\"half_map\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:41:36', '2021-02-28 06:41:36', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(116, 1, '2021-02-28 06:43:23', '2021-02-28 06:43:23', '[vc_row][vc_column][st_tour_video][st_tour_detail_map][st_tour_gallery_map style=\"style-1\" map_style=\"style_riverside\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:43:23', '2021-02-28 06:43:23', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(117, 1, '2021-02-28 06:44:55', '2021-02-28 06:44:55', '[vc_row][vc_column][st_half_slider heading=\"Welcome\" gallery=\"91,90,89,88,87,86,63\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:44:55', '2021-02-28 06:44:55', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(118, 1, '2021-02-28 06:45:59', '2021-02-28 06:45:59', '[vc_row][vc_column][st_half_slider heading=\"Welcome\" gallery=\"91,90,89,88,87,86,63\" description=\",,,hg\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:45:59', '2021-02-28 06:45:59', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(119, 1, '2021-02-28 06:47:16', '2021-02-28 06:47:16', '[vc_row][vc_column][vc_gallery interval=\"3\" images=\"91,90,89,88,87,86,68,69\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:47:16', '2021-02-28 06:47:16', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(120, 1, '2021-02-28 06:48:37', '2021-02-28 06:48:37', '[vc_row][vc_column][vc_gallery type=\"flexslider_slide\" interval=\"3\" images=\"91,90,89,88,87,86,68,69\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:48:37', '2021-02-28 06:48:37', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(121, 1, '2021-02-28 06:49:10', '2021-02-28 06:49:10', '[vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][vc_gallery type=\"flexslider_slide\" interval=\"3\" images=\"91,90,89,88,87,86,68,69\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:49:10', '2021-02-28 06:49:10', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(122, 1, '2021-02-28 06:50:01', '2021-02-28 06:50:01', '[vc_row full_width=\"stretch_row_content_no_spaces\" full_height=\"yes\" equal_height=\"yes\" content_placement=\"middle\" row_fullwidth=\"yes\"][vc_column][vc_gallery type=\"flexslider_slide\" interval=\"3\" images=\"91,90,89,88,87,86,68,69\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:50:01', '2021-02-28 06:50:01', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(123, 1, '2021-02-28 06:50:47', '2021-02-28 06:50:47', '[vc_row full_width=\"stretch_row_content\" equal_height=\"yes\" content_placement=\"middle\"][vc_column][vc_gallery type=\"flexslider_slide\" interval=\"3\" images=\"91,90,89,88,87,86,68,69\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:50:47', '2021-02-28 06:50:47', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(124, 1, '2021-02-28 06:52:12', '2021-02-28 06:52:12', '[vc_row][vc_column][vc_images_carousel images=\"90,89,88\"][/vc_column][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:52:12', '2021-02-28 06:52:12', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(125, 1, '2021-02-28 06:52:35', '2021-02-28 06:52:35', '[vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][vc_images_carousel images=\"90,89,88\"][/vc_column][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:52:35', '2021-02-28 06:52:35', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(126, 1, '2021-02-28 06:53:04', '2021-02-28 06:53:04', '[vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row][vc_row][vc_column][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:53:04', '2021-02-28 06:53:04', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(127, 1, '2021-02-28 06:54:51', '2021-02-28 06:54:51', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\"][vc_column][st_location_slider st_location_list_image=\"91,90,89,88\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:54:51', '2021-02-28 06:54:51', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(128, 1, '2021-02-28 06:55:22', '2021-02-28 06:55:22', '[vc_row full_width=\"stretch_row_content_no_spaces\" content_placement=\"middle\" row_fullwidth=\"yes\"][vc_column][st_location_slider st_location_list_image=\"91,90,89,88\"][/vc_column][/vc_row][vc_row full_width=\"stretch_row_content_no_spaces\"][vc_column][st_title_line header_title=\"Top Tours\" layout_title=\"st_default\"][/st_title_line][st_list_of_services_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row][vc_row][vc_column][st_title_line header_title=\"Top Destination\" layout_title=\"st_default\"][/st_title_line][st_list_of_destinations_new service=\"st_tours\" posts_per_page=\"8\"][vc_empty_space height=\"60px\"][/vc_column][/vc_row]', 'Home', '', 'inherit', 'closed', 'closed', '', '27-revision-v1', '', '', '2021-02-28 06:55:22', '2021-02-28 06:55:22', '', 27, 'http://localhost/tourphoria/2021/02/28/27-revision-v1/', 0, 'revision', '', 0),
(129, 1, '2021-02-28 06:57:40', '2021-02-28 06:57:40', ' ', '', '', 'publish', 'closed', 'closed', '', '129', '', '', '2021-02-28 07:04:45', '2021-02-28 07:04:45', '', 0, 'http://localhost/tourphoria/?p=129', 1, 'nav_menu_item', '', 0),
(130, 1, '2021-02-28 06:57:40', '2021-02-28 06:57:40', ' ', '', '', 'publish', 'closed', 'closed', '', '130', '', '', '2021-02-28 07:04:45', '2021-02-28 07:04:45', '', 0, 'http://localhost/tourphoria/?p=130', 2, 'nav_menu_item', '', 0),
(131, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=131', 1, 'nav_menu_item', '', 0),
(132, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=132', 1, 'nav_menu_item', '', 0),
(133, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=133', 1, 'nav_menu_item', '', 0),
(134, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=134', 1, 'nav_menu_item', '', 0),
(136, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=136', 1, 'nav_menu_item', '', 0),
(137, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=137', 1, 'nav_menu_item', '', 0),
(139, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=139', 1, 'nav_menu_item', '', 0),
(140, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=140', 1, 'nav_menu_item', '', 0),
(141, 1, '2021-02-28 06:55:56', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:56', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=141', 1, 'nav_menu_item', '', 0),
(143, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=143', 1, 'nav_menu_item', '', 0),
(144, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=144', 1, 'nav_menu_item', '', 0),
(145, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=145', 1, 'nav_menu_item', '', 0),
(146, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=146', 1, 'nav_menu_item', '', 0),
(147, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=147', 1, 'nav_menu_item', '', 0),
(148, 1, '2021-02-28 06:57:40', '2021-02-28 06:57:40', ' ', '', '', 'publish', 'closed', 'closed', '', '148', '', '', '2021-02-28 07:04:45', '2021-02-28 07:04:45', '', 0, 'http://localhost/tourphoria/?p=148', 3, 'nav_menu_item', '', 0),
(149, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=149', 1, 'nav_menu_item', '', 0),
(150, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=150', 1, 'nav_menu_item', '', 0),
(151, 1, '2021-02-28 06:55:57', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 06:55:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=151', 1, 'nav_menu_item', '', 0),
(152, 1, '2021-02-28 07:00:17', '0000-00-00 00:00:00', ' ', '', '', 'draft', 'closed', 'closed', '', '', '', '', '2021-02-28 07:00:17', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?p=152', 1, 'nav_menu_item', '', 0),
(153, 1, '2021-02-28 07:03:34', '2021-02-28 07:03:34', '', 'All listing', '', 'publish', 'closed', 'closed', '', 'all-listing', '', '', '2021-02-28 07:03:34', '2021-02-28 07:03:34', '', 0, 'http://localhost/tourphoria/?page_id=153', 0, 'page', '', 0),
(154, 1, '2021-02-28 07:01:51', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2021-02-28 07:01:51', '0000-00-00 00:00:00', '', 0, 'http://localhost/tourphoria/?page_id=154', 0, 'page', '', 0),
(155, 1, '2021-02-28 07:03:34', '2021-02-28 07:03:34', '', 'All listing', '', 'inherit', 'closed', 'closed', '', '153-revision-v1', '', '', '2021-02-28 07:03:34', '2021-02-28 07:03:34', '', 153, 'http://localhost/tourphoria/2021/02/28/153-revision-v1/', 0, 'revision', '', 0),
(156, 1, '2021-02-28 07:04:45', '2021-02-28 07:04:45', ' ', '', '', 'publish', 'closed', 'closed', '', '156', '', '', '2021-02-28 07:04:45', '2021-02-28 07:04:45', '', 0, 'http://localhost/tourphoria/?p=156', 4, 'nav_menu_item', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_activity`
--

CREATE TABLE `wp_st_activity` (
  `post_id` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_booking_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_people` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sale_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price_from` date DEFAULT NULL,
  `sale_price_to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_activity_availability`
--

CREATE TABLE `wp_st_activity_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `starttime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_starttime` int(11) DEFAULT 1,
  `number` int(11) DEFAULT 0,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupday` int(11) DEFAULT NULL,
  `number_booked` int(11) DEFAULT 0,
  `booking_period` int(11) DEFAULT 0,
  `is_base` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_availability`
--

CREATE TABLE `wp_st_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `starttime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_starttime` int(11) DEFAULT 1,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupday` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `number_booked` int(11) DEFAULT 0,
  `parent_id` bigint(20) DEFAULT NULL,
  `allow_full_day` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_end` int(11) DEFAULT NULL,
  `booking_period` int(11) DEFAULT NULL,
  `is_base` int(11) DEFAULT NULL,
  `adult_number` int(11) DEFAULT NULL,
  `child_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_cars`
--

CREATE TABLE `wp_st_cars` (
  `post_id` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cars_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cars_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_car` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cars_booking_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sale_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price_from` date DEFAULT NULL,
  `sale_price_to` date DEFAULT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_cronjob_log`
--

CREATE TABLE `wp_st_cronjob_log` (
  `id` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_flights`
--

CREATE TABLE `wp_st_flights` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `iata_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_from` int(11) DEFAULT NULL,
  `iata_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_to` int(11) DEFAULT NULL,
  `flight_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `airline` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_flight_airport`
--

CREATE TABLE `wp_st_flight_airport` (
  `id` bigint(20) NOT NULL,
  `airport_id` int(11) DEFAULT NULL,
  `iata_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_flight_availability`
--

CREATE TABLE `wp_st_flight_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eco_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_flight_location`
--

CREATE TABLE `wp_st_flight_location` (
  `id` bigint(20) NOT NULL,
  `airport_id` int(11) DEFAULT NULL,
  `map_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_zoom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_form_builder`
--

CREATE TABLE `wp_st_form_builder` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_form_builder`
--

INSERT INTO `wp_st_form_builder` (`id`, `name`, `meta`, `data_type`, `status`) VALUES
(1, 'Form 1', 'a:8:{i:0;a:9:{s:10:\"field_type\";s:10:\"first_name\";s:5:\"title\";s:10:\"First name\";s:4:\"name\";s:13:\"st_first_name\";s:8:\"required\";s:1:\"1\";s:11:\"placeholder\";s:10:\"First name\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";s:8:\"validate\";s:24:\"required|trim|strip_tags\";}i:1;a:9:{s:10:\"field_type\";s:9:\"last_name\";s:5:\"title\";s:9:\"Last name\";s:4:\"name\";s:12:\"st_last_name\";s:8:\"required\";s:1:\"1\";s:11:\"placeholder\";s:9:\"Last name\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";s:8:\"validate\";s:24:\"required|trim|strip_tags\";}i:2;a:9:{s:10:\"field_type\";s:10:\"user_email\";s:5:\"title\";s:5:\"Email\";s:4:\"name\";s:8:\"st_email\";s:8:\"required\";s:1:\"1\";s:11:\"placeholder\";s:5:\"Email\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";s:8:\"validate\";s:36:\"required|trim|strip_tags|valid_email\";}i:3;a:9:{s:10:\"field_type\";s:9:\"telephone\";s:5:\"title\";s:12:\"Phone number\";s:4:\"name\";s:8:\"st_phone\";s:8:\"required\";s:1:\"1\";s:11:\"placeholder\";s:5:\"Phone\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";s:8:\"validate\";s:24:\"required|trim|strip_tags\";}i:4;a:8:{s:10:\"field_type\";s:7:\"address\";s:5:\"title\";s:7:\"Address\";s:4:\"name\";s:10:\"st_address\";s:8:\"required\";s:1:\"1\";s:11:\"placeholder\";s:7:\"Address\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:0:\"\";s:9:\"custom_id\";s:0:\"\";}i:5;a:8:{s:10:\"field_type\";s:12:\"postcode_zip\";s:5:\"title\";s:12:\"Postcode/Zip\";s:4:\"name\";s:11:\"st_zip_code\";s:8:\"required\";s:0:\"\";s:11:\"placeholder\";s:12:\"Postcode/Zip\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";}i:6;a:8:{s:10:\"field_type\";s:8:\"apt_unit\";s:5:\"title\";s:8:\"Apt/Unit\";s:4:\"name\";s:11:\"st_apt_unit\";s:8:\"required\";s:0:\"\";s:11:\"placeholder\";s:8:\"Apt/Unit\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:5:\"col-6\";s:9:\"custom_id\";s:0:\"\";}i:7;a:8:{s:10:\"field_type\";s:8:\"textarea\";s:5:\"title\";s:15:\"Special Request\";s:4:\"name\";s:7:\"st_note\";s:8:\"required\";s:0:\"\";s:11:\"placeholder\";s:57:\"Notes about your order, e.g. special notes for  delivery.\";s:4:\"desc\";s:0:\"\";s:11:\"extra_class\";s:0:\"\";s:9:\"custom_id\";s:0:\"\";}}', 'a:8:{i:0;s:10:\"first_name\";i:1;s:9:\"last_name\";i:2;s:10:\"user_email\";i:3;s:9:\"telephone\";i:4;s:7:\"address\";i:5;s:12:\"postcode_zip\";i:6;s:8:\"apt_unit\";i:7;s:8:\"textarea\";}', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_hotel`
--

CREATE TABLE `wp_st_hotel` (
  `post_id` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_full_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_star` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_avg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel_booking_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sale_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_inbox`
--

CREATE TABLE `wp_st_inbox` (
  `id` bigint(20) NOT NULL,
  `is_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_journey_car`
--

CREATE TABLE `wp_st_journey_car` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_from` int(11) DEFAULT NULL,
  `transfer_to` int(11) DEFAULT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_return` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passenger` int(11) DEFAULT NULL,
  `price_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_location_nested`
--

CREATE TABLE `wp_st_location_nested` (
  `id` bigint(20) NOT NULL,
  `location_id` bigint(20) DEFAULT NULL,
  `location_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `left_key` bigint(20) DEFAULT NULL,
  `right_key` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_location_nested`
--

INSERT INTO `wp_st_location_nested` (`id`, `location_id`, `location_country`, `parent_id`, `left_key`, `right_key`, `name`, `fullname`, `language`, `status`) VALUES
(1, 0, NULL, 0, 1, 8, 'root', 'root', NULL, 'private_root'),
(2, 52, 'US', 1, 2, 7, 'USA', 'USA', 'en', 'publish'),
(3, 55, 'US', 2, 3, 4, 'New york', 'New york, USA', 'en', 'publish'),
(4, 58, 'US', 2, 5, 6, 'San Fancisco', 'San Fancisco, USA', 'en', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_location_relationships`
--

CREATE TABLE `wp_st_location_relationships` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `location_from` bigint(20) DEFAULT NULL,
  `location_to` bigint(20) DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_location_relationships`
--

INSERT INTO `wp_st_location_relationships` (`id`, `post_id`, `location_from`, `location_to`, `post_type`, `location_type`) VALUES
(1, 61, 52, 0, 'st_tours', 'multi_location'),
(2, 61, 55, 0, 'st_tours', 'multi_location');

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_member_packages`
--

CREATE TABLE `wp_st_member_packages` (
  `id` bigint(20) NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_subname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_price` float DEFAULT NULL,
  `package_services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_commission` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_item_upload` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_item_featured` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_member_packages_order`
--

CREATE TABLE `wp_st_member_packages_order` (
  `id` bigint(20) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_subname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_price` float DEFAULT NULL,
  `package_services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_commission` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_item_upload` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_item_featured` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner` int(11) DEFAULT NULL,
  `created` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_order_item_meta`
--

CREATE TABLE `wp_st_order_item_meta` (
  `id` bigint(20) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starttime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_booking_post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_booking_id` int(11) DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_num_search` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_timestamp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_timestamp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wc_order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `commission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `cancel_percent` int(11) DEFAULT NULL,
  `cancel_refund` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_refund_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `raw_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_origin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_price`
--

CREATE TABLE `wp_st_price` (
  `id` mediumint(9) NOT NULL,
  `post_id` int(11) NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_properties`
--

CREATE TABLE `wp_st_properties` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_rental`
--

CREATE TABLE `wp_st_rental` (
  `post_id` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_full_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rental_max_adult` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rental_max_children` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rentals_booking_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sale_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price_from` date DEFAULT NULL,
  `sale_price_to` date DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_rental_availability`
--

CREATE TABLE `wp_st_rental_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `number_booked` int(11) DEFAULT 0,
  `parent_id` bigint(20) DEFAULT NULL,
  `allow_full_day` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_end` int(11) DEFAULT NULL,
  `booking_period` int(11) DEFAULT NULL,
  `is_base` int(11) DEFAULT NULL,
  `adult_number` int(11) DEFAULT NULL,
  `child_number` int(11) DEFAULT NULL,
  `groupday` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_room_availability`
--

CREATE TABLE `wp_st_room_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `number_booked` int(11) DEFAULT 0,
  `parent_id` bigint(20) DEFAULT NULL,
  `allow_full_day` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_end` int(11) DEFAULT NULL,
  `booking_period` int(11) DEFAULT NULL,
  `is_base` int(11) DEFAULT NULL,
  `adult_number` int(11) DEFAULT NULL,
  `child_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_tours`
--

CREATE TABLE `wp_st_tours` (
  `post_id` int(11) DEFAULT NULL,
  `multi_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_people` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_tour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tours_booking_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sale_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price_from` date DEFAULT NULL,
  `sale_price_to` date DEFAULT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_tours`
--

INSERT INTO `wp_st_tours` (`post_id`, `multi_location`, `id_location`, `address`, `price`, `sale_price`, `child_price`, `adult_price`, `infant_price`, `min_price`, `max_people`, `type_tour`, `check_in`, `check_out`, `rate_review`, `duration_day`, `tours_booking_period`, `is_sale_schedule`, `discount`, `sale_price_from`, `sale_price_to`, `price_type`) VALUES
(61, '', '', 'new york', '', '100', '10', '100', '0', '0', '', 'daily_tour', '', '', '0', '', '0', 'off', '', '0000-00-00', '0000-00-00', 'person'),
(62, '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_tour_availability`
--

CREATE TABLE `wp_st_tour_availability` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `check_in` int(11) DEFAULT NULL,
  `check_out` int(11) DEFAULT NULL,
  `starttime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_starttime` int(11) DEFAULT 1,
  `number` int(11) DEFAULT 0,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `infant_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupday` int(11) DEFAULT NULL,
  `number_booked` int(11) DEFAULT 0,
  `booking_period` int(11) DEFAULT 0,
  `is_base` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_tour_availability`
--

INSERT INTO `wp_st_tour_availability` (`id`, `post_id`, `check_in`, `check_out`, `starttime`, `count_starttime`, `number`, `price`, `adult_price`, `child_price`, `infant_price`, `status`, `groupday`, `number_booked`, `booking_period`, `is_base`) VALUES
(81, 61, 1691020800, 1691020800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(82, 61, 1667433600, 1667433600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(83, 61, 1675382400, 1675382400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(84, 61, 1677801600, 1677801600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(85, 61, 1654214400, 1654214400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(86, 61, 1630627200, 1630627200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(87, 61, 1698969600, 1698969600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(88, 61, 1638489600, 1638489600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(89, 61, 1617408000, 1617408000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(90, 61, 1685750400, 1685750400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(91, 61, 1612137600, 1612137600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(92, 61, 1614556800, 1614556800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(93, 61, 1682899200, 1682899200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(94, 61, 1659312000, 1659312000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(95, 61, 1635724800, 1635724800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(96, 61, 1643673600, 1643673600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(97, 61, 1646092800, 1646092800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(98, 61, 1622505600, 1622505600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(99, 61, 1690848000, 1690848000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(100, 61, 1667260800, 1667260800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(101, 61, 1625270400, 1625270400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(102, 61, 1662163200, 1662163200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(103, 61, 1670025600, 1670025600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(104, 61, 1609718400, 1609718400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(105, 61, 1649030400, 1649030400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(106, 61, 1656892800, 1656892800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(107, 61, 1693785600, 1693785600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(108, 61, 1633305600, 1633305600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(109, 61, 1701648000, 1701648000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(110, 61, 1641254400, 1641254400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(111, 61, 1675209600, 1675209600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(112, 61, 1677628800, 1677628800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(113, 61, 1654041600, 1654041600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(114, 61, 1630454400, 1630454400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(115, 61, 1698796800, 1698796800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(116, 61, 1638316800, 1638316800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(117, 61, 1617235200, 1617235200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(118, 61, 1685577600, 1685577600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(119, 61, 1625097600, 1625097600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(120, 61, 1661990400, 1661990400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(121, 61, 1680566400, 1680566400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(122, 61, 1620086400, 1620086400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(123, 61, 1688428800, 1688428800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(124, 61, 1664841600, 1664841600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(125, 61, 1672790400, 1672790400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(126, 61, 1651622400, 1651622400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(127, 61, 1628035200, 1628035200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(128, 61, 1696377600, 1696377600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(129, 61, 1612396800, 1612396800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(130, 61, 1614816000, 1614816000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(131, 61, 1669852800, 1669852800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(132, 61, 1609459200, 1609459200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(133, 61, 1648771200, 1648771200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(134, 61, 1656633600, 1656633600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(135, 61, 1693526400, 1693526400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(136, 61, 1633046400, 1633046400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(137, 61, 1701388800, 1701388800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(138, 61, 1640995200, 1640995200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(139, 61, 1680307200, 1680307200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(140, 61, 1619827200, 1619827200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(141, 61, 1683158400, 1683158400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(142, 61, 1659571200, 1659571200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(143, 61, 1635984000, 1635984000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(144, 61, 1643932800, 1643932800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(145, 61, 1646352000, 1646352000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(146, 61, 1622764800, 1622764800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(147, 61, 1691107200, 1691107200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(148, 61, 1667520000, 1667520000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(149, 61, 1675468800, 1675468800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(150, 61, 1677888000, 1677888000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(151, 61, 1688169600, 1688169600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(152, 61, 1664582400, 1664582400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(153, 61, 1672617600, 1672617600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(154, 61, 1651449600, 1651449600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(155, 61, 1627862400, 1627862400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(156, 61, 1696204800, 1696204800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(157, 61, 1612224000, 1612224000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(158, 61, 1614643200, 1614643200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(159, 61, 1682985600, 1682985600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(160, 61, 1659398400, 1659398400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(161, 61, 1654300800, 1654300800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(162, 61, 1630713600, 1630713600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(163, 61, 1699056000, 1699056000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(164, 61, 1638576000, 1638576000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(165, 61, 1617580800, 1617580800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(166, 61, 1685923200, 1685923200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(167, 61, 1625443200, 1625443200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(168, 61, 1662336000, 1662336000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(169, 61, 1670198400, 1670198400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(170, 61, 1609804800, 1609804800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(171, 61, 1635811200, 1635811200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(172, 61, 1643760000, 1643760000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(173, 61, 1646179200, 1646179200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(174, 61, 1622592000, 1622592000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(175, 61, 1690934400, 1690934400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(176, 61, 1667347200, 1667347200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(177, 61, 1675296000, 1675296000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(178, 61, 1677715200, 1677715200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(179, 61, 1654128000, 1654128000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(180, 61, 1630540800, 1630540800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(181, 61, 1649116800, 1649116800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(182, 61, 1656979200, 1656979200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(183, 61, 1693872000, 1693872000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(184, 61, 1633392000, 1633392000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(185, 61, 1701734400, 1701734400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(186, 61, 1641340800, 1641340800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(187, 61, 1680652800, 1680652800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(188, 61, 1620172800, 1620172800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(189, 61, 1688515200, 1688515200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(190, 61, 1664928000, 1664928000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(191, 61, 1698883200, 1698883200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(192, 61, 1638403200, 1638403200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(193, 61, 1617321600, 1617321600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(194, 61, 1685664000, 1685664000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(195, 61, 1625184000, 1625184000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(196, 61, 1662076800, 1662076800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(197, 61, 1669939200, 1669939200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(198, 61, 1609545600, 1609545600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(199, 61, 1648857600, 1648857600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(200, 61, 1656720000, 1656720000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(201, 61, 1672876800, 1672876800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(202, 61, 1651708800, 1651708800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(203, 61, 1628121600, 1628121600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(204, 61, 1696464000, 1696464000, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(205, 61, 1612483200, 1612483200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(206, 61, 1614902400, 1614902400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(207, 61, 1683244800, 1683244800, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(208, 61, 1659657600, 1659657600, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(209, 61, 1636070400, 1636070400, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(210, 61, 1644019200, 1644019200, '', 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1),
(211, 61, 1693612800, 1693612800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(212, 61, 1633132800, 1633132800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(213, 61, 1701475200, 1701475200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(214, 61, 1641168000, 1641168000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(215, 61, 1680480000, 1680480000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(216, 61, 1620000000, 1620000000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(217, 61, 1688342400, 1688342400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(218, 61, 1664755200, 1664755200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(219, 61, 1672704000, 1672704000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(220, 61, 1651536000, 1651536000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(221, 61, 1646438400, 1646438400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(222, 61, 1622851200, 1622851200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(223, 61, 1691193600, 1691193600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(224, 61, 1667606400, 1667606400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(225, 61, 1675641600, 1675641600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(226, 61, 1678060800, 1678060800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(227, 61, 1654473600, 1654473600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(228, 61, 1630886400, 1630886400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(229, 61, 1699228800, 1699228800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(230, 61, 1638748800, 1638748800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(231, 61, 1627948800, 1627948800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(232, 61, 1696291200, 1696291200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(233, 61, 1612310400, 1612310400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(234, 61, 1614729600, 1614729600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(235, 61, 1683072000, 1683072000, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(236, 61, 1659484800, 1659484800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(237, 61, 1635897600, 1635897600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(238, 61, 1643846400, 1643846400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(239, 61, 1646265600, 1646265600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(240, 61, 1622678400, 1622678400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(241, 61, 1617667200, 1617667200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(242, 61, 1686009600, 1686009600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(243, 61, 1625529600, 1625529600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(244, 61, 1662422400, 1662422400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(245, 61, 1670284800, 1670284800, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(246, 61, 1609891200, 1609891200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(247, 61, 1649203200, 1649203200, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(248, 61, 1657065600, 1657065600, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(249, 61, 1693958400, 1693958400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(250, 61, 1633478400, 1633478400, '', 1, 0, '0', '0', '0', '0', 'available', 0, 0, 0, 1),
(251, 61, 1630800000, 1630800000, NULL, 1, 0, '0', '100', '10', '0', 'available', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_user_online`
--

CREATE TABLE `wp_st_user_online` (
  `ID` bigint(20) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_st_user_online`
--

INSERT INTO `wp_st_user_online` (`ID`, `ip`, `dt`, `item_id`) VALUES
(1, '::1', '1614489555', 0),
(2, '::1', '1614847194', 27),
(3, '::1', '1614489555', 18),
(4, '::1', '1614499277', 30),
(5, '::1', '1614495505', 39),
(6, '::1', '1614495510', 42),
(7, '::1', '1614489555', 61),
(8, '::1', '1614493671', 52),
(9, '::1', '1614847182', 10),
(10, '::1', '1614495500', 9),
(11, '::1', '1614847176', 153),
(12, '::1', '1614847189', 8);

-- --------------------------------------------------------

--
-- Table structure for table `wp_st_withdrawal`
--

CREATE TABLE `wp_st_withdrawal` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payout` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_payout` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'simple', 'simple', 0),
(3, 'grouped', 'grouped', 0),
(4, 'variable', 'variable', 0),
(5, 'external', 'external', 0),
(6, 'exclude-from-search', 'exclude-from-search', 0),
(7, 'exclude-from-catalog', 'exclude-from-catalog', 0),
(8, 'featured', 'featured', 0),
(9, 'outofstock', 'outofstock', 0),
(10, 'rated-1', 'rated-1', 0),
(11, 'rated-2', 'rated-2', 0),
(12, 'rated-3', 'rated-3', 0),
(13, 'rated-4', 'rated-4', 0),
(14, 'rated-5', 'rated-5', 0),
(15, 'Uncategorized', 'uncategorized', 0),
(16, 'Ecotourism', 'ecotourism', 0),
(17, 'Escorted Tour', 'escorted-tour', 0),
(18, 'Menu 1', 'menu-1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(61, 16, 0),
(129, 18, 0),
(130, 18, 0),
(148, 18, 0),
(156, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'product_type', '', 0, 0),
(3, 3, 'product_type', '', 0, 0),
(4, 4, 'product_type', '', 0, 0),
(5, 5, 'product_type', '', 0, 0),
(6, 6, 'product_visibility', '', 0, 0),
(7, 7, 'product_visibility', '', 0, 0),
(8, 8, 'product_visibility', '', 0, 0),
(9, 9, 'product_visibility', '', 0, 0),
(10, 10, 'product_visibility', '', 0, 0),
(11, 11, 'product_visibility', '', 0, 0),
(12, 12, 'product_visibility', '', 0, 0),
(13, 13, 'product_visibility', '', 0, 0),
(14, 14, 'product_visibility', '', 0, 0),
(15, 15, 'product_cat', '', 0, 0),
(16, 16, 'st_tour_type', '', 0, 1),
(17, 17, 'st_tour_type', '', 0, 0),
(18, 18, 'nav_menu', '', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wte_admin_tour_wp_pointer,vc_pointers_frontend_editor,vc_pointers_backend_editor'),
(15, 1, 'show_welcome_panel', '0'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"9645fe71d9f785fb03321bd3bb145482689bbfd2c05b7f40908987c45e800758\";a:4:{s:10:\"expiration\";i:1615020033;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";s:5:\"login\";i:1614847233;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '4'),
(18, 1, '_woocommerce_tracks_anon_id', 'woo:iMCKb1HUroHnBmhGY+M5yhV8'),
(19, 1, 'wc_last_active', '1614816000'),
(20, 1, 'closedpostboxes_dashboard', 'a:0:{}'),
(21, 1, 'metaboxhidden_dashboard', 'a:5:{i:0;s:21:\"dashboard_site_health\";i:1;s:19:\"dashboard_right_now\";i:2;s:18:\"dashboard_activity\";i:3;s:21:\"dashboard_quick_press\";i:4;s:17:\"dashboard_primary\";}'),
(22, 1, '_order_count', '0'),
(23, 1, 'wp_user-settings', 'libraryContent=browse&edit_element_vcUIPanelWidth=646&edit_element_vcUIPanelLeft=683px&edit_element_vcUIPanelTop=74px&editor=tinymce'),
(24, 1, 'wp_user-settings-time', '1614493156'),
(25, 1, 'closedpostboxes_page', 'a:0:{}'),
(26, 1, 'metaboxhidden_page', 'a:10:{i:0;s:30:\"st_hotel_search_result_options\";i:1;s:29:\"st_tour_search_result_options\";i:2;s:33:\"st_activity_search_result_options\";i:3;s:31:\"st_rental_search_result_options\";i:4;s:12:\"revisionsdiv\";i:5;s:10:\"postcustom\";i:6;s:16:\"commentstatusdiv\";i:7;s:11:\"commentsdiv\";i:8;s:7:\"slugdiv\";i:9;s:9:\"authordiv\";}'),
(27, 1, 'meta-box-order_page', 'a:3:{s:4:\"side\";s:59:\"submitdiv,pageparentdiv,st_page_metabox_option,postimagediv\";s:6:\"normal\";s:263:\"st_hotel_search_result_options,st_tour_search_result_options,st_activity_search_result_options,st_rental_search_result_options,wpb_visual_composer,st_footer_social,st_car_search_result_options,revisionsdiv,postcustom,commentstatusdiv,commentsdiv,slugdiv,authordiv\";s:8:\"advanced\";s:0:\"\";}'),
(28, 1, 'screen_layout_page', '2'),
(29, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),
(30, 1, 'metaboxhidden_nav-menus', 'a:12:{i:0;s:21:\"add-post-type-product\";i:1;s:22:\"add-post-type-st_tours\";i:2;s:22:\"add-post-type-location\";i:3;s:22:\"add-post-type-st_order\";i:4;s:24:\"add-post-type-st_layouts\";i:5;s:28:\"add-post-type-st_coupon_code\";i:6;s:12:\"add-post_tag\";i:7;s:15:\"add-post_format\";i:8;s:15:\"add-product_cat\";i:9;s:15:\"add-product_tag\";i:10;s:16:\"add-st_tour_type\";i:11;s:20:\"add-st_location_type\";}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$Bmp0ihTzL1L9LAPmeGf.aEOSbma7gd.', 'admin', 'kchaouanis26@gmail.com', 'http://localhost/tourphoria', '2021-02-26 14:59:13', '', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_admin_notes`
--

CREATE TABLE `wp_wc_admin_notes` (
  `note_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_reminder` datetime DEFAULT NULL,
  `is_snoozable` tinyint(1) NOT NULL DEFAULT 0,
  `layout` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_wc_admin_notes`
--

INSERT INTO `wp_wc_admin_notes` (`note_id`, `name`, `type`, `locale`, `title`, `content`, `content_data`, `status`, `source`, `date_created`, `date_reminder`, `is_snoozable`, `layout`, `image`, `is_deleted`, `icon`) VALUES
(1, 'wc-admin-manage-store-activity-from-home-screen', 'info', 'en_US', 'New! Manage your store activity from the Home screen', 'Start your day knowing the next steps you need to take with your orders, products, and customer feedback.<br /><br />Read more about how to use the activity panels on the Home screen.', '{}', 'unactioned', 'woocommerce-admin', '2021-02-26 18:23:23', NULL, 0, 'plain', '', 0, 'info'),
(2, 'wc-admin-onboarding-email-marketing', 'info', 'en_US', 'Sign up for tips, product updates, and inspiration', 'We\'re here for you - get tips, product updates and inspiration straight to your email box', '{}', 'unactioned', 'woocommerce-admin', '2021-02-26 18:23:24', NULL, 0, 'plain', '', 0, 'info'),
(3, 'wc-admin-marketing-intro', 'info', 'en_US', 'Connect with your audience', 'Grow your customer base and increase your sales with marketing tools built for WooCommerce.', '{}', 'unactioned', 'woocommerce-admin', '2021-02-26 18:23:24', NULL, 0, 'plain', '', 0, 'info'),
(4, 'wc-admin-wc-helper-connection', 'info', 'en_US', 'Connect to WooCommerce.com', 'Connect to get important product notifications and updates.', '{}', 'unactioned', 'woocommerce-admin', '2021-02-26 18:23:24', NULL, 0, 'plain', '', 0, 'info'),
(5, 'facebook_pixel_api_2021', 'marketing', 'en_US', 'Improve the performance of your Facebook ads', 'Enable Facebook Pixel and Conversions API through the latest version of Facebook for WooCommerce for improved performance and measurement of your Facebook ad campaigns.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(6, 'facebook_ec_2021', 'marketing', 'en_US', 'Sync your product catalog with Facebook to help boost sales', 'A single click adds all products to your Facebook Business Page shop. Product changes are automatically synced, with the flexibility to control which products are listed.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(7, 'ecomm-need-help-setting-up-your-store', 'info', 'en_US', 'Need help setting up your Store?', 'Schedule a free 30-min <a href=\"https://wordpress.com/support/concierge-support/\">quick start session</a> and get help from our specialists. We’re happy to walk through setup steps, show you around the WordPress.com dashboard, troubleshoot any issues you may have, and help you the find the features you need to accomplish your goals for your site.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(8, 'woocommerce-services', 'info', 'en_US', 'WooCommerce Shipping & Tax', 'WooCommerce Shipping &amp; Tax helps get your store “ready to sell” as quickly as possible. You create your products. We take care of tax calculation, payment processing, and shipping label printing! Learn more about the extension that you just installed.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(9, 'ecomm-unique-shopping-experience', 'info', 'en_US', 'For a shopping experience as unique as your customers', 'Product Add-Ons allow your customers to personalize products while they’re shopping on your online store. No more follow-up email requests—customers get what they want, before they’re done checking out. Learn more about this extension that comes included in your plan.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(10, 'wc-admin-getting-started-in-ecommerce', 'info', 'en_US', 'Getting Started in eCommerce - webinar', 'We want to make eCommerce and this process of getting started as easy as possible for you. Watch this webinar to get tips on how to have our store up and running in a breeze.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(11, 'your-first-product', 'info', 'en_US', 'Your first product', 'That\'s huge! You\'re well on your way to building a successful online store — now it’s time to think about how you\'ll fulfill your orders.<br /><br />Read our shipping guide to learn best practices and options for putting together your shipping strategy. And for WooCommerce stores in the United States, you can print discounted shipping labels via USPS with <a href=\"https://href.li/?https://woocommerce.com/shipping\" target=\"_blank\">WooCommerce Shipping</a>.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(12, 'wc-square-apple-pay-boost-sales', 'marketing', 'en_US', 'Boost sales with Apple Pay', 'Now that you accept Apple Pay® with Square you can increase conversion rates by letting your customers know that Apple Pay® is available. Here’s a marketing guide to help you get started.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(13, 'wc-square-apple-pay-grow-your-business', 'marketing', 'en_US', 'Grow your business with Square and Apple Pay ', 'Now more than ever, shoppers want a fast, simple, and secure online checkout experience. Increase conversion rates by letting your customers know that you now accept Apple Pay®.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(14, 'wc-admin-optimizing-the-checkout-flow', 'info', 'en_US', 'Optimizing the checkout flow', 'It\'s crucial to get your store\'s checkout as smooth as possible to avoid losing sales. Let\'s take a look at how you can optimize the checkout experience for your shoppers.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(15, 'wc-admin-first-five-things-to-customize', 'info', 'en_US', 'The first 5 things to customize in your store', 'Deciding what to start with first is tricky. To help you properly prioritize, we\'ve put together this short list of the first few things you should customize in WooCommerce.', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(16, 'wc-admin-effortless-payments-by-mollie', 'info', 'en_US', 'Effortless payments by Mollie', 'Offer global and local payment methods, get onboarded in minutes and supported in your language – try it now!', '{}', 'pending', 'woocommerce.com', '2021-02-26 18:23:25', NULL, 0, 'plain', '', 0, 'info'),
(17, 'wc-admin-choosing-a-theme', 'marketing', 'en_US', 'Choosing a theme?', 'Check out the themes that are compatible with WooCommerce and choose one aligned with your brand and business needs.', '{}', 'unactioned', 'woocommerce-admin', '2021-02-27 22:49:25', NULL, 0, 'plain', '', 0, 'info'),
(18, 'wc-admin-insight-first-product-and-payment', 'survey', 'en_US', 'Insight', 'More than 80% of new merchants add the first product and have at least one payment method set up during the first week. We\'re here to help your business succeed! Do you find this type of insight useful?', '{}', 'unactioned', 'woocommerce-admin', '2021-02-27 22:49:25', NULL, 0, 'plain', '', 0, 'info'),
(19, 'wc-admin-mobile-app', 'info', 'en_US', 'Install Woo mobile app', 'Install the WooCommerce mobile app to manage orders, receive sales notifications, and view key metrics — wherever you are.', '{}', 'unactioned', 'woocommerce-admin', '2021-03-04 08:39:29', NULL, 0, 'plain', '', 0, 'info'),
(20, 'wc-admin-onboarding-payments-reminder', 'info', 'en_US', 'Start accepting payments on your store!', 'Take payments with the provider that’s right for you - choose from 100+ payment gateways for WooCommerce.', '{}', 'unactioned', 'woocommerce-admin', '2021-03-04 08:39:29', NULL, 0, 'plain', '', 0, 'info'),
(21, 'wc-admin-add-first-product-note', 'email', 'en_US', 'Store setup', 'Nice one, you’ve created a WooCommerce store! Now it’s time to add your first product.<br /><br />There are three ways to add your products: you can <strong>create products manually, import them at once via CSV file</strong>, or <strong>migrate them from another service</strong>.<br /><br /><a href=\"https://docs.woocommerce.com/document/managing-products/?utm_source=help_panel\">Explore our docs</a> for more information, or just get started!', '{\"role\":\"administrator\"}', 'sent', 'woocommerce-admin', '2021-03-04 08:39:29', NULL, 0, 'plain', 'http://localhost/tourphoria/wp-content/plugins/woocommerce/packages/woocommerce-admin/images/admin_notes/img-product-light.png', 0, 'info'),
(22, 'wc-admin-adding-and-managing-products', 'info', 'en_US', 'Adding and Managing Products', 'Learn more about how to set up products in WooCommerce through our useful documentation about adding and managing products.', '{}', 'unactioned', 'woocommerce-admin', '2021-03-04 08:39:29', NULL, 0, 'plain', '', 0, 'info');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_admin_note_actions`
--

CREATE TABLE `wp_wc_admin_note_actions` (
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `note_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `query` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `actioned_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_wc_admin_note_actions`
--

INSERT INTO `wp_wc_admin_note_actions` (`action_id`, `note_id`, `name`, `label`, `query`, `status`, `is_primary`, `actioned_text`) VALUES
(1, 1, 'learn-more', 'Learn more', 'https://docs.woocommerce.com/document/home-screen/?utm_source=inbox', 'actioned', 1, ''),
(2, 2, 'yes-please', 'Yes please!', 'https://woocommerce.us8.list-manage.com/subscribe/post?u=2c1434dc56f9506bf3c3ecd21&amp;id=13860df971&amp;SIGNUPPAGE=plugin', 'actioned', 0, ''),
(3, 3, 'open-marketing-hub', 'Open marketing hub', 'http://localhost/tourphoria/wp-admin/admin.php?page=wc-admin&path=/marketing', 'actioned', 0, ''),
(4, 4, 'connect', 'Connect', '?page=wc-addons&section=helper', 'unactioned', 0, ''),
(29, 17, 'visit-the-theme-marketplace', 'Visit the theme marketplace', 'https://woocommerce.com/product-category/themes/?utm_source=inbox', 'actioned', 0, ''),
(30, 18, 'affirm-insight-first-product-and-payment', 'Yes', '', 'actioned', 0, 'Thanks for your feedback'),
(139, 19, 'learn-more', 'Learn more', 'https://woocommerce.com/mobile/', 'actioned', 0, ''),
(140, 20, 'view-payment-gateways', 'Learn more', 'https://woocommerce.com/product-category/woocommerce-extensions/payment-gateways/', 'actioned', 1, ''),
(141, 21, 'add-first-product', 'Add a product', 'http://localhost/tourphoria/wp-admin/admin.php?page=wc-admin&task=products', 'actioned', 0, ''),
(142, 22, 'learn-more', 'Learn more', 'https://docs.woocommerce.com/document/managing-products/?utm_source=inbox', 'actioned', 0, ''),
(143, 5, 'upgrade_now_facebook_pixel_api', 'Upgrade now', 'plugin-install.php?tab=plugin-information&plugin=&section=changelog', 'actioned', 1, ''),
(144, 6, 'learn_more_facebook_ec', 'Learn more', 'https://woocommerce.com/products/facebook/', 'unactioned', 1, ''),
(145, 7, 'set-up-concierge', 'Schedule free session', 'https://wordpress.com/me/concierge', 'actioned', 1, ''),
(146, 8, 'learn-more', 'Learn more', 'https://docs.woocommerce.com/document/woocommerce-shipping-and-tax/?utm_source=inbox', 'unactioned', 1, ''),
(147, 9, 'learn-more-ecomm-unique-shopping-experience', 'Learn more', 'https://docs.woocommerce.com/document/product-add-ons/?utm_source=inbox', 'actioned', 1, ''),
(148, 10, 'watch-the-webinar', 'Watch the webinar', 'https://youtu.be/V_2XtCOyZ7o', 'actioned', 1, ''),
(149, 11, 'learn-more', 'Learn more', 'https://woocommerce.com/posts/ecommerce-shipping-solutions-guide/?utm_source=inbox', 'actioned', 1, ''),
(150, 12, 'boost-sales-marketing-guide', 'See marketing guide', 'https://developer.apple.com/apple-pay/marketing/?utm_source=inbox&utm_campaign=square-boost-sales', 'actioned', 1, ''),
(151, 13, 'grow-your-business-marketing-guide', 'See marketing guide', 'https://developer.apple.com/apple-pay/marketing/?utm_source=inbox&utm_campaign=square-grow-your-business', 'actioned', 1, ''),
(152, 14, 'optimizing-the-checkout-flow', 'Learn more', 'https://woocommerce.com/posts/optimizing-woocommerce-checkout?utm_source=inbox', 'actioned', 1, ''),
(153, 15, 'learn-more', 'Learn more', 'https://woocommerce.com/posts/first-things-customize-woocommerce/?utm_source=inbox', 'unactioned', 1, ''),
(154, 16, 'install-mollie', 'Install Mollie', 'https://wordpress.org/plugins/mollie-payments-for-woocommerce/', 'actioned', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_category_lookup`
--

CREATE TABLE `wp_wc_category_lookup` (
  `category_tree_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_wc_category_lookup`
--

INSERT INTO `wp_wc_category_lookup` (`category_tree_id`, `category_id`) VALUES
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_customer_lookup`
--

CREATE TABLE `wp_wc_customer_lookup` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_last_active` timestamp NULL DEFAULT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `country` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `postcode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_download_log`
--

CREATE TABLE `wp_wc_download_log` (
  `download_log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_order_coupon_lookup`
--

CREATE TABLE `wp_wc_order_coupon_lookup` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount_amount` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_order_product_lookup`
--

CREATE TABLE `wp_wc_order_product_lookup` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_qty` int(11) NOT NULL,
  `product_net_revenue` double NOT NULL DEFAULT 0,
  `product_gross_revenue` double NOT NULL DEFAULT 0,
  `coupon_amount` double NOT NULL DEFAULT 0,
  `tax_amount` double NOT NULL DEFAULT 0,
  `shipping_amount` double NOT NULL DEFAULT 0,
  `shipping_tax_amount` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_order_stats`
--

CREATE TABLE `wp_wc_order_stats` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `num_items_sold` int(11) NOT NULL DEFAULT 0,
  `total_sales` double NOT NULL DEFAULT 0,
  `tax_total` double NOT NULL DEFAULT 0,
  `shipping_total` double NOT NULL DEFAULT 0,
  `net_total` double NOT NULL DEFAULT 0,
  `returning_customer` tinyint(1) DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_order_tax_lookup`
--

CREATE TABLE `wp_wc_order_tax_lookup` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipping_tax` double NOT NULL DEFAULT 0,
  `order_tax` double NOT NULL DEFAULT 0,
  `total_tax` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_product_meta_lookup`
--

CREATE TABLE `wp_wc_product_meta_lookup` (
  `product_id` bigint(20) NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `virtual` tinyint(1) DEFAULT 0,
  `downloadable` tinyint(1) DEFAULT 0,
  `min_price` decimal(19,4) DEFAULT NULL,
  `max_price` decimal(19,4) DEFAULT NULL,
  `onsale` tinyint(1) DEFAULT 0,
  `stock_quantity` double DEFAULT NULL,
  `stock_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'instock',
  `rating_count` bigint(20) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `total_sales` bigint(20) DEFAULT 0,
  `tax_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'taxable',
  `tax_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_reserved_stock`
--

CREATE TABLE `wp_wc_reserved_stock` (
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `stock_quantity` double NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_tax_rate_classes`
--

CREATE TABLE `wp_wc_tax_rate_classes` (
  `tax_rate_class_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_wc_tax_rate_classes`
--

INSERT INTO `wp_wc_tax_rate_classes` (`tax_rate_class_id`, `name`, `slug`) VALUES
(1, 'Reduced rate', 'reduced-rate'),
(2, 'Zero rate', 'zero-rate');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_webhooks`
--

CREATE TABLE `wp_wc_webhooks` (
  `webhook_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_version` smallint(4) NOT NULL,
  `failure_count` smallint(10) NOT NULL DEFAULT 0,
  `pending_delivery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_api_keys`
--

CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_key` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_secret` char(43) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nonces` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truncated_key` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_access` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_attribute_taxonomies`
--

CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_label` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_orderby` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_downloadable_product_permissions`
--

CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `download_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `order_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `downloads_remaining` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_log`
--

CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_itemmeta`
--

CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_items`
--

CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokenmeta`
--

CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `payment_token_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokens`
--

CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_sessions`
--

CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `session_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_expiry` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_woocommerce_sessions`
--

INSERT INTO `wp_woocommerce_sessions` (`session_id`, `session_key`, `session_value`, `session_expiry`) VALUES
(2, '1', 'a:7:{s:4:\"cart\";s:6:\"a:0:{}\";s:11:\"cart_totals\";s:367:\"a:15:{s:8:\"subtotal\";i:0;s:12:\"subtotal_tax\";i:0;s:14:\"shipping_total\";i:0;s:12:\"shipping_tax\";i:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";i:0;s:12:\"discount_tax\";i:0;s:19:\"cart_contents_total\";i:0;s:17:\"cart_contents_tax\";i:0;s:19:\"cart_contents_taxes\";a:0:{}s:9:\"fee_total\";i:0;s:7:\"fee_tax\";i:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";i:0;s:9:\"total_tax\";i:0;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:6:\"a:0:{}\";s:8:\"customer\";s:710:\"a:26:{s:2:\"id\";s:1:\"1\";s:13:\"date_modified\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:0:\"\";s:7:\"country\";s:2:\"GB\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:0:\"\";s:16:\"shipping_country\";s:2:\"GB\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:22:\"kchaouanis26@gmail.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";}', 1615020037);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zones`
--

CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zone_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_order` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_locations`
--

CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_methods`
--

CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `instance_id` bigint(20) UNSIGNED NOT NULL,
  `method_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_order` bigint(20) UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rates`
--

CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_country` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT 0,
  `tax_rate_shipping` int(1) NOT NULL DEFAULT 1,
  `tax_rate_order` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_class` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rate_locations`
--

CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_actionscheduler_actions`
--
ALTER TABLE `wp_actionscheduler_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `hook` (`hook`),
  ADD KEY `status` (`status`),
  ADD KEY `scheduled_date_gmt` (`scheduled_date_gmt`),
  ADD KEY `args` (`args`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `last_attempt_gmt` (`last_attempt_gmt`),
  ADD KEY `claim_id` (`claim_id`);

--
-- Indexes for table `wp_actionscheduler_claims`
--
ALTER TABLE `wp_actionscheduler_claims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `date_created_gmt` (`date_created_gmt`);

--
-- Indexes for table `wp_actionscheduler_groups`
--
ALTER TABLE `wp_actionscheduler_groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `slug` (`slug`(191));

--
-- Indexes for table `wp_actionscheduler_logs`
--
ALTER TABLE `wp_actionscheduler_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `action_id` (`action_id`),
  ADD KEY `log_date_gmt` (`log_date_gmt`);

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10)),
  ADD KEY `woo_idx_comment_type` (`comment_type`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_st_activity_availability`
--
ALTER TABLE `wp_st_activity_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ST_AVAILABILITY` (`post_id`,`check_in`);

--
-- Indexes for table `wp_st_availability`
--
ALTER TABLE `wp_st_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ST_AVAILABILITY` (`post_id`,`check_in`);

--
-- Indexes for table `wp_st_cronjob_log`
--
ALTER TABLE `wp_st_cronjob_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_flights`
--
ALTER TABLE `wp_st_flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_flight_airport`
--
ALTER TABLE `wp_st_flight_airport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_flight_availability`
--
ALTER TABLE `wp_st_flight_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_flight_location`
--
ALTER TABLE `wp_st_flight_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_form_builder`
--
ALTER TABLE `wp_st_form_builder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_inbox`
--
ALTER TABLE `wp_st_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_journey_car`
--
ALTER TABLE `wp_st_journey_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_location_nested`
--
ALTER TABLE `wp_st_location_nested`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_location_relationships`
--
ALTER TABLE `wp_st_location_relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_member_packages`
--
ALTER TABLE `wp_st_member_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_member_packages_order`
--
ALTER TABLE `wp_st_member_packages_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_order_item_meta`
--
ALTER TABLE `wp_st_order_item_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_price`
--
ALTER TABLE `wp_st_price`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wp_st_properties`
--
ALTER TABLE `wp_st_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_st_rental_availability`
--
ALTER TABLE `wp_st_rental_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ST_AVAILABILITY` (`post_id`,`check_in`);

--
-- Indexes for table `wp_st_room_availability`
--
ALTER TABLE `wp_st_room_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ST_AVAILABILITY` (`post_id`,`check_in`);

--
-- Indexes for table `wp_st_tour_availability`
--
ALTER TABLE `wp_st_tour_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ST_AVAILABILITY` (`post_id`,`check_in`);

--
-- Indexes for table `wp_st_user_online`
--
ALTER TABLE `wp_st_user_online`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_st_withdrawal`
--
ALTER TABLE `wp_st_withdrawal`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `wp_wc_admin_notes`
--
ALTER TABLE `wp_wc_admin_notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `wp_wc_admin_note_actions`
--
ALTER TABLE `wp_wc_admin_note_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `note_id` (`note_id`);

--
-- Indexes for table `wp_wc_category_lookup`
--
ALTER TABLE `wp_wc_category_lookup`
  ADD PRIMARY KEY (`category_tree_id`,`category_id`);

--
-- Indexes for table `wp_wc_customer_lookup`
--
ALTER TABLE `wp_wc_customer_lookup`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  ADD PRIMARY KEY (`download_log_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `wp_wc_order_coupon_lookup`
--
ALTER TABLE `wp_wc_order_coupon_lookup`
  ADD PRIMARY KEY (`order_id`,`coupon_id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `date_created` (`date_created`);

--
-- Indexes for table `wp_wc_order_product_lookup`
--
ALTER TABLE `wp_wc_order_product_lookup`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `date_created` (`date_created`);

--
-- Indexes for table `wp_wc_order_stats`
--
ALTER TABLE `wp_wc_order_stats`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `status` (`status`(191));

--
-- Indexes for table `wp_wc_order_tax_lookup`
--
ALTER TABLE `wp_wc_order_tax_lookup`
  ADD PRIMARY KEY (`order_id`,`tax_rate_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `date_created` (`date_created`);

--
-- Indexes for table `wp_wc_product_meta_lookup`
--
ALTER TABLE `wp_wc_product_meta_lookup`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `virtual` (`virtual`),
  ADD KEY `downloadable` (`downloadable`),
  ADD KEY `stock_status` (`stock_status`),
  ADD KEY `stock_quantity` (`stock_quantity`),
  ADD KEY `onsale` (`onsale`),
  ADD KEY `min_max_price` (`min_price`,`max_price`);

--
-- Indexes for table `wp_wc_reserved_stock`
--
ALTER TABLE `wp_wc_reserved_stock`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `wp_wc_tax_rate_classes`
--
ALTER TABLE `wp_wc_tax_rate_classes`
  ADD PRIMARY KEY (`tax_rate_class_id`),
  ADD UNIQUE KEY `slug` (`slug`(191));

--
-- Indexes for table `wp_wc_webhooks`
--
ALTER TABLE `wp_wc_webhooks`
  ADD PRIMARY KEY (`webhook_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  ADD PRIMARY KEY (`key_id`),
  ADD KEY `consumer_key` (`consumer_key`),
  ADD KEY `consumer_secret` (`consumer_secret`);

--
-- Indexes for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `attribute_name` (`attribute_name`(20));

--
-- Indexes for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(16),`download_id`),
  ADD KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_order_remaining_expires` (`user_id`,`order_id`,`downloads_remaining`,`access_expires`);

--
-- Indexes for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `payment_token_id` (`payment_token_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_key` (`session_key`);

--
-- Indexes for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- Indexes for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  ADD PRIMARY KEY (`instance_id`);

--
-- Indexes for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`),
  ADD KEY `tax_rate_country` (`tax_rate_country`),
  ADD KEY `tax_rate_state` (`tax_rate_state`(2)),
  ADD KEY `tax_rate_class` (`tax_rate_class`(10)),
  ADD KEY `tax_rate_priority` (`tax_rate_priority`);

--
-- Indexes for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_actionscheduler_actions`
--
ALTER TABLE `wp_actionscheduler_actions`
  MODIFY `action_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `wp_actionscheduler_claims`
--
ALTER TABLE `wp_actionscheduler_claims`
  MODIFY `claim_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `wp_actionscheduler_groups`
--
ALTER TABLE `wp_actionscheduler_groups`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_actionscheduler_logs`
--
ALTER TABLE `wp_actionscheduler_logs`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=835;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `wp_st_activity_availability`
--
ALTER TABLE `wp_st_activity_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_availability`
--
ALTER TABLE `wp_st_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_flights`
--
ALTER TABLE `wp_st_flights`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_flight_airport`
--
ALTER TABLE `wp_st_flight_airport`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_flight_availability`
--
ALTER TABLE `wp_st_flight_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_flight_location`
--
ALTER TABLE `wp_st_flight_location`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_form_builder`
--
ALTER TABLE `wp_st_form_builder`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_st_inbox`
--
ALTER TABLE `wp_st_inbox`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_journey_car`
--
ALTER TABLE `wp_st_journey_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_location_nested`
--
ALTER TABLE `wp_st_location_nested`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wp_st_location_relationships`
--
ALTER TABLE `wp_st_location_relationships`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_st_member_packages`
--
ALTER TABLE `wp_st_member_packages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_member_packages_order`
--
ALTER TABLE `wp_st_member_packages_order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_order_item_meta`
--
ALTER TABLE `wp_st_order_item_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_price`
--
ALTER TABLE `wp_st_price`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_properties`
--
ALTER TABLE `wp_st_properties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_rental_availability`
--
ALTER TABLE `wp_st_rental_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_room_availability`
--
ALTER TABLE `wp_st_room_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_st_tour_availability`
--
ALTER TABLE `wp_st_tour_availability`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `wp_st_user_online`
--
ALTER TABLE `wp_st_user_online`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wp_st_withdrawal`
--
ALTER TABLE `wp_st_withdrawal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_wc_admin_notes`
--
ALTER TABLE `wp_wc_admin_notes`
  MODIFY `note_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wp_wc_admin_note_actions`
--
ALTER TABLE `wp_wc_admin_note_actions`
  MODIFY `action_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `wp_wc_customer_lookup`
--
ALTER TABLE `wp_wc_customer_lookup`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  MODIFY `download_log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_wc_tax_rate_classes`
--
ALTER TABLE `wp_wc_tax_rate_classes`
  MODIFY `tax_rate_class_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_wc_webhooks`
--
ALTER TABLE `wp_wc_webhooks`
  MODIFY `webhook_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  MODIFY `key_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  MODIFY `attribute_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  MODIFY `order_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  MODIFY `token_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  MODIFY `zone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  MODIFY `instance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  MODIFY `tax_rate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  ADD CONSTRAINT `fk_wp_wc_download_log_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `wp_woocommerce_downloadable_product_permissions` (`permission_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
