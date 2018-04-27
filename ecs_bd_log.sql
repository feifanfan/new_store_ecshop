/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-18 16:01:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_bd_log
-- ----------------------------
DROP TABLE IF EXISTS `ecs_bd_log`;
CREATE TABLE `ecs_bd_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户id',
  `bd_id` int(10) NOT NULL COMMENT '报单中心id',
  `bd_money` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '报单中心使用的现金数',
  `bd_upgrade` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '报单中心使用的升级币数',
  `bd_time` int(10) NOT NULL DEFAULT '0' COMMENT '报单时间',
  `bd_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '报单状态，0未审核1已审核',
  `admin_time` int(10) DEFAULT NULL COMMENT '后台审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
