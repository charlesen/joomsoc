DROP TABLE IF EXISTS `#__joonet`; 
CREATE TABLE `#__joonet` (
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
 
INSERT INTO `#__joonet` (`id`,`user_id`, `content`) VALUES
(1, 720, 'Hello joonet !!');
INSERT INTO `#__joonet` (`id`,`user_id`, `content`) VALUES
(2, 720, 'Ca fait plaisir un peu de soleil !! #sunnydays #troyes');
INSERT INTO `#__joonet` (`id`,`user_id`, `content`) VALUES
(3, 720, 'Ca avance bien finalement :)');


DROP TABLE IF EXISTS `#__joonet_user_details`;
CREATE TABLE `#__joonet_user_details` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`gender` CHAR(1),
	`bio` VARCHAR(140),
	`phone` VARCHAR(25),
	`address` VARCHAR(25),
	`city` VARCHAR(25),
	`country` VARCHAR(25),
	`location` VARCHAR(25),
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `#__joonet_user_follows`;
CREATE TABLE `#__joonet_user_follows` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`follower_id` INT(11) NOT NULL,
	`following_id` INT(11) NOT NULL,
	`active` TINYINT(1) DEFAULT 1,
	`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `#__joonet_socialauth`;
CREATE TABLE `#__joonet_socialauth` (
	`id`      INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`provider` VARCHAR(11) NOT NULL,
	PRIMARY KEY (`id`)
);