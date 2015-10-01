<?php
namespace ZffBase\Entity;

use ZffBase\Util\Configurator;

/**
 * Abstract Entity
 *
 * @package ZffBase
 * @subpackage ZffBase_Model
 */
class AbstractEntity {

    public function exchangeArray($data) {
        Configurator::configure($this, $data);
    }

    public function __construct($data = array()) {
        Configurator::configure($this, $data);
    }
}
