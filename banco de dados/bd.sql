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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id_conta`, `status_conta`, `data_entrada`, `data_saida`, `FUNCIONARIO_id_funcionario`, `MESA_id_mesa`, `vlr_total`, `tipo_pagamento`) VALUES
(4, 'F', '2013-05-07 19:33:30', '2013-05-13 21:37:24', 1, 1, 110, '1'),
(5, 'F', '2013-05-07 19:32:53', '2013-05-07 21:51:50', 1, 2, 22100, '1'),
(8, 'F', '2013-05-13 21:44:31', '2013-05-14 10:52:18', 1, 3, 50, '1'),
(9, 'F', '2013-05-14 10:52:41', '2013-06-19 21:21:58', 1, 2, 50, '1'),
(10, 'F', '2013-05-14 20:40:51', '2013-06-19 21:22:07', 1, 2, 300, '1'),
(11, 'A', '2013-06-19 21:22:41', NULL, 1, 1, NULL, NULL),
(12, 'A', '2013-06-20 23:11:25', NULL, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(60) DEFAULT NULL,
  `data_admissao` datetime DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nome_funcionario`, `data_admissao`) VALUES
(1, 'reginaldos', '2013-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `nome_item` varchar(45) DEFAULT NULL,
  `vlr_unitario` float DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id_item`, `nome_item`, `vlr_unitario`) VALUES
(1, 'refrigerante', 50),
(2, 'Kg ComidaS', 220),
(3, 'Prato arroz', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesa`
--

CREATE TABLE IF NOT EXISTS `mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `nro_mesa` int(11) NOT NULL,
  PRIMARY KEY (`id_mesa`),
  UNIQUE KEY `nro_mesa_UNIQUE` (`nro_mesa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `nro_mesa`) VALUES
(3, 20),
(2, 30),
(1, 100),
(4, 333);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `status_pedido`, `CONTA_id_conta`, `entrega_pedido`, `qtd`, `ITEM_id_item`, `descricao_pedido`) VALUES
(12, '2013-05-07 19:39:36', 'E', 4, '2013-05-13 21:35:10', 2, 1, 'coca-cola'),
(13, '2013-05-07 19:41:49', 'E', 5, '2013-05-07 19:44:08', 2, 1, 'EWEW'),
(14, '2013-05-07 20:25:13', 'E', 5, '2013-05-07 20:33:46', 100, 2, '1'),
(16, '2013-05-13 21:33:13', 'E', 4, '2013-05-13 21:35:13', 1, 3, 'prato '),
(17, '2013-05-13 21:44:41', 'E', 8, '2013-05-13 21:47:33', 1, 1, 'a'),
(18, '2013-05-14 10:52:54', 'E', 9, '2013-05-14 11:01:43', 1, 1, 'assa'),
(19, '2013-05-14 20:41:08', 'E', 10, '2013-06-19 21:19:17', 1, 1, ''),
(20, '2013-06-19 21:18:27', 'E', 10, '2013-06-19 21:18:48', 5, 1, '3cocas 2 fantas'),
(21, '2013-06-19 21:23:03', 'P', 11, NULL, 10, 1, 'saiushiuds'),
(22, '2013-06-19 21:23:15', 'P', 11, NULL, 1, 2, '1221');

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
