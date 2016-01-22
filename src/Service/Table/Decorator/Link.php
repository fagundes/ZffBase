<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

use Zend\View\Helper\BasePath;

/**
 * Class Link
 * @todo move decorator to ZffTable
 */
class Link extends \ZfTable\Decorator\Cell\Link
{
    /**
     * @var BasePath
     */
    protected $basePathHelper;

    /**
     * @return BasePath
     */
    public function getBasePathHelper()
    {
        return $this->basePathHelper;
    }

    /**
     * @param BasePath $basePathHelper
     */
    public function setBasePathHelper(BasePath $basePathHelper)
    {
        $this->basePathHelper = $basePathHelper;
    }

    /**
     * {@inheritDoc}
     */
    public function render($context)
    {
        $values = [];
        if (count($this->vars)) {
            $actualRow = $this->getCell()->getActualRow();
            foreach ($this->vars as $var) {
                if (is_object($actualRow)) {
                    $method   = 'get' . ucfirst($var);
                    $values[] = $actualRow->$method();
                } else {
                    $values[] = $actualRow[$var];
                }
            }
        }
        
        $basePath = '';
        $basePathHelper = $this->getBasePathHelper();
        if ($basePathHelper) {
            $basePath = $basePathHelper();
        }
        
        $url = vsprintf($this->url, $values);
        return sprintf('<a href="%s%s">%s</a>', $basePath, $url, $context);
    }
}
