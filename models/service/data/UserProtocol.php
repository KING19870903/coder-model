<?php

/**
 * UserProtocol.php
 *
 * @description : 用户协议页面接口Data层
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Service_Data_UserProtocol {

    /**
     * getUserProtocolContent
     * @description : 获取资管用户协议说明接口数据
     *
     * @param array $arrParams 客户端请求参数
     * @return array
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function getUserProtocolContent($arrParams = array()) {

        //初始化资管助记词ResourceIds
        $arrResourceIds = array(
            Const_Anxun::RESOURCE_USER_PROTOCOL
        );

        //通过RAL服务获取资管资源数据
        $arrRes = As_Dc_OamApi::getResourceInfo($arrResourceIds);

        $arrRet = isset($arrRes[Const_Anxun::RESOURCE_USER_PROTOCOL]) && !empty($arrRes[Const_Anxun::RESOURCE_USER_PROTOCOL]) ?  $arrRes[Const_Anxun::RESOURCE_USER_PROTOCOL] : array();
        if (empty($arrRet) || !is_array($arrRet)) {
            return array();
        }

        //过滤版本信息
        $arrRet = Utils_Util::getDataByVercode($arrRet, $arrParams);

        return $arrRet;
    }
}