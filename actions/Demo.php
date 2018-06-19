<?php

/**
 * Demo.php
 *
 * @description :
 *
 * @author : zhaoxichao
 * @since : 19/06/2018
 */
class Action_Demo extends Base_Action {
    /**
     * call
     * @description : Action入口调用函数
     *
     * @author zhaoxichao
     * @date 19/06/2018
     */
    public function call() {

        $objPageService = new Service_Page_Demo();

        $arrRet = $objPageService->execute();

        //返回结果供output()函数处理
        return $arrRet;
    }
}