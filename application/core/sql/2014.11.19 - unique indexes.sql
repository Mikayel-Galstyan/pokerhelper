ALTER TABLE `teeflow`.`messages` ADD UNIQUE INDEX `messages_type_unique` (`type`);

ALTER TABLE `teeflow`.`settings` DROP INDEX `name`, ADD UNIQUE INDEX `name` (`name`);

DELETE FROM `teeflow`.`intervals` WHERE `id` = '14';

ALTER TABLE `teeflow`.`intervals` CHANGE `name` `name` VARCHAR(255) CHARSET utf8 COLLATE utf8_general_ci NOT NULL, ADD UNIQUE INDEX `intervals_name` (`name`), ADD UNIQUE INDEX `intervals_key` (`key`);

