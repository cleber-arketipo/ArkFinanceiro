-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `arketipo_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `nome`, `email`, `login`, `senha`) VALUES
(1, 'Cleber', 'cleber@arketipo.com.br', 'cleber', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(100) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `documento` varchar(18) NOT NULL,
  `ie` varchar(30) DEFAULT NULL,
  `cep` char(10) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(120) DEFAULT NULL,
  `cidade` varchar(120) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `responsavel` varchar(80) DEFAULT NULL,
  `tipo` enum('PJ','PF') NOT NULL,
  `ramo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documento_UNIQUE` (`documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `razao_social`, `nome`, `documento`, `ie`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `telefone`, `celular`, `responsavel`, `tipo`, `ramo`) VALUES
(0000000002, 'razao', 'nome', '14.213.224/0001-96', '12345', '85.065-140', 'Rua Desembargador ErnÃ¢ni Guarita Cartaxo', '451', 'Alto da XV', 'Guarapuava', 'PR', '(42) 36230873', '(42) 99496271', 'repsonsavel', 'PJ', 'ramo'),
(0000000003, '', 'cleber', '044.630.539-19', '', '85.010-130', 'Rua Coronel Saldanha', '1780', 'Centro', 'Guarapuava', 'PR', '(42) 36230873', '(42) 999645119', '', 'PF', 'ramo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_caixa`
--

CREATE TABLE IF NOT EXISTS `controle_caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `tipo` enum('Entrada','Saída') NOT NULL,
  `conta` varchar(100) NOT NULL,
  `grupo` varchar(45) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `situacao` enum('Previsto','Realizado') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(100) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `documento` varchar(18) DEFAULT NULL,
  `ie` varchar(30) DEFAULT NULL,
  `cep` char(10) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(120) DEFAULT NULL,
  `cidade` varchar(120) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `responsavel` varchar(80) DEFAULT NULL,
  `tipo` enum('PJ','PF') NOT NULL,
  `ramo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `nome`) VALUES
(1, 'Aluguel'),
(2, 'Jobs Avulsos'),
(3, 'Contrato'),
(4, 'Energia'),
(5, 'Telefone'),
(6, 'Recursos Humanos'),
(7, 'Material de Expediente'),
(8, 'Despesas VariÃ¡veis'),
(9, 'Investimentos'),
(10, 'CombustÃ­vel'),
(11, 'ComissÃµes'),
(12, 'Tributos Federais'),
(13, 'Tributos Estaduais');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
