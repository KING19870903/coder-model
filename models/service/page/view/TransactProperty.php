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
     * @var null|Service_Data_TransactProperty Data层对象实例
     */
    private $objDataService = null;

    /**
     * Service_Page_View_TransactProperty constructor.
     */
    public function __construct() {

        //开启签名校验并初始化参数校验规则
        parent::__construct();

        //添加参数校验规则
        $this->arrValidate['name'] = array('notEmpty');


        //初始化参数过滤规则
        $this->filterRule = array(
            'bduss' => 's',
            'name' => 's',
            'trans_type' => 'i',
            'time_start' => 'i',
            'time_end' => 'i',
            'ps' => 'i',
            'pn' => 'i',
        );

        //实例化Page层
        $this->objDataService = new Service_Data_TransactProperty();
    }

    /**
     * call
     * @description : 资产交易记录及查询入口
     *
     * @author zhaoxichao
     * @date 14/06/2018
     */
    public function  call() {
        $arrRet = array();

        if (!$this->useInfo['isLogin']) {
            //用户未登录百度账号
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_USER_NOT_LOGIN);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        $uid = intval($this->useInfo['uid']);

        //判断用户是否登录区块链账号
        $chainInfo = $this->objDataService->isChainUserExists($uid);
        if (!$chainInfo['address']) {
            //用户未登录区块链账号
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_USER_NOT_CHAIN_USER);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        //根据接口要求预处理参数
        $this->handleParams($this->arrInput);

        //查询交易记录数据
        $arrRet = $this->objDataService->getTransactPropertyData($uid, $this->arrInput);

        $this->arrOutput = Utils_Output::SuccessArray($arrRet);
    }

    /**
     * handleParams
     * @description : 根据数据端接口要求预处理参数
     *
     * @param array $arrInput 请求参数
     * @author zhaoxichao
     * @date 14/06/2018
     */
    private function handleParams($arrInput = array()) {

        //产生交易的时间范围--结束时间,默认接口访问的当前时间
        $arrInput['time_end'] = (isset($arrInput['time_end']) && $arrInput['time_end'] > 0)? $arrInput['time_end'] : time();

        //分页大小，取值范围大于等于1且小于等于50,默认取20
        $arrInput['page_size'] = (isset($arrInput['page_size']) && $arrInput['page_size'] >= 1 && $arrInput['page_size'] <= 50) ? $arrInput['page_size'] : Const_Common::DEFAULT_PAGE_SIZE;

        //默认页码为1
        $arrInput['page_num'] = (isset($arrInput['page_num']) && $arrInput['page_num'] >= 1) ? $arrInput['page_num'] : Const_Common::DEFAULT_PAGE_NUM;

        //比较起止时间
        if ($arrInput['time_start'] >= $arrInput['time_end']) {
            //查询交易起始时间大于交易结束时间
            $errInfo = Const_Error::getErrorInfo(Const_Error::ERROR_QUERY_TIME_RANGE);
            $this->arrOutput = Utils_Output::FailArray($errInfo['code'], $errInfo['msg']);
            return;
        }

        $this->arrInput = $arrInput;
    }
}