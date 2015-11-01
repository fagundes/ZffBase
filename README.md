# Zff Base for Zend Framework 2

`Zff\Base` module is a set of classes which are commonly used in several ZF2 projects. 

## Requirements

* php 5.5+ (with fileinfo extension)
* Zend Framework 2
* DoctrineModule & DoctrineORMModule
* ZFTable

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
php composer.phar require fagundes/zff-base:0.*
```

Then add `Zff\\Base` to your `config/application.config.php`.

Installation without composer is not officially supported and requires you to manually install all dependencies that are listed in composer.json

#### How to install FileInfo extension

Maybe you don't have fileinfo extension active on your web server. You can install php extension of several ways. Such as using pecl, apt-get (at gnu/linux). 

To install the extension at xamp, you only need to uncomment the following line in the php.ini file. 

```ini
extension=php_fileinfo.dll
```

### TODO

 - [x] update to php 5.5+
 - [x] add license header on all files
 - [x] include bs form classes
 - [ ] include get/set autocommit in `Zff\Base\Service\AbstractService`
 - [ ] translate files to english (Partial)
 - [x] review Debugger static methods
 - [ ] review crypt classes to be a proxy to zend classes 
 - [ ] include tests cases
 - [ ] review classes name 
 - [ ] review abstract factories 
 - [ ] change ZFTable and DoctrineORMModule to optional dependency. 
 - [ ] create documentation with examples
 - [ ] handle composite (multiple) identifiers in `Zff\Base\Entity\AbstractEntityRepository` 

## Main classes available

* Abstract Factories:
  * `Zff\Base\Form\FormAbstractFactory`         - creates all classes that inherits of `Zff\Base\Form\AbstractForm`
  * `Zff\Base\Form\InputFilterAbstractFactory`  - creates all classes that inherits of `Zff\Base\Form\AbstractInputFilter`
  * `Zff\Base\Service\ServiceAbstractFactory`   - creates all classes that inherits of `Zff\Base\Service\AbstractService`
* Util classes at the namespace `Zff\Base\Util`:
  * `Zff\Base\Util\Crypt`    - Basic crypt functions.
  * `Zff\Base\Util\Debugger` - Debug fuctions.
  * `Zff\Base\Util\File`     - Some functions to handle files.
  * and more
* Others abstract classes:
  * `Zff\Base\Entity\AbstractEntity`    - Entity
  * `Zff\Base\Service\AbstractService`  - Service
  * `Zff\Base\Form\AbstractForm`        - Form
  * `Zff\Base\Form\AbstractInputFilter` - InputFilter
* Helper classes
  * `Zff\Base\View\Helper\Link`             - creates a tag Anchor using Url Helper params
  * `Zff\Base\View\Helper\PostLink`         - as Link but uses js to POST 
  * `Zff\Base\View\Helper\PaginatorLink`    - as PostLink receives a $page to create a tag Anchor
  * `Zff\Base\View\Helper\GetRoute`         - checks if a passed route is the current one
  * `Zff\Base\View\Helper\Escaper\NoEscape` - creates a fake Escape, usefull with some helpers that must have a escape but you dont really want to change anything
* Form Elements
  * `Zff\Base\Form\Element\Bs*`             - Includes Bootstrap 4 classes
* Form Helper classes
  * `Zff\Base\Form\View\Helper\BsFormRow`                    - Creates a single element (as FormRow Helper) but using Bootstrap struture and css classes
  * `Zff\Base\Form\View\Helper\BsForm`                       - Creates the entire form (as Form Helper) but using Bootstrap struture and css classes
  * `Zff\Base\Form\View\Helper\FormActionButton`             - 
  * `Zff\Base\Form\View\Helper\FormInputClasses`             -    
  * `Zff\Base\Form\View\Helper\FormMultiCheckboxSplit`       -    
  * `Zff\Base\Form\View\Helper\FormRadioSplit`               -    
* Router
  * `Zff\Base\Mvc\Router\ControllerRouteStack` - Copy a model route to several  children controllers  