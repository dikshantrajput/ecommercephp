-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 05:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(3, 'dikshant', '$2y$10$R/IWv15AiOLOMb.GdwR3yeHhiSxNmjFM.pKp2Fw.V4wHeWqJxYDgy');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(16, 'Chairs', 1),
(17, 'Fridges', 1),
(18, 'AC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `city`, `pin`, `payment_type`, `total_price`, `payment_status`, `order_status`, `timestamp`) VALUES
(40, 3, 'H no. 751/11,jyoti park, gurgaon', 'Gurgaon', '122001', 'cod', 0, 'success', 4, '2020-07-30 06:13:54'),
(41, 3, 'H no. 751/11,jyoti park, gurgaon', 'Gurgaon', '122001', 'cod', 80000, 'success', 4, '2020-07-30 06:49:11'),
(42, 3, 'H no. 751/11,jyoti park, gurgaon', 'Gurgaon', '122001', 'cod', 321993, 'success', 0, '2020-07-30 06:57:23'),
(43, 3, 'H no. 751/11,jyoti park, gurgaon', 'Gurgaon', '122001', 'paypal', 208993, 'pending', 0, '2020-07-30 14:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `timestamp`) VALUES
(11, 40, 8, 7, 0, '2020-07-29 17:19:58'),
(12, 41, 10, 5, 16000, '2020-07-30 06:47:50'),
(13, 42, 11, 7, 45999, '2020-07-30 06:57:23'),
(14, 43, 15, 3, 42999, '2020-07-30 14:56:09'),
(15, 43, 16, 4, 19999, '2020-07-30 14:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Cancelled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(2000) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `product_name`, `mrp`, `price`, `qty`, `image`, `short_description`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(10, 16, 'ROCKING CHAIR BY TAYYABA ENTERPRISES', 24000, 16000, 20, '43531.jpg', 'ROCKING CHAIR FOR ADULT|ROCKING CHAIR FOR LIVING ROOM OF SHEESHAM WOOD', 'Enjoy the feeling of being comfortable while you read your favourite books using our wooden rocking chair with its slim, modern design will be perfect for anyone short on space. It Provides support to relieve pai\r\nFeaturing strong and durable construction, this chair will be a stylish and timeless piece of furniture for your living area.This exclusive and modern chair will add style and function to any space in your home\r\nA gorgeous rocking chair with exquisite detailing will make your grandpa rather happy and proud to have it this is a perfect piece of furniture as this is one relaxing accessory that you can spend hours on the imaginary wheels give an altogether different dimension and charm to this chair.\r\nThe curved arm style supported by wheel where wheel based on two rocking leg which shift your weight back to front.It bring traditional touch to your living room collection. Just sit on it & get relaxed.\r\nConstructed from premium quality wooden material, it is highly durable in nature.Specially designed for the lovers of wooden articles.Further, the perfect finish and rich construction makes this rocking chair a perfect pick against your valuable currency.', 'Enjoy the feeling of being comfortable while you read your favourite books using our wooden rocking chair with its slim, modern design will be perfect for anyone short on space. It Provides support to relieve pai\r\nFeaturing strong and durable construction', 'Rocking Chair', 'Rocking chair by tayyaba'),
(11, 18, 'Dual Inverter 5 Star Split Air Conditioner with 4 Way Swing & Ocean Black Fin', 56990, 45999, 5, '26491.jpg', 'LG 4-in-1 Convertible Air Conditioner\r\n', 'Dual Inverter\r\n4-in-1 Convertible Cooling\r\nOcean Black Fin\r\n100% Copper With Ocean Black Protection\r\nHigh Temperature cooling Score of 5\r\nLow Gas Detection', 'Dual Inverter\r\n4-in-1 Convertible Cooling\r\nOcean Black Fin\r\n100% Copper With Ocean Black Protection\r\nHigh Temperature cooling Score of 5\r\nLow Gas Detection', 'A.C', 'LG A.C'),
(12, 17, 'Reconnect 190 litres 3 Star Single Door Refrigerator, Maroon RH210D3PMR', 14990, 10990, 10, '36162.jpg', 'Jumbo Freezer, Eco Friendly\r\nReciprocating Compressor Type\r\nMore Energy Efficient, Twist Ice Tray\r\nStabilizer Free Operation, R600a Refrigerant', 'You\'re looking at the Reconnect RH210D3PMR single door refrigerator. Measuring 58 cm in depth, 53 cm in width and 123 cm in height, this 190-litre refrigerator is suitable for a family of 2 to 3 members and can be placed in the kitchen or dining area. This refrigerator comprises of a separate freezer compartment and a fridge compartment. The huge capacity freezer compartment has a massive storage capacity of 45.04-litre in which, you can store ice cream, frozen yoghurt etc. ease. It also has a twist ice tray that lets you remove ice cubes with just a twist. The fridge compartment has two sturdy tempered glass shelves that can easily withstand the weight of heavy utensils. You can store large bottles of water, juice and other beverages on the side racks. This refrigerator also has a spacious vegetable crisper that provides room to store fresh fruits and vegetables. This refrigerator comes with eco-friendly R600a refrigerant which is CFC and HFC free.', 'You\'re looking at the Reconnect RH210D3PMR single door refrigerator. Measuring 58 cm in depth, 53 cm in width and 123 cm in height, this 190-litre refrigerator is suitable for a family of 2 to 3 members and can be placed in the kitchen or dining area. Thi', 'Reliance Fridge', 'Reliance Fridge'),
(13, 16, 'Art Deco Rocking Chair', 49000, 44840, 12, '37092.jpg', 'Simple Old School Chair', 'This stunning rocking chair is a reproduction of an Art Deco design. With wide hand rests and an ergonomically curved seat and backrest, this chair is designed for comfort and could be a great addition to a living room or master bedroom corner. It can also be used with a foot stool. The chair is crafted in teakwood and finished with matte melamine polish. The caning weave is a \'7 step\' pattern, made using high quality cane from the Andamans.', 'This stunning rocking chair is a reproduction of an Art Deco design. With wide hand rests and an ergonomically curved seat and backrest, this chair is designed for comfort and could be a great addition to a living room or master bedroom corner. It can als', 'Old School Chair', 'Chair'),
(14, 16, 'Wipro Furniture Alivio Mid Back Executive Ergonomic Office Chai', 20000, 17000, 10, '92794.jpg', 'Office Chair', 'Ergonomically engineered Synchro Tilt mechanism allowing users to tilt even while resting their feet on the floor. Adjustable Armrests and Seat Height & Cushioned lumber support\r\nPrimary Material: Fabric\r\nColor: Black, Style: Mid Back\r\nAssembly Required: The product requires carpenter assembly and will be provided by the seller\r\nWarranty: 1 year limited warranty against manufacturing defects\r\nFor customer service and warranty related queries please contact [1800-22-8222] (available Monday to Saturday from 9:30 AM to 6:00 PM except national holidays)\r\nProduct Dimensions: Length (19 Inches), Width (19 Inches), Height (38-42 Inches)', 'Ergonomically engineered Synchro Tilt mechanism allowing users to tilt even while resting their feet on the floor. Adjustable Armrests and Seat Height & Cushioned lumber support\r\nPrimary Material: Fabric\r\nColor: Black, Style: Mid Back\r\nAssembly Required: ', 'Chair', 'Office Chair'),
(15, 18, 'BLUESTAR 1.5 Ton 5 Star IC518DATU Inverter Split AC', 50000, 42999, 5, '80983.jpg', 'Air Conditioner', 'Copper condenser coil, precision cooling technology\r\nDual rotor inverter technology, R32 refrigerant\r\nBrushless DC motor, 17675 BTU/Hr cooling capacity\r\n2 litres/hour moisture removal', 'Copper condenser coil, precision cooling technology\r\nDual rotor inverter technology, R32 refrigerant\r\nBrushless DC motor, 17675 BTU/Hr cooling capacity\r\n2 litres/hour moisture removal', 'ac', 'air conditioner'),
(16, 17, 'LG 260 litres 2 Star Double Door Refrigerator, Blue Charm GL-T292RBCY', 29999, 19999, 10, '93821.jpg', 'Double door fridge', 'Smart inverter compressor, auto smart connect\r\nConvertiblePLUS, smart diagnosis, Door Cooling+\r\nWorks without stabilizer, ecofriendly refrigerant\r\nAnti-bacteria gasket, double twist ice tray', 'Smart inverter compressor, auto smart connect\r\nConvertiblePLUS, smart diagnosis, Door Cooling+\r\nWorks without stabilizer, ecofriendly refrigerant\r\nAnti-bacteria gasket, double twist ice tray', 'fridge', 'refrigerator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `timestamp`) VALUES
(3, 'DIKSHANT', 'dikshantraj2001@gmail.com', '$2y$10$WfwcI980T1Q5Gi/eXNNHceJi2WqFjBnjq6WGDRlrBrk0HiSnlRk8.', '07065447781', '2020-07-27 14:02:54'),
(4, 'ashu', 'ashu@gmail.com', '$2y$10$uSI/qDDnpGMojbS5yX1JTeWvRFczfMeydvP64SRnHR4wzgfJ3/0tm', '07065447781', '2020-07-27 14:22:28'),
(5, 'DIKSHANT', 'a@gmail.com', '$2y$10$4LBn0Kgkx2n.Euy4450RJ.RO9.bY2ctIz3rwENMcytB5NKcgCg7ba', '07065447781', '2020-07-27 16:55:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
