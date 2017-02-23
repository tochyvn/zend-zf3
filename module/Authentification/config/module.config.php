<?php
namespace Authentification;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

	'controllers' => [

        /*'factories' => [
            Controller\AuthController::class => InvokableFactory::class,
        ],*/

        'factories' => [
            Controller\AuthController::class => Factory\AuthControllerFactory::class,
        ],

    ],

	'router' => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'authentification' => [
                // Define a "literal" route type:
                'type' => Segment::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/authentification[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],


    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

];