<?php

/**
 * HelpWords.php
 *
 * @description :
 *
 * @author : zhaoxichao
 * @since : 06/06/2018
 */
class Service_Page_View_HelpWords extends Base_Page {

    private $objDataService = null;


    public function __construct() {

        parent::__construct();

        $this->objDataService = new Service_Data_HelpWords();
    }

    public function call() {

        $arrResult = $this->objDataService->getHelpWordsContent();
    }


}