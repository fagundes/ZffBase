<?php

namespace Zff\Base;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements AutoloaderProviderInterface,
  ConfigProviderInterface,
  ViewHelperProviderInterface,
  FilterProviderInterface,
  ServiceProviderInterface {

  public function getAutoloaderConfig() {
     return array(
         'Zend\Loader\ClassMapAutoloader' => array(
             __DIR__ . '/autoload_classmap.php',
         ),
         'Zend\Loader\StandardAutoloader' => array(
             'namespaces' => array(
                 __NAMESPACE__ => __DIR__ . '/src/' ,
             ),
         ),
     );
  }

  public function getConfig($env = null) {
      return include __DIR__ . '/config/module.config.php';
  }

  public function onBootstrap($e) {
    //seta ROOT como o diretorio do projeto
    define('ROOT', __DIR__ . '/../../');

    //define a funcao cakeDump
    function cakeDump($var = false, $showHtml = false, $showFrom = true) {
      return Util\Debugger::cakeDump($var, $showHtml, $showFrom);
    }

    //define a funcao entityDump
    function entityDump($var, $maxDepth = 2, $stripTags = true) {
      return Util\Debugger::entityDump($var, $maxDepth, $stripTags);
    }

  }

  public function getViewHelperConfig() {
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
      'factories' => array(
          'forminputclasses'       => function ($sm) {
              return new Form\View\Helper\FormInputClasses('error', 'control-group clearfix');
          }
      ),
    );
  }

  public function getFilterConfig() {
      return array(

      );
  }

  public function getServiceConfig() {
      return array(
          'abstract_factories' => array(
              'Zff\Base\Form\FormAbstractFactory',
              'Zff\Base\Form\InputFilterAbstractFactory',
              'Zff\Base\Service\ServiceAbstractFactory'
          ),
      );
  }

}