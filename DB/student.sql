/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.8-log : Database - studentmanage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`studentmanage` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `studentmanage`;

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `chat_id` int(10) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(100) NOT NULL,
  `reciever_id` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `message` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `package_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `chat` */

insert  into `chat`(`chat_id`,`sender_id`,`reciever_id`,`type`,`message`,`timestamp`,`package_id`) values (1,'','100','','hii','2024-12-07 08:39:07',NULL),(2,'','','','hii','2024-12-07 08:41:05',0),(3,'','','','hii','2024-12-07 08:41:33',4),(4,'','','','hii','2024-12-07 08:41:51',4),(5,'','','','hii','2024-12-07 08:42:38',4),(6,'','','','hii','2024-12-07 08:43:35',4),(7,'','','','hii','2024-12-07 08:44:38',4),(8,'','','','hello','2024-12-07 08:53:34',4),(9,'','','','hello','2024-12-07 08:54:31',4),(10,'','','','hello','2024-12-07 08:55:03',4),(11,'','','','hello','2024-12-07 09:15:26',4),(12,'','','','how are you\r\n','2024-12-07 09:15:57',4),(13,'','','','hello','2024-12-09 12:42:43',4),(14,'','','','hii','2024-12-09 12:43:47',4),(15,'','','','hellloooooooooooooo','2024-12-09 12:47:08',4),(29,'','','','Hello','2024-12-09 13:45:40',5),(30,'5','101','','hii','2024-12-09 13:47:14',5),(31,'101','','','hii','2024-12-09 16:02:45',5),(32,'5','101','','hello','2024-12-09 16:05:24',5);

/*Table structure for table `chat_members` */

DROP TABLE IF EXISTS `chat_members`;

CREATE TABLE `chat_members` (
  `chat_mid` int(20) NOT NULL AUTO_INCREMENT,
  `studid` int(20) NOT NULL,
  `c_id` int(20) NOT NULL,
  `descrip` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_mid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `chat_members` */

insert  into `chat_members`(`chat_mid`,`studid`,`c_id`,`descrip`,`status`) values (4,2,100,'blaaaaa',''),(5,5,101,'sdsfddddddddddddddddd','');

/*Table structure for table `complaints` */

DROP TABLE IF EXISTS `complaints`;

CREATE TABLE `complaints` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `sid` int(20) NOT NULL,
  `cdes` varchar(500) NOT NULL,
  `reply` varchar(500) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cstatus` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `complaints` */

insert  into `complaints`(`cid`,`sid`,`cdes`,`reply`,`cdate`,`cstatus`) values (1,3,'The system frequently logs me out when Iâ€™m in the middle of entering student details. Please fix this issue. Iâ€™m experiencing slow loading times when accessing the student attendance records. This is affecting my work efficiency.','Thank you!! for bringing this issue to our attention. We are currently investigating the cause of the logout issue and the slow loading times. Our technical team is working to resolve these problems as quickly as possible. We appreciate your patience!!!','2024-10-21 02:46:28','Send');

/*Table structure for table `counsellor` */

DROP TABLE IF EXISTS `counsellor`;

CREATE TABLE `counsellor` (
  `co_id` int(20) NOT NULL AUTO_INCREMENT,
  `co_name` varchar(100) NOT NULL,
  `co_email` varchar(100) NOT NULL,
  `co_phone` varchar(10) NOT NULL,
  `co_pass` varchar(100) NOT NULL,
  `co_address` varchar(100) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

/*Data for the table `counsellor` */

insert  into `counsellor`(`co_id`,`co_name`,`co_email`,`co_phone`,`co_pass`,`co_address`) values (100,'Akhila','akk@gmail.com','7907454292','Akk@123','Kaloor'),(101,'Garry','gar@gmail.com','8977545645','Garyy','Kollam');

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `did` int(20) NOT NULL AUTO_INCREMENT,
  `deptname` varchar(100) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `department` */

insert  into `department`(`did`,`deptname`) values (10,'Bachelor of Computer Applications (BCA)'),(11,'Bachelor of Commerce (BCom)'),(12,'Bachelor of Science in Computer Science (BSc CS)'),(13,'Bachelor of Science in Information Technology (BSc IT)'),(14,'Bachelor of Technology in Electrical Engineering(B.Tech EE)'),(15,'Bachelor of Technology in Mechanical Engineering(B.Tech ME)'),(16,'Bachelor of Technology in Civil Engineering(B.Tech CE)'),(17,'Bachelor of Technology in Electronics Engineering(B.Tech ECE)'),(18,'Bachelor of Business Administration(BBA)'),(19,'Bachelor of Commerce in Accounting and Finance(BCom AF)'),(20,'Bachelor of Arts in Economics(BA Economics)'),(21,'Bachelor of Business Administration in Marketing(BBA Marketing)'),(22,'Bachelor of Business Administration in Finance(BBA Finance)'),(23,'Bachelor of Science in Hospitality Management(BSc HM)'),(24,'Bachelor of Science in Tourism Management(BSc TM)'),(25,'Bachelor of Science in Mathematics(BSc Mathematics)'),(26,'Bachelor of Arts in Sociology(BA Sociology)');

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `eid` int(20) NOT NULL AUTO_INCREMENT,
  `evname` varchar(100) NOT NULL,
  `evimg` varchar(100) NOT NULL,
  `evdatetime` varchar(100) NOT NULL,
  `evdept` varchar(100) NOT NULL,
  `sid` int(20) NOT NULL,
  `evdesc` varchar(500) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `event` */

insert  into `event`(`eid`,`evname`,`evimg`,`evdatetime`,`evdept`,`sid`,`evdesc`) values (1,'Annual Placement Drive','images.jpg','2024-10-20T09:30','',3,'A placement drive for final-year students to connect with top companies for job opportunities.');

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `fdesc` text,
  `fdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fid`),
  KEY `sid` (`sid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `staff` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `feedback` */

insert  into `feedback`(`fid`,`sid`,`fdesc`,`fdate`) values (1,3,'Suggestions for Improvement:\r\nThe user interface is a bit outdated. A modern design could enhance the user experience for both staff and students. Adding a notification feature for new assignments or exam schedules would keep both staff and students informed..','2024-10-21 02:00:34');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `logid` int(20) NOT NULL AUTO_INCREMENT,
  `regid` int(20) NOT NULL,
  `logemail` varchar(100) NOT NULL,
  `logpass` varchar(100) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`logid`,`regid`,`logemail`,`logpass`,`usertype`,`status`) values (1,0,'admin@gmail.com','admin','ADMIN','Approved'),(3,3,'anu@gmail.com','Anu','STAFF','Approved'),(5,2,'nimal@gmail.com','Nimal','STUDENT','Approved'),(9,4,'manesh@gmail.com','Manesh','STAFF','Approved'),(10,5,'rithul@gmail.com','Rithu','STUDENT','Approved'),(12,100,'akk@gmail.com','Akk@123','COUNSELLOR','Approved'),(13,101,'gar@gmail.com','Garyy','COUNSELLOR','Approved');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `sid` int(20) NOT NULL AUTO_INCREMENT,
  `sfname` varchar(100) NOT NULL,
  `slname` varchar(100) NOT NULL,
  `sphone` varchar(100) NOT NULL,
  `semail` varchar(100) NOT NULL,
  `sgen` varchar(100) NOT NULL,
  `sdept` varchar(100) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`sid`,`sfname`,`slname`,`sphone`,`semail`,`sgen`,`sdept`) values (3,'Ananya','Abay','7794561235','anu@gmail.com','Female','Bachelor of Science in Computer Science (BSc CS)'),(4,'Manesh','Manu','7494561235','manesh@gmail.com','Male','Bachelor of Technology in Electrical Engineering (B.Tech EE)');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `studid` int(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `sem` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  PRIMARY KEY (`studid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`studid`,`fname`,`lname`,`phone`,`email`,`dept`,`year`,`sem`,`age`) values (2,'Nimal','K S','9855561235','nimal@gmail.com','Bachelor of Science in Computer Science (BSc CS)','2nd Year','Semester 3','20'),(5,'Rithul','Raju','7795656123','rithul@gmail.com','Bachelor of Technology in Electrical Engineering (B.Tech EE)','3rd Year','Semester 6','21');

/*Table structure for table `studymaterials` */

DROP TABLE IF EXISTS `studymaterials`;

CREATE TABLE `studymaterials` (
  `stmid` int(20) NOT NULL AUTO_INCREMENT,
  `stmyear` varchar(100) NOT NULL,
  `stmsem` varchar(100) NOT NULL,
  `stmdept` varchar(100) NOT NULL,
  `stmtpdf` varchar(100) NOT NULL,
  `sid` int(10) NOT NULL,
  `subject` varchar(100) NOT NULL,
  PRIMARY KEY (`stmid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `studymaterials` */

insert  into `studymaterials`(`stmid`,`stmyear`,`stmsem`,`stmdept`,`stmtpdf`,`sid`,`subject`) values (1,'2nd Year','Semester 3','Bachelor of Science in Computer Science (BSc CS)','B.Sc-Computer-Science..pdf',3,'Mathematics'),(2,'3rd Year','Semester 6','Bachelor of Technology in Electrical Engineering (B.Tech EE)','BTEE.pdf',4,'Electronics');

/*Table structure for table `timetable` */

DROP TABLE IF EXISTS `timetable`;

CREATE TABLE `timetable` (
  `tid` int(20) NOT NULL AUTO_INCREMENT,
  `tdept` varchar(100) NOT NULL,
  `tsem` varchar(100) NOT NULL,
  `tyear` varchar(100) NOT NULL,
  `ttable` varchar(100) NOT NULL,
  `sid` varchar(10) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `timetable` */

insert  into `timetable`(`tid`,`tdept`,`tsem`,`tyear`,`ttable`,`sid`) values (1,'Bachelor of Science in Computer Science (BSc CS)','Semester 3','2nd Year','time.jpeg','3'),(3,'Bachelor of Technology in Electrical Engineering (B.Tech EE)','Semester 6','3rd Year','III-BTech-I-Semester.png','4');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
