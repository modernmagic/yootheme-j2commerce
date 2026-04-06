<?php
defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use J2Commerce\Extension\J2Commerce;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $dispatcher = $container->get(DispatcherInterface::class);
                
                $plugin = new J2Commerce(
                    $dispatcher,
                    (array) PluginHelper::getPlugin('system', 'yootheme_j2commerce')
                );

                $plugin->setApplication(Factory::getApplication());
                // setDatabase() is now handled automatically via the trait

                return $plugin;
            }
        );
    }
};
