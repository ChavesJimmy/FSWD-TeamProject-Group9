-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Dez 2022 um 13:26
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

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
  `availability` tinyint(1) DEFAULT NULL,
  `fk_discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('USER','ADMIN') NOT NULL,
  `user_allowed` enum('allowed','banned') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `fk_discount` (`fk_discount`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products_reviews`
--
ALTER TABLE `products_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `review_answer`
--
ALTER TABLE `review_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
