<?php
namespace J2Commerce\Extension;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\Database\DatabaseAwareInterface;   // ← Added
use Joomla\Database\DatabaseAwareTrait;       // ← Added

class J2Commerce extends CMSPlugin implements SubscriberInterface, DatabaseAwareInterface
{
    use DatabaseAwareTrait;   // ← This provides setDatabase()

    public static function getSubscribedEvents(): array
    {
        return ['onAfterInitialise' => 'boot'];
    }

    public function boot()
    {
        error_log('=== J2Commerce Plugin Booted Successfully ===');
        if (!class_exists('\YOOtheme\Application')) {
            return;
        }

        $app = Factory::getApplication();
        if (!$app->isClient('site') && !$app->isClient('administrator')) {
            return;
        }

        $yoo = \YOOtheme\Application::getInstance();
        $yoo->load(__DIR__ . '/../Module/Source/bootstrap.php');
    }
}
