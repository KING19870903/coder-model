<?php

/**
 * TransactProperty.php
 *
 * @description : 资产交易记录及查询接口Data层
 *
 * @author : zhaoxichao
 * @since : 11/06/2018
 */
class Service_Data_TransactProperty {
    /**
     * @var Dao_BlockChain|null Dao层实例
     */
    private $objDao = null;

    /**
     * Service_Data_TransactProperty constructor.
     */
    public function __construct() {

        //实例化Dao层
        $this->objDao = new Dao_BlockChain();
    }

    /**
     * isChainUserExists
     * @description : 判断用户是否登录区块链账号
     *
     * @param $uid 百度passport id
     * @return array
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function isChainUserExists($uid) {

        $arrRet = $this->objDao->queryChainUser($uid);

        return $arrRet;
    }

    /**
     * getTransactPropertyData
     * @description : 查询用户资产交易记录
     *
     * @param       $uid 百度passport id
     * @param array $arrInput 请求参数
     * @return array
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function getTransactPropertyData($uid, $arrInput = array()) {

        $arrRet = $this->objDao->queryTransactPropertyData($uid, $arrInput);

        return $arrRet;
    }

}