<?php

namespace Zff\Base\Form\View\Helper;

/**
 * FormRadioSplit
 * Similitar ao FormMultiCheckboxSplit, mas redenriza radio ao invés de
 * checkboxes.
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Form_Helper
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
