<?php
namespace Intercon\Challenge\Task\Form;

use Zend\Form\Form;

class TaskForm extends Form
{
    public function __construct(TaskFieldset $taskFieldset)
    {
        parent::__construct('TaskForm');
        $this->setAttribute('method', 'post');

        $taskFieldset->setName('Task');
        $taskFieldset->setUseAsBaseFieldset(true);

        $this->add($taskFieldset);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Enviar',
                'id' => 'submit',
            ),
        ));
    }
}
