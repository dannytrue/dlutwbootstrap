<?php
namespace DluTwBootstrap\Form\Element\Line;

class Select extends \Zend\Form\Element\Select
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
                ->addDecorator('Label');
        }
        return $this;
    }
}