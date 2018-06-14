<?php

/**
 * HelpWords.php
 *
 * @description : 助记词说明接口Data层
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Service_Data_HelpWords {

    /**
     * getHelpWordsContent
     * @description : 获取资管助记词说明接口数据
     *
     * @param array $arrParams 客户端请求参数
     * @return array
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function getHelpWordsContent($arrParams = array()) {

        //初始化资管助记词ResourceIds
        $arrResourceIds = array(
            Const_Anxun::RESOURCE_HELP_WORDS
        );

        //通过RAL服务获取资管资源数据
        $arrRes = As_Dc_OamApi::getResourceInfo($arrResourceIds);

        $arrRet = isset($arrRes[Const_Anxun::RESOURCE_HELP_WORDS]) && !empty($arrRes[Const_Anxun::RESOURCE_HELP_WORDS]) ?  $arrRes[Const_Anxun::RESOURCE_HELP_WORDS] : array();
        if (empty($arrRet) || !is_array($arrRet)) {
            return array();
        }

        //过滤版本信息
        $arrRet = Utils_Util::getDataByVercode($arrRet, $arrParams);

        return $arrRet;
    }
}