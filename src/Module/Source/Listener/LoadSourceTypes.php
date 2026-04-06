<?php
namespace J2Commerce\Listener;

use YOOtheme\Builder\Source;
use J2Commerce\Type\J2StoreProductType;

class LoadSourceTypes
{
    public function handle(Source $source): void
    {
        $source->objectType('J2StoreProduct', J2StoreProductType::config());

        $source->queryType([
            'fields' => [
                'j2storeProducts' => [
                    'type' => ['listOf' => 'J2StoreProduct'],
                    'metadata' => [
                        'label' => 'J2Store Products',
                        'group' => 'J2Store'
                    ],
                    'extensions' => [
                        'call' => 'J2Commerce\Listener\LoadSourceTypes::resolveProducts'
                    ]
                ]
            ]
        ]);
    }

    public static function resolveProducts()
    {
        if (class_exists('\J2StoreHelper')) {
            return \J2StoreHelper::getProducts(['published' => 1, 'limit' => 50]) ?: [];
        }
        return [];
    }
}
