<?php
namespace Intercon\Challenge\TaskTest\Entity;

use Intercon\Challenge\Task\Entity\Task;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAndGetIdReturnCorrectValues()
    {
        $task = new Task();
        $this->assertNull($task->getId());
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $task->setId(1));
        $this->assertSame(1, $task->getId());

        $this->assertNull($task->getTitle());
        $this->assertNull($task->getDescription());
        $this->assertSame($task->getStatus(), 'todo');
    }

    public function testSetAndGetTitleReturnCorrectValues()
    {
        $task = new Task();
        $this->assertNull($task->getTitle());
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $task->setTitle('test'));
        $this->assertSame('test', $task->getTitle());

        $this->assertNull($task->getId());
        $this->assertNull($task->getDescription());
        $this->assertSame($task->getStatus(), 'todo');
    }

    public function testSetAndGetDescriptionReturnCorrectValues()
    {
        $task = new Task();
        $this->assertNull($task->getDescription());
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $task->setDescription('test'));
        $this->assertSame('test', $task->getDescription());

        $this->assertNull($task->getId());
        $this->assertNull($task->getTitle());
        $this->assertSame($task->getStatus(), 'todo');
    }

    public function testSetAndGetStatusReturnCorrectValues()
    {
        $task = new Task();
        $this->assertSame($task->getStatus(), 'todo');
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $task->setStatus('done'));
        $this->assertSame('done', $task->getStatus());

        $this->assertNull($task->getId());
        $this->assertNull($task->getTitle());
        $this->assertNull($task->getDescription());
    }

}
