/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `cust_details`;
CREATE TABLE `cust_details` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(255) DEFAULT NULL,
  `cust_phone` varchar(255) DEFAULT NULL,
  `cust_address` varchar(255) DEFAULT NULL,
  `orggstnum` int DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(2, 'bond', '9999999999', 'america', 12);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(3, 'asdfg', '9999999889', 'asd', 9876);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(4, 'asdfg', '7777777777', 'asd', 12);
INSERT INTO `cust_details` (`bill_id`, `cust_name`, `cust_phone`, `cust_address`, `orggstnum`) VALUES
(5, 'hits', '87897', 'noida', 12),
(6, 'asdfg', '9999999999', 'asd', 9876);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;