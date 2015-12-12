<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use Zend\Form\Element\Radio;

/**
 * Bs Radio Element
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class BsRadio extends Radio implements BsElementInterface
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
