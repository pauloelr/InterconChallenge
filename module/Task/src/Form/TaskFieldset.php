<?php
namespace Intercon\Challenge\Task\Form;

use Zend\Form\Fieldset;

class TaskFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('TaskFieldset');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'options' => array('label' => 'Titulo'),
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array('label' => 'Descrição'),
        ));
    }
}
