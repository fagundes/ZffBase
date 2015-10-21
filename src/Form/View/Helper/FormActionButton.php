<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;
use Zend\Form\View\Helper\FormButton;

/**
 * FormActionButton
 * Criar um FormButton, para ser utilizado em formulários de muitas ações.
 * Sempre retorna o "name"="action" (fixo), será "value" = 'ao value passado pelo element',
 * inclui ainda "formaction" = 'será a url da rota passada pelo element'.
 *
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormActionButton extends FormButton
{

    protected $name = 'action';

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Generate an opening button tag
     *
     * @param  null|array|ElementInterface $attributesOrElement
     * @throws Exception\InvalidArgumentException
     * @throws Exception\DomainException
     * @return string
     */
    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            return '<button>';
        }

        if (is_array($attributesOrElement)) {
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<button %s>', $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new \Exception\InvalidArgumentException(sprintf(
                    '%s expects an array or Zend\Form\ElementInterface instance; received "%s"', __METHOD__, (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }

        $element = $attributesOrElement;
        $name    = $this->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                    '%s requires that the element has an assigned name; none discovered', __METHOD__
            ));
        }

        $route       = $element->getOption('route');
        $routeParams = (array) $element->getOption('route_params');

        if (!$route) {
            throw new Exception\DomainException(sprintf(
                    '%s requires that the element has an assigned the options "route"; none discovered', __METHOD__
            ));
        }
        $urlHelper = $this->getView()->plugin('url');

        $attributes          = $element->getAttributes();
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();

        $attributes['formaction'] = $urlHelper($route, $routeParams);

        return sprintf('<button %s>', $this->createAttributesString($attributes));
    }

    public function setEscapeHtmlHelper($escapeHtmlHelper)
    {
        $this->escapeHtmlHelper = $escapeHtmlHelper;
    }

}
