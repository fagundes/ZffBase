<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LinkFactory implements FactoryInterface
{
    protected $options;

    public function __construct($options = null)
    {
        $this->options = $options ? : [];
    }

    /**
     * {@inheritDoc}
     *
     * @return Link
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewHelperManager = $serviceLocator->getServiceLocator() ?
            $serviceLocator->getServiceLocator()->get('ViewHelperManager') :
            null;

        $decorator = new Link($this->options);
        if ($viewHelperManager && $viewHelperManager->has('basePath')) {
            $decorator->setBasePathHelper($viewHelperManager->get('basePath'));
        }
        return $decorator;
    }
}
