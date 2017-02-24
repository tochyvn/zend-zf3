<?php
namespace OrmDoctrine;

use Zend\Router\Http\Segment; 
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    /**     **/
    'service_manager' => [
        'aliases' => [
            
        ],
        
        'factories' => [

        ],
    ],

    /********* Configuration du controller sans parametre dans le constructeur sinon utiliser une factorie pour l'injection de dependances **********/
	'controllers' => [
        'factories' => [
            Controller\PostsController::class => InvokableFactory::class,
        ],
    ],

	'router' => [
        'routes' => [
            'posts' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/posts[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\PostsController::class,
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