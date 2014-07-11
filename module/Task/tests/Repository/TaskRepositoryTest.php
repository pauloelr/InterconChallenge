<?php
namespace Intercon\Challenge\TaskTest\Repository;

use Doctrine\ORM\Mapping\ClassMetadata;
use Intercon\Challenge\Task\Repository\TaskRepository;
use Intercon\Challenge\Task\Entity\Task;

class TaskRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validTasks
     */
    public function testInsertWithValidData(Task $task)
    {
        $entityManager = \Mockery::mock('Doctrine\ORM\EntityManager');
        $entityManager->shouldReceive('persist')->with($task)->andReturn(null);
        $entityManager->shouldReceive('flush')->with($task)->andReturn(null);

        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $taskRepository = new TaskRepository($entityManager, new ClassMetadata('Intercon\Challenge\Task\Entity\Task'));
        $returnedTask = $taskRepository->insert($task);

        $this->assertEquals($task, $returnedTask);
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $returnedTask);
    }

    /**
     * @dataProvider validTasks
     */
    public function testUpdateWithValidData(Task $task)
    {
        $entityManager = \Mockery::mock('Doctrine\ORM\EntityManager');
        $entityManager->shouldReceive('flush')->with($task)->andReturn(null);

        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $taskRepository = new TaskRepository($entityManager, new ClassMetadata('Intercon\Challenge\Task\Entity\Task'));
        $returnedTask = $taskRepository->update($task);

        $this->assertEquals($task, $returnedTask);
        $this->assertInstanceOf('Intercon\Challenge\Task\Entity\Task', $returnedTask);
    }

    /**
     * @dataProvider validTasks
     */
    public function testDelete(Task $task)
    {
        $entityManager = \Mockery::mock('Doctrine\ORM\EntityManager');
        $entityManager->shouldReceive('remove')->with($task)->andReturn(null);
        $entityManager->shouldReceive('flush')->with($task)->andReturn(null);

        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $taskRepository = new TaskRepository($entityManager, new ClassMetadata('Intercon\Challenge\Task\Entity\Task'));
        $taskRepository->delete($task);
    }

    public function validTasks()
    {
        $task = new Task();
        $task->setId(1);
        $task->setTitle('Test');
        $task->setDescription('Test');
        $task->setStatus('done');

        return array(array($task));
    }
}
