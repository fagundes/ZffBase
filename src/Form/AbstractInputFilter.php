<?php

namespace ZffBase\Form;

use Zend\InputFilter\InputFilter;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Classe Form InputFilter Abstrata
 * Denpende do Modulo DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
abstract class AbstractInputFilter extends InputFilter {

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $entityManagerName = 'doctrine.entitymanager.orm_default';

    public function getEntityManagerName() {
        return $this->entityManagerName? : 'doctrine.entitymanager.orm_default';
    }

    public function setEntityManagerName($entityManagerName) {
        $this->entityManagerName = $entityManagerName;
    }

    public abstract function initialize();
}
