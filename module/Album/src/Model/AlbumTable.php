<?php
namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class AlbumTable
{
    private $tableGateway;
    private $adapter;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->adapter = $tableGateway->getAdapter();
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getAlbum($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = [
            'artist' => $album->artist,
            'title'  => $album->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getAlbum($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }


    public function testQuery() 
    {
        $selectString = "Select * from album";
        $adapter = $this->tableGateway->getAdapter();
        var_dump($adapter->query("select * from album"));
        return $adapter;
    }

    public function getAdapter() 
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select()->from('album');
        $select->where(array('title' => '<script>alert(\'tochap\');</script>'));
        
        /*$statement = $sql->prepareStatementForSqlObject($select);
        $statement->execute();*/
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $rowSet = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $results = array();
        foreach ($rowSet as $key => $row) {
            $results[] = array(
                'id' => $row->id,
                'title' => $row->title,
                'artist' => $row->artist
            );
        }

        return $rowSet;
    }
}