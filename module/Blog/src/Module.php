<?php
namespace Blog;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Album\Model\Album;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements ConfigProviderInterface
{

    /******************** Ceci se faisait dans la version Zend Frameword 2 mais dans on autoload le module dans le composer.json  *********************/
    /*public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }*/

	public function getConfig() 
	{
		return include __DIR__ . '/../config/module.config.php';
	}


    /********************** Configuration de l'invocation d'une instance dynamique controller ********************************/
    /********************** CETTE SECTION EQUIVAUT A LA KEY "controller" DE L'ARRAY DU FICHIER "module.config.php   **********/
    /********************** CETTE SECTION EQUIVAUT A LA KEY "controller" DE L'ARRAY DU FICHIER "module.config.php   **********/
    
	/*public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ListController::class => function($container) {
                    return new Controller\ListController();
                },
                //Creation d'une instance de ListController avec dependances (Constructeur avec paramètres) dependance creer dans la config
                Controller\ListController::class => Factory\ListControllerFactory::class,
            ],
        ];
    }*/


    /********************** CETTE SECTION EQUIVAUT A LA KEY "service-manager" DU FICHIER "module.config.php   **********************************/
    /********************** CETTE SECTION EQUIVAUT A LA KEY "service-manager" DU FICHIER "module.config.php   **********************************/
    /********************** CETTE SECTION EQUIVAUT A LA KEY "service-manager" DU FICHIER "module.config.php   **********************************/
   
    /*public function getServiceConfig()
    {
        return [
            'factories' => [

                Model\PostRepository::class => function($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    //$adapter = $tableGateway->getAdapter();
                    return new Model\PostRepository($tableGateway);
                },

                Model\AlbumTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },

            ],
        ];
    }*/
    
    
}