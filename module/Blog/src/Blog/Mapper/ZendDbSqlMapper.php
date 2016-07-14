<?php
namespace Blog\Mapper;

 use Blog\Model\PostInterface;
 use Zend\Db\Adapter\AdapterInterface;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\HydratingResultSet;
 use Zend\Stdlib\Hydrator\HydratorInterface;
 use Zend\Db\Sql\Insert;
 use Zend\Db\Sql\Update;
 use Zend\Db\Sql\Delete;
 
/**
 * Description of ZendDbSqlMapper
 *
 * @author jeremy
 */
class ZendDbSqlMapper implements PostMapperInterface {
    protected $dbAdapter;
    protected $hydrator;
    protected $postPrototype;

    /**
     * 
     * @param AdapterInterface $dbAdapter
     * @param HydratorInterface $hydrator
     * @param PostInterface $postPrototype
     */
    public function __construct(
            AdapterInterface $dbAdapter,
            HydratorInterface $hydrator,
            PostInterface $postPrototype
    ) {
        $this->dbAdapter = $dbAdapter;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
    }

    /**
     * 
     * @param inst|string  $id
     * 
     * @return PostInterface
     * @throws \InvalidArgumentException
     */
    public function find($id) {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select('posts');
        $select->where(array('id = ?' => $id));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        
        if($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->postPrototype);
        }
        
        throw new \InvalidArgumentException("Blog with given ID:{$id} not found.");
    }

    /**
     * 
     * @return array|PostInterface[]
     */
    public function findAll() {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select('posts');
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        
        if($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    
    /**
     * 
     * @param PostInterface $postObject
     * 
     * @return PostInterface
     * @throws \Exception
     */
    public function save(PostInterface $postObject) {
        $postData = $this->hydrator->extract($postObject);
        unset($postData['id']);
        
        if($postObject->getId()) {
            $action = new Update('posts');
            $action->set($postData);
            $action->where(array('id = ?' => $postObject->getId()));
        } else {
            $action = new Insert('posts');
            $action->values($postData);
        }
        
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();
        
        if($result instanceof ResultInterface) {
            if($newId = $result->getGeneratedValue()) {
                $postObject->setId($newId);
            }
            
            return $postObject;
        }
        
        throw new \Exception("Database error");
    }

    public function delete(PostInterface $postObject) {
        $action = new Delete();
        $action->where(array('id = ?' => $postObject->getId()));
        
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($sql);
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
        
    }

}
