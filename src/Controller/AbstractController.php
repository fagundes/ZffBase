<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Abstract Controller
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

    protected function htmlResponse($html)
    {
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($html);
        return $response;
    }

    protected function jsonResponse($html)
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'text/json');
        $response->setStatusCode(200);
        $response->setContent($html);
        return $response;
    }

}
