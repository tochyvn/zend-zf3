<?php
namespace Authentification\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Authentification\Controller\AuthController;
use Zend\Db\Adapter\AdapterInterface;


class AuthControllerFactory implements FactoryInterface 
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {

		return new AuthController($container->get(AdapterInterface::class));
	}
}