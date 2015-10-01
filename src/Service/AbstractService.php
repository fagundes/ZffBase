<?php

namespace Zff\Base\Service;

use Doctrine\ORM\EntityManager;
use Zff\Base\Exception;

/**
 * AbstractService
 *
 * Uma Service que herda desta Classe Abstrata tem:
 *  - vinculo com uma Entity, por meio do atributo $entityName
 *  - vinculo com uma ou mais Services, por meio do atributo $services
 * Inclui diversos metodos facilitadores.
 *
 * TODO incluir get/set autocommit
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Service
 */
abstract class AbstractService {

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @var array
     */
    protected $services;

    public function __construct(EntityManager $entityManager = null) {
        if ($entityManager) {
            $this->setEntityManager($entityManager);
        }
    }

    protected function checkIfClassExists($class) {
        if (!class_exists($class)) {
            throw new \RuntimeException(sprintf('Class %s does not exist.', $class));
        }
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return string
     */
    public function getEntityManagerName() {
        return $this->entityManagerName? : 'doctrine.entitymanager.orm_default';
    }

    public function setEntityManagerName($entityManagerName) {
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * Metodo proxy EntityManager#getRepository.
     * @return \Doctrine\ORM\EntityRepository A classe de repositorio
     */
    public function getRepository() {
        $this->checkIfClassExists($this->entityName);
        return $this->getEntityManager()->getRepository($this->entityName);
    }

    /**
     * @return array Array de services utilizadas pelas classes concretas
     */
    public function getServices() {
        return $this->services;
    }

    /**
     * Metodo proxy.
     *
     * @param mixed $id
     * @return \Base\Entity\AbstractEntity
     */
    public function getReference($id) {
        return $this->entityManager->getReference($this->entityName, $id);
    }

    /**
     * @param array|\Base\Entity\AbstractEntity $entity
     * @return \Zff\Base\Entity\AbstractEntity
     */
    public function insert($entity) {

        $this->checkIfClassExists($this->entityName);
        if(is_array($entity)) {
          $entity = new $this->entityName($entity);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    /**
     * @param array|\Base\Entity\AbstractEntity $entity
     * @return \Gestor\Entity\AbstractEntity
     */
    public function update($entity) {

        $this->checkIfClassExists($this->entityName);
        if(is_array($entity)) {
          $entity = $this->entityManager->getReference($this->entityName, $v['id']);
          $entity->exchangeArray($entity);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    /**
     * Atualiza o array de entidades.
     *
     * @param array $entities
     * @return array Entities updated
     */
    public function updateAll($entities) {
        foreach ($entities as $entity) {
            $this->entityManager->persist($entity);
        }
        $this->entityManager->flush();
        return $entities;
    }

    /**
     *
     */
    public function delete($id) {
        $this->checkIfClassExists($this->entityName);
        $entity = $this->entityManager->getReference($this->entityName, $id);

        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }

    /**
     * Metodo proxy EntityRepository#findBy.
     * @param array $criteria
     * @param array $orderBy
     * @return array
     */
    public function findBy(array $criteria, array $orderBy = null) {
        return $this->getRepository()->findBy($criteria, (array) $orderBy);
    }

    /**
     * Metodo proxy EntityRepository#find
     * @param int $id
     * @return \Gestor\Entity\AbstractEntity
     */
    public function find($id) {
        return $this->getRepository()->find($id);
    }

    /**
     * Como findBy mais retorna todos
     * @param array $orderBy
     * @return array
     */
    public function findAll(array $orderBy = null) {
        return $this->getRepository()->findBy(array(), (array) $orderBy);
    }

    /**
     * Retorna o total de resultados,
     * $equal serão incluidos como criterios utilizando: '=' ou 'in'
     * $different serão incluidos como criterios utilizando: '<>' ou 'not in'
     *
     * @param array $equal Criterios iguais.
     * @param array $different Criterios diferentes.
     * @return int total
     */
    public function count(array $equal = array(), array $different = array()) {

        $this->checkIfClassExists($this->entityName);

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(e)')
           ->from($this->entityName, 'e');

        $i=0;
        foreach ($equal as $field => $value) {
            $fieldParam  = $field.$i++;
            $whereClause = is_array($value) ? "e.$field in (:$fieldParam)" : "e.$field = :$fieldParam";

            $qb->andWhere($whereClause);
            $qb->setParameter($fieldParam, $value);
        }

        foreach ($different as $field => $value) {
            $fieldParam  = $field.$i++;
            $whereClause = is_array($value) ? "e.$field not in (:$fieldParam)" : "e.$field <> :$fieldParam";

            $qb->andWhere($whereClause);
            $qb->setParameter($fieldParam, $value);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

}
