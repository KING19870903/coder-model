<?php

class Controller_Api extends Ap_Controller_Abstract {

	public $actions = array(

        'checklogin' => 'actions/api/CheckLogin.php',   // 校验登录状态

        'registerchainuser' => 'actions/api/RegisterChainUser.php', // 注册区块链账户
	);
}
