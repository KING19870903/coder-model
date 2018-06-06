<?php
/*=============================================================================
#     FileName: Template.php
#         Desc: 重写模版对象的方法,设置header,设置模版根目录,assign用户信息
#       Author: duteng
#        Email: duteng@baidu.com
#     HomePage: http://m.baidu.com/app
#      Version: 0.0.2
#   LastChange: 2012-10-30 18:51:41
#      History:
=============================================================================*/
class Freeapp_Template implements Ap_View_Interface {
	private $smarty = NULL;

	public function __construct() {
		$this->smarty = Bd_TplFactory::getInstance();
        $this->smarty->registerPlugin('modifier', 'getIcon', "As_Utils_Img::getIcon");
	}

	public function assign($name, $value = NULL) {
		return $this->smarty->assign($name, $value);
	}
	public function display($view, $arr_tpl = array(), $return = false, $header = NULL) {
		$this->_setUserInfo();
		if(is_array($header) && !empty($header)){
			foreach($header as $key => $value){
				header($key.':'.$value);
			}
		}
		$smarty = $this->smarty;
		if (is_array($data) && !isset($data['errors'])) {
			$data['errors'] = $this->errors;
		}
        // do common tpl var hook
		if (Ap_Registry::has('tplCommonVar') !== false) {
            $tplCommonVar = Ap_Registry::get('tplCommonVar');
            foreach ($tplCommonVar as $key => $val) {
                $this->smarty->assign($key, $val);
            }
        }
		foreach($arr_tpl as $key => $value){
			$smarty->assign($key,$value);
		}

		$output = str_replace(array(
			"\r\n",
			"\n",
			"\t",
			"  "
			), "", $smarty->fetch($view));
		if ($return) {
			return $output;
		}
		else {
			echo $output;
			return null;
		}
	}
	public function render($file, $context = NULL) {

	}

	public function setScriptPath($str){
		$templateDir = Bd_AppEnv::getEnv('template').'/';
        $this->smarty->setTemplateDir($templateDir);
        $this->smarty->addPluginsDir($templateDir.'plugin');
        $this->smarty->addConfigDir($templateDir.'config');
	}

	public function getScriptPath(){

	}

    public function register_modifier($name, $fun)
    {
        $this->smarty->register_modifier($name, $fun);
    }

    private function _setUserInfo()
    {
        $userInfo = Native_Utils::getPassInfo();
		if($userInfo['uid'] > 0 && $userInfo['status'] === 0){//判断是否登陆的条件
			$userInfo['uname'] = mb_convert_encoding($userInfo['uname'],'UTF-8','GBK');
			$this->smarty->assign('username', $userInfo['uname']);
			$this->smarty->assign('islogin','true');
			$this->smarty->assign('uid',$userInfo['uid']);
		}
    }
	public function setHeader() {

	}


}
