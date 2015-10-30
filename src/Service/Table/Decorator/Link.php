<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table\Decorator;

class Link extends \ZfTable\Decorator\Cell\Link
{
    /**
     * @var \Zend\View\Helper\BasePath 
     */
    protected $basePathHelper;

    /**
     * @return \Zend\View\Helper\BasePath
     */
    public function getBasePathHelper()
    {
        return $this->basePathHelper;
    }

    public function setBasePathHelper(\Zend\View\Helper\BasePath $basePathHelper)
    {
        $this->basePathHelper = $basePathHelper;
    }

    public function render($context)
    {
        $values = array();
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
        if($basePathHelper) {
            $basePath = $basePathHelper();
        }
        
        $url = vsprintf($this->url, $values);
        return sprintf('<a href="%s%s">%s</a>', $basePath, $url, $context);
    }
}
