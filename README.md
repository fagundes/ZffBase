[![Latest Unstable Version](https://img.shields.io/packagist/vpre/fagundes/zff-base.svg)](https://packagist.org/packages/fagundes/zff-base)
[![Build Status](https://travis-ci.org/fagundes/ZffBase.svg?branch=develop)](https://travis-ci.org/fagundes/ZffBase)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffBase/badge.svg?branch=develop&service=github)](https://coveralls.io/github/fagundes/ZffBase?branch=develop)

[![Latest Stable Version](https://img.shields.io/packagist/v/fagundes/zff-base.svg)](https://packagist.org/packages/fagundes/zff-base)
[![Build Status](https://travis-ci.org/fagundes/ZffBase.svg?branch=0.1.0)](https://travis-ci.org/fagundes/ZffBase)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffBase/badge.svg?branch=0.1.0&service=github)](https://coveralls.io/github/fagundes/ZffBase?branch=0.1.0)

[![Total Downloads](https://poser.pugx.org/fagundes/zff-base/downloads)](https://packagist.org/packages/fagundes/zff-base) [![License](https://poser.pugx.org/fagundes/zff-base/license)](https://packagist.org/packages/fagundes/zff-base)

Zff Base for Zend Framework 2
=============================

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

## Contribuing

If you want to help check the contribuing instructions [here](CONTRIBUTING.md).

### TODO

 - [ ] translate files to english (Partial++)
 - [ ] include tests cases (Partial)
 - [ ] review abstract factories 
 - [ ] change ZFTable and DoctrineORMModule to optional dependency. 
 - [ ] add Bootstrap 3/4 as optional dependency.
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