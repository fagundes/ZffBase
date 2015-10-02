<?php

namespace Zff\Base;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ViewHelperProviderInterface, FilterProviderInterface, ServiceProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig($env = null)
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap($e)
    {
        /**
         * Nao precisamos da constant ROOT para os includes PHP. 
         * 
         * @reference http://samminds.com/2012/08/why-root_path-is-not-needed/
         * @reference http://stackoverflow.com/questions/11969925/how-to-get-applications-root-directory
         * 
         * Mas caso seja necessario para outra coisa, cole a linha abaixo em /public/index.php. 
         * 
         * define('ROOT', dirname(__DIR__));
         */

        /**
         * @todo fazer um alias direto para a funcao \cakeDump
         */
        //define a funcao Zff\Base\cakeDump
        function cakeDump($var = false, $showHtml = false, $showFrom = true)
        {
            return Util\Debugger::cakeDump($var, $showHtml, $showFrom);
        }

        /**
         * @todo fazer um alias direto para a funcao \entityDump
         */
        //define a funcao Zff\Base\entityDump
        function entityDump($var, $maxDepth = 2, $stripTags = true)
        {
            return Util\Debugger::entityDump($var, $maxDepth, $stripTags);
        }

    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                //form helpers
                'formactionbutton'       => 'Zff\Base\Form\View\Helper\FormActionButton',
                'formmulticheckboxsplit' => 'Zff\Base\Form\View\Helper\FormMultiCheckboxSplit',
                'formradiosplit'         => 'Zff\Base\Form\View\Helper\FormRadioSplit',
                //escaper helpers
                'noscape'                => 'Zff\Base\View\Helper\NoScape',
                //other helpers
                'getroute'               => 'Zff\Base\View\Helper\GetRoute',
                'link'                   => 'Zff\Base\View\Helper\Link',
                'paginatorlink'          => 'Zff\Base\View\Helper\PaginatorLink',
                'postlink'               => 'Zff\Base\View\Helper\PostLink',
            ),
            'factories'  => array(
                'forminputclasses' => function ($sm) {
                    return new Form\View\Helper\FormInputClasses('error', 'control-group clearfix');
                }
            ),
        );
    }

    public function getFilterConfig()
    {
        return array(
        );
    }

    public function getServiceConfig()
    {
        return array(
            'abstract_factories' => array(
                'Zff\Base\Form\FormAbstractFactory',
                'Zff\Base\Form\InputFilterAbstractFactory',
                'Zff\Base\Service\ServiceAbstractFactory'
            ),
        );
    }

}
