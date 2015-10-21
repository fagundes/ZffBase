<?php

namespace Zff\Base\View\Helper;

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

use Zend\View\Helper\AbstractHelper;

/**
 * GetRoute
 * Verfica se a rota atual é igual a rota passada.
 *
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class GetRoute extends AbstractHelper {

    /**
     * Se $routeName é fornecido, então verfica se a rota atual é igual $routeName
     * e retorna um dentre dois valores possíveis. Caso positivo retorna
     * $returnTrue, caso contrario retorna $returnFalse.
     *
     * Caso $routeName não seja fornecido retorna então a rota atual.
     *
     * @param string $routeName Rota a ser verificada
     * @param mixed $returnTrue Valor retornado caso $routeName igual a rota atual
     * @param mixed $returnFalse Valor retornado caso $routeName diferente da rota atual
     * @return mixed Retorna $returnTrue ou $returnFalse, ou a rota atual.
     */
    public function __invoke($routeName = null, $returnTrue = true, $returnFalse = false) {
        $sm               = $this->getView()->getHelperPluginManager()->getServiceLocator();
        $matchedRouteName = $sm->get('Application')->getMvcEvent()->getRouteMatch()->getMatchedRouteName();

        if ($routeName) {
            return $matchedRouteName == $routeName ? $returnTrue : $returnFalse;
        }
        return $matchedRouteName;
    }

}
