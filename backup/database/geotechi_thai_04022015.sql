-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 04, 2015 at 01:35 AM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geotechi_thai`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_packages`
--

DROP TABLE IF EXISTS `ac_packages`;
CREATE TABLE IF NOT EXISTS `ac_packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ac_packages`
--

INSERT INTO `ac_packages` (`package_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Plain Listing(Free)', 0, 0),
(2, 'Paid Listing', 0, 0),
(3, 'Advertiser', 0, 0),
(4, 'Featured Listing', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ac_permissions`
--

DROP TABLE IF EXISTS `ac_permissions`;
CREATE TABLE IF NOT EXISTS `ac_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ac_permissions`
--

INSERT INTO `ac_permissions` (`permission_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'property_posting', 0, 0),
(2, 'property_contact', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ac_roles`
--

DROP TABLE IF EXISTS `ac_roles`;
CREATE TABLE IF NOT EXISTS `ac_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ac_roles`
--

INSERT INTO `ac_roles` (`role_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Seller', 0, 0),
(2, 'Buyer', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ac_role_permissions`
--

DROP TABLE IF EXISTS `ac_role_permissions`;
CREATE TABLE IF NOT EXISTS `ac_role_permissions` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`role_permission_id`),
  KEY `role_id` (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ac_role_permissions`
--

INSERT INTO `ac_role_permissions` (`role_permission_id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 2, 0, 0),
(3, 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ac_users`
--

DROP TABLE IF EXISTS `ac_users`;
CREATE TABLE IF NOT EXISTS `ac_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_code` int(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `phone_code` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ac_users`
--

INSERT INTO `ac_users` (`user_id`, `first_name`, `last_name`, `location`, `email`, `email_code`, `phone`, `phone_code`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pioneer', 'Properties', 'bangkok', 'pioneer.properties@gmail.com', 0, '1234567890', 0, '$2y$10$pkVwU1PDlJOltVlboXrbrO.JuosygZKaLVTHaCPWo82wsVeeCtLAG', 'bTEhyXzcErjSpFh2OkgXEzeZfhh9w5ReVRDkNk0jlalt5SNlxcZigl0AILze', 2015, 2015),
(2, 'Sandip', 'Roy', 'bangkok', 'sandip01@gmail.com', 0, '8989898', 0, '$2y$10$INA/ZBpAPYBXbYDfGZ.93evQPDI6i4LEYyh.VI58gWvgiLNBuB/Sq', 'ZUGYresxu4bJSLo0qnSaHjL7f90zgC2TN8S9KvoX2oy2ncbO3NW6TYkDRVt2', 2015, 2015),
(3, 'Nithi', 'Ch', 'bangkok', 'tanwita@gmail.com', 0, '56456456', 0, '$2y$10$BUgizuodxeCZNAvjYLlty.1r9YaVltHLxs1dLSQKMOadsQTLowVwe', NULL, 2015, 2015),
(4, 'Santanu', 'Jana', 'bangkok', 'santanujanagipl@yopmail.com', 0, '882099209', 0, '$2y$10$sDmshpdOllXPWbvQxueoCeCnDRJUgFfMsDU8IBNj7PErFhAScD0pO', NULL, 2015, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `ac_user_packages`
--

DROP TABLE IF EXISTS `ac_user_packages`;
CREATE TABLE IF NOT EXISTS `ac_user_packages` (
  `user_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`user_package_id`),
  KEY `user_id` (`user_id`,`package_id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ac_user_roles`
--

DROP TABLE IF EXISTS `ac_user_roles`;
CREATE TABLE IF NOT EXISTS `ac_user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pr_attributes`
--

DROP TABLE IF EXISTS `pr_attributes`;
CREATE TABLE IF NOT EXISTS `pr_attributes` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(50) NOT NULL,
  `attribute_type` varchar(25) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `pr_attributes`
--

INSERT INTO `pr_attributes` (`attribute_id`, `attribute_name`, `attribute_type`) VALUES
(1, 'Bedrooms', 'number'),
(2, 'Bathrooms', 'number'),
(3, 'Balcony', 'number'),
(4, 'Dinning / Drawing', 'number'),
(5, 'Kitchen', 'number'),
(6, 'Beds', 'number'),
(7, 'Furnishing', 'check'),
(8, 'Furnished', 'check'),
(9, 'ACs', 'number'),
(10, 'Modular Kitchen', 'check'),
(11, 'Water Heater', 'check'),
(12, 'Refrigerator', 'check'),
(13, 'Property on Floor', 'number'),
(14, 'Total Floors in Building', 'number'),
(15, 'Super built-up Area', 'text'),
(16, 'Built-up Area', 'text'),
(17, 'Carpet Area', 'text'),
(18, 'Rooms', 'number'),
(19, 'Washrooms', 'number'),
(20, 'Quality Rating', 'number');

-- --------------------------------------------------------

--
-- Table structure for table `pr_deals`
--

DROP TABLE IF EXISTS `pr_deals`;
CREATE TABLE IF NOT EXISTS `pr_deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_name` varchar(50) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pr_deals`
--

INSERT INTO `pr_deals` (`deal_id`, `deal_name`) VALUES
(1, 'Sell'),
(2, 'Rent');

-- --------------------------------------------------------

--
-- Table structure for table `pr_groups`
--

DROP TABLE IF EXISTS `pr_groups`;
CREATE TABLE IF NOT EXISTS `pr_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pr_groups`
--

INSERT INTO `pr_groups` (`group_id`, `parent_id`, `group_name`) VALUES
(1, 0, 'Units'),
(2, 0, 'Furnishing'),
(3, 2, 'Furnished'),
(4, 2, 'Semi-furnished'),
(5, 2, 'Unfurnished'),
(6, 0, 'Floor Position'),
(7, 0, 'Area'),
(8, 0, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `pr_media`
--

DROP TABLE IF EXISTS `pr_media`;
CREATE TABLE IF NOT EXISTS `pr_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `media_type` varchar(50) NOT NULL,
  `media_title` varchar(100) NOT NULL,
  `media_data` varchar(250) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `pr_media`
--

INSERT INTO `pr_media` (`media_id`, `property_id`, `media_type`, `media_title`, `media_data`, `created_at`, `updated_at`) VALUES
(1, 1, 'PROPERTY-IMAGE', 'Description One', '1357377997.jpg', 0, 0),
(2, 1, 'PROPERTY-IMAGE', 'Description Two', '1118902461.jpg', 0, 0),
(3, 1, 'PROPERTY-IMAGE', 'Description Three', '1297583488.jpg', 0, 0),
(4, 1, 'PROPERTY-IMAGE', 'Description Four', '1225007151.jpg', 0, 0),
(5, 1, 'PROPERTY-IMAGE', 'Description Five', '1213119411.jpg', 0, 0),
(6, 4, 'PROPERTY-IMAGE', 'Description One', '1723062946.jpg', 0, 0),
(7, 4, 'PROPERTY-IMAGE', 'Description Two', '2778047832.', 0, 0),
(8, 4, 'PROPERTY-IMAGE', 'Description Three', '1815477087.jpg', 0, 0),
(9, 4, 'PROPERTY-IMAGE', 'Description Four', '1273610790.jpg', 0, 0),
(10, 4, 'PROPERTY-IMAGE', 'Description Five', '6855875050.jpg', 0, 0),
(11, 5, 'PROPERTY-IMAGE', 'Building View', '4165469345.jpg', 0, 0),
(12, 6, 'PROPERTY-IMAGE', '', '3498143243.jpg', 0, 0),
(13, 6, 'PROPERTY-IMAGE', '', '1605950639.jpg', 0, 0),
(14, 6, 'PROPERTY-IMAGE', '', '8599121268.jpg', 0, 0),
(15, 7, 'PROPERTY-IMAGE', 'Building View', '5267579816.jpg', 0, 0),
(16, 8, 'PROPERTY-IMAGE', 'Building View', '8768813150.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pr_properties`
--

DROP TABLE IF EXISTS `pr_properties`;
CREATE TABLE IF NOT EXISTS `pr_properties` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(100) NOT NULL,
  `location_sub` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `basis` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`property_id`),
  KEY `user_id` (`user_id`,`deal_id`,`type_id`),
  KEY `deal_id` (`deal_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pr_properties`
--

INSERT INTO `pr_properties` (`property_id`, `user_id`, `deal_id`, `type_id`, `title`, `description`, `location`, `location_sub`, `address`, `price`, `basis`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 'House For Sale In Prachuap Khiri Khan', 'The villa is located 6 km west of Hua Hin city center in green lush surroundings. A new road has been build providing with good access roads and infrastructure to the area.\r\n\r\nThe estate has been completed 2 years ago and is today an effective estate consisting of 11 high class pool villas. The nearest surroundings to the estate are other villas providing a peaceful neighborhood\r\n\r\nThe villa has 3 bedrooms, 2 bathrooms and large kitchen- living room which opens up out onto a large covered terrac', 'Phuket', 'Laguna', 'Hua Hin, Asok. Bangkok. Thailand.', 6900000, 'O', '1234567890', 'pioneer.properties@gmail.com', 0, 0),
(2, 0, 0, 0, 'House For Sale In Prachuap Khiri Khan1', 'The villa is located 6 km west of Hua Hin city center in green lush surroundings. A new road has been build providing with good access roads and infrastructure to the area.\r\n\r\nThe estate has been completed 2 years ago and is today an effective estate consisting of 11 high class pool villas. The nearest surroundings to the estate are other villas providing a peaceful neighborhood\r\n\r\nThe villa has 3 bedrooms, 2 bathrooms and large kitchen- living room which opens up out onto a large covered terrac', 'Phuket', 'Laguna', 'Hua Hin, Asok. Bangkok. Thailand.', 6900000, 'O', '1234567890', 'pioneer.properties@gmail.com', 0, 0),
(3, 0, 0, 0, 'House For Sale In Prachuap Khiri Khan1', 'The villa is located 6 km west of Hua Hin city center in green lush surroundings. A new road has been build providing with good access roads and infrastructure to the area.\r\n\r\nThe estate has been completed 2 years ago and is today an effective estate consisting of 11 high class pool villas. The nearest surroundings to the estate are other villas providing a peaceful neighborhood\r\n\r\nThe villa has 3 bedrooms, 2 bathrooms and large kitchen- living room which opens up out onto a large covered terrac', 'Phuket', 'Laguna', 'Hua Hin, Asok. Bangkok. Thailand.', 6900000, 'O', '1234567890', 'pioneer.properties@gmail.com', 0, 0),
(4, 1, 1, 4, 'Townhouse For Sale In Bangkok, Bangkok Central', 'Beautifully presented 4 storey Townhouse located on up-and-coming Sukhumvit 107.\r\n\r\nThe property offers a luxury and spacious living experience and it is fully equipped with all the modern living requirements such as double parking space, private pool and a roof terrace.\r\n\r\nThe townhouse will be kitted with the highest quality finish such as oak floors in the bedrooms and luxury fittings throughout the property. The developer can customize the layout, fixtures and furnishings of the Townhouse ac', 'Bangkok', 'Asok', 'Bangkok Central, Bearing', 20000, 'O', '55555555', 'pioneer.properties@gmail.com', 0, 0),
(5, 2, 1, 4, 'Sunrise Properties', 'Sunrise Property test data', 'Bangkok', 'Nana', 'Soi 32, Asok \r\nBangkok', 100000, 'O', '8989898', 'sandip01@gmail.com', 0, 0),
(6, 1, 1, 4, 'House For Sale In Phuket', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', 'Bangkok', 'Asok', 'efgbkaefejkfgjkgsek\r\nghsdghsklghl\r\n12333243454', 125455, 'O', '1234567890', 'pioneer.properties@gmail.com', 0, 0),
(7, 2, 1, 4, 'Silver Spring', 'G-121 . Sukantanagar well communicated location .With basic amenities available at affordable range .Science city , Mani square , Nalban railway station all at 15 mins distance. Semi furnished .. Well decorated interiors', 'Phuket', 'Laguna', 'laguna soi 22', 5600000, 'O', '8989898', 'sandip01@gmail.com', 0, 0),
(8, 3, 1, 4, 'Silver Valley', 'Silver Valley  Silver ValleyS ilver ValleySilver ValleySilver  ValleySilver ValleySilver ValleySilver ValleySilver  ValleySilver  ValleySilver Valley', 'Bangkok', 'Asok', 'Asok Soi 33', 6000000, 'O', '56456456', 'tanwita@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pr_relations`
--

DROP TABLE IF EXISTS `pr_relations`;
CREATE TABLE IF NOT EXISTS `pr_relations` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`),
  KEY `type_id` (`type_id`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `deal_id` (`deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `pr_relations`
--

INSERT INTO `pr_relations` (`relation_id`, `deal_id`, `type_id`, `group_id`, `attribute_id`) VALUES
(1, 1, 4, 1, 1),
(2, 1, 4, 1, 2),
(3, 1, 4, 1, 3),
(4, 1, 4, 1, 4),
(5, 1, 4, 1, 5),
(6, 1, 4, 8, 8),
(7, 1, 4, 6, 13),
(8, 1, 4, 6, 14),
(9, 1, 4, 7, 15),
(10, 1, 4, 7, 16),
(11, 1, 4, 7, 17),
(12, 2, 4, 1, 1),
(13, 2, 4, 1, 2),
(14, 2, 4, 1, 3),
(15, 2, 4, 1, 4),
(16, 2, 4, 1, 5),
(17, 2, 4, 3, 6),
(18, 2, 4, 3, 9),
(19, 2, 4, 3, 10),
(20, 2, 4, 3, 11),
(21, 2, 4, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pr_types`
--

DROP TABLE IF EXISTS `pr_types`;
CREATE TABLE IF NOT EXISTS `pr_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `pr_types`
--

INSERT INTO `pr_types` (`type_id`, `parent_id`, `type_name`) VALUES
(1, 0, 'Residential'),
(2, 0, 'Commercial'),
(3, 0, 'Land'),
(4, 1, 'Residential Apartment '),
(5, 1, 'Independent House / Villa'),
(6, 1, 'Independent / Builder Floor'),
(7, 1, 'Farm House'),
(8, 1, 'Studio Apartments'),
(9, 1, 'Serviced Apartment'),
(10, 2, 'Office Space'),
(11, 2, 'Shop'),
(12, 2, 'Showroom'),
(13, 2, 'Factory'),
(14, 2, 'Warehouse'),
(15, 2, 'Hotel / Resort'),
(16, 2, 'Guest House'),
(17, 2, 'Banquet Hall'),
(18, 2, 'Space in Retail Mall'),
(19, 3, 'Residential Land'),
(20, 3, 'Commercial Land'),
(21, 3, 'Industrial Land'),
(22, 3, 'Agricultural / Farm Land');

-- --------------------------------------------------------

--
-- Table structure for table `pr_values`
--

DROP TABLE IF EXISTS `pr_values`;
CREATE TABLE IF NOT EXISTS `pr_values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(50) NOT NULL,
  PRIMARY KEY (`value_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `pr_values`
--

INSERT INTO `pr_values` (`value_id`, `property_id`, `attribute_id`, `attribute_value`) VALUES
(89, 4, 1, '2'),
(90, 4, 2, '2'),
(91, 4, 3, '2'),
(92, 4, 4, '2'),
(93, 4, 5, '2'),
(94, 4, 8, 'Yes'),
(95, 4, 13, '3'),
(96, 4, 14, '3'),
(97, 4, 15, '200'),
(98, 4, 16, '700'),
(99, 4, 17, '600'),
(100, 1, 1, '3'),
(101, 1, 2, '2'),
(102, 1, 3, '1'),
(103, 1, 4, '1'),
(104, 1, 5, '1'),
(105, 1, 8, 'Yes'),
(106, 1, 13, '4'),
(107, 1, 14, '6'),
(108, 1, 15, '800'),
(109, 1, 16, '700'),
(110, 1, 17, '600'),
(111, 5, 1, '1'),
(112, 5, 2, '1'),
(113, 5, 3, '1'),
(114, 5, 4, '1'),
(115, 5, 5, '1'),
(116, 5, 8, 'Yes'),
(117, 5, 13, '1'),
(118, 5, 14, '1'),
(119, 5, 15, '300'),
(120, 5, 16, '200'),
(121, 5, 17, '100'),
(133, 6, 1, '1'),
(134, 6, 2, '2'),
(135, 6, 3, '1'),
(136, 6, 4, '1'),
(137, 6, 5, '4'),
(138, 6, 13, '2'),
(139, 6, 14, '2'),
(140, 6, 15, '1434'),
(141, 6, 16, '3434'),
(142, 6, 17, '3543'),
(143, 7, 1, '2'),
(144, 7, 2, '1'),
(145, 7, 3, '1'),
(146, 7, 4, '1'),
(147, 7, 5, '1'),
(148, 7, 13, '1'),
(149, 7, 14, '2'),
(150, 7, 15, '500'),
(151, 7, 16, '450'),
(152, 7, 17, '400'),
(153, 8, 1, '2'),
(154, 8, 2, '1'),
(155, 8, 3, '1'),
(156, 8, 4, '1'),
(157, 8, 5, '1'),
(158, 8, 8, 'Yes'),
(159, 8, 13, '1'),
(160, 8, 14, '1'),
(161, 8, 15, '244'),
(162, 8, 16, '233'),
(163, 8, 17, '222');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ac_role_permissions`
--
ALTER TABLE `ac_role_permissions`
  ADD CONSTRAINT `ac_role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `ac_permissions` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ac_role_permissions_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `ac_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ac_user_packages`
--
ALTER TABLE `ac_user_packages`
  ADD CONSTRAINT `ac_user_packages_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `ac_packages` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ac_user_roles`
--
ALTER TABLE `ac_user_roles`
  ADD CONSTRAINT `ac_user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `ac_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
