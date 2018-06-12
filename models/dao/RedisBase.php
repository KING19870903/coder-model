<?php
/**
 * RedisBase.php
 * Dao层访问redis的基类
 * @author zhuminghai
 * @since 2018/5/22
 */

class Dao_RedisBase {

    /**
     * @var Object As_Dc_Redis
     */
    private $objCache;

    /**
     * __construct
     *
     * @param void
     * @return void
     */
    public function __construct(array $arrConfig) {

        //rds初始化
        $this->objCache = Bd_RalRpc::create('As_Dc_Redis', $arrConfig);

        if (empty($this->objCache)) {
            $this->objCache = null;
        }
    }

    /**
     * 获取缓存键对应缓存信息
     * @param $cacheKey
     * @return array|mixed
     */
    public function get($cacheKey) {
        $result = array();
        if(empty($cacheKey)) {
            return $result;
        }

        if(empty($this->objCache)) {
            return $result;
        }

        $queryKeyArr = array('key' => $cacheKey);
        $data = $this->objCache->get($queryKeyArr);
        if (0 != $data['err_no']) {
            return $result;
        }
        $result = json_decode($data['ret'][$cacheKey], true);
        return $result;
    }

    /**
     * 设置缓存信息
     * @param $cacheKey 缓存键值
     * @param array $data 待缓存的数据
     * @param $cacheTime  缓存时间
     * @return bool 缓存是否成功状态 true|false
     */
    public function set($cacheKey, array $data, $cacheTime) {

        $flag = false;
        if (empty($cacheKey) || empty($data)) {
            return $flag;
        }

        if(empty($this->objCache)) {
            return $flag;
        }

        $arrQueryKey = array(
            'key'     => $cacheKey,
            'value'   => json_encode($data, true),
            'seconds' => $cacheTime,
        );

        $ret = $this->objCache->setex($arrQueryKey);
        if($ret) {
            $flag = true;
        }
        return $flag;
    }

}