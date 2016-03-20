<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Validator;

use Zff\Base\Validator\Cpf;
use PHPUnit_Framework_TestCase;

class CpfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Cpf
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
        $this->validator = new Cpf();
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
        $this->assertTrue($this->validator->isValid('652.965.215-95'));
        $this->assertTrue($this->validator->isValid('159.844.205-89'));
        $this->assertTrue($this->validator->isValid('11514663449'));

        $this->assertFalse($this->validator->isValid('234.234.234-00'));
        $this->assertFalse($this->validator->isValid('12312312312'));
    }

    /**
     * Ensures that the validator checks repeated numbers
     *
     * @return void
     */
    public function testRepeatedNumbers()
    {
        $this->assertFalse($this->validator->isValid(str_repeat('0', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('1', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('2', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('3', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('4', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('5', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('6', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('7', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('8', 11)));
        $this->assertFalse($this->validator->isValid(str_repeat('9', 11)));
    }

    /**
     * Ensures that the validator checks the value's size
     *
     * @return void
     */
    public function testSize()
    {
        $this->assertFalse($this->validator->isValid('652.965.21-95'));
        $this->assertFalse($this->validator->isValid('652.965.21-95'));
        $this->assertFalse($this->validator->isValid('652.965.2156-95'));
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
