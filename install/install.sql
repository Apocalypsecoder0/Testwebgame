-- Set SQL mode and time zone
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Set character set to UTF-8
SET NAMES utf8;

-- Create tables
CREATE TABLE `%PREFIX%aks` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) DEFAULT NULL,
  `target` INT(11) UNSIGNED NOT NULL,
  `ankunft` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `%PREFIX%alliance` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ally_name` VARCHAR(50) DEFAULT '',
  `ally_tag` VARCHAR(20) DEFAULT '',
  `ally_owner` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `ally_register_time` INT(11) NOT NULL DEFAULT '0',
  `ally_description` TEXT,
  `ally_web` VARCHAR(255) DEFAULT '',
  `ally_text` TEXT,
  `ally_image` VARCHAR(255) DEFAULT '',
  `ally_request` VARCHAR(1000) DEFAULT NULL,
  `ally_request_notallow` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `ally_request_min_points` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
  `ally_owner_range` VARCHAR(32) DEFAULT '',
  `ally_members` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `ally_stats` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `ally_diplo` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `ally_universe` TINYINT(3) UNSIGNED NOT NULL,
  `ally_max_members` INT(5) UNSIGNED NOT NULL DEFAULT 20,
  `ally_events` VARCHAR(55) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `ally_tag` (`ally_tag`),
  KEY `ally_name` (`ally_name`),
  KEY `ally_universe` (`ally_universe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Additional table creations follow the same structure...

-- Insert initial data
INSERT INTO `%PREFIX%config` (`uni`, `VERSION`, `uni_name`, `game_name`, `close_reason`, `OverviewNewsText`, `moduls`, `disclamerAddress`, `disclamerPhone`, `disclamerMail`, `disclamerNotice`) VALUES
(1, '%VERSION%', '', '2Moons', '', '', '', '', '', '', '');

INSERT INTO `%PREFIX%ticket_category` (`categoryID`, `name`) VALUES
(1, 'Support');

-- Continue with more insert statements...
