-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Gru 2018, 21:47
-- Wersja serwera: 10.1.36-MariaDB
-- Wersja PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `firma`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` char(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` char(255) COLLATE utf8_polish_ci NOT NULL,
  `PESEL` char(11) COLLATE utf8_polish_ci NOT NULL,
  `nr_dowodu` char(9) COLLATE utf8_polish_ci NOT NULL,
  `dataZatrudnienia` date NOT NULL,
  `dataZwolnienia` date DEFAULT NULL,
  `login` char(255) COLLATE utf8_polish_ci NOT NULL,
  `haslo` char(255) COLLATE utf8_polish_ci NOT NULL,
  `telefon` char(12) COLLATE utf8_polish_ci NOT NULL,
  `uprawnienia` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id`, `imie`, `nazwisko`, `PESEL`, `nr_dowodu`, `dataZatrudnienia`, `dataZwolnienia`, `login`, `haslo`, `telefon`, `uprawnienia`) VALUES
(1, 'Anna', 'Nowak', '95040212345', 'AWR45', '2018-11-01', NULL, 'AnnaN', 'Start123', '789456123', 2),
(2, 'Zenon', 'Kowalski', '90121512345', 'ABC456', '2018-11-19', NULL, 'ZenonK', 'Start321', '123456789', 1),
(3, 'Jan', 'Malinowski', '89123012345', 'QWE123', '2018-10-01', NULL, 'JanMal', 'REWQ456', '654123789', 1),
(4, 'Stefan', 'Nowakowski', '78112512345', 'EWT789', '2018-11-03', NULL, 'StafanN', 'TRE123', '654789321', 0),
(5, 'Marian', 'Karbowski', '98010198745', 'EWQ789', '2018-11-01', '2018-12-31', 'MarianK', 'TEER123', '456321852', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKierownika` int(10) UNSIGNED NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `dataRozpoczecia` date NOT NULL,
  `dataZakonczenia` date DEFAULT NULL,
  `PdataZakonczenia` date NOT NULL,
  `adres` char(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `projekty`
--

INSERT INTO `projekty` (`id`, `idKierownika`, `nazwa`, `dataRozpoczecia`, `dataZakonczenia`, `PdataZakonczenia`, `adres`) VALUES
(1, 3, 'Aplkacja Bazodanowa', '2018-10-01', NULL, '2018-12-15', 'www.youtube.com'),
(2, 2, 'Aplkacja mobilna', '2018-10-01', NULL, '2019-01-01', 'www.youtube.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(10) UNSIGNED NOT NULL,
  `idProjektu` int(10) UNSIGNED NOT NULL,
  `nazwaZadania` char(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci,
  `status` char(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `dataR` date NOT NULL,
  `dataZ` date DEFAULT NULL,
  `czasTrwania` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id`, `idProjektu`, `nazwaZadania`, `opis`, `status`, `dataR`, `dataZ`, `czasTrwania`) VALUES
(1, 1, 'projekt graficzny', 'zamodelowanie grafiki strony internetowej', 'rozpoczete', '2018-11-01', '2018-11-30', 78),
(2, 1, 'oskryptowanie bazy danych', 'zaprojektowanie systemu polaczen z baza danych php', 'rozpoczete', '2018-11-01', '2018-11-30', 78),
(3, 2, 'przygotowanie kontentu', NULL, 'rozpoczete', '2018-11-01', NULL, 78),
(4, 2, 'badanie technologii', NULL, 'zakonczone', '2018-11-01', '2018-11-19', 48);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania_pracownika`
--

CREATE TABLE `zadania_pracownika` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPracownika` int(10) UNSIGNED NOT NULL,
  `idZadania` int(10) UNSIGNED NOT NULL,
  `rolaPracownika` char(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zadania_pracownika`
--

INSERT INTO `zadania_pracownika` (`id`, `idPracownika`, `idZadania`, `rolaPracownika`) VALUES
(1, 1, 1, 'programista'),
(2, 2, 1, 'glowny grafiki'),
(3, 3, 2, 'programista'),
(4, 4, 3, 'grafik'),
(5, 5, 4, 'programista'),
(6, 2, 4, 'kierownik');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKierownika` (`idKierownika`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProjektu` (`idProjektu`);

--
-- Indeksy dla tabeli `zadania_pracownika`
--
ALTER TABLE `zadania_pracownika`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPracownika` (`idPracownika`),
  ADD KEY `idZadania` (`idZadania`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zadania_pracownika`
--
ALTER TABLE `zadania_pracownika`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD CONSTRAINT `projekty_ibfk_1` FOREIGN KEY (`idKierownika`) REFERENCES `pracownicy` (`id`);

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`idProjektu`) REFERENCES `projekty` (`id`);

--
-- Ograniczenia dla tabeli `zadania_pracownika`
--
ALTER TABLE `zadania_pracownika`
  ADD CONSTRAINT `zadania_pracownika_ibfk_1` FOREIGN KEY (`idPracownika`) REFERENCES `pracownicy` (`id`),
  ADD CONSTRAINT `zadania_pracownika_ibfk_2` FOREIGN KEY (`idZadania`) REFERENCES `zadania` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
