<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

use Zend\Form\View\Helper\FormInput;
use Zend\Form\ElementInterface;
use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;
use Zend\Form\Exception;

/**
 * FormMultiCheckboxItem
 *
 * Use the FormMultiCheckboxItem if you need to use the FormMultiCheckbox, but
 * instead of generating all checkboxes at once, you can divide it one by one,
 * invoking this helper several times.
 *
 * At the time of invoking you must pass the 'optionId' from the 'valueOption' that
 * you want to render.
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormMultiCheckboxItem extends FormInput
{

    /**
     * @var array
     */
    protected $labelAttributes;

    /**
     * @var string
     */
    protected $optionId;

    /**
     * Renderiza um element <input> do formulario a partir do $element fornecido,
     * mas dentre todos valueOptions apenas aquele que coincidir com $optionId.
     *
     * @param  ElementInterface $element
     * @throws Exception\InvalidArgumentException
     * @throws Exception\DomainException
     * @return string
     */
    public function render(ElementInterface $element)
    {
        if (!$element instanceof MultiCheckboxElement) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s requires that the element is of type Zend\Form\Element\MultiCheckbox',
                __METHOD__
            ));
        }

        $name     = static::getName($element);
        $optionId = $this->optionId;
        $options  = $element->getValueOptions();

        if (!isset($options[$optionId])) {
            $options[$optionId] = $optionId;
        }
        $option[$optionId] = $options[$optionId];

        if (empty($options)) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has "value_options"; none found',
                __METHOD__
            ));
        }

        $attributes         = $element->getAttributes();
        $attributes['name'] = $name;
        $attributes['type'] = $this->getInputType();
        $isSelected         = in_array($optionId, (array) $element->getValue());

        $rendered = $this->renderOption($element, $option, $isSelected, $attributes);

        return $rendered;
    }

    /**
     * Renderiza apenas um value option
     *
     * @param MultiCheckboxElement $element
     * @param array                $option
     * @param boolean              $selected
     * @param array                $attributes
     * @return string
     */
    protected function renderOption(MultiCheckboxElement $element, array $option, $selected, array $attributes)
    {
        $globalLabelAttributes = $element->getLabelAttributes();
        $closingBracket        = $this->getInlineClosingBracket();

        if (empty($globalLabelAttributes)) {
            $globalLabelAttributes = $this->labelAttributes;
        }

        $key        = key($option);
        $optionSpec = current($option);

        $value           = '';
        $disabled        = false;
        $inputAttributes = $attributes;

        if (is_scalar($optionSpec)) {
            $optionSpec = [
                'value' => $key
            ];
        }

        if (isset($optionSpec['value'])) {
            $value = $optionSpec['value'];
        }
        if (isset($optionSpec['selected'])) {
            $selected = $optionSpec['selected'];
        }
        if (isset($optionSpec['disabled'])) {
            $disabled = $optionSpec['disabled'];
        }
        if (isset($optionSpec['attributes'])) {
            $inputAttributes = array_merge($inputAttributes, $optionSpec['attributes']);
        }

        $inputAttributes['value']    = $value;
        $inputAttributes['checked']  = $selected;
        $inputAttributes['disabled'] = $disabled;

        $input = sprintf(
            '<input %s%s',
            $this->createAttributesString($inputAttributes),
            $closingBracket
        );

        return $input;
    }

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  MultiCheckboxElement|null $element
     * @param  null|string           $optionId
     * @return string|FormMultiCheckbox
     */
    public function __invoke(ElementInterface $element = null, $optionId = null)
    {
        if (!$element) {
            return $this;
        }
        $this->optionId = $optionId;

        return $this->render($element);
    }

    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType()
    {
        return 'checkbox';
    }

    /**
     * Get element name
     *
     * @param  ElementInterface $element
     * @throws Exception\DomainException
     * @return string
     */
    protected static function getName(ElementInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }
        return $name . '[]';
    }
}
