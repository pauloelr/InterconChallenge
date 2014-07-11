<?php
namespace Intercon\Challenge\TaskTest\Controller;

use Intercon\Challenge\Task\Controller\TaskControllerFactory;

class TaskControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServiceReturnInstanceOfTaskController()
    {
        $taskForm = \Mockery::mock('Intercon\Challenge\Task\Form\TaskForm');
        $taskMapper = \Mockery::mock('Intercon\Challenge\Task\Repository\TaskRepository');

        $formManager = \Mockery::mock('Zend\Form\FormElementManager');
        $formManager->shouldReceive('get')
            ->with('Intercon\Challenge\Task\Form\TaskForm')->once()->andReturn($taskForm);

        $serviceLocator = \Mockery::mock('Zend\ServiceManager\ServiceManager');
        $serviceLocator->shouldReceive('get')
            ->with('Intercon\Challenge\Task\Mapper\TaskMapper')->once()->andReturn($taskMapper);

        $controllerManager = \Mockery::mock('Zend\Mvc\Controller\ControllerManager');
        $controllerManager->shouldReceive('getServiceLocator')->once()->andReturn($serviceLocator);
        $serviceLocator->shouldReceive('get')->with('FormElementManager')->once()->andReturn($formManager);

        $taskControllerFactory = new TaskControllerFactory();

        /** @var $controllerManager \Zend\Mvc\Controller\ControllerManager */
        $this->assertInstanceOf(
            '\Intercon\Challenge\Task\Controller\TaskController',
            $taskControllerFactory->createService($controllerManager)
        );
    }
}
