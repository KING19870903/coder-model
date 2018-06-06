<?php

/**
 * Template.php
 *
 * @description : 重写模版对象的方法
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Utils_Template  implements Ap_View_Interface {
    /**
     * @var Bd_TplFactory|null|Smarty   模版对象实例
     */
    private $objSmarty = null;

    /**
     * Utils_Template constructor.
     */
    public function __construct() {
        $this->objSmarty = Bd_TplFactory::getInstance();
    }

    /**
     * setScriptPath
     * @description : 设置模板路径
     *
     * @param string $strPath 模板路径
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function setScriptPath($strPath = '') {

        $strTemplatePath = Bd_AppEnv::getEnv($strPath).'/';

        $this->objSmarty->setTemplateDir($strTemplatePath);
    }

    /**
     * display
     * @description : 页面渲染
     *
     * @param       $strViewPath 设置模板路径
     * @param array $arrRet 页面渲染数据
     * @param bool  $return 是否返回数据
     * @param null  $header header头
     * @return mixed|null
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function display($strViewPath, $arrRet = array(), $return = false, $header = null) {

        foreach($arrRet as $key => $value){
            $this->objSmarty->assign($key,$value);
        }

        $output = str_replace(array(
            "\r\n",
            "\n",
            "\t",
            "  "
        ), "", $this->objSmarty->fetch($strViewPath));
        if ($return) {
            return $output;
        } else {
            echo $output;
            return null;
        }
    }

    /**
     * assign
     * @description : 渲染模板赋值
     *
     * @param      $name 模板变量名称
     * @param null $value 模板变量值
     * @return Smarty_Internal_Data|void
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function assign($name, $value = NULL) {
        return $this->objSmarty->assign($name, $value);
    }

    /**
     * getScriptPath
     * @description :
     *
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function getScriptPath(){

    }

    /**
     * render
     * @description : 渲染
     *
     * @param      $file 待渲染文件
     * @param null $context 待渲染数据
     * @author zhaoxichao
     * @date 06/06/2018
     */
    public function render($file, $context = NULL) {

    }

}