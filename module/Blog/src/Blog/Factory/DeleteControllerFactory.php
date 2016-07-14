<?php

namespace Blog\Factory;

use Blog\Controller\DeleteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of DeleteControllerFactory
 *
 * @author jeremy
 */
class DeleteControllerFactory implements FactoryInterface {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService = $realServiceLocator->get('Blog\Service\PostServiceInterface');
        
        return new DeleteController($postService);
    }
}
