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
            Sioweb\Oxid\SomethingWentWrong\Controller\StartController::class
    ],
    'events' => [
        'onActivate' => '\Sioweb\Oxid\SomethingWentWrong\Core\Events::onActivate',
        'onDeactivate' => '\Sioweb\Oxid\SomethingWentWrong\Core\Events::onDeactivate',
    ],
    // 'templates' => [
    //     'formbuilder_shop_main.tpl' => 'sioweb/Backend/views/admin/tpl/form/formbuilder_shop_main.tpl',
    // ],
    // 'blocks' => [
    //     [
    //         'template' => 'headitem.tpl',
    //         'block' => 'admin_headitem_inccss',
    //         'file' => 'admin_headitem_inccss.tpl',
    //     ],
    // ]
];