<?php

namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Controller\WriteController;
use Blog\Model\Post;
use Zend\Stdlib\Hydrator\ClassMethods;
/**
 * Description of WriteControllerFactory
 *
 * @author jeremy
 */
class WriteControllerFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
         $realServiceLocator = $serviceLocator->getServiceLocator();
         $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');     
         $postInsertForm     = $realServiceLocator->get('FormElementManager')->get('Blog\Form\PostForm');
         $hydrator = new ClassMethods(false);
         $postPrototype = new Post();
        return new WriteController(
                $postService,
                $postInsertForm,
                $hydrator,
                $postPrototype
        );
    }

}
