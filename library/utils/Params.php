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

        // pu参数
        self::parsePu($paramKey);

        // uid
        self::parseUid($paramKey);

    }

    /**
     * 特殊字符转html
     *
     * @static
     * @access protected
     */
    protected static function filterHtmlChars($paramKey) {
        $arrSpecialKeys
            = array('from', 'cid', 'f', 'uid', 'baiduid', 'ssid', 'bd_page_type', 'assets_debug', 'action', 'tj');

        foreach ($arrSpecialKeys as $key) {
            if (!empty(self::$arrParsedParams[$paramKey][$key])) {
                self::$arrParsedParams[$paramKey][$key]
                    = htmlspecialchars(self::$arrParsedParams[$paramKey][$key]);
            }
        }
    }

    /**
     * pu参数解析
     *
     * @static
     * @access protected
     */
    protected static function parsePu($paramKey) {

        if (empty(self::$arrParsedParams[$paramKey]['pu'])) {
            return;
        }

        $arrPuParams = As_Utils_ACommon::decompose(self::$arrParsedParams[$paramKey]["pu"]);

        self::$arrParsedParams[$paramKey] = array_merge(
            self::$arrParsedParams[$paramKey],
            (array) $arrPuParams
        );
    }

    /**
     * 解析uid
     *
     * @static
     * @access protected
     */
    protected static function parseUid($paramKey) {
        $strUid = As_Utils_BdBase64::decodeB64(self::$arrParsedParams[$paramKey]['uid']);

        if (!empty($strUid)) {
            self::$arrParsedParams[$paramKey]['uid'] = $strUid;
        }
    }


    /**
     * 处理HTTP POST请求参数 (TODO : 编码情况是否需要转换待确认)
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
        self::parsePu($paramKey);

        // uid
        self::parseUid($paramKey);
    }
}