<?php
namespace Zff\Base\Util;

/**
 * ClassInfo
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Util
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
