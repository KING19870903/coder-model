<?php
/**
 * @name Api_Controller
 * @desc 主控制器,也是默认控制器
 * @author zhuminghai(zhuminghai@baidu.com)
 */
class Controller_Api extends Ap_Controller_Abstract {

	public $actions = array(

        'checklogin' => 'actions/api/CheckLogin.php',   // 校验登录状态

        'registerchainuser' => 'actions/api/RegisterChainUser.php', // 注册区块链账户
	);
}
