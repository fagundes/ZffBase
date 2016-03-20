<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Entity\Assets;

use Zff\Base\Entity\AbstractEntity;

class AnEntity extends AbstractEntity
{
    protected $field1;
    protected $field2;
    protected $fieldThree;

    /**
     * @return mixed
     */
    public function getField1()
    {
        return $this->field1;
    }

    /**
     * @param mixed $field1
     */
    public function setField1($field1)
    {
        $this->field1 = $field1;
    }

    /**
     * @return mixed
     */
    public function getField2()
    {
        return $this->field2;
    }

    /**
     * @param mixed $field2
     */
    public function setField2($field2)
    {
        $this->field2 = $field2;
    }

    /**
     * @return mixed
     */
    public function getFieldThree()
    {
        return $this->fieldThree;
    }

    /**
     * @param mixed $fieldThree
     */
    public function setFieldThree($fieldThree)
    {
        $this->fieldThree = $fieldThree;
    }
}
