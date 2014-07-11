<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Task' => __DIR__ . '/../view',
        ),
        'controller_map' => array(
            'Intercon\Challenge\Task' => 'task',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'task_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/../database'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Intercon\Challenge\Task\Entity' => 'task_entities'
                )
            )
        ),

        'fixture' => array(
            'task_fixture' => __DIR__ . '/../src/Fixture',
        )
    ),
);
