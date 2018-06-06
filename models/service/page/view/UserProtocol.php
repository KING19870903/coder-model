<?php

/**
 * UserProtocol.php
 *
 * @description : 用户协议说明接口Page层
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Service_Page_View_UserProtocol extends Base_Page {
    /**
     * @var null|Service_Data_UserProtocol Page层对象实例
     */
    private $objDataService = null;

    /**
     * Service_Page_View_UserProtocol constructor.
     */
    public function __construct() {

        // 关闭H5页面sha1签名校验
        $this->isSignCheckOpen = false;

        // 减少H5页面请求参数
        $this->arrValidate = array(

            'action' => array('notEmpty'),

            'ver' => array('notEmpty'),

            'platform_type' => array('notEmpty'),
        );

        //初始化Page层对象实例
        $this->objDataService = new Service_Data_UserProtocol();
    }

    /**
     * call
     * @description : 获取资管用户协议说明接口数据
     *
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function call() {

        $arrResult = $this->objDataService->getUserProtocolContent($this->arrInput);

        $this->arrOutput = $arrResult;
    }
}