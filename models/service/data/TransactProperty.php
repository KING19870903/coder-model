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
     * 我的资产交易展示信息
     * @var array
     */
    private static $MY_ASSET_TRANSACT_FIELDS = array(
        'name'          => 'name',
        'symbol'        => 'symbol',
        'icon'          => 'icon',
        'amount'        => 'amount',
        'precision'     => 'precision',
        'name_cn'       => 'nameCn',
        'dispay_amount' => 'dispayAmount',
        'type'          => 'transType',
        'timestamp'     => 'transTime',
    );

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
     * @date 14/06/2018
     */
    public function getTransactPropertyData($uid, $arrInput = array()) {
        $arrResult = array();

        // 查询交易记录
        $arrRes = $this->objDao->queryTransactPropertyData($uid, $arrInput);
        if (empty($arrRes['total']) || empty($arrRes['txlist']) ) {
            //查询资产交易记录为空
            return $arrResult;
        }

        $arrRetList = array();
        //格式化输出数据
        foreach ($arrRes['txlist'] as $key => $value) {
            $arrRet = array();
            if (empty($value) || !is_array($value)) {
                continue;
            }

            // 格式化下发数据
            foreach (self::$MY_ASSET_TRANSACT_FIELDS as $oriKey => $retKey) {
                if(isset($value[$oriKey])) {
                    if ('timestamp' === $oriKey) {
                        $arrRet[$retKey] = date('m-d H:i', $value[$oriKey]);
                        continue;
                    }
                    $arrRet[$retKey] = $value[$oriKey];
                }
            }

            // 添加f参数
            $fParamInput = array();
            $fParamInput[] = $value['name'];
            $arrRet['fParam'] = Const_FParam::getFparam(Const_FParam::F_MYASSET_TRANSACT_LIST, $fParamInput);

            // 拼接端上返回卡片样式
            $arrRet = Const_DataType::getDataTypeCard(
                Const_DataType::DATATYPE_MYASSET_TRANSACT_LIST,
                $arrRet
            );

            $arrRetList[] = $arrRet;
        }

        //判断是否具有下一页
        $arrResult['hasNextPage'] = false;
        if($arrRes['total'] > $arrInput['page_size'] * $arrInput['page_num']) {
            $arrResult['hasNextPage'] = true;
        }

        $arrResult['data'] = $arrRetList;

        return $arrResult;
    }
}