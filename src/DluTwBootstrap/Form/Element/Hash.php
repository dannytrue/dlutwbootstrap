<?php
namespace DluTwBootstrap\Form\Element;

class Hash extends \Zend\Form\Element\Hash
{

    /* ******************** METHODS ************************ */

    public function loadDefaultDecorators() {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $getId = function(\Zend\Form\Decorator $decorator) {
                return $decorator->getElement()->getId() . '-element';
            };
            $this->addDecorator('ViewHelper');
        }
        return $this;
    }
}