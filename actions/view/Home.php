<?php
/**
 * Home.php
 * 区块链浏览器首页接口，输出如下数据：
 *  （1）我的应用
 *  （2）banner推广信息
 *  （3）推荐应用
 * @author zhuminghai
 * @since 2018/5/31
 */
class Action_Home extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {

        $objPageService = new Service_Page_View_Home();

        $ret = $objPageService->execute();

        return $ret;
    }
}