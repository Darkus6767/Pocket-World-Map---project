-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Lis 2016, 21:51
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
  `place` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `Icon` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `markers`
--

INSERT INTO `markers` (`id`, `lat`, `g_long`, `place`, `description`, `Icon`) VALUES
(44, 52.2870682, 21.107960400000024, 'ZÄ…bki, Polska', 'gdgdg', 'mm_20_yellow.png'),
(45, 50.2974884, 18.95457280000005, 'ChorzÃ³w, Polska', 'gdgsgds', 'mm_20_blue.png'),
(46, 56.26392000000001, 9.50178500000004, 'Dania', 'Denemarck', 'mm_20_yellow.png'),
(47, 50.26489189999999, 19.02378150000004, 'Katowice, Polska', 'Silesian Capital', 'mm_20_red.png'),
(48, 52.52000659999999, 13.404953999999975, 'Berlin, Niemcy', 'Capital of Geramny', 'mm_20_yellow.png'),
(49, 52.3758916, 9.732010400000036, 'Hanower, Niemcy', 'Funny', 'mm_20_blue.png'),
(50, 36.204824, 138.252924, 'Japonia', 'ggsa', 'mm_20_yellow.png'),
(51, 61.52401, 105.31875600000001, 'Rosja', 'gdsgsd', 'mm_20_yellow.png'),
(52, 50.27304389999999, 18.879254599999967, 'Szyb Andrzeja, Ruda ÅšlÄ…ska, Polska', 'Korki ', 'mm_20_yellow.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
