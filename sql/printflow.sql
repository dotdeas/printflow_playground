SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `serviceid` varchar(12) DEFAULT NULL,
  `model` varchar(128) DEFAULT NULL,
  `alertcode` varchar(32) DEFAULT NULL,
  `message` varchar(256) DEFAULT NULL,
  `system` varchar(32) DEFAULT NULL,
  `reportdate` datetime DEFAULT NULL,
  `checked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `type` int(1) NOT NULL,
  `msgsupplie` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `serviceid` varchar(12) DEFAULT NULL,
  `alertcode` varchar(32) DEFAULT NULL,
  `msgsupplie` varchar(128) DEFAULT NULL,
  `reportsent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `serviceid` varchar(12) DEFAULT NULL,
  `alertcode` varchar(32) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `message` varchar(512) DEFAULT NULL,
  `resetdays` tinyint(3) DEFAULT NULL,
  `reportsent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `activity`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `codes`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `log`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;