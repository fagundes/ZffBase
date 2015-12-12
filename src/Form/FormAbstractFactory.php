<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Form Abstract Factory
 * Depends of DoctrineModule
 * Depends InputFilterAbstractFactory class
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class FormAbstractFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {

        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf('Zff\Base\Form\AbstractForm')
                || $reflect->isSubclassOf('Zff\Base\Form\AbstractFieldset')
            ) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
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

            //make sure FormElementManager will create  new registered form elements
            $form->setFormFactory(new \Zend\Form\Factory($serviceLocator->get('FormElementManager')));

            return $form;
        }
        return null;
    }

    protected function getFormFilter(ServiceLocatorInterface $serviceLocator, $requestedName)
    {
        $filterName = $requestedName . 'Filter';
        if (class_exists($filterName) && $serviceLocator->has($filterName)) {
            return $serviceLocator->get($filterName);
        }
        return null;
    }
}
