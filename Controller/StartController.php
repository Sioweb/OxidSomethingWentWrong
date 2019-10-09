<?php

namespace Sioweb\Oxid\SomethingWentWrong\Controller;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Email;
use Ci\Oxid\FormBuilder\Model\Form as FormModel;

class StartController extends StartController_parent
{
    public function somethingWentWrong()
    {
        $FeedbackTrace = Registry::getSession()->getVariable("swwFeedbackTrace");
        $LastTraces = array_slice($FeedbackTrace, -2);
        $NoFormAfterControllers = unserialize($this->getConfig()->getConfigParam('swwNoFormAfterController'));
        
        foreach($LastTraces as $Trace) {
            foreach($NoFormAfterControllers as $Controller) {
                if(preg_match('|\bcl=' . $Trace['CONTROLLER'] . '\b|is', $Controller)) {
                    return false;
                }
            }
        }

        return (
            !empty($FeedbackTrace) &&
            count($FeedbackTrace) > 1 &&
            !Registry::getConfig()->getRequestParameter('fnc') &&
            (Registry::getConfig()->getRequestParameter('redirected') || Registry::getConfig()->getRequestParameter('redirect'))
        );
    }

    public function getFeedbackForm()
    {
        $FeedbackTrace = Registry::getSession()->getVariable("swwFeedbackTrace");
        if(
            Registry::getConfig()->getRequestParameter('fnc') ||
            (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
            $this->isExcludet() ||
            (empty($FeedbackTrace) || count($FeedbackTrace) <= 1)
        ) {
            return '';
        }

        $Form = oxNew(FormModel::class);
        $Email = oxNew(Email::class);
        $Email->sendSww2Owner();
        return $Form->loadWithFields('27ff1f1a74c65f80d52147ec9a18d1c2');
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
