<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Util;

/**
 * Configurator
 * Carrega dados de $options no objecto $target utilizando seus getters e setters.
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
class Configurator
{

    public static function configure($target, $options, $tryCall = false)
    {
        if (!is_object($target)) {
            throw new \Exception('Target should be a object.');
        }
        if (!($options instanceof \Traversable) && !is_array($options)) {
            throw new \Exception('$options should be a Traversable or an array.');
        }

        $tryCall = (bool) $tryCall && method_exists($target, '__call');
        foreach ($options as $name => &$value) {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));

            if ($tryCall || method_exists($target, $setter)) {
                call_user_func([$target, $setter], $value);
            }
        }
        return $target;
    }
}
