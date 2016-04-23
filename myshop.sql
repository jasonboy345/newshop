-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-23 17:49:00
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `detail`
--

CREATE TABLE `detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `orderid` int(11) UNSIGNED DEFAULT NULL,
  `goodsid` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `price` double(6,2) DEFAULT NULL,
  `num` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `detail`
--

INSERT INTO `detail` (`id`, `orderid`, `goodsid`, `name`, `price`, `num`) VALUES
(1, 1, 12, 'css设计指南', 23.00, 2),
(2, 1, 1, '解忧杂货店', 12.00, 3),
(3, 2, 21, '总统们', 44.00, 1),
(4, 2, 20, '巨人', 34.00, 2),
(5, 8, 6, '霍比特人', 23.00, 1),
(6, 8, 1, '解忧杂货店', 12.00, 1),
(7, 8, 6, '霍比特人', 23.00, 1),
(8, 8, 1, '解忧杂货店', 12.00, 1),
(9, 9, 9, '夜晚来临', 12.00, 1),
(10, 9, 12, 'css设计指南', 23.00, 1),
(11, 12, 2, '冰与火之歌1', 12.00, 1),
(12, 12, 3, '冰与火之歌2', 13.00, 1),
(13, 13, 2, '冰与火之歌1', 12.00, 1),
(14, 13, 3, '冰与火之歌2', 13.00, 1),
(15, 13, 7, '爱情买卖', 123.00, 1),
(16, 14, 2, '冰与火之歌1', 12.00, 1),
(17, 14, 3, '冰与火之歌2', 13.00, 1),
(18, 14, 7, '爱情买卖', 123.00, 1),
(19, 14, 4, '冰与火之歌3', 14.00, 2),
(20, 15, 6, '霍比特人', 23.00, 2),
(21, 15, 5, '冰与火之歌4', 14.00, 1),
(22, 16, 12, 'css设计指南', 23.00, 1),
(23, 16, 1, '解忧杂货店', 12.00, 1),
(24, 16, 8, '图图图', 12.00, 1),
(25, 17, 2, '冰与火之歌1', 12.00, 1),
(26, 17, 15, '国民的分度', 22.00, 1),
(27, 18, 10, '英语四级', 12.00, 1),
(28, 18, 16, '时间回旋', 12.00, 1),
(29, 19, 6, '霍比特人', 23.00, 1),
(30, 20, 6, '霍比特人', 23.00, 1),
(31, 20, 5, '冰与火之歌4', 14.00, 1),
(32, 20, 4, '冰与火之歌3', 14.00, 1),
(33, 21, 7, '爱情买卖', 123.00, 1),
(34, 22, 3, '冰与火之歌2', 13.00, 1),
(35, 22, 21, '总统们', 44.00, 1),
(36, 23, 5, '冰与火之歌4', 14.00, 2),
(37, 24, 22, '汉朝文化', 12.00, 1),
(38, 25, 22, '汉朝文化', 12.00, 1),
(39, 26, 8, '图图图', 12.00, 1);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `id` int(11) UNSIGNED NOT NULL,
  `typeid` int(11) UNSIGNED DEFAULT NULL,
  `goods` varchar(32) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `descr` text,
  `price` double(6,2) DEFAULT NULL,
  `picname` varchar(255) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `store` int(11) UNSIGNED DEFAULT '0',
  `num` int(11) UNSIGNED DEFAULT '0',
  `clicknum` int(11) UNSIGNED DEFAULT '0',
  `addtime` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `typeid`, `goods`, `company`, `descr`, `price`, `picname`, `state`, `store`, `num`, `clicknum`, `addtime`) VALUES
(1, 28, '解忧杂货店', '南海出版社', '解忧杂货店', 12.00, '201506290030019772.jpg', 2, 3, 0, 0, 1435537801),
(2, 7, '冰与火之歌1', '中国文学出版社', '冰与火之歌1', 12.00, '201506291307046978.jpg', 2, 12, 0, 0, 1435583224),
(3, 7, '冰与火之歌2', '中国文学出版社', '冰与火之歌2', 13.00, '201506291307244921.jpg', 2, 13, 0, 0, 1435583244),
(4, 7, '冰与火之歌3', '中国文学出版社', '冰与火之歌3', 14.00, '201506291307432262.jpg', 1, 14, 0, 0, 1435583263),
(5, 7, '冰与火之歌4', '中国文学出版社', '冰与火之歌4', 14.00, '201506291307584172.jpg', 2, 2, 0, 0, 1435583278),
(6, 7, '霍比特人', '中国出版社', '霍比特人', 23.00, '201506291327404078.jpg', 1, 12, 0, 0, 1435584460),
(7, 8, '爱情买卖', '南海出版社', '爱情买卖', 123.00, '201506291333065807.jpg', 2, 13, 0, 0, 1435584786),
(8, 25, '图图图', '南海出版社', '图图图', 12.00, '201506291335597375.jpg', 1, 12, 0, 0, 1435584959),
(9, 7, '夜晚来临', '中国文学出版社', '夜晚来临', 12.00, '201506291338407435.jpg', 2, 11, 0, 0, 1435585120),
(10, 31, '英语四级', '新东方', 'CET-4', 12.00, '201506292339074514.jpg', 2, 12, 0, 0, 1435621147),
(11, 28, '乔纳森传', '中国出版社', '乔纳森传', 32.00, '201506292340273870.jpg', 2, 23, 0, 0, 1435621227),
(12, 29, 'css设计指南', '北京出版社', 'css设计指南', 23.00, '201506292340537473.jpg', 2, 23, 0, 0, 1435621253),
(13, 8, '灵魂有香气', '南海出版社', '灵魂有香气', 12.00, '201506292342085713.jpg', 2, 99, 0, 0, 1435621328),
(14, 26, '知日', '中国文学出版社', '知日，了解日本', 88.00, '201506292342459511.jpg', 1, 66, 0, 0, 1435621365),
(15, 11, '国民的分度', '新东方', '国民的分度', 22.00, '201506292343199942.jpg', 2, 22, 0, 0, 1435621399),
(16, 14, '时间回旋', '中国文学出版社', '时间回旋', 12.00, '201506292345055188.jpg', 2, 23, 0, 0, 1435621505),
(17, 11, '南渡北归', '中国文学出版社', '南渡北归', 12.00, '201506301246035385.jpg', 2, 12, 0, 0, 1435668363),
(18, 10, '曾国藩', '中国文学出版社', '曾国藩', 44.00, '201506301246453911.jpg', 2, 55, 0, 0, 1435668405),
(19, 11, '南京大屠杀', '北京出版社', '南京大屠杀', 23.00, '201506301247211793.jpg', 2, 43, 0, 0, 1435668441),
(20, 28, '巨人', '北京出版社', '巨人', 34.00, '201506301247515240.jpg', 2, 34, 0, 0, 1435668471),
(21, 11, '总统们', '新东方', '总统们', 44.00, '201506301248424163.jpg', 2, 66, 0, 0, 1435668522),
(22, 28, '汉朝文化', '南海出版社', '汉朝文化', 12.00, '201507020734025925.jpg', 3, 11, 0, 0, 1435806707);

-- --------------------------------------------------------

--
-- 表的结构 `number`
--

CREATE TABLE `number` (
  `id` int(11) UNSIGNED NOT NULL,
  `num` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `number`
--

INSERT INTO `number` (`id`, `num`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid` int(11) UNSIGNED DEFAULT NULL,
  `linkman` varchar(32) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code` char(6) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `addtime` int(11) UNSIGNED DEFAULT NULL,
  `total` double(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `uid`, `linkman`, `address`, `code`, `phone`, `addtime`, `total`, `status`) VALUES
(1, 1, '刘彬', '北京兄弟连', '100000', '15311497664', 1434992999, 200.00, 0),
(2, 2, '明日香', '北京兄弟连', '100000', '15209876189', 1434993400, 145.00, 0),
(3, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1560000000', 1435766812, 70.00, 1),
(4, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1531932456', 1435766872, 70.00, 1),
(5, 3, '小樱', 'Japan', '100000', '123456789', 1435795550, 12.00, 3),
(6, 3, '小樱', 'Japan', '100000', '1531932456', 1435797327, 48.00, 3),
(7, 3, '小樱', 'Japan', '100000', '1531932456', 1435797824, 48.00, 3),
(8, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1531932456', 1435798198, 35.00, 1),
(9, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1666666666', 1435798823, 35.00, 0),
(10, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1666666666', 1435799268, 47.00, 1),
(11, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1531932456', 1435800578, 47.00, 0),
(12, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '15209876189', 1435804251, 25.00, 1),
(13, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1666666666', 1435805540, 148.00, 0),
(14, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1666666666', 1435805813, 176.00, 0),
(15, 3, '小樱', 'Japan', '100000', '1555569246', 1435806298, 60.00, 0),
(16, 1, '刘彬', '北京朝阳区皮条胡同34号', '100000', '1555569245', 1435806497, 47.00, 0),
(17, 30, '大熊', '北京朝阳区皮条胡同34号', '100000', '1555569245', 1435807564, 34.00, 1),
(18, 1, '刘彬', '安徽安庆市', '246003', '1335569232', 1435815921, 24.00, 1),
(19, 1, '刘彬', '安徽安庆', '246003', '1335569232', 1435820082, 23.00, 0),
(20, 1, '刘彬', '安徽安庆', '246003', '1531932456', 1435820375, 51.00, 0),
(21, 1, '刘彬', '安徽安庆', '246003', '1666666666', 1435822528, 123.00, 0),
(22, 1, '刘彬', '安徽安庆', '246003', '1531932456', 1435833961, 57.00, 0),
(23, 1, '刘彬', '安徽安庆', '246003', '1531932456', 1435850627, 28.00, 1),
(24, 24, '哈哈', '沈阳市沈北新区蒲昌路', '100000', '18818866666', 1450679835, 12.00, 0),
(25, 24, '哈哈', '沈阳市沈北新区蒲昌路', '100000', '18818866666', 1450686210, 12.00, 0),
(26, 24, '哈哈', '沈阳市沈北新区蒲昌路', '100000', '18881881888', 1461145057, 12.00, 0);

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE `type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `pid` int(11) UNSIGNED DEFAULT '0',
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `name`, `pid`, `path`) VALUES
(1, '小说', 0, '0,'),
(2, '文学', 0, '0,'),
(4, '励志', 0, '0,'),
(5, '计算机', 0, '0,'),
(7, '科幻小说', 1, '0,1,'),
(8, '爱情小说', 1, '0,1,'),
(10, '作品集', 2, '0,2,'),
(11, '纪实文学', 2, '0,2,'),
(14, '为人处世', 4, '0,4,'),
(15, '演讲与口才', 4, '0,4,'),
(16, '计算机科学', 5, '0,5,'),
(17, '数据库', 5, '0,5,'),
(18, '电子商务', 5, '0,5,'),
(25, '言情小说', 1, '0,1,'),
(26, '旅游小说', 1, '0,1,'),
(28, '畅销小说', 1, '0,1,'),
(29, 'CSS设计', 5, '0,5,'),
(30, '英语', 0, '0,'),
(31, '英语四级', 30, '0,30,'),
(45, '比尔盖茨', 43, '0,43,'),
(43, '人物自传', 0, '0,'),
(44, '乔布斯', 43, '0,43,');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `pass` char(32) NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code` char(6) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `addtime` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `pass`, `sex`, `address`, `code`, `phone`, `email`, `state`, `addtime`) VALUES
(1, 'admin', '彬彬', '21232f297a57a5a743894a0e4a801fc3', 0, '安徽安庆', '246003', '12345678901', 'liubin@vip.com', 0, 1234567809),
(2, 'dream', '明日香', '202cb962ac59075b964b07152d234b70', 0, 'Janpan', '100000', '1666666666', 'asuka@vip.com', 0, 1434990933),
(3, 'sakura', '小樱', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Japan', '100000', '13505635062', 'sakura@vip.com', 0, 1434991902),
(4, 'future', '发条女孩', '202cb962ac59075b964b07152d234b70', 0, 'beijing', '100000', '1335569246', 'future@qq.com', 0, 1435017472),
(5, 'menmeng1978', '张梦梦', 'e6d8b653aa358fd639bdef741aee121d', 1, 'Japan', '100000', '1555569245', 'mengmeng@qq.com', 1, 1435019588),
(6, 'wangqing', '王琴', 'b59c67bf196a4758191e42f76670ceba', 0, 'lamp110', '100000', '1335569246', 'wangqing@qq.com', 0, 1435028281),
(7, 'liu', '彬彬', '202cb962ac59075b964b07152d234b70', 1, '北京南', '100000', '1335569242', '10086@qq.com', 1, 1435213435),
(8, 'liu520', '夏梦帆', '202cb962ac59075b964b07152d234b70', 0, '安徽安庆', '346008', '1335569232', 'xiaomengfang@qq.com', 1, 1435213517),
(9, 'admin520', '夏静', '9df62e693988eb4e1e1444ece0578579', 0, 'beijing', '100000', '1555569246', 'xj@qq.com', 1, 1435213570),
(10, 'fast', '光速蜗牛', '651a19372a2694ee7579a381af35f009', 1, 'beijing', '100000', '1555569246', 'faster@qq.com', 1, 1435213607),
(11, 'cestbon', 'C女郎', '9df62e693988eb4e1e1444ece0578579', 0, 'glaxay', '100000', '1335569232', 'university@qq.com', 1, 1435213654),
(12, 'jack', '杰克', '651a19372a2694ee7579a381af35f009', 1, 'beijing', '100000', '1335569232', 'jack@qq.com', 1, 1435213696),
(13, 'daxiong', '小影', '3691308f2a4c2f6983f2880d32e29c84', 1, 'anhui', '100000', '1555569245', 'xiaoying@qq.com', 1, 1435213738),
(14, 'beach', '大熊', '08a4415e9d594ff960030b921d42b91e', 1, 'japan', '100000', '1555569246', 'daxiong@qq.com', 1, 1435213770),
(15, 'jingxiang', '静香', '77963b7a931377ad4ab5ad6a9cd718aa', 0, 'japan', '100000', '1555569245', 'jingxiang@qq.com', 1, 1435213803),
(16, 'sakura566', 'binbin', 'd41d8cd98f00b204e9800998ecf8427e', 1, '北京', '100000', '1555569245', 'you@qq.com', 1, 1435249849),
(17, 'XDL', '兄弟连', 'defb99e69a9f1f6e06f15006b1f166ae', 0, 'beijing', '100000', '1335569232', 'xdl@qq.com', 1, 1435249946),
(18, 'cheng', '橙红', '9df62e693988eb4e1e1444ece0578579', 0, 'beijing', '100000', '1335569232', 'lol@qq.com', 1, 1435250127),
(19, 'hhollo', '传记', '77963b7a931377ad4ab5ad6a9cd718aa', 1, 'beijing', '100000', '1335569232', '111@qq.com', 1, 1435250156),
(20, 'helloweorld', '刘霞', '202cb962ac59075b964b07152d234b70', 0, 'beijing', '100000', '1335569242', 'liu@qq.com', 1, 1435278272),
(21, 'abc', '刘大大', 'f3abb86bd34cf4d52698f14c0da1dc60', 1, 'anhui', '100000', '1335569232', 'anhui@qq.com', 1, 1435280338),
(22, 'liu3456', '萨达', '698d51a19d8a121ce581499d7b701668', 0, 'beihai', '100000', '1555569245', 'beihai@qq.com', 1, 1435332716),
(23, '111', '111', '698d51a19d8a121ce581499d7b701668', 1, '111', '100000', '1531932456', '111@qq.com', 1, 1435851158),
(24, 'haha', '哈哈', 'e10adc3949ba59abbe56e057f20f883e', 1, '沈阳市沈北新区蒲昌路', '100000', '18818866666', '188188@qq.com', 1, 1450679754);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typeid` (`typeid`);

--
-- Indexes for table `number`
--
ALTER TABLE `number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- 使用表AUTO_INCREMENT `number`
--
ALTER TABLE `number`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
