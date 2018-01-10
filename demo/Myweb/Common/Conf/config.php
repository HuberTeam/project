<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'data',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'SHOW_PAGE_TRACE'		=>  false,//开启调试工具
     'DATA_CACHE_TYPE'       => 'Memcache',  // 数据缓存类型
    //邮箱设置
    'mail1'=>array(
    	//设置邮件服务器地址
    	'smtp'=>'smtp.163.com',
    	//设置发件人的邮箱地址
    	'username'=>'18376792744@163.com',
    	//客户端的授权密码
    	'password'=>'kenie1711'
    	),
);