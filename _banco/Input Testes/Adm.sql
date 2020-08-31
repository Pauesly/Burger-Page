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
-- Estrutura para tabela `Adm`
--

CREATE TABLE `Adm` (
  `id_adm` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_login_web` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `Adm`
--

INSERT INTO `Adm` (`id_adm`, `email`, `password`, `name`, `picture`, `obs`, `token_login_web`, `active`) VALUES
(1, 'paulowesley@gmail.com', '$2a$08$MTY3OTMwODM4NjVmNDVhYebX.J3n6lYQ.4DNo6xz5FFNOcF45Hh7y', 'Paulo Franco', '0', NULL, 'cookie_jazzgrill126/08/202021:40:52', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `Adm`
--
ALTER TABLE `Adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `Adm`
--
ALTER TABLE `Adm`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
