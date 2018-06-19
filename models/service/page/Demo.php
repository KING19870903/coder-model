<?php

/**
 * Demo.php
 *
 * @description :
 *
 * @author : zhaoxichao
 * @since : 19/06/2018
 */
class Service_Page_Demo extends Base_Page {
    /**
     * @var null Data层实例对象
     */
    private $objDataService = null;

    /**
     * Service_Page_Demo constructor.
     */
    public function __construct() {

        //开启sha1签名校验, 初始化参数校验规则, 初始化参数过滤规则
        parent::__construct();

        //实例化Data层对象
        $this->objDataService = new Service_Data_Demo();
    }

    /**
     * call
     * @description :
     *
     * @author zhaoxichao
     * @date 19/06/2018
     */
    public function call() {

        //调用Data层 处理业务逻辑,得出结果
        $arrRet = $this->objDataService->getData($this->arrInput);

        //初始化返回结果
        $this->arrOutput = $arrRet;
    }

    /**
     * afterCall
     * @description : 格式化Page层输出数据
     *
     * @author zhaoxichao
     * @date 19/06/2018
     */
    public function afterCall() {
        if (empty($this->arrOutput)) {
            $errno = As_Const_Error::ERROR_CANT_FIND_DATA;
            $errmsg = As_Const_Error::$ERROR_MSG[$errno];
            throw new Exception($errmsg, $errno);
        }

        $this->arrOutput = Utils_Util::SuccessArray($this->arrOutput);
    }

}