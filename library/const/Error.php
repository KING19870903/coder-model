<?php
/**
 * Error.php
 * 错误码常量定义
 * @author zhuminghai
 * @since 2018/6/7
 */

class Const_Error extends As_Const_Exception{

    // 错误码前缀 --- xexplorer使用该前缀
    const EXCEPTION_CODE_PREFIX = 200;

    // 用户未登录
    const ERROR_USER_NOT_LOGIN   = 2000;

    //异常提示信息
    public static $EXCEPTION_MSG = array(

        self::ERROR_USER_NOT_LOGIN => '用户未登录',

    );

    /**
     * 获取错误码对应异常信息
     * @param $code
     * @return array
     */
    public static function getErrorInfo($code) {
        $errorInfo = array();
        $errorInfo['code'] = self::getErrCode($code);
        $errorInfo['msg']  = self::getCodeMsg($code);
        return $errorInfo;
    }

    /**
     * 获取异常码对应的提示信息
     * @param $code
     * @return mixed|string
     */
    public static function getCodeMsg($code) {

        // 获取通用异常错误码对应msg信息
        $message = self::getCommonCodeMsg($code);
        if(!empty($message)){
            return $message;
        }

        // 获取对应模块错误码对应msg信息
        if(isset(self::$EXCEPTION_MSG[$code])) {
            return self::$EXCEPTION_MSG[$code];
        }
        return '';
    }

    /**
     * 返回统一的错误码
     * @param $code
     * @return string
     */
    public static function getErrCode($code) {

        return self::EXCEPTION_CODE_PREFIX . $code;

    }

}