<?php

return array(
    'service_manager'=>array(
        'factories' => array(
            'Intercon\Challenge\Task\Mapper\TaskMapper' => 'Intercon\Challenge\Task\Mapper\TaskMapperFactory',
        ),
    ),
    'form_elements'=>array(
        'factories' => array(
            'Intercon\Challenge\Task\Form\TaskFieldset' => 'Intercon\Challenge\Task\Form\TaskFieldsetFactory',
            'Intercon\Challenge\Task\Form\TaskForm' => 'Intercon\Challenge\Task\Form\TaskFormFactory',
        ),
    ),
    'controllers'=>array(
        'factories' => array(
            'Intercon\Challenge\Task\Controller\Task' => 'Intercon\Challenge\Task\Controller\TaskControllerFactory',
        ),
    ),
);
