<?php
/**
 * Params.php
 * 参数统一处理工具类
 * @author zhuminghai
 * @since 2018/5/31
 */

class Utils_Params {

    /**
     * 解析过后的客户端请求参数
     *
     * @static
     * @access protected
     * @var array
     */
    protected static $arrParsedParams = array();

    /**
     * 初始化参数
     *
     * @static
     * @access public
     */
    public static function initParams() {
        if (!empty(self::$arrParsedParams)) {
            return;
        }

        self::procGetParams();

        self::procPostParams();
    }

    /**
     * 获取所有的GET请求参数
     *
     * @return array
     */
    public static function getAllGetParams() {
        return self::$arrParsedParams['params'];
    }

    /**
     * 获取所有的POST请求参数
     *
     * @return array
     */
    public static function getAllPostParams() {
        return self::$arrParsedParams['services'];
    }

    /**
     * 获取所有的请求参数，不区分GET/POST请求类型
     * @return array
     */
    public static function getAllParams() {
        return array_merge((array) self::$arrParsedParams['params'], (array) self::$arrParsedParams['services']);
    }

    /**
     * 获取原始的所有请求参数，不区分GET/POST请求类型
     * @return array
     */
    public static function getAllOriParams(){
        $getParams  = !empty($_GET)  ? $_GET : array();
        $postParams = !empty($_POST) ? $_POST : array();
        return array_merge($getParams, $postParams);
    }

    /**
     * 处理HTTP GET请求参数
     *
     * @static
     * @access public
     */
    public static function procGetParams() {
        self::$arrParsedParams['params'] = $_GET;

        $paramKey = 'params';

        // 特殊字符处理
        self::filterHtmlChars($paramKey);
    }

    /**
     * 特殊字符转html
     * @param $paramKey
     */
    protected static function filterHtmlChars($paramKey) {
        $arrSpecialKeys
            = array('from', 'fParam', 'uid', 'action');

        foreach ($arrSpecialKeys as $key) {
            if (!empty(self::$arrParsedParams[$paramKey][$key])) {
                self::$arrParsedParams[$paramKey][$key]
                    = htmlspecialchars(self::$arrParsedParams[$paramKey][$key]);
            }
        }
    }

    /**
     * 处理HTTP POST请求参数
     *
     * @static
     * @access public
     */
    public static function procPostParams() {
        self::$arrParsedParams['services'] = $_POST;

        $paramKey = 'services';

        // 特殊字符处理
        self::filterHtmlChars($paramKey);

        // pu参数
        self::parsePu();

        // uid
        self::parseUid();

        // bduss参数
        self::parseBduss();
    }

    /**
     * pu参数解析
     * @param $paramKey
     */
    protected static function parsePu() {

        if (empty(self::$arrParsedParams['services']['pu'])) {
            return;
        }

        // 解析pu参数
        $puValue = Utils_AesCipher::decrypt(self::$arrParsedParams['services']["pu"]);

        if(!empty($puValue)) {
            $arrPuParams = As_Utils_ACommon::decompose($puValue);
            self::$arrParsedParams['services'] = array_merge(
                self::$arrParsedParams['services'],
                (array) $arrPuParams
            );
        }
    }

    /**
     * 解析uid
     */
    protected static function parseUid() {

        // urldecode & decrypt

        $decodeUid = self::$arrParsedParams['services']['uid'];
        $strUid = Utils_AesCipher::decrypt($decodeUid);

        if (!empty($strUid)) {
            self::$arrParsedParams['services']['uid'] = $strUid;
        }
    }

    /**
     * 解密bduss信息
     */
    protected static function parseBduss() {

        // urldecode & decrypt
        $decodeBduss = self::$arrParsedParams['services']['bduss'];
        $bduss = Utils_AesCipher::decrypt($decodeBduss);

        if(!empty($bduss)) {
            self::$arrParsedParams['services']['bduss'] = $bduss;
        }
    }
}