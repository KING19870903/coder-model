<?php

/**
 * UserProtocol.php
 *
 * @description : 用户协议页面
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
        //页面赋值
        $ret = array();

        //渲染模板
        $this->getView()->display(Const_Common::USER_PROTOCOL, $ret);
    }
}