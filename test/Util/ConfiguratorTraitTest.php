<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Util;

use PHPUnit_Framework_TestCase;
use ZffTest\Base\Util\Assets\ConfigurableClass;

/**
 * Class ConfiguratorTraitTest
 * @package ZffTest\Base\Util
 */
class ConfiguratorTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigurableClass
     */
    protected $configurableClass;

    public function setup()
    {
        $this->configurableClass = new ConfigurableClass();
    }

    public function testCanCallConfigureDirectly()
    {
        $this->configurableClass->configure([
            'x' => 'value of x',
            'y' => 1,
            'z' => 20.01
        ]);

        $this->assertAttributeEquals('value of x', 'x', $this->configurableClass);
        $this->assertAttributeEquals(1, 'y', $this->configurableClass);
        $this->assertAttributeEquals(20.01, 'z', $this->configurableClass);
    }

    public function testCanCallConfigureInConstructor()
    {
        $this->configurableClass = new ConfigurableClass([
            'x' => 'one meter',
            'y' => 'two feet',
            'z' => 'three trees'
        ]);

        $this->assertAttributeEquals('one meter', 'x', $this->configurableClass);
        $this->assertAttributeEquals('two feet', 'y', $this->configurableClass);
        $this->assertAttributeEquals('three trees', 'z', $this->configurableClass);
    }
}
