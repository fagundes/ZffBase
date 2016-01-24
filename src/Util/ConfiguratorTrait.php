<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Util;

/**
 * ConfiguratorTrait
 *
 * Load $options data into itself using yours getters and setters.
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
trait ConfiguratorTrait
{

    public function configure($options, $tryCall = false)
    {
        if (!is_object($this)) {
            throw new \Exception('Target should be a object.');
        }
        if (!($options instanceof \Traversable) && !is_array($options)) {
            throw new \Exception('$options should be a Traversable or an array.');
        }

        $tryCall = (bool) $tryCall && method_exists($this, '__call');
        foreach ($options as $name => &$value) {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));

            if ($tryCall || method_exists($this, $setter)) {
                call_user_func([$this, $setter], $value);
            }
        }
        return $this;
    }
}
