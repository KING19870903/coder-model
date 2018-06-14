<?php
/**
 * RedisContent.php
 * redis的访问类，访问Redis_mco_content服务的入口
 * @author zhuminghai
 * @since 2018/5/22
 */

class Dao_RedisContent extends Dao_RedisBase {

    public function __construct() {
        $arrConfig = array(
            'pid'      => 'mco',
            'tk'       => 'mco',
            'instance' => 'content',
        );
        parent::__construct($arrConfig);
    }
}