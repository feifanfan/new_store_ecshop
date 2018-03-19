/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : suo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-19 09:55:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_user_money_log
-- ----------------------------
DROP TABLE IF EXISTS `ecs_user_money_log`;
CREATE TABLE `ecs_user_money_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) NOT NULL DEFAULT '0' COMMENT '报单ID',
  `user_left` int(11) unsigned DEFAULT NULL,
  `left_amount` float(10,2) DEFAULT NULL,
  `left_sn` varchar(20) DEFAULT NULL,
  `user_right` int(11) DEFAULT NULL,
  `right_amount` float(10,2) DEFAULT NULL,
  `right_sn` varchar(20) DEFAULT NULL,
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `parent_id` int(11) unsigned NOT NULL,
  `parent_deep` int(10) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL COMMENT '返的金额',
  `percent` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '百分比',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_user_money_log
-- ----------------------------
INSERT INTO `ecs_user_money_log` VALUES ('44', '0', '0', null, null, '0', null, null, '1515047970', '39', '0', '-20.00', '0', '兑换电子币');
INSERT INTO `ecs_user_money_log` VALUES ('45', '2018010513115', '39', '3990.00', '2018010513115', null, null, null, '1515117396', '35', '3', '3990.00', '0', null);
