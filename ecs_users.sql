/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-02 09:05:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_users
-- ----------------------------
DROP TABLE IF EXISTS `ecs_users`;
CREATE TABLE `ecs_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `parent_id` mediumint(9) unsigned DEFAULT '0' COMMENT '推荐人ID',
  `parent_list` text COMMENT '推荐人链',
  `node_id` int(10) DEFAULT NULL,
  `node_list` text COMMENT '用户ID链',
  `parent_side` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '父节点的左右边 1左边2右边',
  `side_list` text COMMENT '所在边的链',
  `bd_id` int(10) DEFAULT NULL COMMENT '报单中心id',
  `deep` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '相对于最高层的深度',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名称',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_money` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '奖金(收益)',
  `user_cash` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '重销',
  `user_point` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '企业币',
  `user_upgrade` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '升级币',
  `user_voucher` float(10,0) NOT NULL DEFAULT '0' COMMENT '代金币',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mobile_phone` varchar(20) NOT NULL COMMENT '手机号',
  `id_card` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `bank` varchar(255) DEFAULT NULL COMMENT '银行',
  `khh` varchar(255) DEFAULT NULL COMMENT '开户行',
  `bankcard_num` varchar(30) DEFAULT NULL,
  `khxm` varchar(64) DEFAULT NULL COMMENT '开户人姓名',
  `acid` varchar(64) DEFAULT NULL COMMENT '银行卡号',
  `team_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '团队业绩',
  `alipay` varchar(128) DEFAULT NULL COMMENT '支付宝账号',
  `install_price` tinyint(1) NOT NULL DEFAULT '0',
  `son_num` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '直系推荐数量 最大为2',
  `email` varchar(60) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `visit_count` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `qq` varchar(20) DEFAULT NULL COMMENT '用户QQ',
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '默认不关注 关注1不关注0',
  `headimg` varchar(255) DEFAULT NULL COMMENT '用户头像（微信头像）',
  `openid` varchar(64) DEFAULT NULL COMMENT '微信OPENID',
  `nickname` varchar(128) DEFAULT NULL COMMENT '微信昵称',
  `language` varchar(16) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `province` varchar(32) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `subscribe_time` int(10) unsigned DEFAULT NULL COMMENT '关注时间',
  `unionid` varchar(64) DEFAULT NULL COMMENT '开放平台ID',
  `groupid` int(11) DEFAULT NULL COMMENT '分组ID',
  `tagid_list` varchar(255) DEFAULT NULL COMMENT '标签ID列表',
  `======zhelizhishiyigefenliziduan=======` varchar(255) DEFAULT NULL COMMENT '单纯的起到分割作用',
  `question` varchar(255) NOT NULL DEFAULT '' COMMENT '不知道干啥的',
  `answer` varchar(255) NOT NULL DEFAULT '' COMMENT '不知道干啥的',
  `pay_points` int(10) unsigned NOT NULL DEFAULT '0',
  `frozen_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rank_points` int(10) unsigned NOT NULL DEFAULT '0',
  `address_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_rank` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_special` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ec_salt` varchar(10) DEFAULT NULL,
  `salt` varchar(10) NOT NULL DEFAULT '0',
  `alias` varchar(60) NOT NULL,
  `msn` varchar(60) NOT NULL,
  `office_phone` varchar(20) NOT NULL,
  `home_phone` varchar(20) NOT NULL,
  `is_validated` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credit_line` decimal(10,2) unsigned NOT NULL,
  `passwd_question` varchar(50) DEFAULT NULL,
  `passwd_answer` varchar(255) DEFAULT NULL,
  `validated` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `froms` char(10) NOT NULL DEFAULT 'pc' COMMENT '''pc:电脑,mobile:手机,app:应用''',
  `real_name` varchar(255) NOT NULL,
  `card` varchar(255) NOT NULL,
  `face_card` varchar(255) NOT NULL,
  `back_card` varchar(255) NOT NULL,
  `district` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `is_surplus_open` tinyint(1) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否激活',
  `bd_status` tinyint(1) NOT NULL DEFAULT '0',
  `fd_num` int(10) NOT NULL DEFAULT '0',
  `fd_date` int(10) NOT NULL DEFAULT '0',
  `jiandian` float(10,2) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_users
-- ----------------------------
INSERT INTO `ecs_users` VALUES ('24', '21', '21,24', '21', '21,24', '1', '1,1', null, '2', 'sghdfg', '96e79218965eb72c92a549dd5a330112', '9.60', '2.40', '0.00', '0.00', '0', '0', '15963641355', null, null, null, null, null, null, '4000.00', null, '0', '0', '', '0000-00-00', '1523919850', '1523919850', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '3', '0', null, '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '12', '20180425', '0.00');
INSERT INTO `ecs_users` VALUES ('25', '24', '21,24,25', '21', '21,25', '2', '1,2', '0', '2', 'fgasg41', '291e6735899ac32244f24534406fd9e4', '1648.00', '412.00', '0.00', '0.00', '0', '0', '18463287472', null, null, null, null, null, null, '5000.00', null, '0', '0', '', '0000-00-00', '1523919951', '1524849819', '127.0.0.1', '0000-00-00 00:00:00', '16', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '500', '0.00', '0', '17', '4', '0', '2708', '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '50', '20180428', '150.00');
INSERT INTO `ecs_users` VALUES ('26', '21', '21,26', '24', '21,24,26', '1', '1,1,1', '21', '3', 'hfaujhk', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '15263698565', null, null, null, null, null, null, '5000.00', null, '0', '0', '', '0000-00-00', '1523920236', '1523920236', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0.00');
INSERT INTO `ecs_users` VALUES ('27', '21', '21,27', '24', '21,24,27', '2', '1,1,2', '0', '3', 'djkasdka', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '15963522336', null, null, null, null, null, null, '5000.00', null, '0', '0', '', '0000-00-00', '1523926721', '1523926721', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0.00');
INSERT INTO `ecs_users` VALUES ('28', '25', '21,24,25,28', '25', '21,25,28', '1', '1,2,1', '0', '3', 'hgghhb', 'bfd776beb4bbab0d5a1fc2f30bc15bc1', '0.00', '0.00', '0.00', '3840.00', '0', '0', '15263698563', null, null, null, null, null, null, '3000.00', null, '0', '0', '', '0000-00-00', '1523927516', '1524007045', '127.0.0.1', '0000-00-00 00:00:00', '2', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', '9243', '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0.00');
INSERT INTO `ecs_users` VALUES ('29', '21', '21,29', '25', '21,25,29', '2', '1,2,2', '0', '3', 'sdfasdfas', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '16985634456', null, null, null, null, null, null, '4000.00', null, '0', '0', '', '0000-00-00', '1523927880', '1523927880', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0.00');
INSERT INTO `ecs_users` VALUES ('21', '0', '21', '0', '21', '1', '1', '0', '1', 'h159636', '96e79218965eb72c92a549dd5a330112', '1105.60', '276.40', '0.00', '0.00', '0', '0', '15963542155', null, null, null, null, null, null, '5000.00', null, '0', '0', '', '0000-00-00', '1523918715', '1523918715', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '1', '50', '20180428', '150.00');
