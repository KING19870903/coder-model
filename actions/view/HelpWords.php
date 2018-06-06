<?php

/**
 * HelpWords.php
 *
 * @description : 助记词说明
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

        $arrOutput = $objPageService->execute();

        //渲染模板 - bootstrap

        $tpl = Bd_TplFactory::getInstance();

        $templateDir = Bd_AppEnv::getEnv('template').'/';

        $tpl->setTemplateDir($templateDir);


        $tpl->assign($arrOutput);

        $tpl->display('app/native/helpwords.tpl');


        //这里直接输出,作为示例
        $strOut = $arrOutput['data'];
     //   var_dump($strOut);die;

        return $strOut;

    }

    public function output($result) {
        //直接输出页面
        echo $strOut;
    }
}