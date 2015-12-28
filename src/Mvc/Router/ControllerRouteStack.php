<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Mvc\Router;

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
class ControllerRouteStack extends TreeRouteStack
{

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
    protected function routeFromArray($specs)
    {
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

            $ctrlRoutes = $specs['controller_routes'];

            if ($ctrlRoutes instanceof Traversable) {
                $ctrlRoutes = ArrayUtils::iteratorToArray($ctrlRoutes);
            } elseif (!is_array($ctrlRoutes)) {
                throw new Exception\InvalidArgumentException(
                    'Controller routes must be an array or Traversable object'
                );
            }

            if (!isset($ctrlRoutes['model_route']) || (!is_array($ctrlRoutes['model_route'])
                && !$ctrlRoutes['model_route'] instanceof Traversable)
            ) {
                throw new Exception\InvalidArgumentException(
                    'Controller routes must have a \'model_route\' key as an array or Traversable object'
                );
            } elseif ($ctrlRoutes['model_route'] instanceof Traversable) {
                $ctrlRoutes['model_route'] = ArrayUtils::iteratorToArray($ctrlRoutes['model_route']);
            }

            if (!isset($ctrlRoutes['controllers']) || (!is_array($ctrlRoutes['controllers'])
                && !$ctrlRoutes['controllers'] instanceof Traversable)
            ) {
                throw new Exception\InvalidArgumentException(
                    'Controller routes must have a \'controllers\' key as an array or Traversable object'
                );
            } elseif ($ctrlRoutes['model_route'] instanceof Traversable) {
                $ctrlRoutes['controllers'] = ArrayUtils::iteratorToArray($ctrlRoutes['controllers']);
            }

            $modelRoute  = $ctrlRoutes['model_route'];
            $controllers = $ctrlRoutes['controllers'];

            foreach ($controllers as $ctrlName) {
                $route = $modelRoute;
                $route['options']['defaults']['controller'] = $ctrlName;
                $route['options']['route'] = str_replace(':controller', $ctrlName, $route['options']['route']);

                $specs['child_routes'][$ctrlName] = $route;
            }
            unset($specs['controller_routes']);
        }

        if (isset($specs['chain_routes'])) {
            if (!is_array($specs['chain_routes'])) {
                throw new Exception\InvalidArgumentException('Chain routes must be an array or Traversable object');
            }

            $chainRoutes = array_merge([$specs], $specs['chain_routes']);
            unset($chainRoutes[0]['chain_routes']);

            if (isset($specs['child_routes'])) {
                unset($chainRoutes[0]['child_routes']);
            }

            $options = [
                'routes' => $chainRoutes,
                'route_plugins' => $this->routePluginManager,
                'prototypes' => $this->prototypes,
            ];

            $route = $this->routePluginManager->get('chain', $options);
        } else {
            $route = SimpleRouteStack::routeFromArray($specs);
        }

        if (!$route instanceof RouteInterface) {
            throw new Exception\RuntimeException('Given route does not implement HTTP route interface');
        }

        if (isset($specs['child_routes'])) {
            $options = [
                'route' => $route,
                'may_terminate' => (isset($specs['may_terminate']) && $specs['may_terminate']),
                'child_routes' => $specs['child_routes'],
                'route_plugins' => $this->routePluginManager,
                'prototypes' => $this->prototypes,
            ];

            $priority = (isset($route->priority) ? $route->priority : null);

            $route           = $this->routePluginManager->get('part', $options);
            $route->priority = $priority;
        }

        return $route;
    }
}
