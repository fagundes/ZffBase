<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Validator;

use Zff\Base\Validator\Cnpj;
use PHPUnit_Framework_TestCase;

class CnpjTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cnpj
     */
    protected $validator;

    /**
     * The list with the options supported.
     * By default all options are disabled.
     *
     * @var array
     */
    protected $options;

    /**
     * Creates a new Cpf Validator for each test
     *
     * @return void
     */
    public function setUp()
    {
        $this->validator = new Cnpj();
        $this->options   = [
            'validIfEmpty' => false,
        ];
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        $this->assertTrue($this->validator->isValid('42548556000167'));
        $this->assertTrue($this->validator->isValid('23.692.572/0001-84'));
        $this->assertTrue($this->validator->isValid('04.235.882/0001-25'));

        $this->assertFalse($this->validator->isValid('12.345.678/0001-12'));
        $this->assertFalse($this->validator->isValid('12312312312312'));
    }

    /**
     * Ensures that the validator checks repeated numbers
     *
     * @return void
     */
    public function testRepeatedNumbers()
    {
        $this->assertFalse($this->validator->isValid(str_repeat('0', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('1', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('2', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('3', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('4', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('5', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('6', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('7', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('8', 14)));
        $this->assertFalse($this->validator->isValid(str_repeat('9', 14)));
    }

    /**
     * Ensures that the validator checks the value's size
     *
     * @return void
     */
    public function testSize()
    {
        $this->assertFalse($this->validator->isValid('4254855600016'));
        $this->assertFalse($this->validator->isValid('425485560001670'));
    }

    /**
     * Ensures that the validator checks if value is empty
     *
     * @return void
     */
    public function testValidIfEmpty()
    {
        $this->assertFalse($this->validator->isValid(''));

        $this->validator->setOptions($this->options);

        $this->assertTrue($this->validator->isValid(''));

    }
}
