<?php

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
        'action',
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

            'country' => array('notEmpty'),

            'fParam' => array('notEmpty'),

            'sign' => array('notEmpty'),
        );
    }

    /**
     * init
     * @description : 初始化操作
     *
     * @author zhaoxichao
     * @date 19/06/2018
     */
    public function init() {

        //获取请求参数
        $this->arrInput = Utils_Params::getAllParams();

        // 参数预处理(参数过滤,参数类型转换,参数默认值设置)
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

        // 判断是否有登录用户信息
        if(empty($this->arrInput['bduss'])) {
            $this->useInfo = null;
            return;
        }

        // 获取用户登录信息
        $ret = Bd_Passport::checkUserLogin($this->arrInput['bduss'], 1, 1, 0, 1, 1);

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
            if($key == 'displayname') {
                $this->useInfo[$key] = iconv(
                    'gbk',
                    'utf-8',
                    $oriPassUserInfo['displayname']
                );
                continue;
            }
            $this->useInfo[$key] = $oriPassUserInfo[$key];
        }

        // 判断是否已登录
        $this->useInfo['isLogin'] = 0;
        if(!empty($oriPassUserInfo['uid'])) {
            $this->useInfo['isLogin'] = 1;
        }
        return true;
    }
}