DROP DATABASE IF EXISTS `wnetwork`;
CREATE DATABASE IF NOT EXISTS`wnetwork`;
USE wnetwork;

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE IF NOT EXISTS `userdata` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(120) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `WORKING` varchar(100) NOT NULL,
  `EXPERIENCE` varchar(25) NOT NULL,
  `SCORE` bigint(25) NOT NULL,
  PRIMARY KEY (id)
) ;

