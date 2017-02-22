<?php
namespace Blog\Factory;

use Blog\Model\PostRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
/*use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Album\Model\Album;*/

class PostRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return PostRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        //Cree une instance de post avec sa dependance TableGatewayInterface
        return new PostRepository($container->get(TableGatewayInterface::class));
    }
}