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
class PaginatorLink extends PostLink
{

    /**
     * Cria a tag 'A', com os dados do link atual, e troca o numero da pagina ($page).
     */
    public function __invoke($title, $page, $options = [])
    {
        return $this->link($title, $page, $options);
    }

    /**
     * Cria um link similar o respectivo metodo em PostLink, porém
     *
     * @param string $title
     * @param string $page
     * @param array $options
     */
    protected function link($title, $page, $options)
    {
        $url = $this->_url($page);

        return parent::link($title, $url, $options);
    }

    protected function _url($page)
    {
        $urlHelper = $this->view->plugin('Url');
        return $urlHelper(null, ['page' => $page], true);
    }
}
