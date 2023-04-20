-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2023 at 05:32 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorijaID` int(11) NOT NULL,
  `nazivKategorije` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorijaID`, `nazivKategorije`) VALUES
(1, 'Poslovni'),
(2, 'Lični'),
(3, 'Ostali');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `ime`, `prezime`, `email`, `lozinka`) VALUES
(12, 'Mihailo', 'Mitrović', 'mikammikam.m@gmail.com', '$2y$10$VbaZwzOo4GYZJDRLqsLnbuWexRHcNN52185VLhU.od7P5U5BcncVm'),
(15, 'Test', 'Test', 'test@gmail.com', '$2y$10$vGnwdDqcqLfqCAgH7TDe/OivixAf4ZGiTXQdGGs3ISfvdJxqORi8G');

-- --------------------------------------------------------

--
-- Table structure for table `zadatak`
--

CREATE TABLE `zadatak` (
  `zadatakID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `kategorija` int(11) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `datumKreiranja` date NOT NULL,
  `izvrsen` int(11) NOT NULL DEFAULT 0,
  `datumZavrsetka` date DEFAULT NULL,
  `slika` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zadatak`
--

INSERT INTO `zadatak` (`zadatakID`, `naziv`, `korisnik`, `kategorija`, `opis`, `datumKreiranja`, `izvrsen`, `datumZavrsetka`, `slika`) VALUES
(11, 'Očisti stan', 12, 2, 'Neki tekst', '2023-04-16', 0, NULL, ''),
(12, 'Odgovori na mejl', 12, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean neque lectus, malesuada sit amet tincidunt eu, sodales ac urna. Maecenas dictum laoreet eros vel hendrerit. Ut est mi, tempus at magna non, euismod luctus risus.', '2023-04-17', 1, '2023-04-20', ''),
(17, 'Sredi policu', 12, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In scelerisque ultricies leo, nec pharetra purus lobortis sit amet.', '2023-04-17', 1, '2023-04-20', ''),
(18, 'Organizuj put', 12, 2, 'Neki tekst', '2023-04-17', 1, '2023-04-19', ''),
(19, 'Predaj dokumenta', 12, 3, 'Uradi ovo', '2023-04-17', 1, '2023-04-20', ''),
(20, 'Spremi večeru', 12, 2, 'Neki tekst', '2023-04-17', 1, '2023-04-20', ''),
(33, 'Ubaci sliku', 12, 2, 'Proba', '2023-04-20', 0, NULL, 'how-to-make-a-website-featured-01.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorijaID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`);

--
-- Indexes for table `zadatak`
--
ALTER TABLE `zadatak`
  ADD PRIMARY KEY (`zadatakID`),
  ADD KEY `korisnik` (`korisnik`),
  ADD KEY `kategorija` (`kategorija`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorijaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zadatak`
--
ALTER TABLE `zadatak`
  MODIFY `zadatakID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zadatak`
--
ALTER TABLE `zadatak`
  ADD CONSTRAINT `zadatak_ibfk_1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`korisnikID`),
  ADD CONSTRAINT `zadatak_ibfk_2` FOREIGN KEY (`kategorija`) REFERENCES `kategorija` (`kategorijaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
