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
    public static $ALLOW_USER_FIELDS = array(
        'uid',
        'displayname',
    );

    /**
     * 不参与客户端参数签名校验
     * @var array
     */
    public static $SIGN_FILTERS_ARR = array(
        'pu',
        'cct',
        'network',
        'ver'
    );

    protected $useInfo;

    public function __construct() {

        parent::__construct();

        // 是否开启sha1签名校验
        $this->isSignCheckOpen = true;

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

        // 校验签名的参数（非解析之后的参数）
        $checkInputParams = Utils_Params::getAllOriParams();

        //校验参数有效性
        if (!empty($this->arrValidate)) {
            As_Request_Validate::validate($this->arrValidate, $checkInputParams);
        }

        //参数签名及token校验
        if ($this->isSignCheckOpen) {

            As_Request_Sign::checkSha1Sign(
                $checkInputParams,
                Const_Common::SIGN_TOKEN,
                self::$SIGN_FILTERS_ARR
            );
        }
    }

    /**
     * 登录状态判断
     */
    protected function checkLogin() {

        if(empty($_COOKIE['BDUSS'])) {
            $this->useInfo = null;
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