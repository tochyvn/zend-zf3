<?php
namespace Blog;

use Zend\Router\Http\Literal; 
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\TableGateway\TableGateway;

// use Album\Model\AlbumTable;
// use Zend\Db\Adapter\AdapterInterface;
// use Zend\Db\ResultSet\ResultSet;
// use Zend\Db\TableGateway\TableGateway;

return [

    /**     **/
    'service_manager' => [
        'aliases' => [
            Model\PostRepositoryInterface::class => Model\PostRepository::class,
            //TableGatewayInterface::class => TableGateway::class,
        ],
        'factories' => [
            //Model\PostRepository::class => InvokableFactory::class,
           //Model\PostRepository::class => Factory\PostRepositoryFactory::class,
        ],
    ],


    /********* Configuration du controller sans parametre dans le constructeur sinon utiliser une factorie pour l'injection de dependances **********/
	'controllers' => [
        'factories' => [
            /**** Invokable without paramters into constructor (use the default constructor) ******/
            //Controller\ListController::class => InvokableFactory::class,

            /**** Before do this, create the Factory ListControllerFactory ******/
            Controller\ListController::class => Factory\ListControllerFactory::class,
        ],
    ],

	'router' => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'blog' => [
                // Define a "literal" route type:
                'type' => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/blog',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\ListController::class,
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