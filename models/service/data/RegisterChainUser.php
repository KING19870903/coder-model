<?php
/**
 * RegisterChainUser.php
 * 注册区块链账户
 * @author zhuminghai
 * @since 2018/6/5
 */

class Service_Data_RegisterChainUser {

    /**
     * @var Dao_BlockChain
     */
    private $daoObj;

    public function __construct() {

        $this->daoObj = new Dao_BlockChain();

    }

    /**
     * 注册创建区块链账户
     * @param $uid
     * @param array $arrInput
     * @return array
     * @throws Utils_Exception
     */
    public function registerUser($uid, array $arrInput){

       $ret = $this->daoObj->registerChainUser($uid, $arrInput);

       return $ret;

    }

}