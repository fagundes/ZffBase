<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;
use Zend\View\Helper\EscapeHtml;

/**
 * Link
 * Create a tag anchor 'a', according the options passed.
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class Link extends AbstractHtmlElement
{

    /**
     * @var EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * @return EscapeHtml
     */
    public function getEscapeHtmlHelper()
    {
        return $this->escapeHtmlHelper;
    }

    /**
     * @param EscapeHtml $escapeHtmlHelper
     */
    public function setEscapeHtmlHelper($escapeHtmlHelper)
    {
        $this->escapeHtmlHelper = $escapeHtmlHelper;
    }

    /**
     * Invoke link method.
     *
     * @param $title
     * @param $url
     * @param array $options
     * @return string
     */
    public function __invoke($title, $url, $options = [])
    {
        return $this->link($title, $url, $options);
    }

    /**
     * Create a html link, tag 'a' (anchor).
     *
     * @param $title
     * @param $url
     * @param $options
     * @return string
     */
    protected function link($title, $url, $options)
    {
        $options['href'] = is_string($url) ? $url : $this->url($url);
        return $this->linkHtml($title, $options);
    }

    protected function url($url)
    {
        $urlHelper = $this->view->plugin('Url');

        if (!isset($url['params'])) {
            $url['params'] = [];
        }

        return $urlHelper($url['route'], $url['params']);
    }

    protected function linkHtml($title, $attribs)
    {
        $escaper = $this->escapeHtmlHelper ? : $this->view->plugin('escapeHtml');
        return '<a' . $this->htmlAttribs($attribs) . '>'
                . $escaper($title)
                . '</a>';
    }
}
