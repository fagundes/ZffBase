<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ServiceAbstractFactory
 *
 * AbstractFactory para todas as Services que
 * herdam de Zff\Base\Service\AbstractService.
 *
 * @package ZffBase
 * @subpackage ZffBase_Service
 */
class ServiceAbstractFactory implements AbstractFactoryInterface
{

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf('Zff\Base\Service\AbstractService')) {
                return true;
            }
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            $service = $reflect->newInstance();

            $entityManager = $serviceLocator->get($service->getEntityManagerName());
            $service->setEntityManager($entityManager);

            $services = (array) $service->getServices();
            foreach ($services as $customServiceName => $serviceName) {
                $this->loadService($serviceLocator, $service, $serviceName, $customServiceName);
            }

            return $service;
        }
        return null;
    }

    protected function loadService(ServiceLocatorInterface $serviceLocator, AbstractService $service, $serviceNeededName, $customServiceName)
    {
        if (is_int($customServiceName)) {
            $simpleServiceName = preg_replace('/(.*)\\\/', '', $serviceNeededName);
        } else {
            $simpleServiceName = ucfirst($customServiceName);
        }

        $methodSet = 'set' . $simpleServiceName . 'Service';

        if (!method_exists($service, $methodSet)) {
            throw new \InvalidArgumentException(sprintf('Espera-se o metodo %s::%s, para carregar o serviço %s.', get_class($service), $methodSet, $serviceNeededName));
        }

        $serviceNeeded = $serviceLocator->get($serviceNeededName);
        call_user_method($methodSet, $service, $serviceNeeded);
    }

}
