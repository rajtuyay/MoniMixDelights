-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 09:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_monimix`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addresses`
--

CREATE TABLE `tbl_addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `xtra_info` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_addresses`
--

INSERT INTO `tbl_addresses` (`address_id`, `user_id`, `recipient_name`, `province`, `city`, `barangay`, `street`, `xtra_info`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ashley Tadeo', 'Bulacan', 'Calumpit', 'San Marcos', 'Purok 1', 'Near Candelaria Church', '09213465789', '2024-11-26 15:18:08', '2024-11-26 16:45:19'),
(2, 1, 'Jhonrick Villegas', 'Pampanga', 'Apalit', 'Balucuc', 'Tabalu', '', '09123456789', '2024-11-26 15:57:43', '2024-11-26 15:57:43'),
(3, 1, 'Erika Silvestre', 'Pampanga', 'Apalit', 'Colgante', 'Tabalu', '', '09987654321', '2024-11-26 15:58:42', '2024-11-26 15:58:42'),
(4, 1, 'Raj Tuyay', 'Pampanga', 'Macabebe', 'Candelaria', 'Purok 2', 'Near the Church', '09352811980', '2024-11-27 02:03:17', '2024-11-27 02:03:17'),
(7, 1, 'Raj Tuyay', 'Pampanga', 'Apalit', 'San Vicente', 'Purok 1', '', '09234124578', '2024-12-08 03:04:42', '2024-12-08 03:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `street` varchar(30) NOT NULL,
  `display_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `firstname`, `middlename`, `lastname`, `age`, `birthday`, `gender`, `contact_no`, `username`, `email`, `password`, `province`, `city`, `barangay`, `street`, `display_photo`) VALUES
(1, 'Monica', 'Guevarra', 'Tuyay', 47, '1977-05-25', 'Female', '09269569811', 'ADMIN-MoniMix', 'monimixdelights@gmail.com', 'admin123', 'Pampanga', 'Macabebe', 'Candelaria', 'Bukang Liwayway', 'sample-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` text NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_description`, `category_image`) VALUES
(1, 'Classic Filipino Treats', 'BLABLABLA', 'filipino-desserts.jpg'),
(2, 'Cupcakes & Donuts', '', 'cupcakes&donuts.png'),
(3, 'Cookies & Brownies', '', 'coookies&brownies.jpg'),
(4, 'Cheesecake & Delights', '', 'cheesecake&delights.jpg'),
(5, 'Cold Desserts', 'Cold desserts are the perfect way to indulge in sweet treats that offer a refreshing and satisfying experience. This category includes a variety of frozen delights, such as ice creams, sorbets, and gelatos, made with the finest ingredients to deliver rich flavors and a cooling sensation, ideal for warm days or as a delightful treat year-round.', 'cold-desserts.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Delivered','Cancelled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(1, 1, '2024-12-04 03:40:46', 20.00, 'Cancelled'),
(2, 1, '2024-12-11 10:13:27', 50.00, 'Delivered'),
(3, 14, '2024-12-11 10:21:19', 60.00, 'Delivered'),
(4, 1, '2024-12-12 04:12:10', 160.00, 'Cancelled'),
(5, 1, '2024-12-14 15:41:41', 175.00, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `package` enum('Box of 6','Box of 12') NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`order_item_id`, `order_id`, `prod_id`, `package`, `quantity`, `price`) VALUES
(1, 2, 8, 'Box of 6', 2, 25.00),
(2, 3, 6, 'Box of 6', 3, 20.00),
(3, 1, 5, 'Box of 6', 4, 5.00),
(4, 4, 4, 'Box of 6', 2, 80.00),
(5, 5, 6, 'Box of 6', 1, 175.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `prod_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('COD','Moni-Wallet','','') NOT NULL DEFAULT 'Moni-Wallet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `order_id`, `payment_date`, `prod_id`, `amount`, `payment_method`) VALUES
(2, 1, '2024-12-04 03:41:08', 2, 200.00, 'Moni-Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_price` float NOT NULL,
  `product_description` text NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `status` enum('Available','Unavailable') NOT NULL DEFAULT 'Available',
  `category_id` int(11) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`prod_id`, `prod_name`, `prod_price`, `product_description`, `stock_quantity`, `status`, `category_id`, `prod_image`, `created_at`) VALUES
(1, 'Puto', 120, 'Experience the soft and fluffy goodness of our Puto—perfectly steamed, lightly sweet, and irresistibly delicious. Topped with creamy cheese or enjoyed plain, it\'s a treat you\'ll keep coming back for!', 75, 'Available', 1, 'prod-puto.jpg', '2024-11-23 00:02:12'),
(2, 'Kutsinta', 90, 'Our Kutsinta is a delightful Filipino sticky rice cake with a chewy texture and a hint of sweetness. Topped with fresh grated coconut, it’s a classic treat that’s both simple and satisfying!', 50, 'Available', 1, 'prod-kutsinta.JPG', '2024-11-23 02:10:55'),
(3, 'Sapin-sapin', 120, 'Sapin-Sapin is a colorful Filipino dessert made with layers of sticky rice and coconut milk, each infused with unique flavors. Soft, sweet, and vibrant, it’s a feast for both the eyes and the taste buds!', 40, 'Available', 1, 'prod-sapin-sapin.jpg\r\n', '2024-11-23 02:18:48'),
(4, 'Pichi-Pichi', 80, 'Experience the soft, chewy goodness of our Pichi-Pichi, made from freshly grated cassava and delicately steamed to perfection. Each bite is generously rolled in your choice of fresh grated coconut or cheese, delivering a delightful balance of flavors and textures you’ll love.', 30, 'Available', 1, 'prod-pichi-pichi.jpg', '2024-11-23 02:20:59'),
(5, 'Polvoron', 30, 'Polvoron is a classic Filipino shortbread treat made with toasted flour, milk, sugar, and butter. Soft, crumbly, and delightfully sweet, it’s a perfect bite-sized indulgence for any occasion!', 100, 'Available', 1, 'prod-polvoron.jpg', '2024-11-23 02:22:09'),
(6, 'Chocolate Cupcake', 175, 'Savor the rich, fudgy delight of our moist chocolate fudge cupcakes made with premium cocoa and dark chocolate.', 50, 'Available', 2, 'prod-choco-cupcake.jpg', '2024-12-04 03:23:51'),
(7, 'Banana Cupcake', 150, 'Enjoy the moist, sweet goodness of our premium banana cupcakes made with ripe bananas and the finest ingredients.', 50, 'Available', 2, 'prod-banana-cupcake.jpg', '2024-12-04 03:24:27'),
(8, 'Chocolate Donut', 150, 'Enjoy the rich, fudgy goodness of our premium chocolate donuts, made with the finest cocoa and real chocolate for a moist and tender treat.', 50, 'Available', 2, 'prod-choco-donut.jpg', '2024-12-04 03:25:27'),
(9, 'Strawberry Donut', 120, 'Enjoy the sweet, juicy strawberries and fluffy texture of our irresistible strawberry donuts.', 50, 'Available', 2, 'prod-strawberry-donut.jpg', '2024-12-04 03:26:21'),
(10, 'Vanilla Donut', 130, 'Enjoy the classic vanilla donut, soft and fluffy with a burst of fun from colorful sprinkles and a crunchy topping.', 50, 'Available', 2, 'prod-vanilla-donut.jpg', '2024-12-04 03:27:00'),
(11, 'Cookies', 60, 'Delight in our handcrafted cookies, baked to golden perfection with premium ingredients. Each bite offers a symphony of rich flavors and irresistible texture.', 50, 'Available', 3, 'prod-cookie.jpg', '2024-12-04 03:27:42'),
(12, 'Brownies', 150, 'Indulge in our luscious brownies, crafted with rich chocolate for a decadent experience. Each piece melts in your mouth with a perfect balance of fudgy and chewy goodness.', 75, 'Available', 3, 'prod-brownies.png', '2024-12-04 03:28:14'),
(13, 'Chocolate Crinkles', 60, 'Delight in our velvety choco crinkles, bursting with rich cocoa flavor. Each bite is a soft, sweet embrace dusted with powdered perfection.', 75, 'Available', 3, 'prod-choco-crinkles.jpg', '2024-12-04 03:28:55'),
(14, 'Cheesecake', 150, 'Our creamy cheesecake offers a rich, smooth texture with a subtle tang. Balanced sweetness rests atop a buttery crust.\r\n', 20, 'Available', 4, 'prod-cheesecake.jpg\r\n', '2024-12-04 03:30:01'),
(15, 'Chocolate Hazelnut Tart', 180, 'A luscious chocolate hazelnut tart with a velvety filling, crowned by a delicate, nutty crunch. A perfect harmony of richness and texture.', 50, 'Available', 4, 'prod-choco-tart.jpg', '2024-12-04 03:31:16'),
(16, 'Strawberry Cream Tart', 160, 'A strawberry cream tart with a buttery crust, layered with silky cream and fresh, juicy strawberries. A refreshing balance of sweetness and elegance.', 50, 'Available', 4, 'prod-strawberry-tart.png\r\n', '2024-12-04 03:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queries`
--

CREATE TABLE `tbl_queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `query_text` text NOT NULL,
  `query_reply` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_queries`
--

INSERT INTO `tbl_queries` (`query_id`, `user_id`, `subject`, `query_text`, `query_reply`, `created_at`) VALUES
(1, 1, 'Product Suggestion', 'Hello po Good Day! Ask lang po if possible po mag suggest ng new product? Favorite ko po kasi yung Egg Pie. Salamat po!', 'Sure thing sige! We\'ll consider your suggestion. Thank you!', '2024-12-13 11:39:13'),
(2, 13, 'Product Appreciation', 'Hii!! I just want to say na SUPERRRR sarap po ng nabili kong chocolate cupcake sa inyo HUHUHU T_T. Thank you! From now on I\'m one of your suki na <33. Keep up the good work!', '', '2024-12-13 12:09:49'),
(3, 1, 'Honest Review', 'Good day! I just want to help you improve your business by giving some honest feedback. To start, the taste of your leche flan is a bit bland. It\'s not bad, but I think it could be a little sweeter. That\'s all. Thank you, and I hope this helps!', '', '2024-12-13 15:32:59'),
(4, 1, 'No Subject', 'THANK YOU SELLER!!!! MORE BLESSINGS TO COME!', 'Welcome!', '2024-12-13 17:20:04'),
(5, 14, 'SURE BUYER', 'Do you accept G-cash as payment? If not, then why?', 'No po as of the moment, but soon po we\'ll try to make it happen. Thanks!', '2024-12-13 17:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `review_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `reply_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`review_id`, `prod_id`, `user_id`, `rating`, `review_text`, `reply_text`, `created_at`) VALUES
(1, 6, 1, 5, 'SUPER SARAP AS IN!! 5stars rate ko dsurb ng seller!!!!! THANK YOU! New Fav unlocked :>', '', '2024-12-11 13:24:26'),
(2, 8, 14, 2, 'Di ko nagustuhan yung lasa, matabang siya parang nakulangan ng asukal at chocolate. I hope mag improve pa T_T', 'Okay teh whatever!', '2024-12-11 13:25:22'),
(3, 1, 13, 4, 'SARAP AS IN LEGIT!!!!!!', '', '2024-12-13 16:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `total_revenue` decimal(10,2) NOT NULL,
  `target_revenue` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`sales_id`, `total_revenue`, `target_revenue`, `date`, `created_at`) VALUES
(1, 1200.50, 1500.00, '2024-12-01', '2024-12-08 05:32:03'),
(2, 1500.50, 1500.00, '2024-12-02', '2024-12-08 05:32:31'),
(3, 1100.25, 1500.00, '2024-12-03', '2024-12-08 06:09:32'),
(4, 2000.00, 1500.00, '2024-12-04', '2024-12-08 06:09:56'),
(5, 1000.05, 1500.00, '2024-12-05', '2024-12-08 06:34:22'),
(6, 3000.50, 1500.00, '2024-12-06', '2024-12-08 08:26:11'),
(7, 1575.25, 1500.00, '2024-12-07', '2024-12-08 08:26:25'),
(8, 1250.95, 1500.00, '2024-12-08', '2024-12-08 08:46:45'),
(9, 1420.80, 1500.00, '2024-12-09', '2024-12-08 09:46:35'),
(10, 1350.05, 1500.00, '2024-12-10', '2024-12-08 09:47:50'),
(11, 2105.20, 1500.00, '2024-12-11', '2024-12-08 09:48:18'),
(12, 5500.00, 7500.00, '2024-11-06', '2024-12-09 00:38:06'),
(13, 7425.00, 7500.00, '2024-11-16', '2024-12-09 00:38:31'),
(14, 20162.75, 20000.00, '2024-10-04', '2024-12-09 01:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_top_up`
--

CREATE TABLE `tbl_top_up` (
  `top_up_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `amount` int(5) NOT NULL,
  `wallet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_top_up`
--

INSERT INTO `tbl_top_up` (`top_up_id`, `user_id`, `date`, `time`, `amount`, `wallet_id`) VALUES
(2, 1, '2024-12-04', '11:47:00', 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `birthday` date NOT NULL,
  `display_photo` varchar(255) NOT NULL DEFAULT 'sample-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email`, `password`, `created_at`, `firstname`, `middlename`, `lastname`, `age`, `username`, `contact_no`, `gender`, `birthday`, `display_photo`) VALUES
(1, 'rajtuyay24@gmail.com', '$2y$10$XyXlYkPUw3niOFlrDbUIy.l2Yd7MSbum7Vr3W9qbLPY1F3E3r3TPK', '2024-11-26 12:46:38', 'Raj Daniel', 'Guevarra', 'Tuyay', 20, 'rajtuyay', '09352811980', 'Male', '2004-08-24', 'Lunox_DG.jpg'),
(13, 'Gulpane@dhvsu.edu.ph', '$2y$10$alUVg2tvg0.AQ0WoLi/QgOHaPUe.RW8V3gU7vmTA5gvpMhKPwdlwi', '2024-12-05 07:28:40', 'Melvin', 'Carreon', 'Gulpane', 22, 'Elvs', '09314235674', 'Male', '2002-07-20', 'sample-profile.png\r\n'),
(14, 'villegasjhonrick@gmail.com', '$2y$10$tVJQbfhgGnt/pwscQGrDyu3bbQJILq0mxTcACCebotqYrDmvupazO', '2024-12-06 05:11:10', 'Jhonrick', 'Dimla', 'Villegas', 21, 'Rek', '09214566552', 'Male', '2003-08-23', 'rainalyn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallet`
--

CREATE TABLE `tbl_wallet` (
  `wallet_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wallet`
--

INSERT INTO `tbl_wallet` (`wallet_id`, `balance`, `user_id`, `updated_at`) VALUES
(1, 2000.00, 1, '2024-12-04 03:42:19'),
(4, 0.00, 13, '2024-12-05 07:28:40'),
(5, 10000.00, 14, '2024-12-06 05:11:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_addresses`
--
ALTER TABLE `tbl_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `Username` (`username`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_queries`
--
ALTER TABLE `tbl_queries`
  ADD PRIMARY KEY (`query_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `tbl_top_up`
--
ALTER TABLE `tbl_top_up`
  ADD PRIMARY KEY (`top_up_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wallet_id` (`wallet_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_addresses`
--
ALTER TABLE `tbl_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_queries`
--
ALTER TABLE `tbl_queries`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_top_up`
--
ALTER TABLE `tbl_top_up`
  MODIFY `top_up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_addresses`
--
ALTER TABLE `tbl_addresses`
  ADD CONSTRAINT `tbl_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD CONSTRAINT `tbl_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`),
  ADD CONSTRAINT `tbl_order_items_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`);

--
-- Constraints for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD CONSTRAINT `tbl_payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`),
  ADD CONSTRAINT `tbl_payments_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`);

--
-- Constraints for table `tbl_queries`
--
ALTER TABLE `tbl_queries`
  ADD CONSTRAINT `tbl_queries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD CONSTRAINT `tbl_reviews_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`),
  ADD CONSTRAINT `tbl_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_top_up`
--
ALTER TABLE `tbl_top_up`
  ADD CONSTRAINT `tbl_top_up_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_top_up_ibfk_2` FOREIGN KEY (`wallet_id`) REFERENCES `tbl_wallet` (`wallet_id`);

--
-- Constraints for table `tbl_wallet`
--
ALTER TABLE `tbl_wallet`
  ADD CONSTRAINT `tbl_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
