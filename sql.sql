-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-31 07:04:23
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `poi`
--
CREATE DATABASE IF NOT EXISTS `poi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `poi`;

-- --------------------------------------------------------

--
-- 表的结构 `poi_admin`
--

DROP TABLE IF EXISTS `poi_admin`;
CREATE TABLE IF NOT EXISTS `poi_admin` (
  `admin_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户级别',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_admin`
--

INSERT INTO `poi_admin` (`admin_id`, `username`, `password`, `lastloginip`, `lastlogintime`, `email`, `realname`, `level`, `status`) VALUES
(1, 'admin', '7f0c455ba19ed24cdb284eefb856e9fb', '127.0.0.1', 1507352381, '', 'Sakura', 255, 1);

-- --------------------------------------------------------

--
-- 表的结构 `poi_content`
--

DROP TABLE IF EXISTS `poi_content`;
CREATE TABLE IF NOT EXISTS `poi_content` (
  `content_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属栏目ID',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `keywords` char(40) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(250) DEFAULT NULL COMMENT '备注',
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '来源',
  `author` char(20) NOT NULL DEFAULT '',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`),
  KEY `status` (`status`,`listorder`,`content_id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`content_id`),
  KEY `catid` (`catid`,`status`,`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_content`
--

INSERT INTO `poi_content` (`content_id`, `catid`, `title`, `title_font_color`, `thumb`, `keywords`, `description`, `posids`, `listorder`, `status`, `copyfrom`, `author`, `create_time`, `update_time`, `count`) VALUES
(1, 4, 'a', '#000000', '/Upload/image/thumb/2017-10-10/59dc9fa67b152.jpg', 'aaaaaaaaaaaaaa', 'aa', '', 0, 1, '本站', 'qqq', 1507631023, 0, 0),
(2, 1, 'a', '#000000', '/Upload/image/thumb/2017-10-10/59dca0037fc31.jpg', 'aaaaaaaaaa', 'aaa', '', 0, 1, '本站', 'admin', 1507631115, 0, 0),
(3, 4, 'a', '#000000', '', 'aaaaaaaaaa', 'aaaaaaaaaaaa', '', 0, 1, '本站', 'admin', 1507631167, 0, 0),
(4, 1, 'sssssss', '#000000', '', 's', 's', '', 0, 1, '本站', 'admin', 1507637499, 0, 0),
(5, 2, '萨达是', '#000000', '', '玩玩', '我', '', 0, -1, '本站', 'admin', 1507641823, 0, 0),
(6, 4, '逗比', '#000000', '', 'a', 'a', '', 0, -1, '本站', 'admin', 1507694266, 0, 0),
(7, 4, '逗比', '#000000', '', 'a', 'a', '', 0, -1, '本站', 'admin', 1507694335, 0, 0),
(8, 4, 's', '#000000', '', 'a', 's', '', 0, 1, 's', 'admin', 1507829097, 1507829097, 0),
(9, 4, 'a', '#000000', '/Upload/image/thumb/2017-10-15/59e34bbbbf604.jpg', 'a', '', '', 0, 1, '', 'admin', 1507894330, 1507894330, 0);

-- --------------------------------------------------------

--
-- 表的结构 `poi_content_c`
--

DROP TABLE IF EXISTS `poi_content_c`;
CREATE TABLE IF NOT EXISTS `poi_content_c` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_id` mediumint(8) UNSIGNED NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_content_c`
--

INSERT INTO `poi_content_c` (`id`, `content_id`, `content`, `create_time`, `update_time`) VALUES
(1, 1, 'aaaaaasssssssssssssssssssssssssssss', 1507631023, 1507795340),
(2, 2, '&lt;p&gt;\r\n	asdas\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	asdsadas\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	ca\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	scf\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	fedgv\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	erg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	re\r\n&lt;/p&gt;', 1507631115, 0),
(3, 3, '&lt;img src=&quot;/Upload/image/contentK/2017-10-10/59dca03bbe635.jpg&quot; alt=&quot;&quot; /&gt;', 1507631167, 0),
(4, 4, 's                                    ', 1507637499, 1507883104),
(5, 5, '<p>\r\n	我dddddddddd的风格地方\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	sdfsfr\r\n</p>', 1507641823, 1507777239),
(6, 6, 'w', 1507694266, 0),
(7, 7, '<p>\r\n	waaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa暗杀大师丹江口\r\n</p>\r\n<p>\r\n	dfgdfgdf\r\n</p>\r\n<p>\r\n	dhrt\r\n</p>', 1507694335, 1507777248),
(8, 8, 'd', 1507829097, 1507829097),
(9, 9, '&lt;p&gt;0&lt;/p&gt;&lt;video class=&quot;edui-faked-video video-js&quot; controls=&quot;&quot; preload=&quot;none&quot; width=&quot;420&quot; height=&quot;280&quot; src=&quot;/upload/video/1.mp4&quot;&gt;&lt;/video&gt;&lt;p&gt;&lt;/p&gt;', 1507894330, 1508155139);

-- --------------------------------------------------------

--
-- 表的结构 `poi_menu`
--

DROP TABLE IF EXISTS `poi_menu`;
CREATE TABLE IF NOT EXISTS `poi_menu` (
  `menu_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_menu`
--

INSERT INTO `poi_menu` (`menu_id`, `name`, `parentid`, `m`, `c`, `f`, `data`, `listorder`, `status`, `type`) VALUES
(1, 'HTML', 0, 'home', 'cat', 'index', '', 0, 1, 0),
(2, 'CSS', 0, 'home', 'cat', 'index', '', 0, 1, 0),
(3, 'JavaScript', 0, 'home', 'cat ', 'index', '', 0, 1, 0),
(4, 'PHP', 0, 'home', 'cat', 'index', '', 0, 1, 0),
(12, '后台首页', 0, 'admin', 'index', 'index', '', 0, -1, 1),
(13, '后台首页2', 0, 'admin', 'index', 'index', '', 0, -1, 1),
(15, 'a', 0, 'a', 's', 'd', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `poi_position`
--

DROP TABLE IF EXISTS `poi_position`;
CREATE TABLE IF NOT EXISTS `poi_position` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_position`
--

INSERT INTO `poi_position` (`id`, `name`, `status`, `description`, `create_time`, `update_time`) VALUES
(1, '首页大图1', 1, '展示首页大图的推荐位1', 0, 0),
(2, '首页大图2', 1, '展示首页大图的推荐位2', 0, 0),
(3, '首页大图3', 1, '展示首页大图的推荐位3', 0, 0),
(4, '首页小图', 1, '展示首页小图的推荐位1', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `poi_position_content`
--

DROP TABLE IF EXISTS `poi_position_content`;
CREATE TABLE IF NOT EXISTS `poi_position_content` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position_id` int(5) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `poi_position_content`
--

INSERT INTO `poi_position_content` (`id`, `position_id`, `title`, `thumb`, `url`, `news_id`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(27, 2, '文章18测试sss', '/upload/2016/03/07/56dcc0158f70e.JPG', '', 18, 0, -1, 1457306930, 0),
(26, 2, 'ss', '/upload/2016/03/07/56dcbce02cab9.JPG', 'http://sina.com.cn', 0, 0, -1, 1457306890, 0),
(25, 3, 'test', '/upload/2016/03/06/56dbdc0c483af.JPG', NULL, 17, 0, -1, 1455756856, 0),
(23, 2, 'test', '/upload/2016/03/06/56dbdc0c483af.JPG', NULL, 17, 1, -1, 1455756856, 0),
(24, 2, '你好ssss', '/upload/2016/03/06/56dbdc015e662.JPG', NULL, 18, 2, -1, 1455756999, 0),


-- --------------------------------------------------------

--
-- 表的结构 `poi_video`
--

DROP TABLE IF EXISTS `poi_video`;
CREATE TABLE IF NOT EXISTS `poi_video` (
  `video_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '标题',
  `author` char(20) NOT NULL DEFAULT '' COMMENT '作者',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `uptime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid` int(5) DEFAULT NULL COMMENT '视频cat分类',
  PRIMARY KEY (`video_id`),
  KEY `status` (`video_id`),
  KEY `listorder` (`video_id`),
  KEY `catid` (`video_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `poi_video_s`
--

DROP TABLE IF EXISTS `poi_video_s`;
CREATE TABLE IF NOT EXISTS `poi_video_s` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `video_id` mediumint(8) UNSIGNED NOT NULL,
  `src` varchar(80) NOT NULL,
  `hex` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`video_id`),
  KEY `Hex` (`hex`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
