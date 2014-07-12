<?php
namespace Intercon\Challenge\TaskTest\Dispatch;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use DoctrineDataFixtureModule\Loader\ServiceLocatorAwareLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;

class TaskControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setApplicationConfig(include __DIR__ . '/../ConfigTest.php');

        $serviceLocator = $this->getApplicationServiceLocator();
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

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/');
        $this->assertResponseStatusCode(200);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task');
    }

    public function testAddActionCanBeAccessed()
    {
        //$this->getApplicationServiceLocator();

        $this->dispatch('/add');
        $this->assertResponseStatusCode(200);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/add');
    }

    public function testEditActionCanBeAccessed()
    {
        $this->dispatch('/edit/1');
        $this->assertResponseStatusCode(200);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/edit');
    }

    public function testDeleteActionCanBeAccessed()
    {
        $this->dispatch('/delete/1');
        $this->assertResponseStatusCode(200);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/delete');
    }

    public function testEditActionRedirectIfIdDoesNotExist()
    {
        $this->dispatch('/edit/3');
        $this->assertResponseStatusCode(302);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/edit');

        $this->assertRedirectTo('/');
    }

    public function testDeleteActionRedirectIfIdDoesNotExist()
    {
        $this->dispatch('/delete/3');
        $this->assertResponseStatusCode(302);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/delete');

        $this->assertRedirectTo('/');
    }

    public function testUpdateRedirectIfIdDoesNotExist()
    {
        $this->dispatch('/3', 'PUT');
        $this->assertResponseStatusCode(302);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/resource');

        $this->assertRedirectTo('/');
    }

    public function testDeleteRedirectIfIdDoesNotExist()
    {
        $this->dispatch('/3', 'DELETE');
        $this->assertResponseStatusCode(302);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/resource');

        $this->assertRedirectTo('/');
    }

    public function testCreateRedirectsAfterValidPost()
    {
        $postData = array(
            'Task' => array(
                'title' => 'Task Test',
                'description' => 'Task Test Description',
            )
        );

        $this->dispatch('/', 'POST', $postData);

        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }

    public function testUpdateRedirectsAfterValidPut()
    {
        $postData = array(
            'Task' => array(
                'title' => 'Task Test',
                'description' => 'Task Test Description',
            )
        );

        $postData = json_encode($postData);

        /** @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $request->setMethod('PUT');
        $request->setContent($postData);
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/json',
        ));
        $this->dispatch('/1');

        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }

    public function testDeleteRedirectsAfterValidDelete()
    {
        $this->dispatch('/1', 'DELETE');
        $this->assertResponseStatusCode(302);

        $this->assertControllerName('Intercon\Challenge\Task\Controller\Task');
        $this->assertControllerClass('TaskController');
        $this->assertMatchedRouteName('task/resource');

        $this->assertRedirectTo('/');
    }
}
