<?php
namespace DluTwBootstrap\Form\Element\Block;

class Checkbox extends \DluTwBootstrap\Form\Element\Line\Checkbox
{
    /* ******************** METHODS ************************ */

    /**
     * Load default decorators
     * @return \Zend\Form\Element
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
                 ->addDecorator('Description', array('tag' => 'p', 'class' => 'help-block'))
                 ->addDecorator('Errors')
                 ->addDecorator(array('divControls' => 'HtmlTag'), array('tag' => 'div', 'class' => 'controls'))
                 ->addDecorator('Label', array('class' => 'control-label'))
                 ->addDecorator('DivControlGroup')
                 ;
        }
        return $this;
    }
}