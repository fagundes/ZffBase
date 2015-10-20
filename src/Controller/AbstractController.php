<?php

namespace Zff\Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Abstract Entity
 *
 * @package ZffBase
 * @subpackage ZffBase_Controller
 */
class AbstractController extends AbstractActionController
{

    /**
     * @var array 
     */
    private $postedData;

    protected function getPostedData()
    {
        if (is_null($this->postedData)) {
            $this->postedData = array_merge(
                    (array) $this->getRequest()->getPost(), 
                    (array) $this->getRequest()->getFiles()
            );
        }
        return $this->postedData;
    }

}
