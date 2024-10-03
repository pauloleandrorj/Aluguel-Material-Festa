-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03-Out-2024 às 13:32
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `BD_PP`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `sobrenome`, `empresa`, `cargo`, `email`, `observacao`) VALUES
(1, 'Paulo15151515151515', 'Martins', 'P&amp;P Aluguel Material Festa', '1515151', 'aluguelmaterialfesta@gmail.com', '555555555555555555555555'),
(2, 'Nicolas', 'Martins', 'Tico Tico', 'CEO', 'nicolasmartinsrj@gmail.com', 'Teste em observação'),
(3, 'Sergio', 'Luiz Rossi Alves', 'TITO LIPPPPPA', 'Supervidor', 'paulomartinsrj@gmail.com', 'agora vai'),
(4, 'Paulo', 'Martins', 'P&amp;P Aluguel Material Festa', '55555555555555555555555', 'aluguelmaterialfesta@gmail.com', 'kokokokoko'),
(5, 'Guilherme Guilherme', 'Martins', 'P&amp;P AAASSSSSSS', 'TESTE', 'ermenegildo@gmail.com', 'ooooooooooooooooooooooooooooo'),
(6, 'Ederson', 'Freire', '', 'Motorista', 'aluguel@gmail.com', ''),
(7, 'Paulo', 'Martins', 'P&P Aluguel Material Festa', '', 'aluguelmaterialsta@gmail.com', '88888888888888888888888888888888888888');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `endereco` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `cliente_id`, `endereco`) VALUES
(1, 1, 'Estrada do Barro Vermelho'),
(2, 2, 'Rua Vaz Lobo, 31 - Vaz Lobo'),
(3, 3, 'Rua Jacina, 76 Vaz Lobo'),
(4, 4, 'Estrada do Barro Vermelho'),
(5, 5, 'Madureira'),
(6, 6, 'Rua do Café');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `telefones`
--

INSERT INTO `telefones` (`id`, `cliente_id`, `telefone`) VALUES
(1, 1, '2133515599'),
(2, 2, '213333333333333'),
(3, 3, '21976611843'),
(4, 4, '2133515599'),
(5, 5, '21545454'),
(6, 6, '151151');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `sobrenome`) VALUES
(1, 'Paulo Leandro Machado Martins', 'aluguelmaterialfesta@gmail.com', '$2y$10$.OU0zDQiwqxHPWZrJlTB5OAQtKd1Z4U44Bg4kMvYB/rJVQ7f2h02O', NULL),
(3, 'Paulo Leandro', 'paulomartinsrj@gmail.com', '123456', NULL),
(16, 'Nicolas', 'nicolas@gmail.com', '$2y$10$irUbKNGnQWridRYxxP6/DeZtEHR/N3Ao6w/2KEQVnNVILHctrdd7.', 'Martins'),
(17, 'guilherme', 'materialfesta@gmail.com', '$2y$10$wZjx6B2sLL2T6ju6Kv7DUumt81n.TP8xixmvbit3Z7u1KlF7qX7ya', 'martins');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices para tabela `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `telefones`
--
ALTER TABLE `telefones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `telefones`
--
ALTER TABLE `telefones`
  ADD CONSTRAINT `telefones_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
