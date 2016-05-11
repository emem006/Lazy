<?php
return array(
    /* 模块相关配置 */
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common'),
    'MODULE_ALLOW_LIST'   => array('Admin','Home','Api','Chat','WeChat','Ad'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'VaRW}DfS"u5E(4/J,^M@xZ.7e<mI$;oCL`8z3_wN', //默认数据加密KEY

    /* 调试配置 */
    'SHOW_PAGE_TRACE' => false,

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => false, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 2, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '-', //PATHINFO URL分割符
    'URL_PATHINFO_FETCH'    =>   'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
    'URL_HTML_SUFFIX'       => '', // URL伪静态后缀设置
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到Action方法参数

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'qdm106869432.my3w.com', // 服务器地址
    'DB_NAME'   => 'qdm106869432_db', // 数据库名
    'DB_USER'   => 'qdm106869432', // 用户名
    'DB_PWD'    => 'verazhang',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'l_', // 数据库表前缀

    //扩展配置
    'LOAD_EXT_CONFIG'       => 'regular,socialize',
    /*Cookies设置*/
    'COOKIE_DOMAIN'  =>'easymall.top',
    
    'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'open'  => 'Admin',
    ),

    'THINK_EMAIL' => array(
        'SMTP_HOST'     => 'smtp.126.com',
        'SMTP_PORT'     => '25',
        'SMTP_USER'     => 'luoyulin007@126.com',
        'SMTP_PASS'     => 'verazhang',
        'FROM_EMAIL'    => 'luoyulin007@126.com',
        'FROM_NAME'     => '慵懒',
        'REPLY_NAME'    => '',
        'REPLY_EMAIL'   => '',
    )
);