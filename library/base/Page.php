<?php
/**
 * Page.php
 * page层基础类
 * @author zhuminghai
 * @since 2018/5/31
 */

class Base_Page extends As_Base_Page {

    /**
     * 可使用的pass用户信息
     * @var array
     */
    protected static $ALLOW_USER_FIELDS = array(
        'uid',
        'displayname',
    );

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

        // 参数预处理
        parent::init();

        // 初始化用户信息
        $this->checkLogin();
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
    protected function checkLogin() {

        if(empty($_COOKIE['BDUSS'])) {
            $this->useInfo = NULL;
        }
        $ret = Bd_Passport::checkUserLogin();
        if($ret) {
            $this->getAllowUserInfo($ret);
        }
    }

    /**
     * 获取可用的用户信息
     * @param array $oriPassUserInfo
     * @return bool
     */
    private function getAllowUserInfo(array $oriPassUserInfo) {

        // 获取可用用户信息
        foreach (self::$ALLOW_USER_FIELDS as $key) {
            $this->useInfo[$key] = $oriPassUserInfo[$key];
        }

        // 判断是否已登录
        $this->useInfo['isLogin'] = false;
        if(!empty($oriPassUserInfo['uid'])) {

            $this->useInfo['isLogin'] = true;

        }
        return true;
    }
}