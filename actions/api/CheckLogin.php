<?php
/**
 * CheckLogin.php
 * 校验登录状态
 * （1）客户端传入bduss，服务端校验是否为登录态
 * （2）passport校验用户为登录态的，再判断用户是否是区块链账户
 * @author zhuminghai
 * @since 2018/6/5
 */
class Action_CheckLogin extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {

        $objPageService = new Service_Page_Api_CheckLogin();

        $ret = $objPageService->execute();

        return $ret;

    }
}