<?php
/**
 * RegisterChainUser.php
 * 注册区块链账户
 * @author zhuminghai
 * @since 2018/6/5
 */
class Service_Page_Api_RegisterChainUser extends Base_Page {

    private $dataObj;

    public function __construct() {

        parent::__construct();

        $this->dataObj = new Service_Data_RegisterChainUser();

    }

    public function call() {

        $result =  array();

        // 未登录的不做后续处理
        if(!$this->useInfo['uid']) {
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_USER_NOT_LOGIN);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        // 注册区块链账户
        $retInfo = $this->dataObj->registerUser(
            $this->useInfo['uid'],
            $this->arrInput
        );

        $result['data'] = $retInfo;
        $this->arrOutput = Utils_Output::SuccessArray($result);
    }
}