-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 21. dub 2024, 18:03
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `pojistovna`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `pojistenci`
--

CREATE TABLE `pojistenci` (
  `id_zakaznika` int(100) NOT NULL,
  `jmeno_zakaznika` varchar(50) NOT NULL,
  `prijmeni_zakaznika` varchar(50) NOT NULL,
  `email_zakaznika` varchar(50) NOT NULL,
  `mesto` varchar(30) NOT NULL,
  `ulice` varchar(30) NOT NULL,
  `cp` varchar(20) NOT NULL,
  `psc` int(10) NOT NULL,
  `narozeni` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `pojistenci`
--

INSERT INTO `pojistenci` (`id_zakaznika`, `jmeno_zakaznika`, `prijmeni_zakaznika`, `email_zakaznika`, `mesto`, `ulice`, `cp`, `psc`, `narozeni`) VALUES
(1, 'Táňa', 'Kulhavá', 'tana@kulhava.cz', 'Zábřeh', 'Václavská', '25', 78901, '2002-10-30'),
(2, 'Drtikol', 'Kulohrizec', 'drikul@kul.cz', 'Ostrava', 'Za humny', '855', 11354, '1990-06-08');

-- --------------------------------------------------------

--
-- Struktura tabulky `pojisteni`
--

CREATE TABLE `pojisteni` (
  `id_pojisteni` int(100) NOT NULL,
  `id_uzivatele` int(100) NOT NULL,
  `id_produktu` int(100) NOT NULL,
  `id_zakaznika` int(100) NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL,
  `cena` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `pojisteni`
--

INSERT INTO `pojisteni` (`id_pojisteni`, `id_uzivatele`, `id_produktu`, `id_zakaznika`, `od`, `do`, `cena`) VALUES
(3, 0, 3, 0, '0000-00-00', '0000-00-00', 0),
(4, 1, 4, 2, '2024-04-20', '2024-04-20', 450),
(5, 1, 3, 2, '2024-04-19', '2024-04-23', 450),
(6, 1, 3, 2, '2024-04-12', '2027-10-22', 855),
(7, 1, 4, 1, '2024-05-01', '2028-12-01', 1500),
(8, 2, 1, 1, '2024-04-17', '2040-12-01', 1500),
(9, 1, 1, 2, '2024-04-19', '2024-04-23', 450),
(19, 2, 3, 1, '2024-04-16', '2035-10-20', 1300),
(20, 2, 4, 1, '2024-04-16', '2035-10-20', 555),
(21, 1, 1, 2, '2024-04-19', '2024-04-23', 5000);

-- --------------------------------------------------------

--
-- Struktura tabulky `produkty`
--

CREATE TABLE `produkty` (
  `id_produktu` int(100) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `popis` varchar(255) NOT NULL,
  `obrazek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `produkty`
--

INSERT INTO `produkty` (`id_produktu`, `nazev`, `popis`, `obrazek`) VALUES
(1, 'Zdravotní pojištění', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'doctor'),
(3, 'Pojištění nemovitosti', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'home'),
(4, 'Pojištění mazlíčků', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'dog');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id_uzivatele` int(100) NOT NULL,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heslo` varchar(200) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id_uzivatele`, `jmeno`, `prijmeni`, `email`, `heslo`, `admin`) VALUES
(1, 'Michal', 'Vincourek', 'michalvincourek@gmail.com', '$2y$10$tOQw5Xno44qyYgCaUfIsUOun7cTlrCGxfAyYcdpj8NpLM4K5kxXRC', 1),
(2, 'Není', 'Admin', 'uzivatel@uzivatel.cz', '$2y$10$jF80AC3pgYT2yNmKBK/PseJYpcRkeD5Xa9Z0dyk6mzh8TpZwkEOz2', 0);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `pojistenci`
--
ALTER TABLE `pojistenci`
  ADD PRIMARY KEY (`id_zakaznika`);

--
-- Indexy pro tabulku `pojisteni`
--
ALTER TABLE `pojisteni`
  ADD PRIMARY KEY (`id_pojisteni`);

--
-- Indexy pro tabulku `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produktu`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id_uzivatele`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `pojistenci`
--
ALTER TABLE `pojistenci`
  MODIFY `id_zakaznika` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `pojisteni`
--
ALTER TABLE `pojisteni`
  MODIFY `id_pojisteni` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produktu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id_uzivatele` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
