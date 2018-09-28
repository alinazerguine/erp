-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 17 sep. 2018 à 17:59
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `erp_digiseed`
--

-- --------------------------------------------------------

--
-- Structure de la table `erp_caution_sites`
--

CREATE TABLE `erp_caution_sites` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `caution_reference` varchar(100) DEFAULT NULL,
  `admin_provional_accpt_date` date DEFAULT NULL,
  `financial_provional_accpt_date` date DEFAULT NULL,
  `duration_for_final_acceptance` int(11) DEFAULT NULL,
  `admin_final_accpt_date` date DEFAULT NULL,
  `financial_final_accpt_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_caution_sites`
--

INSERT INTO `erp_caution_sites` (`id`, `site_id`, `caution_reference`, `admin_provional_accpt_date`, `financial_provional_accpt_date`, `duration_for_final_acceptance`, `admin_final_accpt_date`, `financial_final_accpt_date`, `created_at`) VALUES
(1, 3, 'xxxxxxxx', '2018-08-21', '2018-08-30', 1, '2019-08-21', '2019-08-30', '2018-08-17 16:24:59'),
(2, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-21 13:31:05'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-17 12:05:11');

-- --------------------------------------------------------

--
-- Structure de la table `erp_cron_documents`
--

CREATE TABLE `erp_cron_documents` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `document_url` text NOT NULL,
  `purchase` double NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_cron_documents`
--

INSERT INTO `erp_cron_documents` (`id`, `reference_no`, `supplier_name`, `document_url`, `purchase`, `created`) VALUES
(1, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a22391b6-22c1-4f19-a55e-5a3624796de4&_Division_=249534', 152.87, '2017-12-09'),
(2, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=cdeb10d4-9437-4e21-be7a-a64be147b60b&_Division_=249534', 120.9, '2018-02-24'),
(3, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a060f37f-a505-476d-989d-13e434848e85&_Division_=249534', 53.85, '2017-06-24'),
(4, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=779895de-10bb-4db3-a992-ee39c7e42238&_Division_=249534', 97.71, '2017-12-16'),
(5, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8cd33f48-5aed-41c9-822e-f14e71146a15&_Division_=249534', 74.97, '2017-12-09'),
(6, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a7e7d694-b9b0-469d-a477-46b9a0380b4c&_Division_=249534', 221.08, '2017-06-30'),
(7, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=60d8674c-304e-4834-a2a6-2c4e1f7d5899&_Division_=249534', 148.45, '2017-06-11'),
(8, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=28865592-3214-4fd0-a0de-0ff45091320e&_Division_=249534', 188.05, '2017-08-31'),
(9, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=447ca72c-1dfb-465f-9047-4d67c39192c7&_Division_=249534', 137.75, '2017-06-11'),
(10, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1914ec68-4cde-4350-ae7d-feb0c37015f0&_Division_=249534', 215.97, '2017-08-26'),
(11, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=382c2b18-f831-4231-8eab-558689b35d61&_Division_=249534', 680.39, '2017-10-21'),
(12, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1d84951d-69ae-4e4e-be6b-dba97edfc84c&_Division_=249534', 337.04, '2017-06-24'),
(13, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a0eaf73f-5a5a-4b73-9edb-8d614a9871fb&_Division_=249534', 7.88, '2017-12-08'),
(14, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=838a27ec-aa0a-4df8-8fd0-9663ec8ab154&_Division_=249534', 52.43, '2018-02-17'),
(15, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=27cbd7bb-88eb-4fa2-baba-688a70fe8601&_Division_=249534', 225.67, '2017-10-28'),
(16, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=309d45c2-b5f9-4c81-8d58-1ee79e93683c&_Division_=249534', 329.59, '2017-06-11'),
(17, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=73218cf7-edc6-47b3-90cb-3b99b769eff9&_Division_=249534', 544.4, '2017-11-18'),
(18, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7a492d83-ec05-45a9-9bd3-0bc463a2af49&_Division_=249534', 429.52, '2017-10-31'),
(19, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=39a210c4-9a42-4f7f-8b3e-a2c068621554&_Division_=249534', 71.49, '2018-01-13'),
(20, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=23ae02f7-d112-4482-91d5-985047c485e4&_Division_=249534', 111.4, '2017-12-24'),
(21, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ccde04fc-b123-483b-a132-cfa246716706&_Division_=249534', 4387.57, '2017-11-29'),
(22, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7047ce56-2267-4317-b653-fe124e3eff3d&_Division_=249534', 1025.56, '2017-11-25'),
(23, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0f6d3bef-3fd6-4dfd-a6dc-aa533aa72354&_Division_=249534', 21.63, '2017-08-26'),
(24, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=64b5d84b-eeb9-4298-a9df-e03af677fd21&_Division_=249534', 286.71, '2017-10-28'),
(25, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3ebb9bd6-f1ab-4dba-8dd0-2701b7ed9247&_Division_=249534', 656.4, '2017-08-19'),
(26, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=96a9b355-6d40-4923-a598-4bf3b392aba8&_Division_=249534', 1708.28, '2017-12-16'),
(27, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=60d8674c-304e-4834-a2a6-2c4e1f7d5899&_Division_=249534', 148.45, '2017-06-11'),
(28, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8bb9a317-cd37-4250-9812-3ba575fcd9ef&_Division_=249534', 48.62, '2017-06-17'),
(29, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=bc304f83-c3f4-49d8-aada-d09f831037f6&_Division_=249534', 55.97, '2017-11-30'),
(30, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=219142cb-6ae1-4f31-a6ca-3f46ba8d0859&_Division_=249534', 96.81, '2017-06-24'),
(31, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=9c7b348d-a18c-4dfc-8aa9-ffbf3e8e6ec2&_Division_=249534', 31.3, '2018-01-31'),
(32, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=04cbc2d7-049e-41f6-99a3-56eb3127f482&_Division_=249534', 700.57, '2017-08-26'),
(33, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=e4e86f78-50fe-48b7-9f63-71b5309beba4&_Division_=249534', 13.89, '2018-02-17'),
(34, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d14646d5-ed56-4489-867d-0441eae9b632&_Division_=249534', 1400.96, '2017-09-09'),
(35, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ec352219-3564-41de-932e-d30610d88086&_Division_=249534', 2398.22, '2017-06-30'),
(36, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=41d057e2-a87d-43aa-9611-509bb4194632&_Division_=249534', 204.09, '2017-06-30'),
(37, '17-006', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=41f46348-30b6-4b41-9b3e-9d95e310ac7e&_Division_=249534', 445.86, '2017-09-09'),
(38, '17-006', 'Bemac SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3116437a-bbab-41c5-ab67-f97e3c8e67aa&_Division_=249534', 550, '2017-12-19'),
(39, '17-006', 'Bemac SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=607b5d13-26f0-412d-9f0e-fa021326c16d&_Division_=249534', 2003.65, '2017-11-17'),
(40, '17-006', 'Bemac SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=9c55be29-3139-4182-a20f-c213c1ab2922&_Division_=249534', 2042.18, '2017-10-31'),
(41, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a67fc770-0884-4101-8948-3a677199779c&_Division_=249534', 261, '2017-08-22'),
(42, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0376a915-8841-43df-85d5-a5f107366bfe&_Division_=249534', 261, '2017-06-29'),
(43, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ca0acca1-105a-40ff-bdf1-9a103dbbcc2f&_Division_=249534', 1821.34, '2017-12-27'),
(44, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5688693f-5c90-4d2a-89b0-c15b545dc64e&_Division_=249534', 239.66, '2017-05-31'),
(45, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=e7b3f201-c17d-4e50-83b3-1c9df3fa7bf2&_Division_=249534', 286.09, '2017-07-12'),
(46, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=f95a85a8-3bf1-44c5-be72-bc5849a18eee&_Division_=249534', 57.98, '2018-02-28'),
(47, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=73041153-0bd6-4e72-82c7-b3c60cc3bf97&_Division_=249534', 52.2, '2017-10-25'),
(48, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=f6ccbaf1-9f07-49a9-8d4b-f1de5c2f68c3&_Division_=249534', 99.38, '2017-08-11'),
(49, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0ac21a72-81c4-4cae-8f62-6e835712f249&_Division_=249534', 146.36, '2017-09-20'),
(50, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b1be70de-9d39-46df-87fa-3a9ab6161675&_Division_=249534', 57.98, '2018-02-28'),
(51, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=796ab84e-ed37-44cc-a0c7-0b6241d28611&_Division_=249534', 13.02, '2018-02-28'),
(52, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c69cb837-5d1f-4928-8bea-e400d8f47fdc&_Division_=249534', 29.11, '2018-02-12'),
(53, '17-006', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7fe0f4ec-2c18-4852-9114-5625da6ea19d&_Division_=249534', 23.17, '2018-02-20'),
(54, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a9df8127-a2fb-4c06-839b-fdeaaa0499f9&_Division_=249534', 1431.01, '2017-11-09'),
(55, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=6fd68804-bd10-410a-803a-e809d381259f&_Division_=249534', 378, '2017-12-08'),
(56, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7d5976f9-159d-490f-b7ec-e26cd32a97e2&_Division_=249534', 242.99, '2018-02-09'),
(57, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2c5aca21-65a0-440c-9cac-3643b9d9a747&_Division_=249534', 1071.77, '2017-12-15'),
(58, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=22083734-3b4f-4218-876c-2d2707d86e83&_Division_=249534', 56.58, '2017-11-17'),
(59, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2811e19b-cef9-4696-9789-5942cb282797&_Division_=249534', 1226.78, '2017-11-09'),
(60, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=994cd86c-cbac-4d2d-ac04-885a9f22532f&_Division_=249534', 6073.18, '2017-10-27'),
(61, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=993ed3c8-79f6-43be-b4d1-04be26b4b881&_Division_=249534', 1471.36, '2017-10-27'),
(62, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1d493229-7943-4a51-b2ca-5cf34c84278e&_Division_=249534', 171.08, '2017-11-09'),
(63, '17-006', 'FEILO SYLVANIA BELGIUM BVBA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b73183e5-af71-4331-b78e-736024fac5ff&_Division_=249534', 110.98, '2018-01-19'),
(64, '17-006', 'Lixero Retail B.V.', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=bef3110b-d032-45b3-8182-a298b036d872&_Division_=249534', 79.19, '2018-02-21'),
(65, '17-006', 'Lixero Retail B.V.', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=82250140-6096-494b-8c20-b53ea9cb609f&_Division_=249534', 143.38, '2018-02-22'),
(66, '17-006', 'Lixero Retail B.V.', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=bef3110b-d032-45b3-8182-a298b036d872&_Division_=249534', 79.19, '2018-02-21'),
(67, '17-006', 'Came Benelux Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=419f607d-9446-40c2-b28d-6b20b76537df&_Division_=249534', 357.76, '2018-01-05'),
(68, '17-006', 'Came Benelux Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5d25a4c8-02af-4198-ab07-c7215e8c55e3&_Division_=249534', 409.97, '2018-03-16'),
(69, '17-006', 'Came Benelux Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5d25a4c8-02af-4198-ab07-c7215e8c55e3&_Division_=249534', 409.97, '2018-03-16'),
(70, '17-006', 'Came Benelux Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5d25a4c8-02af-4198-ab07-c7215e8c55e3&_Division_=249534', 409.97, '2018-03-16'),
(71, '17-006', 'Came Benelux Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=419f607d-9446-40c2-b28d-6b20b76537df&_Division_=249534', 357.76, '2018-01-05'),
(72, '17-006', 'Technisch Bureau Verbruggnen VZW', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0b99cf00-9629-4f3c-80ac-9594675ecfd4&_Division_=249534', 391.17, '2018-01-31'),
(73, '17-006', 'Technisch Bureau Verbruggnen VZW', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=24b9911b-dd0d-4490-8dfd-0b0ab6822bd5&_Division_=249534', 146.7, '2018-02-23'),
(74, '17-006', 'Alarme De Clerck', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=44a4f511-69ef-42cc-ae25-d507644de55f&_Division_=249534', 7620, '2018-02-23'),
(75, '17-006', 'Cebeo Nv Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8b2c2a4a-f892-49f9-8b16-ed5391ba70f5&_Division_=249534', 164.73, '2017-07-17'),
(76, '17-006', 'Cebeo Nv Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=42f9e78c-6025-45aa-949a-583e08fbad70&_Division_=249534', 4421.65, '2017-06-19'),
(77, '17-006', 'Cebeo Nv Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=6501357c-4b0f-46db-9c82-cfd309cd989d&_Division_=249534', 1100.33, '2017-08-28'),
(78, '17-006', 'Cebeo Nv Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3bea36d4-6870-43d1-9225-f63647dba536&_Division_=249534', 15750.03, '2017-07-10'),
(79, '17-006', 'PROSECO S.A.', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3d8c8a43-e0be-4e96-ad58-7e330a3fc506&_Division_=249534', 585.31, '2017-10-13'),
(80, '17-006', 'VANCOPENOLLE ET FILS SPRL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0a6c5417-bc32-4210-8298-7fe2385a505a&_Division_=249534', 283.14, '2017-11-28'),
(81, '17-006', 'Bricourcelles Sprl', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=bab9439b-b0b6-4714-8a72-b9085e855038&_Division_=249534', 16.7, '2017-11-08'),
(82, '17-006', 'Lixero Projects BV', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=35259c50-4ce5-4f02-8ac3-b28837812a82&_Division_=249534', 2804.69, '2017-12-08'),
(83, '17-006', 'Induscabel S.A.', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=f8d9d455-1411-4795-a751-3578f3cd32ac&_Division_=249534', 21.88, '2017-06-22'),
(84, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b7769167-189a-4bed-8e86-dbb634663add&_Division_=249534', 693.97, '2017-12-09'),
(85, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ff2b84d2-0e82-4e9e-806d-7871de67c0a4&_Division_=249534', 854.12, '2017-12-09'),
(86, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a2e9bc9c-2ab9-4f85-bad9-bc460adb2627&_Division_=249534', 79.82, '2017-12-24'),
(87, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=dbb3905c-3279-45d3-8632-22c4f3c9c7eb&_Division_=249534', 88.86, '2018-02-10'),
(88, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ad406193-e916-4c90-9207-64f7109668d2&_Division_=249534', 718.57, '2017-09-09'),
(89, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=e6f6664c-bc62-4715-a492-c6b064bf0f3a&_Division_=249534', 277.28, '2017-10-28'),
(90, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2a00c00e-bd4c-4e1c-b73c-0c9b2954f6ef&_Division_=249534', 984.73, '2017-10-07'),
(91, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0cf504f3-df72-4b84-aa3a-2de8c01fc945&_Division_=249534', 11.92, '2017-09-17'),
(92, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=598d07af-6c82-4745-be05-4f925dc28acb&_Division_=249534', 56.69, '2018-01-20'),
(93, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=126750ac-7a81-4e15-9d3d-d7713334c7ed&_Division_=249534', 59.16, '2017-12-09'),
(94, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8900a7fa-7430-479f-8cec-e5d816720840&_Division_=249534', 363.79, '2017-11-11'),
(95, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=929d78aa-82cb-44db-b810-458145b64f7c&_Division_=249534', 77.77, '2017-10-28'),
(96, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=fd4ad74a-2d08-441b-bc60-3b78b9e818d2&_Division_=249534', 13, '2018-02-17'),
(97, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5fb32aa2-c2be-41ff-86f2-b59407f7b20c&_Division_=249534', 184.78, '2017-11-11'),
(98, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d7ef1bda-69b4-4cc9-928e-c4bb2ff8d4a9&_Division_=249534', 1432.35, '2017-08-26'),
(99, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=4a8fd220-fc12-4c9c-819b-a24fdebe3282&_Division_=249534', 795.61, '2017-09-17'),
(100, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0963e3d9-73af-475c-9a37-790807d2b155&_Division_=249534', 13.25, '2017-09-23'),
(101, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0eb67752-b1c4-4cba-9c50-a858eb3b0c8f&_Division_=249534', 65.81, '2018-01-20'),
(102, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ffcd7d27-7ece-41f6-ba2e-aa6c6ad8b723&_Division_=249534', 759.19, '2017-12-09'),
(103, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c1556690-6163-48a3-933d-90bbf2a2f796&_Division_=249534', 113.05, '2018-02-10'),
(104, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=f9627e63-4f63-4690-a88d-d4ab52c61065&_Division_=249534', 927.81, '2017-11-18'),
(105, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=73fdab48-c989-4d3e-973f-24ec50a464a1&_Division_=249534', 1857.9, '2017-08-31'),
(106, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d49b4d3b-aaed-4384-9b43-6972b0f8d1ad&_Division_=249534', 1262.31, '2017-11-25'),
(107, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=37c3cca6-f4c8-4762-91e7-7657d8c517d3&_Division_=249534', 60.85, '2017-11-18'),
(108, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=698e2325-b8b0-4ac4-98e8-c5a52123beb8&_Division_=249534', 87.2, '2018-02-17'),
(109, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8fec624c-2d2e-4cc2-88f3-ff26fe8712b5&_Division_=249534', 868.48, '2017-11-30'),
(110, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b8979b4b-727e-47ae-98de-8362f257d903&_Division_=249534', 323.22, '2018-02-10'),
(111, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1af5b6fa-4d05-4d3e-80db-b4b4fbac02be&_Division_=249534', 93.81, '2017-11-18'),
(112, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=579ad560-78b1-4824-ac9c-e363cb6f4938&_Division_=249534', 193.75, '2017-11-30'),
(113, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1643f838-e9fd-423a-85c4-551e9b5e1a18&_Division_=249534', 190.37, '2017-10-14'),
(114, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a325f204-046b-43b0-917c-aaf00f14a8d5&_Division_=249534', 1487.01, '2017-10-14'),
(115, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d53c5eb9-9dcf-4be2-ba59-b4971ee68197&_Division_=249534', 39.6, '2017-10-21'),
(116, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1e01deee-ebff-43a0-8bd8-20d3d30c254f&_Division_=249534', 1559.47, '2017-11-25'),
(117, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=e61b9d47-a8eb-466b-8d51-85669073a4ef&_Division_=249534', 2799.25, '2017-10-21'),
(118, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ae13eb08-66e6-40a1-b89b-0e4d76b04825&_Division_=249534', 250.53, '2017-10-14'),
(119, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b7feceab-1666-4686-94fe-19b9199d9028&_Division_=249534', 11.87, '2017-11-11'),
(120, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=20b70fa5-a03f-499e-8ba7-a2cfc3252226&_Division_=249534', 250.23, '2017-10-07'),
(121, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=39cdeec5-37f6-423a-ac5b-685ac583b00d&_Division_=249534', 411, '2017-11-11'),
(122, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8256037a-f3a2-414b-951f-9fa338008e67&_Division_=249534', 3.86, '2017-09-30'),
(123, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=4c03cda3-065e-41ed-8722-8d45d51c478c&_Division_=249534', 2175.3, '2017-09-09'),
(124, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=54f5abcb-6f13-4c34-97f2-4b5d5de0f91d&_Division_=249534', 276.09, '2017-10-14'),
(125, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c9c4b677-5c35-456f-90fe-cbaa66679eba&_Division_=249534', 254.57, '2017-09-23'),
(126, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ffabdc0f-c8a6-4869-876a-bfb92a835135&_Division_=249534', 702.72, '2017-11-18'),
(127, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a1335790-0bf0-4887-9428-048f31dc7296&_Division_=249534', 45.08, '2017-10-14'),
(128, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a02dc2a8-f227-4b22-aabd-573e790c0a3b&_Division_=249534', 1422.08, '2017-10-28'),
(129, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2145bce0-8456-48ab-ad5f-f7ab99344a67&_Division_=249534', 185.61, '2017-09-30'),
(130, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=41b513a0-94ff-4d75-bf9b-08814208e237&_Division_=249534', 543.78, '2017-11-25'),
(131, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=19735771-c6ef-4704-91e5-c455aa41398b&_Division_=249534', 2224.56, '2017-09-30'),
(132, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5e4e1edc-4b89-4c33-9c8b-23608216f8b0&_Division_=249534', 217.8, '2017-12-09'),
(133, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=42e3b651-ed42-4235-8cf3-d7c0cdb6bbcf&_Division_=249534', 44.92, '2017-12-09'),
(134, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=92321e4b-208f-42fe-b81f-65752e99da9f&_Division_=249534', 1921.01, '2017-08-26'),
(135, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0c0fdc6d-36d5-4558-8c09-15a73a147127&_Division_=249534', 3667.67, '2017-10-31'),
(136, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=283b96ed-5432-461c-922e-5f379c435bb7&_Division_=249534', 59.83, '2017-09-09'),
(137, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1da01843-ea4a-4a94-af2f-a951a8500f8a&_Division_=249534', 27, '2017-08-26'),
(138, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3ca053d3-aabb-4f0d-beba-cb09dcb2b1dd&_Division_=249534', 439.27, '2017-09-17'),
(139, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=87f9886f-6f15-4cbf-99af-d293853a616d&_Division_=249534', 730.8, '2017-12-09'),
(140, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8e92b6ed-f917-42cc-958f-51fbba5b10ae&_Division_=249534', 87.68, '2017-11-25'),
(141, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=965b5bc4-8362-4dfb-9bc9-e9544c09c5ba&_Division_=249534', 1171.98, '2017-12-16'),
(142, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=ae862ec7-c4e0-47ef-b1ba-40c18ad64f12&_Division_=249534', 48.21, '2017-11-18'),
(143, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=548cb281-bd37-4d15-9b15-ddfddb8a6263&_Division_=249534', 400.4, '2017-11-18'),
(144, '17-081', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a139c54e-8ad8-4f6e-aa4c-56b0353a0a87&_Division_=249534', 3012.36, '2017-11-11'),
(145, '17-081', 'Linergy Benelux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d170f4b0-cd96-4a59-b647-0768e6bf2c2a&_Division_=249534', 439.54, '2017-11-30'),
(146, '17-081', 'Linergy Benelux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=f0ea7c8a-c761-4165-8c18-8c4fc8d53311&_Division_=249534', 191.2, '2018-04-11'),
(147, '17-081', 'Linergy Benelux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=9586be9f-f69d-44cd-b282-08ee94a8a89a&_Division_=249534', 293.03, '2017-11-16'),
(148, '17-081', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3959a0f2-5ce5-4b39-983e-3ea1225ee08a&_Division_=249534', 3842.21, '2018-02-14'),
(149, '17-081', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2ab9a22a-6f9f-464b-aa2a-9d167be6f4c4&_Division_=249534', 10555.83, '2017-11-15'),
(150, '17-081', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d3f79e8f-6e05-40dd-861e-7f182e5233f0&_Division_=249534', 159.72, '2017-11-30'),
(151, '17-081', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d7ece1d1-186f-4713-badf-ff4029730f62&_Division_=249534', 521.99, '2017-09-20'),
(152, '17-081', 'Technisch Bureau Verbruggnen VZW', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=cbceacd5-26a7-4874-9109-f70adbf98ab7&_Division_=249534', 178.86, '2018-01-29'),
(153, '17-081', 'BALASANU, MARIUS', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1da1bcc4-5a8a-4a54-b30a-faca99975091&_Division_=249534', 273, '2017-12-01'),
(154, '17-081', 'BALASANU, MARIUS', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7e2bb86b-7858-492d-a3f9-2b6ad3d0f63a&_Division_=249534', 3390, '2018-03-01'),
(155, '17-081', 'BALASANU, MARIUS', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=12cfccb0-56ca-41c9-bca4-a2e92fc7e3df&_Division_=249534', 4627, '2017-10-02'),
(156, '17-081', 'AGAVRILOAIE, GABRIEL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=75ec8028-becb-4972-9a09-ee6e4127e628&_Division_=249534', 5733, '2018-01-03'),
(157, '17-081', 'AGAVRILOAIE, GABRIEL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=005a3f41-90d9-42c8-af64-3f8a3be51722&_Division_=249534', 7765.5, '2018-03-04'),
(158, '17-081', 'AGAVRILOAIE, GABRIEL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=0d694f51-743c-4930-9e27-02235693c5f0&_Division_=249534', 4543, '2017-10-01'),
(159, '17-081', 'AGAVRILOAIE, GABRIEL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=6c5a6b87-d5a1-495b-b155-2a6f95049e5f&_Division_=249534', 2102, '2017-10-28'),
(160, '17-081', 'AGAVRILOAIE, GABRIEL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=cdf2e365-12c2-4ff8-a518-28a76e5b3cac&_Division_=249534', 1197, '2017-12-03'),
(161, '17-081', 'Facq Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2aa4f67e-e84c-4589-b63e-37a6e82c72a5&_Division_=249534', 53.24, '2017-08-24'),
(162, '17-081', 'BANTUS MIHAIL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d2b2e1e6-c808-402c-9ac5-e50f7a6d6bfa&_Division_=249534', 4627, '2017-10-01'),
(163, '17-081', 'BANTUS MIHAIL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=792bcf61-3c2e-4ce3-b341-b3391c923ae1&_Division_=249534', 2102, '2017-10-28'),
(164, '17-081', 'BANTUS MIHAIL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=08b77bf9-a08d-42b0-9938-645370aa9485&_Division_=249534', 357, '2017-12-01'),
(165, '17-081', 'BANTUS MIHAIL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=2f75ac36-ef12-4962-8935-e6e7516da912&_Division_=249534', 3390, '2018-03-01'),
(166, '17-081', 'BUREAU TECHNIQUE VERBRUGGHEN ASBL', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=97025550-d062-484b-8db1-28e810fffca9&_Division_=249534', 178.86, '2017-12-01'),
(167, '17-081', 'Lixero Projects BV', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d34776d9-3f11-469d-8874-f5366584967d&_Division_=249534', 497.68, '2017-11-10'),
(168, '17-081', 'Cebeo Nv Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=6501357c-4b0f-46db-9c82-cfd309cd989d&_Division_=249534', 1100.33, '2017-08-28'),
(169, '17-082', 'Bricourcelles Sprl', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=5868c229-ac98-4db0-9013-574340473c3e&_Division_=249534', 33.95, '2017-09-19'),
(170, '17-082', 'Fernand Georges Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c1be548b-5ab3-4bb9-a60d-8d6c45f0d8f3&_Division_=249534', 142.3, '2017-11-16'),
(171, '17-082', 'Fernand Georges Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=af2146b9-0423-470c-b435-3596ed3e5962&_Division_=249534', 284.59, '2017-11-16'),
(172, '17-082', 'Fernand Georges Sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c1787271-9abb-48df-95ce-dbc60bc3601c&_Division_=249534', 284.59, '2017-11-15'),
(173, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=a808fdd3-510b-419d-948c-2c5635914d41&_Division_=249534', 35.1, '2017-10-14'),
(174, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=77f65479-1ce2-40c0-bf5c-0e1d135b0dc2&_Division_=249534', 45.58, '2017-09-23'),
(175, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b95092ef-146e-4f51-a3a4-037ac15c4c4a&_Division_=249534', 14.59, '2017-11-18'),
(176, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=8dd9e107-113e-4873-83ef-e9c4089e5987&_Division_=249534', 14.05, '2017-10-28'),
(177, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=942d53ff-0d36-4176-88d6-8c4bc78f8d36&_Division_=249534', 104.98, '2017-09-23'),
(178, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=1860f203-796b-4737-bb8d-3fde34a8143a&_Division_=249534', 7.22, '2017-10-07'),
(179, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=3a9db448-0ede-4479-a8f3-29384a856f25&_Division_=249534', 37.4, '2017-09-17'),
(180, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=50e1c496-3017-4003-a98c-04a24439a114&_Division_=249534', 599.53, '2017-10-14'),
(181, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=14ac8498-9111-4ff4-8450-c2434bb4af1b&_Division_=249534', 8.31, '2017-09-17'),
(182, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=d1b2fccc-b328-49ba-81e3-3aa30b1b8a94&_Division_=249534', 35.48, '2017-10-21'),
(183, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=b70bc1ce-227e-4d3d-b52a-bad131355ff0&_Division_=249534', 1150.15, '2017-09-17'),
(184, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=7e2d2187-5b48-42c2-be23-006a1f913fda&_Division_=249534', 58.09, '2017-11-18'),
(185, '17-082', 'Rexel Belgium sa', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=275d286f-aa4b-4bc9-8195-33b5b021a51f&_Division_=249534', 47.12, '2017-10-28'),
(186, '17-082', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=39b96d34-dd5f-44de-ae7b-eb6d82620c5d&_Division_=249534', 7.32, '2017-09-20'),
(187, '17-082', 'Etablissements Octave Tasiaux SA', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=9f980a6a-f58b-48f2-80fc-751dd320fc96&_Division_=249534', 110.59, '2017-11-30'),
(188, '17-082', '\'\'BPOST\'\'', 'https://start.exactonline.be/docs/SysAttachment.aspx?ID=c0afb8b6-47cc-41ec-aa92-5fbb326286b3&_Division_=249534', 8.91, '2017-09-11');

-- --------------------------------------------------------

--
-- Structure de la table `erp_cron_invoices`
--

CREATE TABLE `erp_cron_invoices` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `invoices` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_cron_invoices`
--

INSERT INTO `erp_cron_invoices` (`id`, `reference_no`, `invoices`) VALUES
(1, '17-006', '[8658.73,3736.94,29506.04,15160.25,14348.13,660,14491.02]'),
(2, '17-081', '[24300.22,32536.1,13788.79,12803.02,38615.37]'),
(3, '17-082', '[3527.16,13009.43]');

-- --------------------------------------------------------

--
-- Structure de la table `erp_cron_purchase`
--

CREATE TABLE `erp_cron_purchase` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `purchase` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_cron_purchase`
--

INSERT INTO `erp_cron_purchase` (`id`, `reference_no`, `purchase`) VALUES
(1, '17-006', 57879),
(2, '17-081', 63743.6),
(3, '17-082', 2035.17);

-- --------------------------------------------------------

--
-- Structure de la table `erp_cron_turnover`
--

CREATE TABLE `erp_cron_turnover` (
  `id` int(11) NOT NULL,
  `turnover` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_cron_turnover`
--

INSERT INTO `erp_cron_turnover` (`id`, `turnover`) VALUES
(1, 581844.21);

-- --------------------------------------------------------

--
-- Structure de la table `erp_employees`
--

CREATE TABLE `erp_employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `add_address` varchar(255) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `place2` varchar(100) DEFAULT NULL,
  `national_reg_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `show_size` float NOT NULL,
  `high_waist` varchar(50) NOT NULL,
  `low_waist` float NOT NULL,
  `position` varchar(255) NOT NULL,
  `civil_status` enum('single','married','spouse with dependents','widow') NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `dependent_child` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `bic_code` varchar(50) NOT NULL,
  `mutual_name` varchar(100) NOT NULL,
  `affiliation` varchar(100) NOT NULL,
  `workplace` varchar(100) NOT NULL,
  `study_level` varchar(100) NOT NULL,
  `status` int(2) NOT NULL COMMENT '1=active, 0=inactive',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_employees`
--

INSERT INTO `erp_employees` (`id`, `fname`, `lname`, `address`, `add_address`, `place`, `place2`, `national_reg_no`, `dob`, `birth_place`, `nationality`, `mobile`, `show_size`, `high_waist`, `low_waist`, `position`, `civil_status`, `spouse_name`, `dependent_child`, `bank_name`, `account_number`, `bic_code`, `mutual_name`, `affiliation`, `workplace`, `study_level`, `status`, `created_at`) VALUES
(1, 'Jean ', 'dubois ', 'rue des sources 4', '', 'ransart ', '6043', '710323-541-72', '1985-11-14', 'lobbes ', 'belge ', '0498408042', 45, 'xl', 48, 'ouvrier qualité cat E ', '', '', 8, '', '', '', '', '', '40', '', 1, '2018-08-21 14:24:26'),
(2, '', '', '', '', '', '', '', '0000-00-00', '', '', '', 0, '', 0, '', '', '', 0, '', '', '', '', '', '', '', 1, '2018-08-21 15:58:18');

-- --------------------------------------------------------

--
-- Structure de la table `erp_employees_working_hours`
--

CREATE TABLE `erp_employees_working_hours` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `total_working_hours` time DEFAULT NULL,
  `total_real_hours` time DEFAULT NULL,
  `total_accountable_hours` time DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `comment` longtext,
  `is_absent` int(2) NOT NULL,
  `working_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_employees_working_hours`
--

INSERT INTO `erp_employees_working_hours` (`id`, `site_id`, `employee_id`, `total_working_hours`, `total_real_hours`, `total_accountable_hours`, `distance`, `comment`, `is_absent`, `working_date`) VALUES
(5, 0, NULL, '00:00:00', '00:00:00', '00:00:00', 0, '', 1, '2018-08-21'),
(17, 4, NULL, '08:34:36', '07:34:36', '08:00:00', 112.86, '', 0, '2018-08-20');

-- --------------------------------------------------------

--
-- Structure de la table `erp_employee_schedule`
--

CREATE TABLE `erp_employee_schedule` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `week_no` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `schedule_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `erp_notifications`
--

CREATE TABLE `erp_notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `is_new` int(2) NOT NULL,
  `notify_to` int(2) NOT NULL DEFAULT '0' COMMENT '0=admin,1 =HR',
  `link` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_notifications`
--

INSERT INTO `erp_notifications` (`id`, `title`, `detail`, `is_new`, `notify_to`, `link`, `created_at`) VALUES
(1, 'Une nouvelle caution a été ajoutée pour le chantier  18-070.', 'Une nouvelle caution a été ajoutée pour le chantier  18-070.', 1, 1, 'http://127.0.0.1:7080/erp/human_resource/caution/detail/3', '2018-08-17 16:24:59'),
(2, 'Une nouvelle caution a été ajoutée pour le chantier  18-092.', 'Une nouvelle caution a été ajoutée pour le chantier  18-092.', 1, 1, 'http://127.0.0.1:7080/erp/human_resource/caution/detail/4', '2018-08-21 13:31:05'),
(3, 'L’exécution du chantier 18-070 a démarré. Merci d’attribuer un gestionnaire.', 'L’exécution du chantier 18-070 a démarré. Merci d’attribuer un gestionnaire.', 1, 0, 'http://127.0.0.1:7080/erp/admin/offers/detail/3', '2018-08-21 15:01:38'),
(4, 'L’exécution du chantier 18-092 a démarré. Merci d’attribuer un gestionnaire.', 'L’exécution du chantier 18-092 a démarré. Merci d’attribuer un gestionnaire.', 1, 0, 'http://127.0.0.1:7080/erp/admin/offers/detail/4', '2018-08-21 15:04:04'),
(5, 'Une nouvelle caution a été ajoutée pour le chantier  18-070.', 'Une nouvelle caution a été ajoutée pour le chantier  18-070.', 1, 1, 'http://127.0.0.1:7080/erp/human_resource/caution/detail/3', '2018-09-17 12:05:11');

-- --------------------------------------------------------

--
-- Structure de la table `erp_offers`
--

CREATE TABLE `erp_offers` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `general_fee` float NOT NULL,
  `hourly_rate` float NOT NULL,
  `working_hours` float NOT NULL COMMENT 'total hours to be worked in the offer',
  `purchase` float NOT NULL,
  `subcontractors` float NOT NULL,
  `cost_price` float NOT NULL,
  `margin` float NOT NULL,
  `sale_price` float NOT NULL,
  `tva_rate` float NOT NULL,
  `total_without_vat` float NOT NULL,
  `total_vat` float NOT NULL,
  `total_with_vat` float NOT NULL,
  `market` enum('','Public','Privé') NOT NULL,
  `client` enum('','Entreprise générale','Pouvoir public','Privé - Entreprise','Privé - Particulier') NOT NULL,
  `offer` enum('','Affaire ferme','Soumission') NOT NULL,
  `manager_id` int(11) NOT NULL,
  `status` enum('','En attente','Annulé','Rejeté','Accepté') NOT NULL,
  `offer_type` enum('offer','order_book','execution','end_construction') NOT NULL,
  `purchase_price` float NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gsm` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_place` varchar(255) DEFAULT NULL,
  `technical_visit` int(2) DEFAULT NULL,
  `visit_date` datetime DEFAULT NULL,
  `visit_address` varchar(255) DEFAULT NULL,
  `visit_contact_person` varchar(255) DEFAULT NULL,
  `visit_gsm` varchar(255) DEFAULT NULL,
  `visit_phone` varchar(255) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `is_new` int(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_offers`
--

INSERT INTO `erp_offers` (`id`, `reference_no`, `description`, `general_fee`, `hourly_rate`, `working_hours`, `purchase`, `subcontractors`, `cost_price`, `margin`, `sale_price`, `tva_rate`, `total_without_vat`, `total_vat`, `total_with_vat`, `market`, `client`, `offer`, `manager_id`, `status`, `offer_type`, `purchase_price`, `company`, `contact_person`, `email`, `gsm`, `phone`, `delivery_date`, `delivery_place`, `technical_visit`, `visit_date`, `visit_address`, `visit_contact_person`, `visit_gsm`, `visit_phone`, `comment`, `is_new`, `created_at`, `update_at`) VALUES
(1, '18-001', ' Soignies - Haute senne logement siège social ', 0, 26.58, 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 'Public', 'Entreprise générale', '', 0, 'Rejeté', 'offer', 0, ' BEMAT ', 'Vedran Dragicevic ', 'vdragicievic@bemat.be', '', '071285990', '0000-00-00 00:00:00', '', 0, '1970-01-01 01:00:00', '', '', '', '', 'lui sonner pour voir qui a gagné ', 0, '2018-08-21 13:25:46', NULL),
(2, '18-002', ' Aménagement des Bureaux - SODA ', 0, 26.58, 112.25, 2956.09, 125, 6064.69, 606.5, 8027.89, 6, 8027.89, 481.673, 8509.56, 'Privé', 'Privé - Entreprise', '', 0, 'Accepté', 'order_book', 0, ' SODA ', 'David Ganty ', 'david@sodaproject.be', '+32(0)483/62.63.98 ', '', '1970-01-01 01:00:00', '', 0, '1970-01-01 01:00:00', '', '', '', '', '', 0, '2018-08-16 21:06:18', NULL),
(3, '18-070', ' Bat. Belgique N°1 - adaptation installation ', 0, 26.58, 128.45, 6393.23, 0, 9807.43, 968.378, 12969.7, 6, 12969.7, 778.181, 13747.9, 'Privé', 'Privé - Particulier', '', 13, 'Accepté', 'order_book', 0, ' Co-Station ', 'Mathieu Demaré ', 'mathieu@co-station.com', '0474975432', '', '1970-01-01 01:00:00', '', 0, '1970-01-01 01:00:00', '', '', '', '', '', 0, '2018-08-17 14:57:38', NULL),
(4, '18-092', ' Cité Harmegnies - Tour B ', 0, 26.58, 903.705, 22418.7, 227044, 273483, 2187.53, 285131, 0, 285131, 0, 285131, 'Public', 'Entreprise générale', 'Affaire ferme', 11, 'Accepté', 'execution', 0, ' BEMAT ', 'Mr Orhant ', 'eorhant@bemat.be', '0499693964', '071489069', '2018-08-02 00:00:00', '', 1, '2018-08-22 00:00:00', 'cité harmegnies charleroi ', 'orhant', '498408042', '', '', 0, '2018-08-21 13:28:21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `erp_progress_data`
--

CREATE TABLE `erp_progress_data` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `purchase` float NOT NULL,
  `total_hours` float NOT NULL,
  `hours` float NOT NULL,
  `hourly_rate` float NOT NULL,
  `general_fee` float NOT NULL,
  `selling_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `erp_schedule`
--

CREATE TABLE `erp_schedule` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `morning_schedule` int(11) NOT NULL,
  `afternoon_schedule` int(11) NOT NULL,
  `schedule_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `erp_securysat`
--

CREATE TABLE `erp_securysat` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(100) NOT NULL,
  `secury_file_date` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_securysat`
--

INSERT INTO `erp_securysat` (`id`, `user_name`, `type`, `secury_file_date`, `created_at`) VALUES
(1, 'Antédamus Thomas', 'passager', '2018-08-20', '2018-08-21 00:00:00'),
(2, 'Carosielli Fabian', 'chauffeur', '2018-08-20', '2018-08-21 00:00:00'),
(3, 'Devillers Olivier', 'chauffeur', '2018-08-20', '2018-08-21 00:00:00'),
(4, 'Etienne Christopher', 'passager', '2018-08-20', '2018-08-21 00:00:00'),
(5, 'Gomez Fred', 'chauffeur', '2018-08-20', '2018-08-21 00:00:00'),
(6, 'Ifrim Ciprian', 'passager', '2018-08-20', '2018-08-21 00:00:00'),
(7, 'Jacobs Alain', 'chauffeur', '2018-08-20', '2018-08-21 00:00:00'),
(8, 'QUINTIN LUCAS', 'passager', '2018-08-20', '2018-08-21 00:00:00'),
(9, 'Quintin Jessy', 'chauffeur', '2018-08-20', '2018-08-21 00:00:00'),
(10, 'Stanciu Adrian', 'passager', '2018-08-20', '2018-08-21 00:00:00'),
(11, 'Stanciu Gabi', 'passager', '2018-08-20', '2018-08-21 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `erp_securysat_data`
--

CREATE TABLE `erp_securysat_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `personal_id` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `depart_place` varchar(100) DEFAULT NULL,
  `arrival_place` varchar(100) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `distance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_securysat_data`
--

INSERT INTO `erp_securysat_data` (`id`, `user_id`, `personal_id`, `type`, `departure_time`, `arrival_time`, `depart_place`, `arrival_place`, `duration`, `distance`) VALUES
(1, 1, '', 'passager', '06:07:38', '06:47:16', 'Route de Ransart - 6220 Heppignies - BE', 'Avenue Alfred Solvay - Alfred Solvaylaan 2A - 1170 Watermael-Boitsfort - Watermaal-Bosvoor', '00:39:38', 54.11),
(2, 1, '', 'passager', '15:21:52', '16:10:12', '[Institut Asomption]', 'Rue du Progrès - 6220 Fleurus', '00:48:20', 58.75),
(3, 2, '3C000009FDAF4D01', 'chauffeur', '06:48:58', '07:02:08', 'Rue du Progrès - 6220 Fleurus - BE', '[Cité Harmegnies]', '00:13:10', 10.59),
(4, 2, '3C000009FDAF4D01', 'chauffeur', '15:41:16', '15:54:12', '[Cité Harmegnies]', 'Rue du Progrès - 6220 Fleurus', '00:12:56', 10.76),
(5, 3, '7700001531d3cc01', 'chauffeur', '06:02:56', '06:11:06', 'Rue du Progrès - 6220 Fleurus - BE', 'Rue Eau-sur-Elle - 6043 Ransart', '00:08:10', 6.76),
(6, 3, '7700001531d3cc01', 'chauffeur', '06:14:06', '07:10:44', 'Rue Eau-sur-Elle - 6043 Ransart - BE', '[Commue Forest]', '00:56:38', 50.74),
(7, 3, '7700001531d3cc01', 'chauffeur', '15:32:22', '16:15:16', '[Commue Forest]', 'Rue du Progrès - 6220 Fleurus', '00:42:54', 56.17),
(8, 4, '', 'passager', '06:13:20', '06:54:18', 'Rue du Progrès - 6220 Fleurus - BE', 'Rue de la Grattine - 7100 La Louvière', '00:40:58', 29.48),
(9, 4, '', 'chauffeur', '15:45:44', '16:12:32', 'Rue des Loups - 7100 La Louvière - BE', 'Rue du Progrès - 6220 Fleurus', '00:26:48', 27.96),
(10, 5, '4300001533CAB301', 'chauffeur', '06:38:56', '06:58:08', 'Rue du Progrès - 6220 Fleurus - BE', 'Rue de l\'Église - 6230 Pont-à-Celles', '00:19:12', 19.55),
(11, 5, '4300001533CAB301', 'chauffeur', '15:53:20', '16:16:46', 'Rue de l\'Église - 6230 Pont-à-Celles - BE', 'Chaussée de Courcelles - 6041 Gosselies', '00:23:26', 11.17),
(12, 5, '4300001533CAB301', 'chauffeur', '16:20:38', '16:31:26', 'Chaussée de Courcelles - 6041 Gosselies - BE', 'Rue du Progrès - 6220 Fleurus', '00:10:48', 9.34),
(13, 6, 'ae00001533c50401', 'passager', '06:36:40', '06:54:20', 'Chaussée de Courcelles - 6041 Gosselies - BE', 'Rue des Loups - 7100 La Louvière', '00:17:40', 20.54),
(14, 6, 'ae00001533c50401', 'passager', '15:45:34', '15:48:30', 'Rue des Loups - 7100 La Louvière - BE', 'Rue des Croix du Feu - 7100 La Louvière', '00:02:56', 0.12),
(15, 6, 'ae00001533c50401', 'passager', '15:48:54', '16:02:28', 'Rue des Croix du Feu - 7100 La Louvière - BE', 'Autoroute de Wallonie - 6180 Courcelles', '00:13:34', 16.13),
(16, 7, '6400001534073401', 'chauffeur', '06:03:30', '06:46:54', 'Rue du Progrès - 6220 Fleurus - BE', 'Avenue Alfred Solvay - Alfred Solvaylaan 2A - 1170 Watermael-Boitsfort - Watermaal-Bosvoor', '00:43:24', 59.02),
(17, 7, '6400001534073401', 'chauffeur', '15:21:18', '16:09:10', '[Institut Asomption]', 'Rue du Progrès - 6220 Fleurus', '00:47:52', 58.77),
(18, 8, '', 'passager', '06:03:38', '06:53:56', 'Rue du Progrès - 6220 Fleurus - BE', '[Commue Forest]', '00:50:18', 57.5),
(19, 8, '', 'passager', '15:33:20', '06:58:02', 'Rue de Barcelone - Barcelonastraat - 1190 Forest - Vorst - BE', 'Rue de Barcelone - Barcelonastraat - 1190 Forest - Vorst', '15:24:42', 112.01),
(20, 9, '', 'chauffeur', '06:13:16', '06:54:20', 'Rue du Progrès - 6220 Fleurus - BE', 'Rue des Loups - 7100 La Louvière', '00:41:04', 29.97),
(21, 9, '', 'passager', '15:45:40', '15:48:30', 'Rue des Loups - 7100 La Louvière - BE', 'Rue des Croix du Feu - 7100 La Louvière', '00:02:50', 0.12),
(22, 9, '', 'passager', '15:48:52', '16:12:28', 'Rue des Croix du Feu - 7100 La Louvière - BE', 'Rue du Progrès - 6220 Fleurus', '00:23:36', 27.83),
(23, 10, '', 'passager', '06:50:36', '07:02:12', 'Rue du Progrès - 6220 Fleurus - BE', '[Cité Harmegnies]', '00:11:36', 10.24),
(24, 10, '', 'passager', '15:42:36', '15:54:12', 'Rue Jonet - 6000 Charleroi - BE', 'Rue du Progrès - 6220 Fleurus', '00:11:36', 10.46),
(25, 11, '7100001533398201', 'passager', '06:39:16', '06:58:36', 'Rue du Progrès - 6220 Fleurus - BE', 'Rue de l\'Église - 6230 Pont-à-Celles', '00:19:20', 19.29),
(26, 11, '7100001533398201', 'passager', '15:54:28', '16:11:52', 'Place communale - 6230 Pont-à-Celles - BE', 'Rue Winston Churchill - 6180 Courcelles', '00:17:24', 8.49);

-- --------------------------------------------------------

--
-- Structure de la table `erp_site_progress`
--

CREATE TABLE `erp_site_progress` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `progress_state` int(11) NOT NULL,
  `start_period` date NOT NULL,
  `end_period` date NOT NULL,
  `period_bill` double NOT NULL,
  `vat` float NOT NULL,
  `total_with_vat` float NOT NULL,
  `forcasted` float NOT NULL,
  `upload_date` datetime NOT NULL,
  `upload_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `erp_tokens`
--

CREATE TABLE `erp_tokens` (
  `id` int(11) NOT NULL,
  `access_token` longtext NOT NULL,
  `refresh_token` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_tokens`
--

INSERT INTO `erp_tokens` (`id`, `access_token`, `refresh_token`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_users`
--

CREATE TABLE `erp_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1=admin, 2=manager, 3=hr',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `ref_link` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erp_users`
--

INSERT INTO `erp_users` (`id`, `name`, `email`, `password`, `image`, `user_type`, `created_by`, `created_at`, `ref_link`) VALUES
(1, 'Nicolas Caron', 'nicolas@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '35695167237c5a61945c93b1c9fe96fa.jpg', 1, 0, '2017-12-26 00:00:00', ''),
(2, 'Micheal Matte', 'micheal@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'a494ad18b18cb6ba901ca7c5c5192f80.jpg', 2, 0, '2017-12-26 14:34:01', ''),
(3, 'Alex John ', 'alex@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1132f40e69de71b947d7de0d31401334.jpg', 3, 0, '2017-12-26 14:34:26', ''),
(4, 'Uran', 'uran@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 1, 0, '2018-02-15 19:26:17', ''),
(5, 'rh@gmail.com', 'rh@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 3, 0, '2018-02-15 22:42:56', ''),
(6, 'project@gmail.com', 'project@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 2, 0, '2018-02-15 22:43:13', ''),
(7, 'uran', 'uran.canhasi@digiseed.be', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', 1, 0, '2018-03-31 11:17:38', ''),
(8, 'Yves Wattiez', 'y.wattiez@wmelectricite.be', '8bbc8506b49e4cf7f1bfc24fd46a11f78b15a550', '510f2c6c6fbc39624bfab231dc891c2c.jpg', 1, 0, '2018-04-27 15:27:44', ''),
(9, 'Isabelle Clippe', 'i.clippe@wmelectricite.be', '8bbc8506b49e4cf7f1bfc24fd46a11f78b15a550', '', 3, 0, '2018-04-27 15:29:15', ''),
(10, 'Bodson Chloe ', 'etudes@wm-electricite.be', '785906bba78d10543a0e7bbffa3e54bb0b005d8c', '89347f36323fcdba2244c455e6a63029.jpg', 2, 0, '2018-08-16 16:00:14', ''),
(11, 'Gilard Emmanuel ', 'gilard.e@wm-electricite.be', 'd97c6d35b7e0ca7a08bd53abe184022317290f65', 'ae6a3062e49308744860a6c6e991d402.jpg', 2, 0, '2018-08-16 21:09:10', ''),
(12, 'Henry Nicolas ', 'henry.n@wm-electricite.be', 'cd595497faa5b6a9aa9bd9a59d962fbb70a2dcfd', 'acfd384e071fdc3cdb5ef73a577811b5.jpg', 2, 0, '2018-08-16 21:14:59', ''),
(13, 'Marcel Wattiez ', 'info@wm-electricite.be', '07d959b529bedc2c1f193eec008bceece51cbd6b', '', 2, 0, '2018-08-16 21:15:31', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `erp_caution_sites`
--
ALTER TABLE `erp_caution_sites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_cron_documents`
--
ALTER TABLE `erp_cron_documents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_cron_invoices`
--
ALTER TABLE `erp_cron_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_cron_purchase`
--
ALTER TABLE `erp_cron_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_cron_turnover`
--
ALTER TABLE `erp_cron_turnover`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_employees`
--
ALTER TABLE `erp_employees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_employees_working_hours`
--
ALTER TABLE `erp_employees_working_hours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_employee_schedule`
--
ALTER TABLE `erp_employee_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_notifications`
--
ALTER TABLE `erp_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_offers`
--
ALTER TABLE `erp_offers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_progress_data`
--
ALTER TABLE `erp_progress_data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_schedule`
--
ALTER TABLE `erp_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_securysat`
--
ALTER TABLE `erp_securysat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_securysat_data`
--
ALTER TABLE `erp_securysat_data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_site_progress`
--
ALTER TABLE `erp_site_progress`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_tokens`
--
ALTER TABLE `erp_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `erp_users`
--
ALTER TABLE `erp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `erp_caution_sites`
--
ALTER TABLE `erp_caution_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `erp_cron_documents`
--
ALTER TABLE `erp_cron_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT pour la table `erp_cron_invoices`
--
ALTER TABLE `erp_cron_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `erp_cron_purchase`
--
ALTER TABLE `erp_cron_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `erp_cron_turnover`
--
ALTER TABLE `erp_cron_turnover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `erp_employees`
--
ALTER TABLE `erp_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `erp_employees_working_hours`
--
ALTER TABLE `erp_employees_working_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `erp_employee_schedule`
--
ALTER TABLE `erp_employee_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `erp_notifications`
--
ALTER TABLE `erp_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `erp_offers`
--
ALTER TABLE `erp_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `erp_progress_data`
--
ALTER TABLE `erp_progress_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `erp_schedule`
--
ALTER TABLE `erp_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `erp_securysat`
--
ALTER TABLE `erp_securysat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `erp_securysat_data`
--
ALTER TABLE `erp_securysat_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `erp_site_progress`
--
ALTER TABLE `erp_site_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `erp_tokens`
--
ALTER TABLE `erp_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `erp_users`
--
ALTER TABLE `erp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
