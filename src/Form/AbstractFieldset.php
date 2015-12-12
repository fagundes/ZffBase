<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form;

use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Abstract Fieldset
 * Depends of DoctrineModule
 *
 * @package ZffBase
 * @subpackage ZffBase_Fieldset
 */
abstract class AbstractFieldset extends Fieldset
{
    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->setAttribute('method', 'post');
    }

    public function getEntityManagerName()
    {
        return $this->entityManagerName? : 'doctrine.entitymanager.orm_default';
    }

    public function setEntityManagerName($entityManagerName)
    {
        $this->entityManagerName = $entityManagerName;
    }

    public function loadHydrator($entityManager)
    {
        $this->entityManager = $entityManager;
        if (!$this->entityName && $this->entityName !== false) {
            throw new \RuntimeException('$entityName property must be defined!');
        }

        if ($this->entityName !== false) {
            $this->setHydrator(new DoctrineHydrator(
                $entityManager,
                $this->entityName
            ));
            $this->setObject(new $this->entityName());
        }
    }

    abstract public function initialize();
}
