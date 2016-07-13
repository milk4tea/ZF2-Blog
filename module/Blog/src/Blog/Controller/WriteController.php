<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;
use Blog\Form\PostForm;
use Zend\View\Model\ViewModel;

/**
 * Description of WriteController
 *
 * @author jeremy
 */
class WriteController extends AbstractActionController {
    protected $postService;
    protected $postForm;
    
    public function __construct(
            PostServiceInterface $postService,
            PostForm $postForm
    ) {
        $this->postService = $postService;
        $this->postForm = $postForm;
    }
    
    public function addAction() {
        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }
    
}
