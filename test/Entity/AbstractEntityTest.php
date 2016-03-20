<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Entity;

use PHPUnit_Framework_TestCase;

class AbstractEntityTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Assets\AnEntity
     */
    protected $anEntityObject;

    public function setup()
    {
        $this->anEntityObject= new Assets\AnEntity();
    }

    public function testConfigurableClass()
    {
        $this->anEntityObject->exchangeArray([
            'field1' => 'xxx',
            'field2' => 'lll',
            'fieldThree' => 0.3
        ]);

        $this->assertAttributeEquals('xxx', 'field1', $this->anEntityObject);
        $this->assertAttributeEquals('lll', 'field2', $this->anEntityObject);
        $this->assertAttributeEquals(0.3, 'fieldThree', $this->anEntityObject);

        $anotherEntityObject = new Assets\AnEntity([
            'field1' => 'xxx',
            'field2' => 'lll',
            'fieldThree' => 0.3
        ]);

        $this->assertAttributeEquals('xxx', 'field1', $anotherEntityObject);
        $this->assertAttributeEquals('lll', 'field2', $anotherEntityObject);
        $this->assertAttributeEquals(0.3, 'fieldThree', $anotherEntityObject);
    }
}
