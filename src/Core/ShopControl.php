<?php

namespace Sioweb\Oxid\SomethingWentWrong\Core;

use OxidEsales\Eshop\Core\Session;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ShopControl AS BaseShopControll;

class ShopControl extends ShopControl_parent
{
    public function __construct()
    {
        parent::__construct();
    }

    public function start($controllerKey = null, $function = null, $parameters = null, $viewsChain = null)
    {
        if(
            (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ||
            $this->isExcludet()
        ) {
            parent::start($controllerKey, $function, $parameters, $viewsChain);
        } else {
            Registry::getConfig()->setConfigParam('blForceSessionStart', true);
            Registry::getSession()->start();
            
            $FeedbackTrace = Registry::getSession()->getVariable("swwFeedbackTrace");
            // Registry::getSession()->setVariable("swwFeedbackTrace", []);
    
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
                    'TIMESTAMP' => $TimeStamp,
                    'PORT' => $_SERVER['SERVER_PORT'],
                    'ADDR' => $this->anonymize($_SERVER['SERVER_ADDR']),
                    'USR' => $this->anonymize($_SERVER['REMOTE_ADDR']),
                    'FILE' => $_SERVER['PHP_SELF'],
                    'SCRIPT' => $_SERVER['SCRIPT_NAME'],
                    'AGENT' => $_SERVER['HTTP_USER_AGENT'],
                    'POST' => http_build_query($_POST),
                    'CONTROLLER' => Registry::getConfig()->getRequestParameter('cl'),
                    'REQUEST_URL' => getRequestUrl()
                ];
                Registry::getSession()->setVariable("swwFeedbackTrace", $FeedbackTrace);
            }
            
            parent::start($controllerKey, $function, $parameters, $viewsChain);
        }
    }

    private function anonymize($ip)
    {
        return implode('.', array_slice(explode('.', $ip), 0, -1)) . '...';
    }

    protected function isExcludet()
    {
        $ExcludeUserAgents = $this->getConfig()->getConfigParam('swwFeedbackExclude');
        if(empty($ExcludeUserAgents)) {
            return false;
        }
        foreach($ExcludeUserAgents as $agent) {
            if(preg_match('|' . str_replace(['|','\\'], ['\|','\\\\'], $agent) . '|is', $_SERVER['HTTP_USER_AGENT'])) {
                return true;
            }
        }

        return false;
    }
}