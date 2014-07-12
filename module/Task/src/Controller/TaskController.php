<?php
namespace Intercon\Challenge\Task\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Intercon\Challenge\Task\Mapper\TaskMapperInterface;
use Intercon\Challenge\Task\Form\TaskForm;

class TaskController extends AbstractRestfulController
{
    private $taskMapper;
    private $taskForm;

    public function __construct(TaskMapperInterface $taskMapper, TaskForm $taskForm)
    {
        $this->taskMapper = $taskMapper;
        $this->taskForm = $taskForm;
    }

    public function getList()
    {
        return array(
            'collection' => $this->taskMapper->findBy(array(), array('status' => 'DESC')),
        );
    }

    public function create($data)
    {
        $form = $this->taskForm;
        $form->setData($data);

        if ($form->isValid()) {
            /** @var \Intercon\Challenge\Task\Entity\Task $task */
            $task = $form->getData();
            $this->taskMapper->insert($task);

            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa cadastrada com sucesso');

            return $this->redirect()->toRoute('task');
        }

        return array('form' => $form);
    }

    public function update($id, $data)
    {
        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        $form = $this->taskForm;
        $form->bind($task);
        $form->setData($data);

        if ($form->isValid()) {
            $this->taskMapper->update($task);

            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa editada com sucesso');

            return $this->redirect()->toRoute('task');
        }

        return array('form' => $form);
    }

    public function delete($id)
    {
        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        $this->taskMapper->delete($task);

        $this->flashMessenger()->setNamespace('success')
            ->addMessage('Tarefa excluída com sucesso');

        return $this->redirect()->toRoute('task');
    }

    public function addAction()
    {
        $form = $this->taskForm;
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        $form = $this->taskForm;
        $form->bind($task);

        return array('form' => $form);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        return array('id' => $id);
    }

    public function completeAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        $task->setStatus('done');
        $this->taskMapper->update($task);

        $this->flashMessenger()->setNamespace('success')
            ->addMessage('Tarefa editada com sucesso');

        return $this->redirect()->toRoute('task');
    }

    public function todoAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        /** @var \Intercon\Challenge\Task\Entity\Task $task */
        $task = $this->taskMapper->find($id);

        if (!$task) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage('Tarefa não encontrada');

            return $this->redirect()->toRoute('task');
        }

        $task->setStatus('todo');

        $this->taskMapper->update($task);
        $this->flashMessenger()->setNamespace('success')
            ->addMessage('Tarefa editada com sucesso');

        return $this->redirect()->toRoute('task');
    }
}
