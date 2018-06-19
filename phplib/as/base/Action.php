<?php
/**
 * Action.php
 *
 * @description : 模块Action基层
 *
 * @author : zhaoxichao
 * @since : 19/06/2018
 */
class As_Base_Action extends Ap_Action_Abstract {

    /**
     * @var string 状态码键
     */
    protected $statusKey;

    /**
     * @var string 提示信息键
     */
    protected $msgKey;

    /**
     * @var string 输出信息键
     */
    protected $resultKey;

    /**
     * @var bool 输出是否需要做gzip压缩
     */
    protected $needGzip;

    /**
     * @var array 输入数据
     */
    protected $arrInput;

    /**
     * action执行入口
     */
    public function execute() {
        try {

            $this->init();

            $result = $this->call();

            $this->output($result);

        } catch (Exception $e) {
            //获取异常信息
            $code = $e->getcode();
            $msg  = $e->getMessage();

            //组合异常返回结果
            $result = array(
                $this->statusKey   => $code,
                $this->msgKey      => $msg,
                $this->resultKey   => array(),
            );

            //输出结果
            $this->output($result);

            // 打印warning错误日志
            Bd_Log::warning("status[" . $code . "] message[" . $msg . "]");
        }
    }

    /**
     * 初始化输入参数及预处理
     */
    public function init() {
        // do something
    }

    /**
     * action处理主函数，调用page层获取数据
     */
    protected function call() {
        // do something
    }

    /**
     * 组织输出数据
     *（若输出有特殊化处理，请在子类覆盖方法）
     *
     * @param array $result
     */
    protected function output(array $result) {

        if (!$this->needGzip) {
            //echo json
            echo json_encode($result);
        } else {
            //echo json & gzip
            As_Request_Output::jsonPackGzip($result);
        }
    }
}