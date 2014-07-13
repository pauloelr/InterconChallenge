<?php

use Doctrine\ORM\Tools\SchemaTool;
use DoctrineDataFixtureModule\Loader\ServiceLocatorAwareLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Event\SuiteEvent;
use Zend\Mvc\Application;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * @var \Zend\Mvc\Application
     */
    private static $application;

    /**
     * @BeforeSuite
     */
    public static function initApplication(SuiteEvent $event)
    {
        chdir(__DIR__);
        $previousDir = '.';

        while (!file_exists('config/application.config.php')) {
            $dir = dirname(getcwd());

            if ($previousDir === $dir) {
                throw new \RuntimeException(
                    'Unable to locate "config/application.config.php": ' .
                    'Is the Content module in a sub-directory of your application skeleton?'
                );
            }

            $previousDir = $dir;
            chdir($dir);
        }

        require 'vendor/autoload.php';

        if(self::$application === null){
            $config = require 'config/application.config.php';
            self::$application = Application::init($config);
        }
    }

    /**
     * @BeforeScenario
     * @AfterScenario
     */
    public function initDatabase($event){
        $serviceLocator = $this->getServiceManager();

        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        // Instantiate Schema Tool
        $tool = new SchemaTool($entityManager);
        $classes = $entityManager->getMetaDataFactory()->getAllMetaData();

        // Drop and Recreate Database
        $tool->dropSchema($classes);
        $tool->createSchema($classes);

        // Instantiate Fixture Executor
        $loader = new ServiceLocatorAwareLoader($serviceLocator);
        $executor = new ORMExecutor($entityManager, new ORMPurger());

        // Get Fixture Config
        $applicationConfig = $serviceLocator->get('Config');
        $fixturePaths = $applicationConfig['doctrine']['fixture'];

        // Load Fixtures From Directories
        foreach ($fixturePaths as $value) {
            $loader->loadFromDirectory($value);
        }

        // Execute Fixtures
        $executor->execute($loader->getFixtures());
    }

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    private function getServiceManager(){
        return self::$application->getServiceManager();
    }
}
