SET NAMES utf8;
SET foreign_key_checks = 0;

-- ---------------------------- --
-- Table structure for `yunzhi_klass`
-- ------------------------------ --
DROP TABLE
IF EXISTS `yunzhi_klass`;

CREATE TABLE `yunzhi_klass` (
	`id` INT (11) UNSIGNED NOT NULL auto_increment,
	`name` VARCHAR (40) NOT NULL DEFAULT '' COMMENT '名称',
	`teacher_id` INT (11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '教师ID',
	`create_time` INT (11) NOT NULL DEFAULT '0',
	`update_time` INT (11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE = MyISAM auto_increment = 5 DEFAULT charset = utf8;

-- ----------------------------
-- Records of `yunzhi_klass`
-- ----------------------------
BEGIN;

INSERT INTO `yunzhi_klass`
VALUES
	(
		'1',
		'实验1班',
		'1',
		'0',
		'0'
	),
	(
		'2',
		'实验2班',
		'2',
		'0',
		'0'
	),
	(
		'3',
		'实验3班',
		'1',
		'0',
		'0'
	),
	(
		'4',
		'实验4班',
		'2',
		'0',
		'0'
	);

COMMIT;
SET foreign_key_checks = 1;