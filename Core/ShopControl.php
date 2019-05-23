<?php

namespace Sioweb\Oxid\SomethingWentWrong\Core;

use OxidEsales\Eshop\Core\Session;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ShopControl AS BaseShopControll;;

class ShopControl extends ShopControl_parent
{
    public function __construct()
    {
        parent::__construct();
    }

    public function start($controllerKey = null, $function = null, $parameters = null, $viewsChain = null)
    {
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            parent::start($controllerKey, $function, $parameters, $viewsChain);
        } else {
            Registry::getConfig()->setConfigParam('blForceSessionStart', true);
            Registry::getSession()->start();
            
            $FeedbackTrace = Registry::getSession()->getVariable("swwFeedbackTrace");
    
            if(empty($FeedbackTrace)) {
                $FeedbackTrace = [];
            }
        
            if(count($FeedbackTrace) === 10) {
                array_shift($FeedbackTrace);
            }
        
            $index = md5($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']);
            $lastKey = array_shift(explode('_', array_pop(array_keys($FeedbackTrace))));

            $TimeStamp = time();
            if($lastKey !== $index) {
                $FeedbackTrace[$index . '_' . $TimeStamp] = [
                    'HTTP_HOST' => $_SERVER['HTTP_HOST'],
                    'REQUEST_URI' => $_SERVER['REQUEST_URI'],
                    'QUERY_STRING' => $_SERVER['QUERY_STRING'],
                    'TIMESTAMP' => $TimeStamp
                ];
                Registry::getSession()->setVariable("swwFeedbackTrace", $FeedbackTrace);
            }
            
            parent::start($controllerKey, $function, $parameters, $viewsChain);
        }
    }
}