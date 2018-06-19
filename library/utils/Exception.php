<?php


class Utils_Exception extends  As_Exception_BaseNew {

    // xexplorer 服务异常码前缀
    const EXCEPTION_CODE_PREFIX = 200;

    /**
     * constructor
     * @param
     * @return
     */
    public function __construct($message, $code, $errBody = null) {

        $code = self::EXCEPTION_CODE_PREFIX . $code;

        parent::__construct($message, $code, $errBody);
    }

}