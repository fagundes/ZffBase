<?php
namespace ZffBase\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * InputFilterAbstractFactory
 * Depende do Modulo DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class InputFilterAbstractFactory implements AbstractFactoryInterface {

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {

        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf('ZffBase\Form\AbstractInputFilter')) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            $filter  = $reflect->newInstance();

            $entityManager = $serviceLocator->get($filter->getEntityManagerName());
            if ($filter instanceof \DoctrineModule\Persistence\ObjectManagerAwareInterface) {
                $filter->setObjectManager($entityManager);
            }

            $filter->initialize();
            return $filter;
        }
        return null;
    }

}
