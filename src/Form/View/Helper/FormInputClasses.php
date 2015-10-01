<?php
namespace ZffBase\Form\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * FormInputClasses Helper
 *
 * @package ZffBase
 * @subpackage ZffBase_Form_Helper
 */
class FormInputClasses extends AbstractHelper {

    private $defaultKeyClasses = '';
    private $permanentClasses = '';
    private $classes = array(
        'error'   => 'error',
        'warning' => 'warning',
        'info'    => 'info',
        'success' => 'success',
    );

    /**
     * @param string $defaultKeyClasses
     * @param string $permanentClasses
     * @param array $classes
     */
    public function __construct($defaultKeyClasses = 'error', $permanentClasses = '', array $classes = null ) {
        if(!empty($classes)) {
            $this->classes = $classes;
        }
        $this->defaultKeyClasses = $defaultKeyClasses;
        $this->permanentClasses = $permanentClasses;
    }

    public function __invoke(\Zend\Form\Element $e, $keyClasses = null) {
        $classes = $this->permanentClasses;
        $messages = $e->getMessages();
        if (!empty($messages)) {
            if (!$keyClasses) {
                $keyClasses = $this->defaultKeyClasses;
            }

            if (!isset($this->classes[$keyClasses])) {
                throw new \RuntimeException(sprintf('A chave \'%s\' não existe no atributo $classes da Helper %s', $keyClasses, __CLASS__));
            }

            $classes .= ' ' . $this->classes[$keyClasses];
        }
        return $classes;
    }
}
