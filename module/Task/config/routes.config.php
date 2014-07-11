<?php
return array(
    'router' => array(
        'routes' => array(
            'task' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                        'controller'    => 'Task',
                        'action'        => null,
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'resource' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => ':id',
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => null,
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                    'add' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => 'add',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => 'add',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                    'edit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => 'edit/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => 'edit',
                            ),
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                    'delete' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => 'delete/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => 'delete',
                            ),
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),
                        'may_terminate' => true,
                    ),

                    'complete' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => 'complete/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => 'complete',
                            ),
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),
                        'may_terminate' => true,
                    ),

                    'todo' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => 'todo/:id',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Intercon\Challenge\Task\Controller',
                                'controller'    => 'Task',
                                'action'        => 'todo',
                            ),
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
        ),
    ),
);
