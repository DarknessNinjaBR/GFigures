-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Set-2020 às 04:49
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gfigures`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `launch` tinyint(1) DEFAULT NULL,
  `old_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `brand_id`, `sale`, `launch`, `old_price`) VALUES
(5, 'Solaire Figure', 'mt show', 240, 2, 3, 0, 1, 0),
(6, 'DNBR', 'feiasso', 199, 2, 9, 0, 0, 0),
(7, 'MUITA COISA', 'doidera', 170.85, 5, 9, 0, 0, 0),
(8, 'fsfas', 'ff', 100, 4, 3, 1, 0, 150),
(9, 'Pedro Gomes Antunes', 'eu', 99.99, 2, 9, 0, 0, 0),
(10, 'Pedro Gomes Antunes', 'fsafas', 99.99, 4, 3, 1, 0, 150),
(13, '111111111', '1111111', 11, 6, 10, 1, 0, 1.111),
(14, 'Action Figure Show', '<p><strong>ISSO È NEGÂO</strong></p><p><i>ISSO È MARIO</i></p><p>isso é normal</p><p><i><strong>ISSO È MARIO NEGAO</strong></i></p>', 1000, 2, 10, 0, 0, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
