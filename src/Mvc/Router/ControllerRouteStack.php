<?php

namespace ZffBase\Mvc\Router;

use Zend\Mvc\Router\Exception;
use Zend\Mvc\Router\Http\TreeRouteStack;
use Zend\Mvc\Router\SimpleRouteStack;
use Zend\Mvc\Router\Http\RouteInterface;

/**
 * ControllerRouteStack
 * Implementa controller router. Similar ao TreeRouteStack, porém permite o uso
 * da chave 'controller_routes' em $spec.
 *
 * Por meio de 'controller_routes' é possivel configurar uma única rota para
 * múltiplas Controllers.
 *
 * O conteudo de 'controller_routes' deve ser um array com duas chaves:
 *   - 'controllers' array|Traversable : define uma lista de controllers
 *   - 'model_route' array|Traversable : define um rota modelo para as controllers listadas
 *
 * @package ZffBase
 * @subpackage ZffBase_Router
 */
class ControllerRouteStack extends TreeRouteStack {

    /**
     * routeFromArray(): defined by SimpleRouteStack.
     *
     * @see    SimpleRouteStack::routeFromArray()
     * @param  string|array|Traversable $specs
     * @return RouteInterface
     * @throws Exception\InvalidArgumentException When route definition is not an array nor traversable
     * @throws Exception\InvalidArgumentException When chain routes are not an array nor traversable
     * @throws Exception\RuntimeException         When a generated routes does not implement the HTTP route interface
     */
    protected function routeFromArray($specs) {
        if (is_string($specs)) {
            if (null === ($route = $this->getPrototype($specs))) {
                throw new Exception\RuntimeException(sprintf('Could not find prototype with name %s', $specs));
            }

            return $route;
        } elseif ($specs instanceof Traversable) {
            $specs = ArrayUtils::iteratorToArray($specs);
        } elseif (!is_array($specs)) {
            throw new Exception\InvalidArgumentException('Route definition must be an array or Traversable object');
        }

        if (isset($specs['controller_routes'])) {

            if ($specs['controller_routes'] instanceof Traversable) {
                $specs['controller_routes'] = ArrayUtils::iteratorToArray($specs['controller_routes']);
            } elseif (!is_array($specs['controller_routes'])) {
                throw new Exception\InvalidArgumentException('Controller routes must be an array or Traversable object');
            }

            if ($specs['controller_routes']['model_route'] instanceof Traversable) {
                $specs['controller_routes']['model_route'] = ArrayUtils::iteratorToArray($specs['controller_routes']['model_route']);
            } elseif (!is_array($specs['controller_routes']['model_route'])) {
                throw new Exception\InvalidArgumentException('Controller routes must have a \'model_route\' key as an array or Traversable object');
            }

            if ($specs['controller_routes']['controllers'] instanceof Traversable) {
                $specs['controller_routes']['controllers'] = ArrayUtils::iteratorToArray($specs['controller_routes']['controllers']);
            } elseif (!is_array($specs['controller_routes']['controllers'])) {
                throw new Exception\InvalidArgumentException('Controller routes must have a \'controllers\' key as an array or Traversable object');
            }

            $modelRoute  = $specs['controller_routes']['model_route'];
            $controllers = $specs['controller_routes']['controllers'];

            foreach ($controllers as $ctrlName) {
                $route                                      = $modelRoute;
                $route['options']['defaults']['controller'] = $ctrlName;
                $route['options']['route']                  = str_replace(':controller', $ctrlName, $route['options']['route']);

                $specs['child_routes'][$ctrlName] = $route;
            }
            unset($specs['controller_routes']);
        }

        if (isset($specs['chain_routes'])) {
            if (!is_array($specs['chain_routes'])) {
                throw new Exception\InvalidArgumentException('Chain routes must be an array or Traversable object');
            }

            $chainRoutes = array_merge(array($specs), $specs['chain_routes']);
            unset($chainRoutes[0]['chain_routes']);

            if (isset($specs['child_routes'])) {
                unset($chainRoutes[0]['child_routes']);
            }

            $options = array(
                'routes'        => $chainRoutes,
                'route_plugins' => $this->routePluginManager,
                'prototypes'    => $this->prototypes,
            );

            $route = $this->routePluginManager->get('chain', $options);
        } else {
            $route = SimpleRouteStack::routeFromArray($specs);
        }

        if (!$route instanceof RouteInterface) {
            throw new Exception\RuntimeException('Given route does not implement HTTP route interface');
        }

        if (isset($specs['child_routes'])) {
            $options = array(
                'route'         => $route,
                'may_terminate' => (isset($specs['may_terminate']) && $specs['may_terminate']),
                'child_routes'  => $specs['child_routes'],
                'route_plugins' => $this->routePluginManager,
                'prototypes'    => $this->prototypes,
            );

            $priority = (isset($route->priority) ? $route->priority : null);

            $route           = $this->routePluginManager->get('part', $options);
            $route->priority = $priority;
        }

        return $route;
    }

}
