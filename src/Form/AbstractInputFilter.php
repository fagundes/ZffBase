<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use Zend\InputFilter\InputFilter;

/**
 * Abstract InputFilter
 * Denpends of DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
abstract class AbstractInputFilter extends InputFilter
{

    /**
     * @var string
     */
    protected $entityManagerName = 'doctrine.entitymanager.orm_default';

    public function getEntityManagerName()
    {
        return $this->entityManagerName? : 'doctrine.entitymanager.orm_default';
    }

    public function setEntityManagerName($entityManagerName)
    {
        $this->entityManagerName = $entityManagerName;
    }

    abstract public function initialize();
}
