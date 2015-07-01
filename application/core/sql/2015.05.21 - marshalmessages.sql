ALTER TABLE `marshalmessages` ADD COLUMN `history_id` INT NULL AFTER `type`;

ALTER TABLE `marshalmessages` ADD INDEX `mm_marshal_id` (`marshal_id`), ADD INDEX `mm_time` (`time`), ADD INDEX `mm_player_id` (`player_id`), ADD INDEX `mm_history_id` (`history_id`);
