<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

use Zend\Form\View\Helper\Form;
use Zend\Form\FormInterface;
use Zend\Form\FieldsetInterface;

/**
 * BsForm
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class BsForm extends Form
{

    /**
     * Render a form from the provided $form,
     *
     * @param  FormInterface $form
     * @return string
     */
    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                $formContent.= $this->getView()->bsFormCollection($element);
            } else {
                $formContent.= $this->getView()->bsFormRow($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }

}
