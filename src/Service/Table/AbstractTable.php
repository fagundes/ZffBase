<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Service\Table;

class AbstractTable extends \ZfTable\AbstractTable
{

    protected $form;
    protected $filter;

    public function getFilter()
    {
        if (!$this->filter) {
            $this->filter = parent::getFilter();
        }
        return $this->filter;
    }

    public function getForm()
    {
        if (!$this->form) {
            $this->form = parent::getForm();
        }
        return $this->form;
    }

}
