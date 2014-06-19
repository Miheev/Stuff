-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2014 at 08:57 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+11:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `core5429_brokdata`
--
-- CREATE DATABASE IF NOT EXISTS `core5429_brokdata` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `core5429_brokdata`;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE roles (
  role_id INTEGER NOT NULL AUTO_INCREMENT,
  role_name VARCHAR(50) NOT NULL,

  PRIMARY KEY (role_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE permissions (
  perm_id INTEGER NOT NULL AUTO_INCREMENT,
  perm_desc VARCHAR(50) NOT NULL,

  PRIMARY KEY (perm_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE role_perm (
  role_id INTEGER NOT NULL,
  perm_id INTEGER NOT NULL,

  CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (perm_id) REFERENCES permissions(perm_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE users (
  user_id INTEGER NOT NULL AUTO_INCREMENT,
  user_login varchar(15) NOT NULL,
  user_pass varchar(100) NOT NULL,
  user_name varchar(100) NOT NULL,
  user_email varchar(100),
  user_phone varchar(100),
  user_company integer,

  primary key (user_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE users_company (
  company_id INTEGER NOT NULL AUTO_INCREMENT,
  user_id INTEGER NOT NULL,
  company_name varchar(100),
  company_address varchar(100),

  primary key (company_id)
);

ALTER TABLE `users`
ADD CONSTRAINT foreign key (user_company) references users_company(company_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE users_company
add CONSTRAINT foreign key (user_id) references users(user_id) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE user_role (
  user_id INTEGER NOT NULL,
  role_id INTEGER NOT NULL,

  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(role_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


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
