<?php

/**
 * HelpWords.php
 *
 * @description : 助记词说明接口Action层
 *
 * @author : zhaoxichao
 * @since : 04/06/2018
 */
class Action_HelpWords  extends Base_Action {
    /**
     * call
     * @description : action处理逻辑入口
     *
     * @author zhaoxichao
     * @date 04/06/2018
     */
    public function call() {

        $objPageService = new Service_Page_View_HelpWords();

        $arrRet = $objPageService->execute();

        //渲染模板
        $this->getView()->display(Const_Common::HELP_WORDS, $arrRet);

    }

    /**
     * output
     * @description : 输出助记词说明HTML页面数据
     *
     * @param string $strOut 助记词说明HTML页面数据
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function output($strOut = '') {

        //直接输出HTML页面数据
        echo $strOut;
    }
}