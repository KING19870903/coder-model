<?php
/**
 * Route.php
 * 区块链浏览器路由管理
 * @author zhuminghai
 * @since 2018/5/31
 */

class Utils_Route implements Ap_Route_Interface
{
    /**
     * 路由规则解析入口，默认为main controller
     * @access public
     * @param  object  &$request
     * @return boolean
     */
    public function route(&$request) {
        $action = empty($_GET['action']) ? 'index' : strtolower(trim($_GET['action']));
        $request->setActionName($action);
        return true;
    }
}