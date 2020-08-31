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
-- Estrutura para tabela `Address`
--

CREATE TABLE `Address` (
  `id_address` int(11) NOT NULL,
  `fk_id_customer` int(11) NOT NULL,
  `local` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_complemento` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `Address`
--

INSERT INTO `Address` (`id_address`, `fk_id_customer`, `local`, `cep`, `rua`, `numero_complemento`, `bairro`, `cidade`, `estado`, `referencia`, `latitude`, `longitude`, `obs`, `active`) VALUES
(2, 4, '', '29122130', 'Rua Guarany', 'wefdzc', 'Glória', 'Vila Velha', 'ES', '', NULL, NULL, '', 1),
(3, 5, 'ddd', '29122130', 'Rua Guarany', 'dsd', 'Glória', 'Vila Velha', 'ES', '', NULL, NULL, '', 1),
(4, 6, 'Casinha', '29122130', 'Rua Guarany', '313', 'Glória', 'Vila Velha', 'ES', 'Perto Mug', NULL, NULL, 'Na rua subindo', 1),
(5, 6, 'Trabalho', '29101410', 'Avenida Champagnat', '620 Lj1', 'Praia da Costa', 'Vila Velha', 'ES', 'Em frente mc doandls', NULL, NULL, 'Shopping cernter cila behjlghaslha', 0),
(6, 7, '', '29122130', 'Rua Guarany', '', 'Glória', 'Vila Velha', 'ES', '', NULL, NULL, '', 1),
(7, 8, 'Troquei pra Trabalho', '29101410', 'Avenida Champagnat', '620lj1', 'Praia da Costa', 'Vila Velha', 'ES', 'Mc Donalds', NULL, NULL, 'So hrario comercial', 1),
(8, 8, 'Casa agora', '29122130', 'Rua Guarany', '313', 'Glória', 'Vila Velha', 'ES', 'MUG', NULL, NULL, 'Noite', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `fk_Address_Customer` (`fk_id_customer`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `Address`
--
ALTER TABLE `Address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `Address`
--
ALTER TABLE `Address`
  ADD CONSTRAINT `fk_Address_Customer` FOREIGN KEY (`fk_id_customer`) REFERENCES `Customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
