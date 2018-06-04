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
        $homeConfig = Bd_Conf::getAppConf("homeConfig");

        // 我的应用卡片
        $textCard = Const_DataType::getDataTypeTextCard(
            Const_DataType::DATATYPE_TEXT,
            "我的应用"
        );
        $data[] = $textCard;

        // 我的应用
        foreach($homeConfig['myDapp'] as $pos => &$info) {
            $fParamInputArr = array();
            $fParamInputArr['pos'] = $pos;
            $info['fParam'] = Const_FParam::getFparam(
                Const_FParam::F_HOME_MYDAPP,
                $fParamInputArr
            );
        }
        $myDapp = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_MY_DAPP,
            $homeConfig['myDapp']
        );
        $data[] = $myDapp;

        // banner数据
        $homeConfig['banner']['fParam'] = Const_FParam::getFparam(Const_FParam::F_HOME_BANNER);
        $banner = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_HOME_BANNER,
            array($homeConfig['banner'])
        );
        $data[] = $banner;

        // 我的应用卡片
        $textCard = Const_DataType::getDataTypeTextCard(
            Const_DataType::DATATYPE_TEXT,
            "推荐应用"
        );
        $data[] = $textCard;

        // 推荐应用
        foreach($homeConfig['recDapp'] as $pos => &$info) {
            $fParamInputArr = array();
            $fParamInputArr['pos'] = $pos;
            $info['fParam'] = Const_FParam::getFparam(
                Const_FParam::F_HOME_RECOMMEND_DAPP,
                $fParamInputArr
            );
        }
        $recDapp = Const_DataType::getDataTypeAppInfoCard(
            Const_DataType::DATATYPE_HOEM_RECOMMEND_DAPP,
            $homeConfig['recDapp']
        );
        $data[] = $recDapp;

        // 返回数据拼装
        $result['hasNextPage'] = false;
        $result['data'] = $data;
        return $result;
    }

}