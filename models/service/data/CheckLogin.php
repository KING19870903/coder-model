<?php
/**
 * CheckLogin.php
 * 校验登录状态和区块链账户信息
 * @author zhuminghai
 * @since 2018/6/5
 */

class Service_Data_CheckLogin {

    // 缓存注册区块链账户前缀
    const REDIS_CACHE_EXIST_USER = 'xexplorer_cache_existuer_';

    // 缓存注册区块链账户时间
    const REDIS_CACHE_USER_TIME = 86400;

    /**
     * 访问下游区块链服务
     * @var Dao_BlockChain
     */
    private $daoObj;

    /**
     * @var Dao_RedisContent
     */
    private $daoRedisObj;

    public function __construct() {

        $this->daoObj = new Dao_BlockChain();

        $this->daoRedisObj = new Dao_RedisContent();
    }

    /**
     * 获取区块链用户信息
     * @param $uid
     * @return array
     */
    public function isChainUserExists($uid) {

        // 已注册的区块链账户，直接走缓存获取数据
        $cacheKey = self::REDIS_CACHE_EXIST_USER . $uid;
        $cacheInfo = $this->daoRedisObj->get($cacheKey);
        if(!empty($cacheInfo)) {
            return $cacheInfo;
        }

        $ret = $this->daoObj->queryChainUser($uid);

        // 若已有区块链账户添加缓存
        if(!empty($ret)) {
            $this->daoRedisObj->set(
                $cacheKey,
                $ret,
                self::REDIS_CACHE_USER_TIME
            );
        }
        return $ret;
    }
}