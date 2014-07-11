<?php

namespace Intercon\Challenge\Task\Repository;

use Doctrine\ORM\EntityRepository;
use Intercon\Challenge\Task\Entity\Task;
use Intercon\Challenge\Task\Mapper\TaskMapperInterface;

class TaskRepository extends EntityRepository implements TaskMapperInterface
{
    /**
     * Insert the Task
     *
     * @param Task $task
     * @return Task
     */
    public function insert(Task $task)
    {
        $this->_em->persist($task);
        $this->_em->flush($task);

        return $task;
    }

    /**
     * Update the category
     *
     * @param Task $task
     * @return Task
     */
    public function update(Task $task)
    {
        $this->_em->flush($task);
        return $task;
    }

    /**
     * Delete the category
     *
     * @param Task $task
     * @return void
     */
    public function delete(Task $task)
    {
        $this->_em->remove($task);
        $this->_em->flush($task);
    }
}
