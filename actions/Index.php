<?php
/**
 * Index.php
 * 默认处理页面
 * @author zhuminghai
 * @since 2018/5/31
 */

class Action_Index extends Base_Action {

    /**
     * action入口处理逻辑
     *
     * @return array
     */
    public function call() {


        $_COOKIE['BDUSS'] = 'ZveXlJajZ0M21VeWVvclZEdGxTZzktRVR0OGY2akdQZHRkRlpPOVBkRGltajFiQVFBQUFBJCQAAAAAAAAAAAEAAADCvAyVemh1bWluZ2hhaQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOINFlviDRZbUF';
        $ret = Bd_Passport::checkUserLogin();
        var_dump($ret);
        exit;
        return array();

    }
}