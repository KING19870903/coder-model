<?php
/**
 * ProcessParams.php
 * 客户端请求参数统一处理插件
 * @author zhuminghai
 * @since 2018/5/31
 */
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