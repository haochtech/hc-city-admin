<?php
pdo_query("DROP TABLE IF EXISTS `ims_zhtc_account`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_account` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
`storeid` varchar(1000) NOT NULL,
`uid` int(10) unsigned NOT NULL DEFAULT '0',
`from_user` varchar(100) NOT NULL,
`accountname` varchar(50) NOT NULL,
`password` varchar(200) NOT NULL,
`salt` varchar(10) NOT NULL,
`pwd` varchar(50) NOT NULL,
`mobile` varchar(20) NOT NULL,
`email` varchar(20) NOT NULL,
`username` varchar(50) NOT NULL,
`pay_account` varchar(200) NOT NULL,
`displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`dateline` int(10) unsigned NOT NULL DEFAULT '0',
`status` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态',
`role` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:店长,2:店员',
`lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
`lastip` varchar(15) NOT NULL,
`areaid` int(10) NOT NULL DEFAULT '0' COMMENT '区域id',
`is_admin_order` tinyint(1) unsigned NOT NULL DEFAULT '1',
`is_notice_order` tinyint(1) unsigned NOT NULL DEFAULT '1',
`is_notice_queue` tinyint(1) unsigned NOT NULL DEFAULT '1',
`is_notice_service` tinyint(1) unsigned NOT NULL DEFAULT '1',
`is_notice_boss` tinyint(1) NOT NULL DEFAULT '0',
`remark` varchar(1000) NOT NULL COMMENT '备注',
`lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度',
`lng` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度',
`cityname` varchar(50) NOT NULL COMMENT '城市名称',
`money` decimal(10,2) NOT NULL,
`authority` text NOT NULL,
`city_qx` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_acthxlist`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_acthxlist` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`act_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_activity`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_activity` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(50) NOT NULL COMMENT '活动标题',
`logo` varchar(200) NOT NULL COMMENT '活动logo',
`img` text NOT NULL COMMENT '活动轮播图',
`details` text NOT NULL COMMENT '活动详情',
`number` int(11) NOT NULL COMMENT '限制人数',
`sign_num` int(11) NOT NULL COMMENT '限制人数',
`time` varchar(20) NOT NULL COMMENT '发布时间',
`start_time` varchar(20) NOT NULL COMMENT '开始时间',
`end_time` varchar(20) NOT NULL COMMENT '结束时间',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`money` decimal(10,2) NOT NULL COMMENT '价格',
`type_id` int(11) NOT NULL COMMENT '分类id',
`tel` varchar(20) NOT NULL COMMENT '电话',
`address` varchar(200) NOT NULL COMMENT '地址',
`coordinate` varchar(50) NOT NULL COMMENT '坐标',
`num` int(11) NOT NULL COMMENT '排序',
`view` int(11) NOT NULL COMMENT '访问量',
`is_bm` int(11) NOT NULL DEFAULT '1' COMMENT '1.开启2.关闭',
`cityname` varchar(20) NOT NULL COMMENT '城市',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_acttype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_acttype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(11) NOT NULL COMMENT '1.开启2.关闭',
`img` varchar(500) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_ad`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_ad` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(50) NOT NULL COMMENT '轮播图标题',
`logo` varchar(200) NOT NULL COMMENT '图片',
`status` int(11) NOT NULL COMMENT '1.开启  2.关闭',
`src` varchar(100) NOT NULL COMMENT '链接',
`orderby` int(11) NOT NULL COMMENT '排序',
`xcx_name` varchar(20) NOT NULL,
`appid` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`type` int(11) NOT NULL,
`cityname` varchar(50) NOT NULL,
`wb_src` varchar(300) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_area`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_area` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`area_name` varchar(50) NOT NULL COMMENT '区域名称',
`num` int(11) NOT NULL COMMENT '排序',
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_bottom`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_bottom` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(20) NOT NULL COMMENT '标题',
`title_color` varchar(20) NOT NULL COMMENT '标题选中颜色',
`title_color2` varchar(20) NOT NULL COMMENT '标题未选中颜色',
`logo` varchar(200) NOT NULL COMMENT '选中图片',
`logo2` varchar(200) NOT NULL COMMENT '未选中图片',
`url` varchar(200) NOT NULL COMMENT '跳转链接',
`num` int(11) NOT NULL COMMENT '排序',
`state` int(11) NOT NULL DEFAULT '1' COMMENT '1开启2关闭',
`uniacid` int(11) NOT NULL,
`xcx_name` varchar(50) NOT NULL COMMENT '小程序名称',
`appid` varchar(30) NOT NULL COMMENT '跳转appid',
`item` int(4) NOT NULL DEFAULT '1',
`src2` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_car`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_car` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`start_place` varchar(100) NOT NULL COMMENT '出发地',
`end_place` varchar(100) NOT NULL COMMENT '目的地',
`start_time` varchar(30) NOT NULL COMMENT '出发时间',
`num` int(4) NOT NULL COMMENT '乘车人数/可乘人数',
`link_name` varchar(30) NOT NULL COMMENT '联系人',
`link_tel` varchar(20) NOT NULL COMMENT '联系电话',
`typename` varchar(30) NOT NULL COMMENT '分类名称',
`other` varchar(300) NOT NULL COMMENT '补充',
`time` int(11) NOT NULL COMMENT '发布时间',
`sh_time` int(11) NOT NULL COMMENT '审核时间',
`top_id` int(11) NOT NULL COMMENT '置顶ID',
`top` int(4) NOT NULL COMMENT '是否置顶,1,是,2否',
`uniacid` varchar(50) NOT NULL,
`state` int(4) NOT NULL COMMENT '1待审核,2通过，3拒绝',
`tj_place` varchar(300) NOT NULL COMMENT '途经地',
`hw_wet` varchar(10) NOT NULL COMMENT '货物重量',
`star_lat` varchar(20) NOT NULL COMMENT '出发地维度',
`star_lng` varchar(20) NOT NULL COMMENT '出发地经度',
`end_lat` varchar(20) NOT NULL COMMENT '目的地维度',
`end_lng` varchar(20) NOT NULL COMMENT '目的地经度',
`is_open` int(4) NOT NULL,
`start_time2` int(11) NOT NULL,
`cityname` varchar(50) NOT NULL,
`is_delete` int(4) NOT NULL DEFAULT '2',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_car_my_tag`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_car_my_tag` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tag_id` int(11) NOT NULL COMMENT '标签id',
`car_id` int(11) NOT NULL COMMENT '拼车ID',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_car_tag`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_car_tag` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`typename` varchar(30) NOT NULL COMMENT '分类名称',
`tagname` varchar(30) NOT NULL COMMENT '标签名称',
`uniacid` varchar(11) NOT NULL COMMENT '50',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_car_top`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_car_top` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` int(11) NOT NULL COMMENT '1.一天2.一周3.一个月',
`money` decimal(10,2) NOT NULL COMMENT '价格',
`uniacid` int(11) NOT NULL,
`num` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_carpaylog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_carpaylog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`car_id` int(44) NOT NULL COMMENT '拼车id',
`money` decimal(10,2) NOT NULL COMMENT '钱',
`time` datetime NOT NULL,
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_comments`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_comments` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`information_id` int(11) NOT NULL COMMENT '帖子id',
`details` varchar(200) NOT NULL COMMENT '评论详情',
`time` varchar(20) NOT NULL COMMENT '时间',
`reply` varchar(200) NOT NULL COMMENT '回复详情',
`hf_time` varchar(20) NOT NULL COMMENT '回复时间',
`user_id` int(11) NOT NULL,
`store_id` int(11) NOT NULL,
`score` decimal(10,1) NOT NULL,
`bid` int(11) NOT NULL,
`hf_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_commission_withdrawal`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_commission_withdrawal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`type` int(11) NOT NULL COMMENT '1.支付宝2.银行卡',
`state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝',
`time` int(11) NOT NULL COMMENT '申请时间',
`sh_time` int(11) NOT NULL COMMENT '审核时间',
`uniacid` int(11) NOT NULL,
`user_name` varchar(20) NOT NULL,
`account` varchar(100) NOT NULL,
`tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额',
`sj_cost` decimal(10,2) NOT NULL COMMENT '实际到账金额',
`bank` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_continuous`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_continuous` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`day` int(11) NOT NULL COMMENT '天数',
`integral` int(11) NOT NULL COMMENT '积分',
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_coupons`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_coupons` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`number` int(11) NOT NULL,
`full` varchar(20) NOT NULL,
`reduce` decimal(10,1) NOT NULL COMMENT '减',
`money` decimal(10,2) NOT NULL,
`time` varchar(20) NOT NULL,
`details` text NOT NULL COMMENT '使用说明',
`surplus` int(11) NOT NULL COMMENT '剩余数量',
`store_id` int(11) NOT NULL,
`end_time` varchar(20) NOT NULL,
`img` text NOT NULL,
`is_show` int(11) NOT NULL DEFAULT '1',
`state` int(11) NOT NULL DEFAULT '1',
`del` int(11) NOT NULL DEFAULT '2',
`type_id` int(11) NOT NULL DEFAULT '1',
`is_pt` int(11) NOT NULL DEFAULT '1',
`cityname` varchar(30) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_coupontype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_coupontype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL COMMENT '分类名称',
`img` varchar(500) NOT NULL,
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`num` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_distribution`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_distribution` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`time` int(11) NOT NULL,
`user_name` varchar(20) NOT NULL,
`user_tel` varchar(20) NOT NULL,
`state` int(11) NOT NULL COMMENT '1.审核中2.通过3.拒绝',
`uniacid` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`pay_state` int(11) NOT NULL,
`code` varchar(50) NOT NULL,
`level` int(11) NOT NULL,
`cityname` varchar(20) NOT NULL,
`is_log` int(11) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_dmorder`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_dmorder` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`store_id` int(11) NOT NULL,
`code` varchar(100) NOT NULL,
`state` int(11) NOT NULL,
`time` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_earnings`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_earnings` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`son_id` int(11) NOT NULL COMMENT '下线',
`money` decimal(10,2) NOT NULL,
`time` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_fx`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_fx` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户ID',
`zf_user_id` int(11) NOT NULL COMMENT '转发人ID',
`money` decimal(10,2) NOT NULL COMMENT '金额',
`time` int(11) NOT NULL COMMENT '时间戳',
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_fxlevel`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_fxlevel` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`money` decimal(10,2) NOT NULL,
`name` varchar(20) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`commission` int(11) NOT NULL COMMENT '1级佣金比例',
`commission2` int(11) NOT NULL COMMENT '2级佣金比例',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_fxlog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_fxlog` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`time` varchar(20) NOT NULL,
`code` varchar(100) NOT NULL,
`level` int(11) NOT NULL,
`note` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(11) NOT NULL DEFAULT '1' COMMENT '1.待支付2.已支付',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_fxset`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_fxset` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`fx_details` text NOT NULL COMMENT '分销商申请协议',
`tx_details` text NOT NULL COMMENT '佣金提现协议',
`is_fx` int(11) NOT NULL COMMENT '1.开启分销审核2.不开启',
`is_ej` int(11) NOT NULL COMMENT '是否开启二级分销1.是2.否',
`tx_rate` int(11) NOT NULL COMMENT '提现手续费',
`commission` varchar(10) NOT NULL COMMENT '一级佣金',
`commission2` varchar(10) NOT NULL COMMENT '二级佣金',
`tx_money` int(11) NOT NULL COMMENT '提现门槛',
`img` varchar(100) NOT NULL COMMENT '分销中心图片',
`img2` varchar(100) NOT NULL COMMENT '申请分销图片',
`uniacid` int(11) NOT NULL,
`is_open` int(11) NOT NULL DEFAULT '1' COMMENT '1.开启2关闭',
`instructions` text NOT NULL COMMENT '分销商说明',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_fxuser`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_fxuser` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '一级分销',
`fx_user` int(11) NOT NULL COMMENT '二级分销',
`time` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_goods`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_goods` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`store_id` int(11) NOT NULL COMMENT '商家ID',
`spec_id` int(11) NOT NULL COMMENT '主规格ID',
`goods_name` varchar(100) NOT NULL COMMENT '商品名称',
`goods_num` int(11) NOT NULL COMMENT '商品数量',
`goods_cost` decimal(10,2) NOT NULL,
`freight` decimal(10,2) NOT NULL COMMENT '运费',
`delivery` varchar(500) NOT NULL COMMENT '关于发货',
`quality` int(4) NOT NULL COMMENT '正品1是,0否',
`free` int(4) NOT NULL COMMENT '包邮1是,0否',
`all_day` int(4) NOT NULL COMMENT '24小时发货1是,0否',
`service` int(4) NOT NULL COMMENT '售后服务1是,0否',
`refund` int(4) NOT NULL COMMENT '极速退款1是,0否',
`weeks` int(4) NOT NULL COMMENT '7天包邮1是，0否',
`lb_imgs` varchar(500) NOT NULL COMMENT '轮播图',
`imgs` varchar(500) NOT NULL COMMENT '商品介绍图',
`time` int(11) NOT NULL COMMENT '时间',
`uniacid` varchar(50) NOT NULL,
`goods_details` text NOT NULL COMMENT '商品详细',
`state` int(4) NOT NULL COMMENT '1待审核,2通过，3拒绝',
`sy_num` int(11) NOT NULL COMMENT '剩余数量',
`is_show` int(11) NOT NULL DEFAULT '1',
`sales` int(11) NOT NULL,
`is_xs` int(11) NOT NULL DEFAULT '2',
`end_time` varchar(20) NOT NULL,
`vr` varchar(500) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_goods_spec`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_goods_spec` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`spec_name` varchar(100) NOT NULL COMMENT '规格名称',
`sort` int(4) NOT NULL COMMENT '排序',
`uniacid` varchar(50) NOT NULL COMMENT '50',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_group`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_group` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`store_id` int(11) NOT NULL COMMENT '门店id',
`goods_id` int(11) NOT NULL COMMENT '商品ID',
`goods_logo` varchar(500) NOT NULL,
`goods_name` varchar(255) NOT NULL COMMENT '商品名称',
`kt_num` int(11) NOT NULL COMMENT '开团人数',
`yg_num` int(11) NOT NULL COMMENT '已购数量',
`kt_time` int(11) NOT NULL COMMENT '开团时间',
`dq_time` int(11) NOT NULL COMMENT '到期时间',
`state` int(4) NOT NULL COMMENT '1.拼团中2成功,3失败',
`user_id` int(11) NOT NULL COMMENT '团长user_id',
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_groupgoods`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_groupgoods` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`store_id` int(11) NOT NULL COMMENT '门店id',
`type_id` int(11) NOT NULL COMMENT '分类ID',
`name` varchar(255) NOT NULL COMMENT '名称',
`logo` varchar(500) NOT NULL COMMENT 'logo',
`img` text NOT NULL COMMENT '多图',
`inventory` int(11) NOT NULL COMMENT '库存',
`pt_price` decimal(10,2) NOT NULL COMMENT '拼团价格',
`y_price` decimal(10,2) NOT NULL COMMENT '原价',
`dd_price` decimal(10,2) NOT NULL COMMENT '单独购买价格',
`ycd_num` int(11) NOT NULL COMMENT '已成团数量',
`ysc_num` int(11) NOT NULL COMMENT '已售出数量',
`people` int(11) NOT NULL COMMENT '成团人数',
`start_time` int(11) NOT NULL COMMENT '开始时间',
`end_time` int(11) NOT NULL COMMENT '结束时间',
`xf_time` int(11) NOT NULL COMMENT '消费截止时间',
`is_shelves` int(4) NOT NULL DEFAULT '1' COMMENT '1上架,2下架',
`details` text NOT NULL COMMENT '商品详情',
`details_img` text NOT NULL COMMENT '详情多图',
`num` int(11) NOT NULL COMMENT '排序',
`state` int(4) NOT NULL DEFAULT '1' COMMENT '1待审核,2通过，3拒绝',
`display` int(4) NOT NULL DEFAULT '1' COMMENT '1显示,2不显示',
`uniacid` int(11) NOT NULL,
`introduction` text NOT NULL,
`time` int(11) NOT NULL COMMENT '发布时间',
`cityname` varchar(30) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_grouporder`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_grouporder` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`group_id` int(11) NOT NULL COMMENT '团id',
`store_id` int(11) NOT NULL COMMENT '门店id',
`goods_id` int(11) NOT NULL COMMENT '商品ID',
`user_id` int(11) NOT NULL COMMENT '用户ID',
`order_num` varchar(30) NOT NULL COMMENT '订单号',
`logo` varchar(500) NOT NULL COMMENT '商品图片',
`goods_name` varchar(255) NOT NULL COMMENT '商品名称',
`goods_type` varchar(50) NOT NULL COMMENT '商品类型',
`price` decimal(10,2) NOT NULL COMMENT '单价',
`goods_num` int(11) NOT NULL COMMENT '商品数量',
`money` decimal(10,2) NOT NULL COMMENT '订单金额',
`pay_type` int(4) NOT NULL COMMENT '付款方式1微信，2余额',
`receive_name` varchar(30) NOT NULL COMMENT '收货人',
`receive_tel` varchar(20) NOT NULL COMMENT '收货人电话',
`receive_address` varchar(100) NOT NULL COMMENT '收货人地址',
`note` varchar(100) NOT NULL COMMENT '备注',
`state` int(4) NOT NULL COMMENT '1未付款,2已付款,3已完成,4已关闭,5已失效',
`xf_time` int(11) NOT NULL COMMENT '消费截止时间',
`time` int(11) NOT NULL COMMENT '下单时间',
`pay_time` int(11) NOT NULL COMMENT '付款时间',
`cz_time` int(11) NOT NULL COMMENT '完成/关闭/失效时间',
`code` varchar(30) NOT NULL COMMENT '支付商户号',
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_grouptype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_grouptype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`img` varchar(500) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_hblq`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_hblq` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户ID',
`tz_id` int(11) NOT NULL COMMENT '帖子ID',
`money` decimal(10,2) NOT NULL COMMENT '金额',
`time` int(11) NOT NULL COMMENT '时间戳',
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_help`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_help` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`question` varchar(200) NOT NULL COMMENT '标题',
`answer` text NOT NULL COMMENT '回答',
`sort` int(4) NOT NULL COMMENT '排序',
`uniacid` varchar(50) NOT NULL,
`created_time` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_hotcity`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_hotcity` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`cityname` varchar(50) NOT NULL COMMENT '城市名称',
`time` int(11) NOT NULL COMMENT '创建时间',
`uniacid` varchar(50) NOT NULL,
`user_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_in`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_in` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` int(11) NOT NULL COMMENT '1.一天2.半年3.一年',
`money` decimal(10,2) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`money2` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_information`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_information` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`details` text NOT NULL COMMENT '内容',
`img` text NOT NULL COMMENT '图片',
`user_id` int(11) NOT NULL COMMENT '用户id',
`user_name` varchar(20) NOT NULL COMMENT '联系人',
`user_tel` varchar(20) NOT NULL COMMENT '电话',
`hot` int(11) NOT NULL COMMENT '1.热门 2.不热门',
`top` int(11) NOT NULL COMMENT '1.置顶 2.不置顶',
`givelike` int(11) NOT NULL COMMENT '点赞数',
`views` int(11) NOT NULL COMMENT '浏览量',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`type2_id` int(11) NOT NULL COMMENT '分类二id',
`type_id` int(11) NOT NULL,
`state` int(11) NOT NULL COMMENT '1.待审核 2.通过3拒绝',
`money` decimal(10,2) NOT NULL,
`time` int(11) NOT NULL COMMENT '发布时间',
`sh_time` int(11) NOT NULL,
`top_type` int(11) NOT NULL,
`address` varchar(500) NOT NULL,
`hb_money` decimal(10,2) NOT NULL,
`hb_num` int(11) NOT NULL,
`hb_type` int(11) NOT NULL,
`hb_keyword` varchar(20) NOT NULL,
`hb_random` int(11) NOT NULL,
`hong` text NOT NULL,
`store_id` int(11) NOT NULL,
`del` int(11) NOT NULL DEFAULT '2',
`user_img2` varchar(200) NOT NULL,
`dq_time` int(11) NOT NULL,
`cityname` varchar(50) NOT NULL,
`hbfx_num` int(11) NOT NULL,
`is_jt` int(4) NOT NULL DEFAULT '2',
`lat` varchar(20) NOT NULL,
`lng` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_integral`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_integral` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`score` int(11) NOT NULL COMMENT '分数',
`type` int(4) NOT NULL COMMENT '1加,2减',
`order_id` int(11) NOT NULL COMMENT '订单id',
`cerated_time` datetime NOT NULL COMMENT '创建时间',
`uniacid` varchar(50) NOT NULL,
`note` varchar(20) NOT NULL COMMENT '备注',
`tid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_jfgoods`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_jfgoods` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL COMMENT '名称',
`img` varchar(100) NOT NULL,
`money` int(11) NOT NULL COMMENT '价格',
`type_id` int(11) NOT NULL COMMENT '分类id',
`goods_details` text NOT NULL,
`process_details` text NOT NULL,
`attention_details` text NOT NULL,
`number` int(11) NOT NULL COMMENT '数量',
`time` varchar(50) NOT NULL COMMENT '期限',
`is_open` int(11) NOT NULL COMMENT '1.开启2关闭',
`type` int(11) NOT NULL COMMENT '1.余额2.实物',
`num` int(11) NOT NULL COMMENT '排序',
`uniacid` int(11) NOT NULL,
`hb_moeny` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_jfrecord`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_jfrecord` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`good_id` int(11) NOT NULL COMMENT '商品id',
`time` varchar(20) NOT NULL COMMENT '兑换时间',
`user_name` varchar(20) NOT NULL COMMENT '用户地址',
`user_tel` varchar(20) NOT NULL COMMENT '用户电话',
`address` varchar(200) NOT NULL COMMENT '地址',
`note` varchar(20) NOT NULL,
`integral` int(11) NOT NULL COMMENT '积分',
`good_name` varchar(50) NOT NULL COMMENT '商品名称',
`good_img` varchar(100) NOT NULL,
`state` int(11) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_jftype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_jftype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`img` varchar(100) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_joinlist`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_joinlist` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`act_id` int(11) NOT NULL,
`time` varchar(20) NOT NULL,
`money` decimal(10,2) NOT NULL,
`code` varchar(100) NOT NULL,
`form_id` varchar(100) NOT NULL,
`state` int(11) NOT NULL COMMENT '1.待支付2.已支付3.已通过4.已核销5.已拒绝',
`uniacid` int(11) NOT NULL,
`user_name` varchar(20) NOT NULL,
`user_tel` varchar(20) NOT NULL,
`hx_time` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_label`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_label` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`label_name` varchar(20) NOT NULL,
`type2_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_like`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_like` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`information_id` int(11) NOT NULL COMMENT '帖子id',
`user_id` int(11) NOT NULL COMMENT '用户id',
`zx_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_llz`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_llz` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`type` int(11) NOT NULL,
`status` int(11) NOT NULL,
`src` varchar(100) NOT NULL,
`cityname` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_message`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_message` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`note` varchar(100) NOT NULL,
`source` varchar(100) NOT NULL,
`content` varchar(100) NOT NULL,
`time` varchar(100) NOT NULL,
`fs_time` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL,
`src` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_mylabel`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_mylabel` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`label_id` int(11) NOT NULL,
`information_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_nav`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_nav` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(50) NOT NULL COMMENT '名称',
`logo` varchar(200) NOT NULL COMMENT '图标',
`status` int(11) NOT NULL COMMENT '1.开启  2.关闭',
`src` varchar(100) NOT NULL COMMENT '内部链接',
`orderby` int(11) NOT NULL COMMENT '排序',
`xcx_name` varchar(20) NOT NULL COMMENT '小程序名称',
`appid` varchar(20) NOT NULL COMMENT 'APPID',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`wb_src` varchar(300) NOT NULL COMMENT '外部链接',
`state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_news`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_news` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(50) NOT NULL COMMENT '公告标题',
`details` text NOT NULL COMMENT '公告详情',
`num` int(11) NOT NULL COMMENT '排序',
`uniacid` int(11) NOT NULL,
`time` int(11) NOT NULL,
`img` varchar(100) NOT NULL,
`state` int(11) NOT NULL,
`type` int(11) NOT NULL,
`cityname` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_order`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_order` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`store_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL COMMENT '金额',
`user_name` varchar(20) NOT NULL COMMENT '联系人',
`address` varchar(200) NOT NULL COMMENT '联系地址',
`tel` varchar(20) NOT NULL COMMENT '电话',
`time` int(11) NOT NULL COMMENT '下单时间',
`pay_time` int(11) NOT NULL,
`complete_time` int(11) NOT NULL,
`fh_time` int(11) NOT NULL COMMENT '发货时间',
`state` int(11) NOT NULL COMMENT '1.待付款 2.待发货3.待确认4.已完成5.退款中6.已退款7.退款拒绝',
`order_num` varchar(20) NOT NULL COMMENT '订单号',
`good_id` int(11) NOT NULL,
`good_name` varchar(100) NOT NULL,
`good_img` varchar(100) NOT NULL,
`good_money` decimal(10,2) NOT NULL,
`out_trade_no` varchar(50) NOT NULL,
`good_spec` varchar(200) NOT NULL COMMENT '商品规格',
`del` int(11) NOT NULL COMMENT '用户删除1是  2否 ',
`del2` int(11) NOT NULL COMMENT '商家删除1.是2.否',
`uniacid` int(11) NOT NULL,
`freight` decimal(10,2) NOT NULL,
`note` varchar(100) NOT NULL,
`good_num` int(11) NOT NULL,
`is_zt` int(11) NOT NULL DEFAULT '2',
`zt_time` varchar(20) NOT NULL,
`kd_num` varchar(100) NOT NULL,
`kd_name` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_paylog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_paylog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`fid` int(11) NOT NULL COMMENT '外键id(商家,帖子,黄页,拼车)',
`money` decimal(10,2) NOT NULL COMMENT '钱',
`time` datetime NOT NULL COMMENT '时间',
`uniacid` varchar(50) NOT NULL COMMENT '50',
`note` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_plate`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_plate` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`type` int(4) NOT NULL,
`name` varchar(50) NOT NULL COMMENT '名称',
`time` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`sort` int(11) NOT NULL COMMENT '排序',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_qbmx`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_qbmx` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`money` decimal(10,2) NOT NULL,
`type` int(11) NOT NULL,
`note` varchar(20) NOT NULL,
`time` varchar(20) NOT NULL,
`user_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_qggoods`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_qggoods` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`logo` varchar(200) NOT NULL,
`price` decimal(10,1) NOT NULL COMMENT '原价',
`money` decimal(10,1) NOT NULL COMMENT '现价',
`number` int(11) NOT NULL COMMENT '数量',
`surplus` int(11) NOT NULL COMMENT '剩余',
`start_time` varchar(20) NOT NULL COMMENT '开始时间',
`end_time` varchar(20) NOT NULL COMMENT '结束时间',
`consumption_time` int(11) NOT NULL COMMENT '消费截止时间',
`details` text NOT NULL,
`store_id` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(11) NOT NULL DEFAULT '1' COMMENT '1.上架2.下架',
`state2` int(11) NOT NULL DEFAULT '1',
`is_tg` int(11) NOT NULL DEFAULT '1',
`type_id` int(11) NOT NULL,
`img` text NOT NULL,
`num` int(11) NOT NULL,
`hot` int(11) NOT NULL,
`content` varchar(100) NOT NULL,
`details_img` text NOT NULL,
`time` varchar(20) NOT NULL,
`cityname` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_qgorder`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_qgorder` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`order_num` varchar(50) NOT NULL,
`user_id` int(11) NOT NULL,
`user_name` varchar(20) NOT NULL,
`user_tel` varchar(20) NOT NULL,
`store_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`good_id` int(11) NOT NULL,
`pay_type` int(11) NOT NULL COMMENT '1.微信支付2.余额支付',
`state` int(11) NOT NULL COMMENT '1.待支付2已支付3.已核销',
`dq_time` varchar(20) NOT NULL COMMENT '到期时间',
`uniacid` int(11) NOT NULL,
`code` varchar(100) NOT NULL,
`good_name` varchar(20) NOT NULL,
`good_logo` varchar(200) NOT NULL,
`pay_time` varchar(20) NOT NULL,
`hx_time` varchar(20) NOT NULL,
`del` int(11) NOT NULL DEFAULT '2' COMMENT '1删除2.未删除',
`note` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_qgtype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_qgtype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
`img` varchar(500) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_sensitive`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_sensitive` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`content` text NOT NULL COMMENT '内容',
`uniacid` int(11) NOT NULL COMMENT '11',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_share`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_share` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`information_id` int(11) NOT NULL COMMENT '帖子id',
`user_id` int(11) NOT NULL COMMENT '用户id',
`store_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_signlist`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_signlist` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`time` varchar(20) NOT NULL COMMENT '签到时间',
`time2` int(11) NOT NULL,
`integral` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`time3` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_signset`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_signset` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`one` int(11) NOT NULL COMMENT '首次奖励积分',
`integral` int(11) NOT NULL COMMENT '每天签到积分',
`is_open` int(11) NOT NULL COMMENT '1.开启2.关闭  签到',
`is_bq` int(11) NOT NULL COMMENT '1.开启2.关闭  补签',
`bq_integral` int(11) NOT NULL COMMENT '补签扣除积分',
`details` text NOT NULL COMMENT '签到说明',
`uniacid` int(11) NOT NULL,
`qd_img` varchar(200) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_sms`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_sms` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`appkey` varchar(100) NOT NULL,
`tpl_id` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`is_open` int(11) NOT NULL DEFAULT '2',
`tid1` varchar(50) NOT NULL,
`tid2` varchar(50) NOT NULL,
`tid3` varchar(50) NOT NULL,
`tpl2_id` int(11) NOT NULL,
`fh_tid` varchar(200) NOT NULL,
`gm_tid` varchar(200) NOT NULL,
`hp_tid` varchar(200) NOT NULL,
`dz_tid` varchar(200) NOT NULL,
`tg_tid` varchar(200) NOT NULL,
`qf_tid` varchar(200) NOT NULL,
`qg_tid` varchar(200) NOT NULL,
`hd_tid` varchar(200) NOT NULL,
`pt_tid` varchar(200) NOT NULL,
`kq_tid` varchar(200) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_spec_value`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_spec_value` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`goods_id` int(11) NOT NULL COMMENT '商品ID',
`spec_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL COMMENT '价格',
`name` varchar(50) NOT NULL COMMENT '名称',
`num` int(11) NOT NULL COMMENT '数量',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_special`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_special` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`day` varchar(20) NOT NULL COMMENT '日期',
`integral` int(11) NOT NULL COMMENT '积分',
`title` varchar(20) NOT NULL COMMENT '标题说明',
`color` varchar(20) NOT NULL COMMENT '颜色',
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_store`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_store` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`store_name` varchar(50) NOT NULL COMMENT '商家名称',
`address` varchar(200) NOT NULL COMMENT '商家地址',
`announcement` varchar(100) NOT NULL COMMENT '公告',
`storetype_id` int(11) NOT NULL COMMENT '主行业分类id',
`storetype2_id` int(11) NOT NULL COMMENT '商家子分类id',
`area_id` int(11) NOT NULL COMMENT '区域id',
`yy_time` varchar(50) NOT NULL COMMENT '营业时间',
`keyword` varchar(50) NOT NULL COMMENT '关键字',
`skzf` int(11) NOT NULL COMMENT '1.是 2否(刷卡支付)',
`wifi` int(11) NOT NULL COMMENT '1.是 2否',
`mftc` int(11) NOT NULL COMMENT '1.是 2否(免费停车)',
`jzxy` int(11) NOT NULL COMMENT '1.是 2否(禁止吸烟)',
`tgbj` int(11) NOT NULL COMMENT '1.是 2否(提供包间)',
`sfxx` int(11) NOT NULL COMMENT '1.是 2否(沙发休闲)',
`tel` varchar(20) NOT NULL COMMENT '手机号',
`logo` varchar(100) NOT NULL,
`weixin_logo` varchar(100) NOT NULL,
`ad` text NOT NULL COMMENT '轮播图',
`state` int(11) NOT NULL COMMENT '1.待审核2通过3拒绝',
`money` decimal(10,2) NOT NULL COMMENT '金额',
`password` varchar(100) NOT NULL COMMENT '核销密码',
`details` text NOT NULL COMMENT '商家简介',
`uniacid` int(11) NOT NULL,
`coordinates` varchar(50) NOT NULL,
`views` int(11) NOT NULL,
`score` decimal(10,1) NOT NULL,
`type` int(11) NOT NULL,
`sh_time` int(11) NOT NULL,
`time_over` int(11) NOT NULL,
`img` text NOT NULL,
`vr_link` text NOT NULL,
`num` int(11) NOT NULL,
`start_time` varchar(20) NOT NULL,
`end_time` varchar(20) NOT NULL,
`wallet` decimal(10,2) NOT NULL,
`user_name` varchar(30) NOT NULL,
`pwd` varchar(50) NOT NULL,
`dq_time` int(11) NOT NULL,
`cityname` varchar(50) NOT NULL,
`time` datetime NOT NULL,
`fx_num` int(11) NOT NULL,
`ewm_logo` varchar(100) NOT NULL,
`is_top` int(4) NOT NULL DEFAULT '2',
`yyzz_img` varchar(100) NOT NULL,
`sfz_img` varchar(100) NOT NULL,
`is_rm` int(11) NOT NULL DEFAULT '2',
`video` varchar(300) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_store_wallet`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_store_wallet` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`store_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`note` varchar(20) NOT NULL,
`type` int(11) NOT NULL COMMENT '1加2减',
`time` varchar(20) NOT NULL,
`tx_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_storepaylog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_storepaylog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`store_id` int(11) NOT NULL COMMENT '商家ID',
`money` decimal(10,2) NOT NULL,
`time` datetime NOT NULL,
`uniacid` varchar(50) NOT NULL,
`note` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_storetype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_storetype` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL COMMENT '分类名称',
`img` varchar(100) NOT NULL COMMENT '分类图片',
`uniacid` int(11) NOT NULL,
`num` int(11) NOT NULL COMMENT '排序',
`money` decimal(10,2) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_storetype2`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_storetype2` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL,
`type_id` int(11) NOT NULL COMMENT '主分类id',
`num` int(11) NOT NULL COMMENT '排序',
`uniacid` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_storetypead`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_storetypead` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(50) NOT NULL COMMENT '轮播图标题',
`logo` varchar(200) NOT NULL COMMENT '图片',
`status` int(11) NOT NULL COMMENT '1.开启  2.关闭',
`src` varchar(100) NOT NULL COMMENT '链接',
`orderby` int(11) NOT NULL COMMENT '排序',
`xcx_name` varchar(20) NOT NULL,
`appid` varchar(20) NOT NULL,
`type_id` int(11) NOT NULL,
`type_id2` int(11) NOT NULL,
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`cityname` varchar(50) NOT NULL COMMENT '城市名称',
`wb_src` varchar(300) NOT NULL COMMENT '外部链接',
`state` int(4) NOT NULL DEFAULT '1' COMMENT '1内部，2外部,3跳转',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_system`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_system` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`appid` varchar(100) NOT NULL COMMENT 'appid',
`appsecret` varchar(200) NOT NULL COMMENT 'appsecret',
`mchid` varchar(20) NOT NULL COMMENT '商户号',
`wxkey` varchar(100) NOT NULL COMMENT '商户秘钥',
`uniacid` varchar(50) NOT NULL,
`url_name` varchar(20) NOT NULL COMMENT '网址名称',
`details` text NOT NULL COMMENT '关于我们',
`url_logo` varchar(100) NOT NULL COMMENT '网址logo',
`bq_name` varchar(50) NOT NULL COMMENT '版权名称',
`link_name` varchar(30) NOT NULL COMMENT '网站名称',
`link_logo` varchar(100) NOT NULL COMMENT '网站logo',
`support` varchar(20) NOT NULL COMMENT '技术支持',
`bq_logo` varchar(100) NOT NULL,
`color` varchar(20) NOT NULL,
`tz_appid` varchar(30) NOT NULL,
`tz_name` varchar(30) NOT NULL,
`pt_name` varchar(30) NOT NULL COMMENT '平台名称',
`tz_audit` int(11) NOT NULL COMMENT '帖子审核1.是 2否',
`sj_audit` int(11) NOT NULL COMMENT '商家审核1.是 2否',
`mapkey` varchar(200) NOT NULL,
`tel` varchar(20) NOT NULL,
`gd_key` varchar(100) NOT NULL,
`rz_xuz` text NOT NULL,
`ft_xuz` text NOT NULL,
`fx_money` decimal(10,2) NOT NULL,
`hb_sxf` int(11) NOT NULL,
`tx_money` decimal(10,2) NOT NULL,
`tx_sxf` int(11) NOT NULL,
`tx_details` text NOT NULL,
`is_hhr` int(4) NOT NULL DEFAULT '2',
`is_hbfl` int(4) NOT NULL DEFAULT '2',
`is_zx` int(4) NOT NULL DEFAULT '2',
`is_car` int(4) NOT NULL,
`pc_xuz` text NOT NULL,
`pc_money` decimal(10,2) NOT NULL,
`is_sjrz` int(4) NOT NULL,
`is_pcfw` int(4) NOT NULL,
`total_num` int(11) NOT NULL,
`is_goods` int(4) NOT NULL,
`apiclient_cert` text NOT NULL,
`apiclient_key` text NOT NULL,
`is_openzx` int(4) NOT NULL,
`is_hyset` int(4) NOT NULL,
`is_tzopen` int(4) NOT NULL,
`is_pageopen` int(4) NOT NULL,
`cityname` varchar(50) NOT NULL,
`is_tel` int(4) NOT NULL DEFAULT '1',
`tx_mode` int(4) NOT NULL DEFAULT '1',
`many_city` int(4) NOT NULL DEFAULT '2',
`tx_type` int(4) NOT NULL DEFAULT '2',
`is_hbzf` int(4) NOT NULL DEFAULT '1',
`hb_img` varchar(100) NOT NULL,
`tz_num` int(11) NOT NULL,
`client_ip` varchar(30) NOT NULL,
`hb_content` varchar(100) NOT NULL,
`is_tzhb` int(4) NOT NULL DEFAULT '1',
`sj_max` varchar(1) NOT NULL,
`zfwl_max` varchar(1) NOT NULL,
`zfwl_open` int(4) NOT NULL DEFAULT '1',
`zx_type` int(4) NOT NULL DEFAULT '1',
`ft_num` int(11) NOT NULL,
`is_img` int(11) NOT NULL DEFAULT '2',
`is_sjhb` int(11) NOT NULL DEFAULT '1',
`is_tzdz` int(11) NOT NULL DEFAULT '1',
`is_rz` int(11) NOT NULL DEFAULT '1',
`integral` int(11) NOT NULL,
`integral2` int(11) NOT NULL,
`is_jf` int(11) NOT NULL DEFAULT '1',
`is_kf` int(11) NOT NULL DEFAULT '1',
`dw_more` int(11) NOT NULL DEFAULT '2',
`is_zxrz` int(11) NOT NULL DEFAULT '1',
`tzmc` varchar(20) NOT NULL DEFAULT '帖子',
`is_dnss` int(11) NOT NULL DEFAULT '1',
`is_vr` int(11) NOT NULL DEFAULT '1',
`is_yysj` int(11) NOT NULL DEFAULT '1',
`tc_img` varchar(100) NOT NULL,
`tc_gg` varchar(100) NOT NULL,
`hbbj_img` varchar(200) NOT NULL,
`gs_img` text NOT NULL,
`gs_details` text NOT NULL,
`gs_tel` varchar(20) NOT NULL,
`gs_time` varchar(50) NOT NULL,
`gs_add` varchar(200) NOT NULL,
`gs_zb` varchar(50) NOT NULL,
`model` int(4) NOT NULL DEFAULT '1',
`is_bm` int(11) NOT NULL DEFAULT '2',
`zf_title` varchar(50) NOT NULL,
`sh_time` int(11) NOT NULL,
`is_qgb` int(11) NOT NULL DEFAULT '2',
`is_qgb2` int(11) NOT NULL DEFAULT '2',
`is_coupon` int(11) NOT NULL DEFAULT '2',
`is_sy` int(11) NOT NULL DEFAULT '2',
`coupon_img` varchar(500) NOT NULL,
`kp_img` varchar(500) NOT NULL,
`kp_time` int(11) NOT NULL DEFAULT '3',
`is_hd` int(11) NOT NULL DEFAULT '2',
`sj_max2` int(11) NOT NULL,
`is_pcqx` int(11) NOT NULL DEFAULT '1',
`is_hyqx` int(11) NOT NULL DEFAULT '1',
`is_yhqqx` int(11) NOT NULL DEFAULT '1',
`is_syqx` int(11) NOT NULL DEFAULT '1',
`is_hdqx` int(11) NOT NULL DEFAULT '1',
`is_hbqx` int(11) NOT NULL DEFAULT '1',
`is_hhrqx` int(11) NOT NULL DEFAULT '1',
`is_dcsqx` int(11) NOT NULL DEFAULT '1',
`is_jfqx` int(11) NOT NULL DEFAULT '1',
`is_spqx` int(11) NOT NULL DEFAULT '1',
`is_sp` int(11) NOT NULL DEFAULT '1',
`sygg_name` varchar(20) NOT NULL DEFAULT '同城头条',
`sjgg_name` varchar(20) NOT NULL DEFAULT '信息头条',
`flgg_name` varchar(20) NOT NULL DEFAULT '商家快报',
`is_zf` int(11) NOT NULL DEFAULT '1',
`is_yhqsh` int(11) NOT NULL DEFAULT '1',
`hb_name` varchar(20) NOT NULL DEFAULT '红包',
`fl_name` varchar(20) NOT NULL DEFAULT '福利',
`is_pzsj` int(11) NOT NULL DEFAULT '1',
`ggoods_set` int(4) NOT NULL DEFAULT '1',
`is_xsqg` int(4) NOT NULL DEFAULT '2',
`xgsh` int(4) NOT NULL DEFAULT '1',
`is_qgqx` int(4) NOT NULL DEFAULT '2',
`g_open` int(4) NOT NULL DEFAULT '2',
`g_qx` int(4) NOT NULL DEFAULT '1',
`fx_jf` int(11) NOT NULL,
`good_jf` int(11) NOT NULL,
`is_city` int(11) NOT NULL DEFAULT '1',
`hy_title` varchar(20) NOT NULL DEFAULT '黄页114',
`kp_url` varchar(300) NOT NULL,
`is_message` int(4) NOT NULL DEFAULT '1',
`is_bdtel` int(4) NOT NULL DEFAULT '1',
`is_ff` int(4) NOT NULL DEFAULT '2',
`is_pgzf` int(4) NOT NULL DEFAULT '2',
`is_video` int(4) NOT NULL DEFAULT '1',
`fj_tz` int(4) NOT NULL DEFAULT '2',
`cz_password` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_top`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_top` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` int(11) NOT NULL COMMENT '1.一天2.一周3.一个月',
`money` decimal(10,2) NOT NULL COMMENT '价格',
`uniacid` int(11) NOT NULL,
`num` int(11) NOT NULL,
`money2` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_type`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_type` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL COMMENT '分类名称',
`img` varchar(100) NOT NULL COMMENT '分类图片',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`num` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
`sx_money` decimal(10,2) NOT NULL,
`money2` decimal(10,2) NOT NULL,
`tel_money` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_type2`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_type2` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL COMMENT '分类名称',
`type_id` int(11) NOT NULL COMMENT '主分类id',
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
`tel_money` decimal(10,2) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_tzpaylog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_tzpaylog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`tz_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`time` datetime NOT NULL,
`uniacid` varchar(50) NOT NULL,
`note` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_user`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_user` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`openid` varchar(100) NOT NULL COMMENT 'openid',
`img` varchar(200) NOT NULL COMMENT '头像',
`time` varchar(20) NOT NULL COMMENT '注册时间',
`name` varchar(20) NOT NULL,
`uniacid` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`user_name` varchar(20) NOT NULL,
`user_tel` varchar(20) NOT NULL,
`user_address` varchar(200) NOT NULL,
`commission` decimal(10,2) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
`total_score` int(11) NOT NULL,
`day` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_usercoupons`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_usercoupons` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`coupons_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`state` int(11) NOT NULL DEFAULT '2' COMMENT '1.使用2.未使用',
`time` varchar(20) NOT NULL,
`pay_type` int(11) NOT NULL,
`code` varchar(100) NOT NULL,
`lq_money` decimal(10,2) NOT NULL,
`del` int(11) NOT NULL DEFAULT '2',
`hx_time` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_userformid`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_userformid` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL COMMENT '用户id',
`form_id` varchar(50) NOT NULL COMMENT 'form_id',
`time` datetime NOT NULL,
`uniacid` varchar(50) NOT NULL,
`openid` varchar(50) NOT NULL COMMENT 'openid',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_video`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_video` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_id` int(11) NOT NULL COMMENT '分类ID',
`title` varchar(200) NOT NULL COMMENT '标题',
`time` datetime NOT NULL,
`yd_num` int(11) NOT NULL COMMENT '阅读数量',
`pl_num` int(11) NOT NULL COMMENT '评论数量',
`dz_num` int(11) NOT NULL COMMENT '点赞数量',
`uniacid` varchar(50) NOT NULL,
`url` varchar(500) NOT NULL COMMENT '视频链接',
`logo` varchar(200) NOT NULL COMMENT '发布人logo',
`nick_name` varchar(30) NOT NULL COMMENT '昵称',
`cityname` varchar(50) NOT NULL COMMENT '城市名称',
`num` int(11) NOT NULL COMMENT '排序',
`fm_logo` varchar(200) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_videodz`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_videodz` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`video_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_videopl`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_videopl` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`content` varchar(500) NOT NULL,
`video_id` int(11) NOT NULL,
`time` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_videotype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_videotype` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL COMMENT '分类名称',
`img` varchar(100) NOT NULL COMMENT '分类图片',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`num` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_withdrawal`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_withdrawal` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(10) NOT NULL COMMENT '真实姓名',
`username` varchar(100) NOT NULL COMMENT '账号',
`type` int(11) NOT NULL COMMENT '1支付宝 2.微信 3.银行',
`time` int(11) NOT NULL COMMENT '申请时间',
`sh_time` int(11) NOT NULL COMMENT '审核时间',
`state` int(11) NOT NULL COMMENT '1.待审核 2.通过  3.拒绝',
`tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额',
`sj_cost` decimal(10,2) NOT NULL COMMENT '实际金额',
`user_id` int(11) NOT NULL COMMENT '用户id',
`uniacid` int(11) NOT NULL,
`method` int(11) NOT NULL,
`store_id` int(11) NOT NULL,
`bank` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yellowpaylog`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yellowpaylog` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`hy_id` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`time` datetime NOT NULL,
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yellowset`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yellowset` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`days` int(11) NOT NULL COMMENT '入住天数',
`money` decimal(10,2) NOT NULL,
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yellowstore`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yellowstore` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`logo` varchar(200) NOT NULL COMMENT 'logo图片',
`company_name` varchar(100) NOT NULL COMMENT '公司名称',
`company_address` varchar(200) NOT NULL COMMENT '公司地址',
`type_id` int(11) NOT NULL COMMENT '二级分类',
`link_tel` varchar(20) NOT NULL COMMENT '联系电话',
`sort` int(11) NOT NULL COMMENT '排序',
`rz_time` int(11) NOT NULL COMMENT '入住时间',
`sh_time` int(11) NOT NULL COMMENT '审核时间',
`state` int(4) NOT NULL COMMENT '1待,2通过,3拒绝',
`rz_type` int(4) NOT NULL COMMENT '入驻类型',
`time_over` int(4) NOT NULL COMMENT '1到期,2没到期',
`uniacid` varchar(50) NOT NULL,
`coordinates` varchar(50) NOT NULL COMMENT '坐标',
`content` text NOT NULL COMMENT '简介',
`imgs` varchar(500) NOT NULL COMMENT '多图',
`views` int(11) NOT NULL,
`tel2` varchar(20) NOT NULL,
`cityname` varchar(50) NOT NULL,
`dq_time` int(11) NOT NULL,
`type2_id` int(11) NOT NULL,
`is_delete` int(4) NOT NULL DEFAULT '2',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yellowtype`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yellowtype` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`type_name` varchar(20) NOT NULL COMMENT '分类名称',
`img` varchar(100) NOT NULL COMMENT '分类图片',
`uniacid` int(11) NOT NULL COMMENT '小程序id',
`num` int(11) NOT NULL,
`money` decimal(10,2) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1' COMMENT '1启用,2禁用',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yellowtype2`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yellowtype2` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) NOT NULL COMMENT '分类名称',
`type_id` int(11) NOT NULL COMMENT '主分类id',
`num` int(11) NOT NULL,
`uniacid` int(11) NOT NULL,
`state` int(4) NOT NULL DEFAULT '1' COMMENT '1启用,2禁用',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yjset`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yjset` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` int(4) NOT NULL DEFAULT '1' COMMENT '1统一模式,2分开模式',
`typer` varchar(10) NOT NULL COMMENT '统一比例',
`sjper` varchar(10) NOT NULL COMMENT '商家比例',
`hyper` varchar(10) NOT NULL COMMENT '黄页比例',
`pcper` varchar(10) NOT NULL COMMENT '拼车比例',
`tzper` varchar(10) NOT NULL COMMENT '帖子比例',
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_yjtx`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_yjtx` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`account_id` int(11) NOT NULL COMMENT '账号id',
`tx_type` int(4) NOT NULL COMMENT '提现方式 1,支付宝,2微信,3银联',
`tx_cost` decimal(10,2) NOT NULL COMMENT '提现金额',
`status` int(4) NOT NULL COMMENT '状态 1申请,2通过,3拒绝',
`uniacid` varchar(50) NOT NULL,
`cerated_time` datetime NOT NULL COMMENT '日期',
`sj_cost` decimal(10,2) NOT NULL COMMENT '实际金额',
`account` varchar(30) NOT NULL COMMENT '账户',
`name` varchar(30) NOT NULL COMMENT '姓名',
`sx_cost` decimal(10,2) NOT NULL COMMENT '手续费',
`time` datetime NOT NULL COMMENT '审核时间',
`is_del` int(4) NOT NULL DEFAULT '1' COMMENT '1正常,2删除',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_zx`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_zx` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_id` int(11) NOT NULL COMMENT '分类ID',
`user_id` int(11) NOT NULL COMMENT '发布人ID',
`title` varchar(200) NOT NULL COMMENT '标题',
`content` text NOT NULL COMMENT '内容',
`time` datetime NOT NULL,
`yd_num` int(11) NOT NULL COMMENT '阅读数量',
`pl_num` int(11) NOT NULL COMMENT '评论数量',
`uniacid` varchar(50) NOT NULL,
`imgs` text NOT NULL COMMENT '图片',
`state` int(4) NOT NULL,
`sh_time` datetime NOT NULL,
`type` int(4) NOT NULL,
`cityname` varchar(50) NOT NULL,
`video` varchar(300) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_zx_assess`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_zx_assess` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`zx_id` int(4) NOT NULL,
`score` int(11) NOT NULL,
`content` text NOT NULL,
`img` varchar(500) NOT NULL,
`cerated_time` datetime NOT NULL,
`user_id` int(11) NOT NULL,
`uniacid` varchar(50) NOT NULL,
`status` int(4) NOT NULL,
`reply` text NOT NULL,
`reply_time` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_zx_type`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_zx_type` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type_name` varchar(100) NOT NULL COMMENT '分类名称',
`icon` varchar(100) NOT NULL COMMENT '图标',
`sort` int(4) NOT NULL COMMENT '排序',
`time` datetime NOT NULL COMMENT '时间',
`uniacid` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_zhtc_zx_zj`;
CREATE TABLE IF NOT EXISTS `ims_zhtc_zx_zj` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`zx_id` int(11) NOT NULL COMMENT '资讯ID',
`user_id` int(11) NOT NULL COMMENT '用户ID',
`uniacid` varchar(50) NOT NULL,
`time` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");
