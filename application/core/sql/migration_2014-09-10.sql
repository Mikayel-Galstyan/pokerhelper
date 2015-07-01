/*
SQLyog Ultimate v9.20 
MySQL - 5.5.16 : Database - teeflow
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`teeflow` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `interferences` */

DROP TABLE IF EXISTS `interferences`;

CREATE TABLE `interferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caused_interference_app_id` varchar(100) DEFAULT NULL,
  `make_interference_app_id` varchar(100) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caused_interference_app_id` (`caused_interference_app_id`),
  KEY `make_interference_app_id` (`make_interference_app_id`),
  KEY `course_id` (`course_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=1264 DEFAULT CHARSET=latin1;

/*Table structure for table `waiting_time` */

DROP TABLE IF EXISTS `waiting_time`;

CREATE TABLE `waiting_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caused_waiting_time_player_app_id` varchar(100) DEFAULT NULL,
  `make_waiting_time_player_app_id` varchar(100) DEFAULT NULL,
  `value` tinytext,
  `date` datetime DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `make_waiting_time_player_app_id` (`make_waiting_time_player_app_id`),
  KEY `caused_waiting_time_player_app_id` (`caused_waiting_time_player_app_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
