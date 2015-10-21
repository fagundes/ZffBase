<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

/**
 * PostLink
 * Similiar a helper Link, porém utiliza Javascript para postar na url passada.
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class PostLink extends Link
{

    /**
     * Cria um link similar o respectivo metodo em Link, porém utiliza Javascript
     * para postar dados, se 'formname' for informado em $options.
     *
     * Como itens do $options opcionais é possivel passar qualquer atributo da tag 'A',
     * exceto 'onclick' e 'href' que serão sobrescritos. Como item do $options
     * obrigatório temos o 'formname', se formname = false, for passado então
     * o metodo retorna um link normal.
     *
     * @param string $title
     * @param string $url
     * @param array $options
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
