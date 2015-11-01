<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ViewHelperProviderInterface
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
    }

    public function getViewHelperConfig()
    {
        return [
            'factories'          => [
                'formGroupClasses' => function ($sm) {
                    return new Form\View\Helper\FormInputClasses('error', 'form-group', array(
                        'error'   => 'has-error',
                        'warning' => 'has-warning',
                        'info'    => 'has-info',
                        'success' => 'has-success',
                    ));
                },
                'formControlClasses' => function ($sm) {
                    return new Form\View\Helper\FormInputClasses('error', 'form-control', array(
                        'error'   => 'form-control-error',
                        'warning' => 'form-control-warning',
                        'info'    => 'form-control-info',
                        'success' => 'form-control-success',
                    ));
                }
            ],
        ];
    }
}
        