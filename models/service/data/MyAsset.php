<?php
/**
 * MyAsset.php
 * 我的资产data数据层
 * @author zhuminghai
 * @since 2018/6/11
 */

class Service_Data_MyAsset {

    /**
     * 我的资产字段展示信息
     * @var array
     */
    private static $MY_ASSET_FIELDS = array(
        'name' => 'name',
        'name_cn' => 'nameCn',
        'symbol' => 'symbol',
        'icon' => 'icon',
        'precision' => 'precision',
        'dispay_amount' => 'dispayAmount',
    );

    private $daoObj;

    public function __construct() {

        $this->daoObj = new Dao_BlockChain();

    }

    /**
     * 我的资产信息获取
     * @param $uid
     * @param array $arrInput
     * @return array
     */
    public function getMyAsset($uid, array $arrInput) {

        $result = array();
        // 获取我的资产信息
        $assetData = $this->daoObj->getMyAsset($uid, $arrInput);
        if(empty($assetData)) {
            return $result;
        }

        // 处理字段适配为驼峰形式
        $bcList = array();
        foreach ($assetData['bclist'] as $key => $info) {
            $bcItem =array();
            foreach (self::$MY_ASSET_FIELDS as $oriKey => $retKey) {
                if(isset($info[$oriKey])) {
                    $bcItem[$retKey] = $info[$oriKey];
                }
            }
            $bcList[] = $bcItem;
        }

        // 格式化返回的我的资产数据
        $result['total'] = $assetData['total'];
        $result['bcList'] = $bcList;
        return $result;
    }
}