<?php
namespace Common\Model;

/**
 * Class ArticleModel
 * @package Manager\Model
 * 文章咨询模型
 */
class BackgroundModel extends BaseModel {

    /**
     * 随机查询一条
     * @return mixed
     */
    public function randFind(){
        $sql = "SELECT `img`
                FROM `l_background` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `l_background`)-(SELECT MIN(id) FROM `l_background`))+(SELECT MIN(id) FROM `l_background`)) AS id) AS t2
                WHERE t1.id >= t2.id AND t1.status = 1
                ORDER BY t1.id ASC LIMIT 1";
        return $this->query($sql);
    }

}