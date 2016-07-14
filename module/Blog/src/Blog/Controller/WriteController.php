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
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $this->postForm->setData($request->getPost());
            
            if($this->postForm->isValid()) {
                try {
                    $this->postService->savePost($this->postForm->getData());                    
                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        }
        
        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }
    
}
