<?php
namespace Blog\Mapper;

use Blog\Model\PostInterface;

/**
 *
 * @author jeremy
 */
interface PostMapperInterface {
    public function find($id);
    
    public function findAll();
}
