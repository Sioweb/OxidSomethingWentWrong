<?php

namespace Sioweb\Oxid\SomethingWentWrong\Core;

use OxidEsales\Eshop\Core\Registry;

class Email extends Email_parent
{

    public function onSwwMailSend()
    {

    }

    public function sendSww2Owner()
    {
        $config = $this->getConfig();

        $shop = $this->_getShop();

        // cleanup
        $this->_clearMailer();
        $this->setFrom($shop->oxshops__oxowneremail->value);

        $language = Registry::getLang();
        $orderLanguage = $language->getObjectTplLanguage();

        // if running shop language is different from admin lang. set in config
        // we have to load shop in config language
        if ($shop->getLanguage() != $orderLanguage) {
            $shop = $this->_getShop($orderLanguage);
        }

        $this->setSmtp($shop);

        // create messages
        $smarty = $this->_getSmarty();

        $this->setViewData('SERVER', [
            'HTTP_HOST' => $_SERVER['HTTP_HOST'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'QUERY_STRING' => $_SERVER['QUERY_STRING'],
            'PORT' => $_SERVER['SERVER_PORT'],
            'ADDR' => $this->anonymize($_SERVER['SERVER_ADDR']),
            'USR' => $this->anonymize($_SERVER['REMOTE_ADDR']),
            'FILE' => $_SERVER['PHP_SELF'],
            'SCRIPT' => $_SERVER['SCRIPT_NAME'],
            'AGENT' => $_SERVER['HTTP_USER_AGENT'],
            'POST' => http_build_query($_POST)
        ]);

        $this->setViewData('SERVER_HISTORY', Registry::getSession()->getVariable("swwFeedbackTrace"));
        $this->setViewData('USER', $this->getActiveUser());
        $this->setViewData('oxcmp_basket', Registry::getSession()->getBasket());

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $this->setBody($smarty->fetch($config->getTemplatePath($this->getConfig()->getConfigParam('swwFeedbackTemplate'), false)));

        $this->setSubject($this->getConfig()->getConfigParam('swwFeedbackSubject'));

        $Receiver = $this->getConfig()->getConfigParam('swwFeedbackReceiver');
        if(empty($Receiver)) {
            $Receiver = $shop->oxshops__oxowneremail->value;
        }
        $this->setRecipient($Receiver, $language->translateString("order"));

        $result = $this->send();

        $this->onSwwMailSend();

        if ($config->getConfigParam('iDebug') == 6) {
            Registry::getUtils()->showMessageAndExit("");
        }

        return $result;
    }

    protected function getActiveUser()
    {
        $arrUserData = [];
        $User = Registry::getSession()->getUser();
        if(!empty($User)) {
            foreach($User->getFieldNames() as $fieldname) {
                $arrUserData[$fieldname] = $User->{'oxuser__' . $fieldname}->value;
            }
        }
        $arrUserData = array_diff_key($arrUserData, $this->excludeFields());
        return $arrUserData;
    }

    protected function excludeFields()
    {
        return ['oxpassword'=>0, 'oxpasssalt'=>0, 'oxrights'=>0];
    }

    private function anonymize($ip)
    {
        return implode('.', array_slice(explode('.', $ip), 0, -1)) . '...';
    }
}
