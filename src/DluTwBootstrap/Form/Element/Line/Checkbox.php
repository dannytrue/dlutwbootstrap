<?php
namespace DluTwBootstrap\Form\Element\Line;

class Checkbox extends \Zend\Form\Element\Checkbox
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
            $this->addDecorator('ViewHelper')
                 //->addDecorator('Errors')
                 ->addDecorator('CheckboxLabel');
        }
        return $this;
    }

}