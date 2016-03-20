<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper;

/**
 * PaginatorLink
 * Based on PostLink helper, but the link is created based on current link and changing the page number ($page),
 *
 * @package ZffBase
 * @subpackage ZffBase_Helper
 */
class PaginatorLink extends PostLink
{

    /**
     * Create tag anchor 'a' with data to current link and changing the page number ($page).
     *
     * @param $title
     * @param $page
     * @param array $options
     * @return string
     */
    public function __invoke($title, $page, $options = [])
    {
        return $this->link($title, $page, $options);
    }

    /**
     * Create a link based on method PostLink::link, but
     * create href based on $page passed.
     *
     * @param string $title
     * @param string $page
     * @param array $options
     * @return string
     */
    protected function link($title, $page, $options)
    {
        $url = $this->urlByPage($page);

        return parent::link($title, $url, $options);
    }

    protected function urlByPage($page)
    {
        $urlHelper = $this->view->plugin('Url');
        return $urlHelper(null, ['page' => $page], true);
    }
}
