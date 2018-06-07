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

        // 未登录用户直接抛出异常
        if(!$this->useInfo['uid']) {
            $result['data'] = array(
                'isUserLogin' => false
            );
            $this->arrOutput = Utils_Output::SuccessArray($result);
            return;
        }

        // 注册区块链账户
        $retInfo = $this->dataObj->registerUser(
            $this->useInfo['uid'],
            $this->arrInput
        );

        $retInfo['isUserLogin'] = true;
        $result['data'] = $retInfo;
        $this->arrOutput = Utils_Output::SuccessArray($result);
    }
}