<?php
namespace Intercon\Challenge\Task\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use Intercon\Challenge\Task\Entity\Task;

interface TaskMapperInterface extends ObjectRepository
{
    /**
     * @param Task $task
     * @return Task
     */
    public function insert(Task $task);

     /**
     * @param Task $task
     * @return Task
     */
    public function update(Task $task);

     /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task);
}
