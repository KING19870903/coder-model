<?php
/**
 * @name Main_Controller
 * @desc 主控制器,也是默认控制器
 * @author zhuminghai(zhuminghai@baidu.com)
 */
class Controller_Main extends Ap_Controller_Abstract {

	public $actions = array(

		'index' => 'actions/Index.php',     // 默认返回处理接口

        'home'  => 'actions/view/Home.php', // 区块链浏览器首页接口
	);
}
