<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

/**
 * PostLink
 * Based on Link helper, but use Javascript to post data to access url via POST.
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class PostLink extends Link
{

    /**
     * Create a link based on method Link::link, but use Javascript to post data,
     * if 'formname' was informed in $options.
     *
     * It's also possible pass in $options any html attribute for tag 'a' (anchor),
     * except 'onclick' and 'href' which will be created by this method.
     * Required $options item: 'formname', if formnam = false, it will be a default
     * Link.
     *
     * @param $title
     * @param $url
     * @param $options
     * @return string
     */
    protected function link($title, $url, $options)
    {

        if (!isset($options['formname'])) {
            throw new \RuntimeException(sprintf('%s: $options precisa ter a chave "formname"', __METHOD__));
        }
        //extrai o formname
        $formname = $options['formname'];
        unset($options['formname']);

        //se formname for false entao utilizara o link normal
        if ($formname === false) {
            return parent::link($title, $url, $options);
        }

        $url = $this->_url($url);

        $onclick = '';
        $onclick .= "document.$formname.action = '$url';";
        $onclick .= "document.$formname.submit();";
        $onclick .= 'event.returnValue = false; return false;';

        $options['onclick'] = $onclick;
        $options['href']    = '#';

        return $this->linkHtml($title, $options);
    }
}
