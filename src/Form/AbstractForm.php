<?php
namespace ZffBase\Form;

use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Classe Form Abstrata
 * Depende do Modulo DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
abstract class AbstractForm extends Form {

    /**
     * @var string
     */
    protected $entityName;
    /**
     * @var string
     */
    protected $entityManagerName;

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setUseInputFilterDefaults(false);
        $this->setAttribute('method', 'post');
    }

    public function getEntityManagerName() {
        return $this->entityManagerName? : 'doctrine.entitymanager.orm_default';
    }

    public function setEntityManagerName($entityManagerName) {
        $this->entityManagerName = $entityManagerName;
    }

    public function loadHydrator($entityManager) {

        if (!$this->entityName && $this->entityName !== false) {
            throw new \RuntimeException('$entityName property must be defined!');
        }

        if ($this->entityName !== false) {
            $this->setHydrator(new DoctrineHydrator($entityManager, $this->entityName));
            $this->setObject(new $this->entityName());
        }
    }

    public abstract function initialize();
}
