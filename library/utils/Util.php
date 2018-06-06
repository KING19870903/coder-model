<?php

/**
 * Util.php
 *
 * @description : xexplorer公共工具类
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Utils_Util {
    /**
     * getDataByVercode
     * @description : 获取对应版本用户协议(默认取最新版本协议)
     *
     * @param array $arrResult 资管用户协议配置数据
     * @param array $arrParams 客户端请求参数
     * @return array
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public static function getDataByVercode($arrResult = array(), $arrParams = array()) {
        $arrRet = array();

        $strVer = $arrParams['ver'];

        foreach ($arrResult as $key => $value) {
            if ($value['vercode'] == $strVer) {
                $arrRet['vercode'] = $value['vercode'];
                $arrRet['vername'] = $value['vername'];
                $arrRet['text'] = $value['text'];
                $arrRet['title'] = $value['title'];
            }
        }

        //默认取最新版本协议
        if (empty($arrRet)) {
            $arrRet['vercode'] = $arrResult[0]['vercode'];
            $arrRet['vername'] = $arrResult[0]['vername'];
            $arrRet['text'] = $arrResult[0]['text'];
            $arrRet['title'] = $arrResult[0]['title'];
        }

        return $arrRet;
    }
}