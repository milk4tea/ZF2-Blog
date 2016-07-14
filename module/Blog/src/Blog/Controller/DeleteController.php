<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;
use Zend\View\Model\ViewModel;

/**
 * Description of DeleteController
 *
 * @author jeremy
 */
class DeleteController extends AbstractActionController{
    protected $postService;
    
    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }
    
    public function deleteAction() {
        try {
            $post = $this->postService->findPost($this->params('id'));
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('blog');
        }
        
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if($del === 'yes') {
                $this->postService->deletePost($post);
            }
            
            return $this->redirect()->toRoute('blog');
        }
        
        return new ViewModel(array(
            'post' => $post
        ));
    }
    
}
