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

        // bduss解密预处理
        $ecryptBduss = !empty($_POST['bduss']) ? $_POST['bduss'] : $_GET['bduss'];
        if(!empty($ecryptBduss)) {
            $_POST['bduss']  = As_Request_Params::decryptBduss($ecryptBduss);
        }
//        if($_GET['action'] == 'checklogin') {
//            $_POST['bduss'] = 'ZveXlJajZ0M21VeWVvclZEdGxTZzktRVR0OGY2akdQZHRkRlpPOVBkRGltajFiQVFBQUFBJCQAAAAAAAAAAAEAAADCvAyVemh1bWluZ2hhaQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOINFlviDRZbUF';
//        }

        // 请求参数处理
        Utils_Params::initParams();
    }
}