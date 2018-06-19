<?php

class Plugin_ProcessParams extends Ap_Plugin_Abstract
{

    /**
     * 路由解析前钩子
     *
     * @access public
     * @param  Ap_Request_Abstract  $request
     * @param  Ap_Response_Abstract $response
     */
    public function routerStartup(Ap_Request_Abstract $request, Ap_Response_Abstract $response) {

        // 请求参数处理
        Utils_Params::initParams();
    }
}