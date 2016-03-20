<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Controller;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Controller Abstract Factory
 *
 * @package ZffBase
 * @subpackage ZffBase_Controller
 */
class ControllerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        if (class_exists($requestedName)) {
            $reflect = new \ReflectionClass($requestedName);
            if ($reflect->isSubclassOf(AbstractController::class)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function createServiceWithName(
        ServiceLocatorInterface $serviceLocator,
        $name,
        $requestedName
    ) {
    
        if ($this->canCreateServiceWithName($serviceLocator, $name, $requestedName)) {
            /**
             * @var AbstractController $controller
             */
            $reflect = new \ReflectionClass($requestedName);
            $controller = $reflect->newInstance();

            $forms = (array)$controller->getForms();
            foreach ($forms as $customFormName => $formName) {
                $this->loadObject($serviceLocator, $controller, $formName, $customFormName, 'form');
            }

            $tables = (array)$controller->getTables();
            foreach ($tables as $customTableName => $tableName) {
                $this->loadObject($serviceLocator, $controller, $tableName, $customTableName, 'table');
            }

            $services = (array)$controller->getServices();
            foreach ($services as $customServiceName => $serviceName) {
                $this->loadObject($serviceLocator, $controller, $serviceName, $customServiceName, 'service');
            }

            return $controller;
        }

        return null;
    }

    protected function loadObject(
        ServiceLocatorInterface $serviceLocator,
        AbstractController $controller,
        $objectNeededName,
        $customObjectName,
        $sufixName
    ) {
    
        $mainServiceLocator = $serviceLocator->getServiceLocator();

        if (is_int($customObjectName)) {
            $simpleObjectName = preg_replace('/(.*)\\\/', '', $objectNeededName);
        } else {
            $simpleObjectName = ucfirst($customObjectName);
        }

        $methodSet = 'set' . $simpleObjectName . ucfirst($sufixName);

        if (!method_exists($controller, $methodSet)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Expected method %s::%s, to set the %s %s.',
                    get_class($controller),
                    $methodSet,
                    $sufixName,
                    $objectNeededName
                )
            );
        }


        $objectNeeded = $mainServiceLocator->get($objectNeededName);
        call_user_func([$controller, $methodSet], $objectNeeded);
    }
}
