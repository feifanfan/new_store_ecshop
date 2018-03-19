/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : suo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-17 10:36:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_users
-- ----------------------------
DROP TABLE IF EXISTS `ecs_users`;
CREATE TABLE `ecs_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `parent_id` mediumint(9) unsigned DEFAULT '0' COMMENT '推荐人ID',
  `id_list` text COMMENT '用户ID链',
  `parent_side` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '父节点的左右边 1左边2右边',
  `side_list` text COMMENT '所在边的链',
  `deep` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '相对于最高层的深度',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名称',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '奖金币',
  `user_cash` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '电子币',
  `user_point` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户的购物积分',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mobile_phone` varchar(20) NOT NULL COMMENT '手机号',
  `id_card` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `bank` varchar(255) DEFAULT NULL COMMENT '银行',
  `khh` varchar(255) DEFAULT NULL COMMENT '开户行',
  `bankcard_num` varchar(30) DEFAULT NULL,
  `khxm` varchar(64) DEFAULT NULL COMMENT '开户人姓名',
  `acid` varchar(64) DEFAULT NULL COMMENT '银行卡号',
  `team_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '团队业绩',
  `area_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '小区业绩(小区业绩是时刻变化的，可能用不到这个字段）',
  `alipay` varchar(128) DEFAULT NULL COMMENT '支付宝账号',
  `flag` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '账号状态 1注册用户 2报单会员 3服务中心',
  `bd_level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '报单会员等级',
  `fw_level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '服务中心等级',
  `install_price` tinyint(1) NOT NULL DEFAULT '0',
  `son_num` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '直系推荐数量 最大为2',
  `lft_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '左边用户数量',
  `rgt_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '右边用户数量',
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
  `buy_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `parent_id` (`parent_id`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_users
-- ----------------------------
INSERT INTO `ecs_users` VALUES ('38', '35', '35,38', '2', '2', '2', 'num3', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0', '0', '', null, null, null, null, null, null, '20030.00', '0.00', null, '0', '0', '0', '0', '0', '0', '0', '111111@qq.com', '1957-01-01', '1512347101', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '0', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('39', '37', '35,37,39', '1', '1,1', '3', 'num4', '2f4db1b39a223cc93a2146cddc0ef5f1', '0.00', '30.00', '20', '0', '', null, null, null, null, null, null, '11995.00', '0.00', null, '0', '9', '0', '0', '0', '0', '0', '22222@qq.com', '1957-01-01', '1512347169', '1516728788', '127.0.0.1', '0000-00-00 00:00:00', '7', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '50', '0.00', '0', '16', '0', '0', '7932', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '1');
INSERT INTO `ecs_users` VALUES ('40', '37', '35,37,40', '2', '1,2', '3', 'num5', '2f3d9eb3ed6e4476dbab03c4a1f92e86', '0.00', '0.00', '0', '0', '', null, null, null, null, null, null, '8030.00', '0.00', null, '0', '9', '0', '0', '0', '0', '0', '333333@qq.com', '1957-01-01', '1512347234', '1512409068', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '17', '0', '0', '9395', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '1');
INSERT INTO `ecs_users` VALUES ('41', '40', '35,37,40,41', '1', '1,2,1', '4', 'num6', '00653abad7fc100c94c495ccd6d4d361', '0.00', '0.00', '0', '0', '', null, null, null, null, null, null, '4015.00', '0.00', null, '0', '9', '0', '0', '0', '0', '0', '44444@qq.com', '1957-01-01', '1512347287', '1512347580', '127.0.0.1', '0000-00-00 00:00:00', '1', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '14', '0', '0', '5538', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('42', '38', '35,38,42', '1', '2,1', '3', 'num7', 'cff10f1cdd2e004b6c357e4a341dc7af', '0.00', '0.00', '0', '0', '', null, null, null, null, null, null, '4015.00', '0.00', null, '0', '9', '0', '0', '0', '0', '0', '666666@qq.com', '1957-01-01', '1512347368', '1516238932', '127.0.0.1', '0000-00-00 00:00:00', '2', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '18', '0', '0', '6253', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '1');
INSERT INTO `ecs_users` VALUES ('43', '38', '35,38,43', '2', '2,2', '3', 'num8', '1da877c381bee7977fe394c6d346c751', '0.00', '0.00', '0', '0', '', null, null, null, null, null, null, '16015.00', '0.00', null, '0', '9', '0', '0', '0', '0', '0', '77777@qq.com', '1957-01-01', '1512347403', '1512433257', '127.0.0.1', '0000-00-00 00:00:00', '3', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '19', '0', '0', '8685', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '1');
