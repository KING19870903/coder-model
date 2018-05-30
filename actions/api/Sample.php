<?php
/**
 * @name Action_Sample
 * @desc sample api
 * @author zhuminghai(zhuminghai@baidu.com)
 */
class Action_Sample extends Saf_Api_Base_Action {

    public function __execute(){
    	$arrRequest = Saf_SmartMain::getCgi();
        $arrInput = $arrRequest['get'];
		$objServicePageSampleApi = new Service_Page_SampleApi();
		$arrPageInfo = $objServicePageSampleApi->execute($arrInput);
        return $arrPageInfo;
    }
	
    public function __render($arrRes){
    	echo json_encode($arrRes);
    }
	
	public function __value($arrRes){
		echo json_encode($arrRes);
	}
}
