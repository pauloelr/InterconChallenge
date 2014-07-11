<?php
namespace Intercon\Challenge\Task;

use Zend\Stdlib\ArrayUtils;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        $config = array();

        $configFiles = array(
            __DIR__ . '/../config/module.config.php',
            __DIR__ . '/../config/service.config.php',
            __DIR__ . '/../config/routes.config.php',
        );

        foreach ($configFiles as $configFile) {
            /** @noinspection PhpIncludeInspection */
            $config = ArrayUtils::merge($config, include $configFile);
        }

        return $config;
    }
}
