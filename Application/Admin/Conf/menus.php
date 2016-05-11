<?php
/**
 * 菜单配置列表
 * group  父菜单 title标题名称  icon改组图标 class是否选中 默认为空 url链接地址  is_developer 0都可见 1开发者模式可见
 * child 子菜单 同上
 */
return array(
    'MENUS' => array(
        array(
            'group' => array('title' => '首页', 'icon' => 'fa-home', 'class' => '', 'url' => 'Index/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title'=>'文章管理','icon'=>'fa-file','class'=>'','url'=>'javascript:void(0);','is_developer'=>0),
            '_child' => array(
                array('title'=>'文章列表','url'=>'Article/index','class'=>'','is_developer'=>0),
                array('title'=>'杂谈列表','url'=>'Talk/index','class'=>'','is_developer'=>0),
                array('title'=>'文章分类','url'=>'ArticleCategory/index','class'=>'','is_developer'=>0)
            )
        ),
        array(
            'group' => array('title' => '微语', 'icon' => 'fa-twitter', 'class' => '', 'url' => 'Twitter/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title' => '留言', 'icon' => 'fa-comments', 'class' => '', 'url' => 'javascript:void(0);', 'is_developer' => 0),
            '_child' => array(
                array('title'=>'留言列表','url'=>'Message/index','class'=>'','is_developer'=>0),
                array('title'=>'回复列表','url'=>'Message/replyList','class'=>'','is_developer'=>0)
            )
        ),
        array(
            'group' => array('title' => '访客', 'icon' => 'fa-heart', 'class' => '', 'url' => 'Bind/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title' => '友情链接', 'icon' => 'fa-external-link', 'class' => '', 'url' => 'FriendlyLink/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title' => '背景图片', 'icon' => 'fa-picture-o', 'class' => '', 'url' => 'Background/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title' => '导航', 'icon' => 'fa-navicon', 'class' => '', 'url' => 'Nav/index', 'is_developer' => 0),
            '_child' => array()
        ),
        array(
            'group' => array('title' => '站点设置', 'icon' => 'fa-cog', 'class' => '', 'url' => 'Config/update', 'is_developer' => 0),
            '_child' => array()
        ),
    ),
);