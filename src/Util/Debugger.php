<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Util;

use Doctrine\Common\Util\Debug as DocDebug;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT')) {
    define('ROOT', '');
}

/**
 * Debug
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
class Debugger
{

    /**
     * Imprime informações de debug sobra uma variavel. Util para ser utilizada
     * em objetos do Doctrine.
     *
     * Um metodo proxy do \Doctrine\Common\Util\Debug::dump
     * @return void
     */
    public static function doctrineDump($var, $maxDepth = 2, $stripTags = true)
    {
        echo "\n<pre class=\"doctrine-debug\">\n";
        DocDebug::dump($var, $maxDepth, $stripTags);
        echo "\n</pre>\n";
    }

    /**
     * Imprime informações de debug sobre a dada variavel.
     *
     * @reference http://book.cakephp.org/3.0/en/development/debugging.html#basic-debugging
     *
     * @param boolean $var Variavel da qual serão exibidas as informações.
     * @param boolean $showHtml Se verdadeiro, o metodo impriem os dados debug escapando as tags.
     * @param boolean $showFrom Se verdadeiro, o metodo imprime de onde debug está sendo chamado.
     * @return void
     */
    public static function cakeDump($var = false, $showHtml = false, $showFrom = true, $stackIndex = 0)
    {

        if (!defined('ROOT')) {
            define('ROOT', '');
        }

        if ($showFrom) {
            $stack = debug_backtrace();
            echo '<strong>' . substr(str_replace(ROOT, '', $stack[$stackIndex]['file']), 1) . '</strong>';
            echo ' (line <strong>' . $stack[$stackIndex]['line'] . '</strong>)';
        }

        $var = print_r($var, true);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo "\n<pre class=\"cake-debug\">\n" . $var . "\n</pre>\n";
    }

}

//defines Zff\Base\Util\cakeDump as function
function cakeDump($var = false, $showHtml = false, $showFrom = true)
{
    return Debugger::cakeDump($var, $showHtml, $showFrom, 1);
}

//defines Zff\Base\Util\entityDump as function
function doctrineDump($var, $maxDepth = 2, $stripTags = true)
{
    return Debugger::doctrineDump($var, $maxDepth, $stripTags);
}
