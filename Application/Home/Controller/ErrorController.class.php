<?php
namespace Home\Controller;
use Think\Controller;
class ErrorController extends Controller{
    public function index(){
        header('Content-type:text/html;charset=utf-8');
        echo '网站正在维护！';
    }

}