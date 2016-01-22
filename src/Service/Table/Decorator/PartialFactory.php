<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PartialFactory
 * @todo move decorator to ZffTable
 */
class PartialFactory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * PartialFactory constructor.
     * @param array|null $options
     */
    public function __construct($options = null)
    {
        $this->options = $options ?: [];
    }

    /**
     * {@inheritDoc}
     *
     * @return Partial
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewHelperManager = $serviceLocator->getServiceLocator() ?
            $serviceLocator->getServiceLocator()->get('ViewHelperManager') :
            null;

        $decorator = new Partial($this->options);
        if (!$viewHelperManager || !$viewHelperManager->has('partial')) {
            throw new ServiceNotCreatedException('Partial Helper couldn\'t be created!');
        }
        $decorator->setPartialHelper($viewHelperManager->get('partial'));
        return $decorator;
    }
}
