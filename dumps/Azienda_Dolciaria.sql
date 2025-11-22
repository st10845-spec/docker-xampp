-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Creato il: Nov 22, 2025 alle 11:29
-- Versione del server: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Versione PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Azienda Dolciaria`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Dipendenti`
--

CREATE TABLE `Dipendenti` (
  `Matricola` int(11) NOT NULL,
  `CF` char(16) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Dipendenti`
--

INSERT INTO `Dipendenti` (`Matricola`, `CF`, `Nome`, `Cognome`, `Indirizzo`) VALUES
(201, 'BNCMRA80A01F205K', 'Marco', 'Bianchi', 'Via Roma 10, Torino'),
(202, 'RSSMNL82B12F205X', 'Manuela', 'Rossi', 'Via Milano 15, Milano'),
(203, 'VRDGPP79C10H501N', 'Giuseppe', 'Verdi', 'Via Napoli 8, Bologna'),
(204, 'LMBLRA91D22F839L', 'Laura', 'Lombardi', 'Corso Italia 50, Firenze'),
(205, 'CNTFNC83E03M272G', 'Francesca', 'Conti', 'Via Dante 12, Napoli'),
(206, 'MLNSRA90F16G702B', 'Sara', 'Milani', 'Via Roma 55, Roma'),
(207, 'RCCCRL85G10A662H', 'Carlo', 'Ricci', 'Via Torino 3, Verona'),
(208, 'BRSLGI88H01F839P', 'Luigi', 'Barbieri', 'Via Venezia 14, Bari'),
(209, 'GRSMRA92I02H501L', 'Maria', 'Grossi', 'Via Po 20, Genova'),
(210, 'MNTGLL80L12D969F', 'Giulia', 'Monti', 'Via Emilia 33, Palermo');

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzini`
--

CREATE TABLE `Magazzini` (
  `Codice` int(11) NOT NULL,
  `Capienza` int(11) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Magazzini`
--

INSERT INTO `Magazzini` (`Codice`, `Capienza`, `Indirizzo`) VALUES
(1, 1500, 'Via Cacao 10, Torino'),
(2, 1200, 'Via Zucchero 5, Milano'),
(3, 1000, 'Corso Pasticceria 8, Bologna'),
(4, 1300, 'Via Vaniglia 20, Firenze'),
(5, 1100, 'Via Miele 15, Napoli'),
(6, 900, 'Via Burro 33, Roma'),
(7, 800, 'Via Cialda 50, Verona'),
(8, 1400, 'Via Biscotto 12, Bari'),
(9, 1000, 'Via Cioccolato 44, Genova'),
(10, 700, 'Via Cannella 18, Palermo');

-- --------------------------------------------------------

--
-- Struttura della tabella `MateriePrime`
--

CREATE TABLE `MateriePrime` (
  `Tipologia` varchar(50) NOT NULL,
  `CostoUnitario` decimal(10,2) NOT NULL,
  `PesoUnitario` decimal(10,2) NOT NULL,
  `Codice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `MateriePrime`
--

INSERT INTO `MateriePrime` (`Tipologia`, `CostoUnitario`, `PesoUnitario`, `Codice`) VALUES
('Burro', 1.80, 1.00, 4),
('Cacao', 2.50, 0.50, 3),
('Farina', 0.80, 1.00, 2),
('Latte in polvere', 2.00, 0.80, 5),
('Mandorle', 3.20, 0.70, 9),
('Miele', 4.00, 0.50, 7),
('Nocciole', 3.50, 0.60, 6),
('Uova', 0.90, 0.50, 10),
('Vaniglia', 5.00, 0.20, 8),
('Zucchero', 1.20, 1.00, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotti`
--

CREATE TABLE `Prodotti` (
  `Id` int(11) NOT NULL,
  `Codice` int(11) DEFAULT NULL,
  `Matricola` int(11) DEFAULT NULL,
  `Descrizione` varchar(255) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Prodotti`
--

INSERT INTO `Prodotti` (`Id`, `Codice`, `Matricola`, `Descrizione`, `Nome`) VALUES
(1, 1, 201, 'Tavoletta di cioccolato al latte con nocciole', 'Cioccolato al Latte'),
(2, 2, 202, 'Biscotti frollini con burro e vaniglia', 'Frollini Classici'),
(3, 3, 203, 'Torta al cacao con glassa di cioccolato', 'Torta al Cacao'),
(4, 4, 204, 'Caramelle dure al miele e limone', 'Caramelle MieleLimone'),
(5, 5, 205, 'Praline di cioccolato fondente ripiene di crema', 'Praline Fondenti'),
(6, 6, 206, 'Merendina al cioccolato con crema al latte', 'Dolcetto Latte'),
(7, 7, 207, 'Cornetto sfogliato con crema alla vaniglia', 'Cornetto Vaniglia'),
(8, 8, 208, 'Biscotti integrali con miele e avena', 'Biscotti Avena'),
(9, 9, 209, 'Cioccolatino fondente al 70%', 'Cioccolatino Fondente'),
(10, 10, 210, 'Torrone alle mandorle e miele', 'Torrone Classico');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ricette`
--

CREATE TABLE `Ricette` (
  `Tipologia` varchar(50) NOT NULL,
  `Id` int(11) NOT NULL,
  `Qtà` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Ricette`
--

INSERT INTO `Ricette` (`Tipologia`, `Id`, `Qtà`) VALUES
('Burro', 2, 0.80),
('Burro', 3, 0.50),
('Burro', 5, 0.60),
('Burro', 7, 0.60),
('Burro', 9, 0.40),
('Cacao', 1, 1.50),
('Cacao', 3, 1.00),
('Cacao', 5, 1.50),
('Cacao', 6, 0.80),
('Cacao', 9, 1.00),
('Farina', 2, 1.50),
('Farina', 3, 1.20),
('Farina', 6, 0.70),
('Farina', 7, 1.20),
('Farina', 8, 1.00),
('Latte in polvere', 1, 0.80),
('Latte in polvere', 6, 0.50),
('Mandorle', 10, 0.80),
('Miele', 4, 0.70),
('Miele', 8, 0.40),
('Miele', 10, 0.60),
('Nocciole', 1, 0.60),
('Nocciole', 5, 0.50),
('Uova', 3, 0.60),
('Vaniglia', 2, 0.10),
('Vaniglia', 4, 0.05),
('Vaniglia', 7, 0.10),
('Zucchero', 1, 1.00),
('Zucchero', 2, 0.50),
('Zucchero', 4, 0.30),
('Zucchero', 5, 0.70),
('Zucchero', 8, 0.30),
('Zucchero', 9, 0.60),
('Zucchero', 10, 0.40);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Dipendenti`
--
ALTER TABLE `Dipendenti`
  ADD PRIMARY KEY (`Matricola`),
  ADD UNIQUE KEY `CF` (`CF`);

--
-- Indici per le tabelle `Magazzini`
--
ALTER TABLE `Magazzini`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD PRIMARY KEY (`Tipologia`),
  ADD KEY `Codice` (`Codice`);

--
-- Indici per le tabelle `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Codice` (`Codice`),
  ADD KEY `Matricola` (`Matricola`);

--
-- Indici per le tabelle `Ricette`
--
ALTER TABLE `Ricette`
  ADD PRIMARY KEY (`Tipologia`,`Id`),
  ADD KEY `Id` (`Id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD CONSTRAINT `MateriePrime_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD CONSTRAINT `Prodotti_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Prodotti_ibfk_2` FOREIGN KEY (`Matricola`) REFERENCES `Dipendenti` (`Matricola`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Ricette`
--
ALTER TABLE `Ricette`
  ADD CONSTRAINT `Ricette_ibfk_1` FOREIGN KEY (`Tipologia`) REFERENCES `MateriePrime` (`Tipologia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ricette_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `Prodotti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
