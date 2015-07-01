/*
SQLyog Ultimate v9.20 
MySQL - 5.1.53 : Database - teeflow
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`teeflow` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `teeflow`;

/*Table structure for table `clubs` */

DROP TABLE IF EXISTS `clubs`;

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `center` text NOT NULL,
  `width` int(4) NOT NULL DEFAULT '640',
  `height` int(4) NOT NULL DEFAULT '640',
  `zoom` int(2) NOT NULL DEFAULT '12',
  `location` text NOT NULL,
  `map_image` varchar(255) NOT NULL,
  `settings` text NOT NULL,
  `angle` int(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `club_id` (`club_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

/*Table structure for table `games` */

DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `polygon_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `total_time` int(11) DEFAULT '0',
  `start_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` datetime DEFAULT '0000-00-00 00:00:00',
  `total_distance` float DEFAULT '0',
  `is_done` int(1) DEFAULT '0',
  `game_order` int(2) DEFAULT NULL,
  `waiting_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `player_id_2` (`player_id`),
  KEY `polygon_id` (`polygon_id`),
  CONSTRAINT `games_ibfk_2` FOREIGN KEY (`polygon_id`) REFERENCES `polygons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `games_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116947 DEFAULT CHARSET=utf8;

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(100) DEFAULT NULL,
  `player_id` varchar(100) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `location` text,
  `info` text,
  `NAME` varchar(55) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3419421 DEFAULT CHARSET=latin1;

/*Table structure for table `history_info` */

DROP TABLE IF EXISTS `history_info`;

CREATE TABLE `history_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info` text,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3358634 DEFAULT CHARSET=latin1;

/*Table structure for table `holes` */

DROP TABLE IF EXISTS `holes`;

CREATE TABLE `holes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `route` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `holes_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=462 DEFAULT CHARSET=latin1;

/*Table structure for table `intervals` */

DROP TABLE IF EXISTS `intervals`;

CREATE TABLE `intervals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text,
  `order` int(11) NOT NULL,
  `collecting` int(11) NOT NULL DEFAULT '0',
  `sending` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) NOT NULL DEFAULT 'f',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(250) DEFAULT NULL,
  `message` text,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `message` text,
  `active` int(1) DEFAULT '0',
  `club_id` int(11) DEFAULT NULL,
  `app_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1314 DEFAULT CHARSET=latin1;

/*Table structure for table `players` */

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) NOT NULL,
  `register_id` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `polygon_id` int(11) NOT NULL,
  `group` tinyint(1) NOT NULL DEFAULT '0',
  `players_count` int(3) NOT NULL DEFAULT '1',
  `players_id` varchar(512) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_polygon_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL,
  `sector_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_waiting` tinyint(1) NOT NULL DEFAULT '0',
  `waiting_time` int(11) NOT NULL DEFAULT '0',
  `avgtime` int(11) DEFAULT '0',
  `polygon_status` tinyint(4) DEFAULT NULL,
  `total_waiting_time` int(11) DEFAULT '0',
  `finalized` int(1) NOT NULL DEFAULT '0',
  `last_polygon_id` int(11) DEFAULT NULL,
  `true_order` int(2) DEFAULT NULL,
  `start_battery` float NOT NULL DEFAULT '0',
  `waiting_positions_amount` text,
  `waiting_time_in_sector` int(11) NOT NULL DEFAULT '0',
  `is_overtaking` int(2) NOT NULL DEFAULT '0',
  `overtaking_list` text,
  `last_location` text,
  `caused_waiting_time_players` text,
  `make_waiting_time_players` text,
  `make_interference_time_players` text,
  `caused_interference_time_players` text,
  `path_sector_time` int(11) NOT NULL DEFAULT '0',
  `caused_waiting_time` int(11) NOT NULL DEFAULT '0',
  `caused_total_waiting_time` int(11) NOT NULL DEFAULT '0',
  `overtaking_time` int(11) NOT NULL DEFAULT '0',
  `iregular_status` varchar(100) DEFAULT NULL,
  `distance_gainged` int(11) NOT NULL DEFAULT '0',
  `problem_sector_start` text NOT NULL,
  `player_order` int(11) NOT NULL DEFAULT '0',
  `name` int(11) NOT NULL DEFAULT '0',
  `waiting_to_app_id` varchar(255) DEFAULT NULL,
  `virtual_sectors` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `polygon_id` (`polygon_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3090 DEFAULT CHARSET=utf8;

/*Table structure for table `polygons` */

DROP TABLE IF EXISTS `polygons`;

CREATE TABLE `polygons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `hole_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:Tee-off-sector, 1:Fairway-sector, 2:Green-sector',
  `app_type` enum('distance','tracking') DEFAULT 'distance' COMMENT 'define application type which should use polygon',
  `hole` text,
  `pois` text,
  `tops` text,
  `image_tops` text NOT NULL,
  `image_details` text COMMENT '{"image_name":{"bottom":{"lat":"52.572260","lng":"13.391369"}, "top":{"lat":"52.546148","lng":"13.411625"}}}',
  `min_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'define time in seconds',
  `max_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'define time in seconds',
  `polygon_details` text,
  `check_point` int(11) DEFAULT '0',
  `check_point_2` int(11) NOT NULL DEFAULT '0',
  `center` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `graph_id` (`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `polygons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=414 DEFAULT CHARSET=utf8;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `long_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Table structure for table `test_games` */

DROP TABLE IF EXISTS `test_games`;

CREATE TABLE `test_games` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `location` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `battery` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=436034 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `password` varchar(150) NOT NULL,
  `password_salt` varchar(150) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1:admin; 2:club;',
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `virtual_sectors` */

DROP TABLE IF EXISTS `virtual_sectors`;

CREATE TABLE `virtual_sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `tops` text,
  `polygon_details` text,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
