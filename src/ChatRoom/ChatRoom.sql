-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Creato il: Feb 14, 2026 alle 11:46
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
-- Database: `ChatRoom`
--
CREATE DATABASE IF NOT EXISTS `ChatRoom` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ChatRoom`;

-- --------------------------------------------------------

--
-- Struttura della tabella `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creator` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `name`, `creator`, `created_at`) VALUES
(1, 'gioco', 'aria', '2026-02-02 07:36:09'),
(3, 'casa', 'aria', '2026-02-02 07:58:39');

-- --------------------------------------------------------

--
-- Struttura della tabella `chatroom_users`
--

CREATE TABLE `chatroom_users` (
  `chatroom_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `ID` int(100) NOT NULL,
  `testo` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `username` varchar(100) NOT NULL,
  `id_chatroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`ID`, `testo`, `data`, `username`, `id_chatroom`) VALUES
(20, 'ciao a tutti!', '2026-02-04 12:51:18', 'fiore ', 1),
(21, 'ciao!', '2026-02-04 12:51:37', 'aria', 1),
(22, 'ciao!', '2026-02-11 13:41:23', 'aria', 1),
(23, 'ciao!', '2026-02-11 14:43:36', 'aria', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'aria', '$2y$12$aFUYWqwuhjSYTaoTEllLh.Cr6O.Umup4noGXpTtR5cZ5JI0ZGjo.2', '2026-01-29 15:17:17'),
(2, 'l', '$2y$12$RZatHh.3a559BP/LoIdBY.tMyenHj76F9H75zTo249eMFrZJ9k3u2', '2026-02-02 08:58:20'),
(3, 'fiore', '$2y$12$KlMmP0tzN0C1O5E3rsy9duZJClgb0C5Qup0AqrD/C/uzsVKSmnxJu', '2026-02-02 09:14:57'),
(4, 'pippo', '$2y$12$.N0nndVzKEtKCvqaqtKbPOOeFGHwa21wgsD8LsVgH.EiLGZIoQAoe', '2026-02-02 16:38:00'),
(5, 'jakia', '$2y$12$ybLovCpzS1PYJYg2mDEdY.ukA8H2dvYkiMZv8EF/c8zzuLwtbM7p.', '2026-02-04 12:41:39');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `chatroom_users`
--
ALTER TABLE `chatroom_users`
  ADD PRIMARY KEY (`chatroom_id`,`username`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `chatroom_users`
--
ALTER TABLE `chatroom_users`
  ADD CONSTRAINT `chatroom_users_ibfk_1` FOREIGN KEY (`chatroom_id`) REFERENCES `chatrooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
