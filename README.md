# ZffBase

Versão 0.0.1

## Introdução

ZffBase fornece um conjunto de classes que podem ser utilizadas em diversos modulos do ZF2.

Você precisará do ZffBase quando utilizar algum módulo que dependa dele ou quando você for
construir um módulo que precisa dele.

## Requisitos

* Zend Framework 2
* DoctrineModule
* DoctrineORMModule

## Instalação

Clone este projeto na pasta `./vendor/` e ative-o no arquivo `./config/application.config.php`.

Principais classes disponibilizadas
-----------------------------------

* Fábricas Abstratas (*Abstract Factories*):
  * `ZffBase\Form\FormAbstractFactory`         - Fabrica todas as classes que herdam de `AbstractForm`
  * `ZffBase\Form\InputFilterAbstractFactory`  - Fabrica todas as classes que herdam de `AbstractInputFilter`
  * `ZffBase\Service\ServiceAbstractFactory`   - Fabrica todas as classes que herdam de `AbstractService`
* Classes Utilitárias, dentro do *namespace* `ZffBase\Util`:
  * `ZffBase\Util\Crypt`    - Funções basicas de criptografia.
  * `ZffBase\Util\Debugger` - Funções de debug.
  * `ZffBase\Util\File`     - Algumas funções extras para manipular arquivos.
* Outras classes abstratas:
  * `ZffBase\Entity\AbstractEntity`    - Entity
  * `ZffBase\Service\AbstractService`  - Service
  * `ZffBase\Form\AbstractForm`        - Form
  * `ZffBase\Form\AbstractInputFilter` - InputFilter

## TODO

  * incluir casos de testes
  * incluir documentacao com exemplos
  * ZffBase\Entity\AbstractEntityRepository - handle composite (multiple) identifiers
  * ZffBase\Service\AbstractService         - incluir get/set autocommit
  * ZffBase\Util\File                       - fazer alguns testes nos parametros antes de usa-lo
