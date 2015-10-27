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
class BsTextarea extends Textarea implements BsElementInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes   = [
        'type'  => 'textarea',
        'class' => 'form-control'
    ];

    public function __construct($name = null, $options = array())
    {
        $this->attributes['id'] = uniqid();
        parent::__construct($name, $options);
    }

}
