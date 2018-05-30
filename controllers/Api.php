<?php
/**
 * @name Api_Controller
 * @desc 主控制器,也是默认控制器
 * @author zhuminghai(zhuminghai@baidu.com)
 */
class Controller_Api extends Ap_Controller_Abstract {
	public $actions = array(
		'sample' => 'actions/api/Sample.php',
	);
}
