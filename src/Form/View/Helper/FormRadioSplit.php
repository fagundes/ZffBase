<?php

namespace ZffBase\Form\View\Helper;

/**
 * FormRadioSplit
 * Similitar ao FormMultiCheckboxSplit, mas redenriza radio ao invés de
 * checkboxes.
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormRadioSplit extends FormMultiCheckboxSplit {

    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType() {
        return 'radio';
    }

}
