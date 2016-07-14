<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Service\PostServiceInterface;
use Blog\Form\PostForm;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Blog\Model\Post;
use Blog\Model\PostInterface;

/**
 * Description of WriteController
 *
 * @author jeremy
 */
class WriteController extends AbstractActionController {
    protected $postService;
    protected $postForm;    
    protected $hydrator;
    protected $postPrototype;


    public function __construct(
            PostServiceInterface $postService,
            PostForm $postForm,
            HydratorInterface $hydrator,
            PostInterface $postPrototype
    ) {
        $this->postService = $postService;
        $this->postForm = $postForm;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
    }
    
    public function addAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $this->postForm->setData($request->getPost());
            
            if($this->postForm->isValid()) {
                try {
                    $postData = $this->postForm->getData();
                    $data = $postData['post-fieldset'];
                    $postObject = $this->hydrator->hydrate($data, $this->postPrototype);
                    $this->postService->savePost($postObject);                    
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
