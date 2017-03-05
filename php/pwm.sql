-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Lis 2016, 02:30
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
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Bonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`Id`, `Login`, `Password`, `Email`, `Bonus`) VALUES
(1, 'admin', '$2y$10$2hqSreR0L3x0db7/.qQml.hyQv.sLqtVMp7PUDHyRUFpNmUkKs8ua', 'admin@admin.pl', 69),
(2, 'Tyna246', 'Kochammojegokota', 'tyna@kocham.pl', 100),
(3, 'adam', '$2y$10$468Up3yYGba4AXzg6vxteOeZbYh9vPeTpQ30SwYogF9G9U95MHhgq', 'tester@test.pl', 10),
(4, 'fgsfasfas', '$2y$10$Q4BjxbHBIMcY3NAxp8gnrubUJicgfuXMuPTlio42mWdvAELM44xBS', 'asfa@fasfas.gsagas', 10),
(5, 'asgasgasg', '$2y$10$fdhE6kM0g/MPTdohXuqhCu5rUYLjejxInY4uF1tVg9DxdmTfaffbi', 'gasga@gaggaa.gag', 10),
(6, 'gaasg', '$2y$10$kR1.3EUkJV9bw5UvDjYyNedKEnQkKvASnmhyzrZJe3pJb/FLo3Yfa', 'fafas@fafa.gat', 10);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
