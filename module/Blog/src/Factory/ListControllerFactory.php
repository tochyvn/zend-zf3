<?php
// In /module/Blog/src/Factory/ListControllerFactory.php:
namespace Blog\Factory;

use Blog\Controller\ListController;
use Blog\Model\PostRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ListControllerFactory implements FactoryInterface
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
        $postRepository = $container->get(PostRepositoryInterface::class);
        //var_dump($postRepository->findAllPosts());
        return new ListController($postRepository);
    }
}