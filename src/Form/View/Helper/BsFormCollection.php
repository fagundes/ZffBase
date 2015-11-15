<?php
/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection;

/**
 * BsFormCollection
 * 
 * @todo implement logic
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class BsFormCollection extends FormCollection
{
    /**
     * The name of the default view helper that is used to render sub elements.
     *
     * @var string
     */
    protected $defaultElementHelper = 'bsformrow';

}