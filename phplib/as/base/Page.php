<?php
/**
 * Page.php
 *
 * @description : 模块Action基层
 *
 * @author : zhaoxichao
 * @since : 19/06/2018
 */
class As_Base_Page {

    /**
     * @var array 参数过滤规则
     */
    protected $filterRule;

    /**
     * @var array 参数校验规则
     */
    protected $arrValidate;

    /**
     * @var array 输入信息
     */
    protected $arrInput;

    /**
     * @var array 输出信息
     */
    protected $arrOutput;

    /**
     * 接口是否开启签名验证
     */
    protected $isSignCheckOpen;

    public function __construct() {

        //默认关闭签名验证，若需要请在init开启
        $this->isSignCheckOpen = false;

        $this->arrOutput = array();
    }

    /**
     * 执行主函数
     * @return array
     */
    public function execute() {

        $this->init();

        $this->checkParam();

        $this->checkRequestLimit();

        $this->call();

        $this->afterCall();

        return $this->arrOutput;
    }

    /**
     * 预处理输入及数据准备
     */
    protected function init() {

        //参数过滤及格式化
        if(!empty($this->filterRule)) {

            if($this->isSignCheckOpen) {
                $this->filterRule['sign'] = 's';
            }

            $this->arrInput = As_Request_Params::filterInput($this->filterRule, $this->arrInput);
        }

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
            As_Request_Sign::checkSign($this->arrInput, As_Const_Common::SIGN_TOKEN);
        }
    }

    /**
     * 限制信息校验（暂时留空）
     */
    protected function checkRequestLimit() {
        // do something
    }

    /**
     * 逻辑处理主体
     */
    protected function call() {
        // do something
    }

    /**
     * 返回前处理（诸如日志打印、数据拼装等）
     */
    protected function afterCall() {
        // do something
    }

}