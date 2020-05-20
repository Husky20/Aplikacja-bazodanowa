-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sty 2019, 16:01
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mysql`
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
(2, 'Zenon', 'Martynikuk', '90121512234', 'QWE123', '2019-01-01', '2019-01-31', 'Zenon', 'Zenon1', '789654412', 0),
(3, 'Jan', 'Malinowski', '89123012345', 'QWE123', '2018-10-01', NULL, 'JanMal', 'REWQ456', '654123789', 1),
(4, 'Stefan', 'Nowakowski', '78112512345', 'EWT789', '2018-11-03', NULL, 'StafanN', 'TRE123', '654789321', 0),
(5, 'Marian', 'Karbowski', '98010198745', 'EWQ789', '2018-11-01', '2018-12-31', 'MarianK', 'TEER123', '456321852', 0),
(6, 'Tomasz', 'Problem', '94030400111', 'ARW641', '2018-12-11', NULL, 'TomaszP', 'Start124', '584646125', 0),
(8, 'Jan', 'Trol', '93020104789', 'ZAK321', '2018-09-17', NULL, 'JanT', 'Start125', '666487124', 0),
(10, 'Konrad', 'Mackiewicz', '80040532154', 'OPL642', '2018-09-20', NULL, 'KonradM', 'Start126', '654875214', 0),
(11, 'Joanna', 'Milik', '95010615462', 'MZA642', '2017-08-08', NULL, 'JoannaM', 'Start127', '784521545', 0),
(12, 'Konrad', 'Mackiewicz', '80040532154', 'OPL642', '2018-09-20', NULL, 'KonradM', 'Start126', '654875214', 0),
(13, 'Joanna', 'Milik', '95010615462', 'MZA642', '2017-08-08', NULL, 'JoannaM', 'Start127', '784521545', 0),
(14, 'Żaneta', 'Macierewicz', '78060532555', 'LKA365', '2016-08-10', NULL, 'ZanetaM', 'Start128', '648547451', 0),
(15, 'Marcel', 'Mikry', '79080955487', 'OPL458', '2018-08-15', NULL, 'MarcelM', 'Start129', '789548125', 0),
(16, 'Żaneta', 'Macierewicz', '78060532555', 'LKA365', '2016-08-10', NULL, 'ZanetaM', 'Start128', '648547451', 0),
(17, 'Marcel', 'Mikry', '79080955487', 'OPL458', '2018-08-15', NULL, 'MarcelM', 'Start129', '789548125', 0),
(18, 'Konrad', 'Król', '86060412569', 'PPO645', '2017-01-09', NULL, 'KonradK', 'Start130', '687458125', 1),
(19, 'Marcelina', 'Wach', '86070322485', 'KLO481', '2018-08-07', NULL, 'MarcelinaW', 'Start131', '845124598', 0),
(20, 'Jadwiga', 'Norka', '89060821546', 'LLA584', '2017-12-19', NULL, 'JadwigaN', 'Start132', '695482154', 0),
(21, 'Piotr', 'Lewandowski', '69120533265', 'YUP485', '2017-07-04', NULL, 'PiotrL', 'Start133', '654875125', 0),
(22, 'Aleksandra', 'Milka', '91060487125', 'LOP125', '2015-11-11', NULL, 'AleksandraM', 'Start134', '785412514', 0),
(23, 'Sandra', 'Wenus', '84030512456', 'TIP154', '2018-05-07', NULL, 'SandraW', 'Start135', '759642154', 0),
(24, 'Galina', 'Witczak', '69120612365', 'PPQ487', '2018-01-18', NULL, 'GalinaW', 'Start136', '584215647', 0),
(25, 'Anna', 'Cyk', '90051232584', 'PWQ587', '2017-11-15', NULL, 'AnnaC', 'Start137', '896512415', 0),
(26, 'Joanna', 'Trawa', '89061025145', 'LLQ125', '2017-02-01', '2018-05-10', 'JoannaT', 'Start136', '625154241', 0),
(27, 'Iwona', 'Skręta', '94080625364', 'ZAK547', '2018-01-01', NULL, 'IwonaS', 'Start138', '666251458', 1);

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
(3, 1, 'Strona firmy', '2018-12-20', NULL, '2019-01-31', 'www.youtube.com'),
(4, 13, 'Zarządzanie domenami i ich migracja', '2017-09-01', '2018-06-01', '2018-05-01', NULL),
(5, 12, 'Wirtualizacja środowisk', '2016-03-01', NULL, '2019-06-03', NULL),
(6, 18, 'Wdrożenia rozwiązań komunikacyjnych oparte na technologii SharePoint', '2017-03-01', NULL, '2020-01-01', NULL),
(7, 8, 'System kopii zapasowych plików SBBS', '2015-06-01', '2017-05-01', '2017-04-01', NULL),
(8, 17, 'Implementacja rozwiązań VPN', '2016-04-01', NULL, '2020-06-01', NULL),
(9, 6, 'Opracowanie i realizacja rozwiązań klastrowych', '2016-09-01', NULL, '2019-08-01', NULL),
(10, 19, 'Rozwiązania telefoniczne dla wielu lokalizacji', '2018-12-03', NULL, '2020-01-01', NULL);

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
(3, 4, 'kopiowanie wszystkich baz danych', 'kopiowanie wszystkich plików na serwer docelowy za pośrednictwem protokołu FTP i aplikacji Midnight Commander', 'rozpoczęte', '2018-08-01', '2019-01-01', 120),
(4, 5, 'Wirtualizacja – inwentaryzacja', 'automatyczna inwentaryzacja serwerów wirtualizacji', 'rozpoczęte', '2018-05-01', '2019-12-02', 68),
(5, 6, 'Development SharePoint', 'Wdrożenie oraz rozwijanie aplikacji i systemu zaprojektowanego w technologii SharePoint.', 'rozpoczęty', '2017-08-01', '2019-12-02', 360),
(6, 7, 'System kopii zapasowych plików SBBS', 'Tworzenie kopii zapasowej całego systemu, włączając aplikacje, pliki konfiguracji i pliki samego systemu operacyjnego', 'rozpoczęty', '2018-07-02', '2019-05-01', 78),
(7, 8, 'implementacja sieci VPN (OpenVPN)', 'uwierzytelnienie, autoryzacja, szyfrowanie', 'rozpoczęty', '2018-02-01', '2019-04-02', 92),
(8, 9, 'Zintegrowana oferta Proinnowacyjnego Klastra Biznesu', 'Kompleksowe wsparcie w zarządzaniu projektami', 'rozpoczęty', '2018-05-01', '2019-11-01', 88),
(9, 10, 'System telefoniczny VoIP innovaphone PBX', 'System telefoniczny VoIP innovaphone PBX - modularna budowa', 'rozpoczety', '2018-09-03', '2019-08-01', 67);

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
(1, 1, 1, 'Programista baz danych'),
(2, 3, 5, 'Tester'),
(3, 11, 6, 'Tester'),
(4, 10, 5, 'Specjalista ds. Oprogramowania'),
(5, 17, 6, 'Specjalista ds. Oprogramowania'),
(6, 21, 4, 'Programista CNC'),
(7, 8, 7, 'Architekt Systemu'),
(8, 17, 5, 'Inżynier DevOps'),
(9, 15, 9, 'Informatyk'),
(10, 10, 6, 'Tester'),
(11, 8, 9, 'Tester'),
(12, 13, 2, 'Programista MySQL'),
(13, 16, 3, 'Informatyk'),
(14, 20, 4, 'Specjalista ds. Oprogramowania'),
(15, 12, 8, 'Specjalista ds. Oprogramowania');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `zadania_pracownika`
--
ALTER TABLE `zadania_pracownika`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
