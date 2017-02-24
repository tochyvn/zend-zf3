<?php
namespace Blog;

use Zend\Router\Http\Segment; 
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\TableGateway\TableGateway;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Album\Model\Album;

//use Blog\Model\Abstraction\ZendDbSqlRepository;



return [

    /**     **/
    'service_manager' => [
        'aliases' => [
            Model\PostRepositoryInterface::class => Model\Abstraction\ZendDbSqlRepository::class,
            //TableGatewayInterface::class => TableGateway::class,
        ],
        'factories' => [

            /*Model\PostRepository::class => function($container) {
                $tableGateway = $container->get(Model\AlbumTableGateway::class);
                //$adapter = $tableGateway->getAdapter();
                return new Model\PostRepository($tableGateway);
            },

            Model\AlbumTableGateway::class => function ($container) {
                $dbAdapter = $container->get(AdapterInterface::class);
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Album());
                return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
            },*/

            Model\Abstraction\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,

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
                'type' => Segment::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/blog[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
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