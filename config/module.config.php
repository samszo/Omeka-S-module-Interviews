<?php
declare(strict_types=1);

// Declaring modules namespace here.  Allows us to automatically reference classes in the 
// src folder of our module with path-names relative to the src folder. 
namespace Interviews;

// Referencing these classes permits us to reference them by name without the full path. 
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'site' => [
                'child_routes' => [
                    'interviews' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/interviews[/:action]',
                            'defaults' => [
                                '__NAMESPACE__' => 'Interviews\Controller',
                                'controller' => Controller\SalutController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    // New Route: used to generate links, among other things.
                    'interviewssalut' => [
                        'type' => Literal::class, // exact match of URI path
                        'options' => [
                            'route' => '/interviews/salut', // URI path
                            'defaults' => [
                                '__NAMESPACE__' => 'Interviews\Controller',
                                'controller' => Controller\SalutController::class, // unique name
                                'action'     => 'salut',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        // Tell the application how to instantiate our controller class
        'factories' => [
            // Add the HelloController class to the array of invokable controllers. 
            Controller\SalutController::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
];