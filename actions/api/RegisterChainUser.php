<?php
/**
 * RegisterChainUser.php
 * 注册创建区块链账户，需要传入如下信息：
 *     （1）助记词强度，1：低，2：中，3：高
 *     （2）语言种类，1：中文，2：英文
 * 返回信息如下：
 *     （1）助记词
 *     （2）用户地址（区块链的）
 * @author zhuminghai
 * @since 2018/6/5
 */

class Action_RegisterChainUser extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {

        $objPageService = new Service_Page_Api_RegisterChainUser();

        $ret = $objPageService->execute();

        return $ret;

    }
}