<?php
namespace Zff\Base\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * FormAbstractFactory
 * Depende do Modulo DoctrineModule
 * Depende da classe InputFilterAbstractFactory
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Form
 */
class FormAbstractFactory implements AbstractFactoryInterface {

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {

        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf('Zff\Base\Form\AbstractForm')) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            $form    = $reflect->newInstance();
            $filter  = $this->getFormFilter($serviceLocator, $requestedName);

            if ($filter) {
                $form->setInputFilter($filter);
            }

            $entityManager = $serviceLocator->get($form->getEntityManagerName());
            $form->loadHydrator($entityManager);

            if ($form instanceof \DoctrineModule\Persistence\ObjectManagerAwareInterface) {
                $form->setObjectManager($entityManager);
            }

            return $form;
        }
        return null;
    }

    protected function getFormFilter(ServiceLocatorInterface $serviceLocator, $requestedName) {
        $filterName = $requestedName . 'Filter';
        if (class_exists($filterName)) {
            return $serviceLocator->get($filterName);
        }
        return null;
    }

}
