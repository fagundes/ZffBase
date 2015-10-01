<?php
namespace Zff\Base\Entity;

use Zff\Base\Util\Configurator;

/**
 * Abstract Entity
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Model
 */
class AbstractEntity {

    public function exchangeArray($data) {
        Configurator::configure($this, $data);
    }

    public function __construct($data = array()) {
        Configurator::configure($this, $data);
    }
}
