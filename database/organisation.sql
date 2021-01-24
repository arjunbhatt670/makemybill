/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE `organisation` (
  `orgname` varchar(100) NOT NULL,
  `orggstnum` int NOT NULL,
  `orgaddress` varchar(200) DEFAULT NULL,
  `orgpno` int DEFAULT NULL,
  `orgemail` varchar(50) DEFAULT NULL,
  `orgimg` varchar(1000) DEFAULT NULL,
  `uid` int DEFAULT NULL,
  PRIMARY KEY (`orggstnum`),
  KEY `uid` (`uid`),
  CONSTRAINT `organisation_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_details` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('jio mukesh', 12, 'mumbai', 9999999, 'farzi@gmail.com', NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('dxfcgvhb', 878, NULL, NULL, NULL, NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('aws', 1234, NULL, NULL, NULL, NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('planatir', 9876, 'F.T.I, A-4, HALDWANI', 2147483647, 'mvalar213@gmail.com', 'aml.png', 1),
('google', 11111, 'chicago', 2147483647, 'rm@gmail.com', '898410.jpg', 1),
('facebook', 12345, 'silicon valley', 2147483647, 'rm@gmail.com', '7wg.jpg', 1),
('tesla', 123789, 'silicon valley', 123456789, 'rishabh.mah22@gmail.com', 'Capture7.png', 1),
('oracle', 895623, NULL, NULL, NULL, NULL, 1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;