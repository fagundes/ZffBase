<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Validator;

/**
 * @reference http://www.schoolofnet.com/2015/04/como-validar-cpf-e-cnpj-usando-zend-framework-2/
 *
 * Validates the Brazilian Taxpayer Registration (CPF).
 */
class Cpf extends AbstractCgc
{
    /**
     * Tamanho do Campo
     * @var int
     */
    protected $size = 11;

    /**
     * Modificadores de Dígitos
     * @var array
     */
    protected $modifiers = [
        [10, 9, 8, 7, 6, 5, 4, 3, 2],
        [11, 10, 9, 8, 7, 6, 5, 4, 3, 2]
    ];
}
