<?php
/**
 * DataType.php
 * 区块链浏览器卡片类型
 * @author zhuminghai
 * @since 2018/6/1
 */

class Const_DataType {

    /**
     * 首页卡片
     */

    // 文本提示卡片类型
    const DATATYPE_TEXT = 1;

    // 我的应用卡片类型
    const DATATYPE_MY_DAPP = 2;

    // 首页banner卡片类型
    const DATATYPE_HOME_BANNER = 3;

    // 我的资产列表页项卡片类型
    const DATATYPE_MYASSET_ITEM = 4;

    // 我的资产交易记录卡片类型
    const DATATYPE_MYASSET_TRANSACT_LIST = 5;

    /**
     * 我的资产卡片
     */


    /**
     * 个人中心卡片
     */


    /**
     * 获取文本提示卡片类型
     * @param $dataType
     * @param $text
     * @return array
     */
    public static function getDataTypeTextCard($dataType, $text) {

        $dataCard = array();

        $dataCard['dataType'] = $dataType;

        $dataCard['itemData']['text'] = $text;

        return $dataCard;
    }

    /**
     * 获取多个卡片对应卡片数据
     * @param $dataType
     * @param array $itemData
     * @return array
     */
    public static function getDataTypeAppInfoCard($dataType, array $itemData){

        $dataCard = array();

        $dataCard['dataType'] = $dataType;

        $dataCard['itemData']['appInfos'] = $itemData;

        return $dataCard;

    }

    /**
     * 获取普通卡片信息
     * @param $dataType
     * @param array $itemData
     * @return array
     */
    public static function getDataTypeCard($dataType, array $itemData) {

        $dataCard = array();

        $dataCard['dataType'] = $dataType;

        $dataCard['itemData'] = $itemData;

        return $dataCard;

    }
}