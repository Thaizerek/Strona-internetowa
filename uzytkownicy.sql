-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Lip 2023, 02:57
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `uzytkownicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `praca`
--

CREATE TABLE `praca` (
  `ID` int(11) NOT NULL,
  `IDpracownika` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `ID` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `rola` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`ID`, `imie`, `nazwisko`, `email`, `telefon`, `haslo`, `rola`) VALUES
(30, 'test', 'test', 'test@test.com', '123456789', '$2y$10$0fAykv8oIVFgeQ3QGvc81ONRH11IIFT2KivQiLsmHsi8UoKf835ca', 'Admin'),
(33, 'Mariusz', 'Sypniewski', 'marsypn@gmail.com', '123321234', '$2y$10$Pdt33yQJeBkxxWr1BsNk5ute6mHEEmaogY/DNiVDWfLe0eIM4b3QO', 'Moderator'),
(34, 'test2', 'test2', 'test2@test2.com', '345567789', '$2y$10$RuRYMXYE1cOHJ04/aIH4IegNfNEbpk2NgosTRNN5QHBrlc4EP9Eq.', 'Pracownik'),
(35, 'example', 'example', 'example@example.com', '987254321', '$2y$10$EKroywx/gygTQRFw1ELCAOXv6kMIKcm5P1HMUmkMVr0sPk/EzRVYW', 'Pracownik');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `praca`
--
ALTER TABLE `praca`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
