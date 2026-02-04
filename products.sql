-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 feb 2026 om 12:11
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `sort_order`) VALUES
(1, 'Breakfast', 'Healthy breakfast options', 1),
(2, 'Lunch & Dinner', 'Bowls and warm meals', 2),
(3, 'Handhelds', 'Wraps and sandwiches', 3),
(4, 'Sides', 'Sides and small plates', 4),
(5, 'Dips', 'Signature dips', 5),
(6, 'Drinks', 'Cold drinks and smoothies', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `images`
--

INSERT INTO `images` (`image_id`, `filename`, `description`) VALUES
(1, 'assets/img/acai_bowl.png', 'Morning Boost Açaí Bowl'),
(2, 'assets/img/garden_wrap.png', 'Garden Breakfast Wrap'),
(3, 'assets/img/pb_toast.png', 'Peanut Butter & Cacao Toast'),
(4, 'assets/img/overnight_oats.png', 'Overnight Oats Apple Pie Style'),
(5, 'assets/img/tofu_tahini.png', 'Tofu Power Tahini Bowl'),
(6, 'assets/img/supergreen.png', 'Supergreen Harvest'),
(7, 'assets/img/falafel_bowl.png', 'Mediterranean Falafel Bowl'),
(8, 'assets/img/tempeh_bowl.png', 'Warm Teriyaki Tempeh Bowl'),
(9, 'assets/img/hummus_wrap.png', 'Zesty Chickpea Hummus Wrap'),
(10, 'assets/img/halloumi_toastie.png', 'Avocado & Halloumi Toastie'),
(11, 'assets/img/jackfruit_slider.png', 'Smoky BBQ Jackfruit Slider'),
(12, 'assets/img/sweet_potato.png', 'Sweet Potato Wedges'),
(13, 'assets/img/zucchini_fries.png', 'Zucchini Fries'),
(14, 'assets/img/falafel_bites.png', 'Baked Falafel Bites'),
(15, 'assets/img/veggie_platter.png', 'Mini Veggie Platter & Hummus'),
(16, 'assets/img/hummus.png', 'Classic Hummus'),
(17, 'assets/img/avocado_lime.png', 'Avocado Lime Crema'),
(18, 'assets/img/yogurt_ranch.png', 'Greek Yogurt Ranch'),
(19, 'assets/img/sriracha_mayo.png', 'Spicy Sriracha Mayo'),
(20, 'assets/img/satay.png', 'Peanut Satay Sauce'),
(21, 'assets/img/green_glow.png', 'Green Glow Smoothie'),
(22, 'assets/img/matcha_latte.png', 'Iced Matcha Latte'),
(23, 'assets/img/infused_water.png', 'Fruit Infused Water'),
(24, 'assets/img/berry_blast.png', 'Berry Blast Smoothie'),
(25, 'assets/img/citrus_cooler.png', 'Citrus Cooler');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL DEFAULT 1,
  `pickup_number` tinyint(4) NOT NULL,
  `price_total` decimal(7,2) NOT NULL,
  `payment_method` varchar(10) NOT NULL DEFAULT 'card',
  `is_paid` tinyint(1) DEFAULT 1,
  `datetime` datetime DEFAULT current_timestamp(),
  `order_date` date NOT NULL
) ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `description`) VALUES
(1, 'Started'),
(2, 'Placed and paid'),
(3, 'Preparing'),
(4, 'Ready for pickup'),
(5, 'Picked up');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `kcal` int(11) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `image_id`, `name`, `description`, `price`, `kcal`, `available`, `sort_order`) VALUES
(1, 1, 1, 'Morning Boost Açaí Bowl', 'Açaí, banana, granola, chia, coconut', 7.50, 320, 1, 1),
(2, 1, 2, 'Garden Breakfast Wrap', 'Scrambled eggs, spinach, yogurt-herb sauce', 6.50, 280, 1, 1),
(3, 1, 3, 'Peanut Butter & Cacao Toast', 'Peanut butter, banana, cacao nibs', 5.00, 240, 1, 1),
(4, 1, 4, 'Overnight Oats: Apple Pie Style', 'Almond milk oats, apple, cinnamon, walnuts', 5.50, 290, 1, 1),
(5, 2, 5, 'Tofu Power Tahini Bowl', 'Quinoa, tofu, sweet potato, kale, tahini', 10.50, 480, 1, 2),
(6, 2, 6, 'Supergreen Harvest', 'Kale, edamame, avocado, cucumber', 9.50, 310, 1, 2),
(7, 2, 7, 'Mediterranean Falafel Bowl', 'Falafel, hummus, vegetables', 10.00, 440, 1, 2),
(8, 2, 8, 'Warm Teriyaki Tempeh Bowl', 'Brown rice, tempeh, broccoli', 11.00, 500, 1, 2),
(9, 3, 9, 'Zesty Chickpea Hummus Wrap', 'Spiced chickpeas, hummus, vegetables', 8.50, 410, 1, 3),
(10, 3, 10, 'Avocado & Halloumi Toastie', 'Grilled halloumi, avocado, chili flakes', 9.00, 460, 1, 3),
(11, 3, 11, 'Smoky BBQ Jackfruit Slider', 'BBQ jackfruit, purple slaw', 7.50, 350, 1, 3),
(12, 4, 12, 'Sweet Potato Wedges', 'Oven baked with smoked paprika', 4.50, 260, 1, 4),
(13, 4, 13, 'Zucchini Fries', 'Crispy breaded zucchini', 4.50, 190, 1, 4),
(14, 4, 14, 'Baked Falafel Bites (5 pcs)', 'Five baked falafel bites', 5.00, 230, 1, 4),
(15, 4, 15, 'Mini Veggie Platter & Hummus', 'Celery, carrots, cucumber', 4.00, 160, 1, 4),
(16, 5, 16, 'Classic Hummus', 'Smooth chickpea hummus, perfect for dipping', 1.00, 120, 1, 5),
(17, 5, 17, 'Avocado Lime Crema', 'Creamy avocado with a hint of lime, great with veggies', 1.00, 110, 1, 5),
(18, 5, 18, 'Greek Yogurt Ranch', 'Tangy Greek yogurt with herbs, ideal as a dip', 1.00, 90, 1, 5),
(19, 5, 19, 'Spicy Sriracha Mayo', 'Spicy and creamy sriracha mayo, adds kick to dishes', 1.00, 180, 1, 5),
(20, 5, 20, 'Peanut Satay Sauce', 'Rich peanut sauce, perfect for dipping or drizzling', 1.00, 200, 1, 5),
(21, 6, 21, 'Green Glow Smoothie', 'Spinach, pineapple, cucumber', 3.50, 120, 1, 6),
(22, 6, 22, 'Iced Matcha Latte', 'Matcha with almond milk', 3.00, 90, 1, 6),
(23, 6, 23, 'Fruit Infused Water', 'Lemon, strawberry, cucumber', 1.50, 0, 1, 6),
(24, 6, 24, 'Berry Blast Smoothie', 'Mixed berries with almond milk', 3.80, 140, 1, 6),
(25, 6, 25, 'Citrus Cooler', 'Orange juice, sparkling water', 3.00, 90, 1, 6),
(26, 5, 16, 'Classic Hummus', 'Smooth chickpea hummus, perfect for dipping', 1.00, 120, 1, 5),
(27, 5, 17, 'Avocado Lime Crema', 'Creamy avocado with a hint of lime, great with veggies', 1.00, 110, 1, 5),
(28, 5, 18, 'Greek Yogurt Ranch', 'Tangy Greek yogurt with herbs, ideal as a dip', 1.00, 90, 1, 5),
(29, 5, 19, 'Spicy Sriracha Mayo', 'Spicy and creamy sriracha mayo, adds kick to dishes', 1.00, 180, 1, 5),
(30, 5, 20, 'Peanut Satay Sauce', 'Rich peanut sauce, perfect for dipping or drizzling', 1.00, 200, 1, 5),
(31, 5, 16, 'Classic Hummus', 'Smooth chickpea hummus, perfect for dipping', 1.00, 120, 1, 5),
(32, 5, 17, 'Avocado Lime Crema', 'Creamy avocado with a hint of lime, great with veggies', 1.00, 110, 1, 5),
(33, 5, 18, 'Greek Yogurt Ranch', 'Tangy Greek yogurt with herbs, ideal as a dip', 1.00, 90, 1, 5),
(34, 5, 19, 'Spicy Sriracha Mayo', 'Spicy and creamy sriracha mayo, adds kick to dishes', 1.00, 180, 1, 5),
(35, 5, 20, 'Peanut Satay Sauce', 'Rich peanut sauce, perfect for dipping or drizzling', 1.00, 200, 1, 5);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Indexen voor tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id` (`image_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`);

--
-- Beperkingen voor tabel `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
