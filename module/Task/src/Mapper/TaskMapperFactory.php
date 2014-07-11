<?php
namespace Intercon\Challenge\Task\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TaskMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
        return $entityManager->getRepository('Intercon\Challenge\Task\Entity\Task');
    }
}
