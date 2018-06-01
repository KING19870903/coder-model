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

    // 我的应用卡片类型
    const DATATYPE_MY_DAPP = 1;

    // 首页banner卡片类型
    const DATATYPE_HOME_BANNER = 2;

    // 首页推荐应用卡片类型
    const DATATYPE_HOEM_RECOMMEND_DAPP = 3;

    /**
     * 我的资产卡片
     */


    /**
     * 个人中心卡片
     */

    /**
     * 获取卡片类型对应卡片数据
     * @param $dataType
     * @param array $itemData
     * @return array
     */
    public static function getDataTypeCard($dataType, array $itemData){

        $dataCard = array();

        $dataCard['dataType'] = $dataType;

        $dataCard['itemData'] = $itemData;

        return $dataCard;

    }

}