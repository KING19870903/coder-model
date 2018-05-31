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


}