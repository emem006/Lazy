<?php
namespace Admin\Model;
use Think\Model;

/**
 * Class BaseModel
 * @package Manager\Model
 * 模型基类
 */
class BaseModel extends Model {


    /**
     * @param int $total 总数
     * @param int $page_size 每页记录数
     * @param array $parameter 拼接参数
     * @return \Think\Page 分页对象
     */
    protected function getPage($total = 0, $page_size = 0, $parameter = array()) {
        $Page = new \Think\Page($total, $page_size, $parameter);
        //分页样式配置
        if($total>$page_size) {
            $Page->setConfig('theme','%UP_PAGE% %FIRST% %LINK_PAGE% %END% %DOWN_PAGE% %HEADER%');
        }
        return $Page;
    }
}