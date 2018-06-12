<?php
/**
 * MyAsset.php
 * 我的资产
 * @author zhuminghai
 * @since 2018/6/11
 */

class Service_Page_View_MyAsset extends Base_Page{

    private $dataObj;

    public function __construct() {

        parent::__construct();

        $this->dataObj = new Service_Data_MyAsset();

    }

    public function call() {

        $result = $data = array();

        // 未登录的不做后续处理
        $data['isUserLogin'] = false;
        if(!$this->useInfo['uid']) {
            $result['data'] = $data;
            $this->arrOutput = Utils_Output::SuccessArray($result);
            return;
        }
        $data['isUserLogin'] = true;

        // 获取我的资产信息
        $assetRet = $this->dataObj->getMyAsset($this->useInfo['uid'], $this->arrInput);
        if(!empty($assetRet)) {
            $data['asset'] = $assetRet;
        } else {
            $data['asset'] = array();
        }
        $result['data'] = $data;
        $this->arrOutput = Utils_Output::SuccessArray($result);

    }
}