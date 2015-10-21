<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Util;

/**
 * ClassInfo
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
class ClassInfo
{

    public static function getClassName($object)
    {
        return get_class($object);
    }

    public static function getSimpleClassName($object)
    {
        $className = self::getClassName($object);
        return preg_replace('/(.*\\\)*/', '', $className);
    }

}
