<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use Zend\Form\Element\Textarea;

/**
 * Bs Textarea Element
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class BsTextarea extends Textarea
{

    /**
     * Seed label attributes
     *
     * @var array
     */
//    protected $labelAttributes = [
//        'class' => 'form-control-label'
//    ];

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'textarea',
        'class' => 'form-control'
    ];

}
