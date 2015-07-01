ALTER TABLE `teeflow`.`history_info`    ADD COLUMN `updated` INT(1) DEFAULT '0' NULL AFTER `course_id`;
ALTER TABLE `teeflow`.`history`    ADD COLUMN `updated` INT(1) DEFAULT '0' NULL AFTER `NAME`;

CREATE TABLE `teeflow`.`job_table`(    `id` INT(11) NOT NULL AUTO_INCREMENT ,    `app_id` VARCHAR(100) ,    `course_id` INT ,    `location` TEXT ,    `date` DATETIME ,    `battery` FLOAT ,    `calculated` INT(1) DEFAULT '0' ,    PRIMARY KEY (`id`) );
ALTER TABLE `teeflow`.`players` ADD COLUMN `send_config` TEXT NULL AFTER `time_in_sectors`; 
ALTER TABLE `teeflow`.`players` ADD COLUMN `last_update_time` TEXT NULL AFTER `send_config`; 