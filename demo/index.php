<?php
date_default_timezone_set('PRC');
//开启页面调试工具
define('APP_DEBUG',false);
//创建一个应用
define('APP_PATH','./Myweb/');

define('USER_ROOT', dirname(__FILE__));
//导入ThinkPHP 里的ThinkPHP.php
require('./ThinkPHP/ThinkPHP.php'); 
 ?>