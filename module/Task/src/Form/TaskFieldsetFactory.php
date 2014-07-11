<?php
namespace Intercon\Challenge\Task\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TaskFieldsetFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $formManager)
    {
        /** @var $formManager \Zend\Form\FormElementManager */
        $serviceManager = $formManager->getServiceLocator();
        /** @var $objectManager \Doctrine\Common\Persistence\ObjectManager */
        $objectManager = $serviceManager->get('Doctrine\ORM\EntityManager');

        $taskFieldset = new TaskFieldset();
        $taskHydrator = new DoctrineHydrator($objectManager, 'Intercon\Challenge\Task\Entity\Task');
        $taskFieldset->setHydrator($taskHydrator);

        return $taskFieldset;
    }
}
