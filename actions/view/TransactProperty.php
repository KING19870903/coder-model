<?php

/**
 * TransactProperty.php
 *
 * @description : 资产交易记录及查询接口Action层
 *
 * @author : zhaoxichao
 * @since : 11/06/2018
 */
class Action_TransactProperty extends Base_Action {
    /**
     * call
     * @description : action入口处理逻辑
     *
     * @return array
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function call() {
        $objPageService = new Service_Page_View_TransactProperty();

        $arrRet = $objPageService->execute();

        return $arrRet;
    }

    /**
     * output
     * @description : 格式化输出结果
     *
     * @param array $result 结果数据
     * @author zhaoxichao
     * @date 12/06/2018
     */
    public function output($result = array()) {

        Utils_Util::jsonPackGzip($result);
    }
}