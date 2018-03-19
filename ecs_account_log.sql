/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : suo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-19 09:48:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_account_log
-- ----------------------------
DROP TABLE IF EXISTS `ecs_account_log`;
CREATE TABLE `ecs_account_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_money` decimal(10,2) NOT NULL,
  `frozen_money` decimal(10,2) NOT NULL,
  `rank_points` mediumint(9) NOT NULL,
  `pay_points` mediumint(9) NOT NULL,
  `user_cash` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '电子币',
  `change_time` int(10) unsigned NOT NULL,
  `change_desc` varchar(255) NOT NULL,
  `change_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_account_log
-- ----------------------------
INSERT INTO `ecs_account_log` VALUES ('55', '37', '80.00', '0.00', '0', '0', '0.00', '1512462708', '安装费、报单费', '99');
INSERT INTO `ecs_account_log` VALUES ('56', '37', '80.00', '0.00', '0', '0', '0.00', '1512462708', '服务中心奖金', '99');
INSERT INTO `ecs_account_log` VALUES ('57', '37', '80.00', '0.00', '0', '0', '0.00', '1515117396', '安装费、报单费', '99');
INSERT INTO `ecs_account_log` VALUES ('58', '37', '79.80', '0.00', '0', '0', '0.00', '1515117396', '服务中心奖金', '99');
INSERT INTO `ecs_account_log` VALUES ('59', '37', '80.00', '0.00', '0', '0', '0.00', '1516237627', '安装费、报单费', '99');
INSERT INTO `ecs_account_log` VALUES ('60', '37', '79.80', '0.00', '0', '0', '0.00', '1516237627', '服务中心奖金', '99');
