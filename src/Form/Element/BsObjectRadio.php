<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use DoctrineModule\Form\Element\ObjectRadio;

/**
 * BsObjectRadio
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class BsObjectRadio extends ObjectRadio implements BsElementInterface
{
    /**
     * Seed label attributes
     *
     * @var array
     */
    protected $labelAttributes = [
        'class' => 'c-input c-radio',
    ];

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
    }
}
