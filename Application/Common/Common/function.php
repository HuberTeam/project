<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/09/18 14:23
 * public function
 */

/**
 * getMd5Password 加密可考虑改为随机数
 */
function getMd5Password( $password ) {
	return md5( $password . 'poipoi' );
}

/**
 * dialog layer 封装一下方便调用
 */
function showlayer( $status, $message, $data = array() ) {
	$reuslt = array(
		'status' => $status,
		'message' => $message,
		'data' => $data,
	);
	exit( json_encode( $reuslt ) );
}

function getMenuType( $type ) {
	return $type == 1 ? '后台菜单' : '前台导航';
}

/**
 * 返回状态值的具体信息
 * @param  int
 * @return string
 */
function getStatus( $status ) {
    $status= intval($status);
    if($status === 1){
       $status=  '<span style="color:#58D68D">开启</span>';
    }elseif ($status === 0) {
       $status = '<span style="color:#F4D03F">关闭</span>';
    }elseif ($status === -1) {
       $status = '<span style="color:red">回收站</span>';
    }
    return $status;
}

/**
 * 获取后台自由菜单Url
 */
function getAdminPlusMenusUrl( $nav ) {
	$url = '/admin.php?c=' . $nav[ 'c' ] . '&a=' . $nav[ 'a' ];
	if ( $nav[ 'f' ] == 'index' ) {
		$url = '/admin.php?c=' . $nav[ 'c' ];
	}
	return $url;
}

/**
 * 获取ID对应的栏目
 */
function getCatNameByCatId($navs , $id){
    foreach($navs as $nav) {
        $navList[$nav['menu_id']] = $nav['name'];
    }
    return isset($navList[$id]) ? $navList[$id] : '';
}

/**
 * 获取Session中常用信息 包括用户个性化配置等
 * @return data
 */
function getLoginSessionUsername() {
	return I ('session.logined')[ 'username' ] ? I ('session.logined')[ 'username' ] : '';
}
function getLoginSessionRealname() {
	return I ('session.logined')[ 'realname' ] ? I ('session.logined')[ 'realname' ] : '';
}
function getLoginSessionLevel() {
    return I ('session.logined')[ 'level' ] ? I ('session.logined')[ 'level' ] : '';
}
function getLoginSessionPageSize() {
    return I ('session.logined')[ 'pagesize' ] ? I ('session.logined')[ 'pagesize' ] : 10;
}


/**
 * 获取用户登录IP
 * @return x.x.x.x OR Unknow
 */
function getClientIP() {
	global $ip;
	if ( getenv( "HTTP_CLIENT_IP" ) )
		$ip = getenv( "HTTP_CLIENT_IP" );
	else if ( getenv( "HTTP_X_FORWARDED_FOR" ) )
		$ip = getenv( "HTTP_X_FORWARDED_FOR" );
	else if ( getenv( "REMOTE_ADDR" ) )
		$ip = getenv( "REMOTE_ADDR" );
	else $ip = "Unknow";
	return $ip;
}

/**
+----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
+----------------------------------------------------------
 * @static
 * @access public
+----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function msubstr( $str, $start = 0, $length, $charset = "utf-8", $suffix = true ) {
	$len = substr( $str );
	if ( function_exists( "mb_substr" ) ) {
		if ( $suffix )
			return mb_substr( $str, $start, $length, $charset ) . "...";
		else
			return mb_substr( $str, $start, $length, $charset );
	} elseif ( function_exists( 'iconv_substr' ) ) {
		if ( $suffix && $len > $length )
			return iconv_substr( $str, $start, $length, $charset ) . "...";
		else
			return iconv_substr( $str, $start, $length, $charset );
	}
	$re[ 'utf-8' ] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re[ 'gb2312' ] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re[ 'gbk' ] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re[ 'big5' ] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all( $re[ $charset ], $str, $match );
	$slice = join( "", array_slice( $match[ 0 ], $start, $length ) );
	if ( $suffix ) return $slice . "…";
	return $slice;
}

//调适用……传递数据以易于阅读的样式格式化后输出
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

        function mymd5($file)   {
            $fragment = 65536;
            $rh       = fopen($file, 'rb');
            $size     = filesize($file);
            $part1    = fread($rh, $fragment);
            fseek($rh, $size - $fragment);
            $part2 = fread($rh, $fragment);
            fclose($rh);
            return md5($part1 . $part2);
        }



/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 5242880 5MB
 * @return JSON   返回ajax的json格式数据
 */
function ajax_upload($path='file',$format='empty',$maxSize='5242880'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'video' => array('flv', 'mp4', 'rm', 'rmvb','mkv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
    );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
            'maxSize'   =>  $maxSize,               // 上传文件最大为50M
            'rootPath'  =>  './',                   // 文件上传保存的根路径
            'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）
            'saveName'  =>  array('uniqid',''),     // 上传文件的保存规则，支持数组和字符串方式定义
            'autoSub'   =>  true,                   // 自动使用子目录保存上传文件 默认为true
            'exts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
        );
        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();
        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
//            echo (json_encode($data));
            return $data;
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');
//                echo (json_encode($data));
                return $data;
            }
        }
    }
}


