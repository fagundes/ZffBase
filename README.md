# Zff Base for Zend Framework 2

`Zff\Base` module is a set of classes which are commonly used in several ZF2 projects. 

## Requisitos

* php 5.3+ (with fileinfo extension)
* Zend Framework 2
* DoctrineModule 
* DoctrineORMModule (some classes depends of)

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

 - [ ] update to php 5.4+
 - [ ] include get/set autocommit in `Zff\Base\Service\AbstractService`
 - [ ] translate files to english
 - [x] add license header on all files
 - [ ] review Debugger static methods
 - [ ] review crypt classes to be a proxy to zend classes 
 - [ ] include tests cases
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
* A New Router