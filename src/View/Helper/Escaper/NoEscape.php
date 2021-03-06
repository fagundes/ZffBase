<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\View\Helper\Escaper;

use Zend\View\Helper\Escaper;

/**
 * Um falso Escaper, util quando uma classe depende de um Escaper mais você não
 * quer realmente escapar/mudar os dados que aquela classe manipula.
 *
 * @package    Zff\Base
 * @subpackage ZffBase_Helper
 */
class NoEscape extends Escaper\AbstractHelper
{

    protected function escape($value)
    {
        return $value;
    }
}
