ALTER TABLE games ADD waiting_time INT(11) NOT NULL DEFAULT 0;
ALTER TABLE players ADD waiting_positions_amount text;
ALTER TABLE players ADD waiting_time_in_sector INT(11) NOT NULL DEFAULT 0;

