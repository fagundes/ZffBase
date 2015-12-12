<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

use ZfTable\Decorator\Exception;

class Partial extends \ZfTable\Decorator\Cell\AbstractCellDecorator
{

    /**
     * @var string
     */
    protected $partialName;

    /**
     * @var \Zend\View\Helper\Partial
     */
    protected $partialHelper;

    /**
     * Changes the record var on the alias to this attribute
     * @var string
     */
    protected $aliasRecord;

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['partial'])) {
            throw new Exception\InvalidArgumentException('Partial key in options argument required');
        }

        $this->partialName = $options['partial'];

        $this->aliasRecord = isset($options['aliasRecord']) ? $options['aliasRecord'] : 'record';
    }

    /**
     * @return \Zend\View\Helper\Partial
     */
    public function getPartialHelper()
    {
        return $this->partialHelper;
    }

    public function setPartialHelper(\Zend\View\Helper\Partial $partialHelper)
    {
        $this->partialHelper = $partialHelper;
    }

    public function render($context)
    {
        $partialHelper = $this->getPartialHelper();

        return $partialHelper($this->partialName, [
            $this->aliasRecord => $this->getActualRow(),
            'context'          => $context
        ]);
    }
}
