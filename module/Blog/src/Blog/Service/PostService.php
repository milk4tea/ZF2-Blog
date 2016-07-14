<?php

namespace Blog\Service;

use Blog\Mapper\PostMapperInterface;
use Blog\Model\PostInterface;

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

    public function savePost(PostInterface $blog) {
        return $this->postMapper->save($blog);
    }

    public function deletePost(PostInterface $blog) {
        return $this->postMapper->delete($post);
    }

}
