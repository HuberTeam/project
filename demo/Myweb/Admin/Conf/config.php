<?php
return array(
	//'配置项'=>'配置值'
	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'simulation',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'SHOW_PAGE_TRACE'		=>	false,	//开启调试工具
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到Action方法参数
    'DATA_CACHE_TYPE'       => 'Memcache',  // 数据缓存类型
);