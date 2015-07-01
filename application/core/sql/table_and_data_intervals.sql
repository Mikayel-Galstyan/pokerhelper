/*
SQLyog Ultimate v9.20 
MySQL - 5.5.16 : Database - teeflow
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`teeflow` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `teeflow`;

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

/*Data for the table `intervals` */

insert  into `intervals`(`id`,`name`,`description`,`order`,`collecting`,`sending`,`key`) values (1,'start-playing-interval',NULL,1,30,60,'stpi'),(2,'first-hole-interval',NULL,2,10,30,'fhi'),(3,'Low Battery 1',NULL,11,30,180,'lb1'),(4,'Low Battery 2',NULL,12,60,180,'lb2'),(5,'Player in stroke','Player is in strokedistance to player in front(interval is only used for player this player, not for player in front)',21,10,60,'stp'),(6,'New device detected on the round in contact to other players','Player is in contact, if\r\ndistance to player behind\r\n>= MD2D (see chapter\r\nfor new device)',33,20,100,'nddr'),(7,'New device\r\ndetected in front in\r\ncontact to player','Player is in contact, if\r\ndistance to new device\r\n>= MD2D (see chapter\r\nfor new device)',33,20,100,'nddb'),(8,'New device\r\ndetected behind in\r\ncontact to player','Player is in contact, if\r\ndistance to new device\r\n>= MD2D (see chapter\r\nfor new device)',33,20,100,'nddf'),(9,'Player overtaking','keep interval till control\r\nsituation is ended',41,30,120,'po'),(10,'Bag on next tee','keep interval till control\r\nsituation is ended',51,30,120,'bont'),(11,'Bag left in old\r\ngreen-sector','keep interval till control\r\nsituation is ended',52,30,120,'blilgs'),(12,'Bag parked, not\r\nentering greensector','keep interval till control\r\nsituation is ended',53,30,120,'bpnegs'),(13,'Player entering\r\npause-sector\r\nbefore starting\r\npause','keep interval till control\r\nsituation is ended',55,30,120,'pepsbs'),(15,'Player not in\r\nallowed sector','keep interval till control\r\nsituation is ended',61,30,120,'pnios'),(16,'Normal Player','The usual tracking, if\r\nnone of the above\r\nsituations occured',71,30,180,'np'),(17,'Lonely Player','Player has a minimum\r\ndistance of MDLP to\r\nplayer in front and behind',81,180,180,'lp'),(18,'Geo-Fence-alert','Switch to normal interval,\r\nif player reenters geofence',91,180,180,'gfa');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
