/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;

INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(12345, 1, 'abc', 2, 12, NULL);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(12345, 2, 'def', 5, 4, NULL);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(12345, 156, 'xcvb', 24, 100, NULL);
INSERT INTO `product` (`orggstnum`, `item_id`, `item_name`, `price_cost`, `stock`, `price_sell`) VALUES
(12345, 157, 'uyi', 45, 32, NULL),
(11111, 158, 'potato', 2, 32, 25),
(11111, 159, 'likes', 1, 23, 2),
(11111, 160, 'likes', 1, 32, 2),
(12, 161, 'likes', 1, 32, 2),
(12, 162, 'sim', 1, 1000, 20);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;