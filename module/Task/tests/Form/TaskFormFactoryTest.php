<?php
namespace Intercon\Challenge\TaskTest\Form;

use Intercon\Challenge\Task\Form\TaskFieldset;
use Intercon\Challenge\Task\Form\TaskFormFactory;

class TaskFormFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServiceReturnInstanceOfTaskForm()
    {
        $taskFieldset = \Mockery::mock(new TaskFieldset());

        $formManager = \Mockery::mock('Zend\Form\FormElementManager');
        $formManager->shouldReceive('get')
            ->with('Intercon\Challenge\Task\Form\TaskFieldset')->once()->andReturn($taskFieldset);

        $taskFormFactory = new TaskFormFactory();

        /** @var $formManager \Zend\Form\FormElementManager */
        $this->assertInstanceOf(
            '\Intercon\Challenge\Task\Form\TaskForm',
            $taskFormFactory->createService($formManager)
        );
    }
}
