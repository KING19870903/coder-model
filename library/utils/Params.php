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
        return array_merge(self::$arrParsedParams['params'], self::$arrParsedParams['services']);
    }

    /**
     * 处理HTTP GET请求参数
     *
     * @static
     * @access public
     */
    public static function procGetParams() {
        self::$arrParsedParams['params'] = $_GET;

        // 特殊字符处理
        self::filterHtmlChars();

        // pu参数
        self::parsePu();

        // uid
        self::parseUid();

        // 城市
        self::parseCct();

        // 省份
        self::parseProvince();
    }

    /**
     * 特殊字符转html
     *
     * @static
     * @access protected
     */
    protected static function filterHtmlChars() {
        $arrSpecialKeys
            = array('from', 'cid', 'f', 'uid', 'baiduid', 'ssid', 'bd_page_type', 'assets_debug', 'action', 'tj');

        foreach ($arrSpecialKeys as $key) {
            if (!empty(self::$arrParsedParams['params'][$key])) {
                self::$arrParsedParams['params'][$key]
                    = htmlspecialchars(self::$arrParsedParams['params'][$key]);
            }
        }
    }

    /**
     * pu参数解析
     *
     * @static
     * @access protected
     */
    protected static function parsePu() {
        if (empty(self::$arrParsedParams['params']['pu'])) {
            return;
        }

        $arrPuParams = As_Utils_ACommon::decompose(self::$arrParsedParams['params']["pu"]);

        // 需要解码的参数名称
        $arrDecodeKeys = array(
            'cua',
            'cuid',
            'cut',
        );

        foreach ($arrDecodeKeys as $key) {
            if (isset($arrPuParams[$key])) {
                $arrPuParams[$key] = As_Utils_BdBase64::decodeB64($arrPuParams[$key]);
            }

            if (!empty($arrPuParams[$key])) {
                $arrPuParams[$key] = urldecode(urldecode($arrPuParams[$key]));
            }
        }

        if (!empty($arrPuParams)) {
            /**
             * at,gt参数无用，日志改造时请去掉
             */
            $arrPuParams['at'] = 1;
            $arrPuParams['gt'] = '111111_0_0';
            self::$arrParsedParams['params'] = array_merge(
                self::$arrParsedParams['params'],
                $arrPuParams
            );
        }
    }

    /**
     * 解析uid
     *
     * @static
     * @access protected
     */
    protected static function parseUid() {
        $strUid = As_Utils_BdBase64::decodeB64(self::$arrParsedParams['params']['uid']);

        if (!empty($strUid)) {
            self::$arrParsedParams['params']['uid'] = $strUid;
        }
    }

    /**
     * 解析城市信息
     *
     * @static
     * @access protected
     */
    protected static function parseCct() {
        if (!isset(self::$arrParsedParams['params']['cct'])) {
            return;
        }

        self::$arrParsedParams['params']['cct']
            = As_Utils_BdBase64::decodeB64(self::$arrParsedParams['params']['cct']);

        if (!empty(self::$arrParsedParams['params']['cct'])) {
            self::$arrParsedParams['params']['cct'] = urldecode(self::$arrParsedParams['params']['cct']);
        }
    }

    /**
     * 解析省份信息
     *
     * @static
     * @access protected
     */
    protected static function parseProvince() {
        if (!isset(self::$arrParsedParams['params']['province'])) {
            return;
        }

        self::$arrParsedParams['params']['province']
            = As_Utils_BdBase64::decodeB64(self::$arrParsedParams['params']['province']);

        if (!empty(self::$arrParsedParams['params']['province'])) {
            self::$arrParsedParams['params']['province'] = urldecode(self::$arrParsedParams['params']['province']);
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
    }
}