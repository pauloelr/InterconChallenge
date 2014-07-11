<?php
namespace Intercon\Challenge\Application;

use Zend\View\HelperPluginManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $application         = $mvcEvent->getApplication();
        $eventManager        = $application->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
