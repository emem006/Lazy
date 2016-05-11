<?php
namespace Common\Model;
use Think\Model;

/**
 * Class BaseModel
 * @package Common\Model
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
        $Page = new \Think\HPage($total, $page_size, $parameter);
        $Page->setConfig('theme',"%UP_PAGE% %HEADER% %DOWN_PAGE% ");
        return $Page;
    }
}