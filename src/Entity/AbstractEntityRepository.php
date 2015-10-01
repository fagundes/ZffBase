<?php
namespace Zff\Base\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Abstract Repository
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Model
 */
class AbstractRepository extends EntityRepository {

    /**
     * Find entities by criteria and returns as an array in pairs:
     * ( $entity->getId() => (string) $entity )
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array the list in pairs
     */
    public function getList(array $criteria = array(), $orderBy = null, $limit = null, $offset = null) {
      $entities = $this->findBy($criteria, $orderBy, $limit, $offset);
      $pairs    = array();

      foreach ($entities as $e) {

        $metadata   = $this->_em->getClassMetadata($this->_entityName);
        $identifier = $metadata->getIdentifierFieldNames();

        // TODO: handle composite (multiple) identifiers
        if (count($identifier) > 1) {
            //$value = $key;
        } else {
            $id = current($metadata->getIdentifierValues($e));
        }

        $pairs[$id] = (string) $e;
      }

      return $pairs;
    }
}
