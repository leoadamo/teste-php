-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Maio-2019 às 16:40
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog-php`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `cdpost` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumo` text NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `posicao` varchar(5) NOT NULL DEFAULT 'right',
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`cdpost`, `titulo`, `resumo`, `texto`, `imagem`, `posicao`, `data`) VALUES
(13, 'Funções em PHP', 'Utilizando as funções no PHP', 'Funções podem ser definidas blocos de código com um objetivo específico, identificados por um nome através do qual pode ser referenciado á partir de várias partes do código. Essa é uma das principais técnicas utilizadas para garantir a reutilização de código, tornando a programação mais prática e o código mais ?limpo? e organizado.', 'funcoes-em-php.jpg', 'left', '2019-05-22'),
(14, 'Echo', 'Printando elementos no PHP', 'Exibe todos os parâmetros.\r\n\r\necho não é uma função atualmente (construtor da linguagem) então não é obrigatório usar parênteses. echo (diferente de outro construtor da linguagem) não se comporta como uma função, então ele nem sempre é usado no contexto de uma função. Sendo assim, se você quer passar mais de um parâmetro para echo, os parâmetros não precisam estar entre parênteses.', 'php-variable.png', 'right', '2019-05-22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `usuario` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `usuario`, `senha`) VALUES
(1, 'admin', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`cdpost`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `cdpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
