<?php
/**
 * CheckLogin.php
 * 校验登录状态信息
 *   （1）是否已登录
 *   （2）是否具有区块链账号
 * @author zhuminghai
 * @since 2018/6/5
 */

class Service_Page_Api_CheckLogin extends Base_Page {

    private $dataObj;

    public function __construct() {

        parent::__construct();

        $this->isSignCheckOpen = false;

        $this->dataObj = new Service_Data_CheckLogin();

    }

    public function call() {

        $result = array();
        $data = array(
            'isUserLogin' => 0,
            'chainUserExist' => 0,
        );

        // 若用户未登录
        if (!$this->useInfo['isLogin']) {
            $result['data'] = $data;
            $this->arrOutput = Utils_Output::SuccessArray($result);
            return;
        }
        $result['isUserLogin'] = 1;

        // 区块链账户是否存在
        $chainUserInfo = $this->dataObj->isChainUserExists($this->useInfo['uid']);
        if ($chainUserInfo['has_account']) {
            $data['chainUserExist'] = 1;
            $data['userAddress'] = $chainUserInfo['address'];
        }
        $result['data'] = $data;
        $this->arrOutput = Utils_Output::SuccessArray($result);
    }
}