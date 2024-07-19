-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2023 at 09:20 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`) VALUES
(1, 'Shailesh Mukund Mestry', 'root', '833344d5e1432da82ef02e1301477ce8'),
(3, 'Yash Paratane', 'yash', 'c296539f3286a899d8b3f6632fd62274'),
(4, 'Aakanksha Jodh', 'aj', '3b6f421e7550395e28e091c5565ac80a');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `featured` varchar(5) NOT NULL,
  `active` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Rice', 'Food_Category_759.jpg', 'Yes', 'Yes'),
(2, 'Paneer', 'Food_Category_414.jpg', 'Yes', 'Yes'),
(3, 'Breakfast', 'Food_Category_275.jpg', 'Yes', 'Yes'),
(4, 'Thali', 'Food_Category_183.jpg', 'Yes', 'Yes'),
(5, 'Soup', 'Food_Category_777.jpg', 'Yes', 'Yes'),
(6, 'Biryani', 'Food_Category_862.jpg', 'Yes', 'Yes'),
(7, 'Chicken', 'Food_Category_67.jpg', 'Yes', 'Yes'),
(8, 'Veg', 'Food_Category_421.jpg', 'Yes', 'Yes'),
(9, 'Burger', 'Food_Category_55.jpg', 'Yes', 'Yes'),
(10, 'Pizza', 'Food_Category_893.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `featured` varchar(5) NOT NULL,
  `active` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Kande Pohe', 'Soaked rice flakes fried in onion tadka ', 25, 'Food_food_402.jpg', 3, 'Yes', 'Yes'),
(2, 'Misal Pav', 'Spicy hot curry with farsan and bread', 120, 'Food_food_754.webp', 3, 'Yes', 'Yes'),
(3, 'Jeera rice', 'Rice with jeera tadka.', 50, 'Food_food_67.jpg', 1, 'Yes', 'Yes'),
(4, 'Tomato Soup', 'Sweet and tangy tomato soup.', 70, 'Food_food_363.jpg', 5, 'Yes', 'Yes'),
(5, 'Butter Paneer', 'Paneer cooked in onion-tomato puree with butter.', 280, 'Food_food_533.jpg', 2, 'Yes', 'Yes'),
(6, 'Chicken Biryani', 'Raja-Maharajon wala shouk', 250, 'Food_food_412.jpg', 6, 'Yes', 'Yes'),
(7, 'Chicken wings masala', 'Spicy chicken wings cooked in fresh veggies', 280, 'Food_food_848.jpg', 7, 'Yes', 'Yes'),
(8, 'Medu Vada', '', 50, 'Food_food_786.jpg', 3, 'Yes', 'Yes'),
(9, 'Gobi Masala', '', 30, 'Food_food_61.jpg', 8, 'Yes', 'Yes'),
(10, 'Veg Kolhapuri', '', 250, 'Food_food_78.jpg', 10, 'Yes', 'Yes'),
(11, 'Paneer pizza', '', 300, 'Food_food_129.jpg', 10, 'Yes', 'Yes'),
(12, 'Veg Burger', '', 100, 'Food_food_487.jpg', 9, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_contact` varchar(20) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `c_name`, `c_contact`, `c_email`, `c_address`) VALUES
(1, 'Jeera rice', 50, 1, 50, '16-03-2023 10:57:11', 'Ordered', 'Shailesh Mestry', '7972382320', 'shaileshmestry2020@gmail.com', 'Indiranagar Chinchwad'),
(2, 'Chicken Biryani', 250, 1, 250, '16-03-2023 22:59:39', 'Ordered', 'Shailesh Mestry', '7972382320', 'shaileshmestry2020@gmail.com', 'Indiranagar Chinchwad'),
(3, 'Kande Pohe', 25, 4, 100, '16-03-2023 23:01:00', 'On Delivery', 'Shailesh Mestry', '7972382320', 'shaileshmestry2020@gmail.com', 'Indiranagar Chinchwad'),
(4, 'Butter Paneer', 280, 1, 280, '16-03-2023 23:02:02', 'Cancelled', 'Shailesh Mestry', '7972382320', 'shaileshmestry2020@gmail.com', 'Indiranagar Chinchwad'),
(5, 'Misal Pav', 120, 5, 600, '16-03-2023 23:02:39', 'Delivered', 'Shailesh Mestry', '7972382320', 'shaileshmestry2020@gmail.com', 'Indiranagar Chinchwad'),
(6, 'Kande Pohe', 25, 1, 25, '16-03-2023 23:03:11', 'On Delivery', 'Shailesh Mestry', '7977977979', 'shaileshmestry2020@gmail.com', 'Indiranagar,Chinchwad');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
