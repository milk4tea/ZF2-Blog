<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;
use Zend\View\Model\ViewModel;

/**
 * Description of ListController
 *
 * @author jeremy
 */
class ListController extends AbstractActionController {

    protected $postService;

    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }

    public function indexAction() {

        return new ViewModel(array(
            'posts' => $this->postService->findAllPost()
        ));
    }
    
    public function detailAction() {
        
        $id = $this->params()->fromRoute('id');
        
        try {
            $post = $this->postService->findPost($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('blog');
        }
        
        return new ViewModel(
            array('post' => $post)
        );
    }

}
