<?php

/**
 * TransactProperty.php
 *
 * @description : 资产交易记录及查询接口Page层
 *
 * @author : zhaoxichao
 * @since : 11/06/2018
 */
class Service_Page_View_TransactProperty extends Base_Page {
    /**
     * 默认分页大小
     */
    const PAGE_SIZE = 20;

    private $is_debug = true;

    /**
     * @var null|Service_Data_TransactProperty Data层对象实例
     */
    private $objDataService = null;

    /**
     * Service_Page_View_TransactProperty constructor.
     */
    public function __construct() {

        //开启签名校验并初始化参数校验规则
        parent::__construct();

        //重写参数校验规则
        $this->arrValidate = array(
            'action' => array('notEmpty'),
            'uid'    => array('notEmpty'),
            'sign'   => array('notEmpty'),
            'name'   => array('notEmpty'),
        );

        //初始化参数过滤规则
        $this->filterRule = array(
            'uid'  => 'i',
            'name' => 's',
            't_start' => 'i',
            't_end' => 'i',
            'type' => 'i',
            'ps' => 'i',
            'pn' => 'i',
            'bduss' => 's',
        );

        //实例化Page层
        $this->objDataService = new Service_Data_TransactProperty();
    }

    /**
     * call
     * @description : 资产交易记录及查询入口
     *
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function  call() {
        $arrRet = array();
        $arrRes = array();
        $arrResult = array();

        if (!$this->useInfo['isLogin']) {
            //用户未登录百度账号
            throw new Utils_Exception(
                Const_Error::$COMMON_ERROR_MSG[Const_Error::ERROR_BUDSS_NO_LOGIN_NO],
                Const_Error::ERROR_BUDSS_NO_LOGIN_NO
            );
        }

        $uid = intval($this->useInfo['uid']);

        //判断用户是否登录区块链账号
        $chainInfo = $this->objDataService->isChainUserExists($uid);
        if (!$chainInfo['address']) {
            //用户未登录区块链账号
            throw new Utils_Exception(
                Const_Error::$EXCEPTION_MSG[Const_Error::ERROR_CHAIN_NO_LOGIN_NO],
                Const_Error::ERROR_CHAIN_NO_LOGIN_NO
            );
        }

        //根据接口要求预处理参数
        $this->handleParams($this->arrInput);

        //查询交易记录数据
        $arrRet = $this->objDataService->getTransactPropertyData($uid, $this->arrInput);
        if (!$arrRet['total'] || !$arrRet['txlist'] || !is_array($arrRet['txlist'])) {
            //查询资产交易记录失败
            throw new Utils_Exception(
                Const_Error::$EXCEPTION_MSG[Const_Error::ERROR_EMPTY_QUERY_USER_CHAIN_LIST],
                Const_Error::ERROR_EMPTY_QUERY_USER_CHAIN_LIST
            );
        }

        //格式化输出数据
        foreach ($arrRet['txlist'] as $key => $value) {
            if (empty($value) || !is_array($value)) {
                continue;
            }
            $arrTmp['dataType'] = 5;
            $arrTmp['itemData'] = $value;
            $arrTmp['itemData']['nameCn'] = isset($value['name_cn']) ? trim($value['name_cn']) : '';
            $arrTmp['itemData']['diaplayAmount'] = isset($value['dispay_amount']) ? trim($value['dispay_amount']) : '';
            $arrTmp['itemData']['transType'] = isset($value['type']) ? trim($value['type']) : '';
            $arrTmp['itemData']['transTime'] = isset($value['timestamp']) ? date('m-d H:i', $value['timestamp']) : 0;

            unset($arrTmp['itemData']['name_cn']);
            unset($arrTmp['itemData']['dispay_amount']);
            unset($arrTmp['itemData']['timestamp']);
            unset($arrTmp['itemData']['type']);

            if ($this->is_debug) {
                for ($i = 0; $i < 10; $i++) {
                    $arrRes[$i] =  $arrTmp;
                }
            } else {
                $arrRes[] = $arrTmp;
            }
        }

        //判断是否具有下一页   hasNextPage  TODO
        $intOffset = ($this->arrInput['pn'] - 1) * self::PAGE_SIZE;
        $arrResult['hasNextPage'] = ($intOffset + self::PAGE_SIZE < count($arrRes)) ? true : false;

        $arrResult['data'] = array_slice($arrRes, $intOffset, self::PAGE_SIZE);


        $this->arrOutput = $arrResult;
    }

    /**
     * handleParams
     * @description : 根据接口要求预处理参数
     *
     * @param array $arrInput 请求参数
     * @throws Utils_Exception
     * @author zhaoxichao
     * @date 12/06/2018
     */
    private function handleParams($arrInput = array()) {

        //产生交易的时间范围--结束时间,默认接口访问的当前时间
        $arrInput['t_end'] = (isset($arrInput['t_end']) && $arrInput['t_end'] > 0)? $arrInput['t_end'] : time();

        //分页大小，取值范围大于等于1且小于等于50,默认取20
        $arrInput['ps'] = (isset($arrInput['ps']) && $arrInput['ps'] >= 1 && $arrInput['ps'] <= 50) ? $arrInput['ps'] : self::PAGE_SIZE ;

        //默认页码为1
        $arrInput['pn'] = (isset($arrInput['pn']) && $arrInput['pn'] >= 1) ? $arrInput['pn'] : 1;

        //比较起止时间
        if ($arrInput['t_start'] >= $arrInput['t_end']) {
            //查询交易起始时间大于交易结束时间
            throw new Utils_Exception(
                Const_Error::$EXCEPTION_MSG[Const_Error::ERROR_QUERY_TIME_RANGE],
                Const_Error::ERROR_QUERY_TIME_RANGE
            );
        }

        $this->arrInput = $arrInput;
    }

    /**
     * afterCall
     * @description : 返回层处理(日志打印,返回结果格式化)
     *
     * @throws Exception
     * @author zhaoxichao
     * @date king
     */
    public function afterCall() {
        if (empty($this->arrOutput)) {
            throw new Utils_Exception(
                As_Const_Error::$ERROR_MSG[As_Const_Error::ERROR_CANT_FIND_DATA],
                As_Const_Error::ERROR_CANT_FIND_DATA
            );
        }

        $this->arrOutput = Utils_Util::SuccessArray($this->arrOutput);
    }

}