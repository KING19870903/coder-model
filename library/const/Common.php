<?php
/**
 * Common.php
 * 区块链浏览器通用常量定义
 * @author zhuminghai
 * @since 2018/5/31
 */

class Const_Common {

    //状态码返回键
    const STATUS_KEY = "error_no";

    //返回提示语键
    const MSG_KEY = "message";

    //返回数据键
    const RESULT_KEY = "result";

    // sha1签名校验token
    const SIGN_TOKEN = "appsearch_explorer_xdaf8dfad*7%12%fdafasi32fa^%&^)dafd";

    //助记词说明
    const HELP_WORDS = 'app/native/helpwords.tpl';

    //用户协议页面
    const USER_PROTOCOL = 'app/native/userprotocol.tpl';


    /**
     * 用户头像相关
     */
    const USER_ICON_NORMAL = 'https://ss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portrait/item/';

    //const USER_ICON_HIGN   = 'https://ss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portraith/item/';

    const USER_ICON_DEFAULT = 'http://cp01-ocean-400.epc.baidu.com:8082/anxun/pic/item/38dbb6fd5266d01698fae711972bd40735fa3523.jpg';
}