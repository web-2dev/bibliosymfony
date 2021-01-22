-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 22 jan. 2021 à 01:32
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP : 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliosymfony`
--

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`id`, `pseudo`, `roles`, `password`, `prenom`, `nom`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$bnA3cjFacWRlLlh1RkFRVw$9XBDk6qXvh1mevxbXoA97l28w0YB29eKxqf7QfAsc4Q', NULL, NULL),
(2, 'biblio', '[\"ROLE_BIBLIOTHECAIRE\"]', '$argon2id$v=19$m=65536,t=4,p=1$SWdVYUNncHNDcWZoN2NRLg$7aI7qKICJmUaozCiWlth3V8/tZ98n+03i2ybSQqDDWA', NULL, NULL),
(3, 'Chloe', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Undiamd1Ym5IWU5admh1Rw$XkxGBGYvvI3y7JAbMahP+RdUR/jZ3NWkFPv4PGf6/eU', NULL, NULL),
(4, 'Laura', '[\"ROLE_BIBLIOTHECAIRE\"]', '$argon2id$v=19$m=65536,t=4,p=1$bFpPellDZHRoZjI4Q2xRLg$NkE68WTtQt/d0s3FecgAbqPoShiVj+clyffpficZOwM', NULL, NULL),
(5, 'Didier', '[\"ROLE_DEV\"]', '$argon2id$v=19$m=65536,t=4,p=1$bFpPellDZHRoZjI4Q2xRLg$NkE68WTtQt/d0s3FecgAbqPoShiVj+clyffpficZOwM', NULL, NULL),
(7, 'test', '[\"ROLE_USER\",\"ROLE_LECTEUR\"]', '$argon2id$v=19$m=65536,t=4,p=1$eGpHNkZKNmM0eU14YzB0cw$56OuU9p8JP1H0FF4MzWTyxd1cf4vTFMcXKppKpEYorE', 'test', 'test'),
(8, 'Nouveau', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$RGFDcmg2WEt0YjRiNEExbw$2haOUQNe+yc43a2Hj6a8JkUksiHEqQQlul1WhDsVuLU', NULL, NULL),
(9, 'biblio2', '[\"ROLE_BIBLIOTHECAIRE\"]', '$argon2id$v=19$m=65536,t=4,p=1$SWdVYUNncHNDcWZoN2NRLg$7aI7qKICJmUaozCiWlth3V8/tZ98n+03i2ybSQqDDWA', NULL, NULL),
(10, 'peter', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TGpIYmVhckc2NlBZeG5wVg$wXqJg05M8JNCiDjvAcZzwisyxf2Nha0fMzubxhKe6Xs', NULL, NULL);

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `livre_id`, `abonne_id`, `date_emprunt`, `date_retour`) VALUES
(1, 100, 1, '2011-12-17', '2011-12-18'),
(2, 101, 2, '2011-12-18', '2011-12-20'),
(3, 100, 3, '2011-12-19', '2011-12-22'),
(4, 103, 4, '2011-12-19', '2011-12-22'),
(5, 104, 1, '2011-12-19', '2011-12-29'),
(6, 105, 2, '2012-03-20', '2012-03-26'),
(7, 105, 3, '2013-06-13', '2020-04-10'),
(8, 100, 2, '2013-06-15', '2020-04-10'),
(9, 101, 1, '2020-04-10', '2021-01-19'),
(10, 103, 1, '2021-04-10', '2021-01-19'),
(11, 100, 1, '2021-01-01', '2021-01-19'),
(12, 100, 2, '2019-05-01', '2021-01-19'),
(14, 101, 4, '2020-04-27', '2020-04-28'),
(15, 102, 4, '2020-04-28', '2020-04-29'),
(16, 104, 4, '2020-04-29', '2020-04-30'),
(17, 101, 4, '2020-04-30', '2020-05-01'),
(18, 108, 8, '2020-07-23', '2021-01-19'),
(19, 105, 4, '2021-01-12', NULL),
(20, 108, 7, '2021-01-19', '2021-01-19'),
(21, 108, 7, '2021-01-19', '2021-01-19'),
(22, 106, 7, '2021-01-19', NULL),
(23, 108, 7, '2021-01-19', NULL);

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `couverture`) VALUES
(100, 'Une vie', 'Guy de Maupassant', 'Une-vie_600a19c52c778.jpeg'),
(101, 'Bel-Ami', 'Guy de Maupassant', 'Bel-Ami_600a19db24fda.jpeg'),
(102, 'Le père Goriot', 'Honoré de Balzac', NULL),
(103, 'Le petit chose', 'Alphonse Daudet', 'Le-Petit-Chose_600a1a3a8b9d5.jpeg'),
(104, 'La Reine Margot', 'Alexandre Dumas', 'la_reine_margot_600a1a5249631.jpeg'),
(105, 'Les Trois Mousquetaires', 'Alexandre Dumas', 'Les-trois-Mousquetaires_600a1a6644f5b.jpeg'),
(106, 'Dune', 'Frank Herbert', '1-Dune_6005677b94e2d.jpeg'),
(107, 'Fondation', 'Isaac Asimov', '1-Fondation_60056721bcf8f.jpeg'),
(108, 'Je suis une légende', 'Richard Matheson', 'je_suis_une_legende_6005673562e8b.jpeg'),
(109, 'Le Messie de Dune', 'Franck Herbert', '2-Le-Messie-de-Dune_6005676ab6534.jpeg'),
(110, 'Le Jour des Fourmis', 'Bernard Werber', 'Le-jour-des-fourmis_6005678d0f721.jpeg'),
(111, 'Fondation et Empire', 'Isaac Asimov', '2-Fondation-et-empire_600a1ac20e6e5.jpeg'),
(112, 'Les Enfants de Dune', 'Frank Herbert', '3-Les-Enfants-de-Dune_600a1aef89720.jpeg'),
(113, '1984', 'George Orwell', '1984_600a1b3c0e51a.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
