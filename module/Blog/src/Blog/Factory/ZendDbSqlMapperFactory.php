<?php
namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Mapper\ZendDbSqlMapper;
use Blog\Model\Post;
use Zend\Stdlib\Hydrator\ClassMethods;
/**
 * Description of ZendDbSqlMapperFactory
 *
 * @author jeremy
 */
class ZendDbSqlMapperFactory implements FactoryInterface{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new ZendDbSqlMapper(
                $serviceLocator->get('Zend\Db\Adapter\Adapter'),
                new ClassMethods(false),
                new Post()
        );
    }

}
