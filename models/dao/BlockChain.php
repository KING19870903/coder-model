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

    // 查询用户的交易列表
    const PATH_INFO_QUERY_USER_TRANSACT_LIST = '/exp/api/wallet/tx/list?';

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
        $queryUrl = self::PATH_INFO_CHECK_USER_EXISTS . http_build_query($reqParams);
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            $queryUrl,
            'get'
        );

        $ralRet = json_decode($ralRet, true);
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
            return $result;
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
            return $result;
        }

        // 服务处理错误
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                $ralRet['msg']
            );
            $result['isHaveRegister'] = true;
            return $result;
        }

        $ralRet['data']['isHaveRegister'] = false;
        return $ralRet['data'];
    }

    /**
     * 获取我的资产信息
     * @param $uid
     * @param $arrInput
     * @return array
     */
    public function getMyAsset($uid, $arrInput) {

        $result = array();

        // 拼装参数
        $reqParams = array();
        $reqParams['uid'] = $uid;
        $reqParams['ps'] = !empty($arrInput['page_size']) ? $arrInput['page_size'] : Const_Common::DEFAULT_PAGE_SIZE ;
        $reqParams['pn'] = !empty($arrInput['page_num']) ? $arrInput['page_num'] : Const_Common::DEFAULT_PAGE_NUM;

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
            return $result;
        }

        // 服务处理错误
        if($ralRet && $ralRet['code'] != 0) {
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                $ralRet['msg']
            );
            return $result;
        }

        return $ralRet['data'];
    }

    /**
     * queryTransactPropertyData
     * @description : 资产交易记录及查询接口
     *
     * @param       $uid 百度passport id
     * @param array $arrInput 请求参数
     * @return array
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function queryTransactPropertyData($uid, $arrInput = array()) {
        $arrRet = array();
        $reqParams = array();

        // 拼装参数
        $reqParams['uid'] = $uid;                           //百度passport id
        $reqParams['name'] = $arrInput['name'];             //区块链名称
        $reqParams['t_start'] = $arrInput['time_start'];    //产生交易的起始时间
        $reqParams['t_end'] = $arrInput['time_end'];        //产生交易的结束时间
        $reqParams['type'] = $arrInput['trans_type'];       //交易类型；0：不区分交易类型；1:转入交易   2:转出交易；默认0
        $reqParams['ps'] = $arrInput['page_size'];                 //分页大小
        $reqParams['pn'] = $arrInput['page_num'];                 //分页页码

        // ral服务请求
        $queryUrl = self::PATH_INFO_QUERY_USER_TRANSACT_LIST . http_build_query($reqParams);
        $ralRet = As_Base_RalBase::ralCall(
            self::SERVICE_NAME,
            $queryUrl,
            'get'
        );

        // ral访问异常
        $ralRet = json_decode($ralRet, true);
        if(!$ralRet) {
            //解析数据失败
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                'json_decode解析数据失败'
            );
            return $arrRet;
        }

        // 服务处理错误
        if($ralRet && $ralRet['code'] != 0) {
            //服务处理错误
            As_Log_Lib::addNotice(
                self::SERVICE_NAME."_exception",
                $ralRet['msg']
            );
            return $arrRet;
        }

        return $ralRet['data'];
    }
}