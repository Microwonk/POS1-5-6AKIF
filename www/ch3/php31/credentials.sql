-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Mai 2017 um 07:30
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php31`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `credentials`
--

CREATE TABLE IF NOT EXISTS `credentials` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `domain` varchar(128) DEFAULT NULL,
  `cms_username` varchar(128) DEFAULT NULL,
  `cms_password` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `credentials`
--

INSERT INTO `credentials` (`id`, `name`, `domain`, `cms_username`, `cms_password`) VALUES
(1, 'Browsecat', 'hc360.com', 'pdeetlefs0', 'mPaf0XcoXO'),
(2, 'Dabtype', 'vinaora.com', 'hbartelsellis1', 'ROfJxYo6IZDF'),
(3, 'Realbuzz', 'theatlantic.com', 'ajosey2', 'ei80rdj6V'),
(4, 'Digitube', 'yellowbook.com', 'chacquoil3', 'tfBrU42rWwNC'),
(5, 'Dabfeed', 'plala.or.jp', 'gdallewater4', '8BkSvaYGvIo'),
(6, 'Dabfeed', 'themeforest.net', 'kingledow5', 'yKRLHcRuMJ9'),
(7, 'Edgetag', 'liveinternet.ru', 'mdefreyne6', 'YAd7GIwNK1'),
(8, 'Chatterbridge', 'nsw.gov.au', 'kwandless7', 'Zqp7R36'),
(9, 'Twimbo', 'sina.com.cn', 'cavrahamoff8', 'vkqolxSlxteG'),
(10, 'Yacero', 'ycombinator.com', 'ctuffell9', 'G9tfnvsTv4'),
(11, 'Rhynoodle', 'spotify.com', 'ymccartneya', 'eLrgp50TLO6r'),
(12, 'Skinder', 'weibo.com', 'hbaskwellb', 'SwNkqgVJ'),
(13, 'Zoomcast', 'indiatimes.com', 'paddionisioc', 'bY584Z3lgkSy'),
(15, 'Jabberbean', 'miibeian.gov.cn', 'fpeddowee', 'PrT4xiN'),
(16, 'Chatterpoint', 'etsy.com', 'scornishf', 'sZUq8jNmt4s'),
(17, 'Jetwire', 'cbslocal.com', 'lhughg', 'S2A9SrYva'),
(18, 'Realfire', 'barnesandnoble.com', 'cflecknoh', 'gi1ZYSOKXvxf'),
(19, 'Muxo', 'amazon.de', 'dmalenoiri', 'uTojwCXyh'),
(20, 'Wordify', 'jalbum.net', 'aelwelj', 'uSp43cnBt2E'),
(21, 'Topicstorm', 'noaa.gov', 'gcappellk', 'v4OCVfnk0'),
(22, 'Flashset', 'ted.com', 'awaskettl', 'hAiumUpA'),
(23, 'Dazzlesphere', 'columbia.edu', 'mroskeillym', 'XcFxoD65GXT'),
(24, 'Riffpath', 'godaddy.com', 'dfinchamn', 'WL5a7y'),
(25, 'Bubbletube', 'oakley.com', 'tstandingo', 'fZriVHPTyJkH'),
(26, 'Quatz', 'eventbrite.com', 'eburstowep', 'sIJqnF'),
(27, 'Camimbo', 'ed.gov', 'gladdleq', '6dliuMc'),
(28, 'Trupe', 'businesswire.com', 'smackellenr', '3uPB1YCEp'),
(29, 'Agivu', 'opera.com', 'mguittes', 'oXPreXz'),
(30, 'Dynava', 'msu.edu', 'hsantorat', 'SaBAhZLMM2'),
(31, 'Katz', 'istockphoto.com', 'gseadonu', 'qEj8wyz0GYt'),
(32, 'LiveZ', 'phoca.cz', 'cmaynellv', 'GAUhGA9D9'),
(33, 'Skipfire', 'constantcontact.com', 'adunphyw', 'hUM1oxyxN4'),
(34, 'Oyoyo', 'hubpages.com', 'kcorbittx', 'PvBFzWmc16'),
(35, 'Eayo', 'ycombinator.com', 'dreinhardty', '4rgMUxsWnlU'),
(36, 'Skivee', 'chronoengine.com', 'bmazzilliz', 'IzcQDQgk'),
(37, 'Quimm', 'netvibes.com', 'bbetonia10', 'amp7oW'),
(38, 'Centimia', 'gmpg.org', 'ehansbury11', 'PSZe2BkZi'),
(39, 'Devshare', 'networkadvertising.org', 'btrew12', '6kI5gc'),
(40, 'Shufflester', 'acquirethisname.com', 'ttrusse13', 'PI6VQiAp8'),
(41, 'Feedspan', 'independent.co.uk', 'jizod14', 'EzFA9S'),
(42, 'Mynte', 'hud.gov', 'lveazey15', 'nnhBpYVyOdDN'),
(43, 'Yambee', 'nydailynews.com', 'cdominka16', 'JXDnhAZBG'),
(44, 'Nlounge', 'ft.com', 'fmoules17', 'Q00G4Ap9vd'),
(45, 'Edgeclub', 'angelfire.com', 'mmacalister18', 'MmOG9GaqyF'),
(46, 'Jabbertype', 'wsj.com', 'bkelsall19', 'q3XZE0QMq'),
(47, 'Yacero', 'theglobeandmail.com', 'egravells1a', '1ngMYecJS2MP'),
(48, 'Skyble', 'craigslist.org', 'vhughson1b', 'EeBUCfoK0O'),
(49, 'Yata', 'nymag.com', 'mkerin1c', 'ryExzwv'),
(50, 'Skajo', 'irs.gov', 'aleebeter1d', 'FZIkHCDR');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
