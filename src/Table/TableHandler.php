<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Table;

use Zend\Stdlib\Parameters;
use ZfTable\AbstractTable;

/**
 * TableHandler
 *
 * @package ZffBase
 * @subpackage ZffBase_Table
 */
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
        return $this->entityManager;
    }

    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
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

    /**
     * @param $data
     * @param AbstractTable $table
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @return bool|string false if the form is invalid or the html resulting
     */
    public function executeTable($data, \ZfTable\AbstractTable $table, \Doctrine\ORM\QueryBuilder $queryBuilder)
    {
        $form = $table->getForm();
        $form->setData($data);

        if ($form->isValid()) {
            $this->prepareTable($table, $queryBuilder);
            return  $table->render();
        }
        return false;
    }
}
