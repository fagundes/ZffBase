<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
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

    /**
     * @inheritdoc
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf(AbstractInputFilter::class)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            $filter  = $reflect->newInstance();

            $entityManager = $serviceLocator->get($filter->getEntityManagerName());
            if ($filter instanceof ObjectManagerAwareInterface) {
                $filter->setObjectManager($entityManager);
            }

            //make sure FilterManager will create new registered InputFilters, Filters and validators
            $filter->setFactory(new InputFilterFactory($serviceLocator->get('InputFilterManager')));

            $filter->initialize();
            return $filter;
        }
        return null;
    }
}
