<?php

use YOOtheme\Builder\Source;

if (!class_exists(Source::class)) {
    return;
}

// Force load classes
require_once __DIR__ . '/Listener/LoadSourceTypes.php';
require_once __DIR__ . '/Type/J2StoreProductType.php';

return [
    'events' => [
        'source.init' => function (Source $source) {
            try {
                (new \J2Commerce\Listener\LoadSourceTypes())->handle($source);
            } catch (\Exception $e) {
                // This will help us see errors
                error_log('J2Store Source Error: ' . $e->getMessage());
            }
        }
    ]
];
