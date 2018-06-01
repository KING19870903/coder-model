<?php
/**
 * Home.php
 * 区块链浏览器首页内容处理
 * @author zhuminghai
 * @since 2018/5/31
 */

class Service_Page_View_Home extends Base_Page {

    private $dataObj;

    public function __construct() {

        parent::__construct();

        $this->dataObj = new Service_Data_Home();

    }

    public function call() {

        $result = $this->dataObj->getHomeInfo($this->arrInput);

        $this->arrOutput = Utils_Output::SuccessArray($result);
    }
}