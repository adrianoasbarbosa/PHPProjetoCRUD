-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 01:32 AM
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
-- Database: `phpprojeto`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_aluno` (IN `var_id` INT, IN `var_nome` VARCHAR(255), IN `var_email` VARCHAR(255), IN `opcao` INT)   BEGIN
    IF EXISTS(SELECT id FROM aluno WHERE id = var_id) THEN
        IF opcao = 1 THEN
            UPDATE aluno SET nome = var_nome, email = var_email WHERE id = var_id;
        ELSE
            DELETE FROM aluno WHERE id = var_id;
        END IF;
    ELSE
        INSERT INTO aluno VALUES (var_id, var_nome, var_email);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_categoria` (IN `var_id` INT, IN `var_nome` VARCHAR(255), IN `var_descricao` TEXT, IN `opcao` INT)   BEGIN
    IF EXISTS(SELECT id FROM categoria WHERE id = var_id) THEN
        IF opcao = 1 THEN
            UPDATE categoria SET nome = var_nome, descricao = var_descricao WHERE id = var_id;
        ELSE
            DELETE FROM categoria WHERE id = var_id;
        END IF;
    ELSE
        INSERT INTO categoria VALUES (var_id, var_nome, var_descricao);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_equipe` (IN `var_id` INT, IN `var_nome_equipe` VARCHAR(100), IN `var_nr_membros` INT, IN `opcao` INT)   BEGIN
    IF EXISTS(SELECT id FROM equipe WHERE id = var_id) THEN
        IF opcao = 1 THEN
            -- Atualizar equipe existente
            UPDATE equipe SET nome_equipe = var_nome_equipe, nr_membros = var_nr_membros WHERE id = var_id;
        ELSE
            -- Deletar equipe existente
            DELETE FROM equipe WHERE id = var_id;
        END IF;
    ELSE
        -- Inserir nova equipe
        INSERT INTO equipe (id, nome_equipe, nr_membros) VALUES (var_id, var_nome_equipe, var_nr_membros);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_onibus` (IN `var_id` INT, IN `var_modelo` VARCHAR(50), IN `var_lugares` INT, IN `var_destino` VARCHAR(100), IN `opcao` INT)   BEGIN
    IF opcao = 0 THEN
        -- Inserir novo ônibus
        INSERT INTO onibus (id, modelo, lugares, destino) VALUES (var_id, var_modelo, var_lugares, var_destino);
    ELSEIF opcao = 1 THEN
        -- Atualizar ônibus existente
        UPDATE onibus SET modelo = var_modelo, lugares = var_lugares, destino = var_destino WHERE id = var_id;
    ELSEIF opcao = 2 THEN
        -- Deletar ônibus existente
        DELETE FROM onibus WHERE id = var_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_passageiro` (IN `var_id` INT, IN `var_nome` VARCHAR(50), IN `var_data_nascimento` DATE, IN `opcao` INT)   BEGIN
    DECLARE existe_passageiro INT;

    SELECT COUNT(*) INTO existe_passageiro FROM passageiro WHERE id = var_id;

    IF existe_passageiro > 0 THEN
        IF opcao = 1 THEN
            -- Atualizar passageiro existente
            UPDATE passageiro SET nome = var_nome, data_nascimento = var_data_nascimento WHERE id = var_id;
        ELSE
            -- Deletar passageiro existente
            DELETE FROM passageiro WHERE id = var_id;
        END IF;
    ELSE
        -- Inserir novo passageiro
        INSERT INTO passageiro (id, nome, data_nascimento) VALUES (var_id, var_nome, var_data_nascimento);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_produto` (IN `var_id` INT, `var_nome` VARCHAR(50), `var_estoque` INT, `var_valor_unit` DECIMAL(10,2), `var_id_categoria` INT, `opcao` INT)   BEGIN
  IF (EXISTS(SELECT id FROM produto WHERE id = var_id)) THEN
  IF (opcao = 1) THEN
  UPDATE produto SET nome = var_nome, estoque = var_estoque, valor_unit = var_valor_unit, id_categoria = var_id_categoria WHERE id = var_id;
  ELSE
  DELETE FROM produto WHERE id = var_id;
  END IF;
  ELSE
  INSERT INTO produto VALUES (var_id, var_nome, var_estoque, var_valor_unit, var_id_categoria);
  END IF;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_viagem` (IN `var_id_onibus` INT, IN `var_id_passageiro` INT, IN `var_data_viagem` DATE, IN `var_opcao` INT)   BEGIN
    IF var_opcao = 0 THEN
        -- Inserir nova viagem
        INSERT INTO viagem (id_onibus, id_passageiro, data_viagem) VALUES (var_id_onibus, var_id_passageiro, var_data_viagem);
    ELSEIF var_opcao = 1 THEN
        -- Atualizar viagem existente
        UPDATE viagem SET data_viagem = var_data_viagem WHERE id_onibus = var_id_onibus AND id_passageiro = var_id_passageiro;
    ELSEIF var_opcao = 2 THEN
        -- Excluir viagem
        DELETE FROM viagem WHERE id_onibus = var_id_onibus AND id_passageiro = var_id_passageiro;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_aluno` (IN `var_id` INT)   BEGIN
    IF var_id IS NULL THEN
        SELECT * FROM aluno ORDER BY nome;
    ELSE
        SELECT * FROM aluno WHERE id = var_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_categoria` (IN `var_id` INT)   BEGIN
    IF var_id IS NULL THEN
        SELECT * FROM categoria ORDER BY nome;
    ELSE
        SELECT * FROM categoria WHERE id = var_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_equipe` (IN `var_id` INT)   BEGIN
    IF var_id IS NULL THEN
        SELECT * FROM equipe ORDER BY nome_equipe;
    ELSE
        SELECT * FROM equipe WHERE id = var_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_onibus` ()   BEGIN
    SELECT * FROM onibus;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_passageiro` ()   BEGIN
    SELECT * FROM passageiro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_viagem` ()   BEGIN
    SELECT v.id, o.modelo AS modelo_onibus, p.nome AS nome_passageiro, v.data_viagem
    FROM viagem v
    INNER JOIN onibus o ON v.id_onibus = o.id
    INNER JOIN passageiro p ON v.id_passageiro = p.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `email`) VALUES
(4, 'Adriano Barbosa', 'teste@teste.com');

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descricao`) VALUES
(3, 'Eletronico', 'TOp'),
(4, 'sss', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nome_equipe` varchar(100) NOT NULL,
  `nr_membros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id`, `nome_equipe`, `nr_membros`) VALUES
(4, 'Fatec', 90);

-- --------------------------------------------------------

--
-- Table structure for table `equipe_aluno`
--

CREATE TABLE `equipe_aluno` (
  `fk_equipe_id` int(11) NOT NULL,
  `fk_aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipe_aluno`
--

INSERT INTO `equipe_aluno` (`fk_equipe_id`, `fk_aluno_id`) VALUES
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `onibus`
--

CREATE TABLE `onibus` (
  `id` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `lugares` int(11) DEFAULT 44,
  `destino` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `onibus`
--

INSERT INTO `onibus` (`id`, `modelo`, `lugares`, `destino`) VALUES
(1, 'Fiat', 111, 'Saop Paulo'),
(2, 'oi22', 222, 'Curitiba'),
(3, '', 0, ''),
(4, '122', 22, 'Curitiba');

-- --------------------------------------------------------

--
-- Table structure for table `passageiro`
--

CREATE TABLE `passageiro` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passageiro`
--

INSERT INTO `passageiro` (`id`, `nome`, `data_nascimento`) VALUES
(2, 'AAAAAAA', '0023-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `valor_unit` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`id`, `nome`, `estoque`, `valor_unit`, `id_categoria`) VALUES
(2, '', 0, 0.00, NULL),
(4, 'ADRIANO BARBOSA', 12, 1111.00, NULL),
(5, '', 0, 0.00, NULL),
(15, 'ASSSS', 200, 23.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`) VALUES
(1, 'teste@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'admin@admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `viagem`
--

CREATE TABLE `viagem` (
  `id` int(11) NOT NULL,
  `id_onibus` int(11) NOT NULL,
  `id_passageiro` int(11) NOT NULL,
  `data_viagem` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viagem`
--

INSERT INTO `viagem` (`id`, `id_onibus`, `id_passageiro`, `data_viagem`) VALUES
(2, 1, 2, '0022-12-12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_equipe_aluno`
-- (See below for the actual view)
--
CREATE TABLE `view_equipe_aluno` (
`nome_equipe` varchar(100)
,`nome` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_onibus`
-- (See below for the actual view)
--
CREATE TABLE `view_onibus` (
`id` int(11)
,`modelo` varchar(100)
,`lugares` int(11)
,`destino` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_passageiro`
-- (See below for the actual view)
--
CREATE TABLE `view_passageiro` (
`id` int(11)
,`nome` varchar(100)
,`data_nascimento` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_produto`
-- (See below for the actual view)
--
CREATE TABLE `view_produto` (
`ID Produto` int(11)
,`Nome produto` varchar(50)
,`Nome categoria` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_viagem`
-- (See below for the actual view)
--
CREATE TABLE `view_viagem` (
`id` int(11)
,`modelo_onibus` varchar(100)
,`nome_passageiro` varchar(100)
,`data_viagem` date
);

-- --------------------------------------------------------

--
-- Structure for view `view_equipe_aluno`
--
DROP TABLE IF EXISTS `view_equipe_aluno`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_equipe_aluno`  AS SELECT `e`.`nome_equipe` AS `nome_equipe`, `a`.`nome` AS `nome` FROM ((`equipe_aluno` `ea` join `equipe` `e` on(`ea`.`fk_equipe_id` = `e`.`id`)) join `aluno` `a` on(`ea`.`fk_aluno_id` = `a`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_onibus`
--
DROP TABLE IF EXISTS `view_onibus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_onibus`  AS SELECT `onibus`.`id` AS `id`, `onibus`.`modelo` AS `modelo`, `onibus`.`lugares` AS `lugares`, `onibus`.`destino` AS `destino` FROM `onibus` ;

-- --------------------------------------------------------

--
-- Structure for view `view_passageiro`
--
DROP TABLE IF EXISTS `view_passageiro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_passageiro`  AS SELECT `passageiro`.`id` AS `id`, `passageiro`.`nome` AS `nome`, `passageiro`.`data_nascimento` AS `data_nascimento` FROM `passageiro` ;

-- --------------------------------------------------------

--
-- Structure for view `view_produto`
--
DROP TABLE IF EXISTS `view_produto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_produto`  AS SELECT `p`.`id` AS `ID Produto`, `p`.`nome` AS `Nome produto`, `c`.`nome` AS `Nome categoria` FROM (`produto` `p` join `categoria` `c` on(`p`.`id_categoria` = `c`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_viagem`
--
DROP TABLE IF EXISTS `view_viagem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_viagem`  AS SELECT `v`.`id` AS `id`, `o`.`modelo` AS `modelo_onibus`, `p`.`nome` AS `nome_passageiro`, `v`.`data_viagem` AS `data_viagem` FROM ((`viagem` `v` join `onibus` `o` on(`v`.`id_onibus` = `o`.`id`)) join `passageiro` `p` on(`v`.`id_passageiro` = `p`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipe_aluno`
--
ALTER TABLE `equipe_aluno`
  ADD PRIMARY KEY (`fk_equipe_id`,`fk_aluno_id`),
  ADD KEY `fk_aluno_id` (`fk_aluno_id`);

--
-- Indexes for table `onibus`
--
ALTER TABLE `onibus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passageiro`
--
ALTER TABLE `passageiro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viagem`
--
ALTER TABLE `viagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_onibus` (`id_onibus`),
  ADD KEY `id_passageiro` (`id_passageiro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `onibus`
--
ALTER TABLE `onibus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passageiro`
--
ALTER TABLE `passageiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `viagem`
--
ALTER TABLE `viagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipe_aluno`
--
ALTER TABLE `equipe_aluno`
  ADD CONSTRAINT `equipe_aluno_ibfk_1` FOREIGN KEY (`fk_equipe_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `equipe_aluno_ibfk_2` FOREIGN KEY (`fk_aluno_id`) REFERENCES `aluno` (`id`);

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Constraints for table `viagem`
--
ALTER TABLE `viagem`
  ADD CONSTRAINT `viagem_ibfk_1` FOREIGN KEY (`id_onibus`) REFERENCES `onibus` (`id`),
  ADD CONSTRAINT `viagem_ibfk_2` FOREIGN KEY (`id_passageiro`) REFERENCES `passageiro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
