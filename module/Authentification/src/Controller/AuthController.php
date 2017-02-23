<?php
namespace Authentification\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;

class AuthController extends AbstractActionController 
{
	private $authAdapter;
	private $adapter;

	public function __construct(AdapterInterface $adapter) 
	{
		$this->adapter = $adapter;

		$this->authAdapter = new AuthAdapter(
			$adapter,
			'users',
			'username',
			'password',
			'MD5(?)'
		);

		//var_dump($this->authAdapter);
		
	}

	public function indexAction() 
	{
		$param = [
			'username' => 'my_username',
			'password' => 'my_password'
		];

		$this->authAdapter->setIdentity($param['username'])
					->setCredential($param['password']);

		$select = $this->authAdapter->getDbSelect();
		$select->where('active = "1"');

		$result = $this->authAdapter->authenticate();

		//Here specify column you wish to for giving max security
		$columnsToReturn = [
			'id',
			'username',
			'real_name',
		];

		$columnToOmit = ['password'];

		return [
			'auth' => $result,
			'user' => $this->authAdapter->getResultRowObject() //ou $this->authAdapter->getResultRowObject(null, $columnToOmit)
		];
	}

	public function loginAction() 
	{

	}

	public function registerAction() 
	{

	}

	/**
	* Execute this function to create table user and inserted data if doesn't exist
	*/
	private function configAuthAdapter() {

		$sqlCreate = 'CREATE TABLE `users` ('
		    . ' `id` INTEGER AUTO_INCREMENT PRIMARY KEY, '
		    . ' `username` VARCHAR(50) UNIQUE NOT NULL, '
		    . ' `password` VARCHAR(32) NULL, '
		    . ' `real_name` VARCHAR(150) NULL,'
		    . ' `active` BOOLEAN DEFAULT FALSE)';

		$this->adapter->query($sqlCreate);

		$sqlInsert = "INSERT INTO `users` (`username`, `password`, `real_name`) "
		    . "VALUES ('my_username', 'my_password', 'My Real Name')";

		// Insert the data
		$this->adapter->query($sqlInsert);
	}


}