<?php
/**
 * Action.php
 * 区块链项目action基础类
 * 定义如下信息：
 * （1）
 * @author zhuminghai
 * @since 2018/5/31
 */

class Base_Action extends As_Base_Action {

    /**
     * 初始化操作
     */
    public function init() {

        $this->statusKey = Const_Common::STATUS_KEY;

        $this->msgKey = Const_Common::MSG_KEY;

        $this->resultKey = Const_Common::RESULT_KEY;

        $this->needGzip = true;
    }
}
