<?php
namespace DluTwBootstrap\Form\Element\Block;

class Password extends \DluTwBootstrap\Form\Element\Line\Password
           implements \DluTwBootstrap\Form\Element\InlineHelp
{
    /**
     * Optional *short* help text displayed inline with the control
     * @var string
     */
    protected $_inlineHelp;

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
                ->addDecorator('InlineHelp', array('tag' => 'span', 'class' => 'help-inline'))
                ->addDecorator('Description', array('tag' => 'p', 'class' => 'help-block'))
                ->addDecorator('Errors')
                ->addDecorator(array('divControls' => 'HtmlTag'), array('tag' => 'div', 'class' => 'controls'))
                ->addDecorator('Label', array('class' => 'control-label'))
                ->addDecorator('DivControlGroup');
        }
        return $this;
    }

    /**
     * Sets inline help
     * @param string $inlineHelp
     */
    public function setInlineHelp($inlineHelp) {
        $this->_inlineHelp = $inlineHelp;
    }

    /**
     * Returns the inline help
     * @return string
     */
    public function getInlineHelp() {
        return $this->_inlineHelp;
    }


}