ALTER TABLE `teeflow`.`players`    ADD COLUMN `done_distance` DOUBLE DEFAULT '0' NULL 
AFTER `missing_position`,    ADD COLUMN `not_done_distance` DOUBLE DEFAULT '0' NULL AFTER `done_distance`;
ALTER TABLE `teeflow`.`players` CHANGE `missing_position` `missing_position` INT(1) DEFAULT '0' NULL , CHANGE `done_distance` `done_distance` TEXT NULL , CHANGE `not_done_distance` `not_done_distance` TEXT NULL ; 
ALTER TABLE `teeflow`.`players` ADD COLUMN `time_in_sectors` TEXT NULL AFTER `not_done_distance`; 
ALTER TABLE `teeflow`.`courses` ADD COLUMN `start_time` DATETIME NULL AFTER `angle`; 