<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * GetRoute
 * Return the current route name
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class GetRoute extends AbstractHelper
{

    /**
     * @var \Zend\Mvc\Router\RouteMatch
     */
    protected $routeMatch;

    public function getRouteMatch()
    {
        if (!$this->routeMatch) {
            $sm               = $this->getView()->getHelperPluginManager()->getServiceLocator();
            $this->routeMatch = $sm->get('Application')->getMvcEvent()->getRouteMatch();
        }
        return $this->routeMatch;
    }

    /**
     * Get name of matched route.
     * @return string
     */
    public function __invoke()
    {
        return $this->getRouteMatch()->getMatchedRouteName();
    }

}
