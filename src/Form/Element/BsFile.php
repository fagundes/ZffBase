<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\Element;

use Zend\Form\Element\File;

/**
 * Bs File Element
 *
 * @package ZffBase
 * @subpackage ZffBase_Form
 */
class BsFile extends File implements BsElementInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes   = [
        'type'  => 'file',
        'class' => 'form-control-file'
    ];

    public function __construct($name = null, $options = array())
    {
        $this->attributes['id'] = uniqid();
        parent::__construct($name, $options);
    }
}
