# Zff\Base

Versão 0.0.1

## Introdução

Zff\Base fornece um conjunto de classes que podem ser utilizadas em diversos modulos do ZF2.

Você precisará do Zff\Base quando utilizar algum módulo que dependa dele ou quando você for
construir um módulo que precisa dele.

## Requisitos

* PHP 5.l3+
* extensao FileInfo
* Zend Framework 2
* DoctrineModule
* DoctrineORMModule

## Instalação

### Instalação via composer

`php composer.phar require fagundes/zff-base:dev-master`

### Instalação manual

Clone este projeto na pasta `./vendor/` e ative-o no arquivo `./config/application.config.php`.

### Para usar o FileInfo

No xamp descomentar linha abaixo no php.ini

extension=php_fileinfo.dll

No linux acredito que a solução seja

sudo apt-get install php5-fileinfo

Principais classes disponibilizadas
-----------------------------------

* Fábricas Abstratas (*Abstract Factories*):
  * `Zff\Base\Form\FormAbstractFactory`         - Fabrica todas as classes que herdam de `AbstractForm`
  * `Zff\Base\Form\InputFilterAbstractFactory`  - Fabrica todas as classes que herdam de `AbstractInputFilter`
  * `Zff\Base\Service\ServiceAbstractFactory`   - Fabrica todas as classes que herdam de `AbstractService`
* Classes Utilitárias, dentro do *namespace* `Zff\Base\Util`:
  * `Zff\Base\Util\Crypt`    - Funções basicas de criptografia.
  * `Zff\Base\Util\Debugger` - Funções de debug.
  * `Zff\Base\Util\File`     - Algumas funções extras para manipular arquivos.
* Outras classes abstratas:
  * `Zff\Base\Entity\AbstractEntity`    - Entity
  * `Zff\Base\Service\AbstractService`  - Service
  * `Zff\Base\Form\AbstractForm`        - Form
  * `Zff\Base\Form\AbstractInputFilter` - InputFilter

## TODO

  * incluir casos de testes
  * incluir documentacao com exemplos
  * Zff\Base\Entity\AbstractEntityRepository - handle composite (multiple) identifiers
  * Zff\Base\Service\AbstractService         - incluir get/set autocommit
  * Zff\Base\Util\File                       - fazer alguns testes nos parametros antes de usa-lo
