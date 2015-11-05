<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

/**
 * FormRadioItem
 * Similar to FormMultiCheckboxItem, more renders radio instead of checkboxes.
 * 
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormRadioItem extends FormMultiCheckboxItem
{

    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType()
    {
        return 'radio';
    }

}
