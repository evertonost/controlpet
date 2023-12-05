-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 05:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_servicos` int(11) NOT NULL,
  `id_cliente` int(1) NOT NULL,
  `pet` varchar(220) NOT NULL,
  `servico` varchar(220) NOT NULL,
  `petshop` varchar(220) NOT NULL,
  `funcionario` varchar(220) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agendamentos`
--

INSERT INTO `agendamentos` (`id_servicos`, `id_cliente`, `pet`, `servico`, `petshop`, `funcionario`, `status`) VALUES
(16, 4, 'mingal', 'tosa', 'cobasi', 'mateus', 1),
(17, 5, 'teste2', 'banho e tosa', 'cobasi', 'mateus', 1),
(18, 5, 'teste2', 'banho', 'Petshopzoo', 'mateus', 1),
(19, 5, 'teste2', 'banho', 'Petshopzoo', 'mateus', 1),
(20, 4, 'mingal', 'tosa', 'cobasi', 'maria', 1),
(21, 4, 'ultimo cadastro ', 'banho e tosa', 'Petshopzoo', 'mateus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `telefone1` varchar(14) NOT NULL,
  `telefone2` varchar(14) DEFAULT NULL,
  `senha` varchar(10) NOT NULL,
  `confirmacao_senha` varchar(10) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `foto_cliente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf`, `data_nascimento`, `email`, `telefone1`, `telefone2`, `senha`, `confirmacao_senha`, `rua`, `numero`, `complemento`, `estado`, `cidade`, `status`, `foto_cliente`) VALUES
(4, 'lucas ruan correia', '11270935925', '2001-01-13', 'as@as', '1', '1', '12', '12', '1', 1, '1', '1', '1', 1, '../fotos_upload/carlos.webp'),
(5, 'luquinhas', '11270935927', '2001-12-01', 'a@asd', '41997115510', '', '789', '789', '1', 1, '1', '1', '1', 1, '../fotos_upload/Logo.png'),
(6, 'lucas ruan', '11370935925', '2001-12-01', 'lucas@teste', '41989764654', '5651654', '456', '456', '1', 1, '1', '1', '1', 1, '../fotos_upload/656d1b2c6a429_maria joaquina.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `id_petshop` int(11) NOT NULL,
  `func_nome` varchar(50) NOT NULL,
  `func_foto` varchar(220) NOT NULL,
  `func_cpf` varchar(11) NOT NULL,
  `func_email` varchar(50) NOT NULL,
  `func_celular` varchar(14) NOT NULL,
  `status_func` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `id_petshop`, `func_nome`, `func_foto`, `func_cpf`, `func_email`, `func_celular`, `status_func`) VALUES
(1, 3, 'mateus', '', '11270935922', 'mateus@gmail.com', '4144444444', 0),
(6, 2, 'testando2', '', '11270935921', 'maria@gmail.com', '4199999999', 0),
(7, 2, 'testando3', '', '11270935921', 'maria@gmail.com', '4199999999', 0),
(8, 2, 'testando4', '', '11270935921', 'maria@gmail.com', '4199999999', 0),
(9, 2, 'testando5', '', '11270935921', 'maria@gmail.com', '4199999999', 0),
(10, 2, 'testando6', '', '11270935921', 'maria@gmail.com', '4199999999', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo_pet` varchar(15) NOT NULL,
  `raca` varchar(50) NOT NULL,
  `genero` char(1) NOT NULL,
  `comportamento` varchar(255) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `foto_pet` varchar(255) NOT NULL,
  `status_pet` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `id_cliente`, `nome`, `tipo_pet`, `raca`, `genero`, `comportamento`, `obs`, `foto_pet`, `status_pet`) VALUES
(56, 4, 'ultimo cadastro ', 'gato', 'vira-lata', 'f', 'asdasdasd', 'assa', 'Imagens/imagens_pet/656cffa33485e_maria joaquina.jpg', 1),
(57, 5, 'teste2', 'gato', 'sad', 'm', 'teste2', 'teste2', 'Imagens/imagens_pet/656d047428645_maria joaquina.jpg', 1),
(58, 4, 'maria joaquina', 'gato', 'vira-lata', 'f', 'teste1', 'teste1', 'Imagens/imagens_pet/656d246d795dd_maria joaquina.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petshops`
--

CREATE TABLE `petshops` (
  `id_petshop` int(11) NOT NULL,
  `nome_petshop` varchar(220) NOT NULL,
  `foto_petshop` varchar(220) NOT NULL,
  `cnpj_petshop` varchar(220) NOT NULL,
  `email_petshop` varchar(220) DEFAULT NULL,
  `telefone1_petshop` varchar(220) NOT NULL,
  `telefone2_petshop` varchar(220) DEFAULT NULL,
  `senha_petshop` varchar(220) NOT NULL,
  `confirm_senha_petshop` varchar(220) NOT NULL,
  `rua_petshop` varchar(220) NOT NULL,
  `numero_petshop` varchar(220) NOT NULL,
  `complemento_petshop` varchar(220) DEFAULT NULL,
  `estado_petshop` varchar(220) NOT NULL,
  `cidade_petshop` varchar(220) NOT NULL,
  `status_petshop` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petshops`
--

INSERT INTO `petshops` (`id_petshop`, `nome_petshop`, `foto_petshop`, `cnpj_petshop`, `email_petshop`, `telefone1_petshop`, `telefone2_petshop`, `senha_petshop`, `confirm_senha_petshop`, `rua_petshop`, `numero_petshop`, `complemento_petshop`, `estado_petshop`, `cidade_petshop`, `status_petshop`) VALUES
(2, 'Petshopzoo', 'imagenspetshop0F58EF12-4BBD-44EE-94CA-7ABB1BCEDDC5.jpg', '12333444000122 ', 'everton.ost@gmail.com', '41995575280', '4188888888', '1234', '1234', 'Rua Anneliese G Krigsner', '2607', 'casa 4', 'parana ', '3', 1),
(3, 'cobasi', 'imagenspetshopnami.jpg', '00000000000000', 'a@a', '41516541561', '', '45', '45', '4', '4', '4', '4', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `id_petshop` int(1) NOT NULL,
  `nome_servico` varchar(220) NOT NULL,
  `custo` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicos`
--

INSERT INTO `servicos` (`id_servico`, `id_petshop`, `nome_servico`, `custo`) VALUES
(1, 0, 'banho', '50'),
(2, 0, 'tosa', '50'),
(3, 0, 'banho e tosa', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_servicos`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `id_petshop` (`id_petshop`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `petshops`
--
ALTER TABLE `petshops`
  ADD PRIMARY KEY (`id_petshop`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_servicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `petshops`
--
ALTER TABLE `petshops`
  MODIFY `id_petshop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `fk_id_petshop` FOREIGN KEY (`id_petshop`) REFERENCES `petshops` (`id_petshop`);

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
