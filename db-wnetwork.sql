DROP DATABASE IF EXISTS `wnetwork`;
CREATE DATABASE IF NOT EXISTS`wnetwork`;
USE wnetwork;

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE IF NOT EXISTS `userdata` (
  	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`NAME` varchar(100),
  	`USERNAME` varchar(100),
   	`EMAIL` varchar(120),
    	`PASSWORD` varchar(10),
   	`WORKING` varchar(100),
   	`EXPERIENCE` varchar(25),
   	`ABOUT` varchar(1000),
   	`IMAGE` blob,
    	`IMAGENAME` varchar(100), 
   	`SCORE` bigint(25),
	`PARENT` bigint(25),
	`DAUA` bigint(25),
	`DAUB` bigint(25),
  PRIMARY KEY (id)
) ;

