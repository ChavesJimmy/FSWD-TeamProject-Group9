-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Dez 2022 um 22:04
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fswd-teamproject_group9`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `discount`
--

INSERT INTO `discount` (`id`, `discount`) VALUES
(1, 5),
(2, 10),
(3, 15),
(4, 20),
(5, 25),
(6, 30),
(7, 40),
(8, 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `type` enum('Food Supplements','Materials','Others') DEFAULT NULL,
  `availability` enum('Available','Not available','','') DEFAULT 'Available',
  `fk_discount` int(11) DEFAULT NULL,
  `displ` enum('yes','no','','') NOT NULL DEFAULT 'yes',
  `Discount` enum('NULL','5','10','15','20','25','30','40','50') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `picture`, `description`, `price`, `type`, `availability`, `fk_discount`, `displ`, `Discount`) VALUES
(1, 'Protein - Applied Nutrition Iso-XP (2kg)', '639325dd9f810.jpg', 'ISO-XP is a high protein supplement with sweetener and by far the cleanest and highest quality Whey Protein Isolate available, with only 0.1g Lactose per 25g serving. Basically there is no other protein, anywhere, which exceeds this level of clinical prot', 60, 'Food Supplements', 'Available', NULL, 'yes', ''),
(2, 'Protein - Scitec Nutrition 100% Whey Isolate 2000g', '639326017d118.jpg', 'Scitec 100% Whey Isolate is an excellent quality protein exclusively from whey. Generally, whey Isolate proteins are produced to have a higher percentage of protein than whey “concentrates”, which also means that “isolates” have lower sugar (including lac', 59, 'Food Supplements', 'Not available', 4, 'no', NULL),
(3, 'Protein - Applied Nutrition Clear Whey Protein 875g', '6393260f55bcd.jpg', 'Applied Nutrition’s Clear Whey Protein is not your average protein shake. Using ultra-hydrolysed whey protein isolate, Applied Nutrition have created a delicious, light and refreshing protein drink that is more like a fruit juice than a milkshake.\r\nWith a', 35, 'Food Supplements', '', NULL, 'yes', NULL),
(4, 'Protein - BioTech Hydro Whey Zero 1816g', '639326296dd0d.jpg', 'Hydro Whey Zero is a combined whey protein drink powder with a protein content of 80%. The composition of the protein also contains, besides hydrolysed whey protein and whey isolate sources, added L-glutamine and L-arginine amino acids. The decomposition ', 60, 'Food Supplements', 'Not available', 1, 'yes', NULL),
(5, 'Amino Acid - Applied Nutrition Multi-Vitamin Complex', '639326737dc04.jpg', 'Multi-Vitamin Complex contributes to the normal function of the immune system during and after intense physical exercise, the nervous system as well as normal muscle and cognitive function and the normal formation of connective tissue.\" \" ', 15, 'Food Supplements', 'Available', 2, 'yes', ''),
(6, 'Amino Acid - OPTIMUM NUTRITION Amino Energy 270 g', '6393278a3d78a.jpg', 'You can tap into Amino Energy any time of the day. It’s ideal in the morning when you’re planning to attack the day; use it as an alternative to your morning coffee. It’s also great instead of a fizzy drink with your lunch, or as an afternoon booster. Or ', 20, 'Food Supplements', '', NULL, 'yes', '25'),
(7, 'Amino Acid - HIMALAYA LIV.52 DS Double Strength 60 Tablets', '639326bcf141a.jpg', 'Liv.52 (LiverCare) helps restore the functional efficiency of the liver by protecting the hepatic parenchyma and assists in promoting hepatocellular regeneration. It facilitates rapid elimination of acetaldehyde, the toxic intermediate metabolite of alcoh', 11, 'Food Supplements', '', NULL, 'yes', NULL),
(8, 'Amino Acid - Mutant BCAA 9.7 348g - Fruit Punch', '639327134fdca.jpg', 'Mutant BCAA 9.7 delivers 9.7 grams of amino acids in just 1 concentrated scoop.\r\nThis product is in the preferred 2:1:1 ratio and then instantized for superior solubility; with added Micronized Amino Support Stack; and finally magnesium fortified to help ', 19, 'Food Supplements', '', NULL, 'yes', NULL),
(9, 'Creatine - Optimum Nutrition - 93 Servings', '63932729d153f.jpg', 'Creatine monohydrate is one of the most well-researched sports nutrition ingredients.\r\nThis unflavored powder mixes easily into water, juice or your post-workout protein shake to help you meet your ambitious power & performance goals.\r\nWhen used in conjun', 27, 'Food Supplements', '', NULL, 'yes', NULL),
(10, 'Creatine - Pro Supps 200 - 200 grams', '6393274228cda.jpg', 'ProSupps Creatine 200 is premium grade Creatine Monohydrate. Creatine Monohydrate is one of the most researched supplements in sports nutrition with numerous clinical studies supporting its use, effectiveness and safety. It is naturally found in many food', 20, 'Food Supplements', '', NULL, 'yes', NULL),
(11, 'Creatine - Warrior Nitrate', '6393275a788ca.jpg', 'Warriors Creatine Nitrate is an innovative new creatine supplement created by mixing the various benefits of creatine and dietary nitrates together.\r\nNitrates come from nitrogen and oxygen molecules that get converted into nitric oxide which are great for', 18, 'Food Supplements', '', NULL, 'yes', NULL),
(12, 'Creatine - 5% Stage Ready Diuretic', '6393279e250cc.jpg', 'When you’re putting everything you have into getting in the best shape of your life, you don’t need excess water retention hiding the valley-deep cuts you’ve been working for. This is the most potent diuretic you can find, and for good reason - the ingred', 25, 'Food Supplements', '', NULL, 'yes', NULL),
(13, 'Creatine - Grenade Creatine 500g', '639327ae5ecb3.jpg', 'Creatine Monohydrate is one of the most extensively studied supplements available and is widely recognised for enhancing strength, recovery, anaerobic capacity and lean mass. With this vast amount of research, creatine is an essential for athletes who wan', 20, 'Food Supplements', '', NULL, 'yes', NULL),
(14, 'USN Tornado Shaker 650-700ml', '639327bacfc9a.jpg', '650ml Tornado Shaker with a detachable compartment to hold a serving of your favourite USN powders!\r\nLeak proof with a rubber seal around the inner mesh\r\nSealed Mouthpiece inside and outside Flip-back and lock mouthpiece cover Screw-on section for powder ', 8, 'Food Supplements', '', NULL, 'yes', NULL),
(15, 'ALPHA BOTTLE V2 750ML', '639327e2c59a5.jpg', 'At Alpha Designs we focus on function over form without compromising on design. So we went back to the drawing board and developed the ultimate shaker bottle. The Alpha Bottle features a silicone seal which ensures the Alpha Bottle is 100% leak-proof, com', 6, 'Others', '', NULL, 'yes', NULL),
(16, 'ALPHA BOTTLE XXL - 2400ML BPA FREE WATER JUG', '6393284b9028a.jpg', 'This 2.4Litre jug is brought to you by the guys at Alpha Designs. No corners cut here folks, UK made, UK designed, leak-proof, BPA & DEHP free AND shatter resistant.This jug isnt just your average jug either....8 sides, this octagonal sensation is a cut a', 12, 'Others', '', NULL, 'yes', NULL),
(17, 'Chaos Crew Graffiti Shaker 700ml', '6393285c5af81.jpg', '700ml shaker with mixer ball.\r\nSimply add your ingredients, toss in the mixerball, and shake. The mixerball whips around inside the bottle, mixing even the thickest ingredients to a smooth and light consistency.\r\nThe classic screw-on lid and secure flip c', 7, 'Others', '', NULL, 'yes', NULL),
(18, 'Urban Fitness 2.7m Leather Jump Rope', '6393286caf981.jpg', '2.7 metre Leather skipping rope.\r\nFoam covered handles offer superb grip.\r\nBall bearing mechanism improves speed and provides smooth movement.', 10, 'Others', '', NULL, 'yes', NULL),
(19, 'Urban Fitness High Grip Speed Rope 2.8m', '6393288386cd7.jpg', 'A lightweight speed rope benefiting from high grip handles which greatly improve slip- resistance. Bearings in the handles ensure a smooth running rope for even faster skipping.\r\nA lightweight speed rope benefiting from high grip handles which greatly imp', 8, 'Others', '', NULL, 'yes', NULL),
(20, 'Urban Fitness 4mm Yoga Mat - Green', '63932891929eb.jpg', 'The Urban Fitness Exercise Fitness Yoga Mat is a PVC yoga mat, offering excellent grip and cushioning. Comes complete with shoulder strap, making it easy to carry. It also keeps the mat rolled up when not in use.', 10, 'Others', '', NULL, 'yes', NULL),
(21, 'Urban Fitness 4mm Yoga Mat - Pink', '6393289b62d87.jpg', 'The Urban Fitness Exercise Fitness Yoga Mat is a PVC yoga mat, offering excellent grip and cushioning. Comes complete with shoulder strap, making it easy to carry. It also keeps the mat rolled up when not in use.', 10, 'Others', '', NULL, 'yes', NULL),
(22, 'Urban Fitness 4mm Yoga Mat - Blue', '639328a22a768.jpg', 'The Urban Fitness Exercise Fitness Yoga Mat is a PVC yoga mat, offering excellent grip and cushioning. Comes complete with shoulder strap, making it easy to carry. It also keeps the mat rolled up when not in use.', 10, 'Others', '', NULL, 'yes', NULL),
(23, 'Urban Fitness 2 in 1 Massage Roller Set', '639328a9d7532.jpg', 'The Urban Fitness 2 In 1 massage roller set includes two different styles of foam rollers to achieve best results. Improves circulation and helps loosen tight and stiff muscles.', 16, 'Others', '', NULL, 'yes', NULL),
(24, 'Urban Fitness 500kg Burst Resistance Swiss Ball 75cm', '639328b56a3cf.jpg', 'Factory tested 500kg burst resistance. Helps relax muscles, remove tension and increase tone. Increasing flexibility in abdominal, thighs and lower back. Improves posture & balance.', 18, 'Others', '', NULL, 'yes', NULL),
(25, 'Urban Fitness 500kg Burst Resistance Swiss Ball 65cm', '639328bdc7bdc.jpg', 'Factory tested 500kg burst resistance. Helps relax muscles, remove tension and increase tone. Increasing flexibility in abdominal, thighs and lower back. Improves posture & balance.', 17, 'Others', '', NULL, 'yes', NULL),
(26, 'Urban Fitness 500kg Burst Resistance Swiss Ball 55cm', '639328c3b237f.jpg', 'Factory tested 500kg burst resistance. Helps relax muscles, remove tension and increase tone. Increasing flexibility in abdominal, thighs and lower back. Improves posture & balance.', 16, 'Others', '', NULL, 'yes', NULL),
(27, 'Urban Fitness Resistance Band Loop 12 Blue X-Strong', '639328d24e777.jpg', 'UFE 12 fitness loop is made from 100% natural latex and is ideal for advanced fitness regimes. Stretch, flex and workout with this extra strong resistance exercise band.', 3, 'Materials', '', NULL, 'yes', NULL),
(28, 'Urban Fitness Resistance Band Loop 12 Green Strong', '639328daa147f.jpg', 'UFE 12 fitness loop is made from 100% natural latex and is ideal for advanced fitness regimes. Stretch, flex and workout with this extra strong resistance exercise band.', 3, 'Materials', '', NULL, 'yes', NULL),
(29, 'Applied Nutrition Digital Watch', '639328e188197.jpg', 'Digital watch with the following features: stopwatch, alarm, and countdown timer. It is also 50m water-resistant.\r\nIt has a comfortable black strap and light to illuminate the digital clock.', 9, 'Others', '', NULL, 'yes', NULL),
(30, 'Set of 5 Resistance Loop Bands', '639328eebe02f.jpg', 'Resistance Exercise Bands allow you to get a complete body workout, train the legs, arms and more. Shape perfect body curve, stay fit and achieve your goal, perfect for both men and women.', 10, 'Materials', '', NULL, 'yes', NULL),
(31, 'MuscleAmmo BMO Print Muscle Fit T-Shirt - White', '6393290227cf6.jpg', 'The MuscleAmmo Beast Mode On Print Muscle Fit T-Shirt is available in Black, White & Grey.\r\nIt is a comfortable yet stylish t-shirt, that is perfect for the gym or everyday wear.\r\nWith a perfect fit on the body and arms, this muscle fit t-shirt not only e', 16, 'Materials', '', NULL, 'yes', NULL),
(32, 'MuscleAmmo Fearless Print Muscle Fit T-Shirt - Black', '639329d396f75.jpg', 'MuscleAmmo Fearless Print premium T-Shirt. 100% Cotton with suede FEARLESS print.', 15, 'Materials', '', NULL, 'yes', NULL),
(33, 'MuscleAmmo GAINS Print Muscle Fit T-Shirt - Black', '639329e4e6710.jpg', 'The MuscleAmmo Gains Print Muscle Fit T-Shirt is available in Black & White.\r\nIt is a comfortable yet stylish t-shirt, that is perfect for the gym or everyday wear.\r\nWith a perfect fit on the body and arms, this muscle fit t-shirt not only enhances the ph', 16, 'Materials', '', NULL, 'yes', NULL),
(34, 'Mens No Pain No Gain Cotton Sleeveless Vest', '639329ecf086c.jpg', '100% cotton Cotton Hand Wash Only Sleeveless', 11, 'Materials', '', NULL, 'yes', NULL),
(35, 'Muscle Ammo T-Shirt - White', '639329fa2fae8.jpg', '100% Cotton Loose fit Fine gauge knit 145 gsm Shoulder to shoulder taping Rolled forward shoulders for better fit Front cover seaming on collar To fit chest', 20, 'Materials', '', NULL, 'yes', NULL),
(36, 'Muscle Ammo Classic Hoody - Customised - White', '63932a02b6e7e.jpg', 'MuscleAmmo Classic Hoody - Customize with your name/ text 80% Cotton, 20% Polyester 280 gsm Kangaroo pouch pocket Drawcord double lined hood Warm and fashionable', 35, 'Materials', '', NULL, 'yes', NULL),
(37, 'Womens USN Slouch Yoga Top', '63932a0a1e8e2.jpg', 'A stylish design which offers fantastic comfort during your training. The USN Slouch Yoga Top features a grey and black slouch design for extra flexibility. The fashionable Slouch Yoga Top is the ideal piece of gym wear, especially those extra-stretchy yo', 5, 'Materials', '', NULL, 'yes', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products_reviews`
--

CREATE TABLE `products_reviews` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `fk_product` int(11) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products_reviews`
--

INSERT INTO `products_reviews` (`id`, `message`, `fk_product`, `star`, `fk_user`) VALUES
(2, 'test 2', 1, 4, NULL),
(3, 'test 3', 3, 3, NULL),
(4, 'test 2', 1, 4, NULL),
(5, 'test 3', 3, 3, NULL),
(6, '', 1, 0, NULL),
(7, 'blabla', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `fk_product` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `payment_method` enum('Paypal','Click and collect','Credit card') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `purchase`
--

INSERT INTO `purchase` (`id`, `fk_product`, `fk_user`, `purchase_date`, `payment_method`) VALUES
(1, 1, NULL, '2023-12-01', 'Paypal'),
(2, 1, NULL, '2022-12-07', 'Click and collect'),
(3, 1, NULL, '2023-12-01', 'Credit card'),
(4, 1, NULL, '2022-12-07', 'Paypal');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `review_answer`
--

CREATE TABLE `review_answer` (
  `id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `fk_review` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_produkt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `fk_user`, `fk_produkt`) VALUES
(1, 3, 1),
(2, 3, 1),
(3, 3, 24),
(4, 3, 35);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('USER','ADMIN') NOT NULL DEFAULT 'USER',
  `user_allowed` enum('allowed','banned') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `address`, `birth_date`, `photo`, `status`, `user_allowed`) VALUES
(3, 'admin', '597f5441e7d174b607873874ed54b974674986ad543e7458e28a038671c9f64c', 'Test', 'Admin', 'admin@admin.test', 'Street', '1992-04-18', NULL, 'ADMIN', 'allowed'),
(4, 'user', 'ae5deb822e0d71992900471a7199d0d95b8e7c9d05c40a8245a281fd2c1d6684', 'Test', 'User', 'user@user.test', 'Street', '1992-04-18', NULL, 'USER', 'allowed');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`fk_discount`);

--
-- Indizes für die Tabelle `products_reviews`
--
ALTER TABLE `products_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`fk_product`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indizes für die Tabelle `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`fk_product`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indizes für die Tabelle `review_answer`
--
ALTER TABLE `review_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_review` (`fk_review`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indizes für die Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_produkt` (`fk_produkt`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `products_reviews`
--
ALTER TABLE `products_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `review_answer`
--
ALTER TABLE `review_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fk_discount`) REFERENCES `discount` (`id`);

--
-- Constraints der Tabelle `products_reviews`
--
ALTER TABLE `products_reviews`
  ADD CONSTRAINT `products_reviews_ibfk_1` FOREIGN KEY (`fk_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_reviews_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`fk_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `review_answer`
--
ALTER TABLE `review_answer`
  ADD CONSTRAINT `review_answer_ibfk_1` FOREIGN KEY (`fk_review`) REFERENCES `products_reviews` (`id`),
  ADD CONSTRAINT `review_answer_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`fk_produkt`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
