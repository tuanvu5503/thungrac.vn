-- --------------------------------------------------------
-- Host:                         172.16.100.3
-- Server version:               5.0.95-log - Source distribution
-- Server OS:                    redhat-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tuanvu-tr
CREATE DATABASE IF NOT EXISTS `tuanvu-tr` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tuanvu-tr`;


-- Dumping structure for table tuanvu-tr.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) default NULL,
  `password` varchar(32) NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `avatar` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

-- Dumping data for table tuanvu-tr.account: ~3 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `username`, `email`, `password`, `level`, `avatar`) VALUES
  (15, 'tuanvu', 'tuanvu@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'tuanvu1447401770.gif'),
  (18, 'yuki_tuanvu1c', 'vu@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'yuki_tuanvu11447377939.jpg'),
  (25, 'tuanvu2', 'tuanvu2@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 2, 'tuanvu11.png');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table tuanvu-tr.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `super_categoryId` int(11) NOT NULL,
  `category_name` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_category_super_category` (`super_categoryId`),
  CONSTRAINT `FK_category_super_category` FOREIGN KEY (`super_categoryId`) REFERENCES `super_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- Dumping data for table tuanvu-tr.category: ~8 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `super_categoryId`, `category_name`) VALUES
  (1, 1, 'Thùng rác công cộng'),
  (2, 2, 'Thùng rác công nghiệp'),
  (3, 3, 'Thùng rác y tế'),
  (4, 1, 'Thùng rác gia đình'),
  (41, 1, 'Thùng rác văn phòng'),
  (42, 2, 'Thùng rác cảm ứng'),
  (43, 3, 'Thùng rác thép'),
  (44, 1, 'Thùng rác nhựa');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Dumping structure for table tuanvu-tr.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) default NULL,
  `phone` int(10) unsigned NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table tuanvu-tr.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for table tuanvu-tr.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category_id` int(10) unsigned NOT NULL,
  `product_name` varchar(100) default NULL,
  `image` varchar(200) default NULL,
  `detail_image` text,
  `price` int(10) unsigned default NULL,
  `qty` int(10) unsigned default NULL,
  `des` text,
  PRIMARY KEY  (`id`),
  KEY `category_product` (`category_id`),
  CONSTRAINT `category_product1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- Dumping data for table tuanvu-tr.product: ~17 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `category_id`, `product_name`, `image`, `detail_image`, `price`, `qty`, `des`) VALUES
  (2, 3, 'Sữa tắm DOVE', 'suatamdove.jpg', 'suatamdove.jpg|d66cc39b36949b06c03892a79799cf2b-01447395060.jpg|d66cc39b36949b06c03892a79799cf2b-11447395060.jpg', 120, 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (3, 2, 'Túi xách DIOR', 'tuixachdior.jpg', 'tuixachdior.jpg|5cfe0beba39e857889274ac8aa377046-01447395078.jpg|5cfe0beba39e857889274ac8aa377046-11447395078.jpg', 1000, 45, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (4, 1, 'Đầm body', 'dambody.jpg', 'ba3029b01eb64d818d6585435dc9f193-01447395130.jpg', 70, 22, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (5, 3, 'Kem White Doctor', 'whitedoctor.jpg', 'whitedoctor.jpg', 350, 23, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (6, 1, 'Áo thun thời trang', 'aothun.jpg', 'd55fc5d01795ac1ffe48ec35602e7ce1-01447395109.jpg|d55fc5d01795ac1ffe48ec35602e7ce1-11447395109.jpg', 15, 32, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (7, 3, 'Kem chống nắng', 'kemchongnang.jpg', 'kemchongnang.jpg|8b6711575dea738431409495dce9975d-01447395140.jpg', 10, 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (8, 4, 'Giày tây', '2e7ba372dfafe1a2e5e3d728c0f0d671-1447741437.jpg', '2e7ba372dfafe1a2e5e3d728c0f0d671-01447385706.jpg|2e7ba372dfafe1a2e5e3d728c0f0d671-11447385706.jpg|2e7ba372dfafe1a2e5e3d728c0f0d671-21447385706.jpg|2e7ba372dfafe1a2e5e3d728c0f0d671-31447385706.jpg', 600, 13, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (111, 3, 'Dầu gội 1', '949e55d29a4e054bb91d0f76cdcfe0d1.jpg', '18715a2901e413e6e29277e1113d3bbf-01447397721.jpg|18715a2901e413e6e29277e1113d3bbf-11447397721.jpg', 10, 13, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (112, 1, 'Áo 1', 'fc52b02a95af814083dd06d25961e954.jpg', 'fc52b02a95af814083dd06d25961e954-01447397703.jpg|fc52b02a95af814083dd06d25961e954-11447397703.jpg', 12, 332, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (113, 2, 'Túi xách 3', '349f9b399392be4e96a271b3e21e7e25.jpg', '349f9b399392be4e96a271b3e21e7e25-01447397687.jpg|349f9b399392be4e96a271b3e21e7e25-11447397687.jpg', 600, 11, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (114, 3, 'Dầu gội 2', '47031e9824e3a6495632f8fdbb97cf0e.jpg', '47031e9824e3a6495632f8fdbb97cf0e-01447397669.jpg|47031e9824e3a6495632f8fdbb97cf0e-11447397669.jpg|47031e9824e3a6495632f8fdbb97cf0e-21447397669.jpg', 5, 100, ''),
  (115, 1, 'Đồ ngủ', '4a62053cb7eb40838905d3cc16a33c62.jpg', '4a62053cb7eb40838905d3cc16a33c62-21447386087.jpg|4a62053cb7eb40838905d3cc16a33c62-01447397613.jpg', 700, 55, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (116, 4, 'Giày 12', 'abdcfd7a2e9bb674a1bf2f88a61e968e.jpg', 'abdcfd7a2e9bb674a1bf2f88a61e968e-01447397596.jpg|abdcfd7a2e9bb674a1bf2f88a61e968e-11447397596.jpg', 111, 1000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (117, 2, 'túi xách 2', '5f5e83767e8d055583da7a8f4839d6b2.jpg', '5f5e83767e8d055583da7a8f4839d6b2-01447397582.jpg|5f5e83767e8d055583da7a8f4839d6b2-11447397582.jpg|5f5e83767e8d055583da7a8f4839d6b2-21447397582.jpg', 232, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (118, 4, 'Giày 2', 'f6df2c1e0c43c4a077ac54a5a5dedbbb.jpg', 'f6df2c1e0c43c4a077ac54a5a5dedbbb-21447386229.jpg|f6df2c1e0c43c4a077ac54a5a5dedbbb-01447397563.jpg|f6df2c1e0c43c4a077ac54a5a5dedbbb-11447397563.jpg|f6df2c1e0c43c4a077ac54a5a5dedbbb-21447397563.jpg', 0, 0, ''),
  (119, 2, 'Túi xách 4', 'e2497aabcadbcb748d732da37e2bc12f.jpg', 'e2497aabcadbcb748d732da37e2bc12f-01447397540.jpg|e2497aabcadbcb748d732da37e2bc12f-11447397540.jpg', 300, 22, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,'),
  (120, 1, 'abcd', 'abcd.jpg', 'abcd.jpg', 0, NULL, NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Dumping structure for table tuanvu-tr.super_category
CREATE TABLE IF NOT EXISTS `super_category` (
  `id` int(11) NOT NULL auto_increment,
  `super_categoryName` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tuanvu-tr.super_category: ~3 rows (approximately)
/*!40000 ALTER TABLE `super_category` DISABLE KEYS */;
INSERT INTO `super_category` (`id`, `super_categoryName`) VALUES
  (1, 'SẢN PHẨM THÙNG RÁC'),
  (2, 'SẢN PHẨM NHÀ VỆ SINH'),
  (3, 'SẢN PHẨM KHÁC');
/*!40000 ALTER TABLE `super_category` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
