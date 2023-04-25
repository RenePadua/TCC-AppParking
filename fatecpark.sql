-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Abr-2023 às 06:02
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fatecpark`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `cd_Veiculo` int(11) NOT NULL,
  `cd_Placa` varchar(8) DEFAULT NULL,
  `nm_Marca` varchar(12) DEFAULT NULL,
  `nm_Modelo` varchar(12) DEFAULT NULL,
  `nm_Cor` varchar(12) CHARACTER SET utf32 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `cd_Marca` int(11) DEFAULT NULL,
  `nm_Marca` varchar(14) CHARACTER SET utf32 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`cd_Marca`, `nm_Marca`) VALUES
(1, 'ALFA ROMEO'),
(2, 'AUDI'),
(3, 'BENTLEY'),
(4, 'BMW'),
(5, 'BUGGY'),
(6, 'CADILLAC'),
(7, 'CHERY'),
(8, 'CHEVROLET'),
(9, 'CHRYSLER'),
(10, 'CITROEN'),
(11, 'CROSS LANDER'),
(12, 'DAEWOO'),
(13, 'DAIHATSU'),
(14, 'DODGE'),
(15, 'FERRARI'),
(16, 'FIAT'),
(17, 'FORD'),
(18, 'GURGEL'),
(19, 'HONDA'),
(20, 'HYUNDAI'),
(21, 'INFINITI'),
(22, 'JAC'),
(23, 'JEEP'),
(24, 'KIA'),
(25, 'LADA'),
(26, 'LAND ROVER'),
(27, 'LEXUS'),
(28, 'LIFAN'),
(29, 'MAZDA'),
(30, 'MERCEDES-BENZ'),
(31, 'MINI'),
(32, 'MITSUBISHI'),
(33, 'MIURA'),
(34, 'NISSAN'),
(35, 'PEUGEOT'),
(36, 'PONTIAC'),
(37, 'PORSCHE'),
(38, 'PUMA'),
(39, 'RENAULT'),
(40, 'ROLLS-ROYCE'),
(41, 'SEAT'),
(42, 'SMART'),
(43, 'SSANGYONG'),
(44, 'SUBARU'),
(45, 'SUZUKI'),
(46, 'TOYOTA'),
(47, 'TROLLER'),
(48, 'VOLKSWAGEN'),
(49, 'VOLVO');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`cd_Veiculo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `cd_Veiculo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
