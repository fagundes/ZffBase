<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use Zend\InputFilter\InputFilter;

/**
 * Classe Form InputFilter Abstrata
 * Denpende do Modulo DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
abstract class AbstractInputFilter extends InputFilter
{

    /**
     * @var string
     */
    protected $entityName;

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

    public abstract function initialize();
}
