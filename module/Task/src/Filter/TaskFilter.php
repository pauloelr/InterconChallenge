<?php
namespace Intercon\Challenge\Task\Filter;

use Zend\InputFilter\InputFilter;

class TaskFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'id',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'required' => false,
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
        ));

        $this->add(array(
            'name' => 'status',
            'required' => false,
        ));
    }
}
