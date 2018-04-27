/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-20 17:31:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_account_log
-- ----------------------------
DROP TABLE IF EXISTS `ecs_account_log`;
CREATE TABLE `ecs_account_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际插入的奖金',
  `act_user_money` decimal(10,2) NOT NULL COMMENT '应该插入的奖金',
  `user_cash` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际插入的冲销',
  `act_user_cash` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应该插入的重消',
  `user_point` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '企业币',
  `upgrade_point` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '升级币',
  `change_time` int(10) unsigned NOT NULL,
  `change_desc` varchar(255) NOT NULL,
  `change_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_account_log
-- ----------------------------
