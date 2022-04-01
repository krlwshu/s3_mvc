-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for actemium_hf
CREATE DATABASE IF NOT EXISTS `actemium_hf` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `actemium_hf`;

-- Dumping structure for table actemium_hf.appraisals
CREATE TABLE IF NOT EXISTS `appraisals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'New',
  `assigned_by` int(11) DEFAULT 0,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `scheduled_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_appraisals_app_templates` (`template_id`),
  KEY `FK_appraisals_sys_users` (`user_id`),
  CONSTRAINT `FK_appraisals_app_templates` FOREIGN KEY (`template_id`) REFERENCES `app_templates` (`id`),
  CONSTRAINT `FK_appraisals_sys_users` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=363 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.appraisals: ~5 rows (approximately)
/*!40000 ALTER TABLE `appraisals` DISABLE KEYS */;
INSERT INTO `appraisals` (`id`, `user_id`, `template_id`, `due_date`, `status`, `assigned_by`, `date_created`, `scheduled_date`) VALUES
	(31, 2, 3, NULL, 'New', 0, '2022-03-21 00:19:16', NULL),
	(42, 1, 2, NULL, 'New', 0, '2022-03-30 21:57:17', NULL),
	(44, 1, 3, NULL, 'Complete', 0, '2022-03-30 21:57:59', NULL),
	(361, 1, 3, NULL, 'Review', 0, '2022-04-01 01:09:43', NULL),
	(362, 1, 3, NULL, 'New', 0, '2022-04-01 01:09:43', NULL);
/*!40000 ALTER TABLE `appraisals` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.app_data
CREATE TABLE IF NOT EXISTS `app_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `response` varchar(300) DEFAULT NULL,
  `resp_value` int(11) DEFAULT NULL,
  `appraisal_id` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__sys_users` (`user_id`),
  KEY `FK_app_data_app_temp_questions` (`question_id`),
  KEY `FK__appraisals` (`appraisal_id`),
  CONSTRAINT `FK__appraisals` FOREIGN KEY (`appraisal_id`) REFERENCES `appraisals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__sys_users` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_data: ~25 rows (approximately)
/*!40000 ALTER TABLE `app_data` DISABLE KEYS */;
INSERT INTO `app_data` (`id`, `user_id`, `response`, `resp_value`, `appraisal_id`, `date_created`, `question_id`) VALUES
	(21, 2, '10', NULL, 31, '2022-03-23 10:17:28', 24),
	(22, 2, 'Lorem ipsum dolor sit amet, qui minim disappointed labore adipisicing minim sint cillum sint consectetur cupidatat.', NULL, 31, NULL, 25),
	(23, 2, 'Lorem ipsum dolor sit amet, qui minim going well happy with labore adipisicing minim sint cillum sint consectetur cupidatat.', NULL, 31, NULL, 26),
	(24, 2, 'Lorem ipsum dolor sit amet, qui minim going well labore adipisicing minim sint need support cillum sint consectetur cupidatat.', NULL, 31, NULL, 27),
	(95, 1, '6', 6, 44, '2022-03-30 21:57:59', 24),
	(96, 1, '1', 1, 44, '2022-03-30 21:57:59', 25),
	(97, 1, '2', 2, 44, '2022-03-30 21:57:59', 26),
	(98, 1, 'dsf', NULL, 44, '2022-03-30 21:57:59', 27),
	(99, 1, 'sdfgfdssdss', NULL, 44, '2022-03-30 21:57:59', 28),
	(100, 1, 'sdfssddsssz', NULL, 44, '2022-03-30 21:57:59', 29),
	(101, 1, 'sdfsfssgfdz', NULL, 44, '2022-03-30 21:57:59', 30),
	(116, 1, '3', 3, 361, '2022-04-01 01:09:43', 24),
	(117, 1, '3', 3, 361, '2022-04-01 01:09:43', 25),
	(118, 1, '3', 3, 361, '2022-04-01 01:09:43', 26),
	(119, 1, 'vb', NULL, 361, '2022-04-01 01:09:43', 27),
	(120, 1, 'vb', NULL, 361, '2022-04-01 01:09:43', 28),
	(121, 1, 'vb', NULL, 361, '2022-04-01 01:09:43', 29),
	(122, 1, 'vb', NULL, 361, '2022-04-01 01:09:43', 30),
	(123, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 24),
	(124, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 25),
	(125, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 26),
	(126, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 27),
	(127, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 28),
	(128, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 29),
	(129, 1, NULL, NULL, 362, '2022-04-01 01:09:43', 30);
/*!40000 ALTER TABLE `app_data` ENABLE KEYS */;

-- Dumping structure for view actemium_hf.app_data_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `app_data_view` (
	`id` INT(11) NOT NULL,
	`template_name` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`atp_id` INT(11) NOT NULL,
	`question` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`response` VARCHAR(300) NULL COLLATE 'utf8mb4_general_ci',
	`resp_value` INT(11) NULL,
	`resp_id` INT(11) NULL,
	`user_id` INT(11) NULL,
	`date_created` TIMESTAMP NULL,
	`option_group` INT(11) NULL,
	`question_type` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table actemium_hf.app_templates
CREATE TABLE IF NOT EXISTS `app_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_templates: ~4 rows (approximately)
/*!40000 ALTER TABLE `app_templates` DISABLE KEYS */;
INSERT INTO `app_templates` (`id`, `template_name`, `created_by`, `visibility`, `date_created`) VALUES
	(1, 'New Starter Review', NULL, NULL, '2022-03-18 18:20:02'),
	(2, 'Junior Engineer', NULL, NULL, '2022-03-18 18:20:16'),
	(3, 'Work - Life Balance', NULL, NULL, '2022-03-18 18:21:03'),
	(4, 'Senior Engineer', NULL, NULL, '2022-03-18 18:21:14');
/*!40000 ALTER TABLE `app_templates` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.app_temp_questions
CREATE TABLE IF NOT EXISTS `app_temp_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) DEFAULT NULL,
  `question_type` varchar(250) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `option_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_app_temp_questions_app_templates` (`template_id`),
  CONSTRAINT `FK_app_temp_questions_app_templates` FOREIGN KEY (`template_id`) REFERENCES `app_templates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_temp_questions: ~7 rows (approximately)
/*!40000 ALTER TABLE `app_temp_questions` DISABLE KEYS */;
INSERT INTO `app_temp_questions` (`id`, `question`, `question_type`, `template_id`, `option_group`) VALUES
	(24, 'In the last year the things I did that had a positive impact on the performance of the business were', 'SR', 3, NULL),
	(25, 'In the last year the things I did that had a positive impact on my customers work', 'MC', 3, 1),
	(26, 'In the last year the things I did that had a positive impact on my fellow engineers were..', 'MC', 3, 1),
	(27, 'In the last year the new skills I learnt and understand to have gained are', 'FT', 3, NULL),
	(28, 'In the last year the partnerships I have built and strengthened with people are ', 'FT', 3, NULL),
	(29, 'The role I would be like to be doing in the future and my timescale for achieving this', 'FT', 3, NULL),
	(30, 'The things I don’t like doing in my current role are', 'FT', 3, NULL);
/*!40000 ALTER TABLE `app_temp_questions` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.question_options
CREATE TABLE IF NOT EXISTS `question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(50) DEFAULT NULL,
  `opt_group_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_question_options_question_option_groups` (`opt_group_id`),
  CONSTRAINT `FK_question_options_question_option_groups` FOREIGN KEY (`opt_group_id`) REFERENCES `question_option_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.question_options: ~5 rows (approximately)
/*!40000 ALTER TABLE `question_options` DISABLE KEYS */;
INSERT INTO `question_options` (`id`, `option`, `opt_group_id`, `order`, `date_created`) VALUES
	(1, 'Strongly agree', 1, 1, NULL),
	(2, 'Agree', 1, 2, NULL),
	(3, 'Disagree', 1, 5, NULL),
	(4, 'Strongly disagree', 1, 3, NULL),
	(5, 'Neutral', 1, 4, NULL);
/*!40000 ALTER TABLE `question_options` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.question_option_groups
CREATE TABLE IF NOT EXISTS `question_option_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.question_option_groups: ~0 rows (approximately)
/*!40000 ALTER TABLE `question_option_groups` DISABLE KEYS */;
INSERT INTO `question_option_groups` (`id`, `group_name`, `date_created`) VALUES
	(1, 'Agreement level', '2022-03-22 21:46:04');
/*!40000 ALTER TABLE `question_option_groups` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `belt` varchar(50) DEFAULT NULL,
  `line_manager` int(11) NOT NULL DEFAULT 0,
  `role` varchar(50) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.staff: ~4 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `name`, `belt`, `line_manager`, `role`, `date_created`) VALUES
	(1, 'Jon', ' Green', 0, '0', '2022-03-18 18:04:42'),
	(2, 'Jack', 'Yellow', 0, '0', '2022-03-18 18:04:42'),
	(3, 'Sarah', 'White', 0, '0', '2022-03-18 18:04:42'),
	(4, 'Lucy', 'Black', 0, '0', '2022-03-18 18:04:42');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.sys_users
CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.sys_users: ~6 rows (approximately)
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` (`id`, `email`, `name`, `password`, `role`, `date_created`) VALUES
	(1, 'John@test.com', 'Jon', 'Karl1234', 'eng', '2022-03-18 17:40:24'),
	(2, 'Jack@test.com', 'Jack', NULL, 'eng', '2022-03-18 17:40:24'),
	(3, 'Sarah@test.com', 'Sarah', NULL, 'eng', '2022-03-18 17:40:24'),
	(4, 'Lucy@test.com', 'Lucy', NULL, 'eng', '2022-03-18 17:40:24'),
	(5, 'Manager@test.com', NULL, NULL, 'eng', '2022-03-20 15:54:02'),
	(6, 'karl.webster@outlook.com', 'Karl', 'Karl1234', 'pm', '2022-03-30 16:55:01');
/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;

-- Dumping structure for trigger actemium_hf.appraisals_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `appraisals_after_insert` AFTER INSERT ON `appraisals` FOR EACH ROW BEGIN

INSERT INTO app_data (user_id, appraisal_id, question_id)
SELECT NEW.user_id AS 'user_id', NEW.id AS 'app_id', id FROM app_temp_questions WHERE template_id = NEW.template_id;


END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view actemium_hf.app_data_view
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `app_data_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `app_data_view` AS select `a`.`id` AS `id`,
`atemp`.`template_name` AS `template_name`,
`atp`.`id` AS `atp_id`,
`atp`.`question` AS `question`,
`ad`.`response` AS `response`,
`ad`.`resp_value` AS `resp_value`,
ad.id AS resp_id,
`a`.`user_id` AS `user_id`,
`a`.`date_created` AS `date_created`,
`atp`.`option_group` AS `option_group`,
`atp`.`question_type` AS `question_type` 
from (((`appraisals` `a` left join `app_data` `ad` on((`ad`.`appraisal_id` = `a`.`id`))) join `app_temp_questions` `atp` on((`ad`.`question_id` = `atp`.`id`))) join `app_templates` `atemp` on((`a`.`template_id` = `atemp`.`id`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
