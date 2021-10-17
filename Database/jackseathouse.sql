-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 10:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jackseathouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(8) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Starters'),
(2, 'Soups'),
(3, 'Salads'),
(4, 'Pasta'),
(5, 'Meats'),
(6, 'Traditional Maltese Food'),
(7, 'Pizza');

-- --------------------------------------------------------

--
-- Table structure for table `contactdetails`
--

CREATE TABLE `contactdetails` (
  `telephone` text,
  `mobileNumber` text,
  `address` text,
  `openingHours` text,
  `email` text,
  `contactID` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactdetails`
--

INSERT INTO `contactdetails` (`telephone`, `mobileNumber`, `address`, `openingHours`, `email`, `contactID`) VALUES
('+356 2168 1546', '+356 7931 7233', 'Jack&#039;s Eat House,\r\nTriq il-Bizantini\r\nIl-Qrendi, Malta\r\nQRD1802', 'Monday: 19:00 - 23:00\r\nTuesday: 19:00 - 23:00\r\nWednesday: 19:00 - 23:00\r\nThursday: 19:00 - 23:00\r\nFriday: 19:00 - 23:00\r\nSaturday: 19:00 - 23:00\r\nSunday: 19:00 - 23:00', 'jackseathouse@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `email` text NOT NULL,
  `emailID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email`, `emailID`) VALUES
('matthew.galea.18@um.edu.mt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `category_id` int(8) DEFAULT NULL,
  `item_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `item_name`) VALUES
(1, 1, 'Local Snails'),
(2, 1, 'Mushrooms in Garlic'),
(3, 2, 'Fish Soup'),
(4, 3, 'Chicken Caesar Salad'),
(5, 3, 'Smoked Salmon Salad'),
(6, 4, 'Spaghetti Rabbit'),
(7, 4, 'Penne Maltese'),
(8, 4, 'Spaghetti Seafood '),
(9, 4, 'Rabbit Ravioli'),
(10, 4, 'Jacks Risotto'),
(11, 5, 'Home-Made Beef Burger'),
(12, 5, 'Rib-Eye (450g)'),
(13, 5, 'Pork Ribs'),
(14, 5, 'Marinated Chicken Breast'),
(15, 6, 'Rabbit Pieces in Garlic'),
(16, 6, 'Rabbit Pieces in Gravy'),
(17, 6, 'Rabbit Stew'),
(18, 6, 'Whole Rabbit'),
(19, 6, 'Horse Meat'),
(20, 6, 'Quails'),
(21, 6, 'Beef Olives'),
(23, 7, 'Margherita'),
(24, 7, 'Funghi'),
(25, 7, 'Capricciosa'),
(26, 7, 'Pepperoni'),
(27, 7, 'Maltija'),
(28, 7, 'Al tonno'),
(29, 7, 'Marinara'),
(30, 7, 'Country Chicken'),
(31, 7, 'Mexicana'),
(32, 7, 'Meat Lovers'),
(33, 7, 'Romantico'),
(34, 7, 'Vegetariana'),
(35, 7, 'Jacks Ftira');

-- --------------------------------------------------------

--
-- Table structure for table `item_details`
--

CREATE TABLE `item_details` (
  `item_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float(11,2) NOT NULL,
  `image_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_details`
--

INSERT INTO `item_details` (`item_id`, `description`, `price`, `image_location`) VALUES
(1, 'Traditional Local Snails, served with garlic bread', 5.50, 'Local Snails.jpg'),
(2, 'Pan Fried garlic infused mushrooms, flamed in Brandy and fresh herbs', 5.50, 'Mushrooms in Garlic.jpg'),
(3, 'Simmered local fish with lemon zest and fresh herbs', 6.50, 'Fish Soup.jpg'),
(4, 'Grilled chicken breast tossed in crispy lettuce leaves, bacon, tomato wedges, croutons, grana shavings and drizzled with caesar dressing', 9.50, 'Chicken Caesar Salad.jpg'),
(5, 'Smoked Scottish salmon, served with toasted multigrain bread wedges, cherry tomatoes and mixed lettuce leaves, tossed in mustard dressing', 9.50, 'Smoked Salmon Salad.jpg'),
(6, 'Spaghettu tossed in a rich rabbit sauce', 6.00, 'Spaghetti Rabbit.jpg'),
(7, 'Penne tossed with Maltese sausage chunks', 9.50, 'Penne Maltese.jpg'),
(8, 'Spaghetti with mussels, vongole, prawns, garlic and fresh herbs', 12.50, 'Spaghetti Seafood.jpg'),
(9, '12 pieces rabbit ravioli served with a rich rabbit gravy flavoured with garlic and peas', 10.50, 'Rabbit Ravioli.jpg'),
(10, 'Arborio rice with chicken strips, bacon, spinach, porcini mushrooms and gorgonzola cream', 10.50, 'Jack_s Risotto.jpg'),
(11, '250g home-made beef burger with cheese, lettuce, tomatoes, caramelized onions and fries', 10.50, 'Home-Made Beef Burger.jpg'),
(12, 'Fresh 450g Rib-eye grilled to your liking', 21.50, 'Rib-Eye (450g).jpg'),
(13, 'BBQ sauce, honey and orange glazed full rack of ribs', 16.50, 'Pork Ribs.jpg'),
(14, 'Grilled marinated chicken breast with garlic and rosemary', 12.50, 'Marinated Chicken Breast.jpg'),
(15, 'Maltese-bred rabbit cooked in garlic and white wine', 12.50, 'Rabbit Pieces in Garlic.jpg'),
(16, 'Maltese-bred rabbit cooked in garlic and red wine gravy', 12.50, 'Rabbit Pieces in Gravy.JPG'),
(17, 'Maltese-bred rabbit stewed the traditional way', 12.50, 'Rabbit Stew.jpg'),
(18, 'Whole Rabbit fried in garlic/red wine gravy/ stewed', 30.00, 'Whole Rabbit.jpg'),
(19, 'Braised horse meat in garlic, thyme and white wine', 13.50, 'Horse Meat.jpg'),
(20, 'Pan fried marinated quails in garlic, thyme and white wine', 11.50, 'Quails.JPG'),
(21, 'Stewed thinly sliced beef stuffed with onions, bacon, carrots, eggs, parsley and minced beef', 14.50, 'Beef Olives.jpg'),
(23, 'Tomato Sauce, Mozzarella and Oregano', 6.00, 'Margherita.jpg'),
(24, 'Tomato Sauce, Mozzarella, Mushrooms and Oregano', 6.50, 'Funghi.jpg'),
(25, 'Tomato Sauce, Mozzarella, Mushrooms, Ham, Artichoke Hearts, Olives, Eggs', 8.50, 'Capricciosa.jpg'),
(26, 'Tomato Sauce, Mozzarella, Pepperoni, Red Leicester cheese, Oregano', 7.50, 'Pepperoni.jpg'),
(27, 'Tomato Sauce, Mozzarella, Maltese Sausage, Tomatoes, Roast Potatoes, Onions, Olives, Capers and Goat Cheese ', 8.50, 'Maltija.jpg'),
(28, 'Tomato Sauce, Mozzarella, Tuna, Onions and Tabasco', 7.50, 'Al tonno.jpg'),
(29, 'Tomato Sauce, Thuna, Seafood mix, Anchovies, Mussels and Onions', 8.00, 'Marinara.jpg'),
(30, 'Tomato Sauce, Mozzarella, Mushrooms, Chicken Strips, Peppers, Onions, Sweet corn and BBQ sauce', 8.00, 'Country Chicken.jpg'),
(31, 'Tomato Sauce, Mozzarella, Chili con Carne, Onions, Peppers and Oregano', 8.00, 'Mexicana.jpg'),
(32, 'Tomato Sauce, Mozzarella, Chicken Strips, Pork Sausages, Lamb Shavings, Pepperoni and Onions', 8.50, 'Meat Lovers.jpg'),
(33, 'Tomato Sauce, Mozzarella, Parma Ham, Parmeggiano Reggaino and Rucola', 8.00, 'Romantico.jpg'),
(34, 'Tomato Sauce, Mozzarella, Mushrooms, Peppers, Sweetcorn, Peas, Tomatoes, Black Olives and Onions', 8.00, 'Vegetariana.jpg'),
(35, 'Rustic Maltese Bread dough topped with tomato sauce, Pork Belly, Maltese Sausage, Tomatoes and Local Peppered Goats Cheese', 13.00, 'Jack_s Ftira.png');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `reviewName` text NOT NULL,
  `reviewMessage` text NOT NULL,
  `reviewStars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `reviewName`, `reviewMessage`, `reviewStars`) VALUES
(1, 'Alex Spot', 'Excellent food and excellent service.', 5),
(2, 'Linda Ross', 'Held my child&#039;s birthday party here, very much enjoyable!', 4),
(3, 'Taylor Donald', 'Friendly staff and exquisite dining, simply the best on the island!', 5);

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

CREATE TABLE `specials` (
  `id` int(11) NOT NULL,
  `Image` text NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`id`, `Image`, `Name`) VALUES
(0, 'Quails.JPG', 'Quails'),
(1, 'Rib-Eye (450g).jpg', 'Rib-Eye'),
(2, 'Vegetarian Salad.jpg', 'Vegetarian Salad'),
(3, 'Jack_s Ftira.png', 'Jack&#039;s Ftira');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `employee_id` int(11) NOT NULL,
  `employee_name` text NOT NULL,
  `employee_position` text NOT NULL,
  `employee_description` text NOT NULL,
  `image_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`employee_id`, `employee_name`, `employee_position`, `employee_description`, `image_location`) VALUES
(0, 'Kenneth Zara', 'Owner', 'Having worked and helped in managing his dads restaurant for over five years Kenneth decided to start his own legacy by opening Jacks Eat House.', 'Kenneth Zara.JPG'),
(10, 'Ben Micallef', 'Head Chef', 'After graduating from ITS and winning the Craft Calamari Cook Off in 2016 Ben joined Kenneths quest in starting a well-managed restaurant in Zurrieq. Apart from being head chef at Jacks Eat House Ben also likes to volunteer at multiple local homeless shelters.', 'Ben Micallef.jpg'),
(11, 'Veronika Fenech', 'Assistant Chef', 'Our Kitchen wont be the same without Veronika. Not only is she an essential asset but she also specialises in cake design and she is also responsible for all our deserts.', 'Veronika Fenech.jpg'),
(12, 'Daniela Miller', 'Head Waiter', 'Daniela will ensure that you as our customer will have a prompt and courteous service.', 'Daniela Miller.jpg'),
(13, 'Karen Mizzi', 'Manager', 'Karen works with all our staff to ensure that all safety and health regulations are up to standards along with a multitude of other responsibilities. She also organises special events and handles all of our PR work.', 'Karen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `welcomepage`
--

CREATE TABLE `welcomepage` (
  `welcomeMessage` text NOT NULL,
  `id` int(11) NOT NULL,
  `welcomeTitle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `welcomepage`
--

INSERT INTO `welcomepage` (`welcomeMessage`, `id`, `welcomeTitle`) VALUES
('Fine cuisine on our premises and delivered to your door', 0, 'Welcome to Jack&#039;s Eat House!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD PRIMARY KEY (`contactID`),
  ADD UNIQUE KEY `contactID` (`contactID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`emailID`),
  ADD UNIQUE KEY `emailID` (`emailID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_ibfk_1` (`category_id`);

--
-- Indexes for table `item_details`
--
ALTER TABLE `item_details`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `Item ID` (`item_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `welcomepage`
--
ALTER TABLE `welcomepage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
