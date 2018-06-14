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
    const PATH_INFO_CHECK_USER_EXISTS = '/exp/api/add/query?';

    // 为用户创建区块链账户
    const PATH_INFO_REGISTER_CHAIN_USER = '/exp/api/add/create?';

    // 查询存储用户交易的区块链信息列表
    const PATH_INFO_QUERY_MY_ASSET = '/exp/api/wallet/bc/list?';


    public function __construct() {
        // do nothing
    }


    /**
     * 判断区块链用户是否存在
     * @param $uid
     * @return array
     * @throws Utils_Exception
     */
    public function queryChainUser($uid) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;

        // ral服务请求
        $queryUrl = self::PATH_INFO_CHECK_USER_EXISTS . http_build_query($reqParams);
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            $queryUrl,
            'get'
        );

        $ralRet = json_decode($ralRet, true);
        // ral访问异常
        if(!$ralRet) {

            As_Log_Lib::addNotice(
                "queryChainUser_call",
                "ral_false_error"
            );

            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_USER_CHECK_CHAIN_USER);
            throw new Utils_Exception(
                $msg,
                Const_Error::ERROR_USER_CHECK_CHAIN_USER
            );
            return $result;
        }

        // 处理下游服务返回错误码
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                "queryChainUser_exception",
                $ralRet['msg']
            );
            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_USER_CHECK_CHAIN_USER);
            throw new Utils_Exception(
                $msg,
                Const_Error::ERROR_USER_CHECK_CHAIN_USER
            );
            return $result;
        }

        return $ralRet['data'];
    }


    /**
     * 注册区块链账户
     * @param $uid
     * @param array $arrInput
     * @return array
     * @throws Utils_Exception
     */
    public function registerChainUser($uid, array $arrInput) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;
        $reqParams['strength'] = $arrInput['security_grade'];
        $reqParams['language'] = $arrInput['language'];
        $reqParams['version'] = 1;

        // ral服务请求
        $queryUrl = self::PATH_INFO_REGISTER_CHAIN_USER . http_build_query($reqParams);
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            $queryUrl,
            'get'
        );

        // ral访问异常
        $ralRet = json_decode($ralRet, true);
        if(!$ralRet) {
            As_Log_Lib::addNotice(
                "registerChainUser_call",
                "ral_false_error"
            );

            // 抛出异常
            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_USER_REGISTER_ERROR);
            throw new Utils_Exception(
                $msg,
                Const_Error::ERROR_USER_REGISTER_ERROR
            );
            return $result;
        }

        // 处理下游服务返回错误码
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                "registerChainUser_exception",
                $ralRet['msg']
            );
            // 抛出异常
            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_USER_REGISTER_ERROR);
            throw new Utils_Exception(
                $msg."_".$ralRet['code'],
                Const_Error::ERROR_USER_REGISTER_ERROR
            );
            return $result;
        }

        return $ralRet['data'];
    }

    /**
     * 获取我的资产信息
     * @param $uid
     * @param $arrInput
     * @return array
     * @throws Utils_Exception
     */
    public function getMyAsset($uid, $arrInput) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;
        $reqParams['ps'] = $arrInput['page_size'];
        $reqParams['pn'] = $arrInput['page_num'];

        // ral服务请求
        $queryUrl = self::PATH_INFO_QUERY_MY_ASSET . http_build_query($reqParams);
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            $queryUrl,
            'get'
        );

        // ral访问异常
        $ralRet = json_decode($ralRet, true);
        if(!$ralRet) {
            As_Log_Lib::addNotice(
                "getMyAsset_call",
                "ral_false_error"
            );
            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_GET_MYASSET_ERROR);
            throw new Utils_Exception(
                $msg,
                Const_Error::ERROR_GET_MYASSET_ERROR
            );
            return $result;
        }

        // 处理下游服务返回错误码
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                "getMyAsset_exception",
                $ralRet['msg']
            );
            $msg = Const_Error::getCodeMsg(Const_Error::ERROR_GET_MYASSET_ERROR);
            throw new Utils_Exception(
                $msg,
                Const_Error::ERROR_GET_MYASSET_ERROR
            );
            return $result;
        }

        return $ralRet['data'];
    }
}