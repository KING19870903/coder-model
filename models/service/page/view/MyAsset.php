<?php
/**
 * MyAsset.php
 * 我的资产
 * @author zhuminghai
 * @since 2018/6/11
 */

class Service_Page_View_MyAsset extends Base_Page{

    /**
     * @var Service_Data_MyAsset
     */
    private $dataObj;

    /**
     * @var Service_Data_CheckLogin
     */
    private $dataCheckLoginObj;

    public function __construct() {

        parent::__construct();

        $this->dataObj = new Service_Data_MyAsset();

        $this->dataCheckLoginObj = new Service_Data_CheckLogin();
    }

    public function call() {

        $result = array();

        // 未登录的不做后续处理
        if(!$this->useInfo['uid']) {
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_USER_NOT_LOGIN);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        // 非注册区块链账户提示用户未注册
        $isChainUserExists = $this->dataCheckLoginObj->isChainUserExists($this->useInfo['uid']);
        if(empty($isChainUserExists)){
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_USER_NOT_CHAIN_USER);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        // 默认分页大小 (单页限制不超过50)
        if(!isset($this->arrInput['page_size'])
            || !is_numeric($this->arrInput['page_size'])
            || $this->arrInput['page_size'] <= 0
            || $this->arrInput['page_size'] > 50) {
            $this->arrInput['page_size'] = Const_Common::DEFAULT_PAGE_SIZE;
        }

        // 默认访问page_num为1
        if(!isset($this->arrInput['page_num'])
            || !is_numeric($this->arrInput['page_num'])
            || $this->arrInput['page_num'] <= 0) {
            $this->arrInput['page_num'] = Const_Common::DEFAULT_PAGE_NUM;
        }

        // 获取我的资产信息
        $assetRet = $this->dataObj->getMyAsset($this->useInfo['uid'], $this->arrInput);
        if(!empty($assetRet)) {
            $result = $assetRet;
        } else {
            $result['data'] = array();
        }

        $this->arrOutput = Utils_Output::SuccessArray($result);

    }
}