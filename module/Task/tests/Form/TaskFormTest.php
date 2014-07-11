<?php
namespace TaskTest\Form;

use PHPUnit_Framework_TestCase;
use Intercon\Challenge\Task\Form\TaskForm;
use Intercon\Challenge\Task\Form\TaskFieldset;

class TaskFormTest extends PHPUnit_Framework_TestCase
{
    public function testFormIsConstructed()
    {
        $taskFieldset = \Mockery::mock(new TaskFieldset());

        /** @var $taskFieldset \Intercon\Challenge\Task\Form\TaskFieldset */
        $taskForm = new TaskForm($taskFieldset);

        $this->assertInstanceOf('Intercon\Challenge\Task\Form\TaskForm', $taskForm);
        $this->assertInstanceOf('Zend\Form\Fieldset', $taskForm->get('Task'));
        $this->assertInstanceOf('Zend\Form\Element\Submit', $taskForm->get('submit'));

        $this->assertEquals($taskForm->getAttribute('method'), 'post');
        $this->assertEquals($taskForm->getBaseFieldset(), $taskFieldset);
    }
}
