-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.4.24-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog`;

-- Listage de la structure de table blog. posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  KEY `id` (`id`),
  KEY `id_user` (`id_user`),
  KEY `author_pseudo` (`author`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- Listage des données de la table blog.posts : ~0 rows (environ)

-- Listage de la structure de table blog. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `profil_picture` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `isLoggedIn` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `pseudo` (`pseudo`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Listage des données de la table blog.users : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
