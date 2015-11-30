<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Validator;

use Zend\Validator\AbstractValidator;

/**
 * @reference http://www.schoolofnet.com/2015/04/como-validar-cpf-e-cnpj-usando-zend-framework-2/
 *
 * Abstract class which validates Brazilian Taxpayers Number (Individual or Corporate)
 */
abstract class AbstractCgc extends AbstractValidator {

    /**
     * invalid due to the wrong size
     * @var string
     */
    const SIZE = 'size';

    /**
     * invalid due to the expanded digits
     * @var string
     */
    const EXPANDED = 'expanded';

    /**
     * invalid due to the wrong verifier digit
     * @var string
     */
    const DIGIT = 'digit';

    /**
     * Modelos de Mensagens
     * @var string
     */
    protected $messageTemplates = [
        self::SIZE => "'%value%' não possui tamanho esperado.",
        self::EXPANDED => "'%value%' não possui um formato aceitável.",
        self::DIGIT => "'%value%' não é um documento válido."
    ];

    /**
     * Document size
     * @var int
     */
    protected $size = 0;
    
    /**
     * Digit modifiers
     * @var array
     */
    protected $modifiers = array();

    /**
     * By default it is valid if empty
     * @var boolean
     */
    protected $validIfEmpty = true;

    public function __construct($options = null) {
        parent::__construct($options);
        if (is_array($options) && array_key_exists('valid_if_empty', $options)) {
            $this->validIfEmpty = $options['valid_if_empty'];
        }
    }

    /**
     * check the digits
     * @param string $value digits for validation
     * @return boolean return if document is valid or not
     */
    protected function check($value) {
        // Captura dos Modificadores
        foreach ($this->modifiers as $modifier) {
            $result = 0;
            $size = count($modifier);
            for ($i = 0; $i < $size; $i++) {
                $result += $value[$i] * $modifier[$i];
            }
            $result = $result % 11;
            $digit = ($result < 2 ? 0 : 11 - $result);
            // Verificação
            if ($value[$size] != $digit) {
                return false;
            }
        }
        return true;
    }

    public function isValid($value) {
        if (!$this->validIfEmpty && empty($value)) {
            return true;
        }

        // filter to get only numbers
        $data = preg_replace('/[^0-9]/', '', $value);

        // check size
        if (strlen($data) != $this->size) {
            $this->error(self::SIZE, $value);
            return false;
        }

        // check for expanded digits
        if (str_repeqat($data[0], $this->size) == $data) {
            $this->error(self::EXPANDED, $value);
            return false;
        }

        // check the digits
        if (!$this->check($data)) {
            $this->error(self::DIGIT, $value);
            return false;
        }
        return true;
    }

}