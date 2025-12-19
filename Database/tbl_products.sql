-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 03:20 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
