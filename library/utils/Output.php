<?php
/**
 * Output.php
 * 输出统一出口处理类
 * @author zhuminghai
 * @since 2018/5/31
 */

class Utils_Output {

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


    /**
     * 失败结果输出
     * @param $errno
     * @param $msg
     * @param array $data
     * @return array
     */
    public static function FailArray($errno, $msg, $data = array()) {

        $result = array(
            'error_no' => $errno,
            'message' => $msg,
            'result' => $data,
        );
        return $result;

    }


}