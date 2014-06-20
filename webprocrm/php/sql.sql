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

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_service` tinyint,
  `order_time` tinyint,
  `order_start` date,
  `order_end` date ,
  `order_status` varchar (100),


  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `order_doc` (
  `order_id` int(10) unsigned NOT NULL,
  `doc_id` int(10) unsigned NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Database: `webprocrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `doc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doc_path` varchar(100) NOT NULL,
  `doc_date` date DEFAULT NULL,
  `doc_name` varchar(100) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` VALUES
  (1, '/doc/t22.txt', '2014-06-19', '1 DOC'),
  (2, '/doc/test.txt', '2014-06-20', '2 DOC');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `perm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perm_desc` varchar(50) NOT NULL,
  `perm_name` varchar(30) NOT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` VALUES
  (1, 'view content', 'view'),
  (2, 'edit content', 'edit'),
  (3, 'extra edit content', 'extra');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` VALUES
  (1, 'admin'),
  (2, 'client'),
  (3, 'manager'),
  (4, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE IF NOT EXISTS `role_perm` (
  `role_id` int(10) unsigned NOT NULL,
  `perm_id` int(10) unsigned NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `perm_id` (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` VALUES
  (1, 1),
  (1, 2),
  (1, 3),
  (2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(15) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `user_company` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_company` (`user_company`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES
  (1, 'admin', 'admin', 'admin admin admin', 'nowert@mail.ru', '123', 1),
  (2, 'client', 'client', 'client', 'client@client.client', '', NULL),
  (3, 'test', 'test', 'test', 'test@test.test', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_company`
--

CREATE TABLE IF NOT EXISTS `users_company` (
  `company_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users_company`
--

INSERT INTO `users_company` VALUES
  (1, 1, 'Web Pro', 'Somewhere near');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` VALUES
  (1, 1),
  (2, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



DROP TABLE IF EXISTS `br_acreinfo`;
CREATE TABLE IF NOT EXISTS `br_acreinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `address` text NOT NULL,
  `location` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `totalarea` float NOT NULL,
  `fid_realtor` int(11) NOT NULL,
  `fid_district` tinyint(4) NOT NULL,
  `fid_acreusage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid_realtor` (`fid_realtor`),
  KEY `fid_district` (`fid_district`),
  KEY `fid_acreusage` (`fid_acreusage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_acreusage`
--

DROP TABLE IF EXISTS `br_acreusage`;
CREATE TABLE IF NOT EXISTS `br_acreusage` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `acreusage` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_balcony`
--

DROP TABLE IF EXISTS `br_balcony`;
CREATE TABLE IF NOT EXISTS `br_balcony` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `balcony` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_cominfo`
--

DROP TABLE IF EXISTS `br_cominfo`;
CREATE TABLE IF NOT EXISTS `br_cominfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `address` text NOT NULL,
  `location` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `totalarea` float NOT NULL,
  `storey` smallint(6) NOT NULL,
  `fid_realtor` int(11) NOT NULL,
  `fid_district` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid_realtor` (`fid_realtor`),
  KEY `fid_district` (`fid_district`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_district`
--

DROP TABLE IF EXISTS `br_district`;
CREATE TABLE IF NOT EXISTS `br_district` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `fid_ptype` tinyint(4) NOT NULL,
  `district` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid_ptype` (`fid_ptype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_homeinfo`
--

DROP TABLE IF EXISTS `br_homeinfo`;
CREATE TABLE IF NOT EXISTS `br_homeinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `address` text NOT NULL,
  `location` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `totalarea` float NOT NULL,
  `livearea` float NOT NULL,
  `cookarea` float NOT NULL,
  `storey` smallint(6) NOT NULL,
  `fid_ptype` tinyint(4) NOT NULL,
  `fid_realtor` int(11) NOT NULL,
  `fid_room` tinyint(4) NOT NULL,
  `fid_district` tinyint(4) NOT NULL,
  `fid_hometype` tinyint(4) NOT NULL,
  `fid_planning` tinyint(4) NOT NULL,
  `fid_state` tinyint(4) NOT NULL,
  `fid_balcony` tinyint(4) NOT NULL,
  `fid_lavatory` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid_ptype` (`fid_ptype`),
  KEY `fid_realtor` (`fid_realtor`),
  KEY `fid_room` (`fid_room`),
  KEY `fid_district` (`fid_district`),
  KEY `fid_hometype` (`fid_hometype`),
  KEY `fid_planning` (`fid_planning`),
  KEY `fid_state` (`fid_state`),
  KEY `fid_balcony` (`fid_balcony`),
  KEY `fid_lavatory` (`fid_lavatory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=373 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_hometype`
--

DROP TABLE IF EXISTS `br_hometype`;
CREATE TABLE IF NOT EXISTS `br_hometype` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `hometype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_lavatory`
--

DROP TABLE IF EXISTS `br_lavatory`;
CREATE TABLE IF NOT EXISTS `br_lavatory` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lavatory` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_planning`
--

DROP TABLE IF EXISTS `br_planning`;
CREATE TABLE IF NOT EXISTS `br_planning` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `planning` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_ptype`
--

DROP TABLE IF EXISTS `br_ptype`;
CREATE TABLE IF NOT EXISTS `br_ptype` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ptype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_realtor`
--

DROP TABLE IF EXISTS `br_realtor`;
CREATE TABLE IF NOT EXISTS `br_realtor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `realtor` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_room`
--

DROP TABLE IF EXISTS `br_room`;
CREATE TABLE IF NOT EXISTS `br_room` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `room` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `br_state`
--

DROP TABLE IF EXISTS `br_state`;
CREATE TABLE IF NOT EXISTS `br_state` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `br_acreinfo`
--
ALTER TABLE `br_acreinfo`
ADD CONSTRAINT `br_acreinfo_ibfk_1` FOREIGN KEY (`fid_realtor`) REFERENCES `br_realtor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_acreinfo_ibfk_2` FOREIGN KEY (`fid_district`) REFERENCES `br_district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_acreinfo_ibfk_3` FOREIGN KEY (`fid_acreusage`) REFERENCES `br_acreusage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `br_cominfo`
--
ALTER TABLE `br_cominfo`
ADD CONSTRAINT `br_cominfo_ibfk_1` FOREIGN KEY (`fid_realtor`) REFERENCES `br_realtor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_cominfo_ibfk_2` FOREIGN KEY (`fid_district`) REFERENCES `br_district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `br_district`
--
ALTER TABLE `br_district`
ADD CONSTRAINT `br_district_ibfk_1` FOREIGN KEY (`fid_ptype`) REFERENCES `br_ptype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `br_homeinfo`
--
ALTER TABLE `br_homeinfo`
ADD CONSTRAINT `br_homeinfo_ibfk_1` FOREIGN KEY (`fid_ptype`) REFERENCES `br_ptype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_2` FOREIGN KEY (`fid_realtor`) REFERENCES `br_realtor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_3` FOREIGN KEY (`fid_room`) REFERENCES `br_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_4` FOREIGN KEY (`fid_district`) REFERENCES `br_district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_5` FOREIGN KEY (`fid_hometype`) REFERENCES `br_hometype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_6` FOREIGN KEY (`fid_planning`) REFERENCES `br_planning` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_7` FOREIGN KEY (`fid_state`) REFERENCES `br_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_8` FOREIGN KEY (`fid_balcony`) REFERENCES `br_balcony` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `br_homeinfo_ibfk_9` FOREIGN KEY (`fid_lavatory`) REFERENCES `br_lavatory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
