<?php
/**
 * Route.php
 * 区块链浏览器路由管理
 * @author zhuminghai
 * @since 2018/5/31
 */

class Utils_Route implements Ap_Route_Interface {

    /**
     * action 到controller的映射
     * 若未设置则使用默认的main控制器
     * @var array
     */
    private static $ACTION_TO_CONTROLLER = array(

        'checklogin' => 'api',

        'registerchainuser' => 'api',

    );

    /**
     * 路由规则解析入口，默认为main controller
     * @access public
     * @param  object &$request
     * @return boolean
     */
    public function route(&$request) {
        $action = empty($_GET['action']) ? 'index' : strtolower(trim($_GET['action']));

        // 若有action->controller映射，按照映射处理
        if (isset(self::$ACTION_TO_CONTROLLER[$action])) {
            $request->setControllerName('Api');
        }
        $request->setActionName($action);
        return true;
    }
}