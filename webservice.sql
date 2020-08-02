-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2020 at 06:09 PM
-- Server version: 10.3.23-MariaDB-1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(255) NOT NULL,
  `ifu` int(10) UNSIGNED NOT NULL,
  `raison_social` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `api_active` tinyint(2) NOT NULL DEFAULT 0,
  `tc` int(11) NOT NULL DEFAULT 0,
  `fvc` int(11) NOT NULL DEFAULT 0,
  `frc` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nim`, `ifu`, `raison_social`, `adresse`, `telephone`, `email`, `api_key`, `api_active`, `tc`, `fvc`, `frc`) VALUES
(1, '7854682185', 12547852, 'SUPERMARCHE CENTRAL', 'BOULEVARD D\'ANANAS, COTONOU', ' 21548789', 'info@supercent.bj', 'AZERTYUIOP12345678', 1, 7, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `numOpe` int(11) NOT NULL,
  `nomOpe` varchar(255) NOT NULL,
  `ifu_client` int(11) DEFAULT NULL,
  `nom_client` varchar(255) DEFAULT NULL,
  `cex` varchar(45) DEFAULT NULL,
  `montant_vente` decimal(6,2) NOT NULL DEFAULT 0.00,
  `montant_ht` decimal(6,2) NOT NULL DEFAULT 0.00,
  `montant_taxe` decimal(6,2) NOT NULL DEFAULT 0.00,
  `taxe_spec` decimal(6,2) DEFAULT 0.00,
  `sig` varchar(255) DEFAULT NULL,
  `statut` tinyint(4) DEFAULT 0,
  `entreprises_id` int(10) UNSIGNED NOT NULL,
  `typeFacture_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id`, `token`, `date`, `numOpe`, `nomOpe`, `ifu_client`, `nom_client`, `cex`, `montant_vente`, `montant_ht`, `montant_taxe`, `taxe_spec`, `sig`, `statut`, `entreprises_id`, `typeFacture_id`) VALUES
(1, 'ALPHA785421', '2020-07-31 12:49:58', 785622, 'Joseph', 125896452, 'Jean', '1', '6500.00', '6500.00', '7500.00', '0.00', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `moyenPayements`
--

CREATE TABLE `moyenPayements` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(1) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moyenPayements`
--

INSERT INTO `moyenPayements` (`id`, `code`, `libelle`) VALUES
(1, 'V', 'Virement'),
(2, 'C', 'carte bancaire'),
(3, 'M', 'Mobile Money'),
(4, 'D', 'Chèques'),
(5, 'E', 'Espèces(cash)'),
(6, 'A', 'autre');

-- --------------------------------------------------------

--
-- Table structure for table `produitFacture`
--

CREATE TABLE `produitFacture` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prix` decimal(6,2) NOT NULL,
  `quantite` decimal(6,2) NOT NULL DEFAULT 1.00,
  `taxe_spec` decimal(6,2) DEFAULT NULL,
  `desc_taxe_spec` varchar(255) DEFAULT NULL,
  `prix_orig` decimal(6,2) DEFAULT NULL,
  `desc_prix` varchar(255) DEFAULT NULL,
  `montant_ht` decimal(6,2) NOT NULL,
  `montant_taxe` decimal(6,2) NOT NULL,
  `factures_id` int(10) UNSIGNED NOT NULL,
  `taxes_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produitFacture`
--

INSERT INTO `produitFacture` (`id`, `nom`, `description`, `prix`, `quantite`, `taxe_spec`, `desc_taxe_spec`, `prix_orig`, `desc_prix`, `montant_ht`, `montant_taxe`, `factures_id`, `taxes_id`) VALUES
(1, 'EAU Viva', 'EAU Viva (l\'eau minérale)', '450.00', '3.00', NULL, NULL, NULL, NULL, '450.00', '780.00', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reglementFacture`
--

CREATE TABLE `reglementFacture` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant` decimal(25,2) NOT NULL,
  `moyenPayements_id` int(10) UNSIGNED NOT NULL,
  `factures_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reglementFacture`
--

INSERT INTO `reglementFacture` (`id`, `montant`, `moyenPayements_id`, `factures_id`) VALUES
(1, '8000.00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `serveurMcf`
--

CREATE TABLE `serveurMcf` (
  `doc_telecharger` int(11) NOT NULL DEFAULT 0,
  `doc_disponible` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `entreprise_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serveurMcf`
--

INSERT INTO `serveurMcf` (`doc_telecharger`, `doc_disponible`, `date`, `entreprise_id`) VALUES
(0, 0, '2020-07-23 20:35:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(1) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `valeur` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `code`, `libelle`, `valeur`) VALUES
(1, 'A', 'Exonéré', '2.00'),
(4, 'B', 'Taxable', '1.00'),
(5, 'C', 'Exportation de produits taxables', '1.00'),
(6, 'D', 'TVA régime d’exception', '1.00'),
(7, 'E', 'Régime fiscal TPS', '1.00'),
(8, 'F', 'Réservé, en cas de taxe de séjour', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `typeFacture`
--

CREATE TABLE `typeFacture` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(2) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeFacture`
--

INSERT INTO `typeFacture` (`id`, `code`, `libelle`) VALUES
(1, 'FV', 'Facture de vente'),
(2, 'CV', 'Copie de la dernière Facture de vente'),
(3, 'EV', 'Facture de vente à l’exportation'),
(4, 'EC', 'Copie de la dernière Facture de vente à l’exportation'),
(5, 'FA', 'Facture d’avoir'),
(6, 'CA', 'Copie de la dernière facture d’avoir'),
(7, 'EA', 'Facture d’avoir à l’exportation'),
(8, 'ER', 'Copie de la dernière Facture d’avoir à l\'exportation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `api_key_UNIQUE` (`api_key`),
  ADD UNIQUE KEY `ifu` (`ifu`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`,`entreprises_id`,`typeFacture_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_factures_entreprises_idx` (`entreprises_id`),
  ADD KEY `fk_factures_typeFacture1_idx` (`typeFacture_id`);

--
-- Indexes for table `moyenPayements`
--
ALTER TABLE `moyenPayements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `produitFacture`
--
ALTER TABLE `produitFacture`
  ADD PRIMARY KEY (`id`,`factures_id`,`taxes_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_produitFacture_factures1_idx` (`factures_id`),
  ADD KEY `fk_produitFacture_taxes1_idx` (`taxes_id`);

--
-- Indexes for table `reglementFacture`
--
ALTER TABLE `reglementFacture`
  ADD PRIMARY KEY (`id`,`moyenPayements_id`,`factures_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_reglementFacture_moyenPayements1_idx` (`moyenPayements_id`),
  ADD KEY `fk_reglementFacture_factures1_idx` (`factures_id`);

--
-- Indexes for table `serveurMcf`
--
ALTER TABLE `serveurMcf`
  ADD KEY `entreprise_id` (`entreprise_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeFacture`
--
ALTER TABLE `typeFacture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `moyenPayements`
--
ALTER TABLE `moyenPayements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produitFacture`
--
ALTER TABLE `produitFacture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reglementFacture`
--
ALTER TABLE `reglementFacture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `typeFacture`
--
ALTER TABLE `typeFacture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `fk_factures_entreprises` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factures_typeFacture1` FOREIGN KEY (`typeFacture_id`) REFERENCES `typeFacture` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produitFacture`
--
ALTER TABLE `produitFacture`
  ADD CONSTRAINT `fk_produitFacture_factures1` FOREIGN KEY (`factures_id`) REFERENCES `factures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produitFacture_taxes1` FOREIGN KEY (`taxes_id`) REFERENCES `taxes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reglementFacture`
--
ALTER TABLE `reglementFacture`
  ADD CONSTRAINT `fk_reglementFacture_factures1` FOREIGN KEY (`factures_id`) REFERENCES `factures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reglementFacture_moyenPayements1` FOREIGN KEY (`moyenPayements_id`) REFERENCES `moyenPayements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `serveurMcf`
--
ALTER TABLE `serveurMcf`
  ADD CONSTRAINT `serveurMcfEntrep` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
