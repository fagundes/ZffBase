<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * InputFilter Abstract Factory
 * Depends of DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class InputFilterAbstractFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {

        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf('Zff\Base\Form\AbstractInputFilter')) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            $filter  = $reflect->newInstance();

            $entityManager = $serviceLocator->get($filter->getEntityManagerName());
            if ($filter instanceof \DoctrineModule\Persistence\ObjectManagerAwareInterface) {
                $filter->setObjectManager($entityManager);
            }

            //make sure FilterManager will create new registered InputFilters, Filters and validators
            $filter->setFactory(new \Zend\InputFilter\Factory($serviceLocator->get('InputFilterManager')));

            $filter->initialize();
            return $filter;
        }
        return null;
    }
}
