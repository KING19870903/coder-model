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

    // 首页推荐应用卡片类型
    const DATATYPE_HOEM_RECOMMEND_DAPP = 4;

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
     * 获取卡片类型对应卡片数据
     * @param $dataType
     * @param array $itemData
     * @return array
     */
    public static function getDataTypeAppInfoCard($dataType, array $itemData){

        $dataCard = array();

        $dataCard['dataType'] = $dataType;

        $dataCard['itemData']['appInfo'] = $itemData;

        return $dataCard;

    }
}