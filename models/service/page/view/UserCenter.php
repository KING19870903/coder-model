<?php
/**
 * UserCenter.php
 * 我的首页
 * @author zhuminghai
 * @since 2018/6/7
 */

class Service_Page_View_UserCenter extends Base_Page{

    private $dataObj;

    public function __construct() {

        parent::__construct();

        $this->dataObj = new Service_Data_CheckLogin();

    }

    public function call() {

        $result = $data = array();

        // 是否登录判断
        $data['isUserLogin'] = false;
        if($this->useInfo['uid']) {
            $data['isUserLogin'] = true;
        }

        // 用户头像获取
        if(!empty($this->useInfo['uid'])) {
            $signValue = Bd_Crypt_Ucrypt::ucrypt_encode($this->useInfo['uid'], $this->useInfo['displayname']);
            $data['userIcon'] = Const_Common::USER_ICON_NORMAL . $signValue;
        } else {
            $data['userIcon'] = Const_Common::USER_ICON_DEFAULT;
        }

        // 获取区块链用户地址
        $chainInfo = $this->dataObj->isChainUserExists($this->useInfo['uid']);
        if(!empty($chainInfo)) {
            $data['address'] = $chainInfo['address'];
        }

        $result['data'] = $data;
        $this->arrOutput = Utils_Output::SuccessArray($result);

    }
}