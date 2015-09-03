DROP TABLE IF EXISTS `#__joomsoc`; 
CREATE TABLE `#__joomsoc` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`content` TEXT NOT NULL,
	`photo` TEXT,
	`video` TEXT,
	`published` TINYINT(1) DEFAULT 1,
	`created_at` TIMESTAMP DEFAULT 0,
	`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);
 
INSERT INTO `#__joomsoc` (`id`,`user_id`, `content`) VALUES
(1, 720, 'Hello JoomSoc !!');
INSERT INTO `#__joomsoc` (`id`,`user_id`, `content`) VALUES
(2, 720, 'Ca fait plaisir un peu de soleil !! #sunnydays #troyes');
INSERT INTO `#__joomsoc` (`id`,`user_id`, `content`) VALUES
(3, 720, 'Ca avance bien finalement :)');


DROP TABLE IF EXISTS `#__joomsoc_user_details`;
CREATE TABLE `#__joomsoc_user_details` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`username` VARCHAR(25) NOT NULL,
	`fullname` VARCHAR(25),
	`gender` CHAR(1),
	`bio` VARCHAR(140),
	`phone` VARCHAR(25),
	`address` VARCHAR(25),
	`city` VARCHAR(25),
	`country` VARCHAR(25),
	`location` VARCHAR(25),
	`created_at` TIMESTAMP DEFAULT 0,
	`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `#__joomsoc_socialauth`;
CREATE TABLE `#__joomsoc_socialauth` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`provider` VARCHAR(11) NOT NULL,
	PRIMARY KEY (`id`)
);