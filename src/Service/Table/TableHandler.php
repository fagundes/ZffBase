<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table;

class TableHandler
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
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getDbAdapter()
    {
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
     * @return \ZfTable\AbstractTable
     */
    public function createTable($tableName)
    {
        $table  = new $tableName;
        $form   = $table->getForm();
        $filter = $table->getFilter();
        $form->setInputFilter($filter);

        return $table;
    }

    public function prepareTable(\ZfTable\AbstractTable $table, $queryBuilder)
    {
        $table->setAdapter($this->getDbAdapter())
                ->setSource($queryBuilder)
                ->setParamAdapter(new \Zend\Stdlib\Parameters($table->getForm()->getData()));
    }

}
