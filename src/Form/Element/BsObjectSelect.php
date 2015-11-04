<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use DoctrineModule\Form\Element\ObjectSelect;

/**
 * ObjectBsSelect
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class BsObjectSelect extends ObjectSelect implements BsElementInterface
{

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'select',
        'class' => 'form-control'
    ];

    public function __construct($name = null, $options = array())
    {
        $this->attributes['id'] = uniqid();
        parent::__construct($name, $options);
    }

}
