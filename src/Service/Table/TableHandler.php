<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Parameters;
use ZfTable\AbstractTable;

class TableHandler implements ServiceLocatorAwareInterface
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $dbAdapter;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getDbAdapter()
    {
        if (!$this->dbAdapter) {
            $this->dbAdapter = $this->getServiceLocator()->get('zfdb_adapter');
        }
        return $this->dbAdapter;
    }

    public function setDbAdapter(\Zend\Db\Adapter\Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        return $this;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (!$this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     *
     * @param string $tableName
     * @return AbstractTable
     */
    public function createTable($tableName)
    {
        if ($this->getServiceLocator() && $this->getServiceLocator()->has($tableName)) {
            $table = $this->getServiceLocator()->get($tableName);
        } else {
            $table  = new $tableName;
        }
        
        $form   = $table->getForm();
        $filter = $table->getFilter();
        $form->setInputFilter($filter);

        return $table;
    }

    /**
     * @param AbstractTable $table
     * @param $queryBuilder
     */
    public function prepareTable(AbstractTable $table, $queryBuilder)
    {
        $table->setAdapter($this->getDbAdapter())
                ->setSource($queryBuilder)
                ->setParamAdapter(new Parameters($table->getForm()->getData()));
    }
}
