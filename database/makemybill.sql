/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `verified` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `orggstnum` int NOT NULL,
  `item_id` int NOT NULL AUTO_INCREMENT,
  `item_name` text NOT NULL,
  `price_cost` float NOT NULL,
  `stock` int NOT NULL,
  `price_sell` float DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `orggstnum` (`orggstnum`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`orggstnum`) REFERENCES `organisation` (`orggstnum`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE `organisation` (
  `orgname` varchar(100) NOT NULL,
  `orggstnum` int NOT NULL,
  `orgaddress` varchar(200) DEFAULT NULL,
  `orgpno` varchar(255) DEFAULT NULL,
  `orgemail` varchar(50) DEFAULT NULL,
  `orgimg` varchar(1000) DEFAULT NULL,
  `uid` int DEFAULT NULL,
  PRIMARY KEY (`orggstnum`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `cust_details`;
CREATE TABLE `cust_details` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(255) DEFAULT NULL,
  `cust_phone` varchar(255) DEFAULT NULL,
  `cust_address` varchar(255) DEFAULT NULL,
  `orggstnum` int DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill` (
  `bill_id` int DEFAULT NULL,
  `orggstnum` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user_details` (`user_id`, `firstname`, `lastname`, `dob`, `email`, `password`, `phone`, `state`, `city`, `verified`, `created_at`) VALUES
(33, 'Arjun', 'Bhatt', '2021-01-07', 'qwer@123.com', '$2y$10$NYsHuW8aEwNrv6EZVr98KufPd0lGxOVsZUPEZOOPD/1HG1.7ARTXG', '9105752709', 'Uttar Pradesh', 'Pfdgh', 0, '2021-01-12 18:08:57');
INSERT INTO `user_details` (`user_id`, `firstname`, `lastname`, `dob`, `email`, `password`, `phone`, `state`, `city`, `verified`, `created_at`) VALUES
(34, 'Arjun', 'Bhatt', '2018-10-17', 'arjunbhatt670@gmail.com', '$2y$10$t2mg7w7XHp2A2Wj0jac8xOVFpzox5plb0NOFpXzoa3Tl0ScFRmbMm', '12345435', 'Delhi', 'wert', 0, '2021-01-18 12:35:52');


INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(147147, 165, 'chips', 3, 100, 5);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(147147, 166, 'soap', 10, 75, 20);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(8989, 167, 'balls', 3, 100, 5);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(121212, 168, 'oil', 50, 100, 60),
(121212, 169, 'apple', 100, 50, 150),
(741741, 170, 'fuel', 150, 100, 200),
(741741, 171, 'dragon', 12500, 20, 20000),
(741741, 172, 'star link', 20000, 10, 30000);

INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('dxfcgvhb', 10, NULL, NULL, NULL, NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('jio mukesh', 12, 'mumbai', '9999999', 'farzi@gmail.com', NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('aws', 1234, NULL, NULL, NULL, NULL, 1);
INSERT INTO `organisation` (`orgname`, `orggstnum`, `orgaddress`, `orgpno`, `orgemail`, `orgimg`, `uid`) VALUES
('Facebook', 8989, 'amrica', '78945566', 'abc456@gmail.com', '', 34),
('planatir', 9876, 'turkey', '14145252', 'qer@123.com', '326653-facets.jpg', 34),
('google', 11111, 'chicago', '2147483647', 'rm@gmail.com', '898410.jpg', 1),
('bookie', 12345, 'silicon valley', '2147483647', 'rm@gmail.com', '7wg.jpg', 1),
('Amazon2', 121212, 'california', '9898989898', 'amzon@am.com', '', 34),
('tesla', 123789, 'silicon valley', '123456789', 'rishabh.mah22@gmail.com', 'Capture7.png', 1),
('Walmart', 147147, NULL, NULL, NULL, NULL, 34),
('spaceX', 741741, '', '', '', 'THUMB__01ao.jpg', 34),
('oracle', 895623, NULL, NULL, NULL, NULL, 1);

INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(2, 'bond', '9999999999', 'america', 12);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(13, 'ramu', '654654654', 'abcd', 11111);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(17, 'Abbas', '123123123', 'noida', 147147);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(18, 'hariom', '910575279', 'asd', 147147),
(19, 'dash', '456456456', 'super', 147147),
(20, 'hariya', '777888777', 'bilsanda', 147147),
(23, 'john wick', '0000000', 'continental', 121212),
(24, 'NASA', '14141414', 'tapri ke paas', 741741);

INSERT INTO `bill` (`bill_id`, `orggstnum`, `item_id`, `item_name`, `quantity`, `price`) VALUES
(17, 147147, 165, 'chips', 10, 5);
INSERT INTO `bill` (`bill_id`, `orggstnum`, `item_id`, `item_name`, `quantity`, `price`) VALUES
(18, 147147, 165, 'chips', 30, 5);
INSERT INTO `bill` (`bill_id`, `orggstnum`, `item_id`, `item_name`, `quantity`, `price`) VALUES
(18, 147147, 166, 'soap', 12, 20);
INSERT INTO `bill` (`bill_id`, `orggstnum`, `item_id`, `item_name`, `quantity`, `price`) VALUES
(19, 147147, 165, 'chips', 45, 5),
(19, 147147, 166, 'soap', 65, 20),
(20, 147147, 165, 'chips', 0, 5),
(20, 147147, 166, 'soap', 5, 20),
(2, 8989, 167, 'balls', 2, 5),
(23, 121212, 168, 'oil', 25, 60),
(23, 121212, 169, 'apple', 25, 150),
(24, 741741, 170, 'fuel', 20, 200),
(24, 741741, 171, 'dragon', 5, 20000),
(24, 741741, 172, 'star link', 7, 30000);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;