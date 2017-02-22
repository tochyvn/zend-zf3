<?php
namespace Blog\Model;

use DomainException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
// use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGatewayInterface;

class PostRepository implements PostRepositoryInterface
{

    private $tableGateway;
    private $adapter;

    public function __construct(TableGatewayInterface $tableGateway) 
    {
        $this->tableGateway = $tableGateway;
        $this->adapter = $tableGateway->getAdapter();
        //var_dump($tableGateway->getAdapter());
    }

	private $data = [
        1 => [
            'id'    => 1,
            'title' => 'Hello World #1',
            'text'  => 'This is our first blog post!',
        ],
        2 => [
            'id'    => 2,
            'title' => 'Hello World #2',
            'text'  => 'This is our second blog post!',
        ],
        3 => [
            'id'    => 3,
            'title' => 'Hello World #3',
            'text'  => 'This is our third blog post!',
        ],
        4 => [
            'id'    => 4,
            'title' => 'Hello World #4',
            'text'  => 'This is our fourth blog post!',
        ],
        5 => [
            'id'    => 5,
            'title' => 'Hello World #5',
            'text'  => 'This is our fifth blog post!',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        return array_map(function($post) {
        	return new Post(
        		$post['title'],
        		$post['text'],
        		$post['id']
        	);

        }, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function findPost($id)
    {
        if (! isset($this->data[$id])) {
        	throw new DomainException(sprintf('Post by id "%s" not found!!!!!!', $id));
        }

        $post = $this->data[$id];

        return new Post(
        	$post['title'],
        	$post['text'],
        	$post['id']
        );
    }

    public function toch() {
        return $this->tableGateway->select();
    }

    public function findAllAlbums($int) 
    {
        $int = (int) $int;
        $sql = "SELECT * FROM Album";
        $query = $this->adapter->query($sql, Adapter::QUERY_MODE_EXECUTE);

        return $query;
    }

    public function findAlbumById($int) 
    {
        $int = (int) $int;
        $sql = "SELECT * FROM Album WHERE id = ?";

        /** PreparedStatement optimal for multi-querying **/
        //$query = $this->adapter->query($sql, array($int));

        /** PreparedStatement optimal for multi-querying **/
        $statement = $this->adapter->createStatement($sql, array($int));
        //var_dump($statement);
        $query = $statement->execute();

        $query = $query->current();

        return $query;
    }


    public function saveAlbum($data) 
    {
        $sql = "INSERT INTO album VALUES (null, ?, ?)";
        $param = array(
            $data['artist'],
            $data['title']
        );
        $query = $this->adapter->query($sql, $param);
    }

}
