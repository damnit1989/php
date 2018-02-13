/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : open_source_bms

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-02-13 15:15:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `os_action_log`
-- ----------------------------
DROP TABLE IF EXISTS `os_action_log`;
CREATE TABLE `os_action_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) NOT NULL COMMENT '登录的用户ID',
  `username` varchar(20) NOT NULL COMMENT '登录的用户名',
  `ip` varchar(20) NOT NULL COMMENT 'ip地址',
  `content` varchar(256) NOT NULL COMMENT '日志内容',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='日志记录表';



-- ----------------------------
-- Table structure for `os_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `os_admin_user`;
CREATE TABLE `os_admin_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1 启用 0 禁用',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of os_admin_user
-- ----------------------------
INSERT INTO `os_admin_user` VALUES ('1', 'admin', 'c6ea4d67a4216c380568a8ad98f17049', '1', '2016-10-18 15:28:37', '2018-02-13 13:38:43', '127.0.0.1');

-- ----------------------------
-- Table structure for `os_article`
-- ----------------------------
DROP TABLE IF EXISTS `os_article`;
CREATE TABLE `os_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `cid` smallint(5) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `introduction` varchar(255) DEFAULT '' COMMENT '简介',
  `content` longtext COMMENT '内容',
  `author` varchar(20) DEFAULT '' COMMENT '作者',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 待审核  1 审核',
  `reading` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读量',
  `thumb` varchar(255) DEFAULT '' COMMENT '缩略图',
  `photo` text COMMENT '图集',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶  0 不置顶  1 置顶',
  `is_recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐  0 不推荐  1 推荐',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `publish_time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of os_article
-- ----------------------------
INSERT INTO `os_article` VALUES ('1', '1', '测试文章一', '', '<p>测试内容</p>', 'admin', '1', '0', '', null, '0', '0', '0', '2017-04-11 14:10:10', '2017-04-11 14:09:45');

-- ----------------------------
-- Table structure for `os_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group`;
CREATE TABLE `os_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL COMMENT '权限规则ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='权限组表';

-- ----------------------------
-- Records of os_auth_group
-- ----------------------------
INSERT INTO `os_auth_group` VALUES ('1', '超级管理组', '1', '1,2,3,73,74,5,6,7,8,9,10,11,12,39,40,41,42,43,14,13,20,21,22,23,24,15,25,26,27,28,29,30,16,17,44,45,46,47,48,18,49,50,51,52,53,19,31,32,33,34,35,36,37,54,55,58,59,60,61,62,56,63,64,65,66,67,57,68,69,70,71,72');

-- ----------------------------
-- Table structure for `os_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group_access`;
CREATE TABLE `os_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限组规则表';

-- ----------------------------
-- Records of os_auth_group_access
-- ----------------------------
INSERT INTO `os_auth_group_access` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `os_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_rule`;
CREATE TABLE `os_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '规则名称',
  `title` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `pid` smallint(5) unsigned NOT NULL COMMENT '父级ID',
  `icon` varchar(50) DEFAULT '' COMMENT '图标',
  `sort` tinyint(4) unsigned NOT NULL COMMENT '排序',
  `condition` char(100) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of os_auth_rule
-- ----------------------------
INSERT INTO `os_auth_rule` VALUES ('1', 'admin/System/default', '系统配置', '1', '1', '0', 'fa fa-gears', '0', '');
INSERT INTO `os_auth_rule` VALUES ('2', 'admin/System/siteConfig', '站点配置', '1', '1', '1', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('3', 'admin/System/updateSiteConfig', '更新配置', '1', '0', '1', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('5', 'admin/Menu/default', '菜单管理', '1', '1', '0', 'fa fa-bars', '0', '');
INSERT INTO `os_auth_rule` VALUES ('6', 'admin/Menu/index', '后台菜单', '1', '1', '5', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('7', 'admin/Menu/add', '添加菜单', '1', '0', '6', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('8', 'admin/Menu/save', '保存菜单', '1', '0', '6', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('9', 'admin/Menu/edit', '编辑菜单', '1', '0', '6', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('10', 'admin/Menu/update', '更新菜单', '1', '0', '6', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('11', 'admin/Menu/delete', '删除菜单', '1', '0', '6', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('12', 'admin/Nav/index', '导航管理', '1', '1', '5', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('13', 'admin/Category/index', '栏目管理', '1', '1', '14', 'fa fa-sitemap', '0', '');
INSERT INTO `os_auth_rule` VALUES ('14', 'admin/Content/default', '内容管理', '1', '1', '0', 'fa fa-file-text', '0', '');
INSERT INTO `os_auth_rule` VALUES ('15', 'admin/Article/index', '文章管理', '1', '1', '14', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('16', 'admin/User/default', '用户管理', '1', '1', '0', 'fa fa-users', '0', '');
INSERT INTO `os_auth_rule` VALUES ('17', 'admin/User/index', '普通用户', '1', '1', '16', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('18', 'admin/AdminUser/index', '管理员', '1', '1', '16', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('19', 'admin/AuthGroup/index', '权限组', '1', '1', '16', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('20', 'admin/Category/add', '添加栏目', '1', '0', '13', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('21', 'admin/Category/save', '保存栏目', '1', '0', '13', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('22', 'admin/Category/edit', '编辑栏目', '1', '0', '13', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('23', 'admin/Category/update', '更新栏目', '1', '0', '13', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('24', 'admin/Category/delete', '删除栏目', '1', '0', '13', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('25', 'admin/Article/add', '添加文章', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('26', 'admin/Article/save', '保存文章', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('27', 'admin/Article/edit', '编辑文章', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('28', 'admin/Article/update', '更新文章', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('29', 'admin/Article/delete', '删除文章', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('30', 'admin/Article/toggle', '文章审核', '1', '0', '15', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('31', 'admin/AuthGroup/add', '添加权限组', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('32', 'admin/AuthGroup/save', '保存权限组', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('33', 'admin/AuthGroup/edit', '编辑权限组', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('34', 'admin/AuthGroup/update', '更新权限组', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('35', 'admin/AuthGroup/delete', '删除权限组', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('36', 'admin/AuthGroup/auth', '授权', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('37', 'admin/AuthGroup/updateAuthGroupRule', '更新权限组规则', '1', '0', '19', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('39', 'admin/Nav/add', '添加导航', '1', '0', '12', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('40', 'admin/Nav/save', '保存导航', '1', '0', '12', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('41', 'admin/Nav/edit', '编辑导航', '1', '0', '12', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('42', 'admin/Nav/update', '更新导航', '1', '0', '12', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('43', 'admin/Nav/delete', '删除导航', '1', '0', '12', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('44', 'admin/User/add', '添加用户', '1', '0', '17', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('45', 'admin/User/save', '保存用户', '1', '0', '17', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('46', 'admin/User/edit', '编辑用户', '1', '0', '17', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('47', 'admin/User/update', '更新用户', '1', '0', '17', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('48', 'admin/User/delete', '删除用户', '1', '0', '17', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('49', 'admin/AdminUser/add', '添加管理员', '1', '0', '18', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('50', 'admin/AdminUser/save', '保存管理员', '1', '0', '18', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('51', 'admin/AdminUser/edit', '编辑管理员', '1', '0', '18', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('52', 'admin/AdminUser/update', '更新管理员', '1', '0', '18', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('53', 'admin/AdminUser/delete', '删除管理员', '1', '0', '18', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('54', 'admin/Slide/default', '扩展管理', '1', '1', '0', 'fa fa-wrench', '0', '');
INSERT INTO `os_auth_rule` VALUES ('55', 'admin/SlideCategory/index', '轮播分类', '1', '1', '54', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('56', 'admin/Slide/index', '轮播图管理', '1', '1', '54', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('57', 'admin/Link/index', '友情链接', '1', '1', '54', 'fa fa-link', '0', '');
INSERT INTO `os_auth_rule` VALUES ('58', 'admin/SlideCategory/add', '添加分类', '1', '0', '55', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('59', 'admin/SlideCategory/save', '保存分类', '1', '0', '55', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('60', 'admin/SlideCategory/edit', '编辑分类', '1', '0', '55', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('61', 'admin/SlideCategory/update', '更新分类', '1', '0', '55', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('62', 'admin/SlideCategory/delete', '删除分类', '1', '0', '55', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('63', 'admin/Slide/add', '添加轮播', '1', '0', '56', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('64', 'admin/Slide/save', '保存轮播', '1', '0', '56', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('65', 'admin/Slide/edit', '编辑轮播', '1', '0', '56', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('66', 'admin/Slide/update', '更新轮播', '1', '0', '56', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('67', 'admin/Slide/delete', '删除轮播', '1', '0', '56', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('68', 'admin/Link/add', '添加链接', '1', '0', '57', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('69', 'admin/Link/save', '保存链接', '1', '0', '57', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('70', 'admin/Link/edit', '编辑链接', '1', '0', '57', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('71', 'admin/Link/update', '更新链接', '1', '0', '57', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('72', 'admin/Link/delete', '删除链接', '1', '0', '57', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('73', 'admin/ChangePassword/index', '修改密码', '1', '1', '1', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('74', 'admin/ChangePassword/updatePassword', '更新密码', '1', '0', '1', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('75', 'admin/Company/default', '企业管理', '1', '1', '0', 'fa fa-wrench', '0', '');
INSERT INTO `os_auth_rule` VALUES ('76', 'admin/Company/index', '企业信息', '1', '1', '75', '', '0', '');
INSERT INTO `os_auth_rule` VALUES ('77', 'admin/Member/index', '成员管理', '1', '1', '75', '', '0', '');

-- ----------------------------
-- Table structure for `os_category`
-- ----------------------------
DROP TABLE IF EXISTS `os_category`;
CREATE TABLE `os_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `alias` varchar(50) DEFAULT '' COMMENT '导航别名',
  `content` longtext COMMENT '分类内容',
  `thumb` varchar(255) DEFAULT '' COMMENT '缩略图',
  `icon` varchar(20) DEFAULT '' COMMENT '分类图标',
  `list_template` varchar(50) DEFAULT '' COMMENT '分类列表模板',
  `detail_template` varchar(50) DEFAULT '' COMMENT '分类详情模板',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '分类类型  1  列表  2 单页',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `path` varchar(255) DEFAULT '' COMMENT '路径',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of os_category
-- ----------------------------
INSERT INTO `os_category` VALUES ('1', '分类一', '', '', '', '', '', '', '1', '0', '0', '0,', '2016-12-22 18:22:24');

-- ----------------------------
-- Table structure for `os_company`
-- ----------------------------
DROP TABLE IF EXISTS `os_company`;
CREATE TABLE `os_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(256) NOT NULL COMMENT '密码',
  `company_name` varchar(256) NOT NULL COMMENT '企业名称',
  `logo_url` varchar(256) DEFAULT NULL COMMENT '企业logon',
  `telphone` varchar(20) DEFAULT NULL COMMENT '企业联系方式',
  `email` varchar(50) DEFAULT NULL COMMENT '企业邮箱',
  `addr` varchar(256) DEFAULT NULL COMMENT '企业地址',
  `qq` varchar(20) DEFAULT NULL COMMENT '企业qq',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业信息表';

-- ----------------------------
-- Records of os_company
-- ----------------------------
INSERT INTO `os_company` VALUES ('1', 'mj', '90c367b260328c6260757669b6d116a7', '', null, '12345678901', '33@qq.com', 'xxxx', '345353', '2018-02-07 12:26:33', '2018-02-13 13:30:40');
INSERT INTO `os_company` VALUES ('2', 'test', '90c367b260328c6260757669b6d116a7', '', null, '12345678963', '77@qq.com', 'xxxxx', '78945', '2018-02-07 13:23:04', '2018-02-13 13:31:38');

-- ----------------------------
-- Table structure for `os_company_camera_set`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_camera_set`;
CREATE TABLE `os_company_camera_set` (
  `company_id` int(11) unsigned NOT NULL COMMENT '关联企业id',
  `is_camera` tinyint(1) unsigned DEFAULT '1' COMMENT '是否开启拍照 0关闭 1开启',
  `wait_time` tinyint(1) unsigned DEFAULT '3' COMMENT '拍照等待时间',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业拍照设置表';

-- ----------------------------
-- Records of os_company_camera_set
-- ----------------------------
INSERT INTO `os_company_camera_set` VALUES ('1', '1', '10');

-- ----------------------------
-- Table structure for `os_company_info`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_info`;
CREATE TABLE `os_company_info` (
  `company_id` int(11) unsigned NOT NULL COMMENT '关联企业id',
  `company_name` varchar(256) NOT NULL COMMENT '企业名称',
  `logo_url` varchar(256) DEFAULT NULL COMMENT '企业logon',
  `welcome_word` varchar(256) DEFAULT NULL COMMENT '企业欢迎语',
  `qr_code` varchar(256) DEFAULT NULL COMMENT '企业二维码地址',
  `addr` varchar(256) DEFAULT NULL COMMENT '企业地址',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业信息表';

-- ----------------------------
-- Records of os_company_info
-- ----------------------------
INSERT INTO `os_company_info` VALUES ('1', '3333333', '/uploads/20180211/b2c6e4394f2f274392cbb619f60a52c3.jpg', '欢迎您的到来', null, '这是企业的地址', '2018-02-12 15:59:09', '2018-02-12 15:59:09');

-- ----------------------------
-- Table structure for `os_company_member`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member`;
CREATE TABLE `os_company_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_1`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_1`;
CREATE TABLE `os_company_member_1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_1
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_10`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_10`;
CREATE TABLE `os_company_member_10` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_10
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_2`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_2`;
CREATE TABLE `os_company_member_2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_2
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_3`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_3`;
CREATE TABLE `os_company_member_3` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';



-- ----------------------------
-- Table structure for `os_company_member_4`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_4`;
CREATE TABLE `os_company_member_4` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_4
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_5`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_5`;
CREATE TABLE `os_company_member_5` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_5
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_6`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_6`;
CREATE TABLE `os_company_member_6` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_6
-- ----------------------------
INSERT INTO `os_company_member_6` VALUES ('1', '2', 'test_1', '12345678978', '888@qq.com', null, '2018-02-07 13:24:47', '2018-02-07 13:24:47');
INSERT INTO `os_company_member_6` VALUES ('2', '2', 'test_2', '98765432101', '88@qq.com', null, '2018-02-07 13:34:25', '2018-02-07 13:34:25');

-- ----------------------------
-- Table structure for `os_company_member_7`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_7`;
CREATE TABLE `os_company_member_7` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_7
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_8`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_8`;
CREATE TABLE `os_company_member_8` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_8
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_member_9`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_member_9`;
CREATE TABLE `os_company_member_9` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '所属企业id',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业成员表';

-- ----------------------------
-- Records of os_company_member_9
-- ----------------------------

-- ----------------------------
-- Table structure for `os_company_notice_set`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_notice_set`;
CREATE TABLE `os_company_notice_set` (
  `company_id` int(11) unsigned NOT NULL COMMENT '关联企业id',
  `is_send_email` tinyint(1) unsigned DEFAULT '1' COMMENT '是否发送邮件 0关闭 1开启',
  `is_send_msg` tinyint(1) unsigned DEFAULT '1' COMMENT '是否发送短信 0关闭 1开启',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='企业通知设置表';

-- ----------------------------
-- Records of os_company_notice_set
-- ----------------------------
INSERT INTO `os_company_notice_set` VALUES ('1', '0', '1');

-- ----------------------------
-- Table structure for `os_company_token`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_token`;
CREATE TABLE `os_company_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) NOT NULL COMMENT '企业ID',
  `token` char(35) DEFAULT '' COMMENT 'ipad登录返回token',
  `expired_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='token表';

-- ----------------------------
-- Records of os_company_token
-- ----------------------------
INSERT INTO `os_company_token` VALUES ('4', '1', 'a10889a9f1b69b9fbbdf650acf935f99', '1518403913');

-- ----------------------------
-- Table structure for `os_company_visit`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_visit`;
CREATE TABLE `os_company_visit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '关联企业id',
  `visit_name` varchar(256) DEFAULT NULL COMMENT '访客类型名称',
  `visit_code` varchar(256) DEFAULT NULL COMMENT '访客类型码',
  `is_open` tinyint(1) unsigned DEFAULT '1' COMMENT '是否开启 0关闭 1开启',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='访客类型表';

-- ----------------------------
-- Records of os_company_visit
-- ----------------------------
INSERT INTO `os_company_visit` VALUES ('186', '1', '面试', null, '0', null, '2018-02-12 14:46:48');
INSERT INTO `os_company_visit` VALUES ('187', '1', '亲友', null, '1', null, '2018-02-12 14:46:48');
INSERT INTO `os_company_visit` VALUES ('188', '1', '商户', null, '0', null, '2018-02-12 14:46:48');
INSERT INTO `os_company_visit` VALUES ('189', '1', '其他', null, '1', null, '2018-02-12 14:46:48');

-- ----------------------------
-- Table structure for `os_company_visit_field`
-- ----------------------------
DROP TABLE IF EXISTS `os_company_visit_field`;
CREATE TABLE `os_company_visit_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `visit_id` int(11) unsigned NOT NULL COMMENT '关联访客类型id',
  `company_id` int(11) unsigned NOT NULL COMMENT '关联企业id',
  `field_name` varchar(256) DEFAULT NULL COMMENT '字段名称',
  `is_open` tinyint(1) unsigned DEFAULT '1' COMMENT '是否开启 0关闭 1开启',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='访客类型字段表';

-- ----------------------------
-- Records of os_company_visit_field
-- ----------------------------
INSERT INTO `os_company_visit_field` VALUES ('33', '186', '1', '姓名', '0', null, '2018-02-12 15:54:53');
INSERT INTO `os_company_visit_field` VALUES ('34', '186', '1', '电话', '1', null, '2018-02-12 15:54:53');
INSERT INTO `os_company_visit_field` VALUES ('35', '186', '1', 'email', '1', null, '2018-02-12 15:54:53');
INSERT INTO `os_company_visit_field` VALUES ('36', '186', '1', '身份证', '0', null, '2018-02-12 15:54:53');
INSERT INTO `os_company_visit_field` VALUES ('37', '186', '1', '旅游', '1', null, '2018-02-12 15:54:53');

-- ----------------------------
-- Table structure for `os_link`
-- ----------------------------
DROP TABLE IF EXISTS `os_link`;
CREATE TABLE `os_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '链接名称',
  `link` varchar(255) DEFAULT '' COMMENT '链接地址',
  `image` varchar(255) DEFAULT '' COMMENT '链接图片',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1 显示  2 隐藏',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of os_link
-- ----------------------------

-- ----------------------------
-- Table structure for `os_nav`
-- ----------------------------
DROP TABLE IF EXISTS `os_nav`;
CREATE TABLE `os_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL COMMENT '父ID',
  `name` varchar(20) NOT NULL COMMENT '导航名称',
  `alias` varchar(20) DEFAULT '' COMMENT '导航别称',
  `link` varchar(255) DEFAULT '' COMMENT '导航链接',
  `icon` varchar(255) DEFAULT '' COMMENT '导航图标',
  `target` varchar(10) DEFAULT '' COMMENT '打开方式',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态  0 隐藏  1 显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Records of os_nav
-- ----------------------------

-- ----------------------------
-- Table structure for `os_slide`
-- ----------------------------
DROP TABLE IF EXISTS `os_slide`;
CREATE TABLE `os_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '轮播图名称',
  `description` varchar(255) DEFAULT '' COMMENT '说明',
  `link` varchar(255) DEFAULT '' COMMENT '链接',
  `target` varchar(10) DEFAULT '' COMMENT '打开方式',
  `image` varchar(255) DEFAULT '' COMMENT '轮播图片',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态  1 显示  0  隐藏',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='轮播图表';

-- ----------------------------
-- Records of os_slide
-- ----------------------------

-- ----------------------------
-- Table structure for `os_slide_category`
-- ----------------------------
DROP TABLE IF EXISTS `os_slide_category`;
CREATE TABLE `os_slide_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '轮播图分类',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='轮播图分类表';

-- ----------------------------
-- Records of os_slide_category
-- ----------------------------
INSERT INTO `os_slide_category` VALUES ('1', '首页轮播');

-- ----------------------------
-- Table structure for `os_system`
-- ----------------------------
DROP TABLE IF EXISTS `os_system`;
CREATE TABLE `os_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '配置项名称',
  `value` text NOT NULL COMMENT '配置项值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of os_system
-- ----------------------------
INSERT INTO `os_system` VALUES ('1', 'site_config', 'a:7:{s:10:\"site_title\";s:30:\"Think Admin 后台管理系统\";s:9:\"seo_title\";s:0:\"\";s:11:\"seo_keyword\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:14:\"site_copyright\";s:0:\"\";s:8:\"site_icp\";s:0:\"\";s:11:\"site_tongji\";s:0:\"\";}');

-- ----------------------------
-- Table structure for `os_test`
-- ----------------------------
DROP TABLE IF EXISTS `os_test`;
CREATE TABLE `os_test` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(20) NOT NULL COMMENT '访客姓名',
  `visitor_phone` varchar(11) NOT NULL COMMENT '访客电话',
  `visitor_email` varchar(50) DEFAULT NULL COMMENT '访客邮箱',
  `visitor_type` varchar(10) DEFAULT NULL COMMENT '来访目的',
  `member_name` varchar(20) DEFAULT NULL COMMENT '关联被访问者',
  `company_id` int(11) unsigned DEFAULT NULL COMMENT '关联所属企业id',
  `member_id` int(11) unsigned NOT NULL COMMENT '关联被访问者id',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='来访记录测试表';

-- ----------------------------
-- Records of os_test
-- ----------------------------
INSERT INTO `os_test` VALUES ('1', '张三', '12345678965', '44@qq.com', '面试', '李四', null, '0', '2018-02-06 17:12:12', '2018-02-06 17:12:15');
INSERT INTO `os_test` VALUES ('2', '张二', '12345678904', 'erw@qq.com', '拜访', '王五', null, '0', '2018-02-06 17:17:50', '2018-02-06 17:17:54');

-- ----------------------------
-- Table structure for `os_user`
-- ----------------------------
DROP TABLE IF EXISTS `os_user`;
CREATE TABLE `os_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT '' COMMENT '手机',
  `email` varchar(50) DEFAULT '' COMMENT '邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态  1 正常  2 禁止',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `last_login_ip` varchar(50) DEFAULT '' COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of os_user
-- ----------------------------
INSERT INTO `os_user` VALUES ('1', 'lmm', '7b79e788e94c1c41b6d4e1b1280c4bdb', '123456897', '2345@qq.com', '1', '2018-02-06 10:19:03', null, '');

-- ----------------------------
-- Table structure for `os_visitor`
-- ----------------------------
DROP TABLE IF EXISTS `os_visitor`;
CREATE TABLE `os_visitor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `visitor_name` varchar(20) NOT NULL COMMENT '访客姓名',
  `visitor_phone` varchar(11) NOT NULL COMMENT '访客电话',
  `visitor_email` varchar(50) DEFAULT NULL COMMENT '访客邮箱',
  `visitor_type` varchar(10) DEFAULT NULL COMMENT '来访目的',
  `member_id` int(11) unsigned NOT NULL COMMENT '关联被访问者id',
  `company_id` int(11) unsigned NOT NULL COMMENT '关联所属企业id',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '插入时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='访客记录表';

-- ----------------------------
-- Records of os_visitor
-- ----------------------------

