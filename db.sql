-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.25 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица test-energoprof.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `body` text,
  `body_ext` text,
  `created` datetime DEFAULT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test-energoprof.pages: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`page_id`, `title`, `header`, `body`, `body_ext`, `created`, `changed`) VALUES
	(1, NULL, NULL, '4', NULL, NULL, '2017-07-20 23:19:37'),
	(2, 'Название страницы 2++', '"Краткое описание"е страницы 2', 'Текст"е страницы 2', 'Дополнительное страницы 2', '2017-07-21 14:19:21', '2017-07-21 14:36:30'),
	(3, 'Названиdе', '"Краткое описание"', 'Текст"', 'Дополнительно', '2017-07-21 14:19:45', '2017-07-21 14:20:00'),
	(4, 'Название3', '"Краткое описание"', 'Текст"', 'Дополнительно', '2017-07-21 14:20:44', '2017-07-21 14:20:44'),
	(5, 'Название3', '"Краткое описание"', 'Текст"', 'Дополнительно', '2017-07-21 14:21:20', '2017-07-21 14:21:20'),
	(6, 'Название3', '"Краткое описание"', 'Текст"', 'Дополнительно', '2017-07-21 14:22:35', '2017-07-21 14:22:35'),
	(7, 'Название3', '"Краткое описание"', 'Текст"', 'Дополнительно', '2017-07-21 14:23:09', '2017-07-21 14:23:09'),
	(14, '14', '14', '14', '', '2017-07-21 14:48:35', '2017-07-21 14:48:35'),
	(15, '15++', '15', '15', '', '2017-07-21 14:49:44', '2017-07-21 14:55:47');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Дамп структуры для таблица test-energoprof.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_group_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test-energoprof.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `login`, `password`, `active`, `user_group_id`) VALUES
	(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица test-energoprof.user_groups
CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_group_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`user_group_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test-energoprof.user_groups: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` (`user_group_id`, `name`) VALUES
	(1, 'администратор сайта');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
