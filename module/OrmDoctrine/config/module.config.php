<?php
namespace OrmDoctrine;

use Zend\Router\Http\Segment; 
use Zend\ServiceManager\Factory\InvokableFactory;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],

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
            //Controller\PostsController::class => InvokableFactory::class,

            Controller\PostsController::class => Factory\PostsControllerFactory::class,
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