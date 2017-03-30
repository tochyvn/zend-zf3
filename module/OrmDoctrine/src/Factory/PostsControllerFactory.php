<?php
// In /module/Blog/src/Factory/ListControllerFactory.php:
namespace OrmDoctrine\Factory;

use OrmDoctrine\Controller\PostsController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostsControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container permet de recuperer des service <=> au Service manager
     * @param string $requestedName
     * @param null|array $options
     * @return ListController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
    	//We want to register the service PostRepositoryInterface before use it below (register it in module.config.php)
        return new PostsController($container->get('doctrine.entitymanager.orm_default'));
    }
}