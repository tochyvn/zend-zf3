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
			"MD5(CONCAT('staticSalt', ?, password_salt))"
			//'MD5(?)'
		);
		/** Test d'insertion **/
		//$this->configAuthAdapter();
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
		$salt = random_bytes(32);
		
		return [
			'auth' => $result,
			'user' => $this->authAdapter->getResultRowObject(), //ou $this->authAdapter->getResultRowObject(null, $columnToOmit)
			'random' => $salt//\Zend\Math\Rand::getBytes(32, true)
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

		/*$sqlCreate = 'CREATE TABLE `users` ('
		    . ' `id` INTEGER AUTO_INCREMENT PRIMARY KEY, '
		    . ' `username` VARCHAR(50) UNIQUE NOT NULL, '
		    . ' `password` VARCHAR(32) NULL, '
		    . ' `real_name` VARCHAR(150) NULL,'
		    . ' `active` BOOLEAN DEFAULT FALSE)';*/

		
		$salt = \Zend\Math\Rand::getBytes(32, true);
		$sqlInsert = "INSERT INTO `users` (`username`, `password`, `real_name`, `status`, `active`, `password_salt`) "
		    . "VALUES ('my_username', MD5('my_password'), 'My Real Name', 'N/A', '1','" . utf8_encode($salt) . "')";

		//Insert the data
		var_dump($this->adapter->query($sqlInsert, \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE));
		
	}


}