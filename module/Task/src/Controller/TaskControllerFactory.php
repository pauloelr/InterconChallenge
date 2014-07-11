<?php
namespace Intercon\Challenge\Task\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TaskControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        /** @var $controllerManager \Zend\Mvc\Controller\ControllerManager; */
        $serviceManager = $controllerManager->getServiceLocator();
        /** @var \Zend\Form\FormElementManager  $formManager */
        $formManager = $serviceManager->get('FormElementManager');

        /** @var $taskMapper \Intercon\Challenge\Task\Repository\TaskRepository */
        $taskMapper = $serviceManager->get('Intercon\Challenge\Task\Mapper\TaskMapper');
        /** @var \Intercon\Challenge\Task\Form\TaskForm $taskForm */
        $taskForm = $formManager->get('Intercon\Challenge\Task\Form\TaskForm');

        return new TaskController($taskMapper, $taskForm);
    }
}
