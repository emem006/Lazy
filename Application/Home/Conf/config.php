<?php
return array(
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'l_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__COMMON__' => __ROOT__ . '/Public/Common',
        '__DOCUMENT__' => __ROOT__ . '/Public/Document',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'URL_HTML_SUFFIX'  => '', // URL伪静态后缀设置

    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'l_home', //session前缀
    'COOKIE_PREFIX'  => 'l_home_', // Cookie前缀 避免冲突

);