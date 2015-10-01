<?php
namespace Zff\BaseTest\Util;

use PHPUnit_Framework_TestCase;
use Zff\Base\Util\ClassInfo;

class ClassInfoTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->anObject = new ClassInfoTest();
    }

    public function testGetClassNameWorks() {
        $className = ClassInfo::getClassName( $this->anObject );

        $this->assertSame($className, 'Zff\BaseTest\Util\ClassInfoTest');
    }

    public function testGetSimpleClassNameWorks() {
        $className = ClassInfo::getSimpleClassName( $this->anObject );

        $this->assertSame($className, 'ClassInfoTest');
    }
}
