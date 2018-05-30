<?php
/**
 * @name Appsearch_Api_Xexplorer_Interface
 * @desc sample api interface
 * @author zhuminghai(zhuminghai@baidu.com)
 */
interface Appsearch_Api_Xexplorer_Interface{
    public function getSample(Appsearch_Api_Xexplorer_Entity_ReqgetSample $req,
    						  Appsearch_Api_Xexplorer_Entity_ResgetSample $res);
}

class Appsearch_Api_Xexplorer_Entity_ReqgetSample extends Saf_Api_Entity{
	public $id = 0;
    public function __construct(){
    }
}
class Appsearch_Api_Xexplorer_Entity_ResgetSample extends Saf_Api_Entity{
    public $errno = 0 ;
    public $data = null ;
    public function __construct(){
    }
}

