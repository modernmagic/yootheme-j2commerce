<?php
namespace J2Commerce\Type;

use Joomla\CMS\Router\Route;

class J2StoreProductType
{
    public static function config()
    {
        return [
            'fields' => [
                'title' => ['type' => 'String', 'metadata' => ['label' => 'Title', 'group' => 'J2Store Product']],
                'price' => [
                    'type' => 'String',
                    'metadata' => ['label' => 'Price', 'group' => 'J2Store Product'],
                    'extensions' => ['call' => 'J2Commerce\Type\J2StoreProductType::resolvePrice']
                ],
                'image' => ['type' => 'String', 'metadata' => ['label' => 'Image', 'group' => 'J2Store Product']],
                'link'  => [
                    'type' => 'String',
                    'metadata' => ['label' => 'Link', 'group' => 'J2Store Product'],
                    'extensions' => ['call' => 'J2Commerce\Type\J2StoreProductType::resolveLink']
                ],
            ],
            'metadata' => ['label' => 'J2Store Product', 'group' => 'J2Store']
        ];
    }

    public static function resolvePrice($item)
    {
        return \J2StoreHelper::getPrice($item->product_id ?? $item->id ?? 0) ?? '0.00';
    }

    public static function resolveLink($item)
    {
        $id = $item->product_id ?? $item->id ?? 0;
        return Route::_('index.php?option=com_j2store&view=product&id=' . $id);
    }
}
