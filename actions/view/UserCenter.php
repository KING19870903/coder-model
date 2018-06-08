<?php
/**
 * UserCenter.php
 * 用户我的首页接口
 * @author zhuminghai
 * @since 2018/6/7
 */

class Action_UserCenter extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {

        $objPageService = new Service_Page_View_UserCenter();

        $ret = $objPageService->execute();

        return $ret;
    }
}