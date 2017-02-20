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
    	

    	/*$dbAdapter = $container->get(AdapterInterface::class);
    	$resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Album());
        $tableGateway = new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
    	var_dump($tableGateway);*/

    	//We want to register the service PostRepositoryInterface before use it below (register it in module.config.php)
        return new PostRepository($container->get(TableGatewayInterface::class));
    }
}