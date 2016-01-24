<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Base\Util;

use PHPUnit_Framework_TestCase;
use Zff\Base\Util\ClassInfo;

/**
 * Class ClassInfoTest
 * @package ZffTest\Base\Util
 */
class ClassInfoTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->anObject = new ClassInfoTest();
    }

    public function testGetClassNameWorks()
    {
        $className = ClassInfo::getClassName($this->anObject);

        $this->assertSame(ClassInfoTest::class, $className);
    }

    public function testGetSimpleClassNameWorks()
    {
        $className = ClassInfo::getSimpleClassName($this->anObject);

        $this->assertSame('ClassInfoTest', $className);
    }
}
