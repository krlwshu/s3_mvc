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
  `scheduled_date` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `last_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_appraisals_app_templates` (`template_id`),
  KEY `FK_appraisals_staff` (`user_id`),
  CONSTRAINT `FK_appraisals_app_templates` FOREIGN KEY (`template_id`) REFERENCES `app_templates` (`id`),
  CONSTRAINT `FK_appraisals_staff` FOREIGN KEY (`user_id`) REFERENCES `staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=414 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.appraisals: ~5 rows (approximately)
/*!40000 ALTER TABLE `appraisals` DISABLE KEYS */;
INSERT INTO `appraisals` (`id`, `user_id`, `template_id`, `due_date`, `status`, `assigned_by`, `scheduled_date`, `date_created`, `last_updated`) VALUES
	(398, 4, 3, NULL, 'Review', 0, NULL, '2022-04-04 01:15:45', '2022-04-04 01:17:39'),
	(399, 3, 1, NULL, 'New', 0, NULL, '2022-04-04 01:35:20', '2022-04-04 01:35:20'),
	(400, 3, 3, NULL, 'New', 0, NULL, '2022-04-04 01:52:32', '2022-04-04 01:52:32'),
	(412, 1, 3, NULL, 'Review', 0, NULL, '2022-04-04 02:09:12', '2022-04-04 02:09:44'),
	(413, 2, 1, NULL, 'New', 0, NULL, '2022-04-04 02:13:13', '2022-04-04 02:13:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=578 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_data: ~40 rows (approximately)
/*!40000 ALTER TABLE `app_data` DISABLE KEYS */;
INSERT INTO `app_data` (`id`, `user_id`, `response`, `resp_value`, `appraisal_id`, `date_created`, `question_id`) VALUES
	(338, 4, 'Strongly agree', 1, 398, '2022-04-04 01:15:45', 39),
	(339, 4, 'I have a good work/life balance', 17, 398, '2022-04-04 01:15:45', 40),
	(340, 4, 'No', 12, 398, '2022-04-04 01:15:45', 41),
	(341, 4, 'Strongly disagree', 4, 398, '2022-04-04 01:15:45', 42),
	(342, 4, 'Nope!', NULL, 398, '2022-04-04 01:15:45', 43),
	(343, 4, 'Love it, give me more hours. I\'ll even work for free!', NULL, 398, '2022-04-04 01:15:45', 44),
	(344, 4, '10', 10, 398, '2022-04-04 01:15:45', 45),
	(345, 4, 'Free pizza!', NULL, 398, '2022-04-04 01:15:45', 46),
	(353, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 31),
	(354, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 32),
	(355, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 33),
	(356, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 34),
	(357, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 35),
	(358, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 36),
	(359, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 37),
	(360, 3, NULL, NULL, 399, '2022-04-04 01:35:20', 38),
	(368, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 39),
	(369, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 40),
	(370, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 41),
	(371, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 42),
	(372, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 43),
	(373, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 44),
	(374, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 45),
	(375, 3, NULL, NULL, 400, '2022-04-04 01:52:32', 46),
	(548, 1, 'Strongly agree', 1, 412, '2022-04-04 02:09:12', 39),
	(549, 1, 'I prioritize my job over my personal life', 13, 412, '2022-04-04 02:09:12', 40),
	(550, 1, 'Yes', 11, 412, '2022-04-04 02:09:12', 41),
	(551, 1, 'Strongly agree', 1, 412, '2022-04-04 02:09:12', 42),
	(552, 1, 'i', NULL, 412, '2022-04-04 02:09:12', 43),
	(553, 1, 'j', NULL, 412, '2022-04-04 02:09:12', 44),
	(554, 1, '10', 10, 412, '2022-04-04 02:09:12', 45),
	(555, 1, 'h', NULL, 412, '2022-04-04 02:09:12', 46),
	(563, 2, 'Disagree', 3, 413, '2022-04-04 02:13:13', 31),
	(564, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 32),
	(565, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 33),
	(566, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 34),
	(567, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 35),
	(568, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 36),
	(569, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 37),
	(570, 2, NULL, NULL, 413, '2022-04-04 02:13:13', 38);
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
	`date_created` DATETIME NULL,
	`option_group` INT(11) NULL,
	`question_type` VARCHAR(250) NULL COLLATE 'utf8mb4_general_ci',
	`question_id` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for table actemium_hf.app_review_actions
CREATE TABLE IF NOT EXISTS `app_review_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(250) NOT NULL DEFAULT '',
  `category` varchar(250) NOT NULL DEFAULT '',
  `status` varchar(50) NOT NULL DEFAULT 'New',
  `target_date` date NOT NULL,
  `assigned_to` int(11) NOT NULL DEFAULT 0,
  `app_data_id` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK__app_data_act` (`app_data_id`),
  KEY `FK_app_review_actions_sys_users` (`assigned_to`),
  CONSTRAINT `FK__app_data_act` FOREIGN KEY (`app_data_id`) REFERENCES `app_data` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_app_review_actions_sys_users` FOREIGN KEY (`assigned_to`) REFERENCES `sys_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_review_actions: ~0 rows (approximately)
/*!40000 ALTER TABLE `app_review_actions` DISABLE KEYS */;
INSERT INTO `app_review_actions` (`id`, `action`, `category`, `status`, `target_date`, `assigned_to`, `app_data_id`, `date_created`) VALUES
	(9, 'Organise free pizza!', 'pizza', 'New', '2022-04-17', 6, 345, '2022-04-04 01:18:51');
/*!40000 ALTER TABLE `app_review_actions` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.app_review_comments
CREATE TABLE IF NOT EXISTS `app_review_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL DEFAULT '',
  `app_data_id` int(11) NOT NULL DEFAULT 0,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK__sys_users_c` (`user_id`),
  KEY `FK__app_data` (`app_data_id`),
  CONSTRAINT `FK__app_data` FOREIGN KEY (`app_data_id`) REFERENCES `app_data` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK__sys_users_c` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_review_comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `app_review_comments` DISABLE KEYS */;
INSERT INTO `app_review_comments` (`id`, `user_id`, `comment`, `app_data_id`, `comment_date`) VALUES
	(25, 6, 'Consider it done!', 345, '2022-04-04 01:18:19'),
	(26, 6, 'jhkj', 548, '2022-04-04 02:10:11');
/*!40000 ALTER TABLE `app_review_comments` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.app_templates
CREATE TABLE IF NOT EXISTS `app_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_templates: ~2 rows (approximately)
/*!40000 ALTER TABLE `app_templates` DISABLE KEYS */;
INSERT INTO `app_templates` (`id`, `template_name`, `created_by`, `visibility`, `date_created`) VALUES
	(1, 'New Starter Review', NULL, NULL, '2022-03-18 18:20:02'),
	(3, 'Work - Life Balance', NULL, NULL, '2022-03-18 18:21:03');
/*!40000 ALTER TABLE `app_templates` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.app_temp_questions
CREATE TABLE IF NOT EXISTS `app_temp_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) DEFAULT NULL,
  `question_type` varchar(250) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `option_group` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_app_temp_questions_app_templates` (`template_id`),
  CONSTRAINT `FK_app_temp_questions_app_templates` FOREIGN KEY (`template_id`) REFERENCES `app_templates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.app_temp_questions: ~16 rows (approximately)
/*!40000 ALTER TABLE `app_temp_questions` DISABLE KEYS */;
INSERT INTO `app_temp_questions` (`id`, `question`, `question_type`, `template_id`, `option_group`, `order`) VALUES
	(31, 'I am comfortable with approaching my line manager if I have any concerns ', 'MC', 1, 1, 1),
	(32, 'I have been familiarised with the workplace/systems and can confidently navigate', 'MC', 1, 1, 4),
	(33, 'I can rely on my team to provide support where needed', 'MC', 1, 1, 3),
	(34, 'I feel my opinion is valued by the team', 'MC', 1, 1, 6),
	(35, 'Do you feel actemium can support you to achieve your career goals based on your experiences so far? ', 'FT', 1, NULL, 7),
	(36, 'I prefer to communicate my opinions', 'MC', 1, 1, 5),
	(37, 'I can execute a task well when I can contribute to the: ', 'MC', 1, 2, 2),
	(38, 'My overall satisfaction of working with Actemium is', 'SR', 1, NULL, 8),
	(39, 'Since transitioning into remote work I have found it easy to adjust', 'MC', 3, 1, 7),
	(40, 'Which of the following statements best describes your work/life balance', 'MC', 3, 4, 8),
	(41, 'Have you missed a personal event because of work?', 'MC', 3, 3, 6),
	(42, 'Do you feel your team leader/project manager respect your work life balance? ', 'MC', 3, 1, 3),
	(43, 'Have you ever suffered from work-related illness or burnout? If so please describe.', 'FT', 3, NULL, 5),
	(44, 'Are you currently satisfied with how many hours you work a week?', 'FT', 3, NULL, 1),
	(45, 'Do you feel you can cope with the number of tasks you have been given? (1-10 scale, 1 being ‘I can’t cope at all’ and 10 being ‘I can cope completely’) ', 'SR', 3, NULL, 2),
	(46, 'Do you have any suggestions on how the company can support you in developing a healthy work life balance?', 'FT', 3, NULL, 4);
/*!40000 ALTER TABLE `app_temp_questions` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.question_options
CREATE TABLE IF NOT EXISTS `question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(50) DEFAULT NULL,
  `opt_group_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `opt_color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question_options_question_option_groups` (`opt_group_id`),
  CONSTRAINT `FK_question_options_question_option_groups` FOREIGN KEY (`opt_group_id`) REFERENCES `question_option_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.question_options: ~15 rows (approximately)
/*!40000 ALTER TABLE `question_options` DISABLE KEYS */;
INSERT INTO `question_options` (`id`, `option`, `opt_group_id`, `order`, `date_created`, `opt_color`) VALUES
	(1, 'Strongly agree', 1, 1, NULL, '#2bff00'),
	(2, 'Agree', 1, 2, NULL, '#00ffae'),
	(3, 'Disagree', 1, 5, NULL, '#e38800'),
	(4, 'Strongly disagree', 1, 3, NULL, '#ed4763'),
	(5, 'Neutral', 1, 4, NULL, '#a1a1a1'),
	(6, 'Documentation', 2, 1, '2022-04-03 17:17:32', '#ff24cc'),
	(7, 'Planning', 2, 2, '2022-04-03 17:18:07', '#b4bf75'),
	(8, 'Leading of others', 2, 3, '2022-04-03 17:18:24', '#8675bf'),
	(9, 'Client communication', 2, 5, '2022-04-03 17:18:44', '#7596bf'),
	(10, 'Technical areas', 2, 4, '2022-04-03 17:19:04', '#bf75bf'),
	(11, 'Yes', 3, 1, '2022-04-03 17:34:40', '#3deb34'),
	(12, 'No', 3, 2, '2022-04-03 17:34:44', '#eb8334'),
	(13, 'I prioritize my job over my personal life', 4, 1, '2022-04-03 17:40:15', '#34e5eb'),
	(14, 'I prioritize my family over my work', 4, 2, '2022-04-03 17:40:34', '#3465eb'),
	(17, 'I have a good work/life balance', 4, 3, '2022-04-03 17:42:21', '#3deb34');
/*!40000 ALTER TABLE `question_options` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.question_option_groups
CREATE TABLE IF NOT EXISTS `question_option_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.question_option_groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `question_option_groups` DISABLE KEYS */;
INSERT INTO `question_option_groups` (`id`, `group_name`, `date_created`) VALUES
	(1, 'Agreement level', '2022-03-22 21:46:04'),
	(2, 'Strengths', '2022-04-03 17:16:12'),
	(3, 'Yes/No', '2022-04-03 17:34:28'),
	(4, 'Priorities WLB', '2022-04-03 17:39:30');
/*!40000 ALTER TABLE `question_option_groups` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.sentiment_dictionary
CREATE TABLE IF NOT EXISTS `sentiment_dictionary` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.sentiment_dictionary: ~0 rows (approximately)
/*!40000 ALTER TABLE `sentiment_dictionary` DISABLE KEYS */;
/*!40000 ALTER TABLE `sentiment_dictionary` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `belt` varchar(50) DEFAULT NULL,
  `line_manager` int(11) NOT NULL DEFAULT 0,
  `role` varchar(50) NOT NULL DEFAULT '0',
  `appraisal_period_days` int(11) DEFAULT 90,
  `user_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_staff_sys_users` (`line_manager`),
  KEY `FK_staff_sys_users_2` (`user_id`),
  CONSTRAINT `FK_staff_sys_users` FOREIGN KEY (`line_manager`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_staff_sys_users_2` FOREIGN KEY (`user_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.staff: ~3 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `name`, `belt`, `line_manager`, `role`, `appraisal_period_days`, `user_id`, `date_created`) VALUES
	(1, 'Jon Smith', ' Green', 6, '0', 90, 1, '2022-03-18 18:04:42'),
	(2, 'Jack Black', 'Yellow', 6, '0', 90, 2, '2022-03-18 18:04:42'),
	(3, 'Sarah Jones', 'White', 6, '0', 90, 3, '2022-03-18 18:04:42'),
	(4, 'Lucy Green', 'Black', 6, '0', 90, 4, '2022-03-18 18:04:42');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table actemium_hf.sys_users
CREATE TABLE IF NOT EXISTS `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table actemium_hf.sys_users: ~6 rows (approximately)
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` (`id`, `email`, `name`, `password`, `role`, `avatar`, `date_created`) VALUES
	(1, 'John@test.com', 'Jon', 'Karl1234', 'eng', '/assets/img/avatars/john-engineer.jpg', '2022-03-18 17:40:24'),
	(2, 'Jack@test.com', 'Jack', 'Karl1234', 'eng', '/assets/img/avatars/Jack.jpg', '2022-03-18 17:40:24'),
	(3, 'Sarah@test.com', 'Sarah', 'Karl1234', 'eng', '/assets/img/avatars/Sarah.jpg', '2022-03-18 17:40:24'),
	(4, 'Lucy@test.com', 'Lucy', 'Karl1234', 'eng', '/assets/img/avatars/Lucy.jpg', '2022-03-18 17:40:24'),
	(5, 'Manager@test.com', 'Test Manager', 'Karl1234', 'eng', '/assets/img/avatars/Jack.jpg', '2022-03-20 15:54:02'),
	(6, 'karl.webster@outlook.com', 'Karl', 'Karl1234', 'pm', '/assets/img/avatars/Jack.jpg', '2022-03-30 16:55:01');
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
`atp`.`question_type` AS `question_type`,
atp.id AS question_id
from (((`appraisals` `a` left join `app_data` `ad` on((`ad`.`appraisal_id` = `a`.`id`))) join `app_temp_questions` `atp` on((`ad`.`question_id` = `atp`.`id`))) join `app_templates` `atemp` on((`a`.`template_id` = `atemp`.`id`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
