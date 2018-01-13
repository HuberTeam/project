<?php
return array(
	//'配置项'=>'配置值'

	//URL地址不区分大小写
	'URL_CASE_INSENSITIVE' => true,
	//URL普通模式
	'URL_MODEL' => 0,
	//数据库配置文件单独放置 方便配置
	'LOAD_EXT_CONFIG' => 'db',
	//伪静态设置
	'HTML_FILE_SUFFIX' => '.html',
	//加载自定义标签
//		'TAGLIB_BUILD_IN' => 'Cx,Common\Tag\Ue',
		'TAGLIB_BUILD_IN' => 'Cx,Common\Tag\Up',
	// 定义常用路径
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__ . '/Public',
		'__HOME_CSS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Home/Public/css',
		'__HOME_JS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Home/Public/js',
		'__HOME_IMAGES__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Home/Public/images',
		'__ADMIN_CSS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Admin/Public/css',
		'__ADMIN_JS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Admin/Public/js',
		'__ADMIN_IMAGES__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Admin/Public/images',
		'__PUBLIC_CSS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Public/css',
		'__PUBLIC_JS__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Public/js',
		'__PUBLIC_IMAGES__' => __ROOT__ . trim( TMPL_PATH, '.' ) . 'Public/images',
		'__STATIC_FW__' => __ROOT__ . 'Public/statics',
	),

);