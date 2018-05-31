<?php
/**
 * Home.php
 * 区块链浏览器首页内容处理
 * @author zhuminghai
 * @since 2018/5/31
 */

class Service_Page_View_Home extends Base_Page {

    public function __construct() {

        parent::__construct();
    }

    public function call() {
        $ret = array('data' => '1111111111111');
        $this->arrOutput = Utils_Output::SuccessArray($ret);
    }
}