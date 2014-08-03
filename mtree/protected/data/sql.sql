-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2014 at 02:02 AM
-- Server version: 5.5.37-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+11:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE IF NOT EXISTS tariff_info (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `description` text,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CREATE TABLE IF NOT EXISTS tarif_options (
#   `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
#   `name` varchar(100),
#   `description` text,
#
#   PRIMARY KEY (`id`)
# ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# CREATE TABLE IF NOT EXISTS `to_ids` (
#   `id` int(4) unsigned NOT NULL,
#   `tarif_id` int(4) unsigned NOT NULL,
#   `option_id` int(4) unsigned NOT NULL,
#
#   PRIMARY KEY (`id`),
#   KEY `tarif_id` (`tarif_id`),
#   KEY `option_id` (`option_id`)
# ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `tariff_id` int(4) unsigned DEFAULT NULL,
  `head_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `head_id` (`head_id`),
  KEY `tariff_id` (`tariff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `tree` text NOT NULL,
  `creator_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tree_data` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answers` text NOT NULL,
  `creator_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tree_bookmark` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `tree_id` int(4) unsigned DEFAULT NULL,
  `user_id` int(4) unsigned DEFAULT NULL,
  `question_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `tree_id` (`tree_id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
ADD CONSTRAINT `fk_user_head` FOREIGN KEY (`head_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_user_tariff` FOREIGN KEY (`tariff_id`) REFERENCES `tariff_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `tree`
ADD CONSTRAINT `fk_data_tree` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `tree_data`
ADD CONSTRAINT `fk_data_user` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `tree_bookmark`
ADD CONSTRAINT `fk_book_tree` FOREIGN KEY (`tree_id`) REFERENCES `tree` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_book_quest` FOREIGN KEY (`question_id`) REFERENCES `tree_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `users` VALUES
  ('', 'admin', 'admin', 'admin admin admin', 'nowert@mail.ru', '123456789', 'Test company', NULL, NULL),
  ('', 'client', 'client', 'client', 'client@client.client', '123456789', 'Test company', NULL, NULL);
INSERT INTO `tree` (`id`, `tree`, `creator_id`) VALUES
  ('', '[{''question'':1,''answers'':[{question:1,''answers'':[{''question'':1},{''question'':2},{''question'':3}]},{''question'':2},{''question'':3}]},{''question'':1,''answers'':[{''question'':2},{''question'':3},{''question'':2}]}]', 1),
  ('', '[{''question'':1,''answers'':[{question:1,''answers'':[{''question'':1},{''question'':2},{''question'':3}]},{''question'':2},{''question'':3}]},{''question'':1,''answers'':[{''question'':2},{''question'':3},{''question'':2}]}]', 1);
INSERT INTO `tree_data` (`id`, `question`, `answers`) VALUES
  ('', 'Q1', 'A1\r\nA2\r\nA3'),
  ('', 'Q2', 'A1\r\nA2\r\nA3'),
  ('', 'Q3', 'A1\r\nA2\r\nA3\r\nA4\r\nA5');


UPDATE  `mtree`.`tree` SET  `id` =  '1' WHERE  `tree`.`id` =11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
