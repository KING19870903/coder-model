<?php

class Bootstrap extends Ap_Bootstrap_Abstract{
	public function _initRoute(Ap_Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用static路由
        $router = Ap_Dispatcher::getInstance()->getRouter();
        $route  = new Utils_Route();
        $router->addRoute('xexplorerRoute', $route);
	}
	
	public function _initPlugin(Ap_Dispatcher $dispatcher) {
        //注册saf插件
        $objPlugin = new Saf_ApUserPlugin();
        $dispatcher->registerPlugin($objPlugin);

        // 请求参数处理
        $objProcessParams = new Plugin_ProcessParams();
        $dispatcher->registerPlugin($objProcessParams);
    }
	
	public function _initView(Ap_Dispatcher $dispatcher){
		//在这里注册自己的view控制器，例如smarty,firekylin
		$objtemplate = new Utils_Template();    	
		$objtemplate->setScriptPath('template');
		$dispatcher->setView($objtemplate);     
		$dispatcher->disableView();//禁止ap自动渲染模板
	}
	
    public function _initDefaultName(Ap_Dispatcher $dispatcher) {
		//设置路由默认信息
		$dispatcher->setDefaultModule('Main')
		           ->setDefaultController('Main');
	}
}
