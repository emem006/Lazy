<?php
/**
 * 社会化登陆配置
 */
return array(
    //腾讯QQ登录配置
    'THINK_SDK_QQ' => array(
        'APP_KEY'    => '101299164', //应用注册成功后分配的 APP ID
        'APP_SECRET' => 'b0368dcb4c3889a265101fae9c776ac8', //应用注册成功后分配的KEY
        'CALLBACK'   => 'http://easymall.top/Login-callback-type-qq'//'http://easymall.top/index.php?m=Home&c=Login&a=callback&type=qq',
    ),

	//新浪微博配置
	'THINK_SDK_SINA' => array(
        'APP_KEY'    => '2513372875', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '58a7d31cc90cb44440e6f4b9995c6c9c', //应用注册成功后分配的KEY
        'CALLBACK'   => 'http://easymall.top/Login-callback-type-sina',
    ),

    //微信配置
    'WEIXIN' => array(
        'APP_KEY'    => 'wx1c496bcce82ec951', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '50759c0b6a5170c16410430e8c2fd944', //应用注册成功后分配的KEY
        'CALLBACK'   => 'http://www.easymall.top/Login-callback-type-weixin',
    ),

    //支付宝配置
    'ZHIFUBAO' => array(
        'APP_KEY'    => '23327095', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '86cb0dd3358b2768123ea85af7133ecd', //应用注册成功后分配的KEY
        'CALLBACK'   => 'http://www.easymall.top/Login-callback-type-zhifubao',
    ),

);
