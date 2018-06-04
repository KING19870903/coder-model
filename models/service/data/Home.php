<?php
/**
 * Home.php
 * 首页数据获取data层
 * @author zhuminghai
 * @since 2018/5/31
 */
class Service_Data_Home {

    /**
     * 获取区块链home数据
     * @param array $arrInput
     * @return mixed
     */
    public function getHomeInfo(array $arrInput) {

        $result = $data = array();

        // 我的应用卡片
        $textCard = Const_DataType::getDataTypeTextCard(
            Const_DataType::DATATYPE_TEXT,
            "我的应用"
        );
        $data[] = $textCard;

        // 资管信息获取
        $resourceIds = array(
            Const_Anxun::RESOURCE_MYDAPP,
            Const_Anxun::RESOURCE_BANNER,
            Const_Anxun::RESOURCE_RECDAPP,
        );
        $oamRet = As_Dc_OamApi::getResourceInfo($resourceIds);
        if (empty($oamRet) || !is_array($oamRet)) {
            return array();
        }

        // 我的应用
        $retMyDapp = array();
        $myDappConfig = $oamRet[Const_Anxun::RESOURCE_MYDAPP];
        if(empty($myDappConfig)) {
            $myDappConfig = $this->getDefaultConfig(Const_Anxun::RESOURCE_MYDAPP);
        }
        foreach($myDappConfig as $pos => $info) {
            $itemData = array();
            $itemData = $this->getOutputItemData($info);
            $fParamInputArr = array();
            $fParamInputArr['pos'] = $pos;
            $itemData['fParam'] = Const_FParam::getFparam(
                Const_FParam::F_HOME_MYDAPP,
                $fParamInputArr
            );
            $retMyDapp[] = $itemData;
        }
        $myDapp = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_MY_DAPP,
            $retMyDapp
        );
        $data[] = $myDapp;


        // banner数据
        $retBanner = array();
        $bannerConfig = $oamRet[Const_Anxun::RESOURCE_BANNER];
        if(empty($bannerConfig)) {
            $bannerConfig = $this->getDefaultConfig(Const_Anxun::RESOURCE_BANNER);
        }
        foreach ($bannerConfig as $info) {
            $itemData = array();
            $itemData = $this->getOutputItemData($info);
            $itemData['fParam'] = Const_FParam::getFparam(Const_FParam::F_HOME_BANNER);
            $retBanner[] = $itemData;
        }
        $banner = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_HOME_BANNER,
            $retBanner
        );
        $data[] = $banner;

        // 推荐应用卡片
        $textCard = Const_DataType::getDataTypeTextCard(
            Const_DataType::DATATYPE_TEXT,
            "推荐应用"
        );
        $data[] = $textCard;

        // 推荐应用
        $retRecDapp = array();
        $recDappConfig = $oamRet[Const_Anxun::RESOURCE_RECDAPP];
        if(empty($recDappConfig)) {
            $recDappConfig = $this->getDefaultConfig(Const_Anxun::RESOURCE_RECDAPP);
        }
        foreach($recDappConfig as $pos => $info) {
            $itemData = array();
            $itemData = $this->getOutputItemData($info);
            $fParamInputArr = array();
            $fParamInputArr['pos'] = $pos;
            $itemData['fParam'] = Const_FParam::getFparam(
                Const_FParam::F_HOME_RECOMMEND_DAPP,
                $fParamInputArr
            );
            $retRecDapp[] = $itemData;
        }
        $recDapp = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_HOEM_RECOMMEND_DAPP,
            $retRecDapp
        );
        $data[] = $recDapp;

        // 返回数据拼装
        $result['hasNextPage'] = false;
        $result['data'] = $data;
        return $result;
    }


    /**
     * 获取输出的item数据
     * @param array $info
     * @param $jumpType
     * @return array
     */
    private function getOutputItemData(array $info, $jumpType) {

        $itemData = array();
        $itemData['name'] = $info['name'];
        $itemData['icon2x'] = $info['icon'];
        $itemData['icon3x'] = !empty($info['highticon']) ? $info['highticon'] : "";
        $itemData['jumpUrl'] = $info['url'];
        $itemData['jumpType'] = $info['urltype'];

        return $itemData;
    }

    /**
     * 容错处理，获取默认配置信息
     * @param $configKey
     * @return array
     */
    private function getDefaultConfig($configKey){
        $homeConfig = Bd_Conf::getAppConf("homeConfig");
        if(isset($homeConfig[$configKey])) {
            return $homeConfig[$configKey];
        } else {
            return array();
        }
    }
}