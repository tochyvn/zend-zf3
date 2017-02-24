<?php
namespace Blog\Model\Abstraction;

use InvalidArgumentException;
use RuntimeException;
use Blog\Model\PostRepositoryInterface;
use Zend\Db\Adapter\AdapterInterface;

class ZendDbSqlRepository implements PostRepositoryInterface
{

	private $db;

	public function __construct(AdapterInterface $db) 
	{
		$this->db = $db;
	}

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
    }

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findPost($id)
    {
    }
}