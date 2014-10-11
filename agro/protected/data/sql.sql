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


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `available` bool DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `request` varchar(255) NOT NULL,
  `user_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1853;

CREATE TABLE IF NOT EXISTS `register` (
  /**
  1 Admin
   */
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
#   `pp` int(6) unsigned DEFAULT NULL,
  `sp` varchar(10) DEFAULT NULL,
  `fio_req` varchar(100) DEFAULT NULL, /*FK u.id*/
#   `reg_id` int(6) unsigned DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  `comment` text DEFAULT NULL,
/*Wheels Section*/
#   `mark` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `inv_id` int(6) unsigned DEFAULT NULL,
/**
2 Supplier
 */
  `fio_exec` varchar(100) DEFAULT NULL,
  `pact_id` varchar(50) DEFAULT NULL,
  `pact_date` date DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `agent_name` varchar(100) DEFAULT NULL,
  `account_id` varchar(50) DEFAULT NULL,
  `account_date` date DEFAULT NULL,
  `account_sum` DECIMAL(10,2) unsigned DEFAULT NULL,
  `date_out_real` date DEFAULT NULL,
  `date_out_plan` date DEFAULT NULL,
  `date_in_plan` date DEFAULT NULL,
  /**
  3 accountant
   */
  `date_in_real` date DEFAULT NULL,
  `date_in_real_sp` date DEFAULT NULL,
  /**
  4 financier
   */
  `pay_date` date DEFAULT NULL,
  `trust_id` varchar(50) DEFAULT NULL,
  /**
  5 Signers
   */

  `request_id` int(4) unsigned DEFAULT NULL, /**Fk**/

  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1853; /*AUTO_INCREMENT=1852 ;*/

CREATE TABLE IF NOT EXISTS `spares` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `mark` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `count` smallint(5) Unsigned NOT NULL,
  `cat_id` varchar(50) NOT NULL,
#   `cat_date` date NOT NULL,

  `register_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `register_id` (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reg_state` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,

  `admin` varchar(10) DEFAULT NULL, /*1*/

  `accountant` varchar(10) DEFAULT NULL, /*2*/
  `in_store` smallint(5) DEFAULT NULL,

  `supplier` varchar(10) DEFAULT NULL,

  `financier` varchar(10) DEFAULT NULL,
#   `sign_fin` bool DEFAULT NULL,

  `signer` varchar(10) DEFAULT NULL,
  `sign_exec` bool DEFAULT NULL,
  `sign_general` bool DEFAULT NULL,

  `register_id` int(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `register_id` (`register_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `request`
ADD CONSTRAINT `fk_request_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `register`
ADD CONSTRAINT `fk_register_request` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `spares`
ADD CONSTRAINT `fk_spares_register` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `reg_state`
ADD CONSTRAINT `fk_state_register` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `users` VALUES
  ('', 'admin@admin.admin',     'admin',  'admin admin admin',    '123456789', 'root',     1),
  ('', 'client@client.client',  'client', 'client client client', '123456789', 'requester', null),
  ('', 'q1@q.q',                '123',    'client client client', '123456789', 'requester', null),
  ('', 'ac@ac.ac', '123', '123', '', 'accountant', 1),
  ('', 'a00@a.a', '123', 'Requester', '', 'requester', NULL),
  ('', 'a01@a.a', '123', 'admin', '', 'admin', NULL),
  ('', 'a02@a.a', '123', 'supplier', '', 'supplier', NULL),
  ('', 'a03@a.a', '123', 'accountant', '', 'accountant', NULL),
  ('', 'a04@a.a', '123', 'financier', '', 'financier', NULL),
  ('', 'a05@a.a', '123', 'signer', '', 'signer', NULL),
  ('', 'a06@a.a', '123', 'techdir', '', 'techdir', 1),
  ('', 'a07@a.a', '123', 'gendir', '', 'gendir', 1),
  ('', 'nowert@mail.ru', 'nowert', 'admin admin admin', '123456789', 'root', 1);


UPDATE  `mtree`.`tree` SET  `id` =  '1' WHERE  `tree`.`id` =11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
