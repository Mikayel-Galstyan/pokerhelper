ALTER TABLE `teeflow`.`marshalmessages` ADD COLUMN `player_app_id` VARCHAR(100) NULL AFTER `situation_type`, ADD INDEX `mm_player_app_id` (`player_app_id`);
