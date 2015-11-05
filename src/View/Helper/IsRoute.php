<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * IsRoute
 * Check if a route is the matched route.
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class IsRoute extends AbstractHelper
{

    /**
     * If $routeName is given, then check if $routeName is equal the matched route name.
     * If so $returnTrue otherwise $returnFalse
     *
     * Case $routeName not be given returns the object instance.
     *
     * @param string $routeName route name to be checked
     * @param mixed $returnTrue the return value if the check is true
     * @param mixed $returnFalse the return value if the chedk is false
     * @return mixed|IsRoute $returnTrue, $returnFalse or IsRoute
     */
    public function __invoke($routeName=null, $returnTrue = true, $returnFalse = false)
    {
        /* @var Zff\Base\View\Helper\GetRoute */
        $getRoute         = $this->getView()->getRoute();
        $matchedRouteName = $getRoute();

        if ($routeName) {
            return $matchedRouteName == $routeName ? $returnTrue : $returnFalse;
        }
        return $this;
    }

}
