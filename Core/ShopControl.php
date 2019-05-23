<?php

namespace Sioweb\Oxid\SomethingWentWrong\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Session;

class ShopControl extends ShopControl_parent
{
    public function __construct()
    {
        $session = oxNew(Session::class);
        $session->setForceNewSession();
        parent::__construct();
    }

    public function start($controllerKey = null, $function = null, $parameters = null, $viewsChain = null)
    {
        parent::start($controllerKey, $function, $parameters, $viewsChain);

        $FeedbackTrace = Registry::getSession()->getVariable("swwFeedbackTrace");

        if(empty($FeedbackTrace)) {
            $FeedbackTrace = [];
        }

        if(count($FeedbackTrace) === 10) {
            array_shift($FeedbackTrace);
        }

        $FeedbackTrace[time()] = [
            'HTTP_HOST' => $_SERVER['HTTP_HOST'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'QUERY_STRING' => $_SERVER['QUERY_STRING']
        ];

        Registry::getSession()->setVariable("swwFeedbackTrace", $FeedbackTrace);
    }
}