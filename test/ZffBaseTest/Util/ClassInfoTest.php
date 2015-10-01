<?php
namespace ZffBaseTest\Util;

use PHPUnit_Framework_TestCase;
use ZffBase\Util\ClassInfo;

class ClassInfoTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->anObject = new ClassInfoTest();
    }

    public function testGetClassNameWorks() {
        $className = ClassInfo::getClassName( $this->anObject );

        $this->assertSame($className, 'ZffBaseTest\Util\ClassInfoTest');
    }

    public function testGetSimpleClassNameWorks() {
        $className = ClassInfo::getSimpleClassName( $this->anObject );

        $this->assertSame($className, 'ClassInfoTest');
    }
}
