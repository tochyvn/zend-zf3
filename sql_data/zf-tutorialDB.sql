-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.14 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour zf-tutorial
CREATE DATABASE IF NOT EXISTS `zf-tutorial` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zf-tutorial`;

-- Export de la structure de la table zf-tutorial. album
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Export de données de la table zf-tutorial.album : 9 rows
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` (`id`, `artist`, `title`) VALUES
	(1, 'The Military Wives', 'In My Dreams'),
	(2, 'Adele', '21'),
	(3, 'Bruce Springsteen', 'Wrecking Ball (Deluxe)'),
	(4, 'Lana Del Rey', 'Born To Die'),
	(5, 'Gotye', 'Making Mirrors'),
	(6, 'fhgffgfg', 'tgrtgdftg'),
	(7, 'Yvanov TOCHAP', 'IslamHouse'),
	(8, 'PHP Security', '<script>alert(\'Faille XSS\')</script>'),
	(9, 'PHP Security', '<script>alert(\'Faille XSS\')</script>');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;

-- Export de la structure de la table zf-tutorial. posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Export de données de la table zf-tutorial.posts : 5 rows
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `text`) VALUES
	(1, 'Blog #1', 'Welcome to my first blog post'),
	(2, 'Blog #2', 'Welcome to my second blog post'),
	(3, 'Blog #3', 'Welcome to my third blog post'),
	(4, 'Blog #4', 'Welcome to my fourth blog post'),
	(5, 'Blog #5', 'Welcome to my fifth blog post');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Export de la structure de la table zf-tutorial. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `real_name` varchar(150) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '0',
  `password_salt` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table zf-tutorial.users : 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `real_name`, `status`, `active`, `password_salt`) VALUES
	(1, 'my_username', 'a865a7e0ddbf35fa6f6a232e0893bea4', 'My Real Name', 'N/A', '1', 'ÍM§.z°UAµ-XÖGçÎèÏÔ[cà÷©9¸g');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
