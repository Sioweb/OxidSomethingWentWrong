<?php

namespace Sioweb\Oxid\SomethingWentWrong\Controller;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Email;
use Ci\Oxid\FormBuilder\Model\Form as FormModel;

class StartController extends StartController_parent
{
    public function somethingWentWrong()
    {
        return (Registry::getConfig()->getRequestParameter('redirected') || Registry::getConfig()->getRequestParameter('redirect'));
    }

    public function getFeedbackForm()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return '';
        }

        $Form = oxNew(FormModel::class);
        $Email = oxNew(Email::class);
        $Email->sendSww2Owner();
        return $Form->loadWithFields('27ff1f1a74c65f80d52147ec9a18d1c2');
    }
}
