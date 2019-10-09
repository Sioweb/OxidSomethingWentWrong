<?php

use OxidEsales\Eshop\Core\Model\ListModel;

$sLangName = "Deutsch";

$aLang = array(
    'charset' => 'UTF-8',

    'SHOP_MODULE_GROUP_sww_feedback_settings' => 'Feedback-Einstellungen',
    'SHOP_MODULE_swwFeedbackSubject' => 'E-Mail-Betreff für Shopbetreiber',
    'SHOP_MODULE_swwFeedbackTemplate' => 'Template für Feedback-E-Mail',
    'SHOP_MODULE_swwFeedbackReceiver' => 'Empfänger für Fehlerberichte',
    'SHOP_MODULE_swwFeedbackExclude' => 'User agents ausschließen',
    'SHOP_MODULE_swwNoFormAfterController' => 'Keinen Fehleranzeigen, wenn der Benutzer von diesen ausgewählten Controllern kommt.',
);


$sQ = "SELECT oxstdurl, oxobjectid, oxseourl FROM oxseo WHERE oxtype='static' && oxlang = ? && oxshopid = ? GROUP BY oxobjectid ORDER BY oxstdurl";

$oStaticUrlList = oxNew(ListModel::class);
$oStaticUrlList->init('oxbase', 'oxseo');
$oStaticUrlList->selectString($sQ, [0, 1]);
foreach($oStaticUrlList as $key => $oItem) {
    $aLang['SHOP_MODULE_swwNoFormAfterController_' . $oItem->oxseo__oxstdurl->getRawValue()] = $oItem->oxseo__oxstdurl->getRawValue() . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $oItem->oxseo__oxseourl->getRawValue();
}