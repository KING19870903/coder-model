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
        $curVer = intval($arrParams['ver']);

        //对版本号从小到大排序
        usort($arrResult, function ($a, $b) {
            return intval(trim($a['vercode'])) > intval(trim($b['vercode']));
        });

        //筛选请求参数的版本
        $arr = array_filter($arrResult, function ($a) use ($curVer) {
            return intval(trim($a['vercode'])) == intval(trim($curVer));
        });

        //如果没有在版本列表中匹配到请求参数的版本，则选取比请求版本小的版本中最近的一个版本
        if (!empty($arr)) {
            $result = array_values($arr)[0];
        } else {
            $arrSmallVer = array_filter($arrResult, function ($a) use ($curVer) {
                return intval(trim($a['vercode'])) < $curVer;
            });

            //对版本号从大到小排序
            usort($arrSmallVer,function ($a,$b){
                return intval(trim($a['vercode']))<intval(trim($b['vercode']));
            });

            $result = $arrSmallVer[0];
        }

        // 过滤非必需字段
        if (!empty($result)) {
            $arrRet['vercode'] = $result['vercode'];
            $arrRet['vername'] = $result['vername'];
            $arrRet['text'] = $result['text'];
            $arrRet['title'] = $result['title'];
        } else {
            // 兜底版本
            $arrRet['vercode'] = $arrResult[0]['vercode'];
            $arrRet['vername'] = $arrResult[0]['vername'];
            $arrRet['text'] = $arrResult[0]['text'];
            $arrRet['title'] = $arrResult[0]['title'];
        }

        return $arrRet;
    }

    /**
     * jsonPackGzip
     * @description : 数组转成json并且gzip压缩
     *
     * @param        $arrOutput   输出数据
     * @param string $pageTagExt  page标签
     * @author zhaoxichao
     * @date 23/03/2018
     */
    public static function jsonPackGzip($arrOutput, $pageTagExt = '') {
        if (isset($_GET['qa']) && $_GET['qa'] == 'test') {
            echo json_encode($arrOutput);
            return;
        }

        As_Request_Output::jsonPackGzip($arrOutput);
    }

    /**
     * 成功结果输出
     * @param $data array
     * @param $msg string
     * @return array
     */
    public static function SuccessArray($data = array(), $msg = '') {

        $result = array(
            'error_no' => 0,
            'message' => $msg,
            'result' => $data,
        );

        return $result;
    }
}