<?php
/**
 * @name index
 * @desc 入口文件
 * @author zhuminghai(zhuminghai@baidu.com)
 */
$objApplication = Bd_Init::init();
$objResponse = $objApplication->bootstrap()->run();
