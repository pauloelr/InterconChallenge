<?php
namespace Intercon\Challenge\TaskTest\Form;

use PHPUnit_Framework_TestCase;
use Intercon\Challenge\Task\Entity\Status;
use Intercon\Challenge\Task\Entity\Type;
use Intercon\Challenge\Task\Form\TaskFieldset;

class TaskFieldsetTest extends PHPUnit_Framework_TestCase
{
    public function testFieldsetIsConstructed()
    {
        $taskFieldset = new TaskFieldset();

        $this->assertInstanceOf('Intercon\Challenge\Task\Form\TaskFieldset', $taskFieldset);
        $this->assertInstanceOf('Zend\Form\Element\Hidden', $taskFieldset->get('id'));
        $this->assertInstanceOf('Zend\Form\Element\Text', $taskFieldset->get('title'));
        $this->assertInstanceOf('Zend\Form\Element\Textarea', $taskFieldset->get('description'));
    }
}
