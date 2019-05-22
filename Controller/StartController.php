<?php

namespace Sioweb\Oxid\SomethingWentWrong\Controller;

use OxidEsales\Eshop\Core\Registry;

class StartController extends StartController_parent
{
    public function render()
    {
        parent::render();
        if (Registry::getConfig()->getRequestParameter('redirected') || Registry::getConfig()->getRequestParameter('redirect')) {
            return 'message/exception.tpl';
        }

        return $this->_sThisTemplate;
    }
}
