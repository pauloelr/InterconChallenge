<?php
namespace Intercon\Challenge\TaskTest\Form;

use Intercon\Challenge\Task\Form\TaskFieldsetFactory;

class TaskFieldsetFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServiceReturnInstanceOfLabelFieldset()
    {
        $doctrineManager = \Mockery::mock('Doctrine\Common\Persistence\ObjectManager');

        $serviceLocator = \Mockery::mock('Zend\ServiceManager\ServiceManager');
        $serviceLocator->shouldReceive('get')->with('Doctrine\ORM\EntityManager')->once()->andReturn($doctrineManager);

        $formManager = \Mockery::mock('Zend\Form\FormElementManager');
        $formManager->shouldReceive('getServiceLocator')->once()->andReturn($serviceLocator);

        $taskFormFactory = new TaskFieldsetFactory();

        /** @var $formManager \Zend\Form\FormElementManager */
        $this->assertInstanceOf(
            '\Intercon\Challenge\Task\Form\TaskFieldset',
            $taskFormFactory->createService($formManager)
        );
    }
}
