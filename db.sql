-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `cuser` text NOT NULL,
  `comment` longtext NOT NULL,
  `cip` text NOT NULL,
  `ctime` datetime NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


SET NAMES utf8;

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(2) NOT NULL,
  `title` text NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `time` datetime NOT NULL,
  `ip` text NOT NULL,
  `user` text NOT NULL,
  `imageid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `luckdraw`;
CREATE TABLE `luckdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` longtext,
  `ip` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2016-03-25 15:35:38