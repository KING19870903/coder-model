<?php
/**
 * MyAsset.php
 * 我的资产接口
 * @author zhuminghai
 * @since 2018/6/11
 */
class Action_MyAsset extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {

        $objPageService = new Service_Page_View_MyAsset();

        $ret = $objPageService->execute();

        return $ret;
    }
}
