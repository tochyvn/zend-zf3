<?php
namespace Blog\Model\Abstraction;

use InvalidArgumentException;
use RuntimeException;
use Blog\Model\PostRepositoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Blog\Model\Post;
use Zend\Hydrator\Reflection;

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
        $sql    = new Sql($this->db);
        $select = $sql->select('posts');
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (! $result instanceof ResultInterface && ! $result->isQueryResult()) {
            return [];
        }
       
        $resultSet = new HydratingResultSet(
            new Reflection(),
            new Post('', '')
        );
        $resultSet->initialize($result);

        return $resultSet;
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