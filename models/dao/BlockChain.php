<?php
/**
 * BlockChain.php
 * dao层区块链账户访问相关
 * @author zhuminghai
 * @since 2018/6/5
 */

class Dao_BlockChain {

    const SERVICE_NAME = "block_chain";

    /**
     * 路径配置
     */

    // 判断是否存在区块链账户
    const PATH_INFO_CHECK_USER_EXISTS = '/exp/api/add/query';

    // 为用户创建区块链账户
    const PATH_INFO_REGISTER_CHAIN_USER = '/exp/api/add/create';


    public function __construct() {
        // do nothing
    }


    /**
     * 判断区块链用户是否存在
     * @param $uid
     * @return array
     */
    public function queryChainUser($uid) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;

        // ral服务请求
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            self::PATH_INFO_CHECK_USER_EXISTS,
            'get',
            $reqParams
        );

        // ral访问异常
        if(!$ralRet) {
            return $result;
        }

        // 服务处理错误
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                $ralRet['msg']
            );
        }

        return $ralRet['data'];
    }


    /**
     * 注册区块链账户
     * @param $uid
     * @param array $arrInput
     * @return array
     */
    public function registerChainUser($uid, array $arrInput) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;
        $reqParams['strength'] = $arrInput['strength'];
        $reqParams['language'] = $arrInput['language'];
        $reqParams['version'] = 1;

        // ral服务请求
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            self::PATH_INFO_REGISTER_CHAIN_USER,
            'get',
            $reqParams
        );

        // ral访问异常
        if(!$ralRet) {
            return $result;
        }

        // 服务处理错误
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                $ralRet['msg']
            );
        }

        return $ralRet['data'];
    }
}