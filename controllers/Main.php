<?php
/**
 * @name Main_Controller
 * @desc 主控制器,也是默认控制器
 * @author zhuminghai(zhuminghai@baidu.com)
 */
class Controller_Main extends Ap_Controller_Abstract {

	public $actions = array(

		'index' => 'actions/Index.php',  // 默认返回处理接口

        'home'  => 'actions/view/Home.php', // 区块链浏览器首页接口

        'helpwords'    =>   'actions/view/HelpWords.php',       //助记词说明

        'userprotocol' =>   'actions/view/UserProtocol.php',    //用户协议页面

        'usercenter'   =>   'actions/view/UserCenter.php',      //我的页面

	);
}
