<?php
/**
 * Page.php
 * page层基础类
 * @author zhuminghai
 * @since 2018/5/31
 */

class Base_Page extends As_Base_Page {

    protected $useInfo;

    public function __construct() {

        parent::__construct();

        // 是否开启sha1签名校验
        $this->isSignCheckOpen = false;

        // 参数校验规则
        $this->arrValidate = array(

            'action' => array('notEmpty'),

            'usertype' => array('notEmpty'),

            'uid' => array('notEmpty'),

            'platform_type' => array('notEmpty'),

            'platform_version_id' => array('notEmpty'),

            'pu' => array('notEmpty'),

            'network' => array('notEmpty'),

            'from' => array('notEmpty'),

            'ver' => array('notEmpty'),

            'ver' => array('notEmpty'),

            'country' => array('notEmpty'),

            'f' => array('notEmpty'),

            'sign' => array('notEmpty'),
        );
    }

    /**
     * 信息初始化
     */
    public function init() {

        $this->arrInput = Utils_Params::getAllParams();

        parent::init();
    }

    /**
     * 参数信息校验
     */
    protected function checkParam() {

        //校验参数有效性
        if (!empty($this->arrValidate)) {
            As_Request_Validate::validate($this->arrValidate, $this->arrInput);
        }

        //参数签名及token校验
        if ($this->isSignCheckOpen) {
            As_Request_Sign::checkSha1Sign($this->arrInput, Const_Common::SIGN_TOKEN);
        }
    }

    /**
     * 登录状态判断
     */
    public function checkLogin() {

        // 待补充完善
    }
}