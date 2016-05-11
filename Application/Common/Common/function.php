<?php

/**
 * 随机生成字符串
 * @param int $flag 0数字字符混合 1字符 2数字
 * @param int $num 生成个数
 * @return string
 */
function getRandStr($num = 0, $flag = 0) {
    $arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',1,2,3,4,5,6,7,8,9,0);
    $randStr  = '';
    switch($flag) {
        case 0 : $s = 0;  $e = 61; break;
        case 1 : $s = 0;  $e = 51; break;
        case 2 : $s = 52; $e = 61; break;
    }
    for($i = 0; $i < $num; $i++) {
        $index = rand($s, $e);
        $randStr   .= $arr[$index];
    }
    return $randStr;
}

/**
 * 验证email地址格式
 * @param $email
 * @return bool
 */
function checkMail($email) {
    if (preg_match("/^[\w\.\-]+@\w+([\.\-]\w+)*\.\w+$/", $email) && strlen($email) <= 60) {
        return true;
    } else {
        return false;
    }
}

/**
 * 获取用户ip地址
 */
function getIp() {
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    if (!ip2long($ip)) {
        $ip = '';
    }
    return $ip;
}

/**
 * 获取Gravatar头像
 * @param $email
 * @param int $s
 * @param string $d
 * @param string $g
 * @return string
 */
function getGravatar($email, $s = 40, $d = 'mm', $g = 'g') {
    $hash = md5($email);
    $avatar = "http://cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
    return $avatar;
}

/**
 * 调用新浪api返回当前ip地址信息
 * @param string $ip
 * @return bool|mixed
 */
function getCurrentIp($ip = ''){
    if(empty($ip)){
        $ip = getIp();
    }
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
    if(empty($res)){ return false; }
    $jsonMatches = array();
    preg_match('#\{.+?\}#', $res, $jsonMatches);
    if(!isset($jsonMatches[0])){ return false; }
    $json = json_decode($jsonMatches[0], true);
    if(isset($json['ret']) && $json['ret'] == 1){
        $json['ip'] = $ip;
        unset($json['ret']);
    }else{
        return false;
    }
    return $json;
}


/**
 * 时间转化函数
 * @param $time
 * @return bool|string
 */
function smartDate($time){
    //当前时间
    $now = time();
    //今天零时零分零秒
    $today = strtotime(date('Y-m-d',$now));
    //传递时间与当前时间相差的秒数
    $diff = $now - $time;
    switch ($time) {
        case $diff < 60:
            $str = '刚刚';
            break;
        case $diff < 3600:
            $str = floor($diff / 60) .'分钟前';
            break;
        case $diff < (3600 * 8):
            $str = floor($diff / 3600) .'小时前';
            break;
        case $time > $today:
            $str = '今天' . date('H:i',$time);
            break;
        default:
            $str = date('Y-m-d H:i',$time);
            break;
    }
    return $str;
}

/**
 * 获取当前页面的url
 * @return string
 */
function getUrl() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

/**
 * 截取编码为utf8的字符串
 * @param string $strings 预处理字符串
 * @param int $start 开始处
 * @param int $length 截取长度
 * @return string
 */
function subString($strings = '', $start = 0, $length = 100) {
    if (function_exists('mb_substr') && function_exists('mb_strlen')) {
        $sub_str = mb_substr($strings, $start, $length, 'utf8');
        return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
    }
    $str = substr($strings, $start, $length);
    $char = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        if (ord($str[$i]) >= 128)
            $char++;
    }
    $str2 = substr($strings, $start, $length + 1);
    $str3 = substr($strings, $start, $length + 2);
    if ($char % 3 == 1) {
        if ($length <= strlen($strings)) {
            $str3 .= '...';
        }
        return $str3;
    }
    if ($char % 3 == 2) {
        if ($length <= strlen($strings)) {
            $str2 .= '...';
        }
        return $str2;
    }
    if ($char % 3 == 0) {
        if ($length <= strlen($strings)) {
            $str .= '...';
        }
        return $str;
    }
}

/**
 * 从可能包含html标记的内容中萃取纯文本摘要
 * @param $data
 * @param $len
 * @return string
 */
function extractHtmlData($data, $len) {
    $data = strip_tags(subString($data, 0, $len + 30));
    $search = array("/([\r\n])[\s]+/", // 去掉空白字符
        "/&(quot|#34);/i", // 替换 HTML 实体
        "/&(amp|#38);/i",
        "/&(lt|#60);/i",
        "/&(gt|#62);/i",
        "/&(nbsp|#160);/i",
        "/&(iexcl|#161);/i",
        "/&(cent|#162);/i",
        "/&(pound|#163);/i",
        "/&(copy|#169);/i",
        "/\"/i",
    );
    $replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
    $data = trim(subString(preg_replace($search, $replace, $data), 0, $len));
    return $data;
}

/**
 * 调用第三方登录
 * @param $type 登陆类型
 * @return mixed
 */
function ThinkOauth($type){
    $type=strtolower($type);
    //载入相应类文件
    include_once APP_PATH.'Home/Common/oauth/'.ucfirst($type).'Oauth.php';
    $class_name="\\ThinkOauth\\".ucfirst($type)."Oauth";
    if(!class_exists($class_name))E('没有找到相应的类');
    $obj=new $class_name();
    return $obj;
}

//签名函数
function createSign ($paramArr) {
    global $appSecret;
    $sign = $appSecret;
    ksort($paramArr);
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $sign .= $key.$val;
        }
    }
    $sign.=$appSecret;
    $sign = strtoupper(md5($sign));
    return $sign;
}

//组参函数
function createStrParam ($paramArr) {
    $strParam = '';
    foreach ($paramArr as $key => $val) {
        if ($key != '' && $val != '') {
            $strParam .= $key.'='.urlencode($val).'&';
        }
    }
    return $strParam;
}

/**
 * 获取当前页面完整URL地址
 */
function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

/**
 * 手动记录日志
 * @param $message
 * @param string $level
 * @param int $type
 * @param string $destination
 * @param string $extra
 */
function write($message,$level='ERROR',$type=3,$destination='',$extra='') {
    $LOG_PATH = './';
    $LOG_FILE_SIZE = 100;
    $now = date('[ c ]');
    $type = $type?$type:3;
    if($type == 3) { // 文件方式记录日志
        if(empty($destination))
            $destination = $LOG_PATH.date('y-m-d').'.log';
        //检测日志文件大小，超过配置大小则备份日志文件重新生成
        if(is_file($destination) && floor($LOG_FILE_SIZE) <= filesize($destination) )
            rename($destination,dirname($destination).'/'.basename($destination).'-'.time().'.log');
    }
    error_log("{$now} {$level}: {$message}\r\n", $type,$destination,$extra );
}