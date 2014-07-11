<?php
namespace Intercon\Challenge\Task\Form;

use Intercon\Challenge\Task\Entity\Task;
use Intercon\Challenge\Task\Filter\TaskFilter;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TaskFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $formManager)
    {
        /** @var $formManager \Zend\Form\FormElementManager */
        /** @var \Intercon\Challenge\Task\Form\TaskFieldset $taskFieldset */
        $taskFieldset = $formManager->get('Intercon\Challenge\Task\Form\TaskFieldset');

        $taskFormFilter = new InputFilter();
        $taskFormFilter->add(new TaskFilter(), 'Task');

        $taskForm =  new TaskForm($taskFieldset);
        $taskForm->setInputFilter($taskFormFilter);
        $taskForm->bind(new Task());

        return $taskForm;
    }
}
