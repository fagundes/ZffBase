<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

use Zend\Form\View\Helper\FormRow;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Button;
use Zend\Form\LabelAwareInterface;
use Zff\Base\Form\Element\BsElementInterface;
use Zff\Base\Form\Element\BsCheckbox;

/**
 * BsFormRow
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class BsFormRow extends FormRow
{

    public function render(ElementInterface $element, $labelPosition = null)
    {
        $markup  = $this->renderBsElement($element, $labelPosition);
        $wrapper = $this->renderWrapper($element);

        return sprintf($wrapper, $markup);
    }

    public function renderWrapper(ElementInterface $element)
    {
        $type = $element->getAttribute('type');
        if (in_array($type, ['checkbox'])) {
            return '<div class="checkbox">%s</div>';
        }
//        if (in_array($type, ['radio', 'multi_checkbox'])) {
//            return '<div>%s</div>';
//        }

        return sprintf(
            '<div class="%s">%s</div>',
            $this->getView()->formGroupClasses($element),
            '%s'
        );
    }

    public function renderBsElement(ElementInterface $element, $labelPosition = null)
    {

        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $labelHelper         = $this->getLabelHelper();
        $elementHelper       = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();

        $label           = $element->getLabel();
        $inputErrorClass = $this->getInputErrorClass();

        if (is_null($labelPosition)) {
            $labelPosition = $this->labelPosition;
        }

        if (isset($label) && '' !== $label) {
            // Translate the label
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate($label, $this->getTranslatorTextDomain());
            }
        }

        // Does this element have errors ?
        if (count($element->getMessages()) > 0 && !empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttributes = $classAttributes . $inputErrorClass;

            $element->setAttribute('class', $classAttributes);
        }

        if ($this->partial) {
            $vars = [
                'element'         => $element,
                'label'           => $label,
                'labelAttributes' => $this->labelAttributes,
                'labelPosition'   => $labelPosition,
                'renderErrors'    => $this->renderErrors,
            ];

            return $this->view->render($this->partial, $vars);
        }

        if ($this->renderErrors) {
            $elementErrors = $elementErrorsHelper->render($element, ['class' => 'form-message']);
        }

        $type = $element->getAttribute('type');
        if (in_array($type, ['radio', 'multi_checkbox'])) {
            $this->prepareLabel($element);
        }


        $elementString = $elementHelper->render($element);

        // hidden elements do not need a <label> -https://github.com/zendframework/zf2/issues/5607
        if (isset($label) && '' !== $label && $type !== 'hidden') {
            $labelAttributes = [];

            if ($element instanceof LabelAwareInterface) {
                $labelAttributes = $element->getLabelAttributes();
            }

            if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
                $label = $escapeHtmlHelper($label);
            }

            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }

            // Multicheckbox elements have to be handled differently as the HTML standard does not allow nested
            // labels.
            if ($element instanceof MonthSelect || $element instanceof Captcha
            ) {
                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>',
                    $label,
                    $elementString
                );
            } elseif ($type === 'multi_checkbox' || $type === 'radio') {
                
                $elementsSplitted = preg_split('#</label>#', $elementString, -1, PREG_SPLIT_NO_EMPTY);
                $elementClass = $type === 'multi_checkbox' ? 'checkbox' : 'radio';
                
                $elementString = '';
                foreach ($elementsSplitted as $elementItem) {
                    $elementString .= sprintf('<div class="%s">%s</label></div>', $elementClass, $elementItem);
                }
                
                $markup = sprintf(
                    '<span>%s</span>%s',
                    $label,
                    $elementString
                );
            } else {
                // Ensure element and label will be separated if element has an `id`-attribute.
                // If element has label option `always_wrap` it will be nested in any case.
                if ($element->hasAttribute('id')
                        && ($element instanceof LabelAwareInterface
                        && !$element->getLabelOption('always_wrap'))
                ) {
                    $labelOpen  = '';
                    $labelClose = '';
                    $label      = $labelHelper($element);
                } else {
                    $labelOpen  = $labelHelper->openTag($labelAttributes);
                    $labelClose = $labelHelper->closeTag();
                }

                if ($label !== '' && (!$element->hasAttribute('id'))
                        && (!$element instanceof BsElementInterface)
                        || ($element instanceof LabelAwareInterface && $element->getLabelOption('always_wrap'))
                ) {
                    $label = '<span>' . $label . '</span>';
                }

                if ($element instanceof BsCheckbox) {
                    $label = '<span class="c-indicator"></span>' . $label;
                }

                // Button element is a special case, because label is always rendered inside it
                if ($element instanceof Button) {
                    $labelOpen  = $labelClose = $label      = '';
                }

                if ($element instanceof LabelAwareInterface && $element->getLabelOption('label_position')) {
                    $labelPosition = $element->getLabelOption('label_position');
                }

                switch ($labelPosition) {
                    case self::LABEL_PREPEND:
                        $markup = $labelOpen . $label . $elementString . $labelClose;
                        break;
                    case self::LABEL_APPEND:
                    default:
                        $markup = $labelOpen . $elementString . $label . $labelClose;
                        break;
                }
            }

            if ($this->renderErrors) {
                $markup .= $elementErrors;
            }
        } else {
            if ($this->renderErrors) {
                $markup = $elementString . $elementErrors;
            } else {
                $markup = $elementString;
            }
        }

        return $markup;
    }

    protected function prepareLabel(ElementInterface $element)
    {
        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $valuesOptions = $element->getValueOptions();
        
        //append span with c-indicator for each option
        foreach ($valuesOptions as $key => $optionSpec) {
            if (is_scalar($optionSpec)) {
                $optionSpec = [
                    'label' => $optionSpec,
                    'value' => $key
                ];
            }

            if (!$element instanceof LabelAwareInterface || !$element->getLabelOption('disable_html_escape')) {
                $optionSpec['label'] = $escapeHtmlHelper($optionSpec['label']);
            }

            $optionSpec['label'] = '<span class="c-indicator"></span>' . $optionSpec['label'];
            $valuesOptions[$key] = $optionSpec;
        }
        
        //disable escape because it was already used above
        $element->setLabelOption('disable_html_escape', true);
        $element->setValueOptions($valuesOptions);
    }
}
