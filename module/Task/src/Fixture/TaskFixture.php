<?php
namespace Intercon\Challenge\Task\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Intercon\Challenge\Task\Entity\Task;

class TaskFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $task = new Task();
        $task->setTitle('Criar a Aplicação');
        $task->setDescription('Criar a Aplicação para o interconPHP');
        $task->setStatus('done');

        $manager->persist($task);
        $manager->flush();

        $task = new Task();
        $task->setTitle('Apresentar a Aplicação');
        $task->setDescription('Apresentar a Aplicação com Zend Framework 2');
        $task->setStatus('todo');

        $manager->persist($task);
        $manager->flush();
    }
}
