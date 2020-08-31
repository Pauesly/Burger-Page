-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31/08/2020 às 01:27
-- Versão do servidor: 10.4.13-MariaDB
-- Versão do PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u620166704_jazz_grill_100`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Customer`
--

CREATE TABLE `Customer` (
  `id_customer` int(11) NOT NULL,
  `phone_number_1` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number_2` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `Customer`
--

INSERT INTO `Customer` (`id_customer`, `phone_number_1`, `phone_number_2`, `name`, `obs`, `picture`, `cpf`, `active`, `created_at`) VALUES
(1, '33333333333', '279985512', 'Paulo Franco', 'Sem OBSes', '0', NULL, 1, '0000-00-00 00:00:00'),
(2, '22222222222', '44444444444', 'Paulo', 'sem OBSes', '0', NULL, 1, '0000-00-00 00:00:00'),
(3, '(54) 4 4444-4444', '(45) 5 5555-5555', 'rerwd', '', NULL, '', 1, '2000-01-27 00:00:00'),
(4, '(53) 4 3444-4444', '(23) 3 3333-3333', 'pw', '', NULL, '', 1, '2000-01-27 00:00:00'),
(5, '(65) 4 4444-4444', '(56) 6 6666-6666', 'pw', '', NULL, '', 1, '2000-01-27 00:00:00'),
(6, '(27) 9 9855-12', '(27) 3534-4135', 'Paulo Franco', 'Obs', NULL, '055.130.617-32', 1, '2020-08-30 23:08:39'),
(7, '27998551', '(27) 3036-3608', 'Paulo Frabalho', 'CPF errado', NULL, '055.130.617-66', 1, '2020-08-30 23:13:12'),
(8, '27998551278', '2730633608', 'Paulo Franco', 'Obs do teste final', NULL, '055.130.617-32', 0, '2020-08-31 01:02:58');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
