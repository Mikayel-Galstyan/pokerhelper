ALTER TABLE `teeflow`.`marshalmessages` ADD COLUMN `end_time` DATETIME NULL AFTER `time`, ADD INDEX `mm_end_time` (`end_time`);

ALTER TABLE `teeflow`.`marshalmessages` ADD COLUMN `situation_type` TINYINT UNSIGNED NULL AFTER `history_id`, ADD INDEX `mm_situation_type` (`situation_type`);
