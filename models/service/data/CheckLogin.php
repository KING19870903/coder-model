<?php
/**
 * CheckLogin.php
 * 校验登录状态和区块链账户信息
 * @author zhuminghai
 * @since 2018/6/5
 */

class Service_Data_CheckLogin {

    /**
     * 访问下游区块链服务
     * @var Dao_BlockChain
     */
    private $daoObj;

    public function __construct() {

        $this->daoObj = new Dao_BlockChain();
    }

    /**
     * 获取区块链用户信息
     * @param $uid
     * @return array
     */
    public function isChainUserExists($uid) {

        $ret = $this->daoObj->queryChainUser($uid);

        return $ret;
    }
}