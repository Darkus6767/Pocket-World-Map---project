-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Lis 2016, 12:58
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pwm`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `g_long` double NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `markers`
--

INSERT INTO `markers` (`id`, `lat`, `g_long`, `description`) VALUES
(1, 51.5073509, -0.12775829999998223, 'dwa'),
(3, 51.5073509, -0.12775829999998223, 'heheh'),
(4, -36.7321521, 146.98362210000005, '^^'),
(5, 50.3249278, 18.785718599999996, 'Zabrze'),
(6, 50.2974884, 18.95457280000005, 'Chorzow'),
(7, 50.26489189999999, 19.02378150000004, 'Katowice'),
(8, 50.3249278, 18.785718599999996, 'w las '),
(9, 50.3249278, 18.785718599999996, 'dggd'),
(10, 2, -5, 'Kocham'),
(11, 52.2296756, 21.012228700000037, 'Warszawiaki'),
(12, 50.3249278, 18.785718599999996, 'gdsd'),
(13, 50.3789108, 18.92704750000007, 'Piekary');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
