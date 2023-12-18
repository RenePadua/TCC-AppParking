-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 15/12/2023 às 15:43
-- Versão do servidor: 10.5.20-MariaDB
-- Versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id21353622_tccappparking2023`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs_movimentacao`
--

CREATE TABLE `logs_movimentacao` (
  `id` int(11) NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_email` varchar(255) DEFAULT NULL,
  `acao_realizada` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs_movimentacao`
--

INSERT INTO `logs_movimentacao` (`id`, `data_hora`, `usuario_email`, `acao_realizada`) VALUES
(1, '2023-07-24 22:41:33', '', 'Criou uma nova marca: ALI BABA'),
(2, '2023-07-24 22:44:57', '', 'Criou uma nova marca: ALI BABA'),
(3, '2023-07-24 22:51:31', '', 'Criou uma nova marca: ALI BABA'),
(4, '2023-07-24 22:54:48', '', 'Criou uma nova marca: ALI BABA'),
(5, '2023-07-24 22:58:22', 'rene.padua@gmail.com', 'Criou uma nova marca: ALI BABA'),
(6, '2023-07-24 23:15:44', 'rene.padua@gmail.com', 'Criou uma nova marca: ALI BABA'),
(7, '2023-07-24 23:16:41', 'thata.bsilva@hotmail.com', 'Criou uma nova marca: ALI BABA'),
(8, '2023-07-24 23:16:58', 'kita@hotmail.com', 'Excluiu a marca: ALI BABA'),
(9, '2023-07-25 03:09:50', 'rene.padua@gmail.com', 'Alterou o valor de 1 para: R$ 4,00'),
(10, '2023-07-25 03:10:05', 'rene.padua@gmail.com', 'Alterou o nível de permissão de kita@hotmail.com para: 4'),
(11, '2023-07-25 03:26:31', 'rene.padua@gmail.com', 'Alterou o valor de Carro para: R$ 3,50'),
(12, '2023-07-25 03:31:16', 'rene.padua@gmail.com', 'Alterou o nível de permissão de pakita@gmail.com para: Gerente'),
(13, '2023-07-25 03:32:34', 'rene.padua@gmail.com', 'Criou o usuário: xiskita@hotmail.com'),
(14, '2023-07-25 03:32:54', 'rene.padua@gmail.com', 'Excluiu o usuário xiskita@hotmail.com'),
(15, '2023-07-25 17:34:28', 'batata@gmail.com', 'Cadastrou o veículo de placa: BKX1290'),
(16, '2023-07-25 17:36:59', 'batata@gmail.com', 'Registrou a entrada do veículo de placa: '),
(17, '2023-07-25 17:37:29', 'batata@gmail.com', 'Registrou a saída do veículo de placa: BKX1290 no valor/hora de R$ 3,50'),
(18, '2023-07-25 17:37:52', 'batata@gmail.com', 'Registrou a saída do veículo de placa: RSA1357 no valor/hora de R$ 3,50'),
(19, '2023-07-25 17:38:20', 'batata@gmail.com', 'Criou uma nova marca: WEE'),
(20, '2023-07-25 17:38:32', 'batata@gmail.com', 'Excluiu a marca: SUZUKI'),
(21, '2023-07-25 17:39:03', 'batata@gmail.com', 'Criou uma nova marca: SUZUKI'),
(22, '2023-07-25 17:39:28', 'batata@gmail.com', 'Excluiu a marca: WEE'),
(23, '2023-07-25 17:40:50', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: CAM9910'),
(24, '2023-07-25 17:41:23', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: '),
(25, '2023-07-25 17:42:31', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: LEX9477 no valor/hora de R$ 1,50'),
(26, '2023-07-25 17:43:28', 'thata.bsilva@hotmail.com', 'Alterou o valor de Carro para: R$ 5,50'),
(27, '2023-07-25 17:43:37', 'thata.bsilva@hotmail.com', 'Alterou o valor de Moto para: R$ 2,50'),
(28, '2023-07-25 17:43:57', 'thata.bsilva@hotmail.com', 'Criou uma nova marca: WEEZITO'),
(29, '2023-07-25 17:44:07', 'thata.bsilva@hotmail.com', 'Excluiu a marca: WEEZITO'),
(30, '2023-07-25 17:45:07', 'thata.bsilva@hotmail.com', 'Criou o usuário: renekito@hotmail.com'),
(31, '2023-07-25 17:45:18', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de renekito@hotmail.com para: Funcionário'),
(32, '2023-07-25 17:45:35', 'thata.bsilva@hotmail.com', 'Alterou a senha do usuário renekito@hotmail.com'),
(33, '2023-07-25 17:45:44', 'thata.bsilva@hotmail.com', 'Excluiu o usuário renekito@hotmail.com'),
(34, '2023-07-25 17:49:49', 'kita@hotmail.com', 'Cadastrou o veículo de placa: HIN1590'),
(35, '2023-07-25 17:50:08', 'kita@hotmail.com', 'Registrou a entrada do veículo de placa: '),
(36, '2023-07-25 17:50:30', 'kita@hotmail.com', 'Registrou a saída do veículo de placa: CAM9910 no valor/hora de R$ 1,50'),
(37, '2023-07-25 17:50:47', 'kita@hotmail.com', 'Criou uma nova marca: WEEEKITI'),
(38, '2023-07-25 17:51:01', 'kita@hotmail.com', 'Excluiu a marca: WEEEKITI'),
(39, '2023-07-25 17:52:20', 'minini@yahoo.com.br', 'Cadastrou o veículo de placa: RGK2345'),
(40, '2023-07-25 17:52:39', 'minini@yahoo.com.br', 'Registrou a entrada do veículo de placa: '),
(41, '2023-07-25 17:53:01', 'minini@yahoo.com.br', 'Registrou a saída do veículo de placa: KIT5432 no valor/hora de R$ 4,50'),
(42, '2023-07-25 17:53:53', 'minini@yahoo.com.br', 'Alterou o valor de Carro para: R$ 3,50'),
(43, '2023-07-25 17:53:59', 'minini@yahoo.com.br', 'Alterou o valor de Moto para: R$ 1,50'),
(44, '2023-07-25 17:54:44', 'minini@yahoo.com.br', 'Criou uma nova marca: WEEETIH'),
(45, '2023-07-25 17:54:59', 'minini@yahoo.com.br', 'Excluiu a marca: WEEETIH'),
(46, '2023-07-25 17:58:15', 'minini@yahoo.com.br', 'Cadastrou o veículo de placa: KIN1234'),
(47, '2023-07-25 17:59:03', 'minini@yahoo.com.br', 'Registrou a entrada do veículo de placa: '),
(48, '2023-07-25 18:40:57', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: OPG8474 no valor/hora de R$ 3,50'),
(49, '2023-07-25 18:44:58', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: OPG8474 no valor/hora de R$ 3,50'),
(50, '2023-07-25 18:45:09', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: OPG8474'),
(51, '2023-07-25 19:23:28', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: ESC5140'),
(52, '2023-07-25 19:30:30', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: ESC5140'),
(53, '2023-07-25 19:30:47', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: ESC5140 no valor/hora de R$ 3,50'),
(54, '2023-07-25 20:05:26', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: OPG8474 no valor/hora de R$ 3,50'),
(55, '2023-07-25 20:06:31', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: ESC5140'),
(56, '2023-07-25 20:19:02', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: ESC5140 no valor/hora de R$ 3,50'),
(57, '2023-07-25 20:19:13', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: ESC5140'),
(58, '2023-07-27 19:38:04', 'rene.padua@gmail.com', 'Cadastrou o veículo de placa: DIT2153'),
(59, '2023-07-27 19:51:46', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: DIT2153'),
(60, '2023-07-27 19:52:07', 'rene.padua@gmail.com', 'Registrou a saída do veículo de placa: DIT2153 no valor/hora de R$ 3,50'),
(61, '2023-07-27 19:52:26', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: DIT2153'),
(62, '2023-07-27 19:55:04', 'rene.padua@gmail.com', 'Registrou a saída do veículo de placa: DIT2153 no valor/hora de R$ 3,50'),
(63, '2023-07-27 19:57:56', 'rene.padua@gmail.com', 'Cadastrou o veículo de placa: BRM2004'),
(64, '2023-07-27 20:03:51', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: BRM2004'),
(65, '2023-07-27 20:04:00', 'rene.padua@gmail.com', 'Registrou a saída do veículo de placa: BRM2004 no valor/hora de R$ 3,50'),
(66, '2023-07-27 20:04:12', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: BRM2004'),
(67, '2023-07-27 20:07:53', 'rene.padua@gmail.com', 'Cadastrou o veículo de placa: THA1110'),
(68, '2023-07-27 20:34:24', 'rene.padua@gmail.com', 'Alterou o nível de permissão de kita@hotmail.com para: Gerente'),
(69, '2023-07-27 20:35:24', 'rene.padua@gmail.com', 'Criou uma nova marca: ALI BABA'),
(70, '2023-07-27 20:37:51', 'rene.padua@gmail.com', 'Excluiu a marca: ALI BABA'),
(71, '2023-07-27 20:39:05', 'rene.padua@gmail.com', 'Criou uma nova marca: ALI BABA'),
(72, '2023-07-27 20:39:19', 'rene.padua@gmail.com', 'Excluiu a marca: ALI BABA'),
(73, '2023-07-28 17:12:08', 'kita@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(74, '2023-07-28 20:37:07', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 16'),
(75, '2023-07-28 21:06:50', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(76, '2023-07-28 21:07:01', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: BRM2004 no valor/hora de R$ 3,50'),
(77, '2023-07-28 21:07:40', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: ESC5140 no valor/hora de R$ 3,50'),
(78, '2023-07-28 21:07:56', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: TDA9010 no valor/hora de R$ 3,50'),
(79, '2023-07-28 21:08:07', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: CAM9910 no valor/hora de R$ 1,50'),
(80, '2023-07-28 21:08:16', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: CED1103 no valor/hora de R$ 1,50'),
(81, '2023-07-28 21:09:15', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: BRM2004'),
(82, '2023-07-31 22:45:46', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 11'),
(83, '2023-07-31 23:15:08', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 10'),
(84, '2023-07-31 23:15:36', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: HIN1590 no valor/hora de R$ 5,50'),
(85, '2023-08-01 17:02:17', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 9'),
(86, '2023-08-01 17:02:57', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 10'),
(87, '2023-08-01 17:03:15', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Moto para: 2'),
(88, '2023-08-01 17:09:36', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 15'),
(89, '2023-08-01 17:49:29', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: BRM2004 no valor/hora de R$ 3,50'),
(90, '2023-08-01 19:29:58', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 8'),
(91, '2023-08-01 20:15:07', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(92, '2023-08-01 20:15:49', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(93, '2023-08-01 20:30:06', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(94, '2023-08-01 20:30:23', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(95, '2023-08-01 20:34:34', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(96, '2023-08-01 20:38:58', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(97, '2023-08-01 20:56:55', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(98, '2023-08-01 20:57:38', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(99, '2023-08-01 20:58:26', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(100, '2023-08-01 20:58:33', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(101, '2023-08-01 20:58:52', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(102, '2023-08-01 20:59:36', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: KIT5436'),
(103, '2023-08-01 20:59:47', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: KIT5436 no valor/hora de R$ 1,50'),
(104, '2023-08-01 20:59:58', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: EEW7654'),
(105, '2023-08-01 21:00:51', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: EEW7654 no valor/hora de R$ 3,50'),
(106, '2023-08-01 21:01:05', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(107, '2023-08-01 21:01:17', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(108, '2023-08-01 21:01:45', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: THA1110 no valor/hora de R$ 3,50'),
(109, '2023-08-01 21:28:45', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: KIN1234 no valor/hora de R$ 3,50'),
(110, '2023-08-01 21:36:50', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: RGK2345 no valor/hora de R$ 5,50'),
(111, '2023-08-01 21:40:17', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: NCA1995 no valor/hora de R$ 3,50'),
(112, '2023-08-01 21:50:50', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 8'),
(113, '2023-08-02 17:49:49', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: ASA7307'),
(114, '2023-08-02 17:50:50', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: CAM9910'),
(115, '2023-08-02 17:51:12', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: KIT5432'),
(116, '2023-08-02 17:53:07', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: YUP4680'),
(117, '2023-08-02 17:58:43', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: CAM9910 no valor/hora de R$ 1,50'),
(118, '2023-08-02 19:04:33', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: MTO0987'),
(119, '2023-08-02 19:04:54', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: MTO0987'),
(120, '2023-08-02 19:08:19', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: MOT6789'),
(121, '2023-08-02 19:09:05', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Moto para: 3'),
(122, '2023-08-02 19:09:17', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: MOT6789'),
(123, '2023-08-02 19:17:02', 'kita@hotmail.com', 'Alterou o número de vagas de Carro para: 25'),
(124, '2023-08-02 19:17:06', 'kita@hotmail.com', 'Alterou o número de vagas de Moto para: 4'),
(125, '2023-08-02 19:17:10', 'kita@hotmail.com', 'Alterou o número de vagas de Moto para: 5'),
(126, '2023-08-02 19:17:19', 'kita@hotmail.com', 'Alterou o número de vagas de Carro para: 24'),
(127, '2023-08-02 19:17:25', 'kita@hotmail.com', 'Alterou o número de vagas de Carro para: 30'),
(128, '2023-08-02 19:17:33', 'kita@hotmail.com', 'Alterou o número de vagas de Moto para: 7'),
(129, '2023-08-02 19:18:41', 'rene.padua@gmail.com', 'Alterou o nível de permissão de kita@hotmail.com para: Funcionário'),
(130, '2023-08-02 19:19:05', 'rene.padua@gmail.com', 'Alterou o nível de permissão de kita@hotmail.com para: Gerente'),
(131, '2023-08-02 19:19:48', 'rene.padua@gmail.com', 'Alterou o nível de permissão de minini@yahoo.com.br para: Funcionário'),
(132, '2023-08-02 19:20:07', 'rene.padua@gmail.com', 'Alterou o nível de permissão de kita@hotmail.com para: Proprietário'),
(133, '2023-08-02 19:21:27', 'rene.padua@gmail.com', 'Alterou o número de vagas de Carro para: 8'),
(134, '2023-08-02 19:21:34', 'rene.padua@gmail.com', 'Alterou o número de vagas de Moto para: 3'),
(135, '2023-08-02 19:23:51', 'rene.padua@gmail.com', 'Alterou o nível de permissão de minini@yahoo.com.br para: Proprietário'),
(136, '2023-08-03 18:16:55', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: CAR1289'),
(137, '2023-08-03 19:22:19', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: BDC4935'),
(138, '2023-08-03 19:22:59', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: YUP4680 no valor/hora de R$ 3,50'),
(139, '2023-08-03 19:23:25', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: BDC4935'),
(140, '2023-08-03 19:23:47', 'thata.bsilva@hotmail.com', 'Alterou o valor de Carro para: R$ 10,50'),
(141, '2023-08-03 19:24:09', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: BDC4935 no valor/hora de R$ 3,50'),
(142, '2023-08-03 19:24:21', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: BDC4935'),
(143, '2023-08-07 19:06:42', 'thata.bsilva@hotmail.com', 'Alterou o valor de Carro para: R$ 4,50'),
(144, '2023-08-07 20:14:19', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de pakita@gmail.com para: Funcionário'),
(145, '2023-08-07 20:17:23', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de pakita@gmail.com para: Gerente'),
(146, '2023-08-07 20:17:52', 'thata.bsilva@hotmail.com', 'Criou o usuário: renekito@hotmail.com'),
(147, '2023-08-07 20:18:05', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de renekito@hotmail.com para: Gerente'),
(148, '2023-08-07 20:18:20', 'thata.bsilva@hotmail.com', 'Alterou a senha do usuário renekito@hotmail.com'),
(149, '2023-08-07 20:18:32', 'thata.bsilva@hotmail.com', 'Excluiu o usuário renekito@hotmail.com'),
(150, '2023-08-07 20:39:34', 'thata.bsilva@hotmail.com', 'Criou o usuário: renekito@hotmail.com com o nível de Funcionário'),
(151, '2023-08-07 20:41:22', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de renekito@hotmail.com para: Gerente'),
(152, '2023-08-09 22:01:36', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 9'),
(153, '2023-08-15 20:38:39', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: LHA1940'),
(154, '2023-08-15 21:16:16', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: LHA1940'),
(155, '2023-08-15 21:17:44', 'thata.bsilva@hotmail.com', 'Registrou a saída do veículo de placa: BDC4935 no valor/hora de R$ 10,50'),
(156, '2023-08-15 21:19:05', 'thata.bsilva@hotmail.com', 'Alterou o valor de Carro para: R$ 4,00'),
(157, '2023-08-15 21:19:21', 'thata.bsilva@hotmail.com', 'Criou uma nova marca: ALI BABA'),
(158, '2023-08-15 21:23:23', 'thata.bsilva@hotmail.com', 'Excluiu a marca: ALI BABA'),
(159, '2023-08-15 21:25:25', 'thata.bsilva@hotmail.com', 'Criou o usuário: mini@yahoo.com.br com o nível: Funcionário'),
(160, '2023-08-15 21:25:40', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de mini@yahoo.com.br para: Gerente'),
(161, '2023-08-15 21:25:54', 'thata.bsilva@hotmail.com', 'Alterou a senha do usuário mini@yahoo.com.br'),
(162, '2023-08-15 21:26:06', 'thata.bsilva@hotmail.com', 'Excluiu o usuário mini@yahoo.com.br'),
(163, '2023-08-15 21:26:42', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 10'),
(164, '2023-08-16 18:49:25', 'thata.bsilva@hotmail.com', 'Criou o usuário: mini@yahoo.com.br com o nível: Funcionário'),
(165, '2023-08-16 18:52:36', 'thata.bsilva@hotmail.com', 'Criou o usuário: mini@hotmail.com com o nível: Funcionário'),
(166, '2023-09-01 18:28:43', 'mini@yahoo.com.br', 'Criou uma nova marca: 2345'),
(167, '2023-09-01 18:28:51', 'mini@yahoo.com.br', 'Excluiu a marca: 2345'),
(168, '2023-09-02 13:03:55', 'rene.padua@gmail.com', 'Registrou a saída do veículo de placa: LHA1940 no valor/hora de R$ 4,50'),
(169, '2023-09-04 23:12:29', 'thata.bsilva@hotmail.com', 'Alterou os valores de Carro'),
(171, '2023-09-04 23:26:41', 'thata.bsilva@hotmail.com', 'Alterou os valores de Carro'),
(172, '2023-09-06 17:31:21', 'thata.bsilva@hotmail.com', 'Alterou os valores de Carro'),
(173, '2023-09-06 17:32:44', 'thata.bsilva@hotmail.com', 'Alterou os valores de Carro'),
(174, '2023-09-06 17:45:45', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_1_hora de Carro'),
(175, '2023-09-06 17:46:39', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_1_hora de Carro'),
(176, '2023-09-06 18:24:37', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_1_hora de Carro'),
(177, '2023-09-06 18:35:19', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_1_hora de Carro'),
(178, '2023-09-06 18:39:13', 'thata.bsilva@hotmail.com', 'Alterou os valores de Carro'),
(179, '2023-09-06 19:50:28', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(180, '2023-09-06 19:57:11', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(181, '2023-09-06 19:57:32', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(182, '2023-09-06 19:59:35', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(183, '2023-09-06 20:04:31', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(184, '2023-09-06 20:08:23', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(185, '2023-09-06 20:18:19', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(186, '2023-09-06 20:20:19', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(187, '2023-09-06 20:28:09', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(188, '2023-09-06 20:29:05', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(189, '2023-09-06 20:30:58', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(190, '2023-09-06 20:31:38', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(191, '2023-09-06 20:33:04', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(192, '2023-09-06 20:40:34', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(193, '2023-09-06 20:41:57', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(194, '2023-09-06 20:44:33', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(195, '2023-09-06 20:46:24', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(196, '2023-09-06 20:47:21', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(197, '2023-09-06 20:50:35', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(198, '2023-09-06 20:51:37', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(199, '2023-09-06 20:56:57', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(200, '2023-09-06 20:57:47', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(201, '2023-09-06 20:58:19', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(202, '2023-09-06 21:10:55', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(203, '2023-09-06 21:11:44', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Carro'),
(204, '2023-09-06 21:11:55', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro'),
(205, '2023-09-06 21:13:34', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_demais_horas de Moto'),
(206, '2023-09-06 21:16:56', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro para R$ 4,00'),
(207, '2023-09-06 21:27:37', 'thata.bsilva@hotmail.com', 'Alterou o valor de vl_2_horas de Carro para R$ 5,50'),
(208, '2023-09-06 21:29:32', 'thata.bsilva@hotmail.com', 'Alterou o valor de 02 Horas de Moto para R$ 3,50'),
(209, '2023-09-08 19:50:45', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: LHA1940'),
(210, '2023-09-08 21:43:53', 'thata.bsilva@hotmail.com', 'Registrou saída - Placa: VBM6754 - Valores(30 min: R$ 4,00, 1h: R$ 4,00, 2h: R$ 2,00 e demais: R$ 1,00)'),
(211, '2023-09-08 21:47:18', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: WEE9980'),
(212, '2023-09-08 21:47:43', 'thata.bsilva@hotmail.com', 'Registrou saída - Placa: WEE9980 - Valores(30 min: R$ 5,00, 1h: R$ 7,00, 2h: R$ 5,50 e demais: R$ 6,00)'),
(213, '2023-09-15 21:22:09', 'thata.bsilva@hotmail.com', 'Alterou o valor de 30 minutos de Carro para R$ 5,50'),
(214, '2023-09-15 21:23:52', 'thata.bsilva@hotmail.com', 'Alterou o valor de 30 minutos de Carro para R$ 5,00'),
(215, '2023-09-21 20:55:12', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de mini@yahoo.com.br para: Gerente'),
(216, '2023-10-06 20:43:18', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Carro para: 15'),
(217, '2023-10-16 20:33:11', 'thata.bsilva@hotmail.com', 'Criou o usuário: teste@teste.com com o nível: Funcionário'),
(218, '2023-10-16 20:51:47', 'thata.bsilva@hotmail.com', 'Criou o usuário: novo@teste.com com o nível: Funcionário'),
(219, '2023-10-16 18:06:22', 'thata.bsilva@hotmail.com', 'Excluiu o usuário novo@teste.com'),
(220, '2023-10-16 18:44:23', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Moto para: 5'),
(221, '2023-10-16 18:45:03', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: CED1103'),
(222, '2023-10-16 18:58:12', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: CAR1289'),
(223, '2023-10-16 19:04:11', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: CAR1289 - Valores(30 min: R$ 5,00, 1h: R$ 7,00, 2h: R$ 5,50 e demais: R$ 6,00)'),
(224, '2023-10-16 19:12:58', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Moto para: 4'),
(225, '2023-10-16 19:17:02', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: THA1110'),
(226, '2023-10-16 19:37:29', 'thata.bsilva@hotmail.com', 'Criou o usuário: novo@teste.com com o nível: Funcionário'),
(227, '2023-10-17 17:18:04', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: CED1103 - Valores(30 min: R$ 2,00, 1h: R$ 5,00, 2h: R$ 3,50 e demais: R$ 3,00)'),
(228, '2023-10-17 17:18:21', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: CAR1289'),
(229, '2023-10-17 17:24:21', 'thata.bsilva@hotmail.com', 'Cadastrou o veículo de placa: NAO1315'),
(230, '2023-10-17 17:25:26', 'thata.bsilva@hotmail.com', 'Registrou a entrada do veículo de placa: BLN1209'),
(231, '2023-10-17 18:55:25', 'thata.bsilva@hotmail.com', 'Alterou o valor de 30 minutos de Carro para R$ 4,00'),
(232, '2023-10-17 18:55:36', 'thata.bsilva@hotmail.com', 'Alterou o valor de 01 Hora de Carro para R$ 5,50'),
(233, '2023-10-18 16:46:49', 'thata.bsilva@hotmail.com', 'Criou uma nova marca: OCAPI'),
(234, '2023-10-18 16:47:33', 'thata.bsilva@hotmail.com', 'Excluiu a marca: OCAPI'),
(235, '2023-10-18 16:51:03', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: BLN1209 - Valores(30 min: R$ 2,00, 1h: R$ 5,00, 2h: R$ 3,50 e demais: R$ 3,00)'),
(236, '2023-10-18 16:53:38', 'thata.bsilva@hotmail.com', 'Criou o usuário: teste1@teste.com com o nível: Funcionário'),
(237, '2023-10-18 16:54:15', 'thata.bsilva@hotmail.com', 'Criou o usuário: teste2@teste.com com o nível: Gerente'),
(238, '2023-10-18 16:54:52', 'thata.bsilva@hotmail.com', 'Alterou o nível de permissão de teste2@teste.com para: Funcionário'),
(239, '2023-10-20 18:25:23', 'teste@teste.com', 'Cadastrou o veículo de placa: LDA7576'),
(240, '2023-10-20 18:25:51', 'teste@teste.com', 'Registrou a entrada do veículo de placa: LDA7576'),
(241, '2023-10-20 18:31:23', 'teste@teste.com', 'Registrou saída de placa: LDA7576 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(242, '2023-10-20 18:34:57', 'teste2@teste.com', 'Cadastrou o veículo de placa: AMI0077'),
(243, '2023-10-20 18:35:12', 'teste2@teste.com', 'Registrou a entrada do veículo de placa: AMI0077'),
(244, '2023-10-20 18:35:55', 'teste2@teste.com', 'Registrou saída de placa: AMI0077 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(245, '2023-10-20 18:38:44', 'mini@yahoo.com.br', 'Criou o usuário: funcionario1@teste.com com o nível: Funcionário'),
(246, '2023-10-20 18:39:18', 'mini@yahoo.com.br', 'Excluiu o usuário funcionario1@teste.com'),
(247, '2023-10-20 18:41:59', 'renekito@hotmail.com', 'Criou o usuário: funcionario2@teste.com com o nível: Funcionário'),
(248, '2023-10-20 18:42:21', 'renekito@hotmail.com', 'Excluiu o usuário funcionario2@teste.com'),
(249, '2023-10-20 18:44:50', 'kita@hotmail.com', 'Criou uma nova marca: HANDLEOVER'),
(250, '2023-10-20 18:45:07', 'kita@hotmail.com', 'Excluiu a marca: HANDLEOVER'),
(251, '2023-10-20 18:46:48', 'minini@yahoo.com.br', 'Criou uma nova marca: COREY'),
(252, '2023-10-20 18:47:03', 'minini@yahoo.com.br', 'Excluiu a marca: COREY'),
(253, '2023-10-25 17:46:17', 'teste@teste.com', 'Alterou a senha do usuário teste@teste.com'),
(254, '2023-10-25 17:46:49', 'teste@teste.com', 'Alterou a senha do usuário teste@teste.com'),
(255, '2023-11-17 17:06:18', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: CAR1289 - Valores(30 min: R$ 5,00, 1h: R$ 7,00, 2h: R$ 5,50 e demais: R$ 6,00)'),
(256, '2023-11-17 17:37:26', 'rene.padua@gmail.com', 'Registrou saída de placa: KIT5432 - Valores(30 min: R$ 4,00, 1h: R$ 4,00, 2h: R$ 2,00 e demais: R$ 1,00)'),
(257, '2023-11-25 10:03:41', 'rene.padua@gmail.com', 'Registrou saída de placa: THA1110 - Valores(30 min: R$ 5,00, 1h: R$ 7,00, 2h: R$ 5,50 e demais: R$ 6,00)'),
(258, '2023-11-29 16:51:13', 'rene.padua@gmail.com', 'Alterou o número de vagas de Moto para: 8'),
(259, '2023-12-01 20:39:18', 'rene.padua@gmail.com', 'Registrou saída de placa: LHA1940 - Valores(30 min: R$ 5,00, 1h: R$ 7,00, 2h: R$ 5,50 e demais: R$ 6,00)'),
(260, '2023-12-05 15:49:05', 'teste@teste.com', 'Alterou a senha do usuário teste@teste.com'),
(261, '2023-12-05 15:49:25', 'teste@teste.com', 'Alterou a senha do usuário teste@teste.com'),
(262, '2023-12-05 16:01:59', 'rene.padua@gmail.com', 'Alterou o número de vagas de Carro para: 15'),
(263, '2023-12-05 18:37:37', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: LHA1940'),
(264, '2023-12-06 16:00:10', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: LHA1940 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(265, '2023-12-09 12:45:57', 'teste@teste.com', 'Cadastrou o veículo de placa: HAY5698'),
(266, '2023-12-09 12:46:47', 'teste@teste.com', 'Registrou saída de placa: MTO0987 - Valores(30 min: R$ 2,00, 1h: R$ 4,00, 2h: R$ 2,00 e demais: R$ 1,00)'),
(267, '2023-12-10 12:26:44', 'teste@teste.com', 'Cadastrou o veículo de placa: GAU8930'),
(268, '2023-12-10 12:30:31', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: HAY5698'),
(269, '2023-12-10 12:30:48', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: GAU8930'),
(270, '2023-12-10 12:32:32', 'rene.padua@gmail.com', 'Registrou saída de placa: GAU8930 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(271, '2023-12-10 12:43:28', 'rene.padua@gmail.com', 'Registrou saída de placa: HAY5698 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(272, '2023-12-10 12:44:26', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: BRM2004'),
(273, '2023-12-12 16:26:02', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: BRM2004 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(274, '2023-12-12 16:31:21', 'thata.bsilva@hotmail.com', 'Alterou o número de vagas de Moto para: 9'),
(275, '2023-12-13 16:09:41', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: GAU8930'),
(276, '2023-12-13 16:34:29', 'rene.padua@gmail.com', 'Registrou saída de placa: GAU8930 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(277, '2023-12-13 16:35:08', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: GAU8930'),
(278, '2023-12-13 16:36:00', 'rene.padua@gmail.com', 'Registrou saída de placa: GAU8930 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(279, '2023-12-13 16:36:10', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: GAU8930'),
(280, '2023-12-13 16:50:24', 'thata.bsilva@hotmail.com', 'Registrou saída de placa: GAU8930 - Valores(30 min: R$ 4,00, 1h: R$ 5,50, 2h: R$ 5,50 e demais: R$ 6,00)'),
(281, '2023-12-13 17:23:04', 'rene.padua@gmail.com', 'Registrou a entrada do veículo de placa: GAU8930');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `cd_Marca` int(11) NOT NULL,
  `nm_Marca` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
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
(46, 'TOYOTA'),
(47, 'TROLLER'),
(48, 'VOLKSWAGEN'),
(49, 'VOLVO'),
(50, 'AMAZON'),
(51, 'AVELLOZ'),
(52, 'BAJAJ'),
(53, 'BRP'),
(54, 'BUELL'),
(55, 'BULL'),
(56, 'CFMOTO'),
(57, 'DAFRA'),
(58, 'DUCATI'),
(59, 'GUZZI'),
(60, 'HAOJUE'),
(61, 'HARLEY-DAVIDSON'),
(62, 'INDIAN'),
(63, 'KAWASAKI'),
(64, 'KTM'),
(65, 'KYMCO'),
(66, 'LL MOTORS'),
(67, 'MV AGUSTA'),
(68, 'PRO TORK'),
(69, 'ROYAL ENFIELD'),
(70, 'SHINERAY'),
(71, 'SOUSA'),
(73, 'SYM'),
(74, 'TRAXX'),
(75, 'VELIMOTOR'),
(76, 'VESPA'),
(77, 'VOLTZ'),
(78, 'YAMAHA'),
(79, 'ZONTES'),
(97, 'SUZUKI');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `cd_Nivel` int(11) NOT NULL,
  `nivel_Acesso` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`cd_Nivel`, `nivel_Acesso`) VALUES
(1, 'Administrador'),
(2, 'Proprietário'),
(3, 'Gerente'),
(4, 'Funcionário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `cd_Registro` int(11) NOT NULL,
  `cd_Veiculo` int(11) DEFAULT NULL,
  `dt_Entrada` datetime DEFAULT NULL,
  `dt_Saida` datetime DEFAULT NULL,
  `vl_Pagamento` decimal(7,2) DEFAULT NULL,
  `vl_30_minutos_Atual` decimal(7,2) DEFAULT NULL,
  `vl_1_hora_Atual` decimal(7,2) DEFAULT NULL,
  `vl_2_horas_Atual` decimal(7,2) DEFAULT NULL,
  `vl_demais_horas_Atual` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `registro`
--

INSERT INTO `registro` (`cd_Registro`, `cd_Veiculo`, `dt_Entrada`, `dt_Saida`, `vl_Pagamento`, `vl_30_minutos_Atual`, `vl_1_hora_Atual`, `vl_2_horas_Atual`, `vl_demais_horas_Atual`) VALUES
(1, 5, '2021-03-05 17:58:42', '2021-03-05 18:40:59', 3.50, 4.00, 4.00, 2.00, 1.00),
(2, 6, '2023-06-05 18:12:08', '2023-06-13 02:26:13', 616.00, 4.00, 4.00, 2.00, 1.00),
(3, 7, '2023-06-06 15:57:37', '2023-06-29 18:07:00', 1939.00, 4.00, 4.00, 2.00, 1.00),
(4, 8, '2023-06-06 16:10:08', NULL, NULL, 2.00, 4.00, 2.00, 1.00),
(5, 9, '2021-06-12 21:48:57', '2021-06-13 02:40:23', 6.00, 2.00, 4.00, 2.00, 1.00),
(7, 10, '2023-06-13 02:41:12', '2023-06-15 12:42:07', 203.00, 4.00, 4.00, 2.00, 1.00),
(8, 11, '2021-06-15 12:41:53', '2021-06-15 12:42:24', 3.50, 4.00, 4.00, 2.00, 1.00),
(9, 12, '2023-06-15 12:44:39', '2023-06-30 16:35:17', 1.50, 2.00, 4.00, 2.00, 1.00),
(10, 13, '2023-06-16 14:18:39', NULL, NULL, 4.00, 4.00, 2.00, 1.00),
(11, 14, '2023-06-16 14:26:32', NULL, NULL, 4.00, 4.00, 2.00, 1.00),
(12, 15, '2023-06-16 14:27:36', '2023-07-25 14:37:46', 3279.50, 4.00, 4.00, 2.00, 1.00),
(13, 16, '2023-06-16 14:38:46', NULL, NULL, 4.00, 4.00, 2.00, 1.00),
(14, 17, '2023-06-16 14:44:40', '2023-09-08 18:42:23', 2023.00, 4.00, 4.00, 2.00, 1.00),
(15, 18, '2023-06-16 14:46:06', NULL, NULL, 4.00, 4.00, 2.00, 1.00),
(16, 20, '2023-06-20 14:36:18', '2023-07-25 15:40:51', 2947.00, 4.00, 4.00, 2.00, 1.00),
(17, 21, '2023-06-20 14:37:53', '2023-06-29 23:46:17', 787.50, 4.00, 4.00, 2.00, 1.00),
(21, 22, '2023-06-29 17:09:35', '2023-08-01 18:40:08', 2779.00, 4.00, 4.00, 2.00, 1.00),
(22, 6, '2023-06-29 17:30:46', '2023-07-03 13:28:07', 318.50, 4.00, 4.00, 2.00, 1.00),
(23, 7, '2023-06-29 17:33:59', '2023-06-29 18:07:00', 3.50, 4.00, 4.00, 2.00, 1.00),
(27, 7, '2023-06-29 18:30:30', '2023-06-30 17:40:55', 80.50, 4.00, 4.00, 2.00, 1.00),
(28, 5, '2023-06-30 13:40:34', '2023-06-30 13:40:59', 3.50, 4.00, 4.00, 2.00, 1.00),
(29, 12, '2023-06-30 16:34:36', '2023-06-30 16:35:17', 1.50, 2.00, 4.00, 2.00, 1.00),
(30, 5, '2023-06-30 17:30:11', '2023-06-30 17:37:51', 3.50, 4.00, 4.00, 2.00, 1.00),
(31, 6, '2023-07-03 13:29:37', '2023-07-04 16:45:32', 94.50, 4.00, 4.00, 2.00, 1.00),
(32, 23, '2023-07-04 17:56:33', '2023-07-04 18:14:52', 1.50, 2.00, 4.00, 2.00, 1.00),
(33, 11, '2023-07-04 18:14:27', '2023-07-05 16:57:56', 80.50, 4.00, 4.00, 2.00, 1.00),
(34, 11, '2023-07-05 16:30:50', '2023-07-05 16:50:45', 4.50, 5.00, 4.00, 2.00, 1.00),
(35, 11, '2023-07-05 16:59:23', '2023-07-25 14:52:59', 2151.00, 5.00, 4.00, 2.00, 1.00),
(36, 9, '2023-07-05 18:18:41', '2023-07-25 14:42:26', 715.50, 2.00, 4.00, 2.00, 1.00),
(37, 25, '2023-07-25 14:36:59', '2023-07-25 14:37:21', 3.50, 4.00, 4.00, 2.00, 1.00),
(38, 26, '2023-07-25 14:41:23', '2023-07-25 14:50:27', 1.50, 2.00, 4.00, 2.00, 1.00),
(39, 27, '2023-07-25 14:50:08', '2023-07-31 20:15:34', 825.00, 6.00, 4.00, 2.00, 1.00),
(40, 28, '2023-07-25 14:52:39', '2023-08-01 18:36:44', 946.00, 6.00, 4.00, 2.00, 1.00),
(41, 29, '2023-07-25 14:59:03', '2023-08-01 18:28:26', 602.00, 4.00, 4.00, 2.00, 1.00),
(42, 30, '2023-07-25 15:27:01', '2023-07-28 18:08:13', 112.50, 2.00, 4.00, 2.00, 1.00),
(43, 26, '2023-07-25 15:27:55', '2023-07-28 18:08:04', 112.50, 2.00, 4.00, 2.00, 1.00),
(44, 31, '2023-07-25 15:29:54', '2023-07-28 18:07:54', 262.50, 4.00, 4.00, 2.00, 1.00),
(45, 20, '2023-07-25 15:41:41', '2023-07-25 15:42:26', 3.50, 4.00, 4.00, 2.00, 1.00),
(46, 20, '2023-07-25 15:42:46', '2023-07-25 15:44:56', 3.50, 4.00, 4.00, 2.00, 1.00),
(47, 20, '2023-07-25 15:45:09', '2023-07-25 17:01:43', 7.00, 4.00, 4.00, 2.00, 1.00),
(48, 32, '2023-07-25 16:30:30', '2023-07-25 16:30:44', 3.50, 4.00, 4.00, 2.00, 1.00),
(49, 32, '2023-07-25 17:06:31', '2023-07-25 17:19:00', 3.50, 4.00, 4.00, 2.00, 1.00),
(50, 32, '2023-07-25 17:19:13', '2023-07-28 18:07:38', 255.50, 4.00, 4.00, 2.00, 1.00),
(51, 33, '2023-07-27 16:51:46', '2023-07-27 16:52:05', 3.50, 4.00, 4.00, 2.00, 1.00),
(52, 33, '2023-07-27 16:52:26', '2023-07-27 16:55:01', 3.50, 4.00, 4.00, 2.00, 1.00),
(53, 34, '2023-07-27 17:03:51', '2023-07-27 17:03:58', 3.50, 4.00, 4.00, 2.00, 1.00),
(54, 34, '2023-07-27 17:04:12', '2023-07-28 18:06:56', 91.00, 4.00, 4.00, 2.00, 1.00),
(55, 35, '2023-07-28 14:12:08', '2023-07-28 18:06:45', 14.00, 4.00, 4.00, 2.00, 1.00),
(56, 34, '2023-07-28 18:09:15', '2023-08-01 14:49:23', 325.50, 4.00, 4.00, 2.00, 1.00),
(57, 35, '2023-08-01 17:15:07', '2023-08-01 17:15:48', 3.50, 4.00, 4.00, 2.00, 1.00),
(58, 35, '2023-08-01 17:30:06', '2023-08-01 17:30:21', 3.50, 4.00, 4.00, 2.00, 1.00),
(59, 35, '2023-08-01 17:34:34', '2023-08-01 17:38:57', 3.50, 4.00, 4.00, 2.00, 1.00),
(60, 35, '2023-08-01 17:56:54', '2023-08-01 17:57:36', 3.50, 4.00, 4.00, 2.00, 1.00),
(61, 35, '2023-08-01 17:58:26', '2023-08-01 17:58:32', 3.50, 4.00, 4.00, 2.00, 1.00),
(62, 35, '2023-08-01 17:58:52', '2023-08-01 18:01:03', 3.50, 4.00, 4.00, 2.00, 1.00),
(63, 12, '2023-08-01 17:59:36', '2023-08-01 17:59:45', 1.50, 2.00, 4.00, 2.00, 1.00),
(64, 6, '2023-08-01 17:59:58', '2023-08-01 18:00:50', 3.50, 4.00, 4.00, 2.00, 1.00),
(65, 35, '2023-08-01 18:01:17', '2023-08-01 18:01:44', 3.50, 4.00, 4.00, 2.00, 1.00),
(66, 24, '2023-08-02 14:49:49', NULL, NULL, 4.00, 4.00, 2.00, 1.00),
(67, 26, '2023-08-02 14:50:50', '2023-08-02 14:58:41', 1.50, 2.00, 4.00, 2.00, 1.00),
(68, 11, '2023-08-02 14:51:12', '2023-11-17 17:37:06', 2574.00, 4.00, 4.00, 2.00, 1.00),
(69, 7, '2023-08-02 14:53:07', '2023-08-03 16:22:56', 91.00, 4.00, 4.00, 2.00, 1.00),
(70, 36, '2023-08-02 16:04:54', '2023-12-09 12:46:44', 3096.00, 2.00, 4.00, 2.00, 1.00),
(71, 37, '2023-08-02 16:09:17', NULL, NULL, 2.00, 4.00, 2.00, 1.00),
(72, 39, '2023-08-03 16:23:25', '2023-08-03 16:24:06', 3.50, 4.00, 4.00, 2.00, 1.00),
(73, 39, '2023-08-03 16:24:21', '2023-08-15 18:17:37', 3045.00, 11.00, 4.00, 2.00, 1.00),
(74, 40, '2023-08-15 18:16:16', '2023-09-02 10:03:52', 1908.00, 5.00, 4.00, 2.00, 1.00),
(75, 40, '2023-09-08 16:50:45', '2023-12-01 20:38:55', 12114.50, 5.00, 7.00, 5.50, 6.00),
(76, 10, '2023-09-08 18:47:18', '2023-09-08 18:47:30', 5.00, 5.00, 7.00, 5.50, 6.00),
(77, 30, '2023-10-16 21:45:03', '2023-10-17 17:17:55', 59.50, 2.00, 5.00, 3.50, 3.00),
(78, 38, '2023-10-16 18:58:12', '2023-10-16 19:04:03', 5.00, 5.00, 7.00, 5.50, 6.00),
(79, 35, '2023-10-16 19:17:02', '2023-11-25 10:03:27', 5700.50, 5.00, 7.00, 5.50, 6.00),
(80, 38, '2023-10-17 17:18:21', '2023-11-17 17:06:12', 4458.50, 5.00, 7.00, 5.50, 6.00),
(81, 23, '2023-10-17 17:25:26', '2023-10-18 16:50:53', 71.50, 2.00, 5.00, 3.50, 3.00),
(82, 42, '2023-10-20 18:25:51', '2023-10-20 18:31:12', 4.00, 4.00, 5.50, 5.50, 6.00),
(83, 43, '2023-10-20 18:35:12', '2023-10-20 18:35:49', 4.00, 4.00, 5.50, 5.50, 6.00),
(84, 40, '2023-12-05 18:37:37', '2023-12-06 16:00:02', 125.00, 4.00, 5.50, 5.50, 6.00),
(85, 44, '2023-12-10 12:30:31', '2023-12-10 12:43:12', 4.00, 4.00, 5.50, 5.50, 6.00),
(86, 45, '2023-12-10 12:30:48', '2023-12-10 12:31:49', 4.00, 4.00, 5.50, 5.50, 6.00),
(87, 34, '2023-12-10 12:44:26', '2023-12-12 16:25:47', 305.00, 4.00, 5.50, 5.50, 6.00),
(88, 45, '2023-12-13 16:09:41', '2023-12-13 16:34:21', 4.00, 4.00, 5.50, 5.50, 6.00),
(89, 45, '2023-12-13 16:35:08', '2023-12-13 16:35:54', 4.00, 4.00, 5.50, 5.50, 6.00),
(90, 45, '2023-12-13 16:36:10', '2023-12-13 16:50:20', 4.00, 4.00, 5.50, 5.50, 6.00),
(91, 45, '2023-12-13 17:23:04', NULL, NULL, 4.00, 5.50, 5.50, 6.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `cd_Tipo` int(11) NOT NULL,
  `nm_Tipo` varchar(10) DEFAULT NULL,
  `vl_Tipo` decimal(7,2) DEFAULT NULL,
  `vl_30_minutos` decimal(7,2) DEFAULT NULL,
  `vl_1_hora` decimal(7,2) DEFAULT NULL,
  `vl_2_horas` decimal(7,2) DEFAULT NULL,
  `vl_demais_horas` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`cd_Tipo`, `nm_Tipo`, `vl_Tipo`, `vl_30_minutos`, `vl_1_hora`, `vl_2_horas`, `vl_demais_horas`) VALUES
(1, 'Carro', 4.00, 4.00, 5.50, 5.50, 6.00),
(2, 'Moto', 1.50, 2.00, 5.00, 3.50, 3.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cd_Nivel` int(11) DEFAULT NULL,
  `contraste_Cor` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `email`, `senha_hash`, `cd_Nivel`, `contraste_Cor`) VALUES
(1, 'thata.bsilva@hotmail.com', '$2y$10$FZkic2fz6SlcclsxPA2tSeLGSHt8xRyFL.8AtmiTS0v8YEk25LpdS', 1, 1),
(2, 'rene.padua@gmail.com', '$2y$10$i1W.XMVMOn9RTJDnmrztiOLbqo5AqFx9nHeIiJ1BMbQs1sulV.eee', 1, 1),
(3, 'kita@hotmail.com', '$2y$10$hM3ECuaSYsfZM4qNLaX9EOS6Y0q8Pw6irxCybVIZYk5rspeYfPg0O', 2, 0),
(6, 'minini@yahoo.com.br', '$2y$10$riXcsjF02ZyNIkB8n9NMlOhOdfYxuqUMFbT9L5yEyHNAzqP7OWu..', 2, 0),
(10, 'batata@gmail.com', '$2y$10$sGDttlHGxa8dlIjntlQOueLHtrEReRmnkoh6ZTPwnEJoou9F2VwE6', 4, 0),
(11, 'pakita@gmail.com', '$2y$10$GcP54G6DtAIOIeAB5asLbeCujmtGl6l/xmHQ2BUr4RuzLuLO2CsT.', 3, 0),
(17, 'renekito@hotmail.com', '$2y$10$kwJ6zt6SrXHernRIRncEOukTO3QcwyvX.VcdfwUF.XgCulzGTJKgO', 3, 0),
(19, 'mini@yahoo.com.br', '$2y$10$/nPCSwQIUrqx97TH11YJ8OFFW0omrs8t09Tv34EbGP1G7U5WFrq5u', 3, 1),
(20, 'mini@hotmail.com', '$2y$10$scZ5qcf1XiG6AzM4LYDrxeYZNhyXleR6Iblhy99XdKH92noi8JHh.', 4, 0),
(21, 'teste@teste.com', '$2y$10$AWYhWfJGscX4zN6DhTGTK.zUmXFZmqzqWHut58neuGwuNKxc4/hDm', 4, 0),
(23, 'novo@teste.com', '$2y$10$UH6koIHg8qqHjRtLLgtia.xc2.CTrUUdb921XGq4MhiRfcHRqPSZ2', 4, 0),
(24, 'teste1@teste.com', '$2y$10$ZjOCIPXTMNs4vjWgQPngc.3w61voNC79ZfDcYwPafcKMUigs3BhKu', 4, 0),
(25, 'teste2@teste.com', '$2y$10$6lByvPA9vBfoEJgLENEWauUt2rJY8HBTpIW3eHap//a5mNIXR8NLW', 4, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `vagas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vagas`
--

INSERT INTO `vagas` (`id`, `tipo_id`, `vagas`) VALUES
(1, 1, 15),
(2, 2, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `cd_Veiculo` int(11) NOT NULL,
  `cd_Placa` varchar(8) DEFAULT NULL,
  `cd_Tipo` int(11) DEFAULT NULL,
  `cd_Marca` int(11) DEFAULT NULL,
  `nm_Modelo` varchar(50) DEFAULT NULL,
  `nm_Cor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (`cd_Veiculo`, `cd_Placa`, `cd_Tipo`, `cd_Marca`, `nm_Modelo`, `nm_Cor`) VALUES
(5, 'WEE9988', 1, 48, 'Fusca', 'Azul'),
(6, 'EEW7654', 1, 48, 'Polo', 'Preto'),
(7, 'YUP4680', 1, 8, 'Onix', 'Amarelo'),
(8, 'PIG8901', 2, 78, 'Fazer 250', 'Preto'),
(9, 'LEX9477', 2, 63, 'Ninja 400', 'Verde'),
(10, 'WEE9980', 1, 2, 'A3', 'Prata'),
(11, 'KIT5432', 1, 48, 'Gol', 'Branco'),
(12, 'KIT5436', 2, 61, 'Bobber', 'Amarelo'),
(13, 'WEE0987', 1, 8, 'Onix', 'Preto'),
(14, 'THA2468', 1, 48, 'New Beetle', 'Amarelo'),
(15, 'RSA1357', 1, 16, 'Uno', 'Preto'),
(16, 'FTY9753', 1, 16, '500', 'Verde'),
(17, 'VBM6754', 1, 46, 'Toyota Hilux - cabine fechada', 'Preto'),
(18, 'VBM6753', 1, 46, 'Toyota Hilux - cabine simples', 'Prata'),
(20, 'OPG8474', 1, 14, 'Ram', 'Preto'),
(21, 'NJO9865', 1, 8, 'Blazer', 'Preto'),
(22, 'NCA1995', 1, 8, 'Tracker', 'Marrom'),
(23, 'BLN1209', 2, 19, 'Hornet', 'Preto'),
(24, 'ASA7307', 1, 19, 'Civic', 'Vermelho'),
(25, 'BKX1290', 1, 16, 'Uno', 'Amarelo'),
(26, 'CAM9910', 2, 97, 'Bandit', 'Preto'),
(27, 'HIN1590', 1, 8, 'Blazer', 'Vermelho'),
(28, 'RGK2345', 1, 39, 'Clio', 'Azul'),
(29, 'KIN1234', 1, 35, '206', 'Cinza'),
(30, 'CED1103', 2, 78, 'R3', 'Azul'),
(31, 'TDA9010', 1, 48, 'Tiguan', 'Prata'),
(32, 'ESC5140', 1, 19, 'City', 'Marrom'),
(33, 'DIT2153', 1, 16, 'Palio', 'Verde'),
(34, 'BRM2004', 1, 48, 'Kombi', 'Azul'),
(35, 'THA1110', 1, 16, 'Toro', 'Amarelo'),
(36, 'MTO0987', 2, 4, 'G310R', 'Azul'),
(37, 'MOT6789', 2, 4, 'G310GS', 'Vermelho'),
(38, 'CAR1289', 1, 8, 'Monza', 'Marrom'),
(39, 'BDC4935', 1, 10, 'C5', 'Preto'),
(40, 'LHA1940', 1, 46, 'Corolla', 'Vermelho'),
(41, 'NAO1315', 1, 16, 'Uno', 'Amarelo'),
(42, 'LDA7576', 1, 8, 'Chevette', 'Preto'),
(43, 'AMI0077', 1, 17, 'Fiesta', 'Prata'),
(44, 'HAY5698', 1, 48, 'Gol', 'Cinza'),
(45, 'GAU8930', 1, 8, 'Tracker', 'Cinza');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `logs_movimentacao`
--
ALTER TABLE `logs_movimentacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`cd_Marca`);

--
-- Índices de tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`cd_Nivel`);

--
-- Índices de tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`cd_Registro`),
  ADD KEY `cd_Veiculo` (`cd_Veiculo`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`cd_Tipo`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_nivel_acesso` (`cd_Nivel`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`cd_Veiculo`),
  ADD UNIQUE KEY `unique_placa` (`cd_Placa`),
  ADD KEY `cd_Marca` (`cd_Marca`),
  ADD KEY `fk_veiculo_tipo` (`cd_Tipo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs_movimentacao`
--
ALTER TABLE `logs_movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `cd_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `cd_Registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `cd_Veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`cd_Veiculo`) REFERENCES `veiculo` (`cd_Veiculo`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_nivel_acesso` FOREIGN KEY (`cd_Nivel`) REFERENCES `nivel_acesso` (`cd_Nivel`);

--
-- Restrições para tabelas `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`cd_Tipo`);

--
-- Restrições para tabelas `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_veiculo_tipo` FOREIGN KEY (`cd_Tipo`) REFERENCES `tipo` (`cd_Tipo`),
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`cd_Marca`) REFERENCES `marca` (`cd_Marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
