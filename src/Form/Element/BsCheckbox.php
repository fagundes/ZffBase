<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use Zend\Form\Element\Checkbox;

/**
 * Bs Checkbox Element
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class BsCheckbox extends Checkbox
{

    /**
     * Seed label attributes
     *
     * @var array
     */
    protected $labelAttributes = [
        'class' => 'checkbox'
    ];

}
