[![Latest Unstable Version](https://img.shields.io/packagist/vpre/fagundes/zff-base.svg)](https://packagist.org/packages/fagundes/zff-base)
[![Build Status](https://travis-ci.org/fagundes/ZffBase.svg?branch=develop)](https://travis-ci.org/fagundes/ZffBase)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffBase/badge.svg?branch=develop&service=github)](https://coveralls.io/github/fagundes/ZffBase?branch=develop)

[![Latest Stable Version](https://img.shields.io/packagist/v/fagundes/zff-base.svg)](https://packagist.org/packages/fagundes/zff-base)
[![Build Status](https://travis-ci.org/fagundes/ZffBase.svg?branch=0.1.6)](https://travis-ci.org/fagundes/ZffBase)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffBase/badge.svg?branch=0.1.6&service=github)](https://coveralls.io/github/fagundes/ZffBase?branch=0.1.6)

[![Total Downloads](https://poser.pugx.org/fagundes/zff-base/downloads)](https://packagist.org/packages/fagundes/zff-base) [![License](https://poser.pugx.org/fagundes/zff-base/license)](https://packagist.org/packages/fagundes/zff-base)

Zff Base for Zend Framework 2
=============================

`Zff\Base` module is a set of classes which are commonly used in several ZF2 projects. 

## Requirements

* php 5.5+ (with fileinfo extension)
* Zend Framework 2
* DoctrineModule & DoctrineORMModule
* ZFTable (optional)

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

## TODO

 - [ ] translate files to english (Partial+++)
 - [ ] setup and include tests cases (Partial)
 - [ ] review abstract factories (Partial)
 - [ ] create documentation with examples

## Main classes available

* Abstract Factories:
  * `Form\FormAbstractFactory`         - creates all classes that inherits of `Form\AbstractForm` or `Form\AbstractFieldset`
  * `Form\InputFilterAbstractFactory`  - creates all classes that inherits of `Form\AbstractInputFilter`
  * `Service\ServiceAbstractFactory`   - creates all classes that inherits of `Service\AbstractService`
* Util classes at the namespace `Util`:
  * `Util\Debugger` - Debug fuctions.
  * `Util\File`     - Some functions to handle files.
  * and more
* Others abstract classes:
  * `Entity\AbstractEntity`    - Entity
  * `Service\AbstractService`  - Service
  * `Form\AbstractForm`        - Form
  * `Form\AbstractInputFilter` - InputFilter
* Helper classes
  * `View\Helper\Link`             - creates a tag Anchor using Url Helper params
  * `View\Helper\PostLink`         - as Link but uses js to POST
  * `View\Helper\PaginatorLink`    - as PostLink receives a $page to create a tag Anchor
  * `View\Helper\GetRoute`         - checks if a passed route is the current one
  * `View\Helper\Escaper\NoEscape` - creates a fake Escape, usefull with some helpers that must have a escape but you dont really want to change anything
* Form Elements
  * `Form\Element\Bs*`             - Includes Bootstrap 4 classes
* Form Helper classes
  * `Form\View\Helper\BsFormRow`                    - Creates a single element (as FormRow Helper) but using Bootstrap struture and css classes
  * `Form\View\Helper\BsForm`                       - Creates the entire form (as Form Helper) but using Bootstrap struture and css classes
  * `Form\View\Helper\FormActionButton`             -
  * `Form\View\Helper\FormInputClasses`             -
  * `Form\View\Helper\FormMultiCheckboxSplit`       -
  * `Form\View\Helper\FormRadioSplit`               -
* Router
  * `Mvc\Router\ControllerRouteStack` - Copy a model route to several children controllers