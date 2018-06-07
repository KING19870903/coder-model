<?php

/**
 * UserProtocol.php
 *
 * @description : 用户协议说明接口Action层
 *
 * @author : zhaoxichao
 * @since : 04/06/2018
 */
class Action_UserProtocol extends Base_Action {
    /**
     * call
     * @description : action处理逻辑入口
     *
     * @author zhaoxichao
     * @date 04/06/2018
     */
    public function call() {
        $objPageService = new Service_Page_View_UserProtocol();

        $arrRet = $objPageService->execute();

        //渲染模板
        $this->getView()->display(Const_Common::HELP_WORDS, $arrRet);
    }

    /**
     * output
     * @description : 输出用户协议说明HTML页面数据
     *
     * @param string $strOut 用户协议说明HTML页面数据
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function output($strOut = '') {

        //直接输出HTML页面数据
        echo $strOut;
    }
}