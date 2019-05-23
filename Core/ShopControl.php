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
        parent::start($controllerKey, $function, $parameters, $viewsChain);
    }

}