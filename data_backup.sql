-- 데이터베이스 생성 및 사용
CREATE DATABASE IF NOT EXISTS `shopping` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopping`;

-- 테이블 생성: cart
CREATE TABLE IF NOT EXISTS `cart` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_qty` int NOT NULL DEFAULT 1,
  `product_price` int NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 생성: orders
CREATE TABLE IF NOT EXISTS `orders` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `roadAddress` varchar(50) NOT NULL,
  `jibunAddress` varchar(50),
  `detailAddress` varchar(50),
  `extraAddress` varchar(50),
  `method` varchar(50) NOT NULL DEFAULT '무통장입금',
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `progress` enum('결제대기','결제완료','배송중','배송완료') NOT NULL DEFAULT '결제대기',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 테이블 생성: products
CREATE TABLE IF NOT EXISTS `products` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(200) NOT NULL,
  `qty` int NOT NULL,
  `rating` int NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- 테이블 생성: product_rating
CREATE TABLE IF NOT EXISTS `product_rating` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '',
  `product_id` varchar(50) NOT NULL,
  `rating` int NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- 테이블 생성: purchase
CREATE TABLE IF NOT EXISTS `purchase` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_tel` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `roadAddress` varchar(50) NOT NULL,
  `jibunAddress` varchar(50),
  `detailAddress` varchar(50),
  `extraAddress` varchar(50),
  `pay_method` varchar(50) NOT NULL DEFAULT '무통장 입금',
  `product_image` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_qty` varchar(50) NOT NULL,
  `total_price` int NOT NULL,
  `shipping_cost` int NOT NULL,
  `grand_total` int NOT NULL,
  `progress` varchar(50) NOT NULL DEFAULT '결제 대기',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- 테이블 생성: user_info
CREATE TABLE IF NOT EXISTS `user_info` (
  `idx` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `user_tel` varchar(50) NOT NULL,
  `postcode` varchar(50) NOT NULL DEFAULT '',
  `roadAddress` varchar(50) NOT NULL,
  `jibunAddress` varchar(50),
  `detailAddress` varchar(50),
  `extraAddress` varchar(50),
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;