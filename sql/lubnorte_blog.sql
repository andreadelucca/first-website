-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 30-Nov-2020 às 23:29
-- Versão do servidor: 10.3.18-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lubnorte_blog`
--
CREATE DATABASE IF NOT EXISTS `lubnorte_blog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lubnorte_blog`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lb_postagem`
--

DROP TABLE IF EXISTS `lb_postagem`;
CREATE TABLE IF NOT EXISTS `lb_postagem` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `tipopostagem` varchar(20) NOT NULL,
  `conteudo` longtext NOT NULL,
  `visitas` int(11) DEFAULT NULL,
  `statuspost` varchar(10) NOT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lb_postagem`
--

INSERT INTO `lb_postagem` (`idpost`, `titulo`, `descricao`, `autor`, `data`, `tipopostagem`, `conteudo`, `visitas`, `statuspost`) VALUES
(6, 'Modelo de Notícia', 'Um conteúdo publicado qualquer', 'André Batista', '2020-11-30', 'Noticia', '&lt;p&gt;Modelo de c&amp;oacute;digo elaborado pelo pior programador do mundo. Uma pituca de imagem!&lt;/p&gt;  &lt;p&gt;&amp;nbsp;&lt;/p&gt;  &lt;p&gt;&amp;nbsp;&lt;/p&gt; ', 0, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lb_usuarios`
--

DROP TABLE IF EXISTS `lb_usuarios`;
CREATE TABLE IF NOT EXISTS `lb_usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `statususuario` varchar(10) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lb_usuarios`
--

INSERT INTO `lb_usuarios` (`idusuario`, `nome`, `usuario`, `senha`, `statususuario`) VALUES
(1, 'Administrador SISTEMA', 'lubnorteamcom', 'lubn2018!@#', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
