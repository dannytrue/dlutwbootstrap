<?php
namespace DluTwBootstrap\Form\Element\Line;

/**
 * Checkbox line element
 * @package DluTwBootstrap
 * @copyright David Lukas (c) - http://www.zfdaily.com
 * @license http://www.zfdaily.com/code/license New BSD License
 * @link http://www.zfdaily.com
 * @link https://bitbucket.org/dlu/dlutwbootstrap
 */
class Checkbox extends \Zend\Form\Element\Checkbox
{

    /* ******************** METHODS ************************ */

    /**
     * Load default decorators
     * @return Checkbox
     */
    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $getId = function(\Zend\Form\Decorator $decorator) {
                return $decorator->getElement()->getId() . '-element';
            };
            $this->addDecorator('ViewHelper')
                 //->addDecorator('Errors')
                 ->addDecorator('CheckboxLabel');
        }
        return $this;
    }
}