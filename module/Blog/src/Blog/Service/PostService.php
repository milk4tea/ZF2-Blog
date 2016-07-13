<?php

namespace Blog\Service;

use Blog\Mapper\PostMapperInterface;

/**
 * Description of PostService
 *
 * @author jeremy
 */
class PostService implements PostServiceInterface {

    protected $postMapper;

    public function __construct(PostMapperInterface $postMapper) {
        $this->postMapper = $postMapper;
    }

    public function findAllPost() {
        return $this->postMapper->findAll();
    }

    public function findPost($id) {
        return $this->postMapper->find($id);
    }

}
