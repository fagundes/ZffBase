<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PartialFactory implements FactoryInterface
{

    protected $options;

    public function __construct($options = null)
    {
        $this->options = $options ? : [];
    }

    /**
     * {@inheritDoc}
     *
     * @return Partial
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewHelperManager = $serviceLocator->getServiceLocator() ? $serviceLocator->getServiceLocator()->get('ViewHelperManager') : null;
        $decorator   = new Partial($this->options);
        if (!$viewHelperManager || !$viewHelperManager->has('partial')) {
            throw new \Zend\ServiceManager\Exception\ServiceNotCreatedException('Partial Helper couldn\'t be created!');
        }
        $decorator->setPartialHelper($viewHelperManager->get('partial'));
        return $decorator;
    }

}
