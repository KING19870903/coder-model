<?php
/**
 * FParam.php
 * f参数信息
 * @author zhuminghai
 * @since 2018/6/1
 */

class Const_FParam {


    // 首页 --- 我的应用
    const F_HOME_MYDAPP = 'xexplorer_home_mydapp';

    // 首页 --- banner
    const F_HOME_BANNER = 'xexplorer_home_banner';

    // 首页 --- 推荐应用
    const F_HOME_RECOMMEND_DAPP = 'xexplorer_home_recommend_dapp';

    // 我的资产 --- 某一区块链
    const F_MYASSET_ITEM = 'xexplorer_myasset_item';


    public static $fparamMap = array(

        self::F_HOME_MYDAPP => 'explorer_home@mydapp@pos+%d',

        self::F_HOME_BANNER => 'explorer_home@banner',

        self::F_HOME_RECOMMEND_DAPP => 'explorer_home@recdapp@pos+%d',

        self::F_MYASSET_ITEM => 'explorer_myasset@name+%s',
    );

    /**
     * @param string $key
     * @param array  $params
     * @return string $result
     */
    public static function getFparam($key, $params = array()) {
        $result = null;
        if (!empty(self::$fparamMap[$key])) {
            if (!$params) {
                $result = self::$fparamMap[$key];
            } else {
                array_unshift($params, self::$fparamMap[$key]);
                $result = call_user_func_array('sprintf', $params);
            }
        }

        return $result ? $result : 'f_unable_to_obain';
    }
}
