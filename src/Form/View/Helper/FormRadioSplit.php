<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

/**
 * FormRadioSplit
 * Similitar ao FormMultiCheckboxSplit, mas redenriza radio ao invés de
 * checkboxes.
 * 
 * @todo replace to a better class name
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormRadioSplit extends FormMultiCheckboxSplit
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
