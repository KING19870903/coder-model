<?php
/**
 * Action.php
 *
 * @description : 当前模块Action基层
 *
 * @author : zhaoxichao
 * @since : 19/06/2018
 */

class Base_Action extends As_Base_Action {

    /**
     * init
     * @description : Action初始化操作
     *
     * @author zhaoxichao
     * @date 19/06/2018
     */
    public function init() {

        //状态码返回键
        $this->statusKey = Const_Common::STATUS_KEY;

        //返回提示语键
        $this->msgKey = Const_Common::MSG_KEY;

        //返回数据键
        $this->resultKey = Const_Common::RESULT_KEY;

        //输出是否需要做gzip压缩,true:压缩
        $this->needGzip = true;
    }
}
