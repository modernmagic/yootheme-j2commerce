<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;

class PlgSystemJ2storeYootheme extends CMSPlugin implements SubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'onAfterInitialise' => 'boot',
        ];
    }

    public function boot()
    {
        $app = \Joomla\CMS\Factory::getApplication();

        if (!$app->isClient('site') && !$app->isClient('administrator')) {
            return;
        }

        if (!class_exists('\YOOtheme\Application')) {
            return;
        }

        $yooApp = \YOOtheme\Application::getInstance();
        $yooApp->load(__DIR__ . '/src/Module/Source/bootstrap.php');
    }
}
