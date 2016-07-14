<?php
namespace Blog\Mapper;

use Blog\Model\PostInterface;

/**
 *
 * @author jeremy
 */
interface PostMapperInterface {
    
    /**
     * 
     * @param int|string $id
     * @return PostInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);
    
    
    /**
     * 
     * @return array|Postinterface[]
     */
    public function findAll();
    
    /**
     * 
     * @param PostInterface $postObject
     * @return PostInterface
     * @throws \Exception
     */
    public function save(PostInterface $postObject);
    
    
    /**
     * 
     * @param PostInterface $postObject
     * 
     * @return bool
     * @throws \Exception
     */
    public function delete(PostInterface $postObject);
}
