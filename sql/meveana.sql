-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2015 às 02:02
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `meveana`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(5) unsigned zerofill NOT NULL,
  `nome` varchar(60) NOT NULL,
  `telefone` varchar(9) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `referencia` varchar(60) DEFAULT NULL,
  `nascimento` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `telefone`, `endereco`, `referencia`, `nascimento`) VALUES
(00002, 'FranÃ§ois JÃºnior', '91890377', 'Rua JoÃ£o GregÃ³rio, 1204, Bairro Novo', 'PrÃ³ximo Ã  igreja N. Sra. de FÃ¡tima', '1984-10-25'),
(00004, 'Jacksilene Miguel de Souza Ferreira', '991890376', 'Rua JoÃ£o GregÃ³rio, 1204, Bairro Novo', 'PrÃ³ximo Ã  igreja N. Sra. de FÃ¡tima', '1988-08-24'),
(00005, 'Henrique de Souza Ferreira', '96668032', 'Rua JoÃ£o GregÃ³rio, 1204, Bairro Novo', '', '2015-05-25'),
(00010, 'Helena Santos', '991890377', 'Rua Ulisses Estanislau de Lucena, 517, Bairro Novo', 'PrÃ³ximo ao abrigo dos velhos', '1970-12-01'),
(00011, 'Alison de Andrade', '987453645', '', '', '1981-08-06'),
(00014, 'Adriano Silva', '32711583', 'Rua JoÃ£o GregÃ³rio, 1204, Bairro Novo', 'Lagoa', '1998-02-15'),
(00015, 'Marcio Felipe', '996668032', 'Rua Ulisses Estanislau de Lucena, 517, Bairro Novo', 'Lagoa', '1978-03-15'),
(00016, 'JosÃ© FranÃ§ois Alves Ferreira', '32713057', 'Rua Ulisses Estanislau de Lucena, 517, Bairro Novo', '', '1968-03-27'),
(00017, 'Joseano Dias', '988162722', 'teste', 'teste', '1984-05-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
`id` int(2) unsigned zerofill NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `telefone` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `cnpj`, `endereco`, `telefone`, `email`) VALUES
(01, 'Disk Entregas', '12345678910112', 'Rua Projetada, 124, centro', '32714457', 'contato@diskentregas.com.br'),
(03, 'Central dos Motoboys', '11655245000155', 'Rua nova, 123', '988979845', 'centraldosmotoboys@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregadores`
--

CREATE TABLE IF NOT EXISTS `entregadores` (
`id` int(2) unsigned zerofill NOT NULL,
  `id_empresa` int(2) unsigned zerofill NOT NULL,
  `nome` varchar(60) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `telefone` varchar(9) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `entregadores`
--

INSERT INTO `entregadores` (`id`, `id_empresa`, `nome`, `cpf`, `rg`, `telefone`) VALUES
(01, 01, 'Joao Almeida', '12544754101', '32144547784', '991894451'),
(03, 03, 'Rafael Santos', '05807137418', '2827162', '996668032'),
(04, 03, 'Rafael Santos', '05807137418', '2827162', '996668032');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`id` int(8) unsigned zerofill NOT NULL,
  `id_cliente` int(5) unsigned zerofill NOT NULL,
  `id_entregador` int(2) unsigned zerofill DEFAULT NULL,
  `data_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) NOT NULL DEFAULT 'Pendente',
  `valor_itens` decimal(5,2) NOT NULL,
  `taxa_entrega` decimal(4,2) NOT NULL,
  `valor_pago` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `id_entregador`, `data_hora`, `status`, `valor_itens`, `taxa_entrega`, `valor_pago`) VALUES
(00000001, 00002, NULL, '2015-11-03 19:33:15', 'Pendente', '33.80', '0.00', NULL),
(00000002, 00005, NULL, '2015-11-04 21:17:08', 'Pendente', '23.80', '0.00', NULL),
(00000003, 00016, NULL, '2015-11-04 21:20:47', 'Pendente', '30.90', '0.00', NULL),
(00000004, 00017, NULL, '2015-11-04 21:26:29', 'Pendente', '23.80', '0.00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_itens`
--

CREATE TABLE IF NOT EXISTS `pedidos_itens` (
  `id_pedido` int(8) unsigned zerofill NOT NULL,
  `id_produto` int(4) unsigned zerofill NOT NULL,
  `qtde` int(2) NOT NULL,
  `preco` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`id_pedido`, `id_produto`, `qtde`, `preco`) VALUES
(00000001, 0002, 1, '18.90'),
(00000001, 0003, 1, '14.90'),
(00000002, 0004, 1, '12.00'),
(00000002, 0005, 2, '5.90'),
(00000003, 0002, 1, '18.90'),
(00000003, 0004, 1, '12.00'),
(00000004, 0004, 1, '12.00'),
(00000004, 0005, 2, '5.90');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
`id` int(4) unsigned zerofill NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tamanho` varchar(15) NOT NULL,
  `preco` decimal(4,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `tamanho`, `preco`) VALUES
(0002, 'Pizza Calabresa', 'Pizza de Calabresa com um monte de coisa', 'Grande', '18.90'),
(0003, 'Pizza Ã  moda da casa', 'Recheada de gostosuras', 'MÃ©dia', '14.90'),
(0004, 'Pizza Ã  moda da casa', 'sem descriÃ§Ã£o', 'Pequena', '12.00'),
(0005, 'Pizza Chocolate', 'chocolate', 'Brotinho', '5.90');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entregadores`
--
ALTER TABLE `entregadores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
 ADD UNIQUE KEY `id_pedido_2` (`id_pedido`,`id_produto`), ADD KEY `id_pedido` (`id_pedido`,`id_produto`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
MODIFY `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `entregadores`
--
ALTER TABLE `entregadores`
MODIFY `id` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
MODIFY `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
