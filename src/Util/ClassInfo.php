<?php
namespace ZffBase\Util;

/**
 * ClassInfo
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
class ClassInfo {

    public static function getClassName($object) {
        return get_class($object);
    }

    public static function getSimpleClassName($object) {
        $className = self::getClassName($object);
        return preg_replace('/(.*\\\)*/', '', $className);
    }
}
