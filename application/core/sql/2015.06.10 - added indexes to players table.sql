ALTER TABLE `teeflow`.`players` CHANGE `finalized` `finalized` TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL, ADD INDEX `players_register_id` (`register_id`), ADD INDEX `players_start_polygon_id` (`start_polygon_id`), ADD INDEX `players_start_time` (`start_time`);