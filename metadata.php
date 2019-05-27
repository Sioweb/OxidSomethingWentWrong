<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

// 1234

/**
 * Module information
 */
$aModule = [
    'id' => 'SiowebSomethingWentWrong',
    'title' => '<i></i><b style="color: #005ba9">Sioweb</b> | Something went wrong!',
    'description' => '.',
    'version' => '1.0',
    'url' => 'https://www.sioweb.de',
    'email' => 'support@sioweb.com',
    'author' => 'Sascha Weidner',
    'extend' => [
        \OxidEsales\Eshop\Application\Controller\StartController::class =>
            Sioweb\Oxid\SomethingWentWrong\Controller\StartController::class,
        \OxidEsales\Eshop\Core\Email::class =>
            Sioweb\Oxid\SomethingWentWrong\Core\Email::class,
        \OxidEsales\Eshop\Core\ShopControl::class =>
            Sioweb\Oxid\SomethingWentWrong\Core\ShopControl::class,
    ],
    'events' => [
        'onActivate' => '\Sioweb\Oxid\SomethingWentWrong\Core\Events::onActivate',
        'onDeactivate' => '\Sioweb\Oxid\SomethingWentWrong\Core\Events::onDeactivate',
    ],
    'templates' => [
        'email/somethingwentwrong/error.tpl' => 'sioweb/SomethingWentWrong/views/tpl/email/somethingwentwrong/error.tpl',
        'email/formbuilder/fehler-feedback.tpl' => 'sioweb/SomethingWentWrong/views/tpl/email/formbuilder/fehler-feedback.tpl',
        'email/formbuilder/customer/fehler-feedback.tpl' => 'sioweb/SomethingWentWrong/views/tpl/email/formbuilder/customer/fehler-feedback.tpl',
    ],
    'blocks' => [
        [
            'template' => 'layout/page.tpl',
            'block' => 'layout_header',
            'file' => 'views/blocks/layout_header.tpl',
        ],
    ],
    'settings' => [
        ['group' => 'sww_feedback_settings', 'name' => 'swwFeedbackSubject', 'type' => 'str', 'value' => 'Feedback Oxid Shop'],
        ['group' => 'sww_feedback_settings', 'name' => 'swwFeedbackTemplate', 'type' => 'str', 'value' => 'email/somethingwentwrong/error.tpl'],
        ['group' => 'sww_feedback_settings', 'name' => 'swwFeedbackReceiver', 'type' => 'str', 'value' => ''],
        ['group' => 'sww_feedback_settings', 'name' => 'swwFeedbackExclude', 'type' => 'arr', 'value' => [
            'bingbot',
            'googlebot',
            'SemrushBot',
            'Cliqzbot',
            'YandexBot',
            'CCBot'
        ]],
    ],
];