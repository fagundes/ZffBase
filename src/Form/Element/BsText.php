<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use Zend\Form\Element\Text;

/**
 * Text Element
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class BsText extends Text implements BsElementInterface
{

    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'text',
        'class' => 'form-control'
    ];

    public function __construct($name = null, $options = [])
    {
        $this->attributes['id'] = uniqid();
        parent::__construct($name, $options);
    }
}
