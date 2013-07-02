-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27-log
-- Versão do PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE IF NOT EXISTS `conta` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `status_conta` char(1) DEFAULT NULL,
  `data_entrada` datetime DEFAULT NULL,
  `data_saida` datetime DEFAULT NULL,
  `FUNCIONARIO_id_funcionario` int(11) NOT NULL,
  `MESA_id_mesa` int(11) NOT NULL,
  `vlr_total` float DEFAULT NULL,
  `tipo_pagamento` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `fk_CONTA_FUNCIONARIO1_idx` (`FUNCIONARIO_id_funcionario`),
  KEY `fk_CONTA_MESA1_idx` (`MESA_id_mesa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id_conta`, `status_conta`, `data_entrada`, `data_saida`, `FUNCIONARIO_id_funcionario`, `MESA_id_mesa`, `vlr_total`, `tipo_pagamento`) VALUES
(18, 'F', '2013-07-02 01:56:28', '2013-07-02 01:57:55', 1, 18, 850, '1'),
(19, 'F', '2013-07-02 02:00:10', '2013-07-02 02:13:52', 1, 19, 70, '2'),
(20, 'F', '2013-07-02 02:27:25', '2013-07-02 03:19:49', 1, 19, 145, '1'),
(22, 'F', '2013-07-02 10:46:34', '2013-07-02 16:47:42', 1, 18, 8040, '1'),
(23, 'F', '2013-07-02 11:33:50', '2013-07-02 16:47:07', 11, 19, 125, '1'),
(29, 'F', '2013-07-02 15:01:05', '2013-07-02 17:31:08', 1, 18, 60, '3'),
(30, 'F', '2013-07-02 15:07:25', '2013-07-02 15:57:49', 1, 19, 80, '1'),
(32, 'F', '2013-07-02 15:56:17', '2013-07-02 15:57:29', 1, 21, 175, '2'),
(35, 'F', '2013-07-02 17:32:52', '2013-07-02 17:34:23', 14, 22, 660, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(60) DEFAULT NULL,
  `data_admissao` datetime DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `permissao` int(11) NOT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome_funcionario`, `data_admissao`, `usuario`, `senha`, `permissao`) VALUES
(1, 'reginaldo', '2013-05-22 00:00:00', 'reginaldo', '202cb962ac59075b964b07152d234b70', 1),
(11, 'Gilberto', '2013-07-02 00:00:00', 'marcio', 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(14, 'junior', '2013-07-02 00:00:00', 'junior', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(45) DEFAULT NULL,
  `vlr_unitario` float DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id_item`, `nome_item`, `vlr_unitario`) VALUES
(10, 'pizza', 60),
(11, 'refrigerante 2l', 5),
(12, 'sorvete', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesa`
--

CREATE TABLE IF NOT EXISTS `mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `nro_mesa` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_mesa`),
  UNIQUE KEY `nro_mesa_UNIQUE` (`nro_mesa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `nro_mesa`, `status`) VALUES
(18, 1, 'L'),
(19, 2, 'L'),
(20, 3, 'L'),
(21, 4, 'L'),
(22, 5, 'L'),
(23, 6, 'L'),
(24, 7, 'L'),
(25, 8, 'L'),
(26, 9, 'L'),
(27, 10, 'L');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `data_pedido` datetime NOT NULL,
  `status_pedido` char(1) NOT NULL,
  `CONTA_id_conta` int(11) NOT NULL,
  `entrega_pedido` datetime DEFAULT NULL,
  `qtd` int(11) NOT NULL,
  `ITEM_id_item` int(11) NOT NULL,
  `descricao_pedido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`,`ITEM_id_item`),
  KEY `fk_PEDIDO_CONTA1_idx` (`CONTA_id_conta`),
  KEY `fk_PEDIDO_ITEM1_idx` (`ITEM_id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `status_pedido`, `CONTA_id_conta`, `entrega_pedido`, `qtd`, `ITEM_id_item`, `descricao_pedido`) VALUES
(6, '2013-07-02 01:56:37', 'E', 18, '2013-07-02 01:57:35', 22, 10, '22'),
(7, '2013-07-02 01:56:48', 'E', 18, '2013-07-02 01:57:38', 2, 11, 'coca e fanta'),
(8, '2013-07-02 01:57:00', 'E', 18, '2013-07-02 01:57:40', 2, 10, 'Calabresa com alho'),
(9, '2013-07-02 02:00:21', 'E', 19, '2013-07-02 02:00:43', 1, 10, '2'),
(10, '2013-07-02 02:07:45', 'E', 19, '2013-07-02 02:13:39', 1, 10, ''),
(11, '2013-07-02 02:27:34', 'E', 20, '2013-07-02 02:28:03', 2, 11, 'coca'),
(12, '2013-07-02 02:27:41', 'E', 20, '2013-07-02 02:28:07', 4, 11, '222'),
(13, '2013-07-02 02:27:48', 'E', 20, '2013-07-02 02:28:10', 2, 10, ''),
(14, '2013-07-02 02:27:52', 'E', 20, '2013-07-02 02:28:13', 1, 10, ''),
(15, '2013-07-02 03:15:41', 'E', 20, '2013-07-02 03:15:54', 2, 12, ''),
(17, '2013-07-02 10:46:41', 'E', 22, '2013-07-02 11:29:55', 11, 10, ''),
(18, '2013-07-02 10:50:07', 'E', 22, '2013-07-02 11:29:58', 11, 10, ''),
(19, '2013-07-02 10:50:13', 'E', 22, '2013-07-02 11:30:01', 112, 10, '2222'),
(21, '2013-07-02 11:34:46', 'E', 23, '2013-07-02 15:58:54', 1, 11, ''),
(22, '2013-07-02 11:34:59', 'E', 23, '2013-07-02 15:58:51', 2, 10, 'calabresa e cheddar'),
(24, '2013-07-02 15:07:40', 'E', 30, '2013-07-02 15:09:26', 2, 10, 'teste'),
(25, '2013-07-02 15:09:15', 'E', 30, '2013-07-02 15:09:29', 2, 12, 'ola'),
(26, '2013-07-02 15:56:26', 'E', 32, '2013-07-02 15:57:11', 5, 10, '22'),
(29, '2013-07-02 17:13:16', 'E', 29, '2013-07-02 17:30:58', 1, 10, 'calabresa'),
(32, '2013-07-02 17:33:07', 'E', 35, '2013-07-02 17:33:24', 11, 10, 'media');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `conta`
--
ALTER TABLE `conta`
  ADD CONSTRAINT `fk_CONTA_FUNCIONARIO1` FOREIGN KEY (`FUNCIONARIO_id_funcionario`) REFERENCES `funcionario` (`id_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CONTA_MESA1` FOREIGN KEY (`MESA_id_mesa`) REFERENCES `mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_PEDIDO_CONTA1` FOREIGN KEY (`CONTA_id_conta`) REFERENCES `conta` (`id_conta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PEDIDO_ITEM1` FOREIGN KEY (`ITEM_id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
