/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : xu

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-17 13:31:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ecs_users
-- ----------------------------
DROP TABLE IF EXISTS `ecs_users`;
CREATE TABLE `ecs_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `parent_id` mediumint(9) unsigned DEFAULT '0' COMMENT '推荐人ID',
  `node_id` int(10) DEFAULT NULL,
  `bd_id` int(10) DEFAULT NULL COMMENT '报单中心id',
  `id_list` text COMMENT '用户ID链',
  `parent_side` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '父节点的左右边 1左边2右边',
  `parent_list` text COMMENT '推荐人链',
  `side_list` text COMMENT '所在边的链',
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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ecs_users
-- ----------------------------
INSERT INTO `ecs_users` VALUES ('1', '0', null, null, '1', '1', null, '1', '1', 'abcd11', '822fda9ba8094fb75b85b45b87da4d69', '4.75', '1.19', '0.00', '0.00', '0', '0', '18888888811', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231451', '1523842954', '127.0.0.1', '0000-00-00 00:00:00', '283', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '3', '0', '0', '7827', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '6', '20180416');
INSERT INTO `ecs_users` VALUES ('2', '1', null, null, '1,2', '1', null, '1,1', '2', 'abcd21', 'de473ae6e91a11d6e1c8f017df2f339e', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888821', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231496', '1523838290', '127.0.0.1', '0000-00-00 00:00:00', '2', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '15', '2', '0', '2683', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('3', '1', null, '1', '1,3', '2', null, '1,2', '2', 'abcd22', '6a0d54f35ada170c3c7fe91d23a821ff', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888822', null, null, null, null, null, null, '0.00', null, '0', '0', '', '0000-00-00', '1523231568', '1523579508', '192.168.1.122', '0000-00-00 00:00:00', '19', '', '2', null, null, null, null, null, null, null, null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', '6855', '0', '', '', '', '', '0', '0.00', null, null, '1', '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('4', '2', null, null, '1,2,4', '1', null, '1,1,1', '3', 'abcd31', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888831', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231628', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '4', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('5', '2', null, null, '1,2,5', '2', null, '1,1,2', '3', 'abcd32', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888832', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231690', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('6', '3', null, null, '1,3,6', '1', null, '1,2,1', '3', 'abcd33', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888833', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231726', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('7', '3', null, null, '1,3,7', '2', null, '1,2,2', '3', 'abcd34', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888834', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231760', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '4', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('8', '4', null, null, '1,2,4,8', '1', null, '1,1,1,1', '4', 'abcd41', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888841', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231800', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '3', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('9', '4', null, null, '1,2,4,9', '2', null, '1,1,1,2', '4', 'abcd42', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888842', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231835', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '4', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('10', '5', null, null, '1,2,5,10', '1', null, '1,1,2,1', '4', 'abcd43', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888843', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231875', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '1', '0', '0');
INSERT INTO `ecs_users` VALUES ('11', '6', null, null, '1,3,6,11', '1', null, '1,2,1,1', '4', 'abcd44', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888844', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231909', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('12', '6', null, null, '1,3,6,12', '2', null, '1,2,1,2', '4', 'abcd45', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888845', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523231968', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('13', '7', null, null, '1,3,7,13', '1', null, '1,2,2,1', '4', 'abcd46', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888846', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232017', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '4', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('14', '8', null, null, '1,2,4,8,14', '1', null, '1,1,1,1,1', '5', 'abcd51', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888851', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232064', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '3', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('15', '8', null, null, '1,2,4,8,15', '2', null, '1,1,1,1,2', '5', 'abcd52', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888852', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232108', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('16', '9', null, null, '1,2,4,9,16', '1', null, '1,1,1,2,1', '5', 'abcd53', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888853', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232391', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '2', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('17', '11', null, null, '1,3,6,11,17', '1', null, '1,2,1,1,1', '5', 'abcd54', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888854', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232446', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '3', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('18', '11', '17', null, '1,3,6,11,18', '2', null, '1,2,1,1,2', '5', 'abcd55', '66507c9a61b47aa0d31f65816b8d3f22', '0.00', '0.00', '100.00', '0.00', '0', '0', '18888888855', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232483', '1523669158', '127.0.0.1', '0000-00-00 00:00:00', '270', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '16', '2', '0', '7877', '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `ecs_users` VALUES ('19', '13', '16', null, '1,3,7,13,19', '1', null, '1,2,2,1,1', '5', 'abcd56', '96e79218965eb72c92a549dd5a330112', '0.00', '0.00', '0.00', '0.00', '0', '0', '18888888856', null, null, null, null, null, null, '0.00', null, '0', '0', '', '1958-01-01', '1523232522', '0', '', '0000-00-00 00:00:00', '0', '', '2', null, null, null, null, '0', '0', '0', null, null, null, null, null, '', '', '0', '0.00', '0', '0', '1', '0', null, '0', '', '', '', '', '0', '0.00', null, null, null, '0', 'pc', '', '', '', '', '0', '0', '0', '1', '0', '0', '0');
